<?php session_start();
/****************************************************************************************************************************
 *    browse.php - Provides methods to browse the collection.
 *    -------------------------------------------------------
 *  Allows browsing the collection (searching with set criteria) by various parameters.
 *
 *  Version: 1.0
 *  Author: Ethan Greer
 *
 *  Modified: 2011-05-02 by Jon Thompson (implementing new interface)
 *
 *  Notes: - This page can take the following GET/POST parameters:
 *            page : If more than recordsPerPage results are found, than they are displayed in multiple pages, with each page
 *              containing up to resultsPerPage number of records.  The page parameter determines which page to display.  It will
 *              be automatically decreased to the largest page with records on it.  Default is 1 (the fitst page).  Only positive
 *              numbers should be passed to this parameter (0 or negative numbers will result in no records being displayed, regardless
 *              of the value of this parameter or how many records actually match the given criteria).
 *            recordsPerPage : The number of results to show per page.  Default is 15.
 ******************************************************************************************************************************/

require("lib/config.php");

$smarty->assign("title", $COLLECTION_NAME . ' - Browse');
  // title of this page. For most pages: &COLLECTION . " - Title" , default: $COLLECTION_NAME
$smarty->assign("tab", "browse"); // active nav tab. default:  "home"
$smarty->assign("baseDir", getBaseDir() ); // should always be getBaseDir() 

$smarty->assign("pageName", "Browse " . $COLLECTION_NAME);
  // name of page to placed in <h1> tag

  
$page=1; //The "page" we are on (default, 1 (first)
$recordsPerPage=15; //The number of records to display per page (default, 15)

 $_SESSION["totalCount"] = 0; //The number of total modules there are in the database. 

if(isset($_REQUEST["page"])) {
  $page=$_REQUEST["page"];
}
if(isset($_REQUEST["recordsPerPage"])) {
  $recordsPerPage=$_REQUEST["recordsPerPage"];
}

$sortBy = "title";
if ( isset($_REQUEST["sortBy"]) ) {
  $sortBy = $_REQUEST["sortBy"];
} elseif ( isset($_SESSION["sortBy"]) ) {
  $sortBy = $_SESSION["sortBy"];
}
$_SESSION["sortBy"] = $sortBy;
$smarty->assign("sortBy", $sortBy);


if (!isset($userInformation)) {
  $userInformation["type"] = "Unregistered";
}

$adminOrEditor = ($userInformation["type"] == "Admin" || $userInformation["type"] == "Editor");
$admin = ($userInformation["type"] == "Admin"); 
$smarty->assign("adminOrEditor", $adminOrEditor);
$smarty->assign("admin", $admin); 

// if filter form submitted, update the filters accordingly
// then reload this page to clear $_POST data
if ($_POST) {
  updateFilters($userInformation);
  header("Location: ".$_SERVER['REQUEST_URI']);
  exit();
}

$filters = getFilters($userInformation);

// module title can also be sent to this page via GET by using the search bar
if (isset($_GET["moduleTitle"])) {
  $filters["title"] = $_GET["moduleTitle"];
}

$smarty->assign("filters", $filters);

$smarty->assign("recordsPerPage", $recordsPerPage);

$records = searchModules($filters); //Get all records matching the query, but only records which are Active in the collection.

$typeCount = getOriginalTypeCount();  
$categoryCount = getOriginalCategoryCount(); 
$statusCount = getOriginalStatusCount(); 
//getOriginalCount(); 

$smarty->assign("typeCount", $typeCount); 
$smarty->assign("categoryCount", $categoryCount); 
$smarty->assign("statusCount", $statusCount); 


/**getOriginalCount()-Gets the counts for everytime on page load to speed up count calculation - split into multiple functions below
**/
/*function getOriginalCount(){
  //Get Types
  $query = "SELECT type.Name, COUNT(1) AS `num` FROM `moduletype`, `type` WHERE moduletype.TypeID = type.TypeID GROUP BY moduletype.TypeID";
  $typeCount = runQuery($query); 

  //Get Categories
  $query = "SELECT categories.Name, COUNT(1) as `num` FROM modulecategories, categories WHERE modulecategories.CategoryID = categories.CategoryID GROUP BY modulecategories.CategoryID"; 
  $categoryCount = runQuery($query); 
}*/

function getOriginalCountWithPermissions()
{
  /*MinUser
  "Viewer"
  "SuperViewer"
  "Submittor"
  "Editor"
  "Admin"

  Restrictions
  "Temp"
  "Student"
  "Teacher"
  "Professor"
  "Principle"
  "Dean"
  "President"
  "Admin"
  */


  $query = "";
}

