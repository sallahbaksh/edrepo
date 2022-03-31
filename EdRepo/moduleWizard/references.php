<?php session_start();
/****************************************************************************************************************************
    moduleWizard/references.php - main page for managing a module's references
    --------------------------------------------------------------------------------------
    Main method for a user to add/remove references for a module.
 
  Version: 1.0
  Author: Jon Thompson 
  Date: 27 Mar 2012
 
  Notes: Takes several key REQUEST variables (sent by the form/URL) :             
              - moduleID : ID of module to edit or create new version of; sent by URL or form
              
             Functions:
              - refreshFields($smarty, $moduleID) - Sends fields with multiple values (e.g. objectives, topics) to Smarty 
 ******************************************************************************************************************************/
  
  require("../lib/config.php");

  $smarty->assign("title", $COLLECTION_NAME . " - Module Wizard");
    // title of this page. For most pages: &COLLECTION . " - Title" , default: $COLLECTION_NAME
  $smarty->assign("tab", "modules"); // active nav tab. default:  "home"
  $smarty->assign("baseDir", getBaseDir() ); // should always be getBaseDir() 
  
  $smarty->assign("pageName", "Module Wizard - References");
  
  $smarty->assign("alert", array("type"=>"", "message"=>"") );
                  // default empty alert message (type can be either positive or negative)
                  
  // send all of the collection's available categories to Smarty                
  $smarty->assign("allCategories", getAllCategories() );
  // send all of the collection's available types to Smarty                
  $smarty->assign("allTypes", getAllTypes() );
  
  // define section of module wizard
  $smarty->assign("section", "References");

  $smarty->assign("delIRefModules", $delIRefModules); 
  $smarty->assign("delERefModules", $delERefModules); 
  
