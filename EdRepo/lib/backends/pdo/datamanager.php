<?php
/****************************************************************************************************************************
 *    datamanager.php - The datamanager for the PDO backend.
 *    ---------------------------------------------------------
 *  This file implements the required back end functions, using a PDO database connection
 *  Dependency: PHP SQL Parser <http://code.google.com/p/php-sql-parser/>
 *
 *  WARNING: Not all PDO drivers support lastInsertId() which is used in dataCreate()
 *
 *  Version: 1.0
 *  Author: Jon Thompson
 *
 ******************************************************************************************************************************/
 
require_once("settings.php");
require_once('PHP-SQL-Parser/php-sql-parser.php');

/* getBackendCapabilities() - Returns all capabilities a back-end supports. 
  @return - Returns a 2D associative array of all capabilities a back-end supports.  The first dimension if "read" and "write", which 
    allows back-ends to indicate if they support a feature in read-only or read-write mode.  The second dimension is the list of 
    capabilities a back-end supports for each mode. 
*/
function getBackendCapabilities() {
  $read = array("UseUsers", "UsersSoftRemove", "UseModules", "SearchModulesByUserID", "SearchModulesByStatus", "SearchModulesByDate", "UseVersions", "UseCategories", "UseTypes", "UseMaterials", "SearchModulesByCategory", "SearchModulesByType", "SearchModulesByTitle", "CrossReferenceModulesInternal", "CrossReferenceModulesExternal", "RateModules", "RateMaterials");
  $write = array("UseUsers", "UsersSoftRemove", "UseModules", "UseVersions", "UseCategories", "UseTypes", "UseMaterials", "CrossReferenceModulesExternal", "CrossReferenceModulesInternal", "RateModules", "RateMaterials");
  return array("read"=>$read, "write"=>$write);
}

/* getBackendBasicInformation() - Gets basic information about a backend, such as name, liscense, version, etc.
  @return - Returns an associative array with the following keys and meanings:
    name: The name of the backend.
    version: The version of the backend.
    author: The backend author (or group which made the backend).  May be left blank, but not recomended.
    license: The name of the liscense the backend is released under, or the text of the liscense.  Public Domain is also acceptable, obviously. */
function getBackendBasicInformation() {
  return array(
    "name" => "PDO Backend",
    "version" => "1.0", 
    "author" => "Jon Thompson",
    "license" => "GPL 3"
 );
}

/* dataCreate() - creates a new record in the given $relation with the supplied values for its $fields
  @param $relation - string name of relation (e.g. "module", "material", "user", etc.)
  @param $fields - associative array where $fields["fieldName"] = fieldValue
  @return - primary key of new row on success; FALSE on error */
function dataCreate($relation, $fields) {
  if ( !is_array($fields) || empty($fields) ) {
	return FALSE;
  }
  
  $db = connect();
  if (!$db) {  
    return FALSE;
  }
  
  $columns = "(" . implode(",", array_keys($fields)) . ")";
  
  // create a list of ?s to hold the places for the values 
  $values = array_fill(0, count($fields), "?");
  $values = "(" . implode(",", $values) . ")";
  
  $query = "INSERT INTO $relation $columns VALUES $values";
  
  $stmt = $db->prepare($query);
  if (!$stmt) {
    disconnect($db);
    return FALSE;
  }
  
  $result = $stmt->execute( array_values($fields) );
  
  
  
  if (!$result) {
    disconnect($db);
    return FALSE;
  }
  
  $id = $db->lastInsertId();
  
  disconnect($db);  
  
  return $id;
}

/* dataRead() - returns the rows from $relation that match the given $condition
  @param $relation - string name of relation (e.g. "module", "material", "user", etc.)
  @param $conditions - array of string conditions (e.g. "fieldName = fieldValue"); Default: empty array
  @return - multidimensional array of matched rows; empty array if no rows found; FALSE on error */
function dataRead($relation, $conditions = array()) {

  if ( !is_array($conditions) ) {
    return FALSE;
  }
  
  $db = connect();
  if (!$db) {
    return FALSE;
  }
  
  $query = "SELECT * FROM $relation";
  
  $params = array();
  if ( !empty($conditions) ) {
    $p = parseConditions($conditions);
    if (!$p) {
      return FALSE;
    }

    $params = $p["params"];
    $query .= " WHERE ".implode(" AND ", $p["fields"]);
  }

  $stmt = $db->prepare($query);
  if (!$stmt) {
    disconnect($db);
    return FALSE;
  }
  
  $result = $stmt->execute($params);  
  if (!$result) {
    disconnect($db);
    return FALSE;
  }
  
  // fetch associative array 
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  disconnect($db);  
  return $results;
}


