<?php
/****************************************************************************************************************************
 *    tag.php - defines the model functions for tags (e.g. authors, topics, categories, etc.)
 *    ---------------------------------------------------------
 *    Includes defnitions for:
 *     - Free-Text Tags (e.g. authors, topics, etc.)
 *     - Controlled-Vocabulary Tags (e.g. categories, types, etc.)
 *     - References (internal and external)
 *
 *  Version: 1.0
 *  Author: Jon Thompson
 *
 ******************************************************************************************************************************/

require_once(__DIR__ . "/../backends/backend.php");
# depends on module functions
require_once(__DIR__ . "/model.php");

/* Free-Text Tags **********************************************************/

/* setModuleAuthors($moduleID, $authors) - Sets a module's authors to the given authros.
  @parm $moduleID - The ID of the module to set authors for.
  @parm $authors - An array of author names to set for the module.  An empty array clears all authors from the module.
  @return - Returns "NotImplimented" if this feature is not supported by the backend.
    Returns FALSE on any error.
    Returns TRUE on success. */
function setModuleAuthors($moduleID, $authors) {
  //Start by clearing all authors from the module.
  $result = dataDelete("moduleauthors", array("ModuleID=".$moduleID));
  if($result===FALSE) {
    return FALSE;
  }
  
  //Now, loop through any names given and add them.
  for($i=0; $i<count($authors); $i++) {
    $fields = array(
      "ModuleID" => $moduleID,
      "AuthorName" => $authors[$i]
    );
    
    $result = dataCreate("moduleauthors", $fields);
    if ($result === FALSE) {
      return FALSE;
    }
  }
  
  return TRUE;
}

/*  getModuleAuthors($moduleID) - Returns a list of all authors attatched to a module.
  @parm $moduleID - The ID of the module to check for authors.
  @return - Returns "NotImplimented" if this feature is not supported by the backend.
    Returns FALSE on any error.
    Returns an array of names on success.  An empty array indicates no authors were found. */
function getModuleAuthors($moduleID) {
  $result = dataRead("moduleauthors", array("ModuleID='".$moduleID."'"));
  if($result===FALSE) {
    return FALSE;
  }
  
  $authors=array();
  foreach($result as $row) {
    $authors[]=$row["AuthorName"];
  }
  
  return $authors;
}

/* setModuleTopics($moduleID, $topics) - Sets ALL topics for a module, and erases all topics for a module not specified.
  @parm $moduleID - The ID of the module to set topics for.
  @parm $topics - A 2D array of topics to set for the module.  The first dimension should be numerically indexed, with each index referring to a topic, 
    and the second dimensions should be an associative array with key "text", referring to the text of the topic.  If supported, this function 
    will store topics in a sensible order which is preserved when read back.  The order is the same as the order of the topics in the array: the 
    first topic in the array is the first topic in order, etc.  The front-end will, if possible, attempt to display topics in the same order they 
    are saved.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.
    Returns TRUE on success. */
function setModuleTopics($moduleID, $topics) {
  //Clear any topics for this module.
  $result = dataDelete("topics", array("ModuleID=".$moduleID)); 
  if($result===FALSE) {
    return FALSE;
  }
  
  //Loop through every topic given and save it.
  for($i=0; $i<count($topics); $i++) { 
    $fields = array (
      "ModuleID" => $moduleID,
      "TopicText" => $topics[$i]["text"],
      "OrderID" => $i
    );
    $result = dataCreate("topics", $fields);
    if($result===FALSE) {
      return FALSE;
    }
  }
  
  return TRUE;
}

/* getModuleTopics($moduleID) - Gets all topics associated with a module.  This function should attempt to order topics in a sensible way if possible.
  @parm $moduleID - The ID of the module to get topics of.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.  Not finding any topics is not considered an error.
    Returns a 2D array on success, with the first dimension numerically indexed, with each index being a topic, and the second dimension being an 
      associative array of information about the topic (keys "orderID" and "text").  Returns an empty array if no topics are found for the module. */