/**
    refreshFields($smarty, $moduleID)
    Sends fields with multiple values (e.g. objectives, topics) 
    to Smarty template in respective arrays.
     @param  $smarty  Smarty object variable (will always be $smarty)
     @param  $moduleID  ID of the module whose field to refresh
*/
  function refreshFields($smarty, $moduleID) {
    global $backendCapabilities; // get the global variable $backendCapabilities
        
    $savedAuthors=getModuleAuthors($moduleID);
    for($i=0; $i<count($savedAuthors); $i++) {
        $savedAuthors[$i] = $safeJSString=preg_replace('/"/', '\"', $savedAuthors[$i]);
    }
    $smarty->assign("savedAuthors", $savedAuthors);
    
    $savedObjectives=getModuleObjectives($moduleID);
    for($i=0; $i<count($savedObjectives); $i++) {
        $savedObjectives[$i] = $safeJSString=preg_replace('/"/', '\"', $savedObjectives[$i]["text"]);
    }
    $smarty->assign("savedObjectives", $savedObjectives);
    
    $savedTopics=getModuleTopics($moduleID);
    for($i=0; $i<count($savedTopics); $i++) {
        $savedTopics[$i] = $safeJSString=preg_replace('/"/', '\"', $savedTopics[$i]["text"]);
    }
    $smarty->assign("savedTopics", $savedTopics);
    
    $savedPrereqs=getModulePrereqs($moduleID);
    for($i=0; $i<count($savedPrereqs); $i++) {
        $savedPrereqs[$i] = $safeJSString=preg_replace('/"/', '\"', $savedPrereqs[$i]["text"]);
    }
    $smarty->assign("savedPrereqs", $savedPrereqs);
            
    $savedCategories=getModuleCategoryIDs($moduleID);
    for($i=0; $i<count($savedCategories); $i++) {
        $category=getCategoryByID($savedCategories[$i]);
        $savedCategories[$i] = $category["ID"];
    }
    $smarty->assign("savedCategories", $savedCategories);
            
    $savedTypes=getModuleTypeIDs($moduleID);
    for($i=0; $i<count($savedTypes); $i++) {
        $type=getTypeByID($savedTypes[$i]);
        $savedTypes[$i] = $type["ID"];
    }
    $smarty->assign("savedTypes", $savedTypes);
    
    // Note that references have two values each that need to be sent 
    // (description and link). These are combined into one string, separated
    // by '$$$delim$$$' and our later separated by JavaScript code.
    
    if(in_array("CrossReferenceModulesInternal", $backendCapabilities["read"]) && in_array("CrossReferenceModulesInternal", $backendCapabilities["write"])) {
        $savedIReferences=getInternalReferences($moduleID);
        for($i=0; $i<count($savedIReferences); $i++) {
            $safeJSString1=preg_replace('/"/', '\"', $savedIReferences[$i]["description"]);            
            $safeJSString2=preg_replace('/"/', '\"', $savedIReferences[$i]["referencedModuleID"]);
            $savedIReferences[$i] = $safeJSString1 . '$$$delim$$$' . $safeJSString2;
        }
        $smarty->assign("savedIRefs", $savedIReferences);
    }
    if(in_array("CrossReferenceModulesExternal", $backendCapabilities["read"]) && in_array("CrossReferenceModulesExternal", $backendCapabilities["write"])) {
        $savedEReferences=getExternalReferences($moduleID);
        for($i=0; $i<count($savedEReferences); $i++) {
            $safeJSString1=preg_replace('/"/', '\"', $savedEReferences[$i]["description"]);
            $safeJSString2=preg_replace('/"/', '\"', $savedEReferences[$i]["link"]);
            $savedEReferences[$i] = $safeJSString1 . '$$$delim$$$' . $safeJSString2;
        }
        $smarty->assign("savedERefs", $savedEReferences);
    }    
  }
  
  
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
    refreshFields($smarty, $moduleInfo["moduleID"]);
    $smarty->assign("pageName", "Module Wizard - Editing \"".$moduleInfo["title"]."\""); 
    
    // user clicked on the submit button to save
    if ( isset($_REQUEST["submit"]) ) {
      // execute save function
	  
	  //Code between these lines allows the auto-complete to be clicked and entered so the the right modules are added with just the ID
	  //The outer if statements allow either ID/Title to be searched or both at the same time. 
		$request = $_REQUEST; 
		$splitID = array(); 
		$mergingArray = array(); 
		$i=0;

    $moduleIRefs = $request["moduleIRefs".$i];
    $moduleIRefsLink = $request["moduleIRefsLink".$i];

    $canSaveModules = true; 

		if((isset($request["moduleIRefs".$i]) && isset($request["moduleIRefsLink".$i])) && (!empty($moduleIRefs) && !empty($moduleIRefsLink))) {
			while(isset($request["moduleIRefs".$i]) && isset($request["moduleIRefsLink".$i])) {
				if (preg_match('/--- ID:/', $request["moduleIRefsLink".$i])){
					$field = $request["moduleIRefsLink".$i];
					$splitIDs = preg_split('/--- ID:/', $field, -1);
					$splitID = $splitIDs[1]; 
					$mergingArray += array("moduleIRefsLink".$i => $splitID); 
					$result = array_merge ($request, $mergingArray); 
					$i++;
				}
				else {
					$splitID = $request["moduleIRefsLink".$i]; 
					$mergingArray += array("moduleIRefsLink".$i => $splitID); 
					$result = array_merge ($request, $mergingArray); 
					$i++;	
				}
			}	
		}
    else{
      $canSaveModules = false; 
    }

	//*********************************End******************************	

      $iRefModulesToDelete = $_REQUEST["delIRefModules"]; 
      $eRefModulesToDelete = $_REQUEST["delERefModules"]; 

      //This is a temporary fix to get a version out
      //This should be intergrated with queryies as they are called from datamanager...which also needs to be fixed
      //since they do not allow custom queries like this one 
      //This block of code will take care of deleting references from modules on save 
      //////////////////Start what should be a function/////////////////
      if (!empty($iRefModulesToDelete))
      {
        $moduleValues = explode("&", $iRefModulesToDelete); 
        $conditions = ""; 
        $query = 'DELETE FROM seealso WHERE (ModuleID, ReferencedModuleID) IN (';
        for ($i = 0; $i < count($moduleValues); $i++){
          if (!empty($moduleValues[$i]))
          {
            if ($i == count($moduleValues) -1)
            {
              $query.="(".$moduleID.",".$moduleValues[$i].")"; 
            }
            else
            {
              $query.="(".$moduleID.",".$moduleValues[$i].")".","; 
            }
          }
        }
        $query.=");";

        $db = mysql_connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE); 
        $table = mysql_select_db($DB_DATABASE); 
        $result = mysql_query($query); 
        mysql_close($db); 
        $canSaveModules = true; 
      }
      else if (!empty($eRefModulesToDelete))
      {
        $moduleValues = explode("&", $eRefModulesToDelete); 
        $conditions = ""; 
        $query = 'DELETE FROM otherresources WHERE (ModuleID, ResourceLink) IN (';
        for ($i = 0; $i < count($moduleValues); $i++){
          if (!empty($moduleValues[$i]))
          {
            if ($i == count($moduleValues) -1)
            {
              $query.="(".$moduleID.",'".$moduleValues[$i]."')"; 
            }
            else
            {
              $query.="(".$moduleID.",'".$moduleValues[$i]."')".","; 
            }
          }
        }
        $query.=");";

        $db = mysql_connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE); 
        $table = mysql_select_db($DB_DATABASE); 
        $result = mysql_query($query); 
        mysql_close($db); 
        $canSaveModules = true; 
      }
      /////////////////////////////End what should be a function//////////////////////

      if (saveAllPossible($result, $userInformation, $moduleInfo)===TRUE && $canSaveModules == true) {
          $smarty->assign("alert", array("type"=>"positive", 
              "message"=>"Module saved.") );
      } 
      else if($canSaveModules == false){
        $smarty->assign("alert", array("type"=>"negative", 
              "message"=>"Could not add module(s) without all information.") );
      }
      else {
          $smarty->assign("alert", array("type"=>"negative", 
              "message"=>"Unable to save module progress.") );
      }
      
      // refresh module information
      $moduleInfo=getModuleByID($moduleID);
      
      // after saving, continue editing
      $smarty->assign("action", "edit");
      $smarty->assign("moduleInfo", $moduleInfo);
      refreshFields($smarty, $moduleInfo["moduleID"]);
    }
	else if ( isset($_REQUEST["submitOrder"])){
	  //Allows users to reOrder the references
	  $table = "seealso"; 
	  $rawString = $_REQUEST["order"];
	  $orderStatus = reOrders($table, $rawString, $moduleID);
	  if ($orderStatus) {
		$smarty->assign("alert", array("type"=>"positive", 
              "message"=>"Modules were ordered sucessfully.") );
	  }
	  else {
		$smarty->assign("alert", array("type"=>"negative", 
              "message"=>"Unable to save module order.") );
	  }
      
      // after saving, continue editing
      $smarty->assign("action", "edit");
      $smarty->assign("moduleInfo", $moduleInfo);
      refreshFields($smarty, $moduleInfo["moduleID"]);
	}
  }
  
