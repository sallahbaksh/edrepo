<?php session_start();
/****************************************************************************************************************************
 *    editCompositions.php Lets the user set relationships between their different modules.
 *    --------------------------------------------------------------------------------------
 *  Shows any relationships that are present, and allows the user to set new parent child relationships.
 *
 *  Version: 1.0
 *  Author: Ben Kos 
 *  Date: 12 August 2011
 ******************************************************************************************************************************/
 
  require("lib/backends/validate.php"); 
  require("lib/config.php");
  // assign the collection name to Smarty
  
 $smarty->assign("title", $COLLECTION_NAME . " - Modify Compositions");
 $smarty->assign("pageName", "My Compositions");
 $smarty->assign("tab", "modules");
 $smarty->assign("baseDir", getBaseDir() );
 $smarty->assign("alert", array("type"=>"", "message"=>"") );
 
 $loggedIn = false;
 $backendCapable = true; 
 if(isset($userInformation)) { 
    $loggedIn = true;
}
 $smarty->assign("loggedIn", $loggedIn); 
 $smarty->assign("backendCapable", $backendCapable);  
 
 $action="displayComp";
 if(isset($_REQUEST["action"])) {
    $action=$_REQUEST["action"];
  }
  $smarty->assign("action", $action);
  
  if($action=="displayComp") { 
	 
 }
 
if($action=="editComp") { 
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
  if (isset($_REQUEST["newParent"]) && $_REQUEST["newParent"] != "") {
    $newParentID=$_REQUEST["newParent"];	 
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
		  $smarty->assign("alert", array("type"=>"positive", "message"=>"Successfully Created New Relationship.") );
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
 
 if($action=="deleteComp") { 
	$deleteChildID=$_REQUEST["actualChild"];
	$deleteChild=getModuleByID($deleteChildID);
	$deleteParentID=$_REQUEST["actualParent"];
	$deleteParent=getModuleByID($deleteParentID);
	$deleteresult=removeParentChild($deleteParentID, $deleteChildID);
	if ($deleteresult === TRUE) {
		$smarty->assign("alert", array("type"=>"positive", "message"=>"Successfully Deleted Relationship.") );
	}
	else {
		$smarty->assign("alert", array("type"=>"negative", "message"=>"Unable to Delete Relationship. Please Try Again.") );
	}
 } 
 
if ($loggedIn == true){  // Prevents error notices from messing up page layout if not logged in.
	$usermodules=searchModules(array("userID"=>$userInformation["userID"])); // All modules that belong to the user.
	$smarty->assign("usermodules", $usermodules);
	$modulechildrenID = array(); // Declares arrays to be used.
	$moduleparentsID = array();
	$modulechildren = array();
	$moduleparents = array();
	foreach($usermodules as $usermodules) {
		$modulechildtemp=getChildren($usermodules["moduleID"]); // Runs getChild() from datamanager for each of the user's modules.
		foreach($modulechildtemp as $modulechild) {
			array_push($modulechildrenID, $modulechild);
			array_push($moduleparentsID, $usermodules["moduleID"]);
		}
	/*	$moduleparenttemp=getParents($usermodules["moduleID"]);					<-- Commented for now to prevent duplicates.
		foreach($moduleparenttemp as $moduleparent) {
			array_push($moduleparentsID, $moduleparent);
			array_push($modulechildrenID, $usermodules["moduleID"]);
		} */
	}	
	foreach($modulechildrenID as $modulechildID) {  // Adds the parent and child IDs to the arrays being sent to smarty.
		array_push($modulechildren,getModuleByID($modulechildID));
	}
	foreach($moduleparentsID as $moduleparentID) {
		array_push($moduleparents,getModuleByID($moduleparentID));
	}	
	$smarty->assign("modulechildren", $modulechildren);
	$smarty->assign("moduleparents", $moduleparents);
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

 //var_dump(get_defined_vars()); // Variable dump for debugging.
 $smarty->display('editCompositions.php.tpl');
?>