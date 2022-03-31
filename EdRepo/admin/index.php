<?php session_start();
/****************************************************************************************************************************
 *    admin/index.php - The home page for the admin section
 *    --------------------------------------------------------------------------------------
 *    If logged in as an admin, lists all admin functions
 *
 *  Version: 1.0
 *  Author: Jon Thompson 
 *
 *  Notes: Uses Smarty's static.tpl template
 ******************************************************************************************************************************/
  
  require("../lib/config.php");

  $smarty->assign("title", $COLLECTION_NAME . " - Admin");
    // title of this page. For most pages: &COLLECTION . " - Title" , default: $COLLECTION_NAME
  $smarty->assign("tab", "admin"); // active nav tab. default:  "home"
  $smarty->assign("baseDir", getBaseDir() ); // should always be getBaseDir() 
  
  $smarty->assign("pageName", "Admin");
  
  $smarty->assign("alert", array("type"=>"", "message"=>"") );
                  // default empty alert message (type can be either positive or negative)
  
  $content = '<fieldset style="float: left;">
        <legend>Collection</legend>
        <ul>
            <li><a href="configureCollection.php">Collection Settings</a></li>
            <li><a href="configureCategories.php">Manage Categories</a></li>
            <li><a href="configureTypes.php">Manage Types</a></li>
            <li><a href="configureHierarchy.php">Manage Hierarchy</a></li>

            <li><a href="editStaticPages.php">Edit Static Pages</a></li>
            <li><a href="../oaiProvider/index.php">Harvest with OAI-PMH</a></li>
        </ul>
    </fieldset>
    
    <fieldset style="float: left;">
        <legend>Design</legend>
        <ul>
            <li><a href="configureHeader.php">Configure Header</a></li>

            <li><a href="configureFooter.php">Configure Footer</a></li>
        </ul>
    </fieldset>
    
    <fieldset style="float: left;">
        <legend>User Management</legend>
        <ul>
            <li><a href="userManagement.php">User Management</a></li>

        </ul>
    </fieldset>
    
    <hr style="clear: both; color: #eee; border: 0;" />';
  
  $smarty->assign("content", $content);
  
  $smarty->display('admin.tpl');

?>
      