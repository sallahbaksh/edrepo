<?php
/****************************************************************************************************************************
 *    module.php - defines the model functions for modules
 *    ---------------------------------------------------------
 *
 *  Version: 1.0
 *  Author: Jon Thompson
 *
 ******************************************************************************************************************************/

require_once(__DIR__ . "/../backends/backend.php");
require_once(__DIR__ . "/model.php");

/* getModuleByID($moduleID) - Gets information about a single module given by a unique ID.
  @parm $moduleID - The ID of the module to fetch.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error (not finding a module with the ID is not an error).
    Returns an array of the module parameters on success, or an empty array if no module was found. */
/** WARNING:
  The return keys "authorFirstName" and "authorLastName" are depricated!  Use the getModuleAuthors() and setModuleAuthors() functions to work with 
  module authors instead!
*/
function getModuleByID($moduleID) {
  // ensure moduleID is an integer
  $moduleID = intval($moduleID); 
  
  $conditions = array("ModuleID=$moduleID");
  $result = dataRead("module", $conditions);
  
  if ($result === FALSE) {
    return FALSE;
  } elseif(empty($result)) {
    return array();
  }
  $row = $result[0];
  $dateTime = $row["DateTime"];
  $description = $row["Description"];
  $educationLevel = $row["EducationLevel"];
  $language = $row["Language"];
  $minutes = $row["Minutes"];
  $authorComments = $row["AuthorComments"];
  $status = $row["Status"];
  $minimumUserType = $row["MinimumUserType"];
  $interactivityType = $row["InteractivityType"];
  $rights = $row["Rights"];
  $checkInComments = $row["CheckInComments"];
  $restrictions = $row["Restrictions"];
  $version = $row["Version"];
  $submitterUserID = $row["SubmitterUserID"];
  $baseID = $row["BaseID"];
  
  $conditions = array("BaseID=$baseID");
  $result = dataRead("modulebases", $conditions);
  if (!$result) {
    return FALSE;
  }
  $title = $result[0]["Title"];
  
  $conditions = array("UserID=$submitterUserID");
  $result = dataRead("users", $conditions);
  if (!$result) {
    return FALSE;
  }
  $authorFirstName = $result[0]["FirstName"];
  $authorLastName = $result[0]["LastName"];
  
  return array("moduleID"=>$moduleID, "title"=>$title, "submitterUserID"=>$submitterUserID, "authorFirstName"=>$authorFirstName, "authorLastName"=>$authorLastName, "dateTime"=>$dateTime, "description"=>$description, "language"=>$language, "educationLevel"=>$educationLevel, "minutes"=>$minutes, "authorComments"=>$authorComments, "status"=>$status, "minimumUserType"=>$minimumUserType,
  "interactivityType"=>$interactivityType, "rights"=>$rights, "checkInComments"=>$checkInComments, "restrictions"=>$restrictions, "version"=>$version, "baseID"=>$baseID );
}

/* searchModules($searchParameters) - Searches modules and returns results based on certain parameters.
  @parm $searchParameters - An associative array listing all search parameters.  The keys are the parameter type, and the values are the 
    text of the parameter.  For example, array("category"=>"Turtles", "author"=>"Jasper") would search for modules in the "Turtles" category 
    by author Jasper.  Note that unknown parameters (keys) are expected to be ignored silently.
  @return - Returns "NotImplimented" if no searching of any kind is supported.
    Returns FALSE on any error.
    Returns a 2D array on success.  The first dimension is numerically indexed, and the second dimension is an associative array with the keys 
      being the attributes of the matching modules, and the values being the text of the attributes (the structure being the same as getModulesByID() ).  
      Returns an empty array if no matching results were found. */
