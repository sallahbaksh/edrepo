<?php session_start();
/****************************************************************************************************************************
 *    configureHierarchy.php - Manage which modules appear in the collection's main hierarchy
 *    ---------------------------------------------------------------------------------------------------------
 *
 *  Version: 1.0
 *  Author:  Jon Thompson
 * 
 *  Notes: - Only Admins may use this page.
 *         - This page uses the following GET/POST parameters:
 *            action :  "display" (default) : currently does nothing additional because this page always displays
 *                                                     all categories, with links to remove a category/add a new one, 
 *                        "changeSettings" : change general hierarchy settings (e.g. name)
 *                        "addModule" : add module to hierarchy
 *                        "removeModule" : remove module from hierarchy.
 *            moduleID : module to add or remove, accordingly
 *            repositoryTreeName : display name of collection's main hierarchy (used with "changeSettings")
 ******************************************************************************************************************************/
  
require("../lib/config.php");

$smarty->assign("title", $COLLECTION_NAME . " - Admin - Configure Collection Hierarchy");
$smarty->assign("tab", "admin");
$smarty->assign("baseDir", getBaseDir() ); // should always be getBaseDir() 

$smarty->assign("pageName", "Admin - Configure Collection Hierarchy");

$smarty->assign("alert", array("type"=>"", "message"=>"") );

//if logged in as admin
if (isset($userInformation) && $userInformation["type"] == "Admin") {
  $action="display"; //Default action is to display 
  if(isset($_REQUEST["action"])) {
    $action=$_REQUEST["action"];
  }
  $smarty->assign("action", $action);

  switch ($action) {
  case "display":
    // Do nothing additional. Main page will display no matter what action is specified
    break;
    
    
  case "changeSettings":
    if ( !isset($_REQUEST['repositoryTreeName']) || !isset($_REQUEST['navTreeLevels']) ) {
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Missing required data to save changes.") );
      break;
    }
    
    $REPOSITORY_TREE_NAME = $_REQUEST['repositoryTreeName'];
    $SHOW_REPOSITORY_TREE = isset($_REQUEST['navTree']);
    $REPOSITORY_TREE_LEVELS = $_REQUEST['navTreeLevels'];
    
    $changesSaved = saveConfig();
    
    if ($changesSaved) {
      $smarty->assign("alert", array("type"=>"positive", "message"=>"Changes successfully saved.") );
    } else {
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Error saving changes.") );
    }
    break;
    
    
  case "addModule":
    if (!isset($_REQUEST["moduleID"])) {
      $smarty->assign("alert", array("type"=>"negative", "message"=>"No module was specified to add.") );
      break;
    }
    $moduleAdded = addHierarchyModule($_REQUEST["moduleID"]);
    if (!$moduleAdded) {
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Error adding specified module to the hierarchy.") );
    }
    break;
    
    
  case "removeModule":
    if (!isset($_REQUEST["moduleID"])) {
      $smarty->assign("alert", array("type"=>"negative", "message"=>"No module was specified to remove.") );
      break;
    }
    
    $moduleRemoved = removeHierarchyModule($_REQUEST["moduleID"]);
    
    if (!$moduleRemoved) {
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Error removing specified module from the hierarchy.") );
    }
    break;
	
	
  case "reOrder":
	$table = "hierarchymodule"; 
	$rawString = $_REQUEST["order"];

  if (!empty($rawString)){
  	$orderStatus = reOrders($table, $rawString, $moduleID); 
  	if($orderStatus) {
  		$smarty->assign("alert", array("type"=>"positive", "message"=>"Module order was saved.") ); 
  	}	
  	else {
  		$smarty->assign("alert", array("type"=>"negative", "message"=>"Module order failed to save.") ); 
  	}
  }
  else
  {
    $smarty->assign("alert", array("type"=>"positive", "message"=>"Module order was saved. No changes were made.") ); 
  }
    break; 
	
	
  default:
    $smarty->assign("alert", array("type"=>"negative", "message"=>"Unknown action specified.") );
  }

  $activeModules = searchModules(array("status"=>"Active"));

  
  $hierarchyModules = getHierarchyModules();
  
  $smarty->assign("hierarchyModules", $hierarchyModules);
  
  
  // eligibleModules = all activeModules minus those modules in the hierarchy already
  $eligibleModules = diffSet($activeModules, $hierarchyModules, "moduleID");
  
  $smarty->assign("eligibleModules", $eligibleModules);
  
  
  // assign needed configuration values
  $smarty->assign("REPOSITORY_TREE_NAME", $REPOSITORY_TREE_NAME);
  $smarty->assign("SHOW_REPOSITORY_TREE", $SHOW_REPOSITORY_TREE);
  $smarty->assign("REPOSITORY_TREE_LEVELS", $REPOSITORY_TREE_LEVELS);
  
} // end if logged in as admin


$smarty->display('configureHierarchy.php.tpl');

?>