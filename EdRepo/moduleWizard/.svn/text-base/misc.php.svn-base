<?php session_start();
/****************************************************************************************************************************
    moduleWizard/misc.php - main page for managing a module's miscellaneous fields
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
  
  $smarty->assign("pageName", "Module Wizard - Misc");
  
  $smarty->assign("alert", array("type"=>"", "message"=>"") );
                  // default empty alert message (type can be either positive or negative)
  
  // define section of module wizard
  $smarty->assign("section", "Misc");
  
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
    $smarty->assign("pageName", "Module Wizard - Editing \"".$moduleInfo["title"]."\""); 
    
    // user clicked on the submit button to save
    if ( isset($_REQUEST["submit"]) ) {
      // exectue save function
      if (saveAllPossible($_REQUEST, $userInformation, $moduleInfo)===TRUE) {
          $smarty->assign("alert", array("type"=>"positive", 
              "message"=>"Module saved.") );
      } else {
          $smarty->assign("alert", array("type"=>"negative", 
              "message"=>"Unable to save module progress.") );
      }
      
      // refresh module information
      $moduleInfo=getModuleByID($moduleID);
      
      // after saving, continue editing
      $smarty->assign("action", "edit");
      $smarty->assign("moduleInfo", $moduleInfo);
    }
  }
  
  $smarty->display('moduleWizard/misc.php.tpl');                  
?>
