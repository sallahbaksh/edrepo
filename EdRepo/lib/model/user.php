<?php
/****************************************************************************************************************************
 *    user.php - defines the model functions for creating and managing users
 *    ---------------------------------------------------------
 *
 *  Version: 1.0
 *  Author: Jon Thompson
 *
 ******************************************************************************************************************************/

require_once(__DIR__ . "/../backends/backend.php");
require_once(__DIR__ . "/model.php");


/* searchUser($searchParameters) - Searches users based on specified parameters.  Unknown search parameters are silently ignored.
    @parm $searchParameters - An associative array of the search parameters to search for.  Keys are the parameter name and key values are 
      the text of the parameter.  Valid keys are: "userID", "email", "firstName", "lastName", "type".  Note that searching by password is 
      not supported.  Unkown keys are silently ignored.
    @return - Returns "NotImplimented" if this feature is not supported by the back-end.
      Returns FALSE on any error.  Unknown/invalid keys are not considered errors, nor is finding no matching users.
      Returns a 2D array on success.  The first dimension is numerically indexed, with each index referring to a matching user.  The 
        second array is an associative array with the information about each found user.  The structure of this array is the same as 
        that returned by getUserInformationByID().
        An empty array indicates no matches were found. */
function searchUsers($searchParameters) {
  $conditions = array();

  if(isset($searchParameters["name"]) && $searchParameters["name"]!="" && $searchParameters["name"]!=" " && $searchParameters["name"]!="*") { //Add filter-by-name criteria to the query, but only if something to search for was actually given.
    $names=preg_split('/ /',$searchParameters["name"] , -1, PREG_SPLIT_NO_EMPTY); //Since the back-end stores names as two seperate fields (first and last), split the names given into all whole words, to search for a matching in either FirstName or LastName for any part of the name given.
    $subQuery="";
    for($i=0; $i<count($names); $i++) {
      if($i!=0) {
        $subQuery=$subQuery."OR ";
      }
      $subQuery=$subQuery."FirstName LIKE '%".$names[$i]."%' OR LastName LIKE '%".$names[$i]."%' ";
    }
    $conditions[] = $subQuery;
  }
  if(isset($searchParameters["email"]) && $searchParameters["email"]!="" && $searchParameters["email"]!="*") {
    $conditions[] = "Email='".$searchParameters["email"]."' ";
  }
  if(isset($searchParameters["type"]) && $searchParameters["type"]!="" && $searchParameters["type"]!="*") {
    $conditions[] = "Type='".$searchParameters["type"]."' ";
  }
  
  $result = dataRead("users", $conditions);
  if($result===FALSE) {
    return FALSE;
  }
  $users=array();
  foreach($result as $row) {
    $users[]=getUserInformationByID($row["UserID"]);
  }
  return $users;
}

/* getUserInformationByID($userID) - Gets information about a user with the specified ID.
  @parm $userID - The ID of the user to get information about, which uniquely identifies them.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error (not finding a user with the specified user ID is not considered an error).
    Returns an associative array on success with the information about the user.  An empty array indicates no user with the specified ID 
      was found.
      The array contains the following keys:  "userID", "email", "firstName", "lastName", "password", "type" */
function getUserInformationByID($userID) {
  $result = dataRead("users", array("UserID=$userID"));
  if($result===FALSE) {
    return FALSE;
  }
  if(count($result)<=0) { 
    return array(); //Return an empty array to show that we didn't find anything.
  }
  $userInfoFromDB = $result[0];
  $userInformation = array(
    "userID"=>$userInfoFromDB["UserID"],
    "email"=>$userInfoFromDB["Email"],
    "firstName"=>$userInfoFromDB["FirstName"],
    "lastName"=>$userInfoFromDB["LastName"],
    "password"=>$userInfoFromDB["Password"],
    "type"=>$userInfoFromDB["Type"], 
	"groups"=>$userInfoFromDB["Groups"], 
	"locked"=>$userInfoFromDB["Locked"]
  );
  return $userInformation;
}

/* createUser($email, $firstName, $lastName, $password, $type) - Creates a new user with the specified parameters.
  @parm $email - The email address of the new user.
  @parm $firstName - The first name of the user.
  @parm $lastName - The last name of the user.
  @parm $password - The desired password of the new user, in plain text.
  @parm $type - The type of the desired user.  Types correspond directly to the rights of the user.  Valid types are:
  @parm $group - The group of the user after the update. Groups correspond to the restrictions the user has on certian modules. 
  @parm $locked - If the user has been locked out of their account due to multiple userName password mismatches. 
    
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    On error, returns either an error code or FALSE.  Possible error codes are:
      "EmailAlreadyExists" - The email address already exists and can not be re-used.
      "BadEmail" - The email address given is invalid in some way.
      "BadPassword" - The password given is invalid in some way.
      "BadType" - The type specified is invalid in some way.
      "BadFirstName" - The first name given is invalid in some way.
      "BadLastName" - The last name given is invalid in some way.
    On success, returns the user ID of the new user, which uniquely identifies them in the system. */
