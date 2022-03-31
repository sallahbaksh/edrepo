<?php session_start();
/****************************************************************************************************************************
 *    install.php - The installation page for Edrepo
 *    --------------------------------------------------------------------------------------
 *  Collects variables to send to the config file. Sets up the default MySQL backend.
 *
 *  Version: 1.0
 *  Author: Ben Kos (from general format by Jon Thompson)
 *  Date: 23 June 2011
 *
 *  Notes: Only needs to be run when the user is first setting everything up.
 ******************************************************************************************************************************/
 
  require("lib/backends/pdo/datamanager.php"); 
  require("lib/smarty/smarty.php");
  require("lib/look/look.php");
  require("lib/config/config.php");
  require("lib/config/header.php");
  require("lib/config/footer.php");
  require("lib/model/utility.php");
  // assign the collection name to Smarty
  $smarty->assign("COLLECTION_NAME", $COLLECTION_NAME);


  // assign the active "look" directory to Smarty
  $smarty->assign("LOOK_DIR", $LOOK_DIR);
  $smarty->assign("loggedIn", false);
  // assign array of header config settings to Smarty
  $smarty->assign("HEADER", $HEADER );
  // assign array of footer config settings to Smarty
  $smarty->assign("FOOTER", $FOOTER );
 
 $smarty->assign("title", "Edrepo Installation"); // Sets title to "Edrepo Installation."
 $smarty->assign("pageName", "Installation");
 $smarty->assign("tab", "home"); // Sets up tab interface.
 $smarty->assign("baseDir", getBaseDir() ); // Needed for all files. 
 $smarty->assign("alert", array("type"=>"", "message"=>"") );
 
  // set default config values if they are not set
  if( !isset($COLLECTION_NAME) ) {
    $COLLECTION_NAME = 'EdRepo'; 
  }
  if( !isset($COLLECTION_BASE_URL) ) {
    $COLLECTION_BASE_URL = '/edrepo/'; 
  }
  if( !isset($MATERIAL_STORAGE_DIR) ) {
    $MATERIAL_STORAGE_DIR = '/materials/';
  }
  if( !isset($NEW_ACCOUNTS_REQUIRE_APPROVAL) ) {
    $NEW_ACCOUNTS_REQUIRE_APPROVAL = TRUE; 
  }
  if( !isset($NEW_ACCOUNTS_ACCOUNT_TYPE) ) {
    $NEW_ACCOUNTS_ACCOUNT_TYPE='Viewer'; 
  }
  if ( !isset($NEW_MODULES_REQUIRE_MODERATION) ) {
    $NEW_MODULES_REQUIRE_MODERATION='FALSE';
  }
  if ( !isset($ENABLE_VERSIONS) ) {
	   $ENABLE_VERSIONS='FALSE'; 
  }
  
  $serverName= $_SERVER['PHP_SELF']; 
  $baseName = baseName($_SERVER["PHP_SELF"]); 
  $collectionBaseURL = str_replace($baseName, "", $serverName); 
  $smarty->assign("collectionBaseURL", $collectionBaseURL); 

  $action="displayEdit"; //Default action is to display an editing panel.
  if(isset($_REQUEST["action"])) {
    $action=$_REQUEST["action"]; 
  }
  
  if (isset($_REQUEST["alert"]) && $_REQUEST["alert"] == "success") {
    $smarty->assign("alert", array("type"=>"positive", "message"=>"Successfully saved configuration.") );   
  }
  
  if($action=="displayEdit") { 
   
  }
       
  elseif($action=="doEdit") // Action changed to doedit once user hits submit button on form.
  { 
    // get config values from form
    $COLLECTION_NAME = $_REQUEST['collection_name'];
    $MATERIAL_STORAGE_DIR = $_REQUEST['material_storage_dir']; 
    $NEW_ACCOUNTS_REQUIRE_APPROVAL = isset($_REQUEST['new_accounts_require_approval']);
    $NEW_ACCOUNTS_ACCOUNT_TYPE = $_REQUEST['new_accounts_account_type'];
    $NEW_MODULES_REQUIRE_MODERATION = isset($_REQUEST['new_modules_require_moderation']); 
	  $ENABLE_VERSIONS = isset($_REQUEST['enable_versions']); 
    if ($_REQUEST["baseURL"] == "on"){
      $COLLECTION_BASE_URL = $_REQUEST['collection_base_url'];  
    }
    else{
      $COLLECTION_BASE_URL = $_REQUEST['baseURL'];
    }

    //opens the settings file and changes the auto approve accounts array
    $file = 'lib/backends/pdo/settings.php';
    $autoApprove = ($_REQUEST['auto_approve_accounts']);
    $open = file_get_contents($file, 'w'); //Reads line by line from file 
    $openArray = explode("\n", $open);  
    $handle = fopen ($file, "w+"); //Erases all lines in files so new lines can be appended 
    fclose($handle);
    if (count($autoApprove) > 0){
      $autoAccounts = implode('", "', $autoApprove);
    }
    else {
      $autoAccounts = "";
    }
    $openArray[19] = '$AUTO_APPROVE_MODULES_TYPE = array('."\"$autoAccounts\"".');';
    file_put_contents($file, implode("\n",$openArray), FILE_APPEND); //Append the new lines to the file 


    $changesSaved = saveConfig();

    if ($changesSaved) {	
      header('Location: install.php?alert=success');
    } else {
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Error saving changes.") );
    }
    
  } elseif($action=="manualInstall") {
	if (saveConfig()) { 
      header("Location: index.php", TRUE);
    } else {
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Error saving changes.") );
    } 
  } else { 

  } // Action not displayedit or doedit 
  
  //Initializing variables for the functions below 
  $allUserTypesAndGroups=getTypeAndGroupFromUser(); 
  $userTypes = reset($allUserTypesAndGroups[0]);
  $removeTypes = array("Disabled", "Pending", "Deleted");   //Types that cannot be set as defaults 
  $iterator = 0; 
  //If statements fixes a bug where options would not show up if array did not have value but was not empty....ex: array=(""); 
  if ($AUTO_APPROVE_MODULES_TYPE[0] == "") {
	 $currentAutoApproveTypes = array(); 
  }
  else {
	 $currentAutoApproveTypes = $AUTO_APPROVE_MODULES_TYPE;    //Used to get the selected ones 
  }
  
  //Functions cannot be split because both iterators would have to equal a different number to stop the recursion...therefore you can 
  //combine the variables with the call to the functino but thats about it....explain this in the comments 
  
  /* findAllUserTypes($newUserTypes, $removeTypes, $iterator)
  *	@params - $newUserTypes - an array of user types (Currently: this uses a varaiable that is set to a function, that function is pre-set in another file)
			- $removeTypes - an array of user types that are not meant to be defaults and should be removed from check box
			- $iterator - should always start at 0 and compares to the count of $removeTypes as a base case 
  *	@returns - $newUserTypes - array of user types without the values from $removeTypes in it
  */
  function findAllUserTypes($newUserTypes, $removeTypes, $iterator){	//This function is needed for the second one 
	if ($iterator == count($removeTypes)){
		return $newUserTypes;
	}
	else {
		$newUserTypes = preg_grep("/$removeTypes[$iterator]/", $newUserTypes, PREG_GREP_INVERT);
		return findAllUserTypes($newUserTypes, $removeTypes, $iterator+=1); 
	}
  }
   /* configureArray($newAccountTypeTPL, $selectedTypes, $iterator)
  *	@params - $newAccountTypeTPL - an array of total default user types (can be taken from findAllUserTypes function)
			- $selectedTypes - an array of user types that are set to autoApprove to be shown as selected on installation page 
			- $iterator - should always start at 0 and compares to the count of $selectedTypes as a base case 
  *	@returns - $newAccountTypeTPL - array of default user types without the values from $selectedTypes in it
  */
  function configureArray($newAccountTypeTPL, $selectedTypes, $iterator){
	if ($iterator == count($selectedTypes)){
		return $newAccountTypeTPL; 
	}
	else {
		$newAccountTypeTPL = preg_grep("/$selectedTypes[$iterator]/", $newAccountTypeTPL, PREG_GREP_INVERT);
		return configureArray($newAccountTypeTPL, $selectedTypes, $iterator+=1); 
	}
  }
  $totalTypes = findAllUserTypes($userTypes, $removeTypes, $iterator);
  $unSelectedTypes = configureArray($totalTypes, $currentAutoApproveTypes, $iterator); 

  $smarty->assign('accountType', $unSelectedTypes);
  $smarty->assign('selectedTypes', $currentAutoApproveTypes);   
  $smarty->assign('COLLECTION_NAME', $COLLECTION_NAME) ;
  $smarty->assign('COLLECTION_BASE_URL', $COLLECTION_BASE_URL) ;
  $smarty->assign('MATERIAL_STORAGE_DIR', $MATERIAL_STORAGE_DIR) ;
  $smarty->assign('NEW_ACCOUNTS_REQUIRE_APPROVAL',$NEW_ACCOUNTS_REQUIRE_APPROVAL) ;
  $smarty->assign('NEW_ACCOUNTS_ACCOUNT_TYPE', $NEW_ACCOUNTS_ACCOUNT_TYPE) ;
  $smarty->assign('NEW_MODULES_REQUIRE_MODERATION', $NEW_MODULES_REQUIRE_MODERATION) ;
  $smarty->assign('ENABLE_VERSIONS', $ENABLE_VERSIONS); 

$smarty->display("install.php.tpl"); // Access Install template
?>