/* autoSelectID() && autoSelectName() 
Note: The next two functions provide the auto-complete search from the database. The first function calls the second function so that users
cannot search the module they are in and can only get the module ID of the ones they have searched. autoSelectName() returns the array 
the is being used by the auto-complete jQuery, it also searches for the BaseID and Title from all module bases that are not the current one. 
autoSelectID() is the function they gets the ID from the BaseID found in autoSelectName(); 
	@returns the BaseID of the module 
*/
function autoSelectName() {
    $moduleID=$_REQUEST["moduleID"];
    $moduleInfo=getModuleByID($moduleID); 
	$baseID = $moduleInfo["baseID"]; 
	$arrayData = array(); 
	$trueData = array();  
	$table = 'modulebases'; 
	$conditions[] = "BaseID != '$baseID' "; 
	$arrayData = dataRead($table, $conditions); 
	$i = 0; 
	foreach($arrayData as $theData) {
		$thisBaseID = autoSelectID($theData["BaseID"]); 
		$temp = $theData["Title"]; 
		$trueData[$i] = $temp." --- ID:".$thisBaseID[0]; 
		$i++; 
	}
	return $trueData; 
	mysql_close($connect); 
}
//This function is called by the function above to give autocomplete ID's 
 function autoSelectID($baseID) {
	$arrayData = array(); 
	$trueData = array();  
	$table = 'module'; 
	$conditions[] = " BaseID = '$baseID' ";
	$arrayData = dataRead($table, $conditions); 
	$i = 0; 
	foreach($arrayData as $theData) {
		$trueData[$i] = $theData['ModuleID']; 
		$i++; 
	} 
	return $trueData; 
	mysql_close($connect); 
 }
  $auto = autoSelectName(); 
  $smarty->assign("auto", $auto); 

  $seeAlsoTable = array(); 
 /*----------------END--------------------*/
//This displays the references added. 
if(isset($_REQUEST["moduleID"])) {  
	$internalReferences = getInternalReferences($_REQUEST["moduleID"]);
    $seeAlso = array();
    foreach ($internalReferences as $reference) {
      $referencedModule = getModuleByID( $reference["referencedModuleID"] );
      // if valid reference
      if ($referencedModule["moduleID"] == $reference["referencedModuleID"] ) {
        array_push($seeAlsoTable, array("description"=>$reference["description"],
          "referencedModuleID"=>$reference["referencedModuleID"], 
          "title"=>$referencedModule["title"], "order"=> $reference["order"]) );
      }
    } 
}
  $smarty->assign("seeAlso", $seeAlsoTable);
  $smarty->assign("externalReferences", $externalReferences); 

  $smarty->display('moduleWizard/references.php.tpl');                  
?>
