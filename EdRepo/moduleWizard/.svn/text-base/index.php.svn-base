<?php session_start();
/****************************************************************************************************************************
    moduleWizard/basics.php - main page for handling creating/editing modules
    --------------------------------------------------------------------------------------
    Main method for a user to create, edit, or create new version of a module.
 
  Version: 1.0
  Author: Jon Thompson 
  Date: 6 June 2011
  Modified significantly: 27 Mar 2012
 
  Notes: Takes several key REQUEST variables (sent by the form/URL) :
              - moduleAction : dictates whether user is editing, creating, or creating new version; sent by URL (link) or by form
                                         (possible values: 'createNewVersion', 'edit', 'create' - default: 'create')             
              - moduleID : ID of module to edit or create new version of; sent by URL or form
              
             Functions:
              - refreshFields($smarty, $moduleID) - Sends fields with multiple values (e.g. objectives, topics) to Smarty 
 ******************************************************************************************************************************/
  
  require("../lib/config.php");
  require("../exportModules.php"); 

  $smarty->assign("title", $COLLECTION_NAME . " - Module Wizard");
    // title of this page. For most pages: &COLLECTION . " - Title" , default: $COLLECTION_NAME
  $smarty->assign("tab", "modules"); // active nav tab. default:  "home"
  $smarty->assign("baseDir", getBaseDir() ); // should always be getBaseDir() 
  
  $smarty->assign("pageName", "Module Wizard");
  
  $smarty->assign("alert", array("type"=>"", "message"=>"") );
                  // default empty alert message (type can be either positive or negative)
                  
  // send all of the collection's available categories to Smarty                
  $smarty->assign("allCategories", getAllCategories() );
  // send all of the collection's available types to Smarty                
  $smarty->assign("allTypes", getAllTypes() );
  
  // define section of module wizard
  $smarty->assign("section", "Basics");
  
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

  $moduleAction = "create";
  if ( isset($_REQUEST["moduleAction"]) ) {    
    if ( isset($_REQUEST["moduleID"]) ) {
        $moduleID=$_REQUEST["moduleID"];
        $moduleInfo=getModuleByID($moduleID);        
    } else {
        $moduleInfo = FALSE;
    }
    
    // check for valid module action, else throw error
    if ($_REQUEST["moduleAction"] == "create" || $_REQUEST["moduleAction"] == "createNewVersion" || 
        $_REQUEST["moduleAction"] == "edit" || $_REQUEST["moduleAction"] == "copy" || $_REQUEST["moduleAction"] == "export")	
    {
        $moduleAction = $_REQUEST["moduleAction"];
        // check if edit, copy, or createNewVersion came with no moduleID (which is necessary)
        if ( ($moduleAction=="edit" || $moduleAction=="createNewVersion" || $moduleAction=="copy")
              && !isset($moduleInfo["moduleID"]) )
        {
            $moduleAction = "error";
            if ($moduleInfo=="NotImplemented") {
                $smarty->assign("alert", array("type"=>"negative", 
                        "message"=>"Sorry, the backend does not support creating/editing modules.") );
            } else {
                $smarty->assign("alert", array("type"=>"negative", 
                        "message"=>"Error retrieving specified module. 
                        If this error persists, contact the collection manager.") );
            }            
        }
    } else {
      $moduleAction = "error";
      $smarty->assign("alert", array("type"=>"negative", 
                        "message"=>"Unknown action specified. 
                        Be sure to only use provided links to this page. 
                        If this error persists, contact the collection manager.") );
    }        
  }
  $smarty->assign("moduleAction", $moduleAction); 
  
  $smarty->assign("moduleID", $moduleID); 
  
  // 'hasPermission' determines whether the user has permission to perform this action
  $hasPermission = false;
  if ( isset($userInformation) ) {
    $type = $userInformation["type"];
    // user must be logged in and have sufficient privileges
    if ($type=="Submitter" || $type=="Editor" || $type=="Admin") {
        // if edit or createNewVersion, check to make sure user owns module or user
        // is editor or admin (who can edit all modules)
        if ( ($moduleAction == "createNewVersion" || $moduleAction == "edit" || $moduleAction == "copy" || $moduleAction == "export")
            && ( $type!="Submitter" || ($type=="Submitter" 
            && isset($moduleInfo["submitterUserID"]) 
            && $moduleInfo["submitterUserID"]==$userInformation["userID"] ) ) )
        {
            $hasPermission = true;
        } elseif ($moduleAction == "create") {
            $hasPermission = true; 
        } elseif ($moduleAction != "error") {
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
  if ($hasPermission == true && $moduleAction != "error")
  {
    // user clicked on the submit button to create new module or save
    if ( isset($_REQUEST["submit"]) ) {
        // first check to see if module needs to be created/create new version
        // if not, save changes to existing module
        if($moduleAction=="create") {
         
          // the following is mostly creation code from original EdRepo
            // Gets all enetered data, valid or not, and stores it.
          $resourceTitle = $_REQUEST["moduleTitle"];      // Required length 3
          $description=$_REQUEST["moduleDescription"];          // Must not be blank
          $language=$_REQUEST["moduleLanguage"]; 
          $educationLevel=$_REQUEST["moduleEducationLevel"]; 
          $minutes=$_REQUEST["moduleMinutes"];    // Optional
          $interactivityType=$_REQUEST["moduleInteractivityType"];
          $rights=$_REQUEST["moduleRights"];
		  $restrictions=$_REQUEST["restrictions"]; 
          
          $smarty->assign("moduleInfo", array("title"=>$resourceTitle, 
                                        "description"=>$description,  
                                        "language"=>$language,  
                                        "educationLevel"=>$educationLevel, 
                                        "minutes"=>$minutes,
                                        "interactivityType"=>$interactivityType,
                                        "rights"=>$rights,
										"restrictions"=>$restrictions)  );
          $i=0;
          $topics=array();
          if(isset($_REQUEST["moduleTopics".$i])) {
            while(isset($_REQUEST["moduleTopics".$i])) {
              $topics[]=$_REQUEST["moduleTopics".$i];
              $i++;
            }
          }
          $i=0;
          $objectives=array();
          if(isset($_REQUEST["moduleObjectives".$i])) {
            while(isset($_REQUEST["moduleObjectives".$i])) {
              $objectives[]=$_REQUEST["moduleObjectives".$i];
              $i++;
            }
          }
          $i=0;
          $prereqs=array();
          if(isset($_REQUEST["modulePrereqs".$i])) {
            while(isset($_REQUEST["modulePrereqs".$i])) {
              $prereqs[]=$_REQUEST["modulePrereqs".$i];
              $i++;
            }
          }
          $i=0;
          $categoryIDs=array();
          if(isset($_REQUEST["moduleCategory".$i])) {
            while(isset($_REQUEST["moduleCategory".$i])) {
              $categoryIDs[]=$_REQUEST["moduleCategory".$i];
              $i++;
            }
          }
          $typeIDs=array();
          if(isset($_REQUEST["moduleType".$i])) {
            while(isset($_REQUEST["moduleType".$i])) {
              $typeIDs[]=$_REQUEST["moduleType".$i];
              $i++;
            }
          }
          $i=0;
          $authors=array();
          if(isset($_REQUEST["moduleAuthors".$i])) {
            while(isset($_REQUEST["moduleAuthors".$i])) {
              $authors[]=$_REQUEST["moduleAuthors".$i];
              $i++;
            }
          }
          $smarty->assign("savedAuthors", $authors);
          $smarty->assign("savedTopics", $topics);
          $smarty->assign("savedObjectives", $objectives);
          $smarty->assign("savedPrereqs", $prereqs);
          $smarty->assign("savedCategories", $categoryIDs);
          $smarty->assign("savedTypes", $typeIDs);
          
          
          
          // Check to see if title is valid //  
          if(validateFieldLength( $resourceTitle, 2)) {
            $smarty->assign("alert", array("type"=>"negative", 
                "message"=>"Error: No module title given. The module could not be created because its name was not specified.") );
          } 
          // Check to see if description is valid //
          else if(validateFieldLength( $description, 0 )){ 
            $smarty->assign("alert", array("type"=>"negative", 
                "message"=>"Error: No description given. The module could not be created because its description was not specified.") );
          }
          else {
            $moduleID=createModule($_REQUEST["moduleTitle"], $description, $language, $educationLevel, $minutes, "", "InProgress", "Unregistered", $interactivityType, $rights, $userInformation["userID"], "", $restrictions);
            if($moduleID===FALSE) {
              $smarty->assign("alert", array("type"=>"negative", 
                "message"=>"An unknown error occurred while attempting to create the module.  This is most likely a back-end problem.") );
            } else {
              $moduleInfo=getModuleByID($moduleID);
              $userAuthor=$userInformation["firstName"]." ".$userInformation["lastName"];
              $result=setModuleAuthors($moduleInfo["moduleID"], array($userAuthor)); //By default, set the module author to the currently logged in user (the creator).
              $customWarning=$result;
              $moduleAction="edit";
              $smarty->assign("moduleID", $moduleID);
              $smarty->assign("moduleAction", "edit");
              $smarty->assign("pageName", "Module Wizard - Editing \"".$moduleInfo["title"]."\"");
              // once new module is created, save all possible data for it so that fields like authors get saved
                if (saveAllPossible($_REQUEST, $userInformation, $moduleInfo)===TRUE) {
                  $smarty->assign("alert", array("type"=>"positive", 
                        "message"=>"Module successfully created and saved.") );
                } else {
                    $smarty->assign("alert", array("type"=>"negative", 
                        "message"=>"Unable to create new module.") );
                }
              $moduleInfo=getModuleByID($moduleID); // refresh info
              $smarty->assign("moduleInfo", $moduleInfo);
              refreshFields($smarty, $moduleInfo["moduleID"]);
            }
          }
          
        } elseif($moduleAction=="createNewVersion") {
          $originalModuleID=$moduleInfo["moduleID"];
          $description = $moduleInfo["description"];
          $language = $moduleInfo["language"];
          $educationLevel = $moduleInfo["educationLevel"];
          $minutes = $moduleInfo["minutes"];
          $interactivityType = $moduleInfo["interactivityType"];
          $rights = $moduleInfo["rights"];
          $restrictions=$_REQUEST["restrictions"];
		  
          if(isset($_REQUEST["moduleDescription"])) {
            $description=$_REQUEST["moduleDescription"];
          }
          if(isset($_REQUEST["moduleMinutes"])) {
            $minutes=$_REQUEST["moduleMinutes"];
          }     
		  $title = $_REQUEST["moduleTitle"];           
          $moduleID=editModuleByID($moduleID, $title, $description, $language, $educationLevel, $minutes, $moduleInfo["authorComments"], $moduleInfo["checkInComments"], $userInformation["userID"], "InProgress", $moduleInfo["minimumUserType"], $interactivityType, $rights, $restrictions, "createNewVersion");
          $moduleInfo=getModuleByID($moduleID); //Refresh module information with the newly created version (probably only the version changed).
          /* Copy the authors from the old module version into the new module version. */
          $old=getModuleAuthors($originalModuleID);
          $result=setModuleAuthors($moduleInfo["moduleID"], $old);
          /* The next several lines copy topics, prereqs, objectives, categories, types, materials, and internal/external references from the old module 
            to the new version.  However, they'll only be copied if the backend says it supports the feature being copied. */
          $old=getModuleTopics($originalModuleID);
          $result=setModuleTopics($moduleInfo["moduleID"], $old);
          $old=getModulePrereqs($originalModuleID);
          $result=setModulePrereqs($moduleInfo["moduleID"], $old);
          $old=getModuleObjectives($originalModuleID);
          $result=setModuleObjectives($moduleInfo["moduleID"], $old);
          if(in_array("UseCategories", $backendCapabilities["read"]) && in_array("UseCategories", $backendCapabilities["write"])) {
            $old=getModuleCategoryIDs($originalModuleID);
            $result=setModuleCategories($moduleInfo["moduleID"], $old);
          }
          if(in_array("UseTypes", $backendCapabilities["read"]) && in_array("UseTypes", $backendCapabilities["write"])) {
            $old=getModuleTypeIDs($originalModuleID);
            $result=setModuleTypes($moduleInfo["moduleID"], $old);
          }
          if(in_array("UseMaterials", $backendCapabilities["read"]) && in_array("UseMaterials", $backendCapabilities["write"])) {
            $old=getAllMaterialsAttatchedToModule($originalModuleID);
            for($i=0; $i<count($old); $i++) {
              $m=getMaterialByID($old[$i]);
			  $materialID=createMaterial($m["content"], $m["type"], $m["readableFileName"], $m["name"], $m["format"]);
			  if($materialID!==FALSE && $materialID!=="NotImplimented") {
                $result=attatchMaterialToModule($materialID, $moduleInfo["moduleID"]);
              }
            }
          }
          if(in_array("CrossReferenceModulesInternal", $backendCapabilities["read"]) && in_array("CrossReferenceModulesInternal", $backendCapabilities["write"])) {
            $old=getInternalReferences($originalModuleID);
            $result=setInternalReferences($moduleInfo["moduleID"], $old);
          }
          if(in_array("CrossReferenceModulesExternal", $backendCapabilities["read"]) && in_array("CrossReferenceModulesExternal", $backendCapabilities["write"])) {
            $old=getExternalReferences($originalModuleID);
            $result=setExternalReferences($moduleInfo["moduleID"], $old);
          }
          /* End copying topics/prereqs/categories/objectives/types/materials/internal refs/external refs into new version. */
          $moduleAction="edit"; //Set the moduleAction to edit, since we want to edit the newly created version.
          
          $smarty->assign("moduleID", $moduleID);
          $smarty->assign("moduleAction", "edit");
          $smarty->assign("pageName", "Module Wizard - Editing \"".$moduleInfo["title"]."\"");
          // once new module is created, save all possible data for it so that fields like authors get saved
            if (saveAllPossible($_REQUEST, $userInformation, $moduleInfo)===TRUE) {
              $smarty->assign("alert", array("type"=>"positive", 
                    "message"=>"New version created and saved.") );
            } else {
                $smarty->assign("alert", array("type"=>"negative", 
                    "message"=>"Unable to create new version.") );
            }
          $smarty->assign("moduleInfo", $moduleInfo);
          refreshFields($smarty, $moduleInfo["moduleID"]);      
        } else if ($moduleAction == "copy") {
		  $originalModuleID=$moduleInfo["moduleID"];
          $description = $moduleInfo["description"];
          $language = $moduleInfo["language"];
          $educationLevel = $moduleInfo["educationLevel"];
          $minutes = $moduleInfo["minutes"];
          $interactivityType = $moduleInfo["interactivityType"];
          $rights = $moduleInfo["rights"];
          $restrictions=$_REQUEST["restrictions"];
		  
          if(isset($_REQUEST["moduleDescription"])) {
            $description=$_REQUEST["moduleDescription"];
          }
          if(isset($_REQUEST["moduleMinutes"])) {
            $minutes=$_REQUEST["moduleMinutes"];
          }     
		  $title = $_REQUEST["moduleTitle"];           
          $moduleID=editModuleByID($moduleID, $title, $description, $language, $educationLevel, $minutes, $moduleInfo["authorComments"], $moduleInfo["checkInComments"], $userInformation["userID"], "InProgress", $moduleInfo["minimumUserType"], $interactivityType, $rights, $restrictions, "copy");
          $moduleInfo=getModuleByID($moduleID); //Refresh module information with the newly created version (probably only the version changed).
          /* Copy the authors from the old module version into the new module version. */
          $old=getModuleAuthors($originalModuleID);
          $result=setModuleAuthors($moduleInfo["moduleID"], $old);
          /* The next several lines copy topics, prereqs, objectives, categories, types, materials, and internal/external references from the old module 
            to the new version.  However, they'll only be copied if the backend says it supports the feature being copied. */
          $old=getModuleTopics($originalModuleID);
          $result=setModuleTopics($moduleInfo["moduleID"], $old);
          $old=getModulePrereqs($originalModuleID);
          $result=setModulePrereqs($moduleInfo["moduleID"], $old);
          $old=getModuleObjectives($originalModuleID);
          $result=setModuleObjectives($moduleInfo["moduleID"], $old);
          if(in_array("UseCategories", $backendCapabilities["read"]) && in_array("UseCategories", $backendCapabilities["write"])) {
            $old=getModuleCategoryIDs($originalModuleID);
            $result=setModuleCategories($moduleInfo["moduleID"], $old);
          }
          if(in_array("UseTypes", $backendCapabilities["read"]) && in_array("UseTypes", $backendCapabilities["write"])) {
            $old=getModuleTypeIDs($originalModuleID);
            $result=setModuleTypes($moduleInfo["moduleID"], $old);
          }
          if(in_array("UseMaterials", $backendCapabilities["read"]) && in_array("UseMaterials", $backendCapabilities["write"])) {
            $old=getAllMaterialsAttatchedToModule($originalModuleID);
            for($i=0; $i<count($old); $i++) {
              $m=getMaterialByID($old[$i]);
			  $materialID=createMaterial($m["content"], $m["type"], $m["readableFileName"], $m["name"], $m["format"]); 
			  if($materialID!==FALSE && $materialID!=="NotImplimented") {
                $result=attatchMaterialToModule($materialID, $moduleInfo["moduleID"]);
              }
            }
          }
          if(in_array("CrossReferenceModulesInternal", $backendCapabilities["read"]) && in_array("CrossReferenceModulesInternal", $backendCapabilities["write"])) {
            $old=getInternalReferences($originalModuleID);
            $result=setInternalReferences($moduleInfo["moduleID"], $old);
          }
          if(in_array("CrossReferenceModulesExternal", $backendCapabilities["read"]) && in_array("CrossReferenceModulesExternal", $backendCapabilities["write"])) {
            $old=getExternalReferences($originalModuleID);
            $result=setExternalReferences($moduleInfo["moduleID"], $old);
          }
          /* End copying topics/prereqs/categories/objectives/types/materials/internal refs/external refs into new version. */
          $moduleAction="edit"; //Set the moduleAction to edit, since we want to edit the newly created version.
          
          $smarty->assign("moduleID", $moduleID);
          $smarty->assign("moduleAction", "edit");
          $smarty->assign("pageName", "Module Wizard - Editing \"".$moduleInfo["title"]."\"");
          // once new module is created, save all possible data for it so that fields like authors get saved
            if (saveAllPossible($_REQUEST, $userInformation, $moduleInfo)===TRUE) {
              $smarty->assign("alert", array("type"=>"positive", 
                    "message"=>"New copy has been created and saved.") );
            } else {
                $smarty->assign("alert", array("type"=>"negative", 
                    "message"=>"Unable to copy module.") );
            }
          $smarty->assign("moduleInfo", $moduleInfo);
          refreshFields($smarty, $moduleInfo["moduleID"]);  
		} else { //$moduleAction = edit
            // exectue save function
            if (saveAllPossible($_REQUEST, $userInformation, $moduleInfo)===TRUE) {
                $smarty->assign("alert", array("type"=>"positive", 
                    "message"=>"Module saved.") );
            } else {
                $smarty->assign("alert", array("type"=>"negative", 
                    "message"=>"Unable to save module progress.") );
            }			
            
            // refresh module information
            $moduleInfo=getModuleByID($moduleID);
            
            // after saving, continue editing
            $smarty->assign("moduleAction", "edit");
            $smarty->assign("pageName", "Module Wizard - Editing \"".$moduleInfo["title"]."\"");
            $smarty->assign("moduleInfo", $moduleInfo);

            refreshFields($smarty, $moduleInfo["moduleID"]);
        }
    } elseif ($moduleAction == "create") {
        $smarty->assign("pageName", "Module Wizard - Create New Module");
    } elseif ($moduleAction == "createNewVersion") {
        $smarty->assign("pageName", "Module Wizard - Create New Version of \"".$moduleInfo["title"]."\"");
        $smarty->assign("moduleInfo", $moduleInfo);
        refreshFields($smarty, $moduleInfo["moduleID"]);
    } elseif ($moduleAction == "copy") {
        $smarty->assign("pageName", "Module Wizard - Copying \"".$moduleInfo["title"]."\"");
        $smarty->assign("moduleInfo", $moduleInfo);
        refreshFields($smarty, $moduleInfo["moduleID"]); 
	  } elseif ($moduleAction == "edit") {
        $smarty->assign("pageName", "Module Wizard - Editing \"".$moduleInfo["title"]."\"");
        $smarty->assign("moduleInfo", $moduleInfo);
        refreshFields($smarty, $moduleInfo["moduleID"]);
    } elseif ($moduleAction == "export") {
        $smarty->assign("pageName", "Module Wizard - Export \"".$moduleInfo["title"]."\"");
        exportModule($moduleInfo); 
    }     
  
  }
  /* autoSelect() - This function allows an auto Search/Select function in javascript. 
		@return - array of names and emails of users 
  */
	function autoSelect(){
		$arrayData = array();
		$emails = array();
		$name = array();  
		$table = 'users'; 
		$arrayData = dataRead($table); 
		foreach ($arrayData as $row) {
			$FN = $row["FirstName"];
			$LN = $row["LastName"];
			$email = $row["Email"];    
			$emails[] = ($email); 
			$name[] = ($FN . " " . $LN);
		}
		return array($emails, $name);
	}
	/* findSubmitterID($input) - this will find the submitter ID of the module to be used for the first submission, can be used
                                for editing but you would need to save this submitter ID under then userInfo rather than
                                moduleInfo
		@params - this will take an input of email or specifed string with the first and last name or a module ID input 
		@return - returns the userID of the user who submitterd a module 
	*/
	function findSubmitterID($input) {

    print_r($input);

		$find = '@';
		$conditions = array(); 
		if (strpos($input, $find)){
			$email = "Email";
			$conditions[] = "$email = '$input'";
		}
		else {
			$FN = "FirstName";
			$LN = "LastName"; 
			$names = preg_split("/[\s]+/", $input);
			$fnInput = $names[0];
			$lnInput = $names[1];
			$conditions[] = "$FN = '$fnInput'"; 
			$conditions[] = "$LN = '$lnInput'";
		}
		$table = 'users'; 
		$user = reset(dataRead($table, $conditions)); 

		return $user["UserID"];
	}
	$email = autoSelect(); 
	$name = autoSelect();
	$emails = $email[0]; 
	$names = $name[1]; 
	$auto = array_merge($emails, $names);
	$smarty->assign("auto", $auto);

	$submitter = getUserInformationByID($moduleInfo["submitterUserID"]);
	$smarty->assign("submitter", $submitter);

	$type = $userInformation["type"];
	$smarty->assign("type", $type); 
  
  $smarty->display('moduleWizard/basics.php.tpl');                  
?>
