<?php /* Smarty version Smarty-3.0.7, created on 2014-06-17 15:24:37
         compiled from "E:\XAMPP\xampplite-win32-1.7.3\xampplite\htdocs\xampp\EdRepo\EdRepo\lib\smarty/templates/forgotPassword.php.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3089553a095f5590c06-99256860%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '73b85c2804ef70be9644c5967ab3cbc79bf55938' => 
    array (
      0 => 'E:\\XAMPP\\xampplite-win32-1.7.3\\xampplite\\htdocs\\xampp\\EdRepo\\EdRepo\\lib\\smarty/templates/forgotPassword.php.tpl',
      1 => 1337897780,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3089553a095f5590c06-99256860',
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
  if(firstName.search("\"")!=-1 || lastName.search("\"")!=-1 || email.search("\"")!=-1 || firstName.search("\'")!=-1 || lastName.search("\'")!=-1 || email.search("\'")!=-1) {
    //Don't allow quote marks.
    alert("Sorry, but first names, last, names, and email addresses may not contain quote marks.");
    return false;
  }
  return true;
}
</script>

<?php if ($_smarty_tpl->getVariable('backendCapable')->value!=true){?>
<h2>This Feature Is Not Supported</h2>
<p>The backend in use does not currently support this feature.</p>

<?php }elseif($_smarty_tpl->getVariable('loggedIn')->value==true){?>
<h2>Please Use The Your "My Account" Panel to Change Your Password</h2>
<p>You are currently logged in.  To change your password, use the your "My Account" panel.</p>
  
<?php }else{ ?> 

<?php if ($_smarty_tpl->getVariable('action')->value=="display"){?>
<p>To recover your password, enter your email address below and click "Recover Password" to send your password to your email address.</p>
<form name="passwordRecoveryForm" method="post" action="forgotPassword.php">
    <input type="hidden" readonly="readonly" name="action" value="recover"></input>
    <div class="fieldRow">
        <label for="email"><strong>Email Address:</strong></label>
        <input type="text" name="email" value="<?php echo (($tmp = @$_smarty_tpl->getVariable('email')->value)===null||$tmp==='' ? '' : $tmp);?>
"></input>
    </div>
    
    <fieldset class="buttons">
        <input type="submit" class="button" name="sub" value="Recover Password"></input>
    </fieldset>
</form>

<?php }elseif($_smarty_tpl->getVariable('action')->value=="recover"){?>

<?php }elseif($_smarty_tpl->getVariable('action')->value=="reset"||$_smarty_tpl->getVariable('action')->value=="doReset"){?>
 <?php if ($_smarty_tpl->getVariable('showForm')->value==true){?>
<p>To reset your password, enter your new password twice in the form below.</p>
<form name="passwordRecoveryForm" method="post" action="forgotPassword.php">
    <input type="hidden" readonly="readonly" name="action" value="doReset"></input>
    <input type="hidden" readonly="readonly" name="userID" value="<?php echo $_smarty_tpl->getVariable('userID')->value;?>
"></input>
    <input type="hidden" readonly="readonly" name="token" value="<?php echo $_smarty_tpl->getVariable('token')->value;?>
"></input>
    <div class="fieldRow">
        <label for="password1"><strong>New Password:</strong></label>
        <input type="password" name="password1"></input>
    </div>
    <div class="fieldRow">
        <label for="password2"><strong>Retype Password:</strong></label>
        <input type="password" name="password2"></input>
    </div>
    
    <fieldset class="buttons">
        <input type="submit" class="button" name="sub" value="Save Password"></input>
    </fieldset>
</form> 
 
 <?php }?> 

<?php }else{ ?>
<p>Unable to process your request.  An unknown action was specified</p>

<?php }?> 

<?php }?> 

</div>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
