{*****************************************************************************
    File:       userManageAccount.php.tpl
    Purpose:    Smarty template for EdRepo's "Mangage Account" page
    Author:     Jon Thompson
    Date:       12 May 2011
*****************************************************************************}

{include file="header.tpl"}

<div id="content">

<h1>{$pageName|default:"404 Error"}</h1>

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


{if isset($userInformation) != true}
<p>Sorry, you must be logged in to continue.</p>

{elseif ($action == "display" && $readUsers == false) || ($action != "display" && $useUsers == false)}
<p class="alert negative">
The backend in use does not support working with users in read and/or write mode, which is required to use this page.
</p>

{else} {* free to display actions *}


{if $action == "display"} {* ACTION : DISPLAY ********************************}
<p>You current account information is displayed below.  To change it, click "Edit Information".  To change your password, choose 
"Change Password".  You may also delete your account from this page.</p>

<p>
    <a class="button" href="userManageAccount.php?action=displayEdit">Edit Information</a>
    <a class="button" href="userManageAccount.php?action=displayChangePassword">Change Password</a>
    <a class="button" href="userManageAccount.php?action=confirmAccountRemoval">Delete Account</a>
</p><br>

<table class="userInformationView" style="display: block">
    <tr><td class="highlight">First Name</td><td>{$userInformation.firstName}</td></tr>
    <tr><td class="highlight">Last Name</td><td>{$userInformation.lastName}</td></tr>
    <tr><td class="highlight">Email Address</td><td>{$userInformation.email}</td></tr>
    <tr><td class="highlight">Type{if $userInformation.type == "Admin"}*{/if}</td><td>{$userInformation.type}</td></tr>
	<tr><td class="highlight">Group{if $userInformation.groups == "Admin"}*{/if}</td><td>{$userInformation.groups}</td></tr>
</table>

{if $userInformation.type =="Admin"}
<p>* To change account types, use the <a href="admin/userManagement.php">User Management</a> tool.</p>
{/if}
{* END ACTION : DISPLAY ******************************************************}


{elseif $action == "displayEdit" || ($action == "doEdit" && $error != "")} {* ACTION: DISPLAY/DO EDIT *}
<p>Change any information you wish to below, and select "Apply" to save your changes.</p>
<form name="editAccountForm" method="post" action="userManageAccount.php">
    <input type="hidden" readonly="readonly" name="action" value="doEdit"></input>
    <fieldset>
    <div class="fieldRow{if $error == "BadFirstName"} error{/if}">
        <label for="firstName"><strong>First Name:</strong></label>
        <input type="text" name="firstName" value="{$userInformation.firstName}"></input>
    </div>
    <div class="fieldRow{if $error == "BadLastName"} error{/if}">
        <label for="lastName"><strong>Last Name:</strong></label>
        <input type="text" name="lastName" value="{$userInformation.lastName}"></input>
    </div>
    <div class="fieldRow{if $error == "BadEmail"} error{/if}">
        <label for="email"><strong>Email Address:</strong></label>
        <input type="text" name="email" value="{$userInformation.email}"></input>
    </div>
    <div class="fieldRow">
        <label for="type"><strong>Type{if $userInformation.type == "Admin"}*{/if}:</strong></label>
        {$userInformation.type}
    </div>
	<div class="fieldRow">
        <label for="type"><strong>Group{if $userInformation.groups == "Admin"}*{/if}:</strong></label>
        {$userInformation.groups}
    </div>
    </fieldset>
    
    <fieldset class="buttons">
        <input type="submit" class="button" name="submit" value="Apply"></input>
        <input type="reset" class="button" name="reset" value="Reset">
    </fieldset>
</form>

{if $userInformation.type == "Admin"}
<p>* To change account types, use the <a href="admin/userManagement.php">User Management</a> tool.</p>
{/if}
{* END ACTION: DISPLAY/DO EDIT ***********************************************}


{* ACTION: DISPLAY/DO CHANGE PASSWORD ****************************************}
{elseif $action == "displayChangePassword" || ($action == "doChangePassword" && $error != "")} 
<form name="changePasswordForm" action="userManageAccount.php" method="post">
	<fieldset>
    <input type="hidden" readonly="readonly" name="action" value="doChangePassword"></input>
    <div class="fieldRow">
        <label for="currentPassword"><strong>Current Password:</strong></label>
        <input name="currentPassword" type="password"></input>
    </div>
    <div class="fieldRow">
        <label for="newPassword1"><strong>New Password:</strong></label>
        <input name="newPassword1" type="password"></input>
    </div>
    <div class="fieldRow">
        <label for="newPassword2"><strong>Retype New Password:</strong></label>
        <input name="newPassword2" type="password"></input>
    </div>
    </fieldset>
    
    <fieldset class="buttons">
        <input type="submit" class="button" name="submit" value="Change Password"></input>
        <a class="button" href="userManageAccount.php">Cancel</a>
    </fieldset>
</form>
{* END ACTION: DISPLAY/DO CHANGE PASSWORD ************************************}


{* ACTION: CONFIRM ACCOUNT REMOVAL *******************************************}
{elseif $action == "confirmAccountRemoval"}
<p><span class="warning"><strong>Are you sure you want to delete your account?</strong></span></p>

<p>When you delete your account, you will no longer have access to any functions of this collection beyond browsing public content.
Deletions can not normally be undone, and even if you create a new account after deleting this one, you will likely not be able to 
edit or manage any modules or materials you have uploaded or worked with under the current account, even if you create a new account 
with the same email address, name, and password.</p>

{if $usersSoftRemove == true}
<p><span class="note">Notice:  Your account will be softly deleted.</span>  A softly deleted account may continue to store certain 
information in it, even once it has been deleted.  Please contact this collection's maintainer with any questions or concerns with 
soft deletion.</p>
{/if}

<p>
    <a class="button" href="userManageAccount.php?action=doAccountRemoval">Delete Account</a>
    <a class="button" href="userManageAccount.php">Cancel</a>
</p>
{* END ACTION: CONFIRM ACCOUNT REMOVAL ***************************************}


{/if} {* end 'action' if *}

{if $action != "display" && $action != "doAccountRemoval"}
<p>Return to <a href="userManageAccount.php">My Account</a>.</p>
{/if}
      
{/if} {* end 'is logged in'/'has user capabilites' if *}

</div>

{include file="footer.tpl"}