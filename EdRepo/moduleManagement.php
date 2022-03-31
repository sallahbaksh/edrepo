<?php session_start();
/****************************************************************************************************************************
 *    moduleManagement.php - Displays and manages modules.
 *    -----------------------------------------------------
 *  Displays an optionally filtered list of modules in the system, and allows the user to perform basic management of modules
 *  in addition to editing them.
 *
 *  Version: 1.0
 *  Author: Ethan Greer
 *  Modified by: Jon Thompson (7/28/2011 - Implemented new interface/Smarty)
 *
 *  Notes: - Only Editors and Admins may use this page.
 ******************************************************************************************************************************/
  
  require("lib/backends/validate.php"); 
  require("lib/config.php");

  $smarty->assign("title", $COLLECTION_NAME . ' - Module Management');
    // title of this page. For most pages: &COLLECTION . " - Title" , default: $COLLECTION_NAME
  $smarty->assign("tab", "moderate"); // active nav tab. default:  "home"
  $smarty->assign("baseDir", getBaseDir() ); // should always be getBaseDir() 
  
  $smarty->assign("pageName", "Module Management");
    // name of page to placed in <h1> tag
  
  $page=1; //The "page" we are on (default, 1 (first)
  $recordsPerPage=15; //The number of records to display per page (default, 15)
  if(isset($_REQUEST["page"])) {
    $page=$_REQUEST["page"];
  }
  if(isset($_REQUEST["recordsPerPage"])) {
    $recordsPerPage=$_REQUEST["recordsPerPage"];
  }
  $smarty->assign("recordsPerPage", $recordsPerPage);
  
  $action="display";
  $wasFiltered=FALSE; //This determines if the modules fetched were filtered or not, for a nicer display if nothing was found.
  if(isset($_REQUEST["action"])) {
    $action=$_REQUEST["action"];
  }
  $smarty->assign("action", $action);
  
  if(isset($userInformation)) { 
    $loggedIn = true;
    if ($userInformation["type"]=="Editor" || $userInformation["type"]=="Admin") {
      $hasPermission = true;
    } else {
      $hasPermission = false;
    }
    //Only do any filtering/etc. if we're logged in,
    if($action=="filter" && isset($_REQUEST["filterText"])) { //If we are suppose to filter the results, do so here (but only if we have enough information to filter with).
	  $modules=searchModules(array("status"=>"Active", "title"=>$_REQUEST["filterText"]));
      $wasFiltered=TRUE;
      $action="display"; //Tell future parts of the program to display what we just got.
    } else { //No filter was specified, so build a list of all modules owned by this user.
      $modules=searchModules(array("status"=>"Active")); //Get a list of all modules .
      $action="display"; //Tell future parts of the program to display what we just got.
    }
  } else {
    $loggedIn = false;
    $hasPermission = false;
  }
  
  if (in_array("UseModules", $backendCapabilities["read"]) && in_array("SearchModulesByUserID", $backendCapabilities["read"]) ) {
    $backendCapable = true;
  } else {
    $backendCapable = false;
  }
  
  $smarty->assign("loggedIn", $loggedIn);
  $smarty->assign("backendCapable", $backendCapable);
  $smarty->assign("wasFiltered", $wasFiltered);
  $smarty->assign("hasPermission", $hasPermission);

  
  if ($hasPermission && $backendCapable) {
    if($action=="display") {
      //We'll use the $modules list of modules to display built earlier
      $smarty->assign("modules", $modules);
      
      $lowerLimit=$recordsPerPage*($page-1); //The lowest index in the $records array which will be printed (based on $page and $recordsPerPage
      $upperLimit=$lowerLimit+$recordsPerPage; //The highest index in the $records array which will be printed (based on $page and $recordsPePage
      /* It is possible that records were found but the page/recordsPerPage combination is beyond the number of records (meaning no records would be displayed).  If this is true,
        decrease the page until it is small enough to show some results. */
      while(count($modules)<$lowerLimit) {
        $page=$page-1;
        $lowerLimit=$recordsPerPage*($page-1); //Calculate new lowerLimit based on new page.
        $upperLimit=$lowerLimit+$recordsPerPage; //Calculate new upperLimit based on new page.
      }
      
      $smarty->assign("page", $page);
      $smarty->assign("lowerLimit", $lowerLimit);
      $smarty->assign("upperLimit", $upperLimit);
      
      // Calculate number of pages needed by dividing Number of records by Records per page and rounding up with ceil()
      $numPages = ceil(count($modules)/$recordsPerPage); 
      $smarty->assign("numPages", $numPages);
    }
  }
        
  $smarty->display("moduleManagement.php.tpl");
?>
      