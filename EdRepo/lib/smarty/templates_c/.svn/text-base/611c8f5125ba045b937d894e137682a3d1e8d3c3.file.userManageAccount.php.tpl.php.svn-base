<?php /* Smarty version Smarty-3.0.7, created on 2014-06-17 15:14:51
         compiled from "E:\XAMPP\xampplite-win32-1.7.3\xampplite\htdocs\xampp\EdRepo\EdRepo\lib\smarty/templates/userManageAccount.php.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2467653a093ab63e0f5-17555394%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '611c8f5125ba045b937d894e137682a3d1e8d3c3' => 
    array (
      0 => 'E:\\XAMPP\\xampplite-win32-1.7.3\\xampplite\\htdocs\\xampp\\EdRepo\\EdRepo\\lib\\smarty/templates/userManageAccount.php.tpl',
      1 => 1337897780,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2467653a093ab63e0f5-17555394',
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


<?php if (isset($_smarty_tpl->getVariable('userInformation',null,true,false)->value)!=true){?>
<p>Sorry, you must be logged in to continue.</p>

<?php }elseif(($_smarty_tpl->getVariable('action')->value=="display"&&$_smarty_tpl->getVariable('readUsers')->value==false)||($_smarty_tpl->getVariable('action')->value!="display"&&$_smarty_tpl->getVariable('useUsers')->value==false)){?>
<p class="alert negative">
The backend in use does not support working with users in read and/or write mode, which is required to use this page.
</p>

<?php }else{ ?> 


<?php if ($_smarty_tpl->getVariable('action')->value=="display"){?> 
<p>You current account information is displayed below.  To change it, click "Edit Information".  To change your password, choose 
"Change Password".  You may also delete your account from this page.</p>

<p>
    <a class="button" href="userManageAccount.php?action=displayEdit">Edit Information</a>
    <a class="button" href="userManageAccount.php?action=displayChangePassword">Change Password</a>
    <a class="button" href="userManageAccount.php?action=confirmAccountRemoval">Delete Account</a>
</p><br>

<table class="userInformationView" style="display: block">
    <tr><td class="highlight">First Name</td><td><?php echo $_smarty_tpl->getVariable('userInformation')->value['firstName'];?>
</td></tr>
    <tr><td class="highlight">Last Name</td><td><?php echo $_smarty_tpl->getVariable('userInformation')->value['lastName'];?>
</td></tr>
    <tr><td class="highlight">Email Address</td><td><?php echo $_smarty_tpl->getVariable('userInformation')->value['email'];?>
</td></tr>
    <tr><td class="highlight">Type<?php if ($_smarty_tpl->getVariable('userInformation')->value['type']=="Admin"){?>*<?php }?></td><td><?php echo $_smarty_tpl->getVariable('userInformation')->value['type'];?>
</td></tr>
</table>

<?php if ($_smarty_tpl->getVariable('userInformation')->value['type']=="Admin"){?>
<p>* To change account types, use the <a href="admin/userManagement.php">User Management</a> tool.</p>
<?php }?>


<?php }elseif($_smarty_tpl->getVariable('action')->value=="displayEdit"||($_smarty_tpl->getVariable('action')->value=="doEdit"&&$_smarty_tpl->getVariable('error')->value!='')){?> 
<p>Change any information you wish to below, and select "Apply" to save your changes.</p>
<form name="editAccountForm" method="post" action="userManageAccount.php">
    <input type="hidden" readonly="readonly" name="action" value="doEdit"></input>
    <fieldset>
    <div class="fieldRow<?php if ($_smarty_tpl->getVariable('error')->value=="BadFirstName"){?> error<?php }?>">
        <label for="firstName"><strong>First Name:</strong></label>
        <input type="text" name="firstName" value="<?php echo $_smarty_tpl->getVariable('userInformation')->value['firstName'];?>
"></input>
    </div>
    <div class="fieldRow<?php if ($_smarty_tpl->getVariable('error')->value=="BadLastName"){?> error<?php }?>">
        <label for="lastName"><strong>Last Name:</strong></label>
        <input type="text" name="lastName" value="<?php echo $_smarty_tpl->getVariable('userInformation')->value['lastName'];?>
"></input>
    </div>
    <div class="fieldRow<?php if ($_smarty_tpl->getVariable('error')->value=="BadEmail"){?> error<?php }?>">
        <label for="email"><strong>Email Address:</strong></label>
        <input type="text" name="email" value="<?php echo $_smarty_tpl->getVariable('userInformation')->value['email'];?>
"></input>
    </div>
    <div class="fieldRow">
        <label for="type"><strong>Type<?php if ($_smarty_tpl->getVariable('userInformation')->value['type']=="Admin"){?>*<?php }?>:</strong></label>
        <?php echo $_smarty_tpl->getVariable('userInformation')->value['type'];?>

    </div>
    </fieldset>
    
    <fieldset class="buttons">
        <input type="submit" class="button" name="submit" value="Apply"></input>
        <input type="reset" class="button" name="reset" value="Reset">
    </fieldset>
</form>

<?php if ($_smarty_tpl->getVariable('userInformation')->value['type']=="Admin"){?>
<p>* To change account types, use the <a href="admin/userManagement.php">User Management</a> tool.</p>
<?php }?>
<?php }elseif($_smarty_tpl->getVariable('action')->value=="displayChangePassword"||($_smarty_tpl->getVariable('action')->value=="doChangePassword"&&$_smarty_tpl->getVariable('error')->value!='')){?> 
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
<?php }elseif($_smarty_tpl->getVariable('action')->value=="confirmAccountRemoval"){?>
<p><span class="warning"><strong>Are you sure you want to delete your account?</strong></span></p>

<p>When you delete your account, you will no longer have access to any functions of this collection beyond browsing public content.
Deletions can not normally be undone, and even if you create a new account after deleting this one, you will likely not be able to 
edit or manage any modules or materials you have uploaded or worked with under the current account, even if you create a new account 
with the same email address, name, and password.</p>

<?php if ($_smarty_tpl->getVariable('usersSoftRemove')->value==true){?>
<p><span class="note">Notice:  Your account will be softly deleted.</span>  A softly deleted account may continue to store certain 
information in it, even once it has been deleted.  Please contact this collection's maintainer with any questions or concerns with 
soft deletion.</p>
<?php }?>

<p>
    <a class="button" href="userManageAccount.php?action=doAccountRemoval">Delete Account</a>
    <a class="button" href="userManageAccount.php">Cancel</a>
</p>


<?php }?> 

<?php if ($_smarty_tpl->getVariable('action')->value!="display"&&$_smarty_tpl->getVariable('action')->value!="doAccountRemoval"){?>
<p>Return to <a href="userManageAccount.php">My Account</a>.</p>
<?php }?>
      
<?php }?> 

</div>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>