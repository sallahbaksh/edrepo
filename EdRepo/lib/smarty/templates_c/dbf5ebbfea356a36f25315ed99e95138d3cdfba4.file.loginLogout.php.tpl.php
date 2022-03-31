<?php /* Smarty version Smarty-3.0.7, created on 2017-01-13 12:11:47
         compiled from "/var/www/html/EdRepo/EdRepo/lib/smarty/templates/loginLogout.php.tpl" */ ?>
<?php /*%%SmartyHeaderCode:87918469158790a537e6856-31786983%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dbf5ebbfea356a36f25315ed99e95138d3cdfba4' => 
    array (
      0 => '/var/www/html/EdRepo/EdRepo/lib/smarty/templates/loginLogout.php.tpl',
      1 => 1484321122,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '87918469158790a537e6856-31786983',
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

<?php if ($_smarty_tpl->getVariable('loginSuccess')->value!=true){?>
<p><a class="button" href="createAccount.php">Create New Account</a></p>

<form name="loginForm" method="post" action="loginLogout.php">
    <fieldset>
    <input type="hidden" name="action" value="login" readonly="readonly"></input>
    <div class="fieldRow">
        <label for="email"><strong>Email address:</strong></label>
        <input name="email" type="text" value="<?php echo (($tmp = @$_smarty_tpl->getVariable('userEmail')->value)===null||$tmp==='' ? '' : $tmp);?>
"></input>
    </div>
    <div class="fieldRow">
        <label for="password"><strong>Password:</strong></label>
        <input name="password" type="password"></input>
    </div>
    </fieldset>
    
    <fieldset class="buttons">
        <input type="submit" class="button" name="submit" value="Login"></input><br><br>
        <a href="forgotPassword.php">Forgot password?</a>
    </fieldset>
</form>
<?php }?>

</div>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>