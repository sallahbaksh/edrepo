<?php session_start();
 /****************************************************************************************************************************
 *    forgotPassword.php - Allows users to recover their password/get a new password.
 *    --------------------------------------------------------------------------------------
 *  Allows users who have forgotten their password to get a new one or have their old one sent to their email address.
 *
 *  Version: 1.0
 *  Author: Ethan Greer (portions by Douglas Lovell)
 *  Modified by: Jon Thompson (5/20/2011 - implemented new interface/Smarty)
 *
 *  Notes: - Not very secure.  Better security would require some back-end changes.
 *         - This file accepts the following POST/GET parameters:
 *              action : One of "display" (default) to display a form to identify the user, or "recover" to actually recover/reset
 *                  the user's password.
 *              email : The email address of the user who forgot their password.
 ******************************************************************************************************************************/

require("lib/backends/validate.php"); 
require("lib/config.php");
//require("lib/backends/mysql/validate.php");
  $smarty->assign("title", $COLLECTION_NAME . ' - Forgot Password');
    // title of this page. For most pages: &COLLECTION . " - Title" , default: $COLLECTION_NAME
  $smarty->assign("tab", "home"); // active nav tab. default:  "home"
  $smarty->assign("baseDir", getBaseDir() ); // should always be getBaseDir() 
  
  $smarty->assign("pageName", "Forgot Password");
    // name of page to placed in <h1> tag
    
  $smarty->assign("alert", array("type"=>"", "message"=>"") );
  
 
  
  $action="display"; //Determines what action to take.  The default is to just display a "create account" form.
  if(isset($_REQUEST["action"]) && !isset($userInformation)) {
    $action=$_REQUEST["action"];
  }
  $smarty->assign("action", $action);
  
  $backendCapable = false;
  $loggedIn = false;
  
  if(in_array("UseUsers", $backendCapabilities["write"])) { //Make sure the back-end supports this feature.
    $backendCapable = true;
  }
  if(isset($userInformation)) { //Logged in users obviously remembered their passwords.  Tell them how to change it, but don't actually send/reset it.
    $loggedIn = true;
  }
  $smarty->assign("loggedIn", $loggedIn);
  $smarty->assign("backendCapable", $backendCapable);
  
