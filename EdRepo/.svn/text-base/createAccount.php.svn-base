<?php session_start();
 /****************************************************************************************************************************
 *    createAccount.php - Allows unregistered users to create an account on the system.
 *    --------------------------------------------------------------------------------------
 *  This file allows unregistered users to create an account on the system.  It is not intended for user maintence or for logged in
 *  users, but is only for unregistered users who want to register an account.
 *
 *  Version: 1.0
 *  Author: Ethan Greer
 *  Modified by: Jon Thompson (5/20/2011 - implemented new interface/Smarty)
 *
 *  Notes: (none) 
 ******************************************************************************************************************************/
 
 require("lib/backends/validate.php"); 
 require("lib/config.php");
 //require("lib/backends/mysql/validate.php");

  $smarty->assign("title", $COLLECTION_NAME . ' - Create New Account');
    // title of this page. For most pages: &COLLECTION . " - Title" , default: $COLLECTION_NAME
  $smarty->assign("tab", "home"); // active nav tab. default:  "home"
  $smarty->assign("baseDir", getBaseDir() ); // should always be getBaseDir() 
  
  $smarty->assign("pageName", "Create New Account");
    // name of page to placed in <h1> tag
    
  $smarty->assign("alert", array("type"=>"", "message"=>"") );
    
  
  $action="display"; //Determines what action to take.  The default is to just display a "create account" form.
  if(isset($_REQUEST["action"]) && !isset($userInformation)) {
    $action=$_REQUEST["action"];
  }
  $smarty->assign("action", $action);
  
  $loggedIn = false;
  $backendCapable = false;
  
if(in_array("UseUsers", $backendCapabilities["write"])) { //Make sure the back-end supports this feature.
  $backendCapable = true;
}

if(isset($userInformation)) { //You can't create a new account using this page if you are already logged in.
  $loggedIn = true;
  $smarty->assign("user", $userInformation);
}

$smarty->assign("loggedIn", $loggedIn);
$smarty->assign("backendCapable", $backendCapable);

$smarty->assign("NEW_ACCOUNTS_REQUIRE_APPROVAL", $NEW_ACCOUNTS_REQUIRE_APPROVAL);   