function getModuleTopics($moduleID) {
  $result = dataRead("topics", array("ModuleID='".($moduleID)."'"));
  if($result===FALSE) {
    return FALSE;
  }
  
  $foundTopics=array();
  foreach($result as $row) {
    $topic=array("orderID"=>$row["OrderID"], "text"=>$row["TopicText"]);
    $foundTopics[]=$topic;
  }
  
  // sort the topics by OrderID
  usort($foundTopics, function($a, $b) { 
    return $a["orderID"] - $b["orderID"];
  });
  
  return $foundTopics;
}

/* setModuleObjectives($moduleID, $objectives) - Sets ALL objectives for a module, and erases all objectives for a module not specified.
  @parm $moduleID - The ID of the module to set objectives for.
  @parm $objectives - A 2D array of objectives to set for the module.  The first dimension should be numerically indexed, with each index referring to an 
    objective, and the second dimensions should be an associative array with key "text", referring to the text of the objective.  If supported, this 
    function will store objectives in a sensible order which is preserved when read back.  The order is the same as the order of the objectives in the 
    array: the first objective in the array is the first orbjective in order, etc.  The front-end will, if possible, attempt to display objectives in 
    the same order they are saved.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.
    Returns TRUE on success. */
function setModuleObjectives($moduleID, $objectives) {  
  //Clear any objectives for this module.
  $result = dataDelete("objectives", array("ModuleID=".$moduleID)); 
  if($result===FALSE) {
    return FALSE;
  }
  
  //Loop through every objective given and save it.
  for($i=0; $i<count($objectives); $i++) { 
    $fields = array (
      "ModuleID" => $moduleID,
      "ObjectiveText" => $objectives[$i]["text"],
      "OrderID" => $i
    );
    $result = dataCreate("objectives", $fields);
    if($result===FALSE) {
      return FALSE;
    }
  }
  
  return TRUE;
}

/* getModuleObjectives($moduleID) - Gets all objectives associated with a module.  This function should attempt to order objectives in a sensible way if 
    possible.
  @parm $moduleID - The ID of the module to get objectives of.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.  Not finding any objectives is not considered an error.
    Returns a 2D array on success, with the first dimension numerically indexed, with each index being an objective, and the second dimension being an 
      associative array of information about the objective (keys "orderID" and "text").  Returns an empty array if no objectives are found for the 
      module. */
function getModuleObjectives($moduleID) {  
  $result = dataRead("objectives", array("ModuleID='".($moduleID)."'"));
  if($result===FALSE) {
    return FALSE;
  }
  
  $foundObjectives=array();
  foreach($result as $row) {
    $objective=array("orderID"=>$row["OrderID"], "text"=>$row["ObjectiveText"]);
    $foundObjectives[]=$objective;
  }
  
  // sort the objectives by OrderID
  usort($foundObjectives, function($a, $b) { 
    return $a["orderID"] - $b["orderID"];
  });
  
  return $foundObjectives;
}

/* setModulePrereqs($moduleID, $prereqs) - Sets ALL prereqs for a module, and erases all prereqs for a module not specified.
  @parm $moduleID - The ID of the module to set prereqs for.
  @parm $prereqs - A 2D array of prereqs to set for the module.  The first dimension should be numerically indexed, with each index referring to a 
    prereq, and the second dimensions should be an associative array with key "text", referring to the text of the prereq.  If supported, this 
    function will store prereqs in a sensible order which is preserved when read back.  The order is the same as the order of the prereqs in the 
    array: the first prereq in the array is the first prereq in order, etc.  The front-end will, if possible, attempt to display prereqs in 
    the same order they are saved.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.
    Returns TRUE on success. */
