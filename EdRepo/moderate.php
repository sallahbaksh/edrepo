<?php session_start();
/****************************************************************************************************************************
 *    moderate.php - Allows module moderation.
 *    -----------------------------------------
 *  Displays modules pending moderation and allows moderators to moderated these modules.
 *
 *  Version: 1.0
 *  Author: Ethan Greer
 *
 *  Modified by: Jon Thompson (5/20/2011 - implemented new interface and use of Smarty templates)
 *
 *  Notes: - Only Editors and Admins may use this page.
 ******************************************************************************************************************************/
  
  require("lib/config.php");

  $smarty->assign("title", $COLLECTION_NAME . " - Moderate Resources");
    // title of this page. For most pages: &COLLECTION . " - Title" , default: $COLLECTION_NAME
  $smarty->assign("tab", "moderate"); // active nav tab. default:  "home"
  $smarty->assign("baseDir", getBaseDir() ); // should always be getBaseDir() 
  
  $smarty->assign("pageName", "Moderate Resources");
  
  $smarty->assign("alert", array("type"=>"", "message"=>"") );
                  // default empty alert message (type can be either positive or negative)
                  
  
  $action="display";
  $wasFiltered=FALSE; //This determines if the modules fetched were filtered or not, for a nicer display if nothing was found.
  if(isset($_REQUEST["action"])) {
    $action=$_REQUEST["action"];
  }
  if( isset($_REQUEST["approveSelected"]) & isset($_REQUEST["moduleIDs"]) ) {
    $action="ApproveSelected";
  } elseif ( isset($_REQUEST["denySelected"]) & isset($_REQUEST["moduleIDs"]) ) {
    $action="DenySelected";
  } else if (isset($_REQUEST["approveFamilySelected"]) & isset($_REQUEST["moduleIDs"])) {
	$action="ApproveFamilySelected"; 
  }
  if($action=="Approve" || $action=="ApproveSelected" || $action=="ApproveFamily" || $action=="ApproveFamilySelected") {
    //Don't do anything, except prevent any other action stuff to happen.  Approval is all taken care of later.
  } elseif($action=="Deny" || $action=="DenySelected") {
    //Don't do anything, except prevent any other action stuff to happen.  Denial is all taken care of later.
  } elseif($action=="filter" && isset($_REQUEST["filterText"])) { //If we are suppose to filter the results, do so here (but only if we have enough information to filter with).  Build a list of modules owned by this user, but only with the filtered titles.
    $modules=searchModules(array("status"=>"PendingModeration", "title"=>$_REQUEST["filterText"]));
    $wasFiltered=TRUE;
    $action="display"; //Tell future parts of the program to display what we just got.
  } else { //No filter was specified and no "special" action was given, so build a list of all modules pending approval.
    $modules=searchModules(array("status"=>"PendingModeration")); //Get a list of all modules which the user owns.
    $action="display"; //Tell future parts of the program to display what we just got.
  }
  $smarty->assign("action", $action);
  $smarty->assign("wasFiltered", $wasFiltered);