if ($backendCapable == true && $loggedIn == false) { //The back-end supports account creation and we're not logged in, so we can create an account.

  if($action=="display") {
     
    $smarty->assign("result", "");
    
  } elseif($action=="doCreateAccount") { //Actually try to create the account.
    /* Do basic error checking and validation... */
    if(!isset($_REQUEST["firstName"]) || !isset($_REQUEST["lastName"]) || !isset($_REQUEST["email"]) || !isset($_REQUEST["password1"]) || !isset($_REQUEST["password2"])) {
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Failed to create account.  
      One or more required parameters is missing.") );
      $smarty->assign("result", "");
    } elseif($_REQUEST["password1"]!=$_REQUEST["password2"] && validatePassword($_REQUEST["password1"])) {
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Error creating your account.  
      The passwords entered do not match.  Please correct this problem and select \"Create Account\" to try again.") );
      $smarty->assign("firstName", $_REQUEST["firstName"]);      
      $smarty->assign("lastName", $_REQUEST["lastName"]);
      $smarty->assign("email", $_REQUEST["email"]);
      $smarty->assign("result", "");
    } else { //Looks like the passwords match and we have everything we need to try to create the account, so try and check for errors.
      if($NEW_ACCOUNTS_REQUIRE_APPROVAL==TRUE) {
        $result=createUser($_REQUEST["email"], $_REQUEST["firstName"], $_REQUEST["lastName"], $_REQUEST["password1"], "Pending", "Temp", "FALSE");
      } else {
        $result=createUser($_REQUEST["email"], $_REQUEST["firstName"], $_REQUEST["lastName"], $_REQUEST["password1"], $NEW_ACCOUNTS_ACCOUNT_TYPE, "Temp", "FALSE");
      }
      $smarty->assign("result", $result);
      if($result=="BadPassword")
      {
        $smarty->assign("alert", array("type"=>"negative", "message"=>"Your password is invalid, please chose a different one.") );
        $smarty->assign("firstName", $_REQUEST["firstName"]);      
        $smarty->assign("lastName", $_REQUEST["lastName"]);
        $smarty->assign("email", $_REQUEST["email"]);
      }
      /* Check for errors creating account, and display a form allowing users to try again on error. */
      else if($result===FALSE || $result=="BadEmail" || $result=="EmailAlreadyExists" || $result=="BadPassword" || $result=="BadFirstName" || $result=="BadLastName" || $result=="BadType") {
        // Check to see if email exists in a deleted account
        if($result=="EmailAlreadyExists" && count($arrayUsers=searchUsers(array("email"=>$_REQUEST["email"])))>0){
          $smarty->assign("alert", array("type"=>"negative", "message"=>"Failed to create your account due because 
          this email is tied to a deleted account. Please contact a system administrator to restore account.") );
        } else {
          $smarty->assign("alert", array("type"=>"negative", "message"=>"Failed to create your account due to one or more errors.  
          Please corrent any errors and try again.") );
        }
        $smarty->assign("firstName", $_REQUEST["firstName"]);      
        $smarty->assign("lastName", $_REQUEST["lastName"]);
        $smarty->assign("email", $_REQUEST["email"]);
      } else { //The account was created okay.
        $smarty->assign("result", "success");
        $smarty->assign("alert", array("type"=>"positive", "message"=>"Your account has been successfully created.") );
        if($NEW_ACCOUNTS_REQUIRE_APPROVAL==TRUE) {
          $smarty->assign("alert", array("type"=>"positive", "message"=>"Your account has been successfully created.
          <br /><strong>Note:  Your account will not be active until it has been approved.</strong>  Until your account is approved, 
          you will not be able to log in to it, and it may appear to not be created.  
          Contact the collection maintainer for more information.") );
          if($EMAIL_MODERATORS_ON_NEW_USERS_PENDING_APPROVAL==TRUE) { //Should an email alert be sent to one or more emails/user classes alerting them to this account pending approval?
            /* Build the message to send and the subject of the email(s)*/
            $subject="New User Account Pending Approval on ".$COLLECTION_NAME;
            $message="A new account has been registered on the ".$COLLECTION_NAME." collection.  It is currently pending approval by you or ";
            $message=$message."another moderator.\n\nTo approve or deny this new account, log onto the collection using your email address ";
            $message=$message.'and password, go to the "User Management" panel, and set the type for the new user to your desired type.';
            $message=$message."\n\nNew Account Information:\n Name: ".$_REQUEST["firstName"]." ".$_REQUEST["lastName"]."\n";
            $message=$message." Email: ".$_REQUEST["email"]."\n\n----------------------------------------------------------\n";
            $message=$message."This message was automatically generated.  Please do not reply.  Contact the collection maintainer if your ";
            $message=$message."you like to stop receiving these alerts or would like to change other preferences.";
            $message=wordwrap($message, 70);
			      $headers = "From: EdRepo <noreply@edrepo.com>";
			
            /* Send the email to any users in the specified classes to send new user account alerts to. */
            for($i=0; $i<count($EMAIL_MODERATORS_ON_NEW_USERS_PENDING_APPROVAL_CLASS); $i++) {
              $users=searchUsers(array("type"=>$EMAIL_MODERATORS_ON_NEW_USERS_PENDING_APPROVAL_CLASS[$i])); //Get all users in the current class being checked
              for($j=0; $j<count($users); $j++) { //Loop through found users of the current type/class.
                print_r("MADE IT TO MAIL"); 
                mail($users[$j]["email"] ,$subject, $message, $headers);
              }
            }
            /* Send the email to any additional addresses to send new user account alerts to. */
            for($i=0; $i<count($EMAIL_MODERATORS_ON_NEW_USERS_PENDING_APPROVAL_LIST); $i++) {
              print_r("MADE IT TO MAIL2"); 
              mail($EMAIL_MODERATORS_ON_NEW_USERS_PENDING_APPROVAL_LIST[$i], $subject, $message, $headers);
            }			
          } // end if($EMAIL_MODERATORS_ON_NEW_USERS_PENDING_APPROVAL==TRUE)
        } // end if($NEW_ACCOUNTS_REQUIRE_APPROVAL==TRUE)		
      } // end check for creation error
    } // end check for input error
  } // end action if
} // end if ($backendCapable == true && $loggedIn == false)

 $smarty->display('createAccount.php.tpl');
?>