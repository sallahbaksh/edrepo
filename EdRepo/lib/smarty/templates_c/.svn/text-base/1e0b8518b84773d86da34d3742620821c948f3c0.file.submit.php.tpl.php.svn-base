<?php /* Smarty version Smarty-3.0.7, created on 2014-06-18 15:41:39
         compiled from "E:\XAMPP\xampplite-win32-1.7.3\xampplite\htdocs\xampp\EdRepo\EdRepo\lib\smarty/templates/moduleWizard/submit.php.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1235553a1eb737e8579-95873641%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1e0b8518b84773d86da34d3742620821c948f3c0' => 
    array (
      0 => 'E:\\XAMPP\\xampplite-win32-1.7.3\\xampplite\\htdocs\\xampp\\EdRepo\\EdRepo\\lib\\smarty/templates/moduleWizard/submit.php.tpl',
      1 => 1337897780,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1235553a1eb737e8579-95873641',
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

<div id="wizard">
<?php $_template = new Smarty_Internal_Template("moduleWizard/wizardNav.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<div id="wizard-form">
<?php if (isset($_smarty_tpl->getVariable('submitSuccess',null,true,false)->value)&&$_smarty_tpl->getVariable('submitSuccess')->value){?>
<p>Thank you for submitting <a href="../viewModule.php?moduleID=<?php echo $_smarty_tpl->getVariable('moduleInfo')->value['moduleID'];?>
&forceView=true">your module</a>. Once approved by a moderator, your module will be publicly visible.</p>
<?php }else{ ?>
  <form method="post" class="tabular" action="submit.php">  
    <input type="hidden" readonly="readonly" name="moduleID" value="<?php echo (($tmp = @$_smarty_tpl->getVariable('moduleInfo')->value['moduleID'])===null||$tmp==='' ? '' : $tmp);?>
"></input>
    
    <div class="fieldRow">
        <label>
            <h3>Check-In Comments</h3>
            <p>Any final comments you have regarding this module, the submission process, or any information you wish to share with any moderators. These comments are only visable to moderators.</p>
        </label>
        
        <div class="fieldInput">
            <textarea name="moduleCheckInComments"><?php echo (($tmp = @$_smarty_tpl->getVariable('moduleInfo')->value['checkInComments'])===null||$tmp==='' ? '' : $tmp);?>
</textarea>
        </div>
    </div>    
    
    <fieldset class="buttons">
      <input type="submit" name="submit" class="button" value="Submit Module" />
      <a class="button" href="index.php?moduleAction=edit&moduleID=<?php echo $_smarty_tpl->getVariable('moduleInfo')->value['moduleID'];?>
">Cancel</a>
    </fieldset>
  </form>
<?php }?> 
</div>

</div>
<?php }?> 

</div>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>