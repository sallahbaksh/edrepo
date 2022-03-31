<?php session_start();
/*********************************************************************************************************
 *      rate.php - Allows users to leave ratings/comments for modules and materials.
 *      ----------------------------------------------------------------------------
 *
 * Author: Ethan Greer
 * Version: 1
 *  Modified by: Jon Thompson (5/20/2011)
 *
 * Notes: - This takes the following GET/POST parameters:
 *            action : The action to take.  One of "display" (default) or "doRate"
 *            moduleID
 *              -OR-
 *            materialID
 *                  Which specifies either a moduleID or a materialID to rate.  This page will automatically
 *                  determine if it should rate a material or module based on if moduleID or materialID was given.
 *            rating : The rating the user gave the module/material (only used with the "doRate" action).
 *            comment : Text of any comment left by the user (only used with the "doRate" action).
 *            subject : Text of any comment title left by the user (only used with the "doRate" action).
 **********************************************************************************************************/
 
  require("lib/config.php");

  $smarty->assign("title", $COLLECTION_NAME . ' - Rate');
    // title of this page. For most pages: &COLLECTION . " - Title" , default: $COLLECTION_NAME
  $smarty->assign("tab", "browse"); // active nav tab. default:  "home"
  $smarty->assign("baseDir", getBaseDir() ); // should always be getBaseDir() 
  
  $smarty->assign("pageName", "Rate");
    // name of page to placed in <h1> tag
    
  $smarty->assign("alert", array("type"=>"", "message"=>"") );
  
  function canViewModule($userType, $minType) {
    if($minType=="Unregistered" || $userType=="Admin") { //Everyone can view modules if the minimum level is Unregistered, and Admins can view every module.
      return TRUE;
    }
    if($userType=="Disabled" || $userType=="Deleted" || $userType=="Pending") { //Disabled, deleted, and pending users can not view any modules.
      return FALSE;
    }
    if($userType=="Viewer" && $minType=="Viewer") {
      return TRUE;
    }
    if($userType=="SuperViewer" && ($minType=="Viewer" || $minType=="SuperViewer")) {
      return TRUE;
    }
    if($userType=="Submitter" && ($minType=="Viewer" || $minType=="SuperViewer" || $minType=="Submitter")) {
      return TRUE;
    }
    if($userType=="Editor" && ($minType=="Viewer" || $minType=="SuperViewer" || $minType="Submitter" || $minType=="Editor")) {
      return TRUE;
    }
    return FALSE;
  }
  
  /** WARNING:  Do not call this function until you have verified that the user is actually logged in, since this function will always indicate a 
    material is viewable/ratable is it has a parent module with a minimum user type of "Viewer" or lower, regardless of the user's log=in status! */
  function canViewMaterial($userType, $materialID) {
    $canView=FALSE; //Will be set to TRUE once it is determined the person accessing this page may view the material.
    $parentModules=getAllModulesAttatchedToMaterial($materialID);
    if($parentModules===FALSE || $parentModules==="NotImplimented") {
      return FALSE;
    }
    for($i=0; $i<count($parentModules); $i++) { //Loop through all modules attatched to the material.  Our goal is to find one with an access level at least as low as the currently logged in user.
      $module=getModuleByID($parentModules[$i]); //Get information about the current module being analyzed.
      if($module["minimumUserType"]=="Unregistered") { //Anyone can view materials/modules if the minimumUserType is "Unregistered".
        return TRUE;
      }
      if($module["minimumUserType"]=="Viewer") { //Assume the user is logged in if this function is called, which means anyone could view a module with this user type.
        return TRUE;
      }
      if($module["minimumUserType"]=="SuperViewer" && ($userType=="SuperViewer" || $userType=="Submitter" || $userType=="Editor" || $userType=="Admin")) {
        return TRUE;
      }
      if($module["minimumUserType"]=="Submitter" && ($userType=="Submitter" || $userType=="Editor" || $userType=="Admin")) {
        return TRUE;
      }
      if($module["minimumUserType"]=="Editor" && ($userType=="Editor" || $userType=="Admin")) {
        return TRUE;
      }
      if($module["minimumUserType"]=="Admin" && $userType=="Admin") {
        return TRUE;
      }
    }
    return FALSE; //If nothing above was matched, the user can't view the module, so return FALSE.
  }
  
  
  $action="display";
  if(isset($_REQUEST["action"])) {
    $action=$_REQUEST["action"];
  }
  $smarty->assign("action", $action);

