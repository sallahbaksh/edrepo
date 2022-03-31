<?php session_start();
/****************************************************************************************************************************
 *    404.php - The page not found page
 *    --------------------------------------------------------------------------------------
 *   Page displayed for error 404 (page not found)
 *
 *  Version: 1.0
 *  Author: Jon Thompson
 *
 *  Notes: (none) 
 ******************************************************************************************************************************/
  
  require("lib/config.php");

  $smarty->assign("title", $COLLECTION_NAME . " - Page Not Found");
    // title of this page. For most pages: &COLLECTION . " - Title" , default: $COLLECTION_NAME
  $smarty->assign("tab", "home"); // active nav tab. default:  "home"
  $smarty->assign("baseDir", getBaseDir() ); // should always be getBaseDir() 
  
  $smarty->display('404.tpl');
  
?>