function searchModules($searchParameters) {
  if(count($searchParameters)>=1) {  
    $conditions = array();

    if(isset($searchParameters["title"]) && isset($searchParameters["titleStartsWith"])) { //One may not search by both "title" and "titleStartsWith".
      return FALSE;
    }
    
    if(isset($searchParameters["title"])) {
      $conditions[] = "modulebases.Title LIKE '%" . $searchParameters["title"] . "%'";
    }
    
    if(isset($searchParameters["titleStartsWith"])) { //This parameter is like searching by title, but instead of looking for the parameter given anywhere in the title, it is looked for only in the beginning of the title.  Useful for browsing.
      $conditions[] = "modulebases.Title LIKE '" . $searchParameters["title"] . "%'";
    }
    
    if(isset($searchParameters["userID"])) {
      $conditions[] = "module.SubmitterUserID='".$searchParameters["userID"]."' ";
    }
    
    //Limit results by status if a status is given and is isn't "*" (which would indicate we're to match all statuses, so no need to limit by them).
    if( isset($searchParameters["status"]) && 
        !empty($searchParameters["status"])
    ) {
      // convert single value to an array
      if ( count($searchParameters["status"]) == 1 && !is_array($searchParameters["status"]) ) {
        $searchParameters["status"] = array($searchParameters["status"]);
      }
      
      // if not selecting all (ie. "*"), filter with given statuses
      if ( !in_array("*", $searchParameters["status"]) ) {
        $statusSet = "(";
        foreach ($searchParameters["status"] as $status) {
          // if this isn't first item in array, add comma to set
          if ( $status != reset($searchParameters["status"]) ) {
            $statusSet .= ",";
          }
          $statusSet .= "'".$status."'";
        }
        $statusSet .= ")";
      
        $conditions[] = "module.Status IN ".$statusSet." ";
      }
    }
    
    if(isset($searchParameters["absoluteDate"]) && $searchParameters["absoluteDate"]!=="*") {
      $conditions[] = "module.Date == '".$searchParameters["absoluteDate"]."' ";
    } else {
      if(isset($searchParameters["minDate"]) && $searchParameters["minDate"]!=="*") {
        /* Start by converting whatever date that came in into a format suitable for MySQL. */
        $date = strftime("%Y-%m-%d %H:%M:%S_" ,strtotime($searchParameters["minDate"]));
        $dateEnd = strpos($date, "_");
        $date = substr($date, 0, $dateEnd);
        $conditions[] = "module.DateTime >= '".$date."' ";
      }
      if(isset($searchParameters["maxDate"]) && $searchParameters["maxDate"]!=="*") {
        $date = strftime("%Y-%m-%d %H:%M:%S_" ,strtotime($searchParameters["maxDate"]));
        $dateEnd = strpos($date, "_");
        $date = substr($date, 0, $dateEnd);
        $conditions[] = "module.DateTime <= '".$date."' ";
      }
    }
    
    $matches = dataJoin("module", "modulebases", "BaseID", "BaseID", $conditions);

    
  } else { //If this else block runs, we didn't have any search parameters for phase 1, so search for everything.
    $matches = dataRead("module");
  }
  if ($matches === FALSE) {
    return FALSE;
  }
  
  // replace each matching module ID with the full module information array
  foreach ($matches as $key=>$match) {
    $matches[$key] = getModuleByID($match["ModuleID"]);
  }

  /* Search by categories works like this:  First, search by other criteria (or, if no other search parameters were given, get all modules) and build 
    a list of modules.  Then, check every module in that list to see if it is in the category specified.  If it is, keep it (or actually, copy it 
    back into a new $matches variable), otherwise, throw it out.  The end result is all matches found which are not in the specified category are 
    discarded, leaving only modules in the specified category remaining. */
  if( isset($searchParameters["category"]) && 
      !empty($searchParameters["category"]) && 
      !in_array("*", $searchParameters["category"])
  ) {
    $matchesPhase1=$matches; //Copy all the previous matches into a new variable so we don't loose them.
    // create a SQL set of category IDs 
    $categorySet = "(";
    foreach ($searchParameters["category"] as $category) {
      // if this isn't first item in array, add comma to set
      if ( $category != reset($searchParameters["category"]) ) {
        $categorySet .= ",";
      }
      $categorySet .= $category;
    }
    $categorySet .= ")";
    $matches=array(); //Reset all matches to nothing.
    for($i=0; $i<count($matchesPhase1); $i++) {
      $conditions = array(
        "CategoryID in".$categorySet, 
        "ModuleID=".$matchesPhase1[$i]["moduleID"]
      );
      $result = dataRead("modulecategories", $conditions);
      if(count($result)>=1) { //Did the above query checking for a matching in the category find a match?
        $matches[]=$matchesPhase1[$i]; //Copy the module back into matches, since it was in the right category.  No need to call getModuleByID again, since we have all the information about the module anyway preserved from the phase 1 search.
      }
    }
  }
  
  /* Searching types works like categories above */
  if( isset($searchParameters["type"]) && 
      !empty($searchParameters["type"]) && 
      !in_array("*", $searchParameters["type"])
  ) {
    $matchesPhase1=$matches; //Copy all the previous matches into a new variable so we don't loose them.
    // create a SQL set of type IDs 
    $typeSet = "(";
    foreach ($searchParameters["type"] as $type) {
      // if this isn't first item in array, add comma to set
      if ( $type != reset($searchParameters["type"]) ) {
        $typeSet .= ",";
      }
      $typeSet .= $type;
    }
    $typeSet .= ")";
    $matches=array(); //Reset all matches to nothing.
    for($i=0; $i<count($matchesPhase1); $i++) {
      $conditions = array(
        "TypeID in".$typeSet,
        "ModuleID=".$matchesPhase1[$i]["moduleID"]
      );
      $result = dataRead("moduletype", $conditions);
      if(count($result)>=1) { //Did the above query checking for a matching in the type find a match?
        $matches[]=$matchesPhase1[$i]; //Copy the module back into matches, since it was in the right type.  No need to call getModuleByID again, since we have all the information about the module anyway preserved from the phase 1 search.
      }
    }
  }
  
  // only top-level modules filter
  if( isset($searchParameters["topLevel"]) && $searchParameters["topLevel"] ) {
    $topLevelModuleIDs = getTopLevelModules();
    $origMatches = $matches;
    $matches = array();
    foreach ($origMatches as $match) {
      // if this match is a top level module
      if (in_array($match["moduleID"], $topLevelModuleIDs)) {
        $matches[] = $match;
      }
    }
  }
  
  // only modules with materials filter
  if( isset($searchParameters["hasMaterial"]) && $searchParameters["hasMaterial"] ) {
    $origMatches = $matches;
    $matches = array();
    foreach ($origMatches as $match) {
      $result=dataRead("modulematerialslink", array("ModuleID=".$match["moduleID"]));
      if(count($result)>=1) {
        $matches[] = $match;
      }
    }
  }
  
  
  
  //Check to see if the user only wanted current versions or not 
	$filteredMatches = array();
	$temp = null; 
	if ($searchParameters["showOlder"]) {
		for ($i = 0; $i < count($matches); $i++) {
			$counter = 0; 
			$match = $matches[$i];
			for ($j = $i; $j <= count($matches); $j++) { 
			$otherMatch = $matches[$j];
				if (($match["baseID"] == $otherMatch["baseID"]) && ($match["moduleID"] != $otherMatch["moduleID"])) {
					$temp = $match; 
					if ($temp["version"] < $otherMatch["version"]) {
						$temp = $otherMatch; 
					}
					$counter++; 
					if ($j == count($matches)){
						array_push ($filteredMatches, $temp); 
					}
				}
			}
			if ($counter == 0) {
				array_push ($filteredMatches, $match); 
			}
		}
	}
	else {
		$filteredMatches = $matches; 
	}

  return $filteredMatches; 
  
}