function setModulePrereqs($moduleID, $prereqs) {  
  //Clear any prereqs for this module.
  $result = dataDelete("prereqs", array("ModuleID=".$moduleID)); 
  if($result===FALSE) {
    return FALSE;
  }
  
  //Loop through every prereq given and save it.
  for($i=0; $i<count($prereqs); $i++) { 
    $fields = array (
      "ModuleID" => $moduleID,
      "PrerequisiteText" => $prereqs[$i]["text"],
      "OrderID" => $i
    );
    $result = dataCreate("prereqs", $fields);
    if($result===FALSE) {
      return FALSE;
    }
  }
  
  return TRUE;
}

/* getModulePrereqs($moduleID) - Gets all prereqs associated with a module.  This function should attempt to order prereqs in a sensible way if possible.
  @parm $moduleID - The ID of the module to get prereqs of.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.  Not finding any prereqs is not considered an error.
    Returns a 2D array on success, with the first dimension numerically indexed, with each index being an prereqs, and the second dimension being an 
      associative array of information about the prereqs (keys "orderID" and "text").  Returns an empty array if no prereqs are found for the 
      module. */
function getModulePrereqs($moduleID) {  
  $result = dataRead("prereqs", array("ModuleID='".($moduleID)."'"));
  if($result===FALSE) {
    return FALSE;
  }
  
  $foundPrereqs=array();
  foreach($result as $row) {
    $prereq=array("orderID"=>$row["OrderID"], "text"=>$row["PrerequisiteText"]);
    $foundPrereqs[]=$prereq;
  }
  
  // sort the prereqs by OrderID
  usort($foundPrereqs, function($a, $b) { 
    return $a["orderID"] - $b["orderID"];
  });
  
  return $foundPrereqs;
}


/* References **************************************************************/

/* getExternalReferences($moduleID) - Returns a list of all references a module as made to external sources.
  @parm $moduleID - The ID of the module to check for external references.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.  Not finding any external references is not considered an error.
    On success, returns a 2D array of references, with the first dimenstion numerically indexed and referring to a reference, and the second 
      dimension an associative array with keys "description", "order", and "link".  Returns an empty array if no references were found. */
function getExternalReferences($moduleID) {
  $result = dataRead("otherresources", array("ModuleID=$moduleID"));
  if($result===FALSE) {
    return FALSE;
  }
  $references=array();
  foreach($result as $row) {
    $references[] = array(
      "description"=>$row["Description"],
      "order"=>$row["OrderID"],
      "link"=>$row["ResourceLink"]
    );    
  }
  
  // sort the references by OrderID
  usort($references, function($a, $b) { 
    return $a["order"] - $b["order"];
  });
  
  return $references;
}

/* setExternalReferences($moduleID, $references) - Sets all the external references for a module, and clears any external references not specified.
  @parm $moduleID - The ID of the module to set external references for.
  @parm $references - A 2D array with external references.  The first dimenstion is numerically indexed, with each index indicating a new external 
    reference.  The second dimension is an associative array with keys "description" and "link".  The back-end will attempt to store the external 
    references in the same order they are given (based on the first dimension of the $references parameter), so that setExternalReferences() will
    return the references in the same order they were passed.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.
    Returns TRUE on successful setting of external references. */
function setExternalReferences($moduleID, $references) {
  //Clear any external references for this module.
  $result = dataDelete("otherresources", array("ModuleID=$moduleID")); 
  if($result===FALSE) {
    return FALSE;
  }
  //Loop through every topic given and save it.
  for($i=0; $i<count($references); $i++) { 
    $fields = array (
      "ModuleID" => $moduleID,
      "Description" => $references[$i]['description'],
      "ResourceLink" => $references[$i]['link'],
      "OrderID" => $i
    );
    $result = dataCreate("otherresources", $fields);
    if($result===FALSE) {
      return FALSE;
    }
  }
  
  return TRUE;
}

/* getInternalReferences($moduleID) - Returns a list of all references the specified module makes to other modules.
  @parm $moduleID - The ID of the module to check for references to other modules.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.  Not finding any references is not considered an error.
    On success, returns a 2D array, with the first dimension numerically indexed and referring to a reference, and the second dimension an
      associative array with keys "description", "referencedModuleID", and "order".  Returns an empty array if no references were found. */