$error = "";
if(!isset($userInformation)) { //If true, we aren't logged in.
  $error = "notLoggedIn";
} elseif(!in_array("UseModules", $backendCapabilities["read"]) || !in_array("SearchModulesByUserID", $backendCapabilities["read"])) {
  $error = "backendSupport";
} else if(!($userInformation["type"]=="Editor" || $userInformation["type"]=="Admin")) {
  $error = "priveleges";
  
} else {

  if($action=="display") {
    $smarty->assign("filterText", "");
    if($wasFiltered===TRUE) { //The user had a filter, so be nice and automatically place that in the filter bar.
      $smarty->assign("filterText", preg_replace('/"/', '&quot;', $_REQUEST["filterText"]) );
    }

    //We'll use the $modules list of modules to display built earlier
    $smarty->assign("modules", $modules); 
    
    
  } elseif($action=="Approve" || $action=="ApproveSelected") {
    if( isset($_REQUEST["moduleID"]) || (isset($_REQUEST["moduleIDs"]) && !empty($_REQUEST["moduleIDs"])) ) {
      // fill array of modules based on variable set
      if ($action=="ApproveSelected") {
        $modules = $_REQUEST["moduleIDs"];
      } else {
        $modules = array($_REQUEST["moduleID"]);
      }
      // approve each module
      foreach($modules as $moduleID) {
        $module=getModuleByID($moduleID);
        if($module["status"]=="PendingModeration") {
          $result=editModuleByID($module["moduleID"], $module["title"], $module["description"], $module["language"], $module["educationLevel"], $module["minutes"], $module["authorComments"], $module["checkInComments"], $module["submitterUserID"], "Active", $module["minimumUserType"],$module["interactivityType"], $module["rights"], $module["restrictions"], FALSE);
          if($result===FALSE || $result=="NotImplimented") {
            $smarty->assign("alert", array("type"=>"negative", "message"=>"Failed to approve Resource.<br />
            A back-end error is preventing the Resource from being approved. 
            Please contact the collection maintainer to report this issue.") );
          } else { //This else block means everything worked!
            $smarty->assign("alert", array("type"=>"positive", "message"=>"Resource successfully approved.  
            It is now active in the collection.") );
          }
        } else { //This else block means, tried to approve a module which was not pending moderation!
          $smarty->assign("alert", array("type"=>"negative", "message"=>"Failed to approve Resource.<br />
          The Resource you attempted to approve was not pending moderation.  Only Resources pending moderation can be approved.<br />") );
        }
      }
    } else { //This else block means, we don't know the moduleID to approve!
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Failed to approve Resource.<br />
      The ID of the Resource to approve was not specified.  If you are receiving this error after clicking a link or button from 
      within this system, please report it to the collection maintainer.") );
    }
    
    // refresh list of modules
    $modules=searchModules(array("status"=>"PendingModeration")); 
    $smarty->assign("modules", $modules); 
    
    
  } else if ($action=="ApproveFamily" || $action=="ApproveFamilySelected"){
		function ids($moduleID, $internalReferences, $connections, $toApprove){
			if ($connections < 0) {
				return approveFamily(count($internalReferences), $toApprove);
			}
			else {
				if ($internalReferences[$connections]["referencedModuleID"] == FALSE){
					array_push ($toApprove, $moduleID); 
				}				
				else {
					array_push ($toApprove, $internalReferences[$connections]["referencedModuleID"]); 
				}
				ids($moduleID, $internalReferences, $connections-=1, $toApprove); 
			}
		}		
		function approveFamily ($counter, $toApprove) {
			if ($counter < 0) {
				return; 
			}
			else if(is_array($toApprove)) {
				$module = getModuleByID($toApprove[$counter]);		
				if($module["status"]=="PendingModeration") {
					$result=editModuleByID($toApprove[$counter], $module["title"], $module["description"], $module["language"], $module["educationLevel"], $module["minutes"], $module["authorComments"], $module["checkInComments"], $module["submitterUserID"], "Active", $module["minimumUserType"],$module["interactivityType"], $module["rights"], $module["restrictions"], FALSE);
				}
				approveFamily($counter-=1, $toApprove); 
			}
		}		
		$moduleID = $_REQUEST["moduleID"]; 
		$internalReferences = getInternalReferences($moduleID);
		$connections = count($internalReferences); 
		ids($moduleID, $internalReferences, $connections, array());
		
		// refresh list of modules
		$modules=searchModules(array("status"=>"PendingModeration")); 
		$smarty->assign("modules", $modules); 
		
  }  elseif($action=="Deny" || $action=="DenySelected") {
    // When a module is denied, its status is set back to "InProgress" so submitter can revise it.
    // Still needed: (email?) notification to submitter that his/her module was denied.
    if(isset($_REQUEST["moduleID"]) || (isset($_REQUEST["moduleIDs"]) && !empty($_REQUEST["moduleIDs"])) ) {
      // fill array of modules based on variable set
      if ($action=="DenySelected") {
        $modules = $_REQUEST["moduleIDs"];
      } else {
        $modules = array($_REQUEST["moduleID"]);
      }
      // deny each module
      foreach($modules as $moduleID) {
        $module=getModuleByID($moduleID);
        if($module["status"]=="PendingModeration") {
          $result=editModuleByID($module["moduleID"], $module["title"], $module["description"], $module["language"], $module["educationLevel"], $module["minutes"], $module["authorComments"], $module["checkInComments"], $module["submitterUserID"], "InProgress", $module["minimumUserType"], $module["interactivityType"], $module["rights"], $module["restrictions"], FALSE);
          if($result===FALSE || $result=="NotImplimented") {
            $smarty->assign("alert", array("type"=>"negative", "message"=>"Failed to deny Resource.<br />
            A back-end error is preventing the Resource from being denied.  Please contact the collection maintainer to report this 
            issue.") );
          } else { //This else block means everything worked, and the user will receive an email that their module was denied. 
              			$userID = $module["submitterUserID"]; 
              			$getUserEmail = getUserInformationByID($userID); 
              			$userEmail = $getUserEmail["email"]; 
              			//Setting up email to send to user 
              			$message = "Your EdRepo module: ";
              			$message .= $module["title"]; 
              			$message .= " has been denied. You can edit this module in the My Modules Page.";
              			$message .= "\n--------------------------\n";
              			$message .= "This is an automatically generated email.  Please do not reply.\n";
              			$message=wordwrap($message, 70);
              			$subject = "Your EdRepo Module"; 
              			$headers = "From: EdRepo <noreply@edrepo.com>";
			
              			if(mail($userEmail, $subject, $message, $headers)) 
              			{
              				$smarty->assign("alert", array("type"=>"positive", "message"=>"Resource was successfully denied.  
              				It is now available for original submitter to revise.") );
              			}
              			else
              			{
                      $smarty->assign("alert", array("type"=>"negative", "message"=>"Email was not sent to user."));
                      $smarty->assign("alert2", array("type"=>"positive", "message"=>"Resource was successfully denied.  
                      It is now available for original submitter to revise.") );
              				//$smarty->assign("alert", array("type"=>"negative", "message"=>"Something went wrong emailing the user. Please contact your administrator.") );
              			}
            }
        } else { //This else block means, tried to deny a module which was not pending moderation!
          $smarty->assign("alert", array("type"=>"negative", "message"=>"Failed to deny Resource.<br />
          The Resource you attempted to deny was not pending moderation.  Only Resources pending moderation can be approved.") );
        }
      }
    } else { //This else block means, we don't know the moduleID to deny!
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Failed to deny Resource.<br />
      The ID of the Resource to deny was not specified.  If you are receiving this error after clicking a link or button from 
      within this system, please report it to the collection maintainer.") );
    }
    
    // refresh list of modules
    $modules=searchModules(array("status"=>"PendingModeration")); 
    $smarty->assign("modules", $modules); 
    
  } // end 'action' if
} // end authentication if

$smarty->assign("error", $error);


$smarty->display('moderate.php.tpl');

?>