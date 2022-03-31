<?php /* Smarty version Smarty-3.0.7, created on 2017-01-13 11:40:51
         compiled from "/var/www/html/EdRepo/EdRepo/lib/smarty/templates/installmysql.php.tpl" */ ?>
<?php /*%%SmartyHeaderCode:105298142158790313aa93d2-72240060%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '84babfe98769aec8d57d69953fc9f588bda7cbe1' => 
    array (
      0 => '/var/www/html/EdRepo/EdRepo/lib/smarty/templates/installmysql.php.tpl',
      1 => 1484321122,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '105298142158790313aa93d2-72240060',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<?php $_template = new Smarty_Internal_Template("addAccount-js.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>


<script type="text/javascript">

document.getElementById(""); 

</script>


<div id="content">

	<h1>Installing Edrepo's MySQL back-end</h1>

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

<?php if ($_smarty_tpl->getVariable('action')->value=='displayConnection'){?>

	<p>Please fill out the following to set up MySQL to support EdRepo</p>
  
	<form action="installmysql.php" method="post" class="tabular" >


	<input type="hidden" readonly="readonly" name="action" value="makeConnection"></input>

	<div class="fieldRow"> 
		<label> Host/Server Name: </label> 
		<input type="text" name="mysqlservername" value="" /> 
	</div> 

	<div class="fieldRow"> 
		<label> Username: </label> 
		<input type="text" name="mysqlusername" value="" /> 
	</div> 

	<div class="fieldRow"> 
		<label> Password: </label> 
		<input type="password" name="mysqlpass" value="" /> 
	</div> 

	<input type="submit" class="button" value="Submit"> 
	</form>
	
<?php }?>

<?php if ($_smarty_tpl->getVariable('action')->value=='makeConnection'){?>

	<form action="installmysql.php" method="post" class="tabular">
	
	<input type="hidden" readonly="readonly" name="action" value="installConnection"></input>

	<div class="fieldRow"> 
		<label>Database Name: </label> 
		<input type="text" name="edrepodatabasename" value="edrepo" /> 
	</div> 

	<input type="submit" class="button" value="Submit"> 
	</form>
	
<?php }?>

<?php if ($_smarty_tpl->getVariable('action')->value=='installConnection'||$_smarty_tpl->getVariable('action')->value=='addExtras'){?>

	<form action="installmysql.php" method="post" class="tabular">
		<input type="hidden" readonly="readonly" name="action" value="addExtra"></input>
		<input type="submit" class="button" value="Add Users / Install Types">
	</form>
	
	<h3>Or</h3>
	
	<form action="index.php" method="post" class="tabular">
		<input type="submit" class="button" value="Finish">
	</form>
	
<?php }?>

<?php if ($_smarty_tpl->getVariable('action')->value=='addExtra'){?>

	<form action="installmysql.php" method="post" class="tabular">
		
	<input type="hidden" readonly="readonly" name="action" value="addExtras"></input>
	
	<div class="fieldRow">
    
	<label><h3>Topics to Install:</h3></label><br>
	<input type="radio" value="*" checked="checked" name="type">All<br>
	<input type="radio" value="Select" name="type">Select Topics<br>
	<input type="radio" value="None" name="type">None<br>
	
	<label><h3>Add Accounts:</h3></label>
      <div class="fieldInput">
        <div id="AccountsList"></div>
        <a class="button" onclick="add('Accounts', 0);">Add Account</a>
      </div>
	  
    </div>
	
	<input type="submit" class="button" value="Submit">
	
  </form>
  
<?php }?>

<?php if ($_smarty_tpl->getVariable('action')->value=='Select'){?> 

<form action="installmysql.php" method="post" class="tabular">

	<input type="hidden" readonly="readonly" name="action" value="addExtras"></input>
	<input type="hidden" readonly="readonly" name="type" value="Selected"></input>
	
	<table border="1" width="auto">
	<tr>
	<?php  $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('typeArray')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['type']->key => $_smarty_tpl->tpl_vars['type']->value){
?>
		<?php if ($_smarty_tpl->getVariable('counter')->value%5==0){?>
			</tr>
			<tr>
			<td><input type="checkbox" name="types[]" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['type']->value;?>
</input></td>
		<?php }?>
		<?php if ($_smarty_tpl->getVariable('counter')->value%5!=0){?>
			<td><input type="checkbox" name="types[]" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['type']->value;?>
</input></td>
		<?php }?>
		<p hidden><?php echo $_smarty_tpl->getVariable('counter')->value++;?>
</p>
	<?php }} ?>
	</table>
	
	<input type="submit" class="button" value="Submit">
	
</form> 

<?php }?>	

</div>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>