/**runCountQuery($query) - not sure if this works yet
  @param $query - 
**/
function runCountQuery($query){
  if (empty($query)) {
    return FALSE;
  }
  
  $db = connect();
  if (!$db) {
    return FALSE;
  }

  global $DB_DATABASE, $DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD; 
  $db = mysql_connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD); 
  mysql_select_db($DB_DATABASE); 

  $resultRow = mysql_query($query); 
  $results = array(); 

  while($row = mysql_fetch_assoc($resultRow)){
    //Matches query in browse.php getOriginalCount function and database column names
    $results[$row["Name"]] = $row["Num"]; 
  }


  if (!$results){
    return FALSE; 
  }
  
  disconnect($db);    
  return $results;
}

/* dataUpdate() - updates the rows in $relation that have certain $conditions with new values supplied in $fields
  @param $relation - string name of relation (e.g. "module", "material", "user", etc.)
  @param $fields - associative array where $fields["fieldName"] = fieldValue
  @param $conditions - array of string conditions (e.g. "fieldName = fieldValue"); Default: empty array
  @return - TRUE on success; FALSE on error */
function dataUpdate($relation, $fields, $conditions = array()) {
  if ( !is_array($fields) || empty($fields) || !is_array($conditions)) {
    return FALSE;
  }
  
  $db = connect();
  if (!$db) {
    return FALSE;
  }
  
  $params = array_values($fields);
  foreach ($fields as $key => $value) {
    $updates[] = $key . "=?";
  }
  $updates = implode(",", $updates);
  
  $query = "UPDATE $relation SET $updates";
  
  if ( !empty($conditions) ) {
    $p = parseConditions($conditions);
    if (!$p) {
      return FALSE;
    }
    
    $params = array_merge($params, $p["params"]);
    $query .= " WHERE ".implode(" AND ", $p["fields"]);
  }
  
  $stmt = $db->prepare($query);
  if (!$stmt) {
    disconnect($db);
    return FALSE;
  }
  
  $result = $stmt->execute($params);    
  disconnect($db);    
  return $result;
}

/* dataDelete() - deletes the rows in $relation that have certain $conditions
  @param $relation - string name of relation (e.g. "module", "material", "user", etc.)
  @param $conditions - array of string conditions (e.g. "fieldName = fieldValue"); Default: empty array
  @return - TRUE on success; FALSE on error */
function dataDelete($relation, $conditions = array()) {
  if ( !is_array($conditions) ) {
    return FALSE;
  }
  
  $db = connect();
  if (!$db) {
    return FALSE;
  }
  
  $query = "DELETE FROM $relation";
  
  $params = array();
  if ( !empty($conditions) ) {
    $p = parseConditions($conditions);
    if (!$p) {
      return FALSE;
    }
    
    $params = $p["params"];
    $query .= " WHERE ".implode(" AND ", $p["fields"]);
  }
  
  $stmt = $db->prepare($query);
  if (!$stmt) {
    disconnect($db);
    return FALSE;
  }
  
  $result = $stmt->execute($params);  
  disconnect($db);
  return $result;
}

// optional functions for PDO implementation

/* dataJoin() - performs inner join $relationA and $relationB on $relationA.$keyA = $relationB.$keyB and returns the joined rows
  @param $relationA - string name of relation (e.g. "module", "material", "user", etc.)
  @param $relationB - string name of relation (e.g. "module", "material", "user", etc.)
  @param $keyA - column in $relationA that must match $keyB in $relationB
  @param $keyB - column in $relationB that must match $keyA in $relationA
  @param $conditions - array of string conditions (e.g. "relationA.colX = relationB.colY"); Default: empty array
  @return - multidimensional array of matched rows; empty array if no rows found; FALSE on error */
function dataJoin($relationA, $relationB, $keyA, $keyB, $conditions = array()) {  
  if ( !is_array($conditions) ) {
    return FALSE;
  }
  
  $db = connect();
  if (!$db) {
    return FALSE;
  }
  
  $query = "SELECT * FROM $relationA INNER JOIN $relationB ON $relationA.$keyA=$relationB.$keyB";
  $params = array();
  if ( !empty($conditions) ) {
    $p = parseConditions($conditions);
    if (!$p) {
      return FALSE;
    }
    
    $params = $p["params"];
    $query .= " WHERE ".implode(" AND ", $p["fields"]);
  }
  
  $stmt = $db->prepare($query);
  if (!$stmt) {
    disconnect($db);
    return FALSE;
  }
  
  $result = $stmt->execute($params);  
  if (!$result) {
    disconnect($db);
    return FALSE;
  }
  
  // fetch associative array 
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  disconnect($db);  
  return $results;
}