/* createModule() - Creates a new module, starting at the inital version.  To create a new VERSION of a module, use editModuleByID() instead.
  @parm $description - A description or description of the module.
  @parm $language - The primary language that the module's contents are in.
  @parm $educationLevel - The amount of schooling that the module's target audience will have.
  @parm $minutes - The number of minutes this module takes to complete
  @parm $authorComments - Comments on the module by the author.
  @parm $status - The module status.  One of the following values: "InProgress", "PendingModeration", "Active", "Locked"
  @parm $minimumUserType - The minimum user type which may view this module once active.  One of "Viewer", "SuperViewer", "Submitter", "Editor", "Admin".
  @parm $interactivityType - The amount of use expected from the module.
  @parm $rights - Legal copyright on module
  @parm $submittingUserID - The ID of the user who submitted the module.
  @parm $checkInComments - Comments left by the submitter.
  @parm $restrictions - the group the user have to be in to see the module 
  @return - Returns FALSE on any error.
    Returns the moduleID of the new module on success. */
function createModule($title, $description, $language, $educationlevel, $minutes, $authorComments, $status, $minimumUserType, $interactivityType, $rights, $submittingUserID, $checkInComments, $restrictions) {
  
  /* Start by creating a module base and retrieving its ID */
  
  $baseID = dataCreate("modulebases", array("Title"=>$title, "ModuleIdentifier"=>""));
  if($baseID===FALSE) {
    return FALSE;
  }
  
  $fields = array(                        
    "Description"      => $description,
    "Minutes"          => $minutes,
    "AuthorComments"   => $authorComments,
    "Status"           => $status,
    "MinimumUserType"  => $minimumUserType,
    "BaseID"           => $baseID,
    "Version"          => 1,
    "SubmitterUserID"  => $submittingUserID,
    "CheckInComments"  => $checkInComments, 
	"Restrictions" 	   => $restrictions
  );
  
  $result = dataCreate("module", $fields);
  
  return $result;
}

/* editModuleByID($moduleID, $createNewVersion) - Update's a module's information in the system.  On back-ends which support writing multiple 
    versions of a module, may optionally also create a new version of the module with the new information while preserving the origional module.
      *NOTE:  Moderation is done primarily through this function.  To approve a module held for moderation, run this function but do not change any 
        values from their origional values except change $status to indicate the module has been approved.  Also, set $createNewVersion to FALSE to 
        prevent a new version from being created (since approving a module simply changes the status, it doesn't create a new version).
  @parm $moduleID - The ID of the module to edit.
  @parm $description - A description or adbstract of the module.
  @parm $language - The primary language that the module's contents are in.
  @parm $educationLevel - The amount of schooling that the module's target audience will have.
  @parm $minutes - The number of minutes this module takes to complete
  @parm $authorComments - Comments on the module by the author.
  @parm $checkInComments - Comments left by the submitter.
  @parm $status - The status of the module.  One of "InProgress", "PendingModeration", "Active", "Locked"
  @parm $minimumUserType - The minimum user type which may view this module once active.  One of "Viewer", "SuperViewer", "Submitter", "Editor", "Admin".
  @parm interactivityType - The amount of use expected from the module.
  @parm rights - Legal copyright on module
  @parm restrictions - the group users have to be in to see the module
  @parm $createNewVersion - Ignored on back-ends which do not support writing new versions of modules.  On other back-ends, specifies if a 
    new version of a module should be created.  Set to TRUE to create a new version of the module with the new information and preserve the 
    old version of the module as it was, or set to FALSE to instead just overwrite the module without changing the version.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.
    Returns the module ID of the resulting module on success.  On back-ends which do not supprot writing multiple versions, or if the 
      $createNewVersion parameter was set to FALSE, this should be the same as the module given in $moduleID.  If a new version of a 
      module was created, the return value will be the ID of the new version. */
