<?php session_start();
/****************************************************************************************************************************
 *    userManagement.php - Allows managing all users of the system.
 *    -------------------------------------------------------------
 *  Displays an optionally filtered list of users on the system, and allows editing, creating, and removing users.
 *
 *  Version: 1.0
 *  Author: Ethan Greer
 *  Modified by: Jon Thompson (5/6/2011 - implemented new interface/Smarty)
 *
 *  Notes: - Only Admins may use this page.
 ******************************************************************************************************************************/
  
  require("../lib/config.php");

  $smarty->assign("title", $COLLECTION_NAME . " - Admin - User Management");
    // title of this page. For most pages: &COLLECTION . " - Title" , default: $COLLECTION_NAME
  $smarty->assign("tab", "admin"); // active nav tab. default:  "home"
  $smarty->assign("baseDir", getBaseDir() ); // should always be getBaseDir() 
  
  $smarty->assign("pageName", "Admin - User Management");
  
  $smarty->assign("alert", array("type"=>"", "message"=>"") );
  
  /* By setting the action to "display" (harmless) and then only changing it if we have confirmed that we're actually logged in, we avoid the possibility of 
    someone not logged in setting an action to change something.  We also cna then assume, later, that if the action is anything but "display" we are 
    indeed logged in. */
  $wasFiltered=FALSE; //Set to true if the results were filtered.
  $action="display";
  if(isset($userInformation)) {
    if(isset($_REQUEST["action"])) {
      $action=$_REQUEST["action"];
    }
  }
  $smarty->assign("action", $action);
  
  if ( isset($_REQUEST["userID"]) ) {
    $smarty->assign("userID", $_REQUEST["userID"]);
  } else {
    $smarty->assign("userID", "");
  }
  
  if(!in_array("UseUsers", $backendCapabilities["read"]) || !in_array("UseUsers", $backendCapabilities["write"])) {
    $smarty->assign("useUsers", "false");
    $useUsers = false;
  } else {
    $smarty->assign("useUsers", "true");
    $useUsers = true;
  }
  