/* dataCount() - returns the distince count from $relation that match the given $condition under the joined tables
  @param $relation - string name of relation (e.g. "module", "material", "user", etc.)
  @oaram $selection - string name of the selected relation for the specific category label (on browse.php page)
  @param $conditions - array of string conditions (e.g. "fieldName = fieldValue"); Default: empty array
  @return - multidimensional array of matched rows; empty array if no rows found; FALSE on error */
  //WARNING: This funciton is not at all dynamic and made for one reason, browse.php cateory counters. 
  //Since this is a very specific requirement this function was made for optimization of browse.php and
  //not meant for other uses. 
function dataCount($relation, $selection, $conditions){
  if ( !is_array($conditions) ) {
    return FALSE;
  }
  
  $db = connect();
  if (!$db) {
    return FALSE;
  }
  

  $query = "SELECT COUNT(DISTINCT($selection.ModuleID)) FROM $relation RIGHT JOIN (modulecategories, moduletype, modulematerialslink, parentchild)" .
            " ON (modulecategories.ModuleID=module.ModuleID OR moduletype.ModuleID=module.ModuleID OR modulematerialslink.ModuleID=module.ModuleID" . 
                  " OR parentchild.ChildID=module.ModuleID)";

  $params = array();
  if ( !empty($conditions) ) {
    $p = parseConditions($conditions);
    if (!$p) {
      return FALSE;
    }

    $params = $p["params"];
    $query .= " WHERE ".implode(" AND ", $p["fields"]);
  }

  $stmt = $db->prepare($query);
  if (!$stmt) {
    disconnect($db);
    return FALSE;
  }
  
  $result = $stmt->execute($params);  
  if (!$result) {
    disconnect($db); 
    return FALSE;
  }
  
  // fetch associative array 
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  disconnect($db);  

  //Returns the count found in the associative array 
  $arrayValues = array_values($results[0]); 
  return $arrayValues[0];  
}

// private functions for PDO implementation

/* connect() - connect to the PDO database
    @return  - database connection on success, FALSE on error
*/
function connect() {  
  global $DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE, $DB_DSN;
  $db = FALSE;
  try {
    $db = new PDO($DB_DSN, $DB_USERNAME, $DB_PASSWORD);
  } catch(Exception $e) {
    return FALSE;
  }
  return $db;
}

/* disconnect() - disconnect from a PDO database
    @param $connection - PDO connection to disconnect from
    @return  - void
*/
function disconnect($connection) {
  $connection = NULL;
}


/* parseConditions() - parses conditions into fields & parameters for prepared statment
    @param $conditions - array of string conditions like "ModuleID = 15"
    @return 
        On success:  array of fields of conditions like:
              array (
                "fields => array("ModuleID = ?"),
                "params" => array("15")
              );
        On failure: FALSE
        
    NOTE: This function is dependent on the PHP SQL Parser
*/
function parseConditions($conditions) {

  $ATOMS_PER_CONDITION = 3; // e.g. "ModuleID = 15" has 3 (ModuleID, =, and 15)
  $parser = new PHPSQLParser();

  $fields = array();
  $params = array();
  
  foreach ($conditions as $c) {
    $sql = "WHERE " . $c;
    $p = $parser->parse($sql);
    $atoms = $p["WHERE"];
    
    // if a condition doesn't have the expected number of atoms,
    // it may have been hijacked by a SQL injection
    if (count($atoms) != $ATOMS_PER_CONDITION) {
      return FALSE;
    }
    
    $field = "";
    
    $operatorFound = FALSE;
    foreach ($atoms as $a) {
      switch($a["expr_type"]) {    
      
      case "colref":
        $field .= $a["base_expr"] . " ";
        break;
      
      case "operator":
        $field .= $a["base_expr"] . " ";
        $operatorFound = TRUE;
        break;
        
      case "const":
        $field .= "? ";
        // trim quotes from constant to prevent double-quoted strings
        $params[] = trim($a["base_expr"], '"\'');
        break;
        
      case "in-list":
        $qs = array_fill(0, count($a["sub_tree"]), "?");
        $field .= "(" . implode(",", $qs) . ")";
        foreach ($a["sub_tree"] as $c) {
          if ($c["expr_type"] != "const") {
            return FALSE;
          }
          $params[] = trim($c["base_expr"], '"\'');
        }
        break;
        
      default:
        return FALSE;
      }
    }
    
    if (!$operatorFound) {
      return FALSE;
    }
    
    $fields[] = $field;
  }
  
  return array("fields" => $fields, "params" => $params);
}