function editModuleByID($moduleID, $title, $description, $language, $educationLevel, $minutes, $authorComments, $checkInComments, $submittingUserID, $status, $minimumUserType, $interactivityType, $rights, $restrictions, $action) {
  $originalModule = getModuleByID($moduleID);
 
  //Check that the module ID given exists.
 if($action !== "createNewVersion") { //This block takes care of creating an original version and a copied version
    $newModuleID=$moduleID; //We won't change the module ID, so set the "new" module ID the same as the old one.
    if ($action === "copy") { //If we are copying a module, add the title and create a new baseID
        $baseFields = array(
            "Title" => $title,
            "ModuleIdentifier" => ""
        );
        $baseResult = dataCreate("modulebases", $baseFields);
        if ($baseResult == FALSE){
            return FALSE;
        }
    }
    $fields = array (
      "DateTime" => date('Y-m-d H:i:s'),
      "Description" => $description,
      "Language" => $language,
      "EducationLevel" => $educationLevel,
      "Minutes" => $minutes,
      "AuthorComments" => $authorComments,
      "CheckInComments" => $checkInComments,
      "SubmitterUserID" => $submittingUserID,
      "Status" => $status,
      "MinimumUserType" => $minimumUserType,
      "InteractivityType" => $interactivityType,
      "Rights" => $rights,
      "Restrictions" => $restrictions,
    );
    $conditions = array("ModuleID=".$moduleID);
   
    if ($action == "copy") { //Create the new module with the new baseID set above
        $fields2 = array ("BaseID" => $baseResult, "Version" => 1);
        $fields = array_merge($fields, $fields2);
        $newModuleID = dataCreate("module", $fields);
        if ($newModuleID === FALSE) {
            return FALSE;
        }
    }
    else {
        $result = dataUpdate("module", $fields, $conditions);
        if ($result===FALSE){
            return FALSE;
        }
    }
  } else { //This else block handles editing a module by creating a new version.
    $baseID = $originalModule["baseID"];
    //This checks for Modules with the same Base ID as the current moduloe, takes the version number, and adds 1
    $conditions = array("BaseID=".$baseID);
    $table = "module";
    $rawData = dataRead($table, $conditions);
    foreach($rawData as $row) {
    $data[] = $row["Version"];
    }
    $max = (max($data)) + 1;  
   
    $fields = array (
      "Description" => $description,
      "Language" => $language,
      "educationLevel" => $educationLevel,
      "Minutes" => $minutes,
      "AuthorComments" => $authorComments,
      "Status" => $status,
      "MinimumUserType" => $minimumUserType,
      "InteractivityType" => $interactivityType,
      "Rights" => $rights,
      "BaseID" => $baseID,
      "Version" => ($max),
      "SubmitterUserID" => $submittingUserID,
      "CheckInComments" => $checkInComments,
      "Restrictions" => $restrictions
    );
   
    $newModuleID = dataCreate("module", $fields);
  }
  return $newModuleID;
}

/* removeModulesByID($moduleIDs) - Removes one or more modules based on their unique IDs.
  @parm $moduelIDs - A numerically indexed array of module IDs to remove.  The value of each index should correspond to the ID of a material 
    to remove.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.  Not finding a specified module ID in the system is not considered an error.
    Returns TRUE on success. */
function removeModulesByID($moduleIDs) {
  for($i=0; $i<count($moduleIDs); $i++) {
    $result = dataDelete("module", array("ModuleID='".$moduleIDs[$i]."'"));
    if($result===FALSE) {
      return FALSE;
    }
  }
  return TRUE;
}

/* addRatingToModule($moduleID, $rating) - Adds a rating to a material.
  @parm $moduleID - The ID of the module to add a rating to.
  @parm $rating - The rating of the module.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.
    Returns TRUE on successful addition of the rating. */
function addRatingToModule($moduleID, $rating) {
  /* Check if the moduleID given exists.  If it doesn't, return an error. */
  $modTest=getModuleByID($moduleID);
  if($modTest===FALSE || $modTest=="NotImplimented" || count($modTest)<=0) {
    return FALSE;
  }
  $result=settype($rating, "integer"); //Convert the rating given to an integer type.
  if($result===FALSE) { //Indicates an error converting to an integer.
    return FALSE;
  }
  
  /* Check to see if the module being rated already has any ratings.  If it doesn't, create a rating entry for it in the database. */
  $result = dataRead("moduleratings", array("ModuleID=$moduleID"));
  if($result===FALSE) {
    return FALSE;
  }
  
  if(empty($result)) { //If true, there's no row for ratings for this module.  We need to create it.
    $fields = array (
      "ModuleID" => $moduleID,
      "Rating" => $rating,
      "NumRatings" => 1
    );
    $result = dataCreate("moduleratings", $fields); 
  } else {
    $moduleRating = $result[0];
    
    $setTypeResults = array();
    $setTypeResults[] = settype($moduleRating["Rating"], "integer");
    $setTypeResults[] = settype($moduleRating["NumRatings"], "integer");
    
    if (in_array(false, $setTypeResults)) {
      return FALSE;
    }
    
    $rating += $moduleRating["Rating"];
    $numRating = $moduleRating["NumRatings"] + 1;
    
    $fields = array("Rating" => $rating, "NumRatings" => $numRating);
    $conditions = array("ModuleID=$moduleID");
    $result = dataUpdate("moduleratings", $fields, $conditions);
  }
  
  if($result === FALSE) {
    return FALSE;
  }
  return TRUE;
}