function getOriginalTypeCount()
{
  //Get Types
  $query = "SELECT type.Name as `Name`, COUNT(1) AS `Num` FROM `moduletype`, `type` WHERE moduletype.TypeID = type.TypeID GROUP BY moduletype.TypeID";
  $typeCount = runCountQuery($query);
  return $typeCount; 
}

function getOriginalCategoryCount()
{
  //Get Categories
  $query = "SELECT categories.Name as `Name`, COUNT(1) as `Num` FROM modulecategories, categories WHERE modulecategories.CategoryID = categories.CategoryID GROUP BY modulecategories.CategoryID"; 
  $categoryCount = runCountQuery($query);
  return $categoryCount; 
}

function getOriginalStatusCount()
{
  //Get status from modules
  $query = "SELECT module.Status as `Name`, COUNT(1) as `Num` FROM module GROUP BY module.Status"; 
  $statusCount = runCountQuery($query); 
  return $statusCount; 
}

/**amountOfModuleInTypes($type, $id, $filters)
  @param - $type - The type of filters selected (ex: category) this helps have one function for many types
  @param - $id - the id in the type of filter (ex: used to make the distinction of categories in that section)
  @param - $filters - all selected filters with unique selections
  @returns - the total amount of modules in the current filterd sections keeping in mind other selected fields
**/
//function amountOfModules($type, $id, $filters, $name, $typeCount, $categoryCount) {
function amountOfModules($type, $name, $typeCount, $categoryCount, $statusCount) {
  if($type == "ALL"){
      return $_SESSION["totalCount"]; 
  }

  if ($type == "category")
  {
    return $categoryCount[$name]; 
  }
  else if($type == "type")
  {
    return $typeCount[$name];
  }
  else if($type == "status")
  {
    return $statusCount[$name]; 
  }
  else if ($type == "hasMaterial" || $type == "topLevel")
  {

  }


  /*$addID = array(); 
  $addID[$type] = array($id); 
  $withFilters = array();

  //This foreach loop will replace the array of filters with an array of filters that have values and then check to see if 
  //the user has any keys matching to the current filters and merge them
  foreach ($filters as $key => $value) {
    if (!empty($filters[$key])){ 
        if ($key == $type && is_array($filters[$key]))
        {
          //This line and a change in the SQL query in the datamanager.php will allow dynamic counters 
          //THis is not necessary at this point, and it has been decided that this does not need to be implemented at this point 
          //$withFilters[$key] = array_merge($filters[$key], $addID[$key]);
          
          $withFilters[$key] = $addID[$key]; 
        }
    }
  }

  //Uncomment this 
  //$amount = findFilterCount($type, $withFilters); 
  return $amount;*/
}


/*checkFilters($filters) - this will check all the filters to make sure they are not * or empty and will give an array of filters selected
    @params - $filters - all filters selected 
    @return - an array of no unique filters to be pushed to smarty for handeling later
*/
function checkFilters($filters){
  $otherFilters = array(); 
  if($filters["category"][0] == "*" && $filters["type"][0] == "*" && $filters["status"][0] == "*" && empty($filters["hasMaterial"]) && 
    empty($filters["topLevel"]) && empty($filters["title"])){
  }
  else{
    if(empty($filters["title"]) == FALSE){
      $otherFilters["title"] = $filters["title"]; 
    }
    if($filters["category"][0] !== "*"){
      $otherFilters["category"] = $filters["category"][0]; 
    }
    if($filters["type"][0] !== "*"){
      $otherFilters["type"] = $filters["type"][0]; 
    }
    if($filters["status"][0] !== "*"){
      $otherFilters["status"] = $filters["status"][0]; 
    }
    if(empty($filters["topLevel"]) == FALSE){
      $otherFilters["topLevel"] = $filters["topLevel"]; 
    }
    if(empty($filters["hasMaterial"]) == FALSE){
      $otherFilters["hasMaterial"] = $filters["hasMaterial"]; 
    }
  }
  return $otherFilters; 
}
$otherFilters = checkFilters($filters);
$smarty->assign("otherFilters", $otherFilters);

/*
//The block of code here will display the count of modules depending on their restrictions
/*function amountOfRestrictions ($filter) {
  $filters["groups"] = array($filter); 
  $amount = count(searchModules($filters));
  return $amount; 
}*/