/* isPendingUser($email) - checks to see if a user is a pending user 
*	@params - $email - the email of the user you are checking 
* 	@returns - boolean (True, False)
*/
function isPendingUser($email){   
    $table = 'users'; 
    $conditions = array("Email='$email'", "Type='Pending'");
    $data = dataRead($table, $conditions); 
    if(is_array($data) && !empty($data)){
        return TRUE;
    }
    else{
        return FALSE;
    }
}
/* references($moduleID) - checks the references for modules 
*	@params - #moduleID - the module ID to check the database with 
*	@return - returns array of reference ID's
*/
function references($moduleID){
    $table = 'seealso';
	$conditions = array("ModuleID=$moduleID");
    $data = dataRead($table, $conditions);
	$referenceIDs = array();
    if (count($data) != FALSE && is_array($data)){
        foreach ($data as $id){
            array_push($referenceIDs, $id["ReferencedModuleID"]);
        }
    }
    return $referenceIDs;
}
/* checkSameReference($moduleID, $referenceID) - checks to see if references for modules are unique.
*	@params - $moduleID - the ID of the module you want to check
*			- $referenceID - the reference ID you are checking
*	@return - returns array of internal references that are attached to module
*/
function checkSameReference($moduleID, $referenceID){
    $internalReferences = getInternalReferences($moduleID);
    $seealso = array();
    foreach ($internalReferences as $references) {
      $referencedModule = references($moduleID);     
      array_push($seealso, $references["referencedModuleID"]);
    }
    return $seealso;
}
/* reOrder($table, $rawString, $moduleID) - This function changes the order of modules as they appear on EdRepo
*	@params - $table - the database table that will be affected 
*			- $rawString - $_REQUEST order given by html 
*			- $moduleID - ID of the module that needs to be moved (changing the OrderID in the database
*	@returns - boolean value (True or False)
*/
function reOrders ($table, $rawString, $moduleID) {
	if(!$rawString) {
		return FALSE; 
	}
	$output = array(); 
	$string = parse_str($rawString, $output); 
	
	if ($table == "seealso") {
		$conditions = "ReferencedModuleID"; 
	}
	else {
		$conditions = "ModuleID"; 
	}
	
	$return = FALSE; 
	global $DB_DATABASE, $DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD; 
	$connect = mysql_connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD); 
	mysql_select_db($DB_DATABASE, $connect); 
	$getQuery = "SELECT MAX(`$conditions`) FROM `$table`"; 
	$idData = mysql_query($getQuery); 
	$maxID = mysql_fetch_array($idData);
	
	for ($i = 0; $i <= $maxID[0]; $i++) {
	//Eventually change this to dataUpdate
		$moduleIDs = $output["order"][$i]; 
		$query = "UPDATE `$table` SET `OrderID`=$i WHERE `$conditions`=$moduleIDs"; 
		$data = mysql_query($query);
		if ($data) {
			$return = TRUE; 
		}
	}
	mysql_close($connect);
	return $return; 
}
/*getTypeAndGroupFromUser() - this function gets the default Type and Group for users from a .txt file and returns a multi-dimensional array of the result
								This funciton populates the drop down lists when creating default users on inital installation of MySQL
	@returns - multi-dimensional array where the first key points to default user types and the second key points to default user groups. 
*/
function getTypeAndGroupFromUser(){
	$configFilePath = dirname(__FILE__)."/userGroupsAndTypes.txt";
	$lines = file($configFilePath);
	$userTypes[] = explode(", ", rtrim($lines[0])); 
	$userGroups[] = explode(", ", rtrim($lines[1])); 
	return array($userTypes, $userGroups); 
}
/* readDefaultTypes() - purpose is to get default module types from .txt file and return them in an array with the SQL command
	@returns - multi dimensional array - returns default types and the default SQL command for inserting values into the database 
*/
function readDefaultTypes() {
	$configFilePath = dirname(__FILE__)."\defaultTypes.txt";
	$lines = file($configFilePath);
	$defaultCommand = 'INSERT INTO `type` (Name) VALUES '; 
	for($i = 0; $i < count($lines); $i++){ 
		$types[] = trim($lines[$i], "\n"); 
	}
	return array($types, $defaultCommand); 
}
?>