/* getModuleRatings($moduleID) - Gets all ratings attatched to a module.
  @parm $moduleID - The ID of the module to get ratings of.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.
    Returns an array with keys "rating" and "numberOfRatings" on success.  The overall rating can be detering by "rating"/"numberOfRatings".  If no 
      ratings are found, "numberOfRatings" will be zero.  Be sure to check for this when using results to avoid trying to divide by zero. */
function getModuleRatings($moduleID) {
  $result = dataRead("moduleratings", array("ModuleID=$moduleID"));
  if($result===FALSE) {
    return FALSE;
  }
  
  $ratings=0;
  $numberOfRatings=0;
  
  foreach($result as $row) {
    $ratings=$ratings+$row["Rating"];
    $numberOfRatings=$numberOfRatings+$row["NumRatings"];
  }
  
  return array("rating"=>$ratings, "numberOfRatings"=>$numberOfRatings);
}

/* saveAllPossible($request, $userInformation, $moduleInfo) - Saves all possible parts of a module during edit/upload.  Does not do anything with 
      materials.
    @parm $request - The $_REQUEST variable from the calling page.
    @parm $userInformation - An array of information about the logged in user from the calling page,
    @parm $moduleInfo - An array of information about the module to save.
    @return - Returns TRUE on success, FALSE on error. */