if($records===FALSE || $records=="NotImplimented") { //Did searching for records return an error or a "NotImplimented"?
  $smarty->assign("moduleError", "true");
} else { //This else block runs if searching for records to browse by did not return an error.
  $smarty->assign("moduleError", "false");
  
  //If the backend supports using categories, also give options to browse by category.
  $useCategories = false;
  if(in_array("UseCategories", $backendCapabilities["read"])) {
    $categories = getAllCategories(); //Get a list of all categories.
    if ( !empty($categories) ) {
      $useCategories = true;
      $smarty->assign("categories", $categories);
    }
  }
  $smarty->assign("useCategories", $useCategories);
  
  //If the backend supports using types, also give options to filter by type.
  $useTypes = false;
  if(in_array("UseTypes", $backendCapabilities["read"])) {
    $types = getAllTypes(); //Get a list of all types.
    if ( !empty($types) ) {
      $useTypes = true;
      $smarty->assign("types", $types);
    }
  }
  $smarty->assign("useTypes", $useTypes);

  /* Assign total number of records to smarty */
  $smarty->assign("numRecords", count($records) );
  
  if(count($records)>0) { //At least one record was found.    
    switch ($sortBy) {
      case "title":
        sortModulesByTitle($records);
        break;
      case "dateAsc":
        sortModulesByDate($records, TRUE);
        break;
      case "dateDesc":
        sortModulesByDate($records, FALSE);
        break;
      default:
        sortModulesByTitle($records);
    }
    
    // lowest index in the $records array to display
    $lowerLimit = $recordsPerPage * ($page - 1); 
    // highest index in the $records array to display
    $upperLimit = $lowerLimit + $recordsPerPage;
    /* It is possible that records were found but the page/recordsPerPage combination is beyond the number of records (meaning no records would be displayed).  If this is true,
             decrease the page until it is small enough to show some results. */
    while(count($records)<$lowerLimit) {
      $page=$page-1;
      $lowerLimit = $recordsPerPage * ($page - 1);
      $upperLimit = $lowerLimit + $recordsPerPage;
    }
    
    $smarty->assign("page", $page);
    $smarty->assign("lowerLimit", $lowerLimit);
    $smarty->assign("upperLimit", $upperLimit);
    
    
    $recordCategories = array();
    //Loop through records, starting at the lowest index and continuing as long as $i doesn't grow beyond the length of $records and doesn't exceed the upperLimit.
    for($i=$lowerLimit; ($i<$upperLimit && $i<count($records))  ; $i++) {
        $moduleID = $records[$i]["moduleID"];
        
        $records[$i]["hasMaterials"] = hasMaterials($moduleID);
    
        $categories = getModuleCategoryIDs($moduleID);
        if($categories!==FALSE) {
          $myCategories = ""; // empty string to store module [i]' s categories
          for($j=0; $j<count($categories); $j++) {
            $category=getCategoryByID($categories[$j]);
            $myCategories .= $category["name"].'<br />'; // add category to this module's string
          }
          
          $recordCategories[$i] = $myCategories; // add module [i]'s string of categories to array of all modules' categories
        } else { //Error getting categories for module.
          $recordCategories[$i] = 'Error getting module categories.  ';
        }
    }
    $smarty->assign("recordCategories", $recordCategories);
    
    // Calculate number of pages needed by dividing Number of records by Records per page and rounding up with ceil()
    $numPages = ceil(count($records)/$recordsPerPage); 
    $smarty->assign("numPages", $numPages);
    
  } // end if(count($records)>0)
} // end if checking $records for failure

$_SESSION["totalCount"] = count($records); 

$smarty->assign("records", $records);

$smarty->display('browse.php.tpl');


/* getFilters() - Returns the saved filters (or default filters if none saved)
  @params - userInformation to check user type
     @return - Returns array of filters 
*/
function getFilters($userInfo) {
  $filters = getDefaultFilters($userInfo);
  
  if (isset($_SESSION["filters"])) {
    $filters = $_SESSION["filters"];
  }

  return $filters;
}

/* getDefaultFilters() - Returns default filters
  @params - $userInfo to check user type
     @return - array of filters
*/
function getDefaultFilters($userInfo) {
  $filters = array();
  
  $filters["title"] = "";
  $filters["category"] = array("*");
  $filters["type"] = array("*");

  // add status filter to only get active modules
  if ($userInfo["type"] == "Admin") {
  $filters["status"] = array("*");
  }
  else {
  $filters["status"] = array("Active"); 
  }
  
  return $filters;
}

