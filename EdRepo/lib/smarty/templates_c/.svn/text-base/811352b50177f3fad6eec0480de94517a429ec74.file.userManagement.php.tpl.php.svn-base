<?php /* Smarty version Smarty-3.0.7, created on 2014-07-22 10:08:40
         compiled from "E:\XAMPP\xampplite-win32-1.7.3\xampplite\htdocs\xampp\EdRepo\EdRepo\lib\smarty/templates/userManagement.php.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2695853ce706806f6d8-80205926%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '811352b50177f3fad6eec0480de94517a429ec74' => 
    array (
      0 => 'E:\\XAMPP\\xampplite-win32-1.7.3\\xampplite\\htdocs\\xampp\\EdRepo\\EdRepo\\lib\\smarty/templates/userManagement.php.tpl',
      1 => 1406037488,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2695853ce706806f6d8-80205926',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<div id="content">

<h1><?php echo (($tmp = @$_smarty_tpl->getVariable('pageName')->value)===null||$tmp==='' ? "404 Error" : $tmp);?>
</h1>

<?php if ($_smarty_tpl->getVariable('loggedIn')->value!="true"){?>
<p>Sorry, you must be logged in as an admin to access this page.</p>

<?php }elseif($_smarty_tpl->getVariable('user')->value['type']!="Admin"){?>
<p>Sorry, you must be an admin to access this page.</p>

<?php }else{ ?>

<?php if ($_smarty_tpl->getVariable('alert')->value['message']!=''){?>
    <p class="alert <?php echo (($tmp = @$_smarty_tpl->getVariable('alert')->value['type'])===null||$tmp==='' ? "positive" : $tmp);?>
">
      <?php if ($_smarty_tpl->getVariable('alert')->value['type']=="negative"){?>
        <img src="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
lib/look/<?php echo $_smarty_tpl->getVariable('LOOK_DIR')->value;?>
/failure.png" alt="Failure: " />
      <?php }else{ ?>
        <img src="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
lib/look/<?php echo $_smarty_tpl->getVariable('LOOK_DIR')->value;?>
/success.png" alt="Success: " />
      <?php }?>
      
        <?php echo $_smarty_tpl->getVariable('alert')->value['message'];?>

    </p>
<?php }?>

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

<?php if ($_smarty_tpl->getVariable('action')->value=="display"){?> 

<?php if ($_smarty_tpl->getVariable('readUsers')->value!="true"){?>
<p>The backend in use does not support working with users in read mode, which is required to use this page.</p>

<?php }else{ ?>
<form name="nameSearchForm" method="get" action="userManagement.php">
    <input type="hidden" readonly="readonly" name="action" value="display"></input>
    <a class="button" href="userManagement.php?action=displayCreateAccount">Add New User</a> | 
    <input type="text" name="filterName" id="filterTextInput" value="<?php echo $_smarty_tpl->getVariable('filterName')->value;?>
" />
    <input type="submit" class="button" name="sub" value="Filter"></input>
</form>

<?php if ($_smarty_tpl->getVariable('numUsers')->value<=0&&$_smarty_tpl->getVariable('wasFiltered')->value=="false"){?>
<p>There are currently no users in the system.</p>

<?php }elseif($_smarty_tpl->getVariable('numUsers')->value<=0&&$_smarty_tpl->getVariable('wasFiltered')->value=="true"){?>
<p>No users were found matching you search criteria.</p>

<?php }else{ ?> 
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
    <?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('users')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
?>
          <tr><td><?php echo $_smarty_tpl->tpl_vars['user']->value['userID'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['user']->value['firstName'];?>
 <?php echo $_smarty_tpl->tpl_vars['user']->value['lastName'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['user']->value['email'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['user']->value['type'];?>
</td>
          <td><a class="button" href="userManagement.php?action=displayEdit&userID=<?php echo $_smarty_tpl->tpl_vars['user']->value['userID'];?>
">Edit</a></td>
          <td><a class="button" href="userManagement.php?action=displayChangePassword&userID=<?php echo $_smarty_tpl->tpl_vars['user']->value['userID'];?>
">Change Password</a></td>
          <td><a class="button" href="userManagement.php?action=confirmAccountRemoval&userID=<?php echo $_smarty_tpl->tpl_vars['user']->value['userID'];?>
">Delete</a></td></tr>
    <?php }} ?>
    </tbody>
</table>

<?php }?> 
<?php }?> 

<?php }elseif(($_smarty_tpl->getVariable('action')->value=="displayEdit"||$_smarty_tpl->getVariable('action')->value=="doEdit")&&$_smarty_tpl->getVariable('userID')->value!=''){?> 

<?php if ($_smarty_tpl->getVariable('useUsers')->value!="true"){?>
<p>The backend in use does not support working with users in read and/or write mode, which is required to use this page.</p>

<?php }else{ ?> 
<p>Change any information you wish to below, and select "Apply" to save changes.</p>

<form name="editAccountForm" method="post" action="userManagement.php">
    <input type="hidden" readonly="readonly" name="action" value="doEdit"></input>
    <input type="hidden" readonly="readonly" name="userID" value="<?php echo $_smarty_tpl->getVariable('editUserInfo')->value['userID'];?>
"></input>
    <fieldset>
    <div class="fieldRow<?php if ($_smarty_tpl->getVariable('error')->value=="BadFirstName"){?> error<?php }?>">
        <label for="firstName"><strong>First Name:</strong></label>
        <input type="text" name="firstName" value="<?php echo $_smarty_tpl->getVariable('editUserInfo')->value['firstName'];?>
"></input>
    </div>
    <div class="fieldRow<?php if ($_smarty_tpl->getVariable('error')->value=="BadLastName"){?> error<?php }?>">
        <label for="lastName"><strong>Last Name:</strong></label>
        <input type="text" name="lastName" value="<?php echo $_smarty_tpl->getVariable('editUserInfo')->value['lastName'];?>
"></input>
    </div>
    <div class="fieldRow<?php if ($_smarty_tpl->getVariable('error')->value=="BadEmail"){?> error<?php }?>">
        <label for="email"><strong>Email Address:</strong></label>
        <input type="text" name="email" value="<?php echo $_smarty_tpl->getVariable('editUserInfo')->value['email'];?>
"></input>
    </div>
    <div class="fieldRow">
        <label for="firstName"><strong>Type:</strong></label>
        <select name="type">
            <option value="Pending"<?php if ($_smarty_tpl->getVariable('editUserInfo')->value['type']=="Pending"){?> selected="selected"<?php }?>>Pending Approval</option>
            <option value="Viewer"<?php if ($_smarty_tpl->getVariable('editUserInfo')->value['type']=="Viewer"){?> selected="selected"<?php }?>>Viewer</option>
            <option value="SuperViewer"<?php if ($_smarty_tpl->getVariable('editUserInfo')->value['type']=="SuperViewer"){?> selected="selected"<?php }?>>SuperViewer</option>
            <option value="Submitter"<?php if ($_smarty_tpl->getVariable('editUserInfo')->value['type']=="Submitter"){?> selected="selected"<?php }?>>Submitter</option>
            <option value="Editor"<?php if ($_smarty_tpl->getVariable('editUserInfo')->value['type']=="Editor"){?> selected="selected"<?php }?>>Editor</option>
            <option value="Admin"<?php if ($_smarty_tpl->getVariable('editUserInfo')->value['type']=="Admin"){?> selected="selected"<?php }?>>Admin</option>
            <option value="Disabled"<?php if ($_smarty_tpl->getVariable('editUserInfo')->value['type']=="Disabled"){?> selected="selected"<?php }?>>Disabled</option>
        </select>
    </div>
	
	
	<div class="fieldRow">
		<label for="groups"><strong>Group:</strong></label>
		<label for="groups">(Select None if users are able to view everything.)</label>
		<br>
		<select name="groups">
			<option value="None" <?php if ($_smarty_tpl->getVariable('editUserInfo')->value['groups']=="None"){?> selected="selected"<?php }?>>None</option>
			<option value="Temp" <?php if ($_smarty_tpl->getVariable('editUserInfo')->value['groups']=="Temp"){?> selected="selected"<?php }?>>Temp</option>
			<option value="Student" <?php if ($_smarty_tpl->getVariable('editUserInfo')->value['groups']=="Student"){?> selected="selected"<?php }?>>Student</option>
			<option value="Teacher" <?php if ($_smarty_tpl->getVariable('editUserInfo')->value['groups']=="Teacher"){?> selected="selected"<?php }?>>Teacher</option>
			<option value="Professor" <?php if ($_smarty_tpl->getVariable('editUserInfo')->value['groups']=="Professor"){?> selected="selected"<?php }?>>Professor</option>
			<option value="Principal" <?php if ($_smarty_tpl->getVariable('editUserInfo')->value['groups']=="Principal"){?> selected="selected"<?php }?>>Principal</option>
			<option value="Dean" <?php if ($_smarty_tpl->getVariable('editUserInfo')->value['groups']=="Dean"){?> selected="selected"<?php }?>>Dean</option>
			<option value="President" <?php if ($_smarty_tpl->getVariable('editUserInfo')->value['groups']=="President"){?> selected="selected"<?php }?>>President</option>
			<option value="Admin" <?php if ($_smarty_tpl->getVariable('editUserInfo')->value['groups']=="Admin"){?> selected="selected"<?php }?>>Admin</option>
		</select>
	</div>
	
	
	
    </fieldset>
    <fieldset class="buttons"><input type="submit" class="button" name="submit" value="Apply"></input>
	<input type="reset" class="button" name="reset" value="Reset"></input>
	<a href="userManagement.php" class="button">Cancel</a></fieldset>
</form>
<?php }?> 


<?php }elseif(($_smarty_tpl->getVariable('action')->value=="displayChangePassword"||$_smarty_tpl->getVariable('action')->value=="doChangePassword")&&$_smarty_tpl->getVariable('userID')->value!=''){?> 

<?php if ($_smarty_tpl->getVariable('useUsers')->value!="true"){?>
<p>The backend in use does not support working with users in read and/or write mode, which is required to use this page.</p>

<?php }else{ ?> 
<p class="note">Changing password for user <strong><?php echo $_smarty_tpl->getVariable('editUserInfo')->value['firstName'];?>
 <?php echo $_smarty_tpl->getVariable('editUserInfo')->value['lastName'];?>
.</strong></p>

<?php if ($_smarty_tpl->getVariable('user')->value['userID']!=$_smarty_tpl->getVariable('editUserInfo')->value['userID']){?> 
<p class="warning">It is not reccomended that you change this user's password. 
Changing a user's password can make it impossible for the user to log in. 
Unless you are resetting this user's password, it is recomended that you do not 
change their password and instead allow the user to change their password themselves from their "My Account" panel.</p>
<?php }else{ ?>
<p class="note">You are changing your own account's password. 
You can also change your password, as well as other account details, from your "My Account" panel.</p>
<?php }?>

<form name="changePasswordForm" action="userManagement.php" method="post"><fieldset>
    <input type="hidden" readonly="readonly" name="action" value="doChangePassword"></input>
    <input type="hidden" readonly="readonly" name="userID" value="<?php echo $_smarty_tpl->getVariable('editUserInfo')->value['userID'];?>
"></input>
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
<?php }?> 


<?php }elseif($_smarty_tpl->getVariable('action')->value=="displayCreateAccount"||$_smarty_tpl->getVariable('action')->value=="doCreateAccount"){?> 

<?php if ($_smarty_tpl->getVariable('useUsers')->value!="false"){?>
<h2>Create New Account</h2>
<p>Enter all information about the user of the new account below and select "Create Account" to add the account.</p>

<form name="newAccountForm" method="post" action="userManagement.php">
    <input type="hidden" name="action=" value="doCreateAccount" readonly="readonly"></input>
    <fieldset>
    <input type="hidden" readonly="readonly" name="action" value="doCreateAccount"></input>
    <div class="fieldRow<?php if ($_smarty_tpl->getVariable('result')->value=="BadFirstName"){?> error<?php }?>">
        <label for="firstName"><strong>First Name:</strong></label>
        <input type="text" name="firstName" id="firstName" value="<?php echo (($tmp = @$_smarty_tpl->getVariable('editUserInfo')->value['firstName'])===null||$tmp==='' ? '' : $tmp);?>
"></input>
    </div>
    <div class="fieldRow<?php if ($_smarty_tpl->getVariable('result')->value=="BadLastName"){?> error<?php }?>">
        <label for="lastName"><strong>Last Name:</strong></label>
        <input type="text" name="lastName" id="lastName" value="<?php echo (($tmp = @$_smarty_tpl->getVariable('editUserInfo')->value['lastName'])===null||$tmp==='' ? '' : $tmp);?>
"></input>
    </div>
    <div class="fieldRow<?php if ($_smarty_tpl->getVariable('result')->value=="BadEmail"||$_smarty_tpl->getVariable('result')->value=="EmailAlreadyExists"){?> error<?php }?>">
        <label for="email"><strong>Email Address:</strong></label>
        <input type="text" name="email" id="email" value="<?php echo (($tmp = @$_smarty_tpl->getVariable('editUserInfo')->value['email'])===null||$tmp==='' ? '' : $tmp);?>
"></input>
        <?php if ($_smarty_tpl->getVariable('result')->value=="EmailAlreadyExists"){?>This email address is already in use.<?php }?>
    </div>
    <div class="fieldRow">
        <label for="type"><strong>Type:</strong></label>
        <select name="type">
            <option value="Pending"<?php if ($_smarty_tpl->getVariable('editUserInfo')->value['type']=="Pending"){?> selected="selected"<?php }?>>Pending Approval</option>
            <option value="Viewer"<?php if ($_smarty_tpl->getVariable('editUserInfo')->value['type']=="Viewer"){?> selected="selected"<?php }?>>Viewer</option>
            <option value="SuperViewer"<?php if ($_smarty_tpl->getVariable('editUserInfo')->value['type']=="SuperViewer"){?> selected="selected"<?php }?>>SuperViewer</option>
            <option value="Submitter"<?php if ($_smarty_tpl->getVariable('editUserInfo')->value['type']=="Submitter"){?> selected="selected"<?php }?>>Submitter</option>
            <option value="Editor"<?php if ($_smarty_tpl->getVariable('editUserInfo')->value['type']=="Editor"){?> selected="selected"<?php }?>>Editor</option>
            <option value="Admin"<?php if ($_smarty_tpl->getVariable('editUserInfo')->value['type']=="Admin"){?> selected="selected"<?php }?>>Admin</option>
            <option value="Disabled"<?php if ($_smarty_tpl->getVariable('editUserInfo')->value['type']=="Disabled"){?> selected="selected"<?php }?>>Disabled</option>
        </select>
    </div>
	
	
	
		
	
	
	
		<div class="fieldRow">
		<label for="groups"><strong>Group:</strong></label>
		<label for="groups">(Select None if users are able to view everything.)</label>
		<br>
		<select name="groups">
			<option value="None" <?php if ($_smarty_tpl->getVariable('editUserInfo')->value['groups']=="None"){?> selected="selected"<?php }?>>None</option>
			<option value="Temp" <?php if ($_smarty_tpl->getVariable('editUserInfo')->value['groups']=="Temp"){?> selected="selected"<?php }?>>Temp</option>
			<option value="Student" <?php if ($_smarty_tpl->getVariable('editUserInfo')->value['groups']=="Student"){?> selected="selected"<?php }?>>Student</option>
			<option value="Teacher" <?php if ($_smarty_tpl->getVariable('editUserInfo')->value['groups']=="Teacher"){?> selected="selected"<?php }?>>Teacher</option>
			<option value="Professor" <?php if ($_smarty_tpl->getVariable('editUserInfo')->value['groups']=="Professor"){?> selected="selected"<?php }?>>Professor</option>
			<option value="Principal" <?php if ($_smarty_tpl->getVariable('editUserInfo')->value['groups']=="Principal"){?> selected="selected"<?php }?>>Principal</option>
			<option value="Dean" <?php if ($_smarty_tpl->getVariable('editUserInfo')->value['groups']=="Dean"){?> selected="selected"<?php }?>>Dean</option>
			<option value="President" <?php if ($_smarty_tpl->getVariable('editUserInfo')->value['groups']=="President"){?> selected="selected"<?php }?>>President</option>
			<option value="Admin" <?php if ($_smarty_tpl->getVariable('editUserInfo')->value['groups']=="Admin"){?> selected="selected"<?php }?>>Admin</option>
		</select>
	</div>
	
	
	
	
	
	
	
    <div class="fieldRow<?php if ($_smarty_tpl->getVariable('result')->value=="BadPassword"){?> error<?php }?>">
        <label for="password1"><strong>Password:</strong></label>
        <input type="password" name="password1"></input>
        <?php if ($_smarty_tpl->getVariable('result')->value=="BadPassword"){?>Password must be at least 5 characters.<?php }?>
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

<?php }?> 

<?php }elseif($_smarty_tpl->getVariable('action')->value=="confirmAccountRemoval"){?> 

<?php if ($_smarty_tpl->getVariable('useUsers')->value!="false"){?>
<p class="warning">Are you sure you want to delete the account belonging to <?php echo $_smarty_tpl->getVariable('editUserInfo')->value['firstName'];?>
 <?php echo $_smarty_tpl->getVariable('editUserInfo')->value['lastName'];?>
 (<?php echo $_smarty_tpl->getVariable('editUserInfo')->value['email'];?>
)?</p>

<p>Deleting this account is permanent, and can not be undone without manually changing the back-end storage engine.  Once this account has been deleted, the user who owns this account 
will no longer be able to modify, edit, or manage their account, modules, or materials.  In addition, even if a new account is create with the same name and email, it will be  
considered a different account and will not have access to any modules, materials, or settings belonging to this account.

<?php if ($_smarty_tpl->getVariable('usersSoftRemove')->value=="true"){?>
<p><span class="note">Notice:  The account will be softly deleted.</span>  A softly deleted account may continue to store certain 
information in it, even once it has been deleted.  This information is necessary to maintain information about modules and materials submitted by the account.  All other information 
about the account, including as much personal information as possible, will be permently deleted.  To remove all information about this account, including information which may 
be require to maintain module and material consistancy, you will need to manually edit the back-end storage database.</p>
<?php }?>

<p>
<a class="button" href="userManagement.php?action=doAccountRemoval&userID=<?php echo $_smarty_tpl->getVariable('editUserInfo')->value['userID'];?>
">Delete Account</a>
<a class="button"  href="userManagement.php">Cancel</a>
</p>
<?php }?> 

<?php }?> 

<?php if ($_smarty_tpl->getVariable('action')->value!="display"){?><p>Back to <a href="userManagement.php">User Management</a>.</p><?php }?>

<?php }?> 

</div>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