function saveAllPossible($request, $userInformation, $moduleInfo) {

  $backendCapabilities=getBackendCapabilities(); //Get the backend's abilities
  /* Make sure the given user has the right to save this module. */
  if($moduleInfo["submitterUserID"]!=$userInformation["userID"] && !($userInformation["type"]=="Editor" || $userInformation["type"]=="Admin")) {
    return FALSE;
  }
  /* Get all information about the module currently stored. */
  $moduleID=$moduleInfo["moduleID"];
  $title=$moduleInfo["title"];
  $submitterUserID=$moduleInfo["submitterUserID"];
  $authorFirstName=$moduleInfo["authorFirstName"];
  $authorLastName=$moduleInfo["authorLastName"];
  $dateTime=$moduleInfo["dateTime"];
  $description=$moduleInfo["description"];
  $language=$moduleInfo["language"];
  $educationLevel=$moduleInfo["educationLevel"];
  $minutes=$moduleInfo["minutes"];
  $authorComments=$moduleInfo["authorComments"];
  $status=$moduleInfo["status"];
  $minimumUserType=$moduleInfo["minimumUserType"];
  $interactivityType=$moduleInfo["interactivityType"];
  $rights=$moduleInfo["rights"];
  $checkInComments=$moduleInfo["checkInComments"];
  $restrictions=$moduleInfo["restrictions"]; 
  $version=$moduleInfo["version"];
  $topics=getModuleTopics($moduleInfo["moduleID"]);
  $objectives=getModuleObjectives($moduleInfo["moduleID"]);
  $authors=getModuleAuthors($moduleInfo["moduleID"]);
  if(in_array("UseCategories", $backendCapabilities["read"])) { //Only try to read a current category if the backend supports it.
    $categoryIDs=getModuleCategoryIDs($moduleInfo["moduleID"]);
  }
  if(in_array("UseTypes", $backendCapabilities["read"])) { //Only try to read a current type if the backend supports it.
    $typeIDs=getModuleTypeIDs($moduleInfo["moduleID"]);
  }
  if(in_array("CrossReferenceModulesExternal", $backendCapabilities["read"])) {
    $externalReferences=getExternalReferences($moduleInfo["moduleID"]);
  }
  if(in_array("CrossReferenceModulesInternal", $backendCapabilities["write"])) {
    $internalReferences=getInternalReferences($moduleInfo["moduleID"]);
  }
  $prereqs=getModulePrereqs($moduleInfo["moduleID"]);
  
  /* Overright the current information about the module with any new module passed in through the $request variable. */
  if(isset($request["moduleDescription"])) {
    $description=$request["moduleDescription"];
  }
  if(isset($request["moduleLanguage"])) {
    $language=$request["moduleLanguage"];
  }
  if(isset($request["moduleEducationLevel"])) {
    $educationLevel=$request["moduleEducationLevel"];
  }
  if(isset($request["moduleMinutes"])) {
    $minutes=$request["moduleMinutes"];
  }
  if(isset($request["moduleCategoryID"])) {
    $categoryID=$request["moduleCategoryID"];
  }
  if(isset($request["moduleTypeID"])) {
    $typeID=$request["moduleTypeID"];
  }
  if(isset($request["moduleMinimumUserType"])) {
    $minimumUserType=$request["moduleMinimumUserType"];
  }
if(isset($request["moduleInteractivityType"])) {
    $interactivityType=$request["moduleInteractivityType"];
  }
  if(isset($request["moduleRights"])) {
    $rights=$request["moduleRights"];
  }
  if(isset($request["restrictions"])) {
	$restrictions=$request["restrictions"];
  }
  if(isset($request["moduleAuthorComments"])) {
    $authorComments=$request["moduleAuthorComments"];
  }
  
  $i=0;
  if(isset($request["moduleTopics".$i])) {
    $topics=array();
    while(isset($request["moduleTopics".$i])) {
      $topics[]=array("text"=>$request["moduleTopics".$i]);
      $i++;
    }
  }
  $i=0;
  if(isset($request["moduleObjectives".$i])) {
    $objectives=array();
    while(isset($request["moduleObjectives".$i])) {
      $objectives[]=array("text"=>$request["moduleObjectives".$i]);
      $i++;
    }
  }
  $i=0;
  if(isset($request["modulePrereqs".$i])) {
    $prereqs=array();
    while(isset($request["modulePrereqs".$i])) {
      $prereqs[]=array("text"=>$request["modulePrereqs".$i]);
      $i++;
    }
  }
  $i=0;
  if(isset($request["moduleERefs".$i]) && isset($request["moduleERefsLink".$i])) {
    $externalReferences=array();
    while(isset($request["moduleERefs".$i]) && isset($request["moduleERefsLink".$i])) {
      $externalReferences[]=array("description"=>$request["moduleERefs".$i], "link"=>$request["moduleERefsLink".$i]);
      $i++;
    }
  }
  $i=0;
  if(isset($request["moduleIRefs".$i]) && isset($request["moduleIRefsLink".$i])) {
    $internalReferences=array();
    while(isset($request["moduleIRefs".$i]) && isset($request["moduleIRefsLink".$i])) {
	  $internalReferences[]=array("description"=>$request["moduleIRefs".$i], "referencedModuleID"=>$request["moduleIRefsLink".$i]);
      $i++;
    }	
  }
  $i=0;
  if(isset($request["moduleCategory".$i])) {
    $categoryIDs=array();
    while(isset($request["moduleCategory".$i])) {
      $categoryIDs[]=$request["moduleCategory".$i];
      $i++;
    }
  }
  $i=0;
  if(isset($request["moduleType".$i])) {
    $typeIDs=array();
    while(isset($request["moduleType".$i])) {
      $typeIDs[]=$request["moduleType".$i];
      $i++;
    }
  }
  $i=0;
  if(isset($request["moduleAuthors".$i])) {
    $authors=array();
    while(isset($request["moduleAuthors".$i])) {
      $authors[]=$request["moduleAuthors".$i];
      $i++;
    }
  }
  /* Try to save the module, and return accordingly. */
  if(in_array("UseModules", $backendCapabilities["write"])) { //Only try to update the module if the backend supports writing modules
    $result=editModuleByID($moduleID, $title, $description, $language, $educationLevel, $minutes, $authorComments, $checkInComments, $submitterUserID, $status, $minimumUserType, $interactivityType, $rights, $restrictions, "save");
    if($result=="NotImplimented" || $result===FALSE) {
      return FALSE; //Error saving module.
    }
  }
  if(in_array("UseCategories", $backendCapabilities["write"]) && $categoryIDs!==FALSE && $categoryIDs!=="NotImplimented") { //Only try to set a category if the backend supports writing categories and we actually have a category to set to.
    if(isset($request["noModuleCategories"]) && $request["noModuleCategories"]=="true") {
      $result=setModuleCategories($moduleID, array());
    } else {
      $result=setModuleCategories($moduleID, $categoryIDs);
    }
    if($result==="NotImplimented" || $result===FALSE) {
      return FALSE;
    }
  }
  if(in_array("UseTypes", $backendCapabilities["write"]) && $typeIDs!==FALSE && $typeIDs!=="NotImplimented") { //Only try to set a type if the backend supports writing types and we actually have a type to set to.
    if(isset($request["noModuleTypes"]) && $request["noModuleTypes"]=="true") {
      $result=setModuleTypes($moduleID, array());
    } else {
      $result=setModuleTypes($moduleID, $typeIDs);
    }
    if($result==="NotImplimented" || $result===FALSE) {
      return FALSE;
    }
  }
  if(in_array("CrossReferenceModulesExternal", $backendCapabilities["write"]) && $externalReferences!==FALSE && $externalReferences!=="NotImplimented") {
    /* The if statement below works around a bug which prevents one from deleting all external references.  This first checks for a parameter 
      "noModuleERefs" which, if set to "true", means that if no eRefs were found on the page, to remove all eRefs attached to the module.  Normally, 
      finding no eRefs on the page would not change them, since it would be assumed they weren't found because we weren't called from the page of 
      the module wizard containing them.  This behaviour is retained if the "noModuleERefs" parameter is not found or is not "true". */
    if(isset($request["noModuleERefs"]) && $request["noModuleERefs"]=="true") {
      $result=setExternalReferences($moduleID, array());
    } else {
      $result=setExternalReferences($moduleID, $externalReferences);
    }
    if($result==="NotImplimented" || $result===FALSE) {
      return FALSE;
    }
  }
  if(in_array("CrossReferenceModulesInternal", $backendCapabilities["write"]) && $internalReferences!==FALSE && $internalReferences!=="NotImplimented") {
    if(isset($request["noModuleIRefs"]) && $request["noModuleIRefs"]=="true"){
      $result=setInternalReferences($moduleID, array());
    } else {
      $result=setInternalReferences($moduleID, $internalReferences);
    }
	if($result==="NotImplimented" || $result===FALSE) {
      return FALSE;
    }
  }
  /* Set module topics... */
  if(isset($request["noModuleTopics"]) && $request["noModuleTopics"]=="true") {
    $result=setModuleTopics($moduleID, array());
  } else {
    $result=setModuleTopics($moduleID, $topics);
  }
  if($result==="NotImplimented" || $result===FALSE) {
    return FALSE;
  }
  /* Set module objectives... */
  if(isset($request["noModuleObjectives"]) && $request["noModuleObjectives"]=="true") {
    $result=setModuleObjectives($moduleID, array());
  } else {
    $result=setModuleObjectives($moduleID, $objectives);
  }
  if($result==="NotImplimented" || $result===FALSE) {
    return FALSE;
  }
  /* Set module prereqs... */
  if(isset($request["noModulePrereqs"]) && $request["noModulePrereqs"]=="true") {
    $result=setModulePrereqs($moduleID, array());
  } else {
    $result=setModulePrereqs($moduleID, $prereqs);
  }
  if($result==="NotImplimented" || $result===FALSE) {
    return FALSE;
  }
  /* Set module authors... */
  if(isset($request["noModuleAuthors"]) && $request["noModuleAuthors"]=="true") {
    $result=setModuleAuthors($moduleID, array());
  } else {
    $result=setModuleAuthors($moduleID, $authors);
  }
  if($result==="NotImplimented" || $result===FALSE) {
    return FALSE;
  }
  return TRUE;
} //End saveAllPossible() function.

