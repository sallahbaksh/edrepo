<?php session_start();
/****************************************************************************************************************************
 *    index.php - The home page for the collection
 *    --------------------------------------------------------------------------------------
 *  A home page.  Responsible for displaying the user interface and anything in the body collection maintainers want.
 *
 *  Version: 1.0
 *  Author: Ethan Greer
 *
 * Modified: 2011-04-28 by Jon Thompson (implementing new interface)
 *
 *  Notes: (none) 
 ******************************************************************************************************************************/
  
  require("lib/backends/validate.php"); 
  require("lib/config.php");

  $smarty->assign("title", $COLLECTION_NAME);
    // title of this page. For most pages: &COLLECTION . " - Title" , default: $COLLECTION_NAME
  $smarty->assign("tab", "home"); // active nav tab. default:  "home"
  $smarty->assign("baseDir", getBaseDir() ); // should always be getBaseDir() 
  
  /* Instead of making users edit this HTML to put new content in it, we just display whatever the lib/staticContent/home.html file has in 
         it.  So, users who want to change this need to edit that file.  This also makes it easy to put a built-in editor in the system:  Just 
         make a page which can grabe lib/staticContent/home.html, allow users to edit the content, and save it back to that file. */
  $smarty->assign("content", file_get_contents("lib/staticContent/home.html") );
  
  $smarty->assign("SHOW_REPOSITORY_TREE", $SHOW_REPOSITORY_TREE);
  $smarty->assign("REPOSITORY_TREE_LEVELS", $REPOSITORY_TREE_LEVELS);
  
  //These lines of code accept an error code from install.php and viewMaterial.php
  if (count($_REQUEST) > 0){
    if (isset($_REQUEST["alert"]) && $_REQUEST["alert"] == "success") {
      $smarty->assign("alert", array("type"=>"positive", "message"=>"Successfully saved configuration.") );   
    }
    elseif(isset($_REQUEST["alert"]) && ($_REQUEST["alert"] == "errorNoID") || ($_REQUEST["alert"] == "errorNoMatch")){
      if($_REQUEST["alert"] == "errorNoID"){
        $message = "No materials were found because no ID was provided."; 
      }
      if($_REQUEST["alert"] == "errorNoMatch"){
        $message = "No materials were matched with the ID provided."; 
      }
      $smarty->assign("alert", array("type"=>"negative", "message"=>$message)); 
    }
  }
  if ($SHOW_REPOSITORY_TREE === TRUE) {
    $user = isset($userInformation) ? $userInformation : false;
    $smarty->assign("tree", getTreeHTML(REPOSITORY_ID, REPOSITORY_ID, $user));
  }
  
  if($INSTALL == FALSE) {
	header("Location: install.php"); 
  }
  
  $smarty->display('home.tpl');

?>
      