<?php
/****************************************************************************************************************************
*    config.php - Collection-wide configuration settings.
*    -----------------------------------------------------
*  Contains settings which are used collection-wide by the front-end.
*
*  Version: 1.0
*  Author: Ethan Greer
*  Modified by: Ben Kos - Connected to install.php
*  Modified by: Chris Macco - added the ability to get the base URL when EdRepo is installed in other places
*
*  Notes: - Do NOT put functions in this file, since it is imported by many files which may themselves be imported by files 
*         which have already imported this.  Placing functions in this file is likely to result in "Can not redeclare 
*         <function> errors" !!
******************************************************************************************************************************/

/* COLLECTION_NAME is the name of your collection. */
$COLLECTION_NAME="EdRepo";

/* COLLECTION_SHORTNAME is a simple, short name for your collection, used with harvesting.  It may only contain letters and 
number (no  spaces, puncuation, etc) */
$COLLECTION_SHORTNAME="EdRepo";

/* COLLECTION_BASE_URL is the base address users access EdRepo from on your server.  So, for example, if your EdRepo homepage 
was at http://wwww.example.com/edrepo/index.php, the base URL would be /edrepo/ */
$COLLECTION_BASE_URL="/EdRepo/EdRepo/";

/* NEW_ACCOUNTS_REQUIRE_APPROVAL determines if new accounts are automatically activated or if they must first be approved.
Set to FALSE to activate new accounts immediately.
       TRUE to disable new accounts until an administrator activates them.
NEW ACCOUNTS_ACCOUNT_TYPE determines the account time new accounts are by default.  The account type determines the privilege lebvel.
Valid levels (from lowest privileges to highest) are: Viewer, SuperViewer, Submitter, Editor, Admin
The default action is to automatically activate new users, but place them in the lowest privilege level. */
$NEW_ACCOUNTS_REQUIRE_APPROVAL=TRUE;
$NEW_ACCOUNTS_ACCOUNT_TYPE="Viewer";

$EMAIL_MODERATORS_ON_NEW_USERS_PENDING_APPROVAL=FALSE;
$EMAIL_MODERATORS_ON_NEW_USERS_PENDING_APPROVAL_CLASS=array("Admin");
$EMAIL_MODERATORS_ON_NEW_USERS_PENDING_APPROVAL_LIST=array();
/* If NEW_ACCOUNTS_REQUIRE_APPROVAL is equal to TRUE then EMAIL_MODERATORS_ON_NEW_USERS_PENDING_APPROVAL should also be TRUE */
$NEW_MODULES_REQUIRE_MODERATION=TRUE;
if ($NEW_ACCOUNTS_REQUIRE_APPROVAL == TRUE)
{
	$EMAIL_MODERATORS_ON_NEW_USERS_PENDING_APPROVAL = TRUE; 
}

/* NEW_MODULES_REQUIRE_MODERATION determines if modules are automatically made active to the collection when submitted, or if they 
must first be approved by a moderator.
Set to TRUE to require moderation of submitted modules.  Modules will not become active or visible in the collection until
  they have been approved by a moderator (Editor or above privilege level).
       FALSE to publish and activate modules as soon as they are submitted, without requiring moderation. */
function NEW_MODULES_REQUIRE_MODERATION($type){
	global $AUTO_APPROVE_MODULES_TYPE;  
	if (array_search($type, $AUTO_APPROVE_MODULES_TYPE) !== FALSE){
		return FALSE;
	}
	else {
		return TRUE;
	} 
}

/* EMAIL_MODERATORS_ON_NEW_MODULE_PENDING_MODERATION determines if one or more email addresses should be notified when a new module is submitted 
  for moderation by a user.
Set to TRUE to enable this behavior.
       FALSE to disable this behavior. (default) */
$EMAIL_MODERATORS_ON_NEW_MODULE_PENDING_MODERATION=FALSE;
/* If NEW_MODULES_REQUIRE_MODERATION is equal to TRUE then EMAIL_MODERATORS_ON_NEW_MODULE_PENDING_MODERATION should also be TRUE */
if ($NEW_MODULES_REQUIRE_MODERATION == TRUE)
{
	$EMAIL_MODERATORS_ON_NEW_MODULE_PENDING_MODERATION = TRUE; 
}

/* EMAIL_MODERATORS_ON_NEW_MODULE_PENDING_MODERATION_CLASS determines any classes of users which should receive email alerts when new modules are 
  pending moderation.  Sending emails when modules are pending moderation must be enabled seperatly for this to have any effect.
This configuration variable should be set to an array of user types.  Every user of each type specified in the array will receive an email 
  alerting them of new modules pending moderation.  To prevent sending emails to every member of one or more class(es), set this to an empty
  array ( array() ).
Default value:  array("Editor", "Admin")
    which will sending email to all users of type Editor or Admin. */
$EMAIL_MODERATORS_ON_NEW_MODULE_PENDING_MODERATION_CLASS=array("Editor", "Admin");

/* EMAIL_MODERATORS_ON_NEW_MODULE_PENDING_MODERATION_LIST allows you to send email alerts of new modules pending moderation to a specific set of 
  email addresses.  These email addresses to not have to belong to users on the system.  For these emails to be send, sending emails when 
  new modules are pending moderation must be enabled speretly.
This configuration variable should be an array, with each element a valid email address which alerts will be send to.
Default value:  array()
    which is an empty list. */
$EMAIL_MODERATORS_ON_NEW_MODULE_PENDING_MODERATION_LIST=array();

/* MATERIAL_STORAGE_DIR should be set to the path on your file system which will store uploaded materials.  This directory needs to be 
readable and writable by your web server (or whatever process is running PHP). */
$MATERIAL_STORAGE_DIR="/materials/";

/* ENABLE_VERSIONS - When TRUE, users can create new versions of existing modules. When FALSE, all mention of versioning is hidden.
                                  Default: FALSE*/
$ENABLE_VERSIONS ="TRUE";

/* INSTALL is a boolean value that identifies whether the install sequence for EdRepo has been run or not. Some functions of the site will be unable
  to be used properly unless the install script has commenced. 
Set to TRUE to mean that the install sequence has been run.
     FALSE To mean that the install sequence has not been run. (default) */
$INSTALL=TRUE;

/* SHOW_REPOSITORY_TREE is a boolean. If set to TRUE, the repository navigational tree is shown on the home page. Default is TRUE. */
$SHOW_REPOSITORY_TREE = TRUE;

/* REPOSITORY_TREE_LEVELS is the number of levels to initially open in the repository navigational tree. Default is 2. */
$REPOSITORY_TREE_LEVELS = 2;

/* REPOSITORY_TREE_NAME is the name displayed as the root of the repository navigational tree . Default is "Repository". */
$REPOSITORY_TREE_NAME = "Repository";

?>