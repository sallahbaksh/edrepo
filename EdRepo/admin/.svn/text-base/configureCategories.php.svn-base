<?php session_start();
/****************************************************************************************************************************
 *    configureCategories.php - Allows editing of categories used in the collection.
 *    ---------------------------------------------------------------------------------------------------------
 *
 *  Version: 1.0
 *  Author: Ethan Greer
 *  Modified by: Jon Thompson (5/6/2011 - implement new interface/Smarty engine)
 * 
 *
 *  Notes: - Only Admins may use this page.
 *         - This page uses the following GET/POST parameters:
 *            categoryAction :  "display" (default) : currently does nothing additional because this page always displays
*                                                     all categories, with links to remove a category/add a new one, 
 *                        "doRemove" : remove a category
                          "doAdd" : add a category.
 *            categoryID : Used with the "doRemove" categoryAction to specify which category to delete.
 *            categoryName : Used with the "doAdd" categoryAction to specify the name of the category to add.
 *            categoryDescription : Used with the "doAdd" categoryAction to specify a description for the category to add.
 ******************************************************************************************************************************/
  
  require("../lib/config.php");
  
  $smarty->assign("title", $COLLECTION_NAME . " - Admin - Configure Categories");
    // title of this page. For most pages: &COLLECTION . " - Title" , default: $COLLECTION_NAME
  $smarty->assign("tab", "admin"); // active nav tab. default:  "home"
  $smarty->assign("baseDir", getBaseDir() ); // should always be getBaseDir() 
  
  $smarty->assign("pageName", "Admin - Configure Categories");
  
  $smarty->assign("alert", array("type"=>"", "message"=>"") );
  
  $categoryAction="display"; //Default categoryAction is to display categories.
  
  if(isset($_REQUEST["categoryAction"])) {
    $categoryAction=$_REQUEST["categoryAction"];
  }
  $smarty->assign("categoryAction", $categoryAction);


//Get array of categories to check against to ensure duplicates are not added
$result = dataRead("categories", array()); 

$categoryTypes = array(); 

foreach($result as $array)
{
  array_push($categoryTypes, strtolower($array["Name"]));
}


if(!(in_array("UseCategories", $backendCapabilities["read"]) && in_array("UseCategories", $backendCapabilities["write"]))) { //Check for the ability of the backend to use categories.
  $smarty->assign("useCategories", "false");
} else {
  $smarty->assign("useCategories", "true");
  
  
  if($categoryAction=="display") {
    // Do nothing additional.
    // Design has been changed to always display the categories, even if some other categoryAction is being performed
    // Display code is found after  add/remove code
    
  } elseif($categoryAction=="doRemove" && isset($_REQUEST["categoryID"]) && $userInformation["type"]=="Admin") { //If the categoryAction is doRemove and a categoryID was given, try to remove it.
    $result=removeCategory($_REQUEST["categoryID"]); //Remove specified category.  This function is also suppose to automatically remove any modules from the category as well, so no special categoryAction is needed here to keep the storage back-end consistant.
    if($result===FALSE || $result==="NotImplimented") { //Error
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Unabled to remove category.") );
    } else { //Successfully removed category
      $smarty->assign("alert", array("type"=>"positive", "message"=>"Category successfully removed.") );
    }
    
  } elseif($categoryAction=="doAdd" && isset($_REQUEST["categoryName"]) && isset($_REQUEST["categoryDescription"]) && $userInformation["type"]=="Admin"){

    //Not sure why this cannot combine with the if statement above without causing parse errors.... 
    //In general better programming practice is to declare variables at the top and use them rather than 
    //calling them over and over (like $_REQUEST) however this is older code 
    $categoryName = trim((string)$_REQUEST["categoryName"]);
    $categoryDescription = trim((string)$_REQUEST["categoryDescription"]); 
    if (empty($categoryName) || empty($categoryDescription)){
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Unabled to add category. Ensure you have added both name and description.") );
    } 
    else if (in_array(strtolower($categoryName), $categoryTypes)){
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Category already exists with that name.") );
    }
    else{
      $result=createCategory($_REQUEST["categoryName"], $_REQUEST["categoryDescription"]);
      if($result===FALSE || $result=="NotImplimented") { //Failed to create new category
        $smarty->assign("alert", array("type"=>"negative", "message"=>"Failed to create to category.</p>") );
      } else { //Success
        $smarty->assign("alert", array("type"=>"positive", "message"=>"Category successfully created.") );
      }
    }
  } else if ($categoryAction == "edit" && $userInformation["type"]=="Admin" && isset($_REQUEST["categoryID"])){
	$categoryInfo = getCategoryByID($_REQUEST["categoryID"]);  
	$smarty->assign("categoryID", $_REQUEST["categoryID"]); 
	$smarty->assign("categoryInfo", $categoryInfo); 
	
  } else if ($categoryAction == "doEdit" && $userInformation["type"]=="Admin" && isset($_REQUEST["categoryID"]) && isset($_REQUEST["editCategoryName"]) && isset($_REQUEST["editCategoryDescription"])){
	$result=editCategory($_REQUEST["categoryID"], $_REQUEST["editCategoryName"], $_REQUEST["editCategoryDescription"]);
    if($result===FALSE || $result==="NotImplimented") { //Failed to create new category
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Failed to edit to category.</p>") );
    } else { //Success
      $smarty->assign("alert", array("type"=>"positive", "message"=>"Category successfully edited.") );
    }  
  }
  // Send categories to Smarty for display AFTER adding or removing with the above categoryActions
  $categories=getAllCategories(); //Get all categories currently in this collection.
  if($categories===FALSE || $categories=="NotImplimented" || count($categories)<=0) { //Make sure there wasn't an error getting categores and that at least one was found.
    $smarty->assign("noCategories", "true");
  } else { //This else block runs if we got at least one category.
    $smarty->assign("noCategories", "false");
    $smarty->assign("categories", $categories);
  }
}

  $smarty->display('configureCategories.php.tpl');

?>