function getInternalReferences($moduleID) {
  $result = dataRead("seealso", array("ModuleID=$moduleID"));
  if($result===FALSE) {
    return FALSE;
  }
  $references=array();
  foreach($result as $row) {
    $references[] = array(
      "description" => $row["Description"], 
      "order" => $row["OrderID"],
      "referencedModuleID" => $row["ReferencedModuleID"]
    );    
  }
  
  // sort the references by OrderID
  usort($references, function($a, $b) { 
    return $a["order"] - $b["order"];
  });
  
  return $references;
}

/* setInternalReferences($moduleID, $references) - Sets all internal references for a module (other modules referenced by the module) and removes 
    any references made which are not specified.
  @parm $moduleID - The ID of the module making the reference.
  @parm $references - A 2D array of references, with the first dimension being numerically indexed, with each index referring to a reference, and 
    the second dimenstion being an associative array with keys "description" and "referencedModuleID" (with the value for the key 
    "referencedModuleID" containing a valid moduleID for the module being referenced).  This function will attempt to store the references in the 
    same order they are passed in the first dimension of this parameter, so that they will be read back by getInternalReferences() in the same
    order they are passed to this function.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.
    Returns TRUE on successful setting of references to other modules.
  NOTE:  This function does not directly check to make sure module IDs given in $references are actually valid.  If invalid IDs are given, this 
    function may return either TRUE or FALSE, and if it returns TRUE than the invalid reference will have been saved to the storage back-end.
    Therefore, it is suggested front-ends check that IDs to be referenced are valid before passing them to this function. */
function setInternalReferences($moduleID, $references) {
  //Clear any internal references made by this module.
  //$result = dataDelete("seealso", array("ModuleID=$moduleID")); 
  //if($result===FALSE) {
  //  return FALSE;
  //}
  //Loop through every topic given and save it.
  	$errorOn = array();
	for ($a=0; $a < count($references); $a++) {
		$result = checkSameReference($moduleID, $references[$a]['referencedModuleID']);  
		$count = 0;
		for($i=0; $i<count($result); $i++) {  
			$result = checkSameReference($moduleID, $references[$a]['referencedModuleID']); 
			$checked = $result[$i]; 
			settype($checked, "integer"); 
			$entered = $references[$a]["referencedModuleID"]; 
			settype($entered, "integer"); 
			if ($checked == $entered) {
				$count++;
			}
		}
		if ($count != 0) { 
			array_push ($errorOn, $references[$a]['referencedModuleID']); 
		}
		else {
			$fields = array(
				  "ModuleID" => $moduleID,
				  "Description" => $references[$a]['description'],
				  "ReferencedModuleID" => $references[$a]['referencedModuleID'],
				  "OrderID" => $a
				);
				$result = dataCreate("seealso", $fields);
				if($result===FALSE) {
				  return FALSE; 
				}
		}
	}
	if (count($errorOn) == 0) {
		return TRUE;
	}
  }
  



/* Controlled-Vocabulary Tags - Categories **********************************/

/* createCategory($name, $description) - Creates a new category, which modules may add themselves to.
  @parm $name - The category name.
  @parm $description - A description for the category.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.
    Returns a CategoryID on success, which uniquely identifies the category. */
function createCategory($name, $description) {
  $fields = array("Name" => $name, "Description" => $description);
  $categoryID = dataCreate("categories", $fields);
  return $categoryID;
}

/* removeCategory($categoryID) - Removes the category with the specified ID.  This function should also remove any modules from the deleted category.
  @parm $categoryID - The ID of the category to remove.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.
    Returns TRUE on success. */