/* submitModule($request, $userInformation, $moduleInfo, $checkInComments, $requiresModeration) - Submits a module to the back-end, changing its 
        status to either pending moderation, or active in the system, depending on if moderation is required or not.
      @parm $request - The $_REQUEST variable from the calling page.
      @parm $userInformation - Information about the user, as from the getUserInformationByID() function.
      @parm $moduleInfo - Information about the module to submit, as from the getModuleByID() function.
      @parm $checkInComments - Any "check-in comments" left by the user at check in time.
      @parm $requiresModeration - If the module should be submitted for moderation, set to TRUE.  Otherwise, the module will immedietly be made active. */
function submitModule($request, $userInformation, $moduleInfo, $checkInComments, $requiresModeration) {
  if(!($userInformation["type"]=="Submitter" || $userInformation["type"]=="Editor" || $userInformation["type"]=="Admin")) { //Is the user allowed to submit modules?
    return FALSE;
  }
  if(saveAllPossible($request, $userInformation, $moduleInfo)!==TRUE) { //Try to save anything that might have changed.
    return FALSE;
  }
  $moduleInfo=getModuleByID($moduleInfo["moduleID"]); //Reload the module information, since it might have changed after calling saveAllPossible() above.
  if($requiresModeration===TRUE) {
    $status="PendingModeration";
  } else {
    $status="Active";
  }
  /* Update the module, setting it to the proper status (as determined by the $status variable).  This shouldn't change anything except the status and
    checkInComments, but the editModuleByID() function requires all the parameters, even if most of them aren't changed. */
  $result=editModuleByID($moduleInfo["moduleID"], $moduleInfo["title"], $moduleInfo["description"], $moduleInfo["language"], $moduleInfo["educationLevel"], $moduleInfo["minutes"], $moduleInfo["authorComments"], $checkInComments, $moduleInfo["submitterUserID"], $status, $moduleInfo["minimumUserType"], $moduleInfo["interactivityType"], $moduleInfo["rights"], $moduleInfo["restrictions"], "submit");
  if($result===FALSE || $result==="NotImplimented") {
    return FALSE;
  }
  return TRUE;
}

/* canUserViewModule($module, $user = false) - Determines if use can view the given module.
     @param $module - array of the module information for the module to check.
     @param $user - array of user information for currently logged-in user. 
                            Defaults to false which means user isn't logged in (i.e. "Unregistered")
     @return - Returns true if user can view the given module, false otherwise 
*/
function canUserViewModule($module, $user = FALSE) {
  // array of module minimum user types each user type can view
  $allowedToView  = array (
    // user type                  array() of types that user can view
    'Unregistered' => array('Unregistered'),
    'Viewer' => array('Unregistered','Viewer'),
    'SuperViewer' => array('Unregistered','Viewer','SuperViewer'),
    'Submitter' => array('Unregistered','Viewer','SuperViewer','Submitter'),
    'Editor' => array('Unregistered','Viewer','SuperViewer','Submitter','Editor','Admin'),
    'Admin' => array('Unregistered','Viewer','SuperViewer','Submitter','Editor','Admin')
  );
  
  $moduleStatus = $module["status"];
  $moduleSubmitterID = $module["submitterUserID"];
  $moduleMinType = $module["minimumUserType"];
  $moduleRestriction = $module["restrictions"]; 
  
  $userType = "Unregistered";
  $userID = NULL;
  
  if ($user !== FALSE) {
    $userType = $user["type"];
    $userID = $user["userID"];
	$userGroup = $user["groups"]; 
  }

  // user owns module, so they can view it
  if ($moduleSubmitterID == $userID) {
    return TRUE;
  }

  $canView = FALSE; 

  $checkGroups = FALSE; 
  //Checks the user's group , so they can view it
  if ($userGroup == $moduleRestriction || $moduleRestriction == "None" || $userGroup == "None" || $userGroup == "Admin") {
		$checkGroups = TRUE; 
	}

  // editors and admins can view all modules, regardless of status
  if (($userType == "Editor" || $userType == "Admin") && $checkGroups == TRUE) {
    return TRUE;
  }
  
  $moduleStatusCheck = FALSE;
  // if module is active, visibility is determined by user type and module's min user type
  if (($moduleStatus == "Active") && $checkGroups == TRUE) {
    $r = in_array($moduleMinType, $allowedToView[$userType]);

    $moduleStatusCheck = $r; 
  }

  //New code I am not sure that this is necessary 
  if ($checkGroups == $moduleStatusCheck)
  { 
    return $checkGroups; 
  }
  else
  {
    return $moduleStatusCheck;
  }

  return FALSE;
}

