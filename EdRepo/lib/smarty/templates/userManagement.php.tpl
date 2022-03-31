{*****************************************************************************
    File:       userManagement.php.tpl
    Purpose:    Smarty template for EdRepo's "User Management" page
    Author:     Jon Thompson
    Date:       6 May 2011
*****************************************************************************}

{include file="header.tpl"}

<div id="content">

<h1>{$pageName|default:"404 Error"}</h1>

{if $loggedIn != "true"}
<p>Sorry, you must be logged in as an admin to access this page.</p>

{elseif $user.type != "Admin"}
<p>Sorry, you must be an admin to access this page.</p>

{else}

{if $alert.message != ""}
    <p class="alert {$alert.type|default:"positive"}">
      {if $alert.type == "negative"}
        <img src="{$baseDir}lib/look/{$LOOK_DIR}/failure.png" alt="Failure: " />
      {else}
        <img src="{$baseDir}lib/look/{$LOOK_DIR}/success.png" alt="Success: " />
      {/if}
      
        {$alert.message}
    </p>
{/if}

<script type="text/javascript" src="lib/sorttable/sorttable.js"></script>
<script type="text/javascript">
    function quickValidateNewAccountFields() {
      var email=document.getElementById("email").value;
      var firstName=document.getElementById("firstName").value;
      var lastName=document.getElementById("lastName").value;
      if(firstName.search("\"")!=-1 || lastName.search("\"")!=-1 || email.search("\"")!=-1) {
        alert("Sorry, but first names, last names, and email addresses may not contain quote marks.");
        return false;
      }
      return true;
    }
</script>

{if $action == "display"} {* ACTION: DISPLAY *********************************}

{if $readUsers != "true"}
<p>The backend in use does not support working with users in read mode, which is required to use this page.</p>

{else}
<form name="nameSearchForm" method="get" action="userManagement.php">
    <input type="hidden" readonly="readonly" name="action" value="display"></input>
    <a class="button" href="userManagement.php?action=displayCreateAccount">Add New User</a>
    <input type="text" name="filterName" id="filterTextInput" value="{$filterName}" />
    <input type="submit" class="button" name="sub" value="Filter"></input>
</form>

{if $numUsers <= 0 && $wasFiltered == "false"}
<p>There are currently no users in the system.</p>

{elseif $numUsers <= 0 && $wasFiltered == "true"}
<p>No users were found matching you search criteria.</p>

{else} {* display users *}
<table class="sortable UserInformationView">
    <thead><tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Type</th>
        <th class="sorttable_nosort">Edit</th>
        <th class="sorttable_nosort">Change Password</th>
        <th class="sorttable_nosort">Delete</th>
    </tr></thead>
    <tbody>
    {foreach $users as $user}
          <tr><td>{$user.userID}</td><td>{$user.firstName} {$user.lastName}</td><td>{$user.email}</td><td>{$user.type}</td>
          <td><a class="button" href="userManagement.php?action=displayEdit&userID={$user.userID}">Edit</a></td>
          <td><a class="button" href="userManagement.php?action=displayChangePassword&userID={$user.userID}">Change Password</a></td>
          <td><a class="button" href="userManagement.php?action=confirmAccountRemoval&userID={$user.userID}">Delete</a></td></tr>
    {/foreach}
    </tbody>
</table>

{/if} {* end 'number of users' if *}
{/if} {* end 'read users' if *}
{* END ACTION: DISPLAY *******************************************************}

{elseif ( $action == "displayEdit" || $action == "doEdit" ) && $userID != ""} {* ACTION: DISPLAY EDIT USER *}

{if $useUsers != "true"}
<p>The backend in use does not support working with users in read and/or write mode, which is required to use this page.</p>

{else} {* display user edit form *}
<p>Change any information you wish to below, and select "Apply" to save changes.</p>

