<?php /* Smarty version Smarty-3.0.7, created on 2014-07-18 11:51:51
         compiled from "E:\XAMPP\xampplite-win32-1.7.3\xampplite\htdocs\xampp\EdRepo\EdRepo\lib\smarty/templates/installmysql.php.tpl" */ ?>
<?php /*%%SmartyHeaderCode:44953c942971f8645-74564975%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a715a7a56b5987d2a6b664a7bff999ca35ccf836' => 
    array (
      0 => 'E:\\XAMPP\\xampplite-win32-1.7.3\\xampplite\\htdocs\\xampp\\EdRepo\\EdRepo\\lib\\smarty/templates/installmysql.php.tpl',
      1 => 1337897780,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '44953c942971f8645-74564975',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

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
		<label> Server Name: </label> 
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
		<input type="text" name="edrepodatabasename" value="" /> 
	</div> 

	<input type="submit" class="button" value="Submit"> 
	</form>
	
<?php }?>

<?php if ($_smarty_tpl->getVariable('action')->value=='installConnection'){?>

	<form action="index.php" method="post" class="tabular">
	
	<input type="submit" class="button" value="Finish">
	
  </form>
<?php }?>

</div>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>