<?php /* Smarty version Smarty-3.0.7, created on 2014-07-11 10:56:33
         compiled from "E:\XAMPP\xampplite-win32-1.7.3\xampplite\htdocs\xampp\EdRepo\EdRepo\lib\smarty/templates/moduleWizard/references.php.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1152853bffb21186d22-51474059%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c3cea5924b7b03543b3326892bd35626540f53de' => 
    array (
      0 => 'E:\\XAMPP\\xampplite-win32-1.7.3\\xampplite\\htdocs\\xampp\\EdRepo\\EdRepo\\lib\\smarty/templates/moduleWizard/references.php.tpl',
      1 => 1405090588,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1152853bffb21186d22-51474059',
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

<script type="text/javascript" src="../lib/jquery/check-changes.js"></script>
<?php $_template = new Smarty_Internal_Template("moduleWizard/moduleWizard-js.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<!-- JQuery Function that allows auto-complete search for titles that gives the ID for the title you created -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script>
function autoComplete(name) {
	var obj = []; 
	obj = <?php echo json_encode($_smarty_tpl->getVariable('auto')->value);?>
; 
	$(name).autocomplete({
		source:obj
	});
 
}
</script>
<div id="wizard-form">
  <form method="post" class="tabular" action="references.php">  
    <input type="hidden" readonly="readonly" name="moduleID" value="<?php echo (($tmp = @$_smarty_tpl->getVariable('moduleInfo')->value['moduleID'])===null||$tmp==='' ? '' : $tmp);?>
"></input>
    <input id="noModuleERefs" type="hidden" value="true" name="noModuleERefs">
    <input id="noModuleIRefs" type="hidden" value="true" name="noModuleIRefs">
    
    <div class="fieldRow">
        <label>
            <h3>Related Modules</h3>
            <p>If other modules in this collection relate to this module, add them here, along with a brief description of the relation.</p>
        </label>
        <div class="fieldInput">
            <div id="IRefsList"></div>
            <button class="button" onclick="add('IRefs', '')" type="button">Add Related Module</button>
        </div>
    </div>
    
    <div class="fieldRow">
        <label>
            <h3>External References</h3>
            <p>External references are references to sources outside this collection that viewers of your module may be interested in. It is recommended you provide these references in the form of a citation (for example, in APA or MLA style).</p>
        </label>
        <div class="fieldInput">
            <div id="ERefsList"></div>
            <button class="button" onclick="add('ERefs', '')" type="button">Add External Reference</button>
        </div>
    </div>
    
    <fieldset class="buttons">
      <input type="submit" name="submit" class="button" value="Save References" />
      <input type="reset" class="button" value="Reset" />
    </fieldset>
  </form>
</div>

</div>
<?php }?> 

</div>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>