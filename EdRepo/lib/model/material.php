<?php
/****************************************************************************************************************************
 *    material.php - defines the model functions for materials
 *    ---------------------------------------------------------
 *
 *  Version: 1.0
 *  Author: Jon Thompson
 *
 ******************************************************************************************************************************/

require_once(__DIR__ . "/../backends/backend.php");
require_once(__DIR__ . "/model.php");

/* getMaterialByID($materialID) - Gets information about a single material given by a unique ID.
  @parm $materialID - The ID of the material to fetch.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error (not finding a material with the ID is not an error).
    Returns an array of the material parameters on success, or an empty array if no material was found. */
function getMaterialByID($materialID) {
  // ensure materialID is an integer
  $materialID = intval($materialID); 
  
  $conditions = array("MaterialID=$materialID");
  $result = dataRead("materials", $conditions);
  
  if ($result === FALSE) {
    return FALSE;
  } elseif (empty($result)) {
    return array();
  }
  
  $row = $result[0];
  
  $material=array("materialID"=>$row["MaterialID"], "name"=>$row["Name"], "type"=>$row["Type"], "content"=>$row["Content"], "readableFileName"=>$row["ReadableFileName"], "dateTime"=>$row["DateTime"], "format"=>$row["Format"]);
  
  return $material;
}

/* searchMaterials($spearchParameters) - Searches all materials for those matching the specified search parameters.
  @parm $searchParameters - An associative array of parameters to search by.  Keys are the parameter, values are the value of the parameter.  
    Unknown or unsupported search parameters are silently ignored.
  @return - Returns "NotImplimented" if the back-end does not support search materials.
    Returns FALSE on any error (not finding any matching materials or unsupported parameters are not considered errors).
    Returns an associative array of results matching the parameters given on success, or an empty array if no results are found. */
function searchMaterials($searchParameters) {
  $conditions = array();
  if(isset($searchParameters["absoluteDate"]) && $searchParameters["absoluteDate"]!=="*") {
    $conditions[] = "materials.DateTime == '".$searchParameters["absoluteDate"];

  } else {
    if(isset($searchParameters["minDate"]) && $searchParameters["minDate"]!=="*") {
      /* Start by converting whatever date that came in into a format suitable for MySQL. */
      $date = strftime("%Y-%m-%d %H:%M:%S_" ,strtotime($searchParameters["minDate"]));
      $dateEnd = strpos($date, "_");
      $date = substr($date, 0, $dateEnd);
      $conditions[] = "materials.DateTime >= '".$date."'";
    }
    if(isset($searchParameters["maxDate"]) && $searchParameters["maxDate"]!=="*") {
      $date = strftime("%Y-%m-%d %H:%M:%S_" ,strtotime($searchParameters["maxDate"]));
      $dateEnd = strpos($date, "_");
      $date = substr($date, 0, $dateEnd);
      $conditions[] = "materials.DateTime <= '".$date."'";
    }
  }
  
  $result = dataRead("materials", $conditions);
  
  if($result===FALSE) {
    return FALSE;
  }
  
  /* Create an array of all matching material IDs. */
  $materialIDs = array();
  foreach($result as $row) {
    $materialIDs[]=$row["MaterialID"];
  }
  
  /* Loop through all the material IDs and get the info for the matching material and put it in the $results array. */
  $results=array();
  for($i=0; $i<count($materialIDs); $i++) {
    $results[]=getMaterialByID($materialIDs[$i]);
  }
  
  return $results;
}

