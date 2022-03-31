<?php session_start();
/****************************************************************************************************************************
 *    installmysql.php - The part of the installation page for Edrepo that sets up the default MySQL back-end
 *    --------------------------------------------------------------------------------------
 *  Sets up the default MySQL back-end, other options for alternate backends can be added as needed.
 *
 *  Version: 1.0
 *  Author: Ben Kos
 *  Date: 8 July 2011
 *
 *  Notes: Only needs to be run when the user is first setting everything up.
 ******************************************************************************************************************************/

  //require("lib/backends/pdo/datamanager.php"); 
  require("lib/smarty/smarty.php");
  require("lib/look/look.php");
  require("lib/config/config.php");
  require("lib/config/header.php");
  require("lib/config/footer.php");
  require("lib/model/utility.php");
  require("lib/model/user.php"); 
  // assign the collection name to Smarty
  $smarty->assign("COLLECTION_NAME", $COLLECTION_NAME);
  
  // assign the active "look" directory to Smarty
  $smarty->assign("LOOK_DIR", $LOOK_DIR);
  $smarty->assign("loggedIn", false);
  // assign array of header config settings to Smarty
  $smarty->assign("HEADER", $HEADER );
  // assign array of footer config settings to Smarty
  $smarty->assign("FOOTER", $FOOTER );
 
 $smarty->assign("title", "Edrepo MySQL Installation"); // Sets title to "Edrepo Installation."
 $smarty->assign("pageName", "MySQL Installation");
 $smarty->assign("tab", "Home"); // Sets up tab interface.
 $smarty->assign("baseDir", getBaseDir() ); // Needed for all files.
 $smarty->assign("alert", array("type"=>"", "message"=>"") );

	if( $_REQUEST["backend_type"] = "Custom") {
		$action="skipPage"; 
	}
	
	$action = "displayConnection";
	if(isset($_REQUEST["action"])) {
		$action=$_REQUEST["action"];  // Default action set to displayConnection. Changes to makeConnection and installConnection
	}								  // after the user fills out necessary information.
	
	//These three functions get the action for type configuration 
	$types = readDefaultTypes();
	if(isset($_REQUEST["type"]) && $_REQUEST["type"] == "Select"){
		$action = "Select"; 
	}
	if(isset($_REQUEST["type"]) && $_REQUEST["type"] != "Select"){
		$action="addExtras"; 
	}
	
 $smarty->assign('action', $action) ;
 
 if ($action=="displayConnection") { // Collects information to connect to MySQL.
 //$smarty->assign("mysqlServer", $mysqlServer);
 //$smarty->assign("mysqlUser", $mysqlUser);
 //$smarty->assign("mysqlPass", $mysqlPass);
 }
  if ($action=="makeConnection") {    // Collects information to create database.
    $mysqlServer=$_REQUEST['mysqlservername']; 
    $mysqlUser=$_REQUEST['mysqlusername'];
    $mysqlPass=$_REQUEST['mysqlpass'];
    $mysqlConnection = mysql_connect($mysqlServer,$mysqlUser,$mysqlPass);
    if ($mysqlConnection!==FALSE) {
      $smarty->assign("alert", array("type"=>"positive", "message"=>"MySQL login details verified.") ) ;
      $_SESSION['mysqlservername'] = $mysqlServer;
      $_SESSION['mysqlusername'] = $mysqlUser;
      $_SESSION['mysqlpass'] = $mysqlPass; 
    }
    if ($mysqlConnection==FALSE) {
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Error connecting to MySQL. Please check your login details.") ) ;
    }
	}
  if ($action=="installConnection") {  // Runs the needed MySQL queries.
    $mysqlServer=$_SESSION['mysqlservername']; 
    $mysqlUser=$_SESSION['mysqlusername'];
    $mysqlPass=$_SESSION['mysqlpass'];
    $mysqlConnection = mysql_connect($mysqlServer,$mysqlUser,$mysqlPass);

	if ($mysqlConnection!==FALSE && $mysqlConnection!==NULL) {
      if ( install($mysqlConnection) === TRUE) {
        $smarty->assign("alert", array("type"=>"positive", "message"=>"MySQL back-end successfully installed.") ) ;        
      }
      mysql_close($mysqlConnection);
    }
	else {
		$smarty->assign("alert", array("type"=>"negative", "message"=>"Error connecting to MySQL. Please check your login details. <br />" )) ;
	}
   }
	
  $defaultTypes = readDefaultTypes(); 
  if ($action = "addExtras") {
	$smarty->assign("counter", 0); 
	$smarty->assign("typeArray", $defaultTypes[0]); 
	addExtraUsers($_POST); 
  } 
  if (count($_POST) > 0){
  	$selectedTypes = $_POST["types"];
  	$command = $_POST["type"];
  	installTypes($command, $selectedTypes, $defaultTypes);
  }
  
 

  /**	installTypes($command, $selectedTypes, $defaultTypes) - installs types into the database when installing mySQL
		@params - $command - the post variable for type that relays the command from the TPL page
				- $selectedTypes - if the user selects the types they want to install this will be the array of types 
									that will be used to install those selected types. 
				- $defaultTypes - this is the default types (30) taken from a text file and put into a multi-dimensional
									array, this funcitno takes the first key [0] of this array to get all default values
  **/
	function installTypes($command, $selectedTypes, $defaultTypes){
	  global $smarty; 
	  if ($command) {
		$mysqlServer=$_SESSION['mysqlservername']; 
		$mysqlUser=$_SESSION['mysqlusername'];
		$mysqlPass=$_SESSION['mysqlpass'];
		$mysqlConnection = mysql_connect($mysqlServer,$mysqlUser,$mysqlPass);
		
		//Setting the types and trying to figure out how to call a query from the code 
		if ($mysqlConnection!==FALSE && $mysqlConnection!==NULL) {
			if(!mysql_query("TRUNCATE TABLE `edrepo`.`type`", $mysqlConnection)){
				$smarty->assign("alert", array("type"=>"negative", "message"=>"Something went wrong while installing the types. Please contact an administrator.")); 
			}
			if ($command == "Selected"){
				for ($i = 0; $i < count($selectedTypes); $i++){ 
					$type = $selectedTypes[$i]; 
					$sql = "INSERT INTO `edrepo`.`type` (`TypeID`, `Name`) VALUES (NULL, \"$type\" );";
					if(!mysql_query($sql, $mysqlConnection)){
						$smarty->assign("alert", array("type"=>"negative", "message"=>"Something went wrong while installing the types. Please contact an administrator.")); 
					}
				}
			}
			else if ($command == "*"){
				for ($i = 0; $i < count($defaultTypes[0]); $i++){
					$type = $defaultTypes[0][$i]; 
					$sql  = "INSERT INTO `edrepo`.`type` (`TypeID`, `Name`) VALUES (NULL, \"$type\" );";
					if(!mysql_query($sql, $mysqlConnection)){
						$smarty->assign("alert", array("type"=>"negative", "message"=>"Something went wrong while installing the types. Please contact an administrator.")); 
					}
				}
			}
			else if ($command == "None") {
				//Nothing happens  
			}
			else {
				for ($i = 0; $i < count($defaultTypes[0]); $i++){
					$type = $defaultTypes[0][$i]; 
					$sql  = "INSERT INTO `edrepo`.`type` (`TypeID`, `Name`) VALUES (NULL, \"$type\" );";
					if(!mysql_query($sql, $mysqlConnection)){
						$smarty->assign("alert", array("type"=>"negative", "message"=>"Something went wrong while installing the types. Please contact an administrator.")); 
					}
				}
			}
		}
		mysql_close($mysqlConnection); 
	   }
	}
  /** sqlDump($filename) - Loads a MySQL dump file into a database.
          Note: the MySQL connection must be open and the desired databse selected
          Function based on code written by:
             Daniel15 <http://dan.cx/blog/2006/12/restore-mysql-dump-using-php>
             
         @param  $filename  path of the file to dump
         @return  TRUE on success */
  function sqlDump($filename) {
    // Temporary variable, used to store current query
    $templine = '';
    // Read in entire file
    $lines = file($filename);
    // Loop through each line
    foreach ($lines as $line)
    {
        // Skip it if it's a comment
        if (substr($line, 0, 2) == '--' || $line == '')
            continue;
     
        // Add this line to the current segment
        $templine .= $line;
        // If it has a semicolon at the end, it's the end of the query
        if (substr(trim($line), -1, 1) == ';')
        {
            // Perform the query
            mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
            // Reset temp variable to empty
            $templine = '';
        }
    }
    return true;
  }
  
  /** 
        install($mysqlConnection) - Creates/accesses the EdRepo database
        @param  $mysqlConnection  connection to the MySQL database
        @return TRUE on success; FALSE on error (error is sent via $smarty)
     */
  function install($mysqlConnection) {
    global $smarty; // get access to smarty

    // Create edrepo user
    if ( !mysql_query("CREATE USER 'edrepo'@'localhost' IDENTIFIED BY 'edrepo' ;",$mysqlConnection) ) {
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Error creating user.<br />". mysql_error($mysqlConnection)) ) ;
      return false;
    }
    // Create database
    if ( !mysql_query("CREATE DATABASE edrepo;",$mysqlConnection) ) {
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Error creating database.<br />" . mysql_error($mysqlConnection)) ) ;
      return false;
    }
    // Select database
    if ( !mysql_query("USE edrepo;",$mysqlConnection) ) {
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Error selecting EdRepo database.<br />" . mysql_error($mysqlConnection)) ) ;
      return false;
    }
    // Import database tables
    if ( !sqlDump('lib/backends/pdo/mysql.sql') ) {
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Error importing EdRepo database.<br />" . mysql_error($mysqlConnection)) ) ;
      return false;
    }
    // Grant priveleges
    if ( !mysql_query("GRANT ALL PRIVILEGES ON edrepo.* TO 'edrepo'@'localhost'; ",$mysqlConnection) ) {
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Error granting privileges on EdRepo database.<br />" . mysql_error($mysqlConnection)) ) ;
      return false;
    }
    
    // if the function makes it here, everything worked
    return true;
  }
 
 /* addExtraUsers($post) - this will add users when installing MySQL
	@params - $post - is the $_POST variable from the .tpl(HTML) page. 
 */
  function addExtraUsers($post) {
		global $smarty; 
		$typesName = array(); 
		$values = array(); 
		$relation = "users"; 
		unset($post["action"]);
		//Strips the input to variables that can be read by name and value in two arrays. The keys will match each other for the name to value assignments 
		//Ex: [0] => Email ---- [0] => thisIsAn@email.com
		foreach ($post as $typeName => $value) {
			$typeName = preg_replace('/[0-9]+/', '', $typeName); 
			$typeName = preg_replace('/Accounts/','', $typeName); 
			$type = substr($typeName, 8); 
			array_push($typesName, $typeName); 
			array_push($values, $value); 
		}
		$email = array(); 
		$firstName = array(); 
		$lastName = array(); 
		$password = array(); 
		$types = array(); 
		$group = array();  
		for ($i = 0; $i < count($_POST)-1; $i++) {	
			if ($typesName[$i] == 'Email'){
				$email[] = $values[$i]; 
			}
			else if ($typesName[$i] == 'FirstName'){
				$firstName[] = $values[$i]; 
			}
			else if ($typesName[$i] == 'LastName'){
				$lastName[] = $values[$i]; 
			}
			else if ($typesName[$i] == 'Password'){
				$password[] = $values[$i]; 
			}
			else if ($typesName[$i] == 'Type') {
				$type[] = $values[$i]; 
			}
			else if ($typesName[$i] == 'Group') {
				$group[] = $values[$i]; 
			}
		}
		for ($i = 0; $i < count($email); $i++){
			if (!createUser($email[$i], $firstName[$i], $lastName[$i], $password[$i], $type[$i], $group[$i], "FALSE")){
				$smarty->assign("alert", array("type"=>"negative", "message"=>"Error creating user.<br />")); 
			}
		}
  }
  
  
 //This calls the getTypeAndGroupFromUser function from the dataManager page which will get the default user types and groups in a multidimensional array 
 $userColumnInfo = getTypeAndGroupFromUser(); 
 $smarty->assign("userTypes", current($userColumnInfo[0])); 
 $smarty->assign("userGroups", current($userColumnInfo[1])); 
  
 $smarty->display("installmysql.php.tpl");
 
 ?>