function removeCategory($categoryID) {  
  //Delete the category.
  $result = dataDelete("categories", array("CategoryID=".$categoryID));
  if($result===FALSE) {
    return FALSE;
  }
  
  //Remove any modules from the deleted categories
  $result = dataDelete("modulecategories", array("CategoryID=".$categoryID));
  if($result===FALSE) {
    return FALSE;
  }
  
  return TRUE;
}
/* editCategory($categoryID, $name, $description)
	@params - $categoryID - ID of category to edit 
			- $name - the name you want to change the category name to. 
			- $description - the description you want to change the category descriptions to. 

*/
function editCategory($categoryID, $name, $description){
	$fields =  array ("Name" => $name, "Description" => $description);
	$conditions = array ("CategoryID=".$categoryID); 
	$result = dataUpdate("categories", $fields, $conditions);  
	if ($result===FALSE){
		return FALSE; 
	}
	
	return TRUE; 
}

/* getCategoryById() - Returns information about the category with the specified ID.
  @parm $categoryID - The ID of the category to look up.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.  Not finding the specified category IS considered an error.
    On success, returns an associative array with information about the category, with keys "name", "ID", and "description". */
function getCategoryById($categoryID) {
  $result = dataRead("categories", array("CategoryID=".$categoryID));
  if($result===FALSE || count($result) != 1) {
    return FALSE;
  }
  
  $row = $result[0];
  $name = $row["Name"];
  $description = $row["Description"];
  return array("ID"=>$categoryID, "name"=>$name, "description"=>$description);
}

/* getAllCategories() - Returns all categories.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.
    On success, returns a 2D array, with the first element numerically indexed and indicating a category, and the second dimension the same as that 
      returned by getCategoryByID(). */
function getAllCategories() {
  $result = dataRead("categories");
  if($result===FALSE) {
    return FALSE;
  }
  
  $categories=array();
  foreach($result as $row) {
    $categories[]=getCategoryByID($row["CategoryID"]);
  }
  
  return $categories;
}

/* setModuleCategories($moduleID, $categoryIDs) - Sets a module's category(a) to the category(a) with the specified ID(a).  This function will also 
    remove a module from any categories not identified by the specified category ID.
    Note:  It is advised that the back-end have some sort of default "other" or dummy category for modules which do not specify a category, since there 
      is no method to remove a module from a category.
  @parm $moduleID - The ID of the module to put into a category.  Passing an empty string ("") will remove all categories associated with the module.
  @parm $categoryIDs - An array of category IDs to put the module into.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.
      Back-ends are encouraged to ensure the given module ID and category ID are valid, but this is not required, espcially for back-ends which do not 
        actually have category IDs, but instead treat each category IDs as category names.
    Returns TRUE on success. */
function setModuleCategories($moduleID, $categoryIDs) {
  //Make sure all the category IDs given actually exist.
  for($i=0; $i<count($categoryIDs); $i++) {
    $result=getCategoryById($categoryIDs[$i]);
    if(!$result) {
      return FALSE;
    }
  }
  
  //Remove any references to the module in any categories.
  $result = dataDelete("modulecategories", array("ModuleID=".$moduleID)); 
  
  //Add the module to each category
  for($i=0; $i<count($categoryIDs); $i++) {
    $fields = array("ModuleID" => $moduleID, "CategoryID" => $categoryIDs[$i]);
    $result = dataCreate("modulecategories", $fields); 
    if($result===FALSE) {
      return FALSE;
    }
  }
  
  return TRUE;
}

/* getModuleCategoryIDs($moduleID) - Returns the ID(s) of the category(s) the specified module is in.
  @parm $moduleID - The ID of the module to look for the category of.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on error.
    Returns an array category IDs on success.  An empty array indicates the module is not in any categories. */
function getModuleCategoryIDs($moduleID) {
  $result = dataRead("modulecategories", array("ModuleID=".$moduleID));
  if($result===FALSE) {
    return FALSE;
  }
  
  $categoryIDs=array();
  foreach($result as $row) {
    $categoryIDs[]=$row["CategoryID"];
  }
  
  return $categoryIDs;
}


/* Controlled-Vocabulary Tags - Types ***************************************/

