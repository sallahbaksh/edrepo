<?php
/****************************************************************************************************************************
 *    hiearchy.php - defines the model functions for module hiearchies
 *    ---------------------------------------------------------
 *
 *  Version: 1.0
 *  Author: Jon Thompson
 *
 ******************************************************************************************************************************/

require_once(__DIR__ . "/../backends/backend.php");
require_once(__DIR__ . "/model.php");

// "module ID" for the repository
define("REPOSITORY_ID", 0);


/* getChildren($moduleID) - Returns a list of modules that are listed as child to the given module.
  @parm $moduleID - The ID of the module to be checked as parent.
  @return - Returns FALSE on any error.  Not finding any children is not considered an error.
    On success, returns an array of all modules or compositions that are listed as children of the given composition.  
	Returns an empty array if no child modules or compositions were found. */
function getChildren($moduleID) {
  $result = dataRead("parentchild", array("ParentID=$moduleID"));
  if($result===FALSE) {
    return FALSE;
  }  
  $results=array();
  foreach($result as $row) {
    $results[]=$row["ChildID"];
  }
  return $results;
}

/* getParents($moduleID) - Returns a list of modules that are listed as parent to the given module.
  @parm $moduleID - The ID of the module to be checked as child.
  @return - Returns FALSE on any error.  Not finding any parent modules is not considered an error.
    On success, returns an array of all modules that are listed as parents of the given module.  
	Returns an empty array if no parent modules were found. */
function getParents($moduleID) {
  $result = dataRead("parentchild", array("ChildID=$moduleID"));
  if($result===FALSE) {
    return FALSE;
  }  
  $results=array();
  foreach($result as $row) {
    $results[]=$row["ParentID"];
  }
  return $results;
}

/* setParentChild($parentID, $childID) - Creates a new relationship in the Parent Child table with the given modules.
  @parm $parentID - The moduleID of the parent module.
  @parm $childID - The moduleID of the child module.
  @return - Returns FALSE on any error.
    Returns TRUE on successful setting of the relationship. */
function setParentChild($parentID, $childID) {
  $fields = array (
    "ParentID" => $parentID,
    "ChildID" => $childID
  );
  $result = dataCreate("parentchild", $fields);
  if($result===FALSE) {
    return FALSE;
  }
  return TRUE;
}

/* removeParentChild($parentID, $childID) - Deletes a specified relationship from the parent child table.
  @parm $pairingID - the ID of the pairing to be eliminated.
  @return - Returns FALSE on any error.
    Returns TRUE on successful deletion of the relationship. */
function removeParentChild($parentID, $childID) {
  $conditions = array (
    "ParentID=$parentID",
    "ChildID=$childID"
  );
  $result = dataDelete("parentchild", $conditions);
  return $result;
}

/* getTopLevelModules - returns all active modules in the collection
                                   that have no parents
      @return - array of IDs for the modules with no parents
*/
function getTopLevelModules() {
  $topLevelModules = array();
  
  $modules = searchModules(array("status"=>"Active"));
  
  foreach($modules as $module) {
    $parents = getParents($module["moduleID"]);
    if (count($parents)<=0) {
      $topLevelModules[] = $module["moduleID"];
    }
  }
  
  return $topLevelModules;  
}

/* addHierarchyModule() - add module to collection's main hierarchy
    @param  $moduleID  - module ID of the module to add
    @return - TRUE on success, FALSE otherwise
*/
function addHierarchyModule($moduleID) {
  $fields = array("ModuleID" => $moduleID);
  $result = dataCreate("hierarchymodule", $fields);  
  if ($result === FALSE) {
    return FALSE;
  }
  return TRUE;
}

/* removeHierarchyModule() - remove module from collection's main hierarchy
    @param  $moduleID  - module ID of the module to remove
    @return - TRUE on success, FALSE otherwise
*/
function removeHierarchyModule($moduleID) {
  $conditions = array("ModuleID = $moduleID");
  return dataDelete("hierarchymodule", $conditions);;
}

/* getHierarchyModules() - retrieve modules that are in collection's main hierarchy
// @return - multi-dimensional array of module information, or FALSE on error
*/
function getHierarchyModules() {
  $result = dataRead("hierarchymodule");
  if ($result === FALSE) {
    return FALSE;
  }

  $modules = array();
  foreach($result as $row) {
    $module = getModuleByID($row["ModuleID"]);
    
    if (!$module || count($module) <= 0) {
      continue; // invalid module, skip to next id
    }
    
	$module[] = array_push($module, $row["OrderID"]); 
	$modules[] = $module; 
  }
  
  usort($modules, function($a, $b) { 
    return $a[0] - $b[0];
  });
  
  return $modules;  
}

/* getTreeHTML - generates tree HTML (i.e. nested un-ordered lists) for module hierarchy
    NOTE: This function is recursive.
    @param  $rootID - module ID of this tree's root
    @param  $currentID - the module ID of the module being currently viewed
    @param  $user - user information if logged in, false otherwise
    @param  $moduleID - module ID of the module to create an <li> for in this call
         WARNING: $moduleID is for function-internal use only. Leave null when calling externally.
     @return - string of HTML describing the tree with unordered lists
*/
function getTreeHTML($rootID, $currentID, $user = FALSE, $moduleID = NULL) {
  // i.e. this is the first call for this tree
  if ($moduleID == NULL) {
    $moduleID = $rootID;
  }  
  
  $output = "";
  
  // first call,  so begin tree will <ul>
  if ($rootID == $moduleID) {
    $output .= "<ul>\n";
  }
  
  $link = ""; // the link (e.g. <a href="...">) this li should contain
  $href = ""; // the href for the link (e.g. <a href="$href">)
  $inner = ""; // the inner HTML for the link (e.g. <a>$inner</a>)
  $children = array(); // module's children
  $canUserView = FALSE;
  
  if ($moduleID == REPOSITORY_ID) {
    $href = 'index.php';
    $inner = $GLOBALS['REPOSITORY_TREE_NAME'];
    $hierarchyModules = getHierarchyModules();
	foreach ($hierarchyModules as $hierarchyModule) {
		$children[] = $hierarchyModule["moduleID"];
	}
	$canUserView = TRUE;
    
  } else {
    $module = getModuleByID($moduleID);
    
    $isValidModule = ($module !== FALSE || count($module) > 0);
    if ($isValidModule) {
      $canUserView = canUserViewModule($module, $user);
      $href = "viewModule.php?moduleID=".$moduleID."&root=".$rootID;
      $inner = $module["title"];
      $children = getChildren($moduleID);
    }
  }  
  
  $link = '<a';
  if ( hasMaterials($moduleID) ) {
    $link .= ' class="has-material" title="Has material"';
  }
  $link .= ' href="'.$href.'">'.$inner."</a>\n";
  
  // display the module if user can view it
  if ($canUserView) {
    // if this module is the one currently being viewed
    if ($moduleID == $currentID) {
      $output .= "<li class=\"current\" id=\"node".$moduleID."\">\n";    
    } else {
      $output .= "<li id=\"node".$moduleID."\">\n";
    }
    
    $output .= $link;
      
    if (count($children) > 0) {
      $output .= "<ul>\n";
      foreach ($children as $child) {
        $output .= getTreeHTML($rootID, $currentID, $user, $child);
      }
      $output .= "</ul>\n";
    }
    
    $output .= "</li>\n";
  }
  
  
  if ($rootID == $moduleID) {
    $output .= "</ul>\n";
  }
  
  return $output;
}


?>