/* createMaterial($content, $type, $title, $rights, $language, $publisher, $description, $creator, $format) - Adds a material with the specified information 
    to the system.  This will only add material metadata.  If the actual material resides within the system (a local file, not a URL), than the 
    material must also be uploaded to the system with storeMaterialLocally().
      NOTE: When storing materials locally, it is _STROGNLY_ advised to use storeMaterialLocally() BEfORE createMaterial, otherwise it is difficult to 
        impossible to know the proper $content!!
  @parm $content - A link which indicates how to actually retrieve that material.  If the material is to be stored locally, this should be a 
    suitable path name to a file as returned by storeMaterialLocally().  If the material resides outside the system (for example, on a video sharing site, 
    or web site), this should be the URL to the material.  Links to externally-hosted materials MUST begin with the protocal (http://, ftp:// etc).
  @parm type - The type of link to make.  Either "LocalFile" (the source is stored within the system in a file), or "ExternalURL" (the source is stored
    somewhere remotely, accessed by a URL).
  @parm $readableFileName - Used only if $type is "LocalFile".  If it is, than this parameter specifies a human readable file name for the file 
    being uploaded.  Ignored if the link type is not "LocalFile".
  @parm $type - The type of the material.  Types must come from the DCMI types published on dublincore.org
  @parm $title - A descriptive title for the material.
  @parm $rights - A rights statement for the material.  It is suggested to either include a link to a rights statement or liscense, or include the 
    statement or liscense here.
  @language - The language of the material.
  @description - A description of the material.
  @creator - The creator of the material.  This is the material's author, and not necessarily the uploader of the material.
  @parm $format - MIME type of file (if local file)
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.
    Returns a material ID on success.  This material ID uniquely identifies the material in the system. */
function createMaterial($content, $type, $readableFileName, $name, $format) {
  //If the link type is a file stored locally, we need to provide a human readable file name
  $readableFileName = ($type=="LocalFile") ? $readableFileName : "";
  
  $fields = array(
    "Content" => $content,
    "Type" => $type,
    "Name" => $name,
    "Format" => $format,
    "ReadableFileName" => $readableFileName
  );
  
  $materialID = dataCreate("materials", $fields);
  
  return $materialID;
}

/* attatchMaterialToModule($materialID, $moduleID) - Links a material to a module.  This will make a material appear when viewing a module.
  @parm $materialID - The ID of the material to attatch to a module.
  @parm $moduleID - The module to attatch the material to.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.
    Returns TRUE if the material was successfully attatched to the module. */
function attatchMaterialToModule($materialID, $moduleID) {
  $fields = array("ModuleID" => $moduleID, "MaterialID" => $materialID);
  $result = dataCreate("modulematerialslink", $fields);
  
  if($result===FALSE) {
    return FALSE;
  }
  
  return TRUE;
}

/* deattatchMaterialFromModule($materialID, $moduleID) - Removes a material attatchment from a module without actually deleting the material.  In most 
    cases, it is probably preferable to instead just delete the material.
  @parm $materialID - The ID of the material to de-attatch from a module.
  @parm $moduleID - The ID of the module to de-attatch the material from.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on error.
    Returns TRUE on success. */
function deattatchMaterialFromModule($materialID, $moduleID) {
  $conditions = array("ModuleID=$moduleID", "MaterialID=$materialID");
  return dataDelete("modulematerialslink", $conditions);
}

/* getAllMaterialsAttatchedToModule($moduleID) - Gets a list of all materials attatched to a module.
  @parm $moduleID - The ID of the module to get attatched modules of.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.  Not finding a module with the specified ID _IS_ considered an error.
    Returns a numerically indexed array of material IDs on success.  An empty array indicates no materials are attached to the module. */
function getAllMaterialsAttatchedToModule($moduleID) {
  $result = dataRead("modulematerialslink", array("ModuleID = $moduleID"));
  if($result===FALSE) {
    return FALSE;
  }
  
  $results=array();
  foreach($result as $row) {
    $results[] = $row["MaterialID"];
  }
  
  return $results;
}

/* getAllModulesAttatchedToMaterial($materialID) - Returns a list of all modules attatched to a material.
  @parm $materialID - The ID of the material to check for attached modules.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.  Not finding a material with the specified ID _IS_ considered an error.
    Returns a numerically indexed array of modules attatched to the material on success.  An empty array indicates no modules are attached to the 
      material (in other words, this is an orphan material).*/
function getAllModulesAttatchedToMaterial($materialID) {
  $result = dataRead("modulematerialslink", array("MaterialID = $materialID"));
  if($result===FALSE) {
    return FALSE;
  }
  
  $results=array();
  foreach($result as $row) {
    $results[] = $row["ModuleID"];
  }
  
  return $results;
}

