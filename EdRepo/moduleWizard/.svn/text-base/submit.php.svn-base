<?php session_start();
/****************************************************************************************************************************
    moduleWizard/submit.php - main page for submitting a module
    --------------------------------------------------------------------------------------
    Fields: Minimum User Type, Comments
 
  Version: 1.0
  Author: Jon Thompson 
  Date: 27 Mar 2012
 
  Notes: Takes several key REQUEST variables (sent by the form/URL) :             
              - moduleID : ID of module to edit or create new version of; sent by URL or form
 ******************************************************************************************************************************/
  
  require("../lib/config.php");

  $smarty->assign("title", $COLLECTION_NAME . " - Module Wizard");
    // title of this page. For most pages: &COLLECTION . " - Title" , default: $COLLECTION_NAME
  $smarty->assign("tab", "modules"); // active nav tab. default:  "home"
  $smarty->assign("baseDir", getBaseDir() ); // should always be getBaseDir() 
  
  $smarty->assign("pageName", "Module Wizard - Submit");
  
  $smarty->assign("alert", array("type"=>"", "message"=>"") );
                  // default empty alert message (type can be either positive or negative)
  
  // define section of module wizard
  $smarty->assign("section", "Submit");
  
  // check for error
  $action = "edit";
  // module ID is required
  if ( isset($_REQUEST["moduleID"]) ) {
      $moduleID=$_REQUEST["moduleID"];
      $moduleInfo=getModuleByID($moduleID);        
  } else {
      $moduleInfo = FALSE;
  }
  if ( !isset($moduleInfo["moduleID"]) )
  {
    $action = "error";
    if ($moduleInfo=="NotImplemented") {
        $smarty->assign("alert", array("type"=>"negative", 
                "message"=>"Sorry, the backend does not support creating/editing modules.") );
    } else {
        $smarty->assign("alert", array("type"=>"negative", 
                "message"=>"Error retrieving specified module. 
                If this error persists, contact the collection manager.") );
    }            
  } else {
    if ($moduleInfo["status"] != "InProgress") {
      $action = "error";
      $smarty->assign("alert", array("type"=>"negative", 
              "message"=>"Error. Module must be in progress to be submitted.") );      
    }
  }  
  $smarty->assign("action", $action); 
  
  
  // 'hasPermission' determines whether the user has permission to perform this action
  $hasPermission = false;
  if ( isset($userInformation) ) {
    $type = $userInformation["type"];
    // user must be logged in and have sufficient privileges
    if ($type=="Submitter" || $type=="Editor" || $type=="Admin") {
        // if edit or createNewVersion, check to make sure user owns module or user
        // is editor or admin (who can edit all modules)
        if ( $type!="Submitter" || ($type=="Submitter" 
            && isset($moduleInfo["submitterUserID"]) 
            && $moduleInfo["submitterUserID"]==$userInformation["userID"] ) )
        {
            $hasPermission = true;
        } elseif ($action != "error") {
            $smarty->assign("alert", array("type"=>"negative", 
                "message"=>"Sorry, you don't have permission to edit this module!") );
        }
    } else {
        $smarty->assign("alert", array("type"=>"negative", 
                "message"=>"Sorry, you don't have permissions to create/edit modules!") );
    }
  } else {
    $smarty->assign("alert", array("type"=>"negative", 
                "message"=>"Sorry, you must be logged in to create/edit modules!") );
  }
  $smarty->assign("hasPermission", $hasPermission);
  
  
  // if user has permission, and no error was found, continue
  if ($hasPermission == true && $action != "error")
  {
    $smarty->assign("moduleInfo", $moduleInfo);
    $smarty->assign("pageName", "Module Wizard - Submit \"".$moduleInfo["title"]."\""); 
    
    // user clicked on the submit button to save
    if ( isset($_REQUEST["submit"]) ) {
      // execute submit function
	  $type = $userInformation["type"];  
	  $approval = NEW_MODULES_REQUIRE_MODERATION($type);  
	  if (submitModule($_REQUEST, $userInformation, $moduleInfo, $_REQUEST["moduleCheckInComments"], $approval) === TRUE) {
          $smarty->assign("submitSuccess", true);
          $smarty->assign("alert", array("type"=>"positive", 
              "message"=>"Module successfully submitted for moderation.") );
      } else { //This may crash after settings update 
          $smarty->assign("alert", array("type"=>"negative", 
              "message"=>"Unable to submit module.") );
      }
      
      // refresh module information
      $moduleInfo=getModuleByID($moduleID);
      
      // after saving, continue editing
      $smarty->assign("action", "edit");
      $smarty->assign("moduleInfo", $moduleInfo);
    }
  }
  
  $smarty->display('moduleWizard/submit.php.tpl');                  
?>