$loggedIn = false;
if(isset($userInformation)) { //This block runs if the user is logged in.
  /* Check to make sure that if a moduleID was given, the backend can write module ratings, and if a materialID was given, that the backend 
    can write material ratings.*/
  $loggedIn = true;
  
  if((isset($_REQUEST["moduleID"]) && in_array("RateModules", $backendCapabilities["write"])) || (isset($_REQUEST["materialID"]) && in_array("RateMaterials", $backendCapabilities["write"]))) {
    if($action=="display") {
      if(!isset($_REQUEST["materialID"])) { //Are we trying to work with a module, not material?
        $module=getModuleByID($_REQUEST["moduleID"]);
        if($module===FALSE || $module==="NotImplimented" || count($module)<=0) { //Check to make sure the module actually exists
          $smarty->assign("alert", array("type"=>"negative", "message"=>'<h1>Module Not Found</h1>') );
        } else { //This else runs if the module exists
          if(canViewModule($userInformation["type"], $module["minimumUserType"])) {
            $smarty->assign("showRateModule", true);
            $smarty->assign("module", $module);
          } else { //Error, can't view module
            $smarty->assign("alert", array("type"=>"negative", 
            "message"=>'The Resource you are attempting to rate is only accessable and rateable to users with a privilege level higher than 
            your current privilege level.') );
          }
        }
      } elseif(isset($_REQUEST["materialID"])) { //Are we trying to work with a material?
        if(canViewMaterial($userInformation["type"], $_REQUEST["materialID"])) {
          $material=getMaterialByID($_REQUEST["materialID"]);
          //$parentModules=getAllModulesAttatchedToMaterial($material["materialID"]);          
          $smarty->assign("module", array("moduleID"=>$_REQUEST["moduleID"]) );
          if($material===FALSE || $material==="NotImplimented" || count($material)<=0) { //Check that the material actually exists
            $smarty->assign("alert", array("type"=>"negative", "message"=>'<h1>Material Not Found</h1>') );
          } else {
            $smarty->assign("showRateMaterial", true);
            $smarty->assign("material", $material);
          }
        } else { //Error, can't rate material
          $smarty->assign("alert", array("type"=>"negative", 
          "message"=>'>The material you are attempting to rate either does not exist, or it is not attatched to any Resources with a privilege 
          level at your user\'s privilege level or lower.  You may only rate materials that are attatched to at least one Resource
          with a privilege level equal to or lower than your user\'s privilege level.') );
        }
      } else { //Error:  Don't know what material/module to work with.
        $smarty->assign("alert", array("type"=>"negative", 
        "message"=>'No Resource or material to rate was specified.  To avoid this error in the future, you should only rate Resources and 
        materials from the links provided for leaving ratings from the "View Module" pages.') );
      }
      
      
    } elseif($action=="doRate") { //Trying to actually write a rating to a module.
      if(!isset($_REQUEST["materialID"])) { //Are we trying to work with a module, not material?
        $module=getModuleByID($_REQUEST["moduleID"]);
        if($module===FALSE || $module==="NotImplimented" || count($module)<=0) { //Check to make sure the module actually exists
          echo '<h1>Resource Not Found</h1>';
        } else { //This else runs if the module exists
          if(canViewModule($userInformation["type"], $module["minimumUserType"])) {
            $smarty->assign("module", $module);
            if(isset($_REQUEST["rating"])) {
              $addRatingResult=addRatingToModule($module["moduleID"], $_REQUEST["rating"]);
            }
            if(!isset($_REQUEST["rating"]) || (isset($addRatingResult) && $addRatingResult!==TRUE)) { //Error
             $smarty->assign("alert", array("type"=>"negative", "message"=>'Unable to add rating to module.
              <br />The system was unable to add a rating to the specified Resource.') ); 
            } else { //Success
              $smarty->assign("alert", array("type"=>"positive", 
              "message"=>'Successfully added rating to the Resource "'.$module["title"].'" version '.$module["version"].'.') );
            }
          } else { //Error, can't view module
            $smarty->assign("alert", array("type"=>"negative", 
            "message"=>'The Resource you are attempting to rate is only accessible and rateable to users with a privilege level higher than 
            your current privilege level.') );
          }
        }
      } elseif(isset($_REQUEST["materialID"])) { //Are we trying to work with a material?
        if(canViewMaterial($userInformation["type"], $_REQUEST["materialID"])) {
          $material=getMaterialByID($_REQUEST["materialID"]);
          //$parentModules=getAllModulesAttatchedToMaterial($material["materialID"]);
          $smarty->assign("module", array("moduleID"=>$_REQUEST["moduleID"]) );
          if($material===FALSE || $material==="NotImplimented" || count($material)<=0) { //Check that the material actually exists
            $smarty->assign("alert", array("type"=>"negative", "message"=>'No material with the specified ID was found.') );
          } else {
            //echo '<h1>Rate Material '.$material["title"].'</h1>';
            $addRatingResult=FALSE; //By default adding a rating failed.  It will be changed to TRUE if adding a rating succeeds.
            if(isset($_REQUEST["rating"])) { //&& isset($_REQUEST["commentTitle"]) && isset($_REQUEST["comment"])) { //Check to make sure we have enough info to rate a material.
              //$addRatingResult=addCommentAndRatingToMaterial($_REQUEST["materialID"], $userInformation["firstName"]." ".$userInformation["lastName"], $_REQUEST["commentTitle"], $_REQUEST["comment"], $_REQUEST["rating"]);
				$addRatingResult=addCommentAndRatingToMaterial($_REQUEST["materialID"], $userInformation["firstName"]." ".$userInformation["lastName"], "", "", $_REQUEST["rating"]); 
			}
            if($addRatingResult!==TRUE) { //Adding rating failed
              $smarty->assign("alert", array("type"=>"negative", "message"=>'Unable to add rating to material.<br />
              An error occurred which trying to add a rating to the material.</p>') );
            } else { //Successfully added rating
              $smarty->assign("alert", array("type"=>"positive", "message"=>'Rating successfully added to material.')) ;
            }
          }
        } else { //Error, can't rate material
          $smarty->assign("alert", array("type"=>"negative", 
          "message"=>'The material you are attempting to rate either does not exist, or it is not attatched to any Resources with a privilege 
          level at your user\'s privilege level or lower.  You may only rate materials that are attatched to at least one Resource 
          with a privilege level equal to or lower than your user\'s privilege level.') );
        }
      } else { //Error:  Don't know what material/module to work with.
        $smarty->assign("alert", array("type"=>"negative", 
        "message"=>'No Resource or material to rate was specified.  To avoid this error in the future, you should only rate Resources and 
        materials from the links provided for leaving ratings from the "View Resource" pages.') );
      }
    } else { //Error, unknown action.
      $smarty->assign("alert", array("type"=>"negative", "message"=>'The action specified is unrecognized.<br />
      An unknown and unhandled action was specified, and your request could not be processed.  If you are receiving this error after 
      clicking a link or button from with this collection, please report this error to the collection maintainer.') );
    }          
  } else { //If true, 
    $smarty->assign("alert", array("type"=>"negative", "message"=>'The system was unable to process your request for one or more 
    of the following reasons:
    <ul><li>Neither a Resource ID or material ID was specified.</li>
    <li>The backend storage system currently in use does not support writing ratings for the component specified (material or Resource).</li></ul>') );
  }
}

 $smarty->display('rate.php.tpl');
?>