/* storeMaterialLocally($uploadedFileReference, $storageDir) - Stores a material file locally, returning a link to the laterial suitable for use with the back-end.
  @param $moduleID  -  Module for which this material is being stored (used to create subfolder)
  @parm $uploadedFileTempReference - A reference to the FILE structure containing information about the file.  This can be found with $_FILES['name'] 
    where 'name' is the name of the HTML form element which stored the file.
  @parm $storageDir - The directory to store materials in.  This should probably be the $MATERIAL_STORAGE_DIR variable from the master collection
    configuration, and needs to end with a slash.
  @return - Returns "NotImplimented" if this feature is not implimented by the back-end.
    Returns FALSE on any error storing the material.
    Returns a link to the material on success.  This link may be used with createMaterial and is suitable for discovering the material in the system. */
function storeMaterialLocally($moduleID, $uploadedFileReference, $storageDir) {
  if($uploadedFileReference["error"]>0) { //This indicates a file upload error from PHP.
    return FALSE;
  }
  if(!is_uploaded_file($uploadedFileReference["tmp_name"])) {
    //return FALSE;  
	return $moduleID."/".$uploadedFileReference["name"];
  }
  if(!validateFileType($uploadedFileReference["type"]) || !validateFileSize($uploadedFileReference["size"])) { //Make sure the file type and size is okay.
    return FALSE;
  }
  
  // Changed to store materials as {material-directory}/{module-id}/{original-filename}    Jon Thompson 8/26/2011
  if ( !is_dir($storageDir.$moduleID) ) {
    mkdir($storageDir.$moduleID, 0770);
  }
  $filenameToStore = $moduleID."/".$uploadedFileReference["name"];
  
  // if file with filename exists already, return an error so we don't overwrite
  if(file_exists($storageDir.$filenameToStore)) { 
    return "FileExists";
  }
  
  $result=move_uploaded_file($uploadedFileReference["tmp_name"], $storageDir.$filenameToStore);
  if($result===FALSE) {
    return FALSE;
  }
  return $filenameToStore;
}
/*deleteSameMaterialFromDB($materialID, $type, $content, $fileName) 


*/
function deleteSameMaterialFromDB($materialID, $type, $content, $fileName) {
	global $DB_DATABASE, $DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD; 
	$connect = mysql_connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD); 
	mysql_select_db($DB_DATABASE, $connect); 
	
	$query = "DELETE FROM `materials` WHERE `MaterialID`!= '$materialID' AND `Type`='$type' AND `Content`='$content' AND `ReadableFileName`='$fileName' "; 
 
	$result = mysql_query($query);
	
	mysql_close($connect);  
	
	if ($result != FALSE) {
		return $result." deleted!"; 
	}
	else {
		return $result." did not delete"; 
	}
}

/* editMaterialByID($moduleID) - Updates a material's information in the system.
  @parm $materialID - The ID of the material to edit.
  @parm $content - Links the material to an actual file containing the actual material.  Either a URL to an external reference or a local path as 
    returned by storeMaterialLocally().
  @type - Either "LocalFile" if the material is a file stored locally on the system, or "ExternalURL" if the material is a file stored outside the
    system (ex. on YouTube) and accessible through a URL.
  @readableFileName - A human-readable file name for the material.  This name will be suggested when users download the material.
  @parm $name - The title of the material.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.
    Returns the module ID of the resulting module on success.  This is should be the same as the materialID initially given. */
function editMaterialByID($materialID, $content, $type, $readableFileName, $name) {
  $fields = array(
    "Content" => $content,
    "Type" => $type,
    "ReadableFileName" => $readableFileName,
    "Name" => $name
  );
  $conditions = array("MaterialID=$materialID");
  $result = dataUpdate("materials", $fields, $conditions);
  if($result===FALSE) {
    return FALSE;
  }
  return $materialID;
}

/*  renameMaterialByID($materialID, $name) - Gives the users the ability to rename the material by their ID
  @param - $materialID - the material ID which the user would like to rename
  @param - $name - the new name of the material they would like 
  @returns True if the renaming function completed 
*/
function renameMaterialByID($materialID, $name){
	$fields = array("Name" => $name); 
	$conditions = array("MaterialID=$materialID"); 
	$result = dataUpdate("materials", $fields, $conditions); 
	if ($result){
		return TRUE; 
	}
}

