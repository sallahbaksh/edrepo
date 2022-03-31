<?php session_start();
/****************************************************************************************************************************
 *    editStaticPages.php - Allows editing of static content pages (such as the about page) used by the system.
 *    ---------------------------------------------------------------------------------------------------------
 *  Allows administrators to easily edit pages whcih contain static content.
 *
 *  Version: 1.0
 *  Author: Ethan Greer
 *  Modified by: Jon Thompson (5/9/2011 - implemented new interface/Smarty)
 *
 *  Notes: - Only Admins may use this page.
 *         - This page uses the following GET/POST parameters:
 *            action : One of the following:
 *                            "display" (default) which will list all the static content that can be edited
 *                            "displayEdit" which will display the specified static content for editing.
 *                            "doEdit" will attempt to save the edited progress.
 *            page : The page of static HTML to edit.  This parameter should be the name of a file in the lib/staticContent
 *              directory and must be recognized by this page (see the inilitilzing code).
 ******************************************************************************************************************************/
  
  require("../lib/config.php");

  $smarty->assign("title", $COLLECTION_NAME . " - Admin - Edit Static Pages");
    // title of this page. For most pages: &COLLECTION . " - Title" , default: $COLLECTION_NAME
  $smarty->assign("tab", "admin"); // active nav tab. default:  "home"
  $smarty->assign("baseDir", getBaseDir() ); // should always be getBaseDir() 
  
  $smarty->assign("pageName", "Admin - Edit Static Pages");
  
  $smarty->assign("alert", array("type"=>"", "message"=>"") );
  
  
  $action="display"; //Default action is to display list of available content to edit
  if(isset($_REQUEST["action"])) {
    $action=$_REQUEST["action"];
  }
  $smarty->assign("action", $action);
  
  /* To prevent against people abusing this page to edit (or possibly create) any page in the lib/staticContent subdirectory, we'll check to make 
    sure the page given in the $_REQUEST["page"] parameter is a valid page we can edit.  This means you MUST add all pages which can be edited here!
    If the page given isn't found here, or nothing ws given, $pagename will be left as FALSE, indicating no valid page was found.  Otheriwse, 
    $pagename will be set to a friendly, human-readable name for the page. */
  $pagename=FALSE; //By default a valid page wasn't given.
  if(isset($_REQUEST["page"])) {
    if($_REQUEST["page"]=="about.html") { //About page
      $pagename="About Page";
    } elseif($_REQUEST["page"]=="home.html") { //Home page
      $pagename="Home Page";
    }
  }
  
  if ($pagename != FALSE) {
    $smarty->assign("pageName", "Admin - Edit '".$pagename."'");
  }
  

if (isset($userInformation) && $userInformation["type"]=="Admin") { //This else block is if we're logged in as an admin.

  if($action=="display") {
    // nothing additional needs to be done.
    // Simple display is handled by Smarty template.
    
  } elseif($action=="displayEdit") {
    if($pagename===FALSE) { //A $pagename of FALSE means the page given to edit isn't valid, or no page was given to edit.
      $smarty->assign("alert", array("type"=>"negative", "message"=>"The page specified can not be edited.") );
    } else { //This indicates a valid page was given to edit.  The filename should be in $_REQUEST["page"] and a human-readable name should be in $pagename.
      $smarty->assign("page", array("name"=>$pagename,
                        "file"=>htmlspecialchars($_REQUEST["page"]),
                        "content"=>htmlspecialchars(file_get_contents("../lib/staticContent/".$_REQUEST["page"]), ENT_NOQUOTES) ) );
    }
    
    
  } elseif($action=="doEdit" && $pagename!==FALSE && isset($_REQUEST["content"])) { //If the action is doEdit and a valid pagename and some content was passed, try to update the page.
    $smarty->assign("page", array("name"=>$pagename,
                        "file"=>htmlspecialchars($_REQUEST["page"]),
                        "content"=>htmlspecialchars(file_get_contents("../lib/staticContent/".$_REQUEST["page"]), ENT_NOQUOTES) ) );
    /* To write the content: Open the file specified, making a file handle $wf.  Write the content gotten to $wf.  Then close $wf. */
    $wf=fopen("../lib/staticContent/".$_REQUEST["page"], "w"); //It is safe to trust $_REQUEST["page"] because it was verified when determining a $pageanme (and we've already check to make sure $pagename isn't FALSE above.
    if($wf!==FALSE) { //Successfully opened file.            
      $result=fwrite($wf, $_REQUEST["content"]);
      if($result!==FALSE) { //Successful writing file.
        $smarty->assign("alert", array("type"=>"positive", "message"=>"Successfully updated '".$pagename."'.") );
        
        $smarty->assign("page", array("name"=>$pagename,
                        "file"=>htmlspecialchars($_REQUEST["page"]),
                        "content"=>htmlspecialchars(file_get_contents("../lib/staticContent/".$_REQUEST["page"]), ENT_NOQUOTES) ) );
      } else { //Failed to write to file.
        $smarty->assign("alert", array("type"=>"negative", "message"=>"Unable to update ".$pagename." due to 
        error opening file.<br />Please report this error to the collection maintainer.") );
      }
      fclose($wf); //Close file.
    } else { //Failed to open file
      $smarty->assign("alert", array("type"=>"negative", "message"=>"Unable to update ".$pagename." due to 
      error opening file.<br />Please report this error to the collection maintainer.") );
    }
    
    
  } else { //Unknown/unhandled action specified.
    $smarty->assign("alert", array("type"=>"negative", "message"=>"Unknown or Unhandled Action Specified</h1>") );
  } // end action if
  
} // end if logged in as admin if
        
        
  $smarty->display('editStaticPages.php.tpl');
  ?>