<form name="editAccountForm" method="post" action="userManagement.php">
    <input type="hidden" readonly="readonly" name="action" value="doEdit"></input>
    <input type="hidden" readonly="readonly" name="userID" value="{$editUserInfo.userID}"></input>
    <fieldset>
    <div class="fieldRow{if $error == "BadFirstName"} error{/if}">
        <label for="firstName"><strong>First Name:</strong></label>
        <input type="text" name="firstName" value="{$editUserInfo.firstName}"></input>
    </div>
    <div class="fieldRow{if $error == "BadLastName"} error{/if}">
        <label for="lastName"><strong>Last Name:</strong></label>
        <input type="text" name="lastName" value="{$editUserInfo.lastName}"></input>
    </div>
    <div class="fieldRow{if $error == "BadEmail"} error{/if}">
        <label for="email"><strong>Email Address:</strong></label>
        <input type="text" name="email" value="{$editUserInfo.email}"></input>
    </div>
    <div class="fieldRow">
        <label for="firstName"><strong>Type:</strong></label>
        <select name="type">
            <option value="Pending"{if $editUserInfo.type == "Pending"} selected="selected"{/if}>Pending Approval</option>
            <option value="Viewer"{if $editUserInfo.type == "Viewer"} selected="selected"{/if}>Viewer</option>
            <option value="SuperViewer"{if $editUserInfo.type == "SuperViewer"} selected="selected"{/if}>SuperViewer</option>
            <option value="Submitter"{if $editUserInfo.type == "Submitter"} selected="selected"{/if}>Submitter</option>
            <option value="Editor"{if $editUserInfo.type == "Editor"} selected="selected"{/if}>Editor</option>
            <option value="Admin"{if $editUserInfo.type == "Admin"} selected="selected"{/if}>Admin</option>
            <option value="Disabled"{if $editUserInfo.type == "Disabled"} selected="selected"{/if}>Disabled</option>
        </select>
    </div>
	<div class="fieldRow">
		<label for="groups"><strong>Group:</strong></label>
		<select name="groups">
			<option value="None" {if $editUserInfo.groups == "None"} selected="selected"{/if}>None</option>
			<option value="Student" {if $editUserInfo.groups == "Student"} selected="selected"{/if}>Student</option>
			<option value="Teacher" {if $editUserInfo.groups == "Teacher"} selected="selected"{/if}>Teacher</option>
			<option value="Professor" {if $editUserInfo.groups == "Professor"} selected="selected"{/if}>Professor</option>
			<option value="Principal" {if $editUserInfo.groups == "Principal"} selected="selected"{/if}>Principal</option>
			<option value="Dean" {if $editUserInfo.groups == "Dean"} selected="selected"{/if}>Dean</option>
			<option value="President" {if $editUserInfo.groups == "President"} selected="selected"{/if}>President</option>
			<option value="Admin" {if $editUserInfo.groups == "Admin"} selected="selected"{/if}>Admin</option>
		</select>
	</div>
    </fieldset>
    <fieldset class="buttons"><input type="submit" class="button" name="submit" value="Apply"></input>
	<input type="reset" class="button" name="reset" value="Reset"></input>
	<a href="userManagement.php" class="button">Cancel</a></fieldset>
</form>
{/if} {* end 'use users' if *}
{* END ACTION: DISPLAY EDIT USER *********************************************}


{elseif ( $action == "displayChangePassword" || $action == "doChangePassword" ) && $userID != ""} {* ACTION: DISPLAY CHANGE PASSWORD *}

{if $useUsers != "true"}
<p>The backend in use does not support working with users in read and/or write mode, which is required to use this page.</p>

{else} {* display change password form *}
<p class="note">Changing password for user <strong>{$editUserInfo.firstName} {$editUserInfo.lastName}.</strong></p>

