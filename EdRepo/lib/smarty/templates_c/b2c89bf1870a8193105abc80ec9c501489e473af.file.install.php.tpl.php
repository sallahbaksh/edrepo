<?php /* Smarty version Smarty-3.0.7, created on 2017-01-13 11:37:49
         compiled from "/var/www/html/EdRepo/EdRepo/lib/smarty/templates/install.php.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1582421015879025dad26d2-82920720%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b2c89bf1870a8193105abc80ec9c501489e473af' => 
    array (
      0 => '/var/www/html/EdRepo/EdRepo/lib/smarty/templates/install.php.tpl',
      1 => 1484321122,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1582421015879025dad26d2-82920720',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<div id="content">

<h1>Installing the Edrepo front-end</h1>

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

<p>To manually install EdRepo please click below. Otherwise fill out the form below to automatically install EdRepo.</p>
<form action="install.php" method="post">

<input type="hidden" readonly="readonly" name="action" value="manualInstall"></input>
<input type="submit" class="button" value="Manually Install EdRepo"></input>

</form>

<p>Please fill out the following to set up your Edrepo collection.</p>

<form action="install.php" method="post" class="tabular" >

<input type="hidden" readonly="readonly" name="action" value="doEdit"></input>

<input type="hidden" readonly="readonly" name="install" value="TRUE"></input>

<div class="fieldRow"> 
	<label><h3>Collection Name</h3></label> 
	<input type="text" name="collection_name" value="<?php echo $_smarty_tpl->getVariable('COLLECTION_NAME')->value;?>
" /> 
</div> 

<div class="fieldRow"> 
	<label><h3>Base URL</h3>
  <p>The base directory where you installed EdRepo. For example if your URL is "http://mysite.com/stuff/edrepo" the Base URL would be "/stuff/edrepo".</p>
  </label>
  	<input type="radio" name="baseURL" name="auto" value="<?php echo $_smarty_tpl->getVariable('collectionBaseURL')->value;?>
" checked="checked"><b><?php echo $_smarty_tpl->getVariable('collectionBaseURL')->value;?>
</b></input>
  	<p style="display:inline">or</p>
	<input type="radio" name="baseURL" name="entered"><input type="text" name="collection_base_url" value="<?php echo $_smarty_tpl->getVariable('COLLECTION_BASE_URL')->value;?>
" /></input>
</div> 

<div class="fieldRow">  
	<label><h3>Material Storage Directory</h3>
  <p>Absolute path to a directory on your server's filesystem to save this collection's materials.</p></label>  
	<input type="text" name="material_storage_dir" value="<?php echo $_smarty_tpl->getVariable('MATERIAL_STORAGE_DIR')->value;?>
" /> 
</div> 

<div class="fieldRow"> 
	<label><h3>Approval For New Accounts</h3><p>New accounts require administrator approval.</p></label>  
	<input type="checkbox" name="new_accounts_require_approval" 
	<?php if ($_smarty_tpl->getVariable('NEW_ACCOUNTS_REQUIRE_APPROVAL')->value=="TRUE"){?> checked="checked"<?php }?> />
</div> 

<div class="fieldRow">
	<label><h3>Auto-approval for modules.</h3> 
	<p>Automatically approves modules when submitted. (Default: Admin, Editor)</p></label>
	<?php  $_smarty_tpl->tpl_vars['selectedUser'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('selectedTypes')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['selectedUser']->key => $_smarty_tpl->tpl_vars['selectedUser']->value){
?>
		<input type="checkbox" name="auto_approve_accounts[]" value="<?php echo $_smarty_tpl->tpl_vars['selectedUser']->value;?>
" checked="checked">
		<?php echo $_smarty_tpl->tpl_vars['selectedUser']->value;?>

		</input>
	<?php }} ?>
	<?php  $_smarty_tpl->tpl_vars['accountTypes'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('accountType')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['accountTypes']->key => $_smarty_tpl->tpl_vars['accountTypes']->value){
?>
		<input type="checkbox" name="auto_approve_accounts[]" value="<?php echo $_smarty_tpl->tpl_vars['accountTypes']->value;?>
">
		<?php echo $_smarty_tpl->tpl_vars['accountTypes']->value;?>

		</input>
	<?php }} ?>

</div>

<div class="fieldRow"> 
	<label><h3>Default New Account Type</h3></label> 
	<select name="new_accounts_account_type" value="<?php echo $_smarty_tpl->getVariable('NEW_ACCOUNTS_ACCOUNT_TYPE')->value;?>
" />
		<option <?php if (isset($_smarty_tpl->getVariable('NEW_ACCOUNTS_ACCOUNT_TYPE',null,true,false)->value)&&$_smarty_tpl->getVariable('NEW_ACCOUNTS_ACCOUNT_TYPE')->value=="Viewer"){?> selected="selected"<?php }?>>Viewer</option>
		<option <?php if (isset($_smarty_tpl->getVariable('NEW_ACCOUNTS_ACCOUNT_TYPE',null,true,false)->value)&&$_smarty_tpl->getVariable('NEW_ACCOUNTS_ACCOUNT_TYPE')->value=="Super Viewer"){?> selected="selected"<?php }?>>Super Viewer</option>
		<option <?php if (isset($_smarty_tpl->getVariable('NEW_ACCOUNTS_ACCOUNT_TYPE',null,true,false)->value)&&$_smarty_tpl->getVariable('NEW_ACCOUNTS_ACCOUNT_TYPE')->value=="Submitter"){?> selected="selected"<?php }?>>Submitter</option>
		<option <?php if (isset($_smarty_tpl->getVariable('NEW_ACCOUNTS_ACCOUNT_TYPE',null,true,false)->value)&&$_smarty_tpl->getVariable('NEW_ACCOUNTS_ACCOUNT_TYPE')->value=="Editor"){?> selected="selected"<?php }?>>Editor</option>
		<option <?php if (isset($_smarty_tpl->getVariable('NEW_ACCOUNTS_ACCOUNT_TYPE',null,true,false)->value)&&$_smarty_tpl->getVariable('NEW_ACCOUNTS_ACCOUNT_TYPE')->value=="Admin"){?> selected="selected"<?php }?>>Admin</option>
	</select>
</div> 

<div class="fieldRow"> 
	<label><h3>Moderate New Modules</h3><p>New modules require moderator approval to become public.</p></label>  
	<input type="checkbox" name="new_modules_require_moderation" 
	<?php if ($_smarty_tpl->getVariable('NEW_MODULES_REQUIRE_MODERATION')->value=="TRUE"){?> checked="checked"<?php }?> /> 
</div> 	

<div class="fieldrow">
	<label><h3>Show Versions</h3><p>Module Versions will be shown and can be made.</p></label>
	<input type="checkbox" name="enable_versions"
	<?php if ($_smarty_tpl->getVariable('ENABLE_VERSIONS')->value=="TRUE"){?> checked="checked"<?php }?> />
</div>

<input type="submit" class="button" value="Submit Information"> 

</form>

<p>Once you are pleased with your settings, please select which back-end you would like to use to support your EdRepo system.</p>

<form action="installmysql.php" method="post" class="tabular">
<div class="fieldRow"> 
	<label> Back-End to be used: </label> 
	<select name="backend_type">
		<option>MySQL (default)</option>
		<option>Custom</option>
	</select> 
</div> 

<input type="submit" class="button" value="Continue"> 

</form>

</div>


<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>