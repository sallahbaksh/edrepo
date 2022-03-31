<?php session_start();
/****************************************************************************************************************************
 *    delete.php - Deletes a module currently being edited.
 *    --------------------------------------------------------------------------------------
 *  Deletes a module which a user is editing but which has not yet been added to the collection.  Provides a way to cancel
 *  the module submission wizard and not save the module progress.
 *
 *  Version: 1.0
 *  Author: Ethan Greer
 *  Modified by: Jon Thompson (6/24/2011 - implemented Smarty/new interface)
 *
 *  Notes: - This is only intended to delete modules not yet active or pending moderation in the collection.
 *         - Takes the following GET or POST parameters:
 *           action : The action to take.
 *           moduleID : The ID of the module to delete.
 *           forceDelete : If set to "true", than administrators and editors will be able to delete any module, regardless
 *                    of the module's status or owner. (NO LONGER USED)
 ******************************************************************************************************************************/
  
  require("../lib/config.php");

  $smarty->assign("title", $COLLECTION_NAME . " - Delete Module");
    // title of this page. For most pages: &COLLECTION . " - Title" , default: $COLLECTION_NAME
  $smarty->assign("tab", "modules"); // active nav tab. default:  "home"
  $smarty->assign("baseDir", getBaseDir() ); // should always be getBaseDir() 
  
  $smarty->assign("pageName", "Delete Module");
  
  $smarty->assign("alert", array("type"=>"", "message"=>"") );
                  // default empty alert message (type can be either positive or negative)
                  
                  
  $action = "error";
  if ( isset($_REQUEST["moduleID"]) ) {
      $moduleID=$_REQUEST["moduleID"];
      $moduleInfo=getModuleByID($moduleID);        
  } else {
      $moduleInfo = FALSE;
  }
  // if action and module info aren't valid, throw error; else, get the action
  if ( !isset($_REQUEST["action"]) || $moduleInfo == FALSE || $moduleInfo == "NotImplemented" ) {
    $smarty->assign("alert", array("type"=>"negative", "message"=>"Not enough valid information to continue.") );
    $action = "error";
  } else {
    $action = $_REQUEST["action"];
  }
  $smarty->assign("action", $action);
  $smarty->assign("moduleInfo", $moduleInfo); 
  
  // 'hasPermission' determines whether the user has permission to perform this action
  $hasPermission = false;
  if ($action != "error") {
      if ( isset($userInformation) ) {
        $type = $userInformation["type"];
        if ($type=="Submitter" || $type=="Editor" || $type=="Admin") { // if user has enough rights
            // if user owns this module, or is an editor/admin who can edit all modules
            if ( $moduleInfo["submitterUserID"]==$userInformation["userID"] || ($type=="Editor" || $type=="Admin") )
            {
                $hasPermission = true;  
            } elseif ($action != "error") {
                $smarty->assign("alert", array("type"=>"negative", 
                    "message"=>"Sorry, you don't have permission to delete this module!") );
            }
        } else {
            $smarty->assign("alert", array("type"=>"negative", 
                    "message"=>"Sorry, you don't have permissions to create/edit modules!") );
        }
      } else {
        $smarty->assign("alert", array("type"=>"negative", 
                    "message"=>"Sorry, you must be logged in to create/edit modules!") );
      }
      // if backend doesn't support deleting, deny permission
      if(!in_array("UseModules", $backendCapabilities["write"])) {
        $hasPermission = false;
        $smarty->assign("alert", array("type"=>"negative", 
                    "message"=>"Unable to delete module.  The back-end in use does not support writing modules.") );
      }
  }
  $smarty->assign("hasPermission", $hasPermission);
  
  // if user has permission, and no error was found, continue
if($hasPermission==TRUE && $action!="error") {
    
    echo('Got to delete.php'); 


    if($action=="doDelete") {
        /* Deleting a module involves removing all topics, categories, types, prereqs, and objectives, and materials attached to the module, and 
           then removing the module.  Don't remove materials which are also used by other modules, however. */
        $materials=getAllMaterialsAttatchedToModule($moduleInfo["moduleID"]); //Get a list of all materials owned by this module.
        $results=array();
        $results[]=setModulePrereqs($moduleInfo["moduleID"], array()); //Remove all prereqs for the module.
        $results[]=setModuleTopics($moduleInfo["moduleID"], array()); //Remove all topics for the module.
        $results[]=setModuleObjectives($moduleInfo["moduleID"], array()); //Remove all objectives for the module.
        $results[]=setModuleAuthors($moduleInfo["moduleID"], array()); //Remove all authors from the module.
        if(in_array("UseCategories", $backendCapabilities["write"])) { //Does the back-end support writing categories?
          $results[]=setModuleCategories($moduleInfo["moduleID"], array()); //Remove all categories from the module.
        }
        if(in_array("UseTypes", $backendCapabilities["write"])) { //Does the back-end support writing types?
          $results[]=setModuleTypes($moduleInfo["moduleID"], array()); //Remove all types from the module.
        }
        for($i=0; $i<count($materials); $i++) { //Scan all materials attatched to the module.  If they are not attatched to any other modules, delete them.
          $results[]=deattatchMaterialFromModule($materials[$i], $moduleInfo["moduleID"]);
          if(count(getAllModulesAttatchedToMaterial($materials[$i])<=1)) { //If one or fewer modules are attatched to the material, than the material must not be attached to any other modules.  Delete it.
            $result=removeMaterialsByID(array($materials[$i]), '..'.$MATERIAL_STORAGE_DIR);
          }
        }
        
        // remove all parent-child relationships involving this module
        $parents = getParents($moduleInfo["moduleID"]);
        foreach($parents as $parent) {
          $results[]=removeParentChild($parent, $moduleInfo["moduleID"]);
        }
        $children = getChildren($moduleInfo["moduleID"]);
        foreach($children as $child) {
          $results[]=removeParentChild($moduleInfo["moduleID"], $child);
        }
        
        $results[]=removeModulesByID(array($moduleInfo["moduleID"]));
        if ( !in_array(FALSE, $results) ) {
          $smarty->assign("alert", array("type"=>"positive", 
                "message"=>"Module Deleted.") );
        } else { //This else block runs if an error was encountered
          $smarty->assign("alert", array("type"=>"negative", 
                "message"=>"Error. Unable to delete this module.") );
        }
    }
}      
        
  $smarty->display("moduleWizard/delete.php.tpl");
  
  ?>