/* createType($name) - Creates a new type, which modules may add themselves to.
  @parm $name - The type name.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.
    Returns a TypeID on success, which uniquely identifies the type. */
function createType($name) {
  if (!$name) {
    return FALSE;
  }

  $fields = array("Name" => $name);
  return dataCreate("type", $fields);
}

/* removeType($typeID) - Removes the type with the specified ID.  This function should also remove any modules from the deleted type.
  @parm $typeID - The ID of the type to remove.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.
    Returns TRUE on success. */
function removeType($typeID) {
  //Delete the type.
  $result = dataDelete("type", array("TypeID=".$typeID)); 
  if($result===FALSE) {
    return FALSE;
  }
  //Remove any modules from the deleted types
  $result = dataDelete("moduletype", array("TypeID=".$typeID)); 
  if($result===FALSE) {
    return FALSE;
  }
  return TRUE;
}

/* getTypeById() - Returns information about the type with the specified ID.
  @parm $typeID - The ID of the type to look up.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.  Not finding the specified type IS considered an error.
    On success, returns an associative array with information about the type, with keys "name", "ID",*/
function getTypeById($typeID) {
  $result = dataRead("type", array("TypeID=$typeID"));
  if($result===FALSE || count($result)<=0) {
    return FALSE;
  }
  $row = $result[0];
  $name = $row["Name"];
  return array("ID"=>$typeID, "name"=>$name);
}

/* getAllTypes() - Returns all types.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.
    On success, returns a 2D array, with the first element numerically indexed and indicating a type, and the second dimension the same as that 
      returned by getTypeByID(). */
function getAllTypes() {
  $result = dataRead("type");
  if($result===FALSE) {
    return FALSE;
  }
  $types = array();
  foreach($result as $row) {
    $types[]=getTypeByID($row["TypeID"]);
  }
  return $types;
}

/* setModuleTypes($moduleID, $typeIDs) - Sets a module's type to the type with the specified ID.  This function will also 
    remove a module from any types not identified by the specified type ID.
    Note:  It is advised that the back-end have some sort of default "other" or dummy type for modules which do not specify a type, since there 
      is no method to remove a module from a type.
  @parm $moduleID - The ID of the module to put into a type.  Passing an empty string ("") will remove all types associated with the module.
  @parm $typeIDs - An array of type IDs to put the module into.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.
      Back-ends are encouraged to ensure the given module ID and type ID are valid, but this is not required, espcially for back-ends which do not 
        actually have type IDs, but instead treat each type IDs as type names.
    Returns TRUE on success. */
function setModuleTypes($moduleID, $typeIDs) {
  // make sure module exists
  if (!getModuleByID($moduleID)) {
    return FALSE;
  }
  // Remove duplicate type IDs
  $typeIDs = array_unique($typeIDs);
  //Make sure all the type IDs given actually exist.
  for($i=0; $i<count($typeIDs); $i++) {
    if(!getTypeByID($typeIDs[$i])) {
      return FALSE;
    }
  }
  //Remove any references to the module in any types.
  $result = dataDelete("moduletype", array("ModuleID=$moduleID"));
  for($i=0; $i<count($typeIDs); $i++) {
    $fields = array("ModuleID" => $moduleID, "TypeID" => $typeIDs[$i]);
    $result = dataCreate("moduletype", $fields);
    if($result===FALSE) {
      return FALSE;
    }
  }
  return TRUE;
}

/* getModuleTypeIDs($moduleID) - Returns the ID(s) of the type(s) the specified module is in.
  @parm $moduleID - The ID of the module to look for the type of.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on error.
    Returns an array type IDs on success.  An empty array indicates the module is not in any types. */
function getModuleTypeIDs($moduleID) {
  $result = dataRead("moduletype", array("ModuleID=$moduleID"));
  if($result===FALSE) {
    return FALSE;
  }
  
  $typeIDs=array();
  foreach($result as $row) {
    $typeIDs[]=$row["TypeID"];
  }
  return $typeIDs;
}


 
?>