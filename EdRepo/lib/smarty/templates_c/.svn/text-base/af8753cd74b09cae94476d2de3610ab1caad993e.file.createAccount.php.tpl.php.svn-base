<?php /* Smarty version Smarty-3.0.7, created on 2014-06-18 11:32:54
         compiled from "E:\XAMPP\xampplite-win32-1.7.3\xampplite\htdocs\xampp\EdRepo\EdRepo\lib\smarty/templates/createAccount.php.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2111753a1b126a763f2-17995379%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'af8753cd74b09cae94476d2de3610ab1caad993e' => 
    array (
      0 => 'E:\\XAMPP\\xampplite-win32-1.7.3\\xampplite\\htdocs\\xampp\\EdRepo\\EdRepo\\lib\\smarty/templates/createAccount.php.tpl',
      1 => 1403102554,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2111753a1b126a763f2-17995379',
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

<script type="text/javascript">
    function quickValidateAllFormFields() {
      var email=document.getElementById("email").value;
      var firstName=document.getElementById("firstName").value;
      var lastName=document.getElementById("lastName").value;
      if(firstName.search("\"")!=-1 || lastName.search("\"")!=-1 || email.search("\"")!=-1) { //Don't allow quote marks.
        alert("Sorry, but first names, last, names, and email addresses may not contain quote marks.");
        return false;
      }
      return true;
    }
</script>

<?php if ($_smarty_tpl->getVariable('backendCapable')->value!=true){?>
<h2>This Feature Is Not Supported</h2>
<p>The backend in use does not currently support this feature.</p>

<?php }elseif($_smarty_tpl->getVariable('loggedIn')->value!=false){?>
<h2>You Must Log Out To Continue</h2>
<p>You are currently logged in.  You must log out before creating a new account.</p>
    <?php if ($_smarty_tpl->getVariable('user')->value['type']=="Admin"){?>
    <p><strong>Admin Users:</strong> To create or manage user accounts, use the "User Management" tool from the admin menu.</p>
    <?php }?>
  
<?php }else{ ?> 

<?php if ($_smarty_tpl->getVariable('result')->value!="success"){?>
<p>To create a new account, fill in all of the information below and select "Create Account".</p>
<?php if ($_smarty_tpl->getVariable('NEW_ACCOUNTS_REQUIRE_APPROVAL')->value==true){?>
  <p><span class="note">Your account will require approval before it becomes active.</span>  The maintainer of this collection requires 
  that new accounts be approved before they can be used.  Once your account is created, it will not be accessible until it is approved.</p>
<?php }?>

<form name="createAccountFrom" action="createAccount.php" method="post">
    <input type="hidden" readonly="readonly" name="action" value="doCreateAccount"></input>
    <div class="fieldRow<?php if ($_smarty_tpl->getVariable('result')->value=="BadFirstName"){?> error<?php }?>">
        <label for="firstName"><strong>First Name:</strong></label>
        <input type="text" name="firstName" id="firstName" value="<?php echo (($tmp = @$_smarty_tpl->getVariable('firstName')->value)===null||$tmp==='' ? '' : $tmp);?>
"></input>
    </div>
    <div class="fieldRow<?php if ($_smarty_tpl->getVariable('result')->value=="BadLastName"){?> error<?php }?>">
        <label for="lastName"><strong>Last Name:</strong></label>
        <input type="text" name="lastName" id="lastName" value="<?php echo (($tmp = @$_smarty_tpl->getVariable('lastName')->value)===null||$tmp==='' ? '' : $tmp);?>
"></input>
    </div>
    <div class="fieldRow<?php if ($_smarty_tpl->getVariable('result')->value=="BadEmail"||$_smarty_tpl->getVariable('result')->value=="EmailAlreadyExists"){?> error<?php }?>">
        <label for="email"><strong>Email Address:</strong></label>
        <input type="text" name="email" id="email" value="<?php echo (($tmp = @$_smarty_tpl->getVariable('email')->value)===null||$tmp==='' ? '' : $tmp);?>
"></input>
        <?php if ($_smarty_tpl->getVariable('result')->value=="EmailAlreadyExists"){?>
            <span class="error">This email address is already in use.</span>
        <?php }?>
    </div>
    <div class="fieldRow">
        <label for="password1"><strong>Password:</strong></label>
        <input type="password" name="password1"></input>
    </div>
    <div class="fieldRow">
        <label for="password2"><strong>Retype Password:</strong></label>
        <input type="password" name="password2"></input>
    </div>

    <fieldset class="buttons">
    <input class="button" type="submit" name="submit" value="Create Account" onclick="return quickValidateAllFormFields();"></input>
    </fieldset>
</form>
<?php }?>

<?php }?> 

<?php if ($_smarty_tpl->getVariable('action')->value!="display"&&$_smarty_tpl->getVariable('action')->value!="doCreateAccount"){?>
<p>Unable to process your request.  An unknown action was specified</p>
<?php }?>

</div>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