if (isset($userInformation) && $userInformation["type"]=="Admin") { //This block is if we're logged in as an admin.

  if($action=="display") { //Just show current account information
    if(!in_array("UseUsers", $backendCapabilities["read"])) {
      $smarty->assign("readUsers", "false");
    } else {
      $smarty->assign("readUsers", "true");
      
      if(!isset($_REQUEST["filterName"])) {
        $smarty->assign("filterName", "");
      } else {
        $smarty->assign("filterName", preg_replace('/"/', '&quot;', $_REQUEST["filterName"]) );
      }
      
      if(isset($_REQUEST["filterName"])) {
        $users=searchUsers(array("name"=>$_REQUEST["filterName"])); //Get users based on filter
        $wasFiltered=TRUE;
        $smarty->assign("wasFiltered", "true");
      } else {
        $users=searchUsers(array()); //Get all users
        $smarty->assign("wasFiltered", "false");
      }
      
      $smarty->assign("numUsers", count($users) );
      $smarty->assign("users", $users);
    }
    
    
  } elseif($action=="displayEdit" && isset($_REQUEST["userID"])) {
    if(!in_array("UseUsers", $backendCapabilities["read"]) || !in_array("UseUsers", $backendCapabilities["write"])) {
      $smarty->assign("useUsers", "false");
    } else {
      $smarty->assign("useUsers", "true");
      $editUserInfo=getUserInformationByID($_REQUEST["userID"]);
      $smarty->assign("editUserInfo", $editUserInfo);      
      $smarty->assign("error", ""); // no user-created error when initially displaying user information
    }
    
    
  } elseif($action=="displayChangePassword" && isset($_REQUEST["userID"])) {
    if(!in_array("UseUsers", $backendCapabilities["read"]) || !in_array("UseUsers", $backendCapabilities["write"])) {
      $smarty->assign("useUsers", "false");
    } else {
      $smarty->assign("useUsers", "true");
      $editUserInfo=getUserInformationByID($_REQUEST["userID"]);
      $smarty->assign("editUserInfo", $editUserInfo);
    }
 
    
  } elseif($action=="doEdit" && isset($_REQUEST["userID"])) {
    $editUserInfo=getUserInformationByID($_REQUEST["userID"]);
    $smarty->assign("editUserInfo", $editUserInfo);
    if(!in_array("UseUsers", $backendCapabilities["read"]) || !in_array("UseUsers", $backendCapabilities["write"])) {
      $smarty->assign("useUsers", "false");
    } else {
      $smarty->assign("useUsers", "true");
      
      if(!isset($_REQUEST["firstName"]) || !isset($_REQUEST["lastName"]) || !isset($_REQUEST["email"]) || !isset($_REQUEST["type"]) || !isset($_REQUEST["groups"]) ) { //If true, we don't have enough information to change anything
        $smarty->assign("alert", array("type"=>"negative", "message"=>"Error.  Not enough information given to change anything.") );
      } else {
        $result=editUserByID($_REQUEST["userID"],
                            $_REQUEST["email"], 
                            $_REQUEST["firstName"], 
                            $_REQUEST["lastName"], 
                            "", 
                            $_REQUEST["type"],
							$_REQUEST["groups"],
							"",
                            TRUE, FALSE, FALSE, TRUE);
							
		if($result!==TRUE) {
          $smarty->assign("alert", array("type"=>"negative",
                                         "message"=>'Unable to update account. Please check your changes below and try again.
                                         <br />Invalid fields are highlighted.') );
          $smarty->assign("error", $result); // if result isn't true it contains an error
          
          // assign user-modified $_REQUEST variables to editUserInfo instead of database values
          $smarty->assign("editUserInfo", array("userID"=>$_REQUEST["userID"],
                                                "email"=>$_REQUEST["email"],
                                                "firstName"=>$_REQUEST["firstName"],
                                                "lastName"=>$_REQUEST["lastName"],
                                                "type"=>$_REQUEST["type"],
												"groups"=>$_REQUEST["groups"], 
												"locked"=>$_REQUEST["locked"]	));
        } else { // Success
		  $user = getUserInformationByID($_REQUEST["userID"]);
		  $resetPass = "http://".$_SERVER["SERVER_NAME"].dirname(dirname($_SERVER["PHP_SELF"]))."/forgotPassword.php"; 

      $message = "Dear ". $user["firstName"]. " " . $user["lastName"] . ",\n\n"; 
		  
      if ($user["type"] != "Pending" && $user["type"] != "Disabled" && $user["type"] != "Deleted")
		  {

			   $message .= "We are pleased to inform you that your account for EdRepo has been approved!\n\n"; 
			   $message .= "Your user name is: " . $user["email"] . ". Your password remains the same, however you can reset your password at anytime on EdRepo's forgot password page: " . $resetPass . "    if necessary.\n\n";
			   $message .= "We would like to welcome you to EdRepo!\n\n"; 
			  
		  }
		  else if ($user["type"] == "Disabled" || $user["type"] == "Deleted")
		  {
			  $message .= "We regret to inform you that your account for EdRepo has been either disabled or deleted.\n\n"; 
			  $message .= "The user name of: " . $user["email"] . " will no longer gain access to EdRepo.\n\n";
			  $message .= "If this user name is not yours please disregard this email.\n\n"; 			  
		  }
			

      $message .= "Sincerely,\n"; 
      $message .= "EdRepo"; 
      $message .= "\n--------------------------\n";
      $message .= "This is an automatically generated email. Please do not reply.\n";
      $message .= "For security reasons we suggest you delete this email once you have logged in."; 
      $message=wordwrap($message, 70);
      $subject = "EdRepo Account"; 
      $headers = "From: EdRepo <noreply@edrepo.com>";

      if(!mail($user["email"], $subject, $message, $headers)){
          $smarty->assign("alert", array("type"=>"negative", "message"=>"Email confirmation was not sent.") );
      } 
          $smarty->assign("editUserInfo", getUserInformationByID($_REQUEST["userID"]) );
          $smarty->assign("error", "");
          $smarty->assign("alert", array("type"=>"positive", "message"=>"Information Successfully Updated.") );
        }
      }
    }
    
    
  } elseif($action=="doChangePassword" && isset($_REQUEST["userID"])) {
    $editUserInfo=getUserInformationByID($_REQUEST["userID"]);
    $smarty->assign("editUserInfo", $editUserInfo);
    if(!in_array("UseUsers", $backendCapabilities["read"]) || !in_array("UseUsers", $backendCapabilities["write"])) {
      $smarty->assign("useUsers", "false");
    } else {
      $smarty->assign("useUsers", "true");
      if(!isset($_REQUEST["newPassword1"]) || !isset($_REQUEST["newPassword2"]) || !isset($_REQUEST["userID"])) {
        $smarty->assign("alert", array("type"=>"negative", "message"=>"Unable to change your password.<br />
                                                           One or more required pieces of information is missing."));
      } elseif($_REQUEST["newPassword1"]!=$_REQUEST["newPassword2"]) {
        $smarty->assign("alert", array("type"=>"negative", "message"=>"Unable to change your password.<br />
                                                                      The two passwords entered for your new password do not match."));
      } else {
        $result=editUserByID($editUserInfo["userID"], $editUserInfo["email"], $editUserInfo["firstName"], 
                             $editUserInfo["lastName"], $_REQUEST["newPassword1"], "", "", "", FALSE, TRUE, TRUE, TRUE);
        if($result===TRUE) {
          $smarty->assign("alert", array("type"=>"positive", "message"=>"Your password has been successfully changed.</p>") );
        } else {
          if($result=="BadPassword") {
            $smarty->assign("alert", array("type"=>"negative", "message"=>"The new password is not strong enough or otherwise invalid.") );
          } else {
            $smarty->assign("alert", array("type"=>"negative", "message"=>"An unknown error occurred while trying to change your password.
            <br />If this problem persists, please contact the collection maintainers to report the issue.") );
          }
        }
      }
    }
    
  } elseif($action=="displayCreateAccount") {
    if(!$useUsers) { //This if block runs if the back-end doesn't support working with users in read/write mode, which is required.
      $smarty->assign("alert", array("type"=>"negative", "message"=>"The back-end in use does not support working 
      with users in read and/or write mode. Creating a new user/account requires the back-end to support working with users in read and
      echo 'write mode.") );
    } else {
      // assign empty editUserInfo for form
      $smarty->assign("editUserInfo", array("email"=>"",
                                            "firstName"=>"",
                                            "lastName"=>"",
                                            "type"=>"",
											"groups"=>"", 
											"locked"=>""	));
      $smarty->assign("result", ""); 
    }
    
  } elseif($action=="doCreateAccount") {
    if($useUsers) { //Only continue if the back-end supports working with users in read/write mode.
      if(!(isset($_REQUEST["type"]) && isset($_REQUEST["firstName"]) && isset($_REQUEST["lastName"]) && isset($_REQUEST["email"]) && isset($_REQUEST["password1"]) && isset($_REQUEST["password2"]))) {
        $smarty->assign("alert", array("type"=>"negative", "message"=>"Unable to create new user/account.  One 
        or more required pieces of information is missing.<br />
        If you are receiving this error after clicking a button or link from within this system, please report it to the collection 
        maintainer.") );
      } else {
        $result=createUser($_REQUEST["email"], $_REQUEST["firstName"], $_REQUEST["lastName"], $_REQUEST["password1"], $_REQUEST["type"], $_REQUEST["groups"], "FALSE");
        $smarty->assign("result", $result);
        if($result===FALSE || $result=="BadEmail" || $result=="EmailAlreadyExists" || $result=="BadPassword" || $result=="BadFirstName" || $result=="BadLastName" || $result=="BadType" || $result=="BadGroup") {
        
          $smarty->assign("alert", array("type"=>"negative", "message"=>"Failed to create the user/account due to one or more errors.  Please corrent any errors and try again.") );
          
          // assign user-modified $_REQUEST variables to editUserInfo instead of database values
          $smarty->assign("editUserInfo", array("email"=>$_REQUEST["email"],
                                                "firstName"=>$_REQUEST["firstName"],
                                                "lastName"=>$_REQUEST["lastName"],
                                                "type"=>$_REQUEST["type"], 
												"groups"=>$_REQUEST["groups"]) );
          /*                                      
          echo '<form name="createAccountFrom" action="userManagement.php" method="post">';
          echo '<fieldset>';
          echo '<input type="hidden" readonly="readonly" name="action" value="doCreateAccount"></input>';
          echo '<div class="fieldRow"><label for="firstName"><strong>First Name:</strong>';
          if($result=="BadFirstName") {
            echo '<br><span class="error">The first name entered is invalid.</span>';
          }
          echo '</label><input type="text" name="firstName" id="firstName" value="'.$_REQUEST["firstName"].'"></input></div>';
          echo '<div class="fieldRow"><label for="lastName"><strong>Last Name:</strong>';
          if($result=="BadLastName") {
            echo '<br><span class="error">The last name entered is invalid.</span>';
          }
          echo '</label><input type="text" name="lastName" id="lastName" value="'.$_REQUEST["lastName"].'"></input></div>';
          echo '<div class="fieldRow"><label for="email"><strong>Email Address:</strong>';
          if($result=="BadEmail") {
            echo '<br><span class="error">The email address entered is not valid.</span>';
          }
          if($result=="EmailAlreadyExists") {
            echo '<br><span class="error">The email address entered already exists in the system.  Please choose a different email address.</span>';
          }
          echo '</label><input type="text" name="email" id="email" value="'.$_REQUEST["email"].'"></input></div>';
          echo '<div class="fieldRow"><label for="firstName"><strong>Type:</strong>';
          if($result=="BadType") {
            echo '<br><span class="error">The type specified is invalid or not supported by the back-end.  Please choose a different type.</span>';
          }
          echo '</label>';
          echo '<select name="type">';
            if($_REQUEST["type"]=="Disabled") {
              echo '<option value="Pending" selected="selected">Pending Approval</option>';
            } else {
              echo '<option value="Pending">Pending Approval</option>';
            }
            if($_REQUES["type"]=="Viewer") {
              echo '<option value="Viewer" selected="selected">Viewer</option>';
            } else {
              echo '<option value="Viewer">Viewer</option>';
            }
            if($_REQUES["type"]=="SuperViewer") {
              echo '<option value="SuperViewer" selected="selected">SuperViewer</option>';
            } else {
              echo '<option value="SuperViewer">SuperViewer</option>';
            }
            if($_REQUES["type"]=="Submitter") {
              echo '<option value="Submitter" selected="selected">Submitter</option>';
            } else {
              echo '<option value="Submitter">Submitter</option>';
            }
            if($_REQUES["type"]=="Editor") {
              echo '<option value="Editor" selected="selected">Editor</option>';
            } else {
              echo '<option value="Editor">Editor</option>';
            }
            if($_REQUES["type"]=="Admin") {
              echo '<option value="Admin" selected="selected">Admin</option>';
            } else {
              echo '<opyion value="Admin">Admin</option>';
            }
            if($_REQUES["type"]=="Disabled") {
              echo '<option value="Disabled" selected="selected">Disabled</option>';
            } else {
              echo '<option value="Disabled">Disabled</option>';
            }
          echo '</select></div>';
          echo '<div class="fieldRow"><label for="password1"><strong>Password:</strong></label><input type="password" name="password1"></input></div>';
          echo '<div class="fieldRow"><label for="password2"><strong>Retype Password:</strong></label><input type="password" name="password2"></input></div>';
          echo '</fieldset>';
          echo '<fieldset class="buttons"><input type="submit" class="button" name="submit" value="Create Account"></input>';
          echo '<a href="userManagement.php?action=display" class="button">Cancel</a></fieldset>';
          echo '</form>';*/
        } else { //The account was created okay.
          $smarty->assign("alert", array("type"=>"positive", "message"=>"User account has been successfully created.") );
      
          // assign empty editUserInfo for form
          $smarty->assign("editUserInfo", array("email"=>"",
                                                "firstName"=>"",
                                                "lastName"=>"",
                                                "type"=>"", 
												"groups"=>"") );
        }
      }
    } else { //This else block runs if the back-end doesn't support working with users in read/write mode, which is required.
      $smarty->assign("alert", array("type"=>"negative", "message"=>"The back-end in use does not support working 
      with users in read and/or write mode. Creating a new user/account requires the back-end to support working with users in read and
      echo 'write mode.") );
    }
    
    
  } elseif($action=="confirmAccountRemoval" && isset($_REQUEST["userID"])) {
    $editUserInfo=getUserInformationByID($_REQUEST["userID"]);
    $smarty->assign("editUserInfo", $editUserInfo);
    
    $smarty->assign("usersSoftRemove", "false");
    if(in_array("UsersSoftRemove", $backendCapabilities["write"])) {
        $smarty->assign("usersSoftRemove", "true");
    }
    
    
  } elseif($action=="doAccountRemoval" && isset($_REQUEST["userID"])) {
    if(in_array("UsersSoftRemove", $backendCapabilities["write"])) { //If true, the back-end is advertising soft-removal, so use that method.
      $result=removeUsersByID(array($_REQUEST["userID"]), TRUE);
    } else { //Back-end didn't advertise soft-removal, so don't user it.
      $result=removeUsersByID(array($_REQUEST["userID"]), FALSE);
    }
    if($result===TRUE) { //deletion successful
      $smarty->assign("alert", array("type"=>"positive", "message"=>"The account has been successfully deleted.") );
      if($_REQUEST["userID"]==$userInformation["userID"]) { //Did we delete ourselves?
        logout(); //Log ourselves out if we just deleted ourselves.
        //echo '<p>Since you deleted the account you were currently logged in to, you have also been logged out.</p>';
      }
    } else { //Error deleting account
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Account deletion failed.
      <br />If this problem persists, please contact this collection's maintainer.") );
    }
    
    
  } elseif($action=="customError") {
    //Don't do anything.  An action of customError indicates any error handling/messages have already been taken care of.
  } else {
    $smarty->assign("alert", array("type"=>"negative", "message"=>"Unknown error while processing request.
    <br />An unknown error occurred while processing your request.  If you are receiving this error after clicking a link or button from within this system, please report this error to the collection maintainer.") );
  }
}

  $smarty->display('userManagement.php.tpl');
  ?>