<?php session_start();
/****************************************************************************************************************************
 *    index.php - The home page for the OAI-PMH provider portion of the system
 *    ------------------------------------------------------------------------
 *  This page is nothing but an informational page giving basic instructions on how to harvest this collection with OAI-PMH..
 *
 *  Version: 1.0
 *  Author: Ethan Greer
 *  Modified: Jon Thompson (5/20/2011 converted to Smarty)
 *
 *  Notes: (none) 
 ******************************************************************************************************************************/
  
  require("../lib/config.php");

  $smarty->assign("title", $COLLECTION_NAME . ' - Admin - OAI-PMH');
    // title of this page. For most pages: &COLLECTION . " - Title" , default: $COLLECTION_NAME
  $smarty->assign("tab", "admin"); // active nav tab. default:  "home"
  $smarty->assign("baseDir", getBaseDir() ); // should always be getBaseDir() 
  
  $url = "http://".$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].dirname($_SERVER["SCRIPT_NAME"])."/provider.php";
    
  $content = "    <h1>Harvest with OAI-PMH</h1>
      <p>OAI-PMH is a protocol allowing you to easily collect all of the records stored in this collection, and is useful for integrating this 
        collection's content with other collections.</p>
      <p>This collection supports serving requests made in the OAI-PMH version 2 protocol and returns information in the Dublic Core prefix.</p>
      <p>To harvest this collection, point your harvester to the following URL:</p>
      <ul>
        <li><a href=\"$url\">$url</a></li>
      </ul>";
      
    /* Instead of making users edit this HTML to put new content in it, we just display whatever the lib/staticContent/home.html file has in 
         it.  So, users who want to change this need to edit that file.  This also makes it easy to put a built-in editor in the system:  Just 
         make a page which can grabe lib/staticContent/home.html, allow users to edit the content, and save it back to that file. */
  $smarty->assign("content", $content );
  
  $smarty->display('static.tpl');
  