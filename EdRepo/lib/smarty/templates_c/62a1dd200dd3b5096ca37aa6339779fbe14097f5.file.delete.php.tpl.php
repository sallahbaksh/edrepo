<?php /* Smarty version Smarty-3.0.7, created on 2014-07-08 11:19:40
         compiled from "E:\XAMPP\xampplite-win32-1.7.3\xampplite\htdocs\xampp\EdRepo\EdRepo\lib\smarty/templates/moduleWizard/delete.php.tpl" */ ?>
<?php /*%%SmartyHeaderCode:854653bc0c0c754ff1-46235690%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '62a1dd200dd3b5096ca37aa6339779fbe14097f5' => 
    array (
      0 => 'E:\\XAMPP\\xampplite-win32-1.7.3\\xampplite\\htdocs\\xampp\\EdRepo\\EdRepo\\lib\\smarty/templates/moduleWizard/delete.php.tpl',
      1 => 1404409954,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '854653bc0c0c754ff1-46235690',
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

<?php if ($_smarty_tpl->getVariable('hasPermission')->value==true&&$_smarty_tpl->getVariable('action')->value!="error"){?>

<?php if ($_smarty_tpl->getVariable('action')->value=="delete"){?>
<p><span class="warning"><strong>Are you sure you want to delete the module "<?php echo $_smarty_tpl->getVariable('moduleInfo')->value['title'];?>
"?</strong></span></p>

<p>Deleting this module will permanently remove it, and you will loose all changes you have made to it.</p>

<?php if ($_smarty_tpl->getVariable('user')->value['userID']!=$_smarty_tpl->getVariable('moduleInfo')->value['submitterUserID']){?>
<p><span class="warning"><strong>WARNING:  You are deleting a module which does not belong to you!</strong></span><br />
Deleting a module which does not belong to you is not recomended.  If you submit this module, the origional module owner will no 
longer be able to edit or create new versions of this module.  It is strongly suggested, therefore, that you stop editing this 
module.  If you choose to continue editing this module, it is STRONGLY reccomended you do not submit it for moderation or publish 
it to the collection.</p>
<?php }?>

<p><a class="button" href="delete.php?action=doDelete&moduleID=<?php echo $_smarty_tpl->getVariable('moduleInfo')->value['moduleID'];?>
">Delete</a> | 
<a class="button" href="../showMyModules.php">Cancel</a></p>

<?php }elseif($_smarty_tpl->getVariable('action')->value!="doDelete"&&$_smarty_tpl->getVariable('action')->value!="error"){?>
<p>Unknown action specified.</p>

<?php }?> 

<?php }?> 

<?php if ($_smarty_tpl->getVariable('user')->value['type']=="Submitter"||$_smarty_tpl->getVariable('user')->value['type']=="Editor"||$_smarty_tpl->getVariable('user')->value['type']=="Admin"){?>
<p><a href="../showMyModules.php">Return to "My Modules"</a></p>
<?php }?>
    
</div>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