/* sortModulesByTitle() - sort given $modules by module title in ascending order
    @param &$modules - multidimensional array of modules passed by reference
    @return - TRUE on success, FALSE otherwise
*/
function sortModulesByTitle(&$modules) {
  return usort($modules, function ($a, $b) {
    return strcasecmp($a["title"], $b["title"]);
  });
}

/* sortModulesByDate() - sort given $modules by date
    @param &$modules - multidimensional array of modules passed by reference
    @param $asc - boolean value; if TRUE, sort ascending, else sort descending
    @return - TRUE on success, FALSE otherwise
*/
function sortModulesByDate(&$modules, $asc = TRUE) {
  if ($asc) {
    return usort($modules, function ($a, $b) {
      return strcmp($a["dateTime"], $b["dateTime"]);
    });
  } else {
    return usort($modules, function ($a, $b) {
      return strcmp($b["dateTime"], $a["dateTime"]);
    });
  }
}
/**countTypeModules($filter) - this will count the amount of modules for each type (Model, Project...) 
	@param- $filter - this is the filter name (Model, Project...) taken from the TPL page
	@return - returns the amount of modules in database with the specific filters. 

**/
function countTypeModules ($filter){
	connectToDB(); 
	$constraint = $filter; 
	$getIDs = "SELECT COUNT(ModuleID) FROM `moduletype` WHERE `TypeID`=$constraint"; 
	$typeIDs = mysql_query($getIDs); 
	$amount = mysql_fetch_array($typeIDs); 
	closeConnection(); 
	return $amount[0]; 
}
/**- countCategoryModules($filter); - this will count the amount of modules for each type of category (Testing, Programming...) 
	@param- $filter - this is the filter name (Testing, Programming...) taken from the TPL page
	@return - returns the amount of modules in database with the specific filters.
**/
function countCategoryModules($filter){
	connectToDB(); 
	$constraint = $filter; 
	$getIDs = "SELECT COUNT(ModuleID) FROM `modulecategories` WHERE `CategoryID`=$constraint"; 
	$categoryIDs = mysql_query($getIDs); 
	$amount = mysql_fetch_array($categoryIDs); 
	closeConnection(); 
	return $amount[0]; 
}
/**countWithMaterials() - This counts the amount of modules that are linked to materials.
	@return - returns the amount of modules in database with the specific filters. 
**/
function countWithMaterials($otherFilters){
  $verified = FALSE; 
  for($i = 0; $i < count($otherFilters); $i++){
    if (array_key_exists("hasMaterial", $otherFilters)){
      $verified = TRUE; 
    }
  }

  if ($verified == TRUE){
    unset($otherFilters["hasMaterial"]); 

    print_r($otherFilters);
    //Middle


    connectToDB(); 
    $getIDs = "SELECT COUNT(distinct ModuleID) FROM `modulematerialslink` "; 
    $moduleIDs = mysql_query($getIDs); 
    $amount = mysql_fetch_array($moduleIDs);
    closeConnection(); 
    return $amount[0]; 




  } 
  else{
    return 0; 
  }
}
/**countModuleStatus($filter); - this will count the amount of modules for each type of status (Active, Pending...) 
	@param- $filter - this is the filter name (Active, Pending...) taken from the TPL page
	@return - returns the amount of modules in database with the specific filters. 
**/
function countModuleStatus($filter){
	connectToDB(); 
	$constraint = $filter;
	$getIDs = "SELECT COUNT(Status) FROM `module` WHERE `Status`='$constraint'  "; 
	$moduleIDs = mysql_query($getIDs); 
	$amount = mysql_fetch_array($moduleIDs);
	closeConnection(); 
	return $amount[0]; 
}
/**connectToDB()
	Takes in global variables then connects to the database. 
**/
function connectToDB(){
	global $DB_DATABASE, $DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD; 
	$connect = mysql_connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD); 
	mysql_select_db($DB_DATABASE, $connect);
}
/**closeConnection(); 
	Closes the connection to the database. 
**/
function closeConnection(){
	mysql_close(); 
}

?>