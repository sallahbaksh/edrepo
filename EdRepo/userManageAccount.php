<?php session_start();
/****************************************************************************************************************************
 *    userManageAccount.php - Allows a user to manage basic information about their account.
 *    --------------------------------------------------------------------------------------
 *  This file contains the front-end code to allow a user to manage their own account.  It can not modify any accounts except that
 *  of the currently logged in user, and only management of account details which all users, regardless of privilege level, can
 *  modify can be changed from this page.
 *
 *  Version: 1.0
 *  Author: Ethan Greer
 *  Modified by: Jon Thompson (5/13/11 - implemented new interface and Smarty)
 *
 *  Notes: (none) 
 ******************************************************************************************************************************/

  require("lib/backends/validate.php"); 
  require("lib/config.php");

  $smarty->assign("title", $COLLECTION_NAME . " - My Account");
    // title of this page. For most pages: &COLLECTION . " - Title" , default: $COLLECTION_NAME
  $smarty->assign("tab", "home"); // active nav tab. default:  "home"
  $smarty->assign("baseDir", getBaseDir() ); // should always be getBaseDir() 
  
  $smarty->assign("pageName", "My Account");
  
  $smarty->assign("alert", array("type"=>"", "message"=>"") );
                  // default empty alert message (type can be either positive or negative)

  
  
  
  /* By setting the action to "display" (harmless) and then only changing it if we have confirmed that we're actually logged in, we avoid the possibility of 
    someone not logged in setting an action to change something.  We also cna then assume, later, that if the action is anything but "display" we are 
    indeed logged in. */
  $action="display";
  if(isset($userInformation)) {
    if(isset($_REQUEST["action"])) {
      $action=$_REQUEST["action"];
    }
  }
  $smarty->assign("action", $action);

  if(!in_array("UseUsers", $backendCapabilities["read"])) {
    $readUsers = false;
  } else {
    $readUsers = true;
  }
  $smarty->assign("readUsers", $readUsers);
  
  if(!in_array("UseUsers", $backendCapabilities["read"]) || !in_array("UseUsers", $backendCapabilities["write"])) {
    $useUsers = false;
  } else {
    $useUsers = true;
  }
  $smarty->assign("useUsers", $useUsers);
  
  