/* removeMaterialsByID($materialIDs, $storageDir) - Removes one or more materials based on their unique material ID.  This removes both the metadata and, if the 
    material is stored locally, the actual material as well (unless it is in use by another material/module).
  @parm $materialIDs - A numerically indexed array of the materials to remove.  The value of each index should correspond to a material ID 
    which uniquely identifies a material to remove.
  @parm $storageDir - The directory containing the sotred materials.  This should probably be the $MATERIAL_STORAGE_DIR from the 
    collection's master configuration, and needs to end with a slash.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.  Not finding a material ID is not considered an error.
    Returns TRUE on success. */
function removeMaterialsByID($materialIDs, $storageDir) {
  for($i=0; $i<count($materialIDs); $i++) {
    /* Get the material to delete. */
    $material = getMaterialByID($materialIDs[$i]);
    if (!$material || $material == "NotImplimented") {
      continue;
    }
    
    /* If the link type is a local file, check to see if the file is used by any other materials.  If it isn't, delete the file. */
    if($material["type"] == "LocalFile") {
      $conditions = array(
        "Content='".$material["content"]."'", 
        "MaterialID!=".$materialIDs[$i]
      );
      $result = dataRead("materials", $conditions);
      if(count($result) <= 0) { //If true, the material file isn't used by any other modules.  Delete it.
        $result = unlink($storageDir.$material["content"]);
      }
    }
    
    /* Delete the material metadata. */
    $result = dataDelete("materials", array("MaterialID=".$materialIDs[$i]));
  }
  
  return TRUE;
}

/* addCommentAndRatingToMaterial($materialID, $subject, $comment, $rating) - Adds a comment and a rating to a material.
  @parm $materialID - The ID of the material which is being commented and rated on.
  @parm $author - The name of the person leaving the rating.
  @parm $subject - The subject/title of the comment.
  @parm $rating - The rating of the material.
  @return - Returns "NotImplimented" if this feature is not implimented by the back-end.
    Returns FALSE on any error.
    Returns TRUE on successful addition of comment and rating.*/
function addCommentAndRatingToMaterial($materialID, $author, $subject, $comment, $rating) {
  /* Check if the materialID given exists.  If it doesn't, return an error. */
  $matTest=getMaterialByID($materialID);
  if($matTest===FALSE || $matTest=="NotImplimented" || count($matTest)<=0) {
    return FALSE;
  }
  $result=settype($rating, "integer"); //Convert the rating given to an integer type.
  if($result===FALSE) { //Indicates an error converting to an integer.
    return FALSE;
  }
  
  /* Add the rating and comments for the material to the database. */
  $fields = array(
    "MaterialID" => $materialID,
    "Comments" => $comment,
    "Subject" => $subject,
    "Rating" => $rating,
    "Author" => $author
  );
  $result = dataCreate("materialcomments", $fields);
  if($result===FALSE) { //Check for errors on updating rating
    return FALSE;
  }
  
  return TRUE;
}

/* getMaterialRatingsAndComments($materialID) - Gets all ratings and comments attatched to a material.
  @parm $materialID - The ID of the material to get ratings/comments of.
  @return - Returns "NotImplimented" if this feature is not supported by the backend.
    Returns FALSE on any error.
    Returns a 2D array on success, with the first dimension numerically indexed, with each index referring to a rating, and the second dimenstion 
      an associative array with keys "subject", "comment", "date", "rating", and "author". */
function getMaterialRatingsAndComments($materialID) {
  $result = dataRead("materialcomments", array("MaterialID=$materialID"));
  if($result===FALSE) {
    return FALSE;
  }
  $materials=array(); //Will hold details of all material ratings/comments found.
  foreach($result as $row) {
    $materials[] = array(
      "subject"=>$row["Subject"], 
      "comment"=>$row["Comments"], 
      "date"=>$row["Date"], 
      "rating"=>$row["Rating"], 
      "author"=>$row["Author"]
    );
  }
  
  return $materials;
}

/* hasMaterials() - determines if a module has materials attached to it
    @param $moduleID - module ID of module to check for materials
    @return - TRUE if module has materials, FALSE otherwise
*/
function hasMaterials($moduleID) {
  $materials = getAllMaterialsAttatchedToModule($moduleID);
  
  if (!$materials || count($materials) <= 0) {
    return FALSE;
  }
  
  return TRUE;
}


?>