function createUser($email, $firstName, $lastName, $password, $type, $group, $locked) {
  /* Start by doing some simple validation checks on the input */
  
  if(validateEmail($email)!==TRUE) {
    return "BadEmail";
  }
  if(validateName($firstName)!==TRUE) {
    return "BadFirstName";
  }
  if(validateName($lastName)!==TRUE) {
    return "BadLastName";
  }
  if(validatePassword($password)!==TRUE) {
    return "BadPassword";
  }
  $result = dataRead("users", array("Email='$email'"));
  if($result===FALSE || count($result)>=1) {
    return "EmailAlreadyExists";
  }
  
  $hash = secureHash($password, $email, NULL);
  
  $fields = array (
    "Email" => $email,
    "FirstName" => $firstName,
    "LastName" => $lastName,
    "Password" => $hash,
    "Type" => $type,
	"Groups" => $group, 
	"Locked" => $locked
  );
 
  $result = dataCreate("users", $fields);
  return $result;
}

/* editUserByID($userID, $email, $firstName, $lastName, $password, $type, $group, $locked, $ignoreChangePassword, $ignoreChangeType, $ignoreChangeGroup, $ignoreChangeLocked) - Updates a user specified by $userID to have the charastics specified.
  @parm $userID - The user ID of the user to edit.  Note that changing user IDs is not supported.
  @parm $email - The email address the user should have after applying the update.
  @parm $firstName - The first name the user should have after applying the update.
  @parm $lastName - The last name the user should have after applying the update.
  @parm $password - The password the user should have after applying the update, in plain text.
  @parm $type - The type of the user after the update.  Types correspond to rights of the user.  See the createUser for a list of valid types.
  @parm $group - The group of the user after the update. Groups correspond to the restrictions the user has on certian modules. 
  @parm $locked - If the user has been locked out of their account due to multiple userName password mismatches. 
  @parm $ignoreChangePassword - If set to TRUE, the password given will be completely ignored and not changed.
  @parm $ignoreChangeType - If set to TRUE, the type given will be completely ignored and not changed. 
  @parm #ignoreChangeGroup - if set to TRUE, the group given will be completly ignored and not changed. 
  @return - Returns "NotImplimented" if this feature is not implimented.
    Returns an error code or FALSE on any failure.  Possible error codes are:
      "BadEmail" - The email address given is invalid in some way.
      "BadPassword" - The password given is invalid in some way.
      "BadType" - The type specified is invalid in some way.
      "BadFirstName" - The first name given is invalid in some way.
      "BadLastName" - The last name given is invalid in some way.
    Returns TRUE on successful edit/update. */
function editUserByID($userID, $email, $firstName, $lastName, $password, $type, $group, $locked, $ignoreChangePassword, $ignoreChangeType, $ignoreChangeGroup, $ignoreChangeLocked) {
  /* Start by doing some very basic input checking, to make sure we don't have completely */
  if(validateEmail($email)!==TRUE) {
    return "BadEmail";
  }
  if(validateName($firstName)!==TRUE) {
    return "BadFirstName";
  }
  if(validateName($lastName)!==TRUE) {
    return "BadLastName";
  }
  if($ignoreChangePassword !== TRUE && validatePassword($password)!==TRUE) {
    return "BadPassword";
  }
  
  $fields = array (
    "Email" => $email, 
    "FirstName" => $firstName,
    "LastName" => $lastName
  );
  $conditions = array("UserID=$userID");
  
  print_r($ignoreChangePassword); 

  if($ignoreChangePassword!==TRUE) {
    $fields["Password"] = secureHash($password, $email, NULL);
  }
  if($ignoreChangeType!==TRUE) {
    $fields["Type"] = $type; 
  }
  if($ignoreChangeGroup!==TRUE) {
	$fields["Groups"] = $group; 
  }
  if($ignoreChangeLocked!==TRUE){
	$fields["Locked"] = $locked; 
  }
  
  $result = dataUpdate("users", $fields, $conditions);
  return $result;
}

/* removeUsersByID($userID) - Removes one or more users based on their user IDs.  Note that it is up to the back-end to determine exactly how 
    to remove the user(s) (i.e., actually delete them from the system, set them as deleted, etc).
  @parm $userIDs - A numerically indexed array, with each index value containing an ID of a user to remove.
  @parm $softRemove - If TRUE, this will set a user's status to deleated/disabled, instead of actually removing them.  Back-ends do not have to support 
    soft-removes.  If they do not, they should not advertise the "UsersSoftRemove" capability.  In this case, they will simply ignore this parameter.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.
    Returns TRUE on success. */
function removeUsersByID($userIDs, $softRemove) {
  for($i=0; $i<count($userIDs); $i++) {
    $conditions = array("UserID=".$userIDs[$i]);
    if($softRemove===TRUE) {
      $result = dataUpdate("users", array("Type" => "Deleted"), $conditions);
    } else {
      $result = dataDelete("users", $conditions);
    }
    if($result===FALSE) {
      return FALSE;
    }
  }
  return TRUE;
}


?>