if(isset($userInformation)) {
    $smarty->assign("userInformation", $userInformation);

  if($action=="display" && $readUsers==true) { //Just show current account information if the action is "display"

    
    
  } elseif($action=="displayEdit") { //displayEdit action shows a form allowing users to change account information.
    $smarty->assign("error", ""); // no error when just displaying
    
    
  } elseif($action=="doEdit") { //doEdit action actually tries to make changes done in the form presented in the displayEdit action.  Also handles errors.
      if(!isset($_REQUEST["firstName"]) || !isset($_REQUEST["lastName"]) || !isset($_REQUEST["email"])) { //If true, we don't have enough information to change anything
        $smarty->assign("alert", array("type"=>"negative", "message"=>"Error.  Not enough information given to change anything.") );
      } else {
        $result=editUserByID($userInformation["userID"],
                             $_REQUEST["email"],
                             $_REQUEST["firstName"],
                             $_REQUEST["lastName"], 
                             "", "", "", TRUE, TRUE, TRUE);
                             
        if($result!==TRUE) {
          $smarty->assign("alert", array("type"=>"negative", "message"=>"Unable to update your account. Please check your changes below and try again.") );
          $smarty->assign("error", $result);
          $smarty->assign("userInformation", array("userID"=>$userInformation["userID"],
                                                "email"=>$_REQUEST["email"],
                                                "firstName"=>$_REQUEST["firstName"],
                                                "lastName"=>$_REQUEST["lastName"],
                                                "type"=>$userInformation["type"], 
												"groups"=>$userInformation["groups"]) );
        } else {
          $smarty->assign("error", "");        
          $smarty->assign("alert", array("type"=>"positive", "message"=>"Information Successfully Updated.") );
        }
      }
    
    
  } elseif($action=="displayChangePassword") { //displayChangePassword action shows a form allowing users to change their password.
    $smarty->assign("error", "");
    
  } elseif($action=="doChangePassword") { //doChangePassword action actually tries to change the user's password.
      $hash = $userInformation["password"];
      $salt = substr($hash, 0, 64);
      $email = $userInformation["email"];
      if(!isset($_REQUEST["newPassword1"]) || !isset($_REQUEST["newPassword2"]) || !isset($_REQUEST["currentPassword"])) {
        $smarty->assign("alert", array("type"=>"negative", "message"=>"Unable to change your password.  One or more required pieces of information is missing.") );
        $smarty->assign("error", "MissingInformation");
      } elseif(secureHash($_REQUEST["currentPassword"], NULL, $salt) != $hash) {
        $smarty->assign("alert", array("type"=>"negative", "message"=>"Unable to change your password.  The password entered as your current password is incorrect.") );
        $smarty->assign("error", "IncorrectPassword");
      } elseif($_REQUEST["newPassword1"]!=$_REQUEST["newPassword2"]) {
        $smarty->assign("alert", array("type"=>"negative", "message"=>"Unable to change your password.  The two passwords entered for your new password do not match.") );
        $smarty->assign("error", "PasswordMismatch");
      } else {
        $result=editUserByID($userInformation["userID"], 
                             $userInformation["email"], 
                             $userInformation["firstName"], 
                             $userInformation["lastName"], 
                             $_REQUEST["newPassword1"], 
                             "", "", FALSE, FALSE, TRUE, TRUE, TRUE);
                             
        if($result===TRUE) { //Password change successful?
          $smarty->assign("alert", array("type"=>"positive", "message"=>"Your password has been successfully changed.") );
          $smarty->assign("error", "");
        } else { //This else block runs if the password change wasn't successful.
          $smarty->assign("error", $result);
          if($result=="BadPassword") {
            $smarty->assign("alert", array("type"=>"negative", "message"=>"The new password is not strong enough or otherwise invalid.") );
          } else {
            $smarty->assign("alert", array("type"=>"negative", "message"=>"An unknown error occurred while trying to change your password.<br />
            If this problem persists, please contact the collection maintainers to report the issue.") );
          }
        }
      }
    
    
  } elseif($action=="confirmAccountRemoval") { //confirmAccountRemoval action displays a confirmation before allowing users to delete their account.
    $usersSoftRemove = false;
    if(in_array("UsersSoftRemove", $backendCapabilities["write"])) {
      $usersSoftRemove = true;
    }
    $smarty->assign("usersSoftRemove", $usersSoftRemove);
    
    
  } elseif($action=="doAccountRemoval") { //doAccountRemoval action actually removes a user's account.
    if(in_array("UsersSoftRemove", $backendCapabilities["write"])) { //If true, the back-end is advertising soft-removal, so use that method.
      $result=removeUsersByID(array($userInformation["userID"]), TRUE);
    } else { //Back-end didn't advertise soft-removal, so don't user it.
      $result=removeUsersByID(array($userInformation["userID"]), FALSE);
    }
    if($result===TRUE) { //deletion successful
      logout($smarty); //Once we've deleted the account, we should also log the user out.
      $smarty->assign("alert", array("type"=>"positive", "message"=>"Your account has been successfully deleted.
      <br />Your account with this collection has been successfully deleted.  You have also been logged out.") );
    } else { //Error deleting account
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Account deletion failed.<br />
      If this problem persists, please contact this collection's maintainer.") );
    }
    
  } else { //Catch-all for any unknown action.
    $smarty->assign("alert", array("type"=>"negative", "message"=>"Unable to process your request.
    An unknown action was specified.") );
  } // end 'action' if
  
} // end 'logged in' if
        
  $smarty->display('userManageAccount.php.tpl');

?>