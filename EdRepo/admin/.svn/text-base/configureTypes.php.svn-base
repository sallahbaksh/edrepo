<?php session_start();
/****************************************************************************************************************************
 *    configureTypes.php - Allows editing of types used in the collection.
 *    ---------------------------------------------------------------------------------------------------------
 *
 *  Version: 1.0
 *  Author:  Jon Thompson
 * 
 *
 *  Notes: - Only Admins may use this page.
 *         - This page uses the following GET/POST parameters:
 *            action :  "display" (default) : currently does nothing additional because this page always displays
*                                                     all types, with links to remove a type/add a new one, 
 *                        "doRemove" : remove a type
                          "doAdd" : add a type.
 *            typeID : Used with the "doRemove" action to specify which type to delete.
 *            typeName : Used with the "doAdd" action to specify the name of the type to add.
 ******************************************************************************************************************************/
  
  require("../lib/config.php");

  $smarty->assign("title", $COLLECTION_NAME . " - Admin - Configure Types");
    // title of this page. For most pages: &COLLECTION . " - Title" , default: $COLLECTION_NAME
  $smarty->assign("tab", "admin"); // active nav tab. default:  "home"
  $smarty->assign("baseDir", getBaseDir() ); // should always be getBaseDir() 
  
  $smarty->assign("pageName", "Admin - Configure Types");
  
  $smarty->assign("alert", array("type"=>"", "message"=>"") );
  
  $action="display"; //Default action is to display types.
  if(isset($_REQUEST["action"])) {
    $action=$_REQUEST["action"];
  }
  $smarty->assign("action", $action);
  

  $result = dataRead("categories", array()); 

  $types = array(); 

  foreach($result as $array)
  {
    array_push($types, strtolower($array["Name"]));
  }



if(!(in_array("UseTypes", $backendCapabilities["read"]) && in_array("UseTypes", $backendCapabilities["write"]))) { //Check for the ability of the backend to use types.
  $smarty->assign("useTypes", "false");
} else {
  $smarty->assign("useTypes", "true");
  
  
  if($action=="display") {
    // Do nothing additional.
    // Design has been changed to always display the types, even if some other action is being performed
    // Display code is found after  add/remove code
    
  } elseif($action=="doRemove" && isset($_REQUEST["typeID"]) && $userInformation["type"]=="Admin") { //If the action is doRemove and a typeID was given, try to remove it.
    $result=removeType($_REQUEST["typeID"]); //Remove specified type.  This function is also suppose to automatically remove any modules from the type as well, so no special action is needed here to keep the storage back-end consistant.
    if($result===FALSE || $result==="NotImplimented") { //Error
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Unabled to remove type.") );
    } else { //Successfully removed type
      $smarty->assign("alert", array("type"=>"positive", "message"=>"Type successfully removed.") );
    }
    
  } elseif($action=="doAdd" && isset($_REQUEST["typeName"]) && $userInformation["type"]=="Admin") {
    $result=createType($_REQUEST["typeName"]);
    if($result===FALSE || $result=="NotImplimented") { //Failed to create new type
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Failed to create to type.</p>") );
    }
    else if (in_array(strtolower($_REQUEST["typeName"]), $types)){
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Type already exists with that name.") );
    } else { //Success
      $smarty->assign("alert", array("type"=>"positive", "message"=>"Type successfully created.") );
    }
    
  } else { //Unknown/unhandled action specified.
    echo '<h1>Unknown or Unhandled Action Specified</h1>';
  }
  
  
  // Send types to Smarty for display AFTER adding or removing with the above actions
  $types=getAllTypes(); //Get all types currently in this collection.
  if($types===FALSE || $types=="NotImplimented" || count($types)<=0) { //Make sure there wasn't an error getting types and that at least one was found.
    $smarty->assign("noTypes", "true");
  } else { //This else block runs if we got at least one type.
    $smarty->assign("noTypes", "false");
    $smarty->assign("types", $types);
  }
}

  $smarty->display('configureTypes.php.tpl');

?>