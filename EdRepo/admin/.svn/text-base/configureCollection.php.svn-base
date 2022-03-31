<?php session_start();
/****************************************************************************************************************************
 *    configureHeader.php - Allows editing of collection settings.
 *    ---------------------------------------------------------------------------------------------------------
 *  
 *
 *  Version: 1.0
 *  Author: Jon Thompson 
 *
 *  Notes: - Only Admins may use this page.
 *         - This page uses the following GET/POST parameters:
 *            action : One of "displayEdit" (default) which will display the specified static content for editing.
 *                            "doEdit" will attempt to save the edited progress.
 *            page : The page of static HTML to edit.  This parameter should be the name of a file in the lib/staticContent
 *              directory and must be recognized by this page (see the inilitilzing code).
 ******************************************************************************************************************************/
  
  require("../lib/config.php");

  $smarty->assign("title", $COLLECTION_NAME . " - Admin - Configure Collection");
    // title of this page. For most pages: &COLLECTION . " - Title" , default: $COLLECTION_NAME
  $smarty->assign("tab", "admin"); // active nav tab. default:  "home"
  $smarty->assign("baseDir", getBaseDir() ); // should always be getBaseDir() 
  
  $smarty->assign("pageName", "Admin - Configure Collection");
  
  $smarty->assign("alert", array("type"=>"", "message"=>"") );
  
  $smarty->assign("SHOW_REPOSITORY_TREE", $SHOW_REPOSITORY_TREE);
  $smarty->assign("REPOSITORY_TREE_LEVELS", $REPOSITORY_TREE_LEVELS);
  
  /* To prevent against people abusing this page to edit (or possibly create) any page in the lib/staticContent subdirectory, we'll check to make 
    sure the page given in the $_REQUEST["page"] parameter is a valid page we can edit.  This means you MUST add all pages which can be edited here!
    If the page given isn't found here, or nothing ws given, $pagename will be left as FALSE, indicating no valid page was found.  Otheriwse, 
    $pagename will be set to a friendly, human-readable name for the page. */
  $pagename="Collection"; //By default a valid page wasn't given.
  $file="config.php";
  
  
  if ( isset($_REQUEST["alert"]) ) {
    $alert = $_REQUEST["alert"];
    
    if ($alert == "success") {
      $smarty->assign("alert", array("type"=>"positive", "message"=>"Successfully updated ".$pagename.".") );
    }
  }
  
  $action="displayEdit"; //Default action is to display an editing panel.
  if(isset($_REQUEST["action"])) {
    $action=$_REQUEST["action"];
  }
  $smarty->assign("action", $action);


if (isset($userInformation) && $userInformation["type"]=="Admin") { //This else block is if we're logged in as an admin.

  if($action=="displayEdit") {
      
  } elseif($action=="doEdit" && $pagename!==FALSE) { //If the action is doEdit and a valid pagename and some content was passed, try to update the page.    
    $COLLECTION_NAME = isset($_REQUEST['name']) ? $_REQUEST['name'] : 'EdRepo';
    $COLLECTION_SHORTNAME = shortName($COLLECTION_NAME);

    $changesSaved = saveConfig();
    
    if ($changesSaved) {
      // reload page with a success message
      // reload is needed to load the changed values
      header('Location: configureCollection.php?alert=success');
    } else {
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Error saving changes.") );
    }
  } else { //Unknown/unhandled action specified.
    $smarty->assign("alert", array("type"=>"negative", "message"=>"Unknown or Unhandled Action Specified</h1>") );
  }
}
  
$smarty->display('configureCollection.php.tpl'); 

?>