if ($backendCapable == true && $loggedIn == false) { //The back-end supports account creation and we're not logged in, so we can create an account.
  if($action=="display") {
    // Smarty handles this
    
  } elseif($action=="recover") { //Actually try to recover/reset the password, and send the result to the user's email.
    if(!isset($_REQUEST["email"])) { //If true, no password was given.  Given error.
      $smarty->assign("alert", array("type"=>"negative", "message"=>"No email address was found while attempting to recover a lost password.  
      Unable to continue.") );
    } else { //We have an email, so check to make sure its a valid email and if it is, send the user's password to the email.
      if(!validateEmail($_REQUEST["email"])) {
        $smarty->assign("alert", array("type"=>"negative", "message"=>"The email address entered is not a valid email address. 
        Please re-check the email address for accuracy.") );
        $smarty->assign("email", htmlspecialchars($_REQUEST["email"]) );
      } else { //A valid email address was given, so process it.
        /* NOTE:  We _ALWAYS_ report success, even if the email address doesn't exist in the collection!  This is to make it harder
          for attackers to abuse this password recovery system to detect emails which actually exist in the system! */
        $user=searchUsers(array("email"=>$_REQUEST["email"]));
        if($user!==FALSE && $user!="NotImplimented" && count($user)==1) { //If no error eas reported searching for the user by email, and the search was supported, and returned exactly one user was returned, send them an email with their password.
        
          // clear old tokens and generate new one for this user
          clearRecoveryTokens();
          removeRecoveryTokens($user[0]["userID"]);
          $token = createRecoveryToken($user[0]["userID"]);
          if ($token == false) {
            $resetLink = "ERROR generating your recovery token. Please try again or consult your system administrator.";
          } else {		  
            $resetLink = "http://".$_SERVER["SERVER_NAME"].$COLLECTION_BASE_URL."forgotPassword.php?action=reset&userID=".$user[0]["userID"]."&token=".$token;
          }
          
          //Build a message to send in the $message variable.
          $message=$user[0]["firstName"]." ".$user[0]["lastName"].", \n\n";
          $message=$message."You or somebody else requested that your password for your account on the ".$COLLECTION_NAME." collection be sent ";
          $message=$message."to you via the 'Forgot Password' tool.  To reset your password, follow the link below:\n\n";
          $message=$message.$resetLink."\n\n";
          $message=$message."Note this link will expire in 24 hours -- please reset your password as soon as possible.";
          $message=$message."\n--------------------------\n";
          $message=$message."This is an automatically generated email.  Please do not reply.\n";
          $message=$message."For security purposes, it is recommended that your delete this email once you are able to log into your account.";
          $message=wordwrap($message, 70); //Word-Wrap the message at 70 lines.
          $subject="Your password for the ".$COLLECTION_NAME." collection";
		  $headers = "From: EdRepo <noreply@edrepo.com>";
          if (!mail($user[0]["email"], $subject, $message, $headers)){
				$smarty->assign("alert", array("type"=>"negative", "message"=>"Email confirmation was not sent.") );
		  } //Send email to the user with the message and subject built above.
        }
        /* Report success, no matter if an email was actually sent.  This helps avoid attacks which use this feature to discover the email addresses
          of users of this system based on if a password recovery email could be sent or not. */
        $smarty->assign("alert", array("type"=>"positive", "message"=>"An email has been sent to "."<strong>".$_REQUEST["email"]."</strong>"." with 
        directions on how to reset your password.") );
      }
    }
    
  } elseif ($action == "reset" || $action == "doReset" || $action == "unLock") {
    if (!isset($_REQUEST["userID"]) && !isset($_REQUEST["token"])) {
      $smarty->assign("showForm", false);
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Sorry, not enough data has been provided. Please follow the exact link provided in the reset email.") );
    } else {
      $userID = $_REQUEST["userID"];
      $token = $_REQUEST["token"];
      $userInfo = getUserInformationByID($userID);
      clearRecoveryTokens(); // clear expired tokens
      if ($token != getRecoveryToken($userID) || $userInfo == false) {
        $smarty->assign("showForm", false);
        $smarty->assign("alert", array("type"=>"negative", "message"=>"Sorry, not enough data has been provided. Please follow the exact link provided in the reset email.") );
      } else {
        $smarty->assign("showForm", true);
        $smarty->assign("userID", $userID);
        $smarty->assign("token", $token);
		
		if ($action=="unLock"){//If the account is locked unlock it....this will be used from a link sent to the email with ID and token 
			$result = editUserByID($userInfo["userID"],
                             $userInfo["email"],
                             $userInfo["firstName"],
                             $userInfo["lastName"],
                             "",
                             "", "", "FALSE", TRUE, TRUE, TRUE, FALSE); 
			if($result){
				removeRecoveryTokens($userInfo["userID"]);
				$smarty->assign("showForm", false);
				$_SESSION["loginAttempts"] = 0; 
				$smarty->assign("alert", array("type"=>"positive", "message"=>"Account has been un-locked.")); 			
			}
			else{
				$smarty->assign("alert", array("type"=>"negative", "message"=>"Something went wrong when trying to un-lock your account. Please contact an administrator.")); 
			}
		}
        
        // continue if actually attempting to reset
        if ($action == "doReset") {
          if (!isset($_REQUEST["password1"]) && !isset($_REQUEST["password2"])) {
            $smarty->assign("alert", array("type"=>"negative", "message"=>"Sorry, not enough data has been provided. Please make sure you type your new password in both boxes.") );
          } else {
            $password1 = $_REQUEST["password1"];
            $password2 = $_REQUEST["password2"];
            if ($password1 != $password2) {
              $smarty->assign("alert", array("type"=>"negative", "message"=>"Sorry, the passwords entered were not the same. To save a new password, make sure to type the same password into both boxes.") );
            } else {
					if ($userInfo["locked"] == "TRUE"){//If it is locked and you reset the password unlock the account and use the password. 
						$result=editUserByID($userInfo["userID"],
                             $userInfo["email"],
                             $userInfo["firstName"],
                             $userInfo["lastName"],
                             $password1,
                             "", "", "FALSE", FALSE, TRUE, TRUE, FALSE);							 
					}
					else {
						$result=editUserByID($userInfo["userID"],
                             $userInfo["email"],
                             $userInfo["firstName"],
                             $userInfo["lastName"],
                             $password1,
                             "", "", "", FALSE, TRUE, TRUE, TRUE);
					}
                             
              if($result===TRUE) { //Password change successful?
                $smarty->assign("alert", array("type"=>"positive", "message"=>"Your password has been successfully changed.") );
                $smarty->assign("showForm", false);
                removeRecoveryTokens($userInfo["userID"]);
              } else { //This else block runs if the password change wasn't successful.
                $smarty->assign("error", $result);
                if($result=="BadPassword") {
                  $smarty->assign("alert", array("type"=>"negative", "message"=>"The new password is not strong enough or otherwise invalid.") );
                } else {
                  $smarty->assign("alert", array("type"=>"negative", "message"=>"An unknown error occurred while trying to change your password.<br />
                  If this problem persists, please contact the collection maintainers to report the issue.") );
                }
              }
            } // end if passwords match
          } // end if both passwords set
        } // end if doReset
      } // end check token
    } // end isset userID and token
  } // end action if
}

 $smarty->display('forgotPassword.php.tpl');
?>