/* updateFilters() - saves filters to $_SESSION
    @param $userInfo - array of user information
    @return void
*/
function updateFilters($userInfo) {
  $defaultFilters = getDefaultFilters($userInfo);

  // if clearing filters, use defaults
  if ( isset($_POST["clearFilters"]) ) {
    $_SESSION["filters"] = $defaultFilters;
    return;
  }
  
  $filters = $defaultFilters;
  
  // grab any saved filters from the session
  if ( isset($_SESSION["filters"]) && !empty($_SESSION["filters"]) ) {
    $filters = $_SESSION["filters"];
  } 
  
  if ( isset($_POST["moduleTitle"]) ) {
    $filters["title"] = $_POST["moduleTitle"];
  }
  if ( isset($_POST["moduleCategory"]) ) {
    $filters["category"] = $_POST["moduleCategory"];
  }
  if ( isset($_POST["moduleType"]) ) {
    $filters["type"] = $_POST["moduleType"];
  }
  if ( ($userInfo["type"] == "Admin" || $userInfo["type"] == "Editor") &&
       isset($_POST["moduleStatus"])
  ) {
    $filters["status"] = $_POST["moduleStatus"];
  }
  
  $filters["topLevel"] = isset($_POST["topLevel"]);
  $filters["hasMaterial"] = isset($_POST["hasMaterial"]);
  
  // save the filters to the session
  $_SESSION["filters"] = $filters;
}

/*searchParameters($searchParameters) - this function is returning the amount of modules dynamically in a specific category using filters 
                                        given from checkboxes. This code is an adaptation of the code in the module.php page. However in 
                                        order to create a fast enough algoritm I chose to re-work this function. Dynamically counting the 
                                        amount means that when a filter is selected and updated the page will re-count the modules in eahc
                                        section keeping in mind the seleced filter(s). 
    @params - $type - the type of filter you are counting
    @params - $searchParamters - total amount of filters given to the function 
    #return - number of modules in the filter(s).

*/
function findFilterCount($type, $searchParameters) {

  $conditions = array(); 

  $categoriesParam= "modulecategories"; 
  $categoryField = ".CategoryID="; 
  $typeParam = "moduletype";
  $typeField = ".TypeID="; 
  $statusParam = "module";
  $statusField = ".Status=";
  $hasMaterialParam = "modulematerialslink";
  $hasMaterialField = ".ModuleID=";  
  $topModuleParam = "parentchild";
  $topModuleField = ".ModuleID=";  

  //This form loop will put together the conditions to search from in the specific manor needed for PDO
  foreach ($searchParameters as $pKey => $parameters) 
  {
    if(is_array($parameters))
    {
      foreach ($parameters as $key => $parameter)
      {
        if ($parameter != "*")
        {
          if($pKey == "category")
          {
              array_push($conditions, $categoriesParam.$categoryField.$parameter); 
          } 
          elseif($pKey == "type")
          {
              array_push($conditions, $typeParam.$typeField.$parameter);
          }
          elseif($pKey == "status")
          {
              array_push($conditions, $statusParam.$statusField."'".$parameter."'");
          }
        }
      }
    }
    else
    {
        if ($parameters != "*")
        {
          if($pKey == "category")
          {
              array_push($conditions, $categoriesParam.$categoryField.$parameters); 
          } 
          elseif($pKey == "type")
          {
              array_push($conditions, $typeParam.$typeField.$parameters);
          }
          elseif($pKey == "status")
          {
              array_push($conditions, $statusParam.$statusField."'".$parameters."'");
          }
          elseif($pKey == "topLevel")
          {
              array_push($conditions, $topModuleParam.$topModuleField.$parameters);
          }
          elseif($pKey == "hasMaterial")
          {
              array_push($conditions, $hasMaterialParam.$hasMaterialField.$parameters); 
          }
        }
    }
  }

  //Seperate from above. This helps decide what type of count to return. 
  $selection = "module"; 
  if($type == "category")
  {
    $selection = $categoriesParam; 
  } 
  elseif($type == "type")
  {
    $selection = $typeParam; 
  }
  elseif($type == "status")
  {
    $selection = $statusParam; 
  }
  elseif($type == "topLevel")
  {
    $selection = $topModuleParam; 
  }
  elseif($type == "hasMaterial")
  {
    $selection = $typeParam; 
  }

  $labelCount = dataCount("module", $selection, $conditions); 

  return $labelCount; 

}

?>
