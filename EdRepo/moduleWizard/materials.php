<?php session_start();
/****************************************************************************************************************************
    moduleWizard/materials.php - managing a module's materials
    --------------------------------------------------------------------------------------
    Main method for a user to add/remove materials and attach child modules
 
  Version: 1.0
  Author: Jon Thompson 
  Date: 27 March 2012
 
  Notes: Takes several key REQUEST variables (sent by the form/URL) :
              - action : indicates which action to take if any
                            values: display (default), addMaterial, removeMaterial, addChild, removeChild
              - moduleID : ID of module to edit or create new version of; sent by URL or form
 ******************************************************************************************************************************/
  
  require("../lib/config.php");

  $smarty->assign("title", $COLLECTION_NAME . " - Module Wizard");
    // title of this page. For most pages: &COLLECTION . " - Title" , default: $COLLECTION_NAME
  $smarty->assign("tab", "modules"); // active nav tab. default:  "home"
  $smarty->assign("baseDir", getBaseDir() ); // should always be getBaseDir() 
  
  $smarty->assign("pageName", "Module Wizard - Materials");
  
  $smarty->assign("alert", array("type"=>"", "message"=>"") );
                  // default empty alert message (type can be either positive or negative)
  
  // define section of module wizard
  $smarty->assign("section", "Materials");  
  
  $validActions = array("display", "addMaterial", "forceAddMaterial", "deleteMaterial", "doDeleteMaterial", "renameMaterial", "doRenameMaterial", "addChild", "addNewChild", "removeChild");
  
  // 'action' handles display (default), addMaterial, removeMaterial, rename, addChild, removeChild
  $action = "display";
  if ( isset($_REQUEST["action"]) ) {  

    $action = $_REQUEST["action"];
    
    // check if specified action is valid
    if ( !in_array($action, $validActions) )
    {
      $action = "error";
      $smarty->assign("alert", array("type"=>"negative", 
                        "message"=>"Unknown action specified. 
                        Be sure to only use provided links to this page. 
                        If this error persists, contact the collection manager.") );
    }
  }       
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
  // if it's any of these actions, we need a value material as well
  if ($action == "doDeleteMaterial" || $action == "deleteMaterial" || $action == "renameMaterial" || $action == "doRenameMaterial") {
      if ( isset($_REQUEST["materialID"]) ) {
          $materialID=$_REQUEST["materialID"];
          $materialInfo=getMaterialByID($materialID);        
      } else {
          $materialInfo = FALSE;
      }
      $smarty->assign("materialInfo", $materialInfo);  
      
      $allModuleMaterials=getAllMaterialsAttatchedToModule($moduleID);
      if ($allModuleMaterials==FALSE || !in_array($materialInfo["materialID"], $allModuleMaterials) ) {
          $smarty->assign("alert", array("type"=>"negative", "message"=>"This material doesn't belong to this module!") );
          $action = "error";
      }
      
      if ($materialInfo == FALSE) {
          $smarty->assign("alert", array("type"=>"negative", "message"=>"Not enough valid information to continue.") );
          $action = "error";
      }
  }
  $smarty->assign("action", $action); 
  
  
  // 'hasPermission' determines whether the user has permission to perform this action
  $hasPermission = false;
  if ( isset($userInformation) ) {
	$group = $userInformation["groups"];
    $type = $userInformation["type"];
	$restrictions = $moduleInfo["restrictions"];
	$canView = FALSE; 
    // user must be logged in and have sufficient privileges
    if ($type=="Submitter" || $type=="Editor" || $type=="Admin") {
        // if edit or createNewVersion, check to make sure user owns module or user
        // is editor or admin (who can edit all modules)
        if ( $type!="Submitter" || ($type=="Submitter"
            && isset($moduleInfo["submitterUserID"]) 
            && $moduleInfo["submitterUserID"]==$userInformation["userID"]) )
        {
            $hasPermission = true;
        } elseif ($moduleAction != "error") {
            $smarty->assign("alert", array("type"=>"negative", 
                "message"=>"Sorry, you don't have permission to edit this module!") );
        }
    } else {
        $smarty->assign("alert", array("type"=>"negative", 
                "message"=>"Sorry, you don't have permissions to create/edit modules!") );
    }
	if ($group == "None" || $group == "Admin" || $restrictions == $group || $restrictions == "None" || $userInformation["userID"] == $moduleInfo["submitterUserID"]) {
		$canView = TRUE; 
	}
  } else {
    $smarty->assign("alert", array("type"=>"negative", 
                "message"=>"Sorry, you must be logged in to create/edit modules!") );
  }
  $smarty->assign("hasPermission", $hasPermission);
  $smarty->assign("canView", $canView); 
  
  
  
  // if user has permission, and no error was found, continue
  if ($hasPermission == true && $action != "error")
  {
    $smarty->assign("pageName", "Module Wizard - Editing \"".$moduleInfo["title"]."\"");
  
    $smarty->assign("moduleInfo", $moduleInfo);
    
    $modules=searchModules(array("status"=>array("Active")));
    $userModules=searchModules(array("userID"=>$userInformation["userID"])); // All modules that belong to the user.
    foreach ($userModules as $userModule) {
      if (!in_array($userModule, $modules)) {
        $modules[] = $userModule;
      }
    }
    $smarty->assign("modules", $modules);
    
    
    $materials = array();
    $allModuleMaterials=getAllMaterialsAttatchedToModule($moduleInfo["moduleID"]);
    if($allModuleMaterials===FALSE) {
        $smarty->assign("alert", array("type"=>"negative",
            "message"=>"Error retrieving this module's materials!") );
    } else {
        for($i=0; $i<count($allModuleMaterials); $i++) {
            $materials[$i]=getMaterialByID($allModuleMaterials[$i]);                
        }
    }
    $smarty->assign("materials", $materials);
    
    $moduleChildren = array();
    $moduleChildrenID = getChildren($moduleInfo["moduleID"]);
    foreach($moduleChildrenID as $moduleChildID) {
      array_push($moduleChildren,getModuleByID($moduleChildID));
    }	 
    $smarty->assign("moduleChildren", $moduleChildren);
	
    if ($action == "addMaterial" || $action == "forceAddMaterial") {
        // check all fields are set
        // if not, overwrite given fields to show user
		if ($action != "forceAddMaterial") {
			$_SESSION["materialTypes"] = ($_REQUEST["materialType"]); 
			$_SESSION["materialFiles"] = ($_FILES["materialFile"]); 
			$_SESSION["materialFileNames"] = ($_FILES["materialFile"]["name"]); 
			$_SESSION["materialFileTypes"] = ($_FILES["materialFile"]["type"]); 
			$_SESSION["materialNames"] = ($_REQUEST["materialName"]); 
		}
        if ( (!(isset($_REQUEST["moduleID"]) && isset($_REQUEST["materialType"]) 
            && (($_REQUEST["materialType"]=="LocalFile" && isset($_REQUEST["materialName"]) && isset($_FILES["materialFile"])) 
            || ($_REQUEST["materialType"]=="ExternalURL" && isset($_REQUEST["materialName"]) && isset($_REQUEST["materialURL"])))) )&& $action != "forceAddMaterial" ) {
            $materialInfo = array();
            // overwrite given fields to show smarty
            if ( isset($_REQUEST["materialType"])) {
                $materialInfo["type"] = $_REQUEST["materialType"];		
            }
            if ( isset($_REQUEST["materialName"]) ) {
                $materialInfo["title"] = $_REQUEST["materialName"];				
            }
            $smarty->assign("materialInfo", $materialInfo);
            $smarty->assign("alert", array("type"=>"negative", 
                "message"=>"Unable to add a material to this module.  
                            Some information necessary to add the material was missing.") );
        } else {
		  // fields are set, so attempt to add material
		if ($action == "forceAddMaterial") {
			$type = ($_SESSION["materialTypes"]);
			$files = ($_SESSION["materialFiles"]);
			$fileName = ($_SESSION["materialFileNames"]);
			$fileType = ($_SESSION["materialFileTypes"]);
			$name = ($_SESSION["materialNames"]); 
		}
		else {
			$type = ($_REQUEST["materialType"]);
			$files = ($_FILES["materialFile"]);
			$fileName = ($_FILES["materialFile"]["name"]); 
			$fileType = ($_FILES["materialFile"]["type"]); 
			$name = ($_REQUEST["materialName"]); 
		}
          if($type=="LocalFile") { 
			$content = storeMaterialLocally($moduleID, $files, '..'.$MATERIAL_STORAGE_DIR); 
			$readableFileName = $fileName; 
			$format = $fileType; 
          } elseif ($type=="ExternalURL") { //Run this block if the material source type isn't a file to upload (ie its a URL)
            $content=$_REQUEST["materialURL"]; //Get the link (URL) from what was submitted.
            $readableFileName=""; //There is no "human-readable" file name for URLs.
            $format = "";
          }
          if($content===FALSE) { //Error storing material file?
            $smarty->assign("alert", array("type"=>"negative", 
                  "message"=>"<strong>Unable to upload material file.</strong><br />Check to ensure the file fits the minimum upload requirements (size, type, and virus-free) and try again.  If this problem persists, 
                              please contact the collection maintainer.") );
          } elseif($content == "FileExists" && $action != "forceAddMaterial") {			
			$modulesID = $moduleInfo["moduleID"]; 
			//Pop up to the user so they know they will be overwriting materials previously saved 
			print "<script> if(confirm('Saving this material will overwrite the previous material with the same name. \\n".
									"Would you like to overwrite? \\n\\n".
									"$readableFileName')) 
							{
								var myWindow = window.open('materials.php?moduleID="."$moduleID"."&action=forceAddMaterial', '_self'); 
							}
							else {
								alert('Unable to upload the file: \\n\\n $readableFileName\\n\\nbecause a file with that name has already been uploaded to this module.\\nPlease rename the file on your computer and try again.');
								var myWindow = window.open('materials.php?moduleID="."$moduleID', '_self');
							}

				  </script>"; 				  
          } else {		  
            $materialID=createMaterial($content, $type, $readableFileName, $name , $format); //Add the material to the database
            if($materialID===FALSE) { //Error adding material?
              $smarty->assign("alert", array("type"=>"negative", 
                  "message"=>"<strong>Unable to create material.</strong><br />
                              Please contact the collection maintainer to report this error.</p>") );
            } else {
              $result=attatchMaterialToModule($materialID, $moduleInfo["moduleID"]); //Attach the material to the module
              if($result===FALSE) { //Error attaching material to module?
                $smarty->assign("alert", array("type"=>"negative", 
                  "message"=>"<strong>Unable to attach material to module.</strong><br />
                              Please contact the collection maintainer to report this error.") );
              } else { //Material successfully uploaded, added to database, and attached to module!
                //$smarty->assign("alert", array("type"=>"positive", "message"=>"Material successfully added.") ); 
                // on success, redirect to materials step in wizard:
				
				if ($action == "forceAddMaterial") {
					deleteSameMaterialFromDB($materialID, $type, $content, $fileName);
				}
				
				unset($_SESSION["materialTypes"]); 
				unset($_SESSION["materialFiles"]); 
				unset($_SESSION["materialFileNames"]); 
				unset($_SESSION["materialFileTypes"]); 
				unset($_SESSION["materialNames"]); 
				
				print "<script> 
						var myWindow = window.open('materials.php?moduleID="."$moduleID', '_self'); 
				  </script>"; 				  
              }
            }
          }  // end if($content===FALSE)
        }
		
    } elseif ($action == "addChild") { // create parent-child relationship
      $validChild = false; // true if child and parent are given
      $validParent = false;
      // Gets the modules that the user wants to create the relationship between.
      if (isset($_REQUEST["newChild"]) && $_REQUEST["newChild"] != "") {
        $newChildID=$_REQUEST["newChild"];	 
        $newChild=getModuleByID($newChildID);
        if ($newChild["moduleID"]==$newChildID) {
          $validChild = true;
        }
      }
      if ($moduleInfo != FALSE) {
        $newParentID=$moduleInfo["moduleID"];	 
        $newParent=getModuleByID($newParentID);
        if ($newParent["moduleID"]==$newParentID) {
          $validParent = true;
        }
      }
      
      if ($validChild && $validParent) {
        $duplicateRelationship = FALSE;
        $currentChildrenID=getChildren($newParentID);
        foreach ($currentChildrenID as $currentChildID) { // Makes sure the relationship being created doesn't already exist.
          if($newChildID == $currentChildID) {
            $duplicateRelationship = TRUE;
          }
        }
        $currentParentsID=getParents($newChildID);
        foreach ($currentParentsID as $currentParentID) {
          if($newParentID == $currentParentID) {
            $duplicateRelationship = TRUE;
          }
        }

        /*
                  To prevent circular relationships:
                  ParentID must NOT be ChildID
                  ParentID must NOT be descendant of ChildID
                  ChildID must NOT be ancestor of ParentID
                  */
        $circularRelationship = FALSE;
        if ( in_array($newParentID, getDescendants($newChildID)) || in_array($newChildID, getAncestors($newParentID)) ) {
          $circularRelationship = TRUE;
        }
        
        
        if( $duplicateRelationship !== TRUE && $circularRelationship !== TRUE ) { // If it isn't a duplicate, creates relationship and shows
          $pcResult=setParentChild($newParentID, $newChildID);					 // according alert.
        }	
        
        if( !empty($pcResult) && $pcResult === TRUE) {
          //$smarty->assign("alert", array("type"=>"positive", "message"=>"Successfully Created New Relationship.") );
            // on success, redirect to materials step in wizard:
            header( 'Location: materials.php?moduleID='.$moduleInfo["moduleID"] ) ;
        }
        else if ($duplicateRelationship == TRUE)  {
          $smarty->assign("alert", array("type"=>"negative", "message"=>"You are trying to create a relationship that already exists.") );
        }
        else if ($circularRelationship == TRUE)  {
          $smarty->assign("alert", array("type"=>"negative", "message"=>"Error. You are trying to create a circular relationship (e.g. one where the given parent is a descendant of the given child).") );
        }
        else {		
          $smarty->assign("alert", array("type"=>"negative", "message"=>"Error While Creating New Relationship. Please Try Again.") );
        }
      } else {
        $smarty->assign("alert", array("type"=>"negative", "message"=>"Error creating new relationship. Please be sure to supply both a valid child and a valid parent.") );
      }
      
    } else if ($action == "addNewChild") {
	      $resourceTitle = $_REQUEST["moduleName"];      // Required length 3
          $description=$_REQUEST["moduleDescription"];          // Must not be blank
          
          $smarty->assign("newChildModuleInfo", array("title"=>$resourceTitle, 
                                        "description"=>$description)	);
          
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
            $moduleID=createModule($_REQUEST["moduleName"], $description, $language, $educationLevel, $minutes, "", "InProgress", "Unregistered", $interactivityType, $rights, $userInformation["userID"], "", "None");
            if($moduleID===FALSE) {
              $smarty->assign("alert", array("type"=>"negative", 
                "message"=>"An unknown error occurred while attempting to create the module.  This is most likely a back-end problem.") );
            } else {
              $childModuleInfo=getModuleByID($moduleID);
              $userAuthor=$userInformation["firstName"]." ".$userInformation["lastName"];
              $result=setModuleAuthors($childModuleInfo["moduleID"], array($userAuthor)); //By default, set the module author to the currently logged in user (the creator).
              $customWarning=$result;
              $smarty->assign("newChildModuleID", $moduleID);
              // once new module is created, save all possible data for it so that fields like authors get saved
                if (saveAllPossible($_REQUEST, $userInformation, $childModuleInfo)===TRUE) {
                  $smarty->assign("alert", array("type"=>"positive", 
                        "message"=>"Module successfully created and saved.") );
                } else {
                    $smarty->assign("alert", array("type"=>"negative", 
                        "message"=>"Unable to create new module.") );
                }

		  $validChild = false; // true if child and parent are given
		  $validParent = false;
		  // Gets the modules that the user wants to create the relationship between.
			$newChildID=$childModuleInfo["moduleID"]; 	//could be $newChildID = $moduleID;   
			$newChild=getModuleByID($newChildID);
			if ($newChild["moduleID"]==$newChildID) {
			  $validChild = true;
			}
		  }
		  if ($moduleInfo != FALSE) {
			$newParentID=$moduleInfo["moduleID"];	 
			$newParent=getModuleByID($newParentID);
			if ($newParent["moduleID"]==$newParentID) {
			  $validParent = true;
			}
		  }
		  
		  if ($validChild && $validParent) {
			$duplicateRelationship = FALSE;
			$currentChildrenID=getChildren($newParentID);
			foreach ($currentChildrenID as $currentChildID) { // Makes sure the relationship being created doesn't already exist.
			  if($newChildID == $currentChildID) {
				$duplicateRelationship = TRUE;
			  }
			}
			$currentParentsID=getParents($newChildID);
			foreach ($currentParentsID as $currentParentID) {
			  if($newParentID == $currentParentID) {
				$duplicateRelationship = TRUE;
			  }
			}

			/*
					  To prevent circular relationships:
					  ParentID must NOT be ChildID
					  ParentID must NOT be descendant of ChildID
					  ChildID must NOT be ancestor of ParentID
					  */
			$circularRelationship = FALSE;
			if ( in_array($newParentID, getDescendants($newChildID)) || in_array($newChildID, getAncestors($newParentID)) ) {
			  $circularRelationship = TRUE;
			}
			
			
			if( $duplicateRelationship !== TRUE && $circularRelationship !== TRUE ) { // If it isn't a duplicate, creates relationship and shows
			  $pcResult=setParentChild($newParentID, $newChildID);					 // according alert.
			}	
			
			if( !empty($pcResult) && $pcResult === TRUE) {
			  //$smarty->assign("alert", array("type"=>"positive", "message"=>"Successfully Created New Relationship.") );
				// on success, redirect to materials step in wizard:
				header( 'Location: materials.php?moduleID='.$moduleInfo["moduleID"] ) ;
			}
			else if ($duplicateRelationship == TRUE)  {
			  $smarty->assign("alert", array("type"=>"negative", "message"=>"You are trying to create a relationship that already exists.") );
			}
			else if ($circularRelationship == TRUE)  {
			  $smarty->assign("alert", array("type"=>"negative", "message"=>"Error. You are trying to create a circular relationship (e.g. one where the given parent is a descendant of the given child).") );
			}
			else {		
			  $smarty->assign("alert", array("type"=>"negative", "message"=>"Error While Creating New Relationship. Please Try Again.") );
			}
		  } else {
			$smarty->assign("alert", array("type"=>"negative", "message"=>"Error creating new relationship. Please be sure to supply both a valid child and a valid parent.") );
		  }
		}
	} else if ($action == "removeChild") { 
      $deleteChildID=$_REQUEST["childID"];
      $deleteParentID=$moduleInfo["moduleID"];
      $deleteresult=removeParentChild($deleteParentID, $deleteChildID);
      if ($deleteresult === TRUE) {
        //$smarty->assign("alert", array("type"=>"positive", "message"=>"Successfully Deleted Relationship.") );
        // on success, redirect to materials step in wizard:
        header( 'Location: materials.php?moduleID='.$moduleInfo["moduleID"] ) ;
      } else {
        $smarty->assign("alert", array("type"=>"negative", "message"=>"Error. Unable to delete relationship.") );
      }
      
    } else if ($action == "doDeleteMaterial") {
      if(!isset($_REQUEST["materialID"])) { //Can't remove a material if we don't know the ID.
        $smarty->assign("alert", array("type"=>"negative", 
				"message"=>"<strong>The ID of the material to delete was not specified.  Unable to remove unknown material.</strong>") );
      } else {
        $result=deattatchMaterialFromModule($_REQUEST["materialID"], $moduleInfo["moduleID"]); //Deattatch the material from the module.
        if($result!==TRUE) {
          $smarty->assign("alert", array("type"=>"negative", 
				"message"=>"<strong>Error removing material (at deattatchMaterialFromModule).</strong>") );
        } else {
          $result=removeMaterialsByID(array($_REQUEST["materialID"]), '..'.$MATERIAL_STORAGE_DIR); //Actually remove the material.
          if($result!==TRUE) {
            $smarty->assign("alert", array("type"=>"negative", 
				"message"=>"<strong>Error removing material (at removeMaterialsByID).</strong>") );
          } else {
            //$smarty->assign("alert", array("type"=>"positive", "message"=>"Successfully removed material.") );
            // on success, redirect to materials step in wizard:
            header( 'Location: materials.php?moduleID='.$moduleInfo["moduleID"] ) ;
          }
        }
      }     
    } else if ($action == "doRenameMaterial") {
	  if(!isset($_REQUEST["materialID"])) { //Can't remove a material if we don't know the ID.
        $smarty->assign("alert", array("type"=>"negative", 
				"message"=>"<strong>The ID of the material to delete was not specified.  Unable to remove unknown material.</strong>") );
      }else if (!isset($_POST["renameMaterial"])) {
		$smarty->assign("alert", array("type"=>"negative", 
				"message"=>"<strong>There was not anything entered in the renaming textbox. Please enter a name or click cancel. </strong>")); 
	  }else {
        $result=renameMaterialByID($_REQUEST["materialID"], $_POST["renameMaterial"]); //Deattatch the material from the module.
        if($result!==TRUE) {
          $smarty->assign("alert", array("type"=>"negative", 
				"message"=>"<strong>Error renaming material.</strong>") );
        } else {
			//$smarty->assign("alert", array("type"=>"positive", "message"=>"Successfully renamed material.") );
            // on success, redirect to materials step in wizard:
            header( 'Location: materials.php?moduleID='.$moduleInfo["moduleID"] ) ;
		}
      }
	}//end action if
}

/*  getDescendants() - return all descendants of a module with id $moduleID
              (including itself, its children, its children's children, etc.)
         NOTE: this function is recursive */
function getDescendants($moduleID) {
  $desc = array($moduleID);
  
  $children = getChildren($moduleID);

  if (count($children) > 0) {
    foreach ($children as $child) {
      $desc = array_merge($desc, getDescendants($child));
    }
  }
  
  return $desc;
}

/*  getAncestors() - return all ancestors of a module with id $moduleID
              (including itself, its parents, its parents's parents, etc.)
         NOTE: this function is recursive */
function getAncestors($moduleID) {
  $ans = array($moduleID);
  
  $parents = getParents($moduleID);

  if (count($parents) > 0) {
    foreach ($parents as $parent) {
      $ans = array_merge($ans, getAncestors($parent));
    }
  }
  
  return $ans;
}
  
  $smarty->display('moduleWizard/materials.php.tpl');                  
?>