{if $user.userID != $editUserInfo.userID} {* Are we editing a password for a user who isn't the logged in user? *}
<p class="warning">It is not reccomended that you change this user's password. 
Changing a user's password can make it impossible for the user to log in. 
Unless you are resetting this user's password, it is recomended that you do not 
change their password and instead allow the user to change their password themselves from their "My Account" panel.</p>
{else}
<p class="note">You are changing your own account's password. 
You can also change your password, as well as other account details, from your "My Account" panel.</p>
{/if}

<form name="changePasswordForm" action="userManagement.php" method="post"><fieldset>
    <input type="hidden" readonly="readonly" name="action" value="doChangePassword"></input>
    <input type="hidden" readonly="readonly" name="userID" value="{$editUserInfo.userID}"></input>
    <div class="fieldRow">
        <label for="newPassword1"><strong>New Password:</strong></label>
        <input name="newPassword1" type="password"></input>
    </div>
    <div class="fieldRow">
        <label for="newPassword2"><strong>Retype New Password:</strong></label>
        <input name="newPassword2" type="password"></input>
    </div></fieldset>
    <fieldset class="buttons">
        <input type="submit" class="button" name="submit" value="Change Password"></input>
        <a href="userManagement.php" class="button">Cancel</a>
    </fieldset>
</form>
{/if} {* end 'use users' if *}
{* END ACTION: CHANGE PASSWORD ***********************************************}


{elseif $action == "displayCreateAccount" || $action == "doCreateAccount"} {* ACTION: CREATE ACCOUNT *}

{if $useUsers != "false"}
<h2>Create New Account</h2>
<p>Enter all information about the user of the new account below and select "Create Account" to add the account.</p>

<form name="newAccountForm" method="post" action="userManagement.php">
    <input type="hidden" name="action=" value="doCreateAccount" readonly="readonly"></input>
    <fieldset>
    <input type="hidden" readonly="readonly" name="action" value="doCreateAccount"></input>
    <div class="fieldRow{if $result == "BadFirstName"} error{/if}">
        <label for="firstName"><strong>First Name:</strong></label>
        <input type="text" name="firstName" id="firstName" value="{$editUserInfo.firstName|default:''}"></input>
    </div>
    <div class="fieldRow{if $result == "BadLastName"} error{/if}">
        <label for="lastName"><strong>Last Name:</strong></label>
        <input type="text" name="lastName" id="lastName" value="{$editUserInfo.lastName|default:''}"></input>
    </div>
    <div class="fieldRow{if $result == "BadEmail" || $result == "EmailAlreadyExists"} error{/if}">
        <label for="email"><strong>Email Address:</strong></label>
        <input type="text" name="email" id="email" value="{$editUserInfo.email|default:''}"></input>
        {if $result == "EmailAlreadyExists"}This email address is already in use.{/if}
    </div>
    <div class="fieldRow">
        <label for="type"><strong>Type:</strong></label>
        <select name="type">
            <option value="Pending"{if $editUserInfo.type == "Pending"} selected="selected"{/if}>Pending Approval</option>
            <option value="Viewer"{if $editUserInfo.type == "Viewer"} selected="selected"{/if}>Viewer</option>
            <option value="SuperViewer"{if $editUserInfo.type == "SuperViewer"} selected="selected"{/if}>SuperViewer</option>
            <option value="Submitter"{if $editUserInfo.type == "Submitter"} selected="selected"{/if}>Submitter</option>
            <option value="Editor"{if $editUserInfo.type == "Editor"} selected="selected"{/if}>Editor</option>
            <option value="Admin"{if $editUserInfo.type == "Admin"} selected="selected"{/if}>Admin</option>
            <option value="Disabled"{if $editUserInfo.type == "Disabled"} selected="selected"{/if}>Disabled</option>
        </select>
    </div>
		<div class="fieldRow">
		<label for="groups"><strong>Group:</strong></label>
		<select name="groups">
			<option value="Temp" {if $editUserInfo.groups == "Temp"} selected="selected"{/if}>Temp</option>
			<option value="None" {if $editUserInfo.groups == "None"} selected="selected"{/if}>None</option>
			<option value="Student" {if $editUserInfo.groups == "Student"} selected="selected"{/if}>Student</option>
			<option value="Teacher" {if $editUserInfo.groups == "Teacher"} selected="selected"{/if}>Teacher</option>
			<option value="Professor" {if $editUserInfo.groups == "Professor"} selected="selected"{/if}>Professor</option>
			<option value="Principal" {if $editUserInfo.groups == "Principal"} selected="selected"{/if}>Principal</option>
			<option value="Dean" {if $editUserInfo.groups == "Dean"} selected="selected"{/if}>Dean</option>
			<option value="President" {if $editUserInfo.groups == "President"} selected="selected"{/if}>President</option>
			<option value="Admin" {if $editUserInfo.groups == "Admin"} selected="selected"{/if}>Admin</option>
		</select>
	</div>
    <div class="fieldRow{if $result == "BadPassword"} error{/if}">
        <label for="password1"><strong>Password:</strong></label>
        <input type="password" name="password1"></input>
        {if $result == "BadPassword"}Password must be at least 5 characters.{/if}
    </div>
    <div class="fieldRow">
        <label for="password2"><strong>Retype Password:</strong></label>
        <input type="password" name="password2"></input>
    </div>	
    </fieldset>
    <fieldset class="buttons">
        <input type="submit" class="button" name="sub" value="Create Account" onclick="return quickValidateNewAccountFields();"></input> 
        <a class="button" href="userManagement.php?action=display">Cancel</a>
    </fieldset>
</form>

{/if} {* end 'use users' if *}
{* END ACTION: CREATE ACCOUNT ************************************************}

{elseif $action == "confirmAccountRemoval"} {* ACTION: CREATE ACCOUNT *}

{if $useUsers != "false"}
<p class="warning">Are you sure you want to delete the account belonging to {$editUserInfo.firstName} {$editUserInfo.lastName} ({$editUserInfo.email})?</p>

<p>Deleting this account is permanent, and can not be undone without manually changing the back-end storage engine.  Once this account has been deleted, the user who owns this account 
will no longer be able to modify, edit, or manage their account, modules, or materials.  In addition, even if a new account is create with the same name and email, it will be  
considered a different account and will not have access to any modules, materials, or settings belonging to this account.

{if $usersSoftRemove == "true"}
<p><span class="note">Notice:  The account will be softly deleted.</span>  A softly deleted account may continue to store certain 
information in it, even once it has been deleted.  This information is necessary to maintain information about modules and materials submitted by the account.  All other information 
about the account, including as much personal information as possible, will be permently deleted.  To remove all information about this account, including information which may 
be require to maintain module and material consistancy, you will need to manually edit the back-end storage database.</p>
{/if}

<p>
<a class="button" href="userManagement.php?action=doAccountRemoval&userID={$editUserInfo.userID}">Delete Account</a>
<a class="button"  href="userManagement.php">Cancel</a>
</p>
{/if} {* end 'use users' if *}

{/if} {* end 'action' if *}

{if $action != "display"}<p>Back to <a href="userManagement.php">User Management</a>.</p>{/if}

{/if} {* end 'logged in as admin' if *}

</div>

{include file="footer.tpl"}
