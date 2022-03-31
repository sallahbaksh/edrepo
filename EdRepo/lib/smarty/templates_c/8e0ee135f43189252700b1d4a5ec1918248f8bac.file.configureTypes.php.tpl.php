<?php /* Smarty version Smarty-3.0.7, created on 2014-06-18 15:45:56
         compiled from "E:\XAMPP\xampplite-win32-1.7.3\xampplite\htdocs\xampp\EdRepo\EdRepo\lib\smarty/templates/configureTypes.php.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3180753a1ec74c1d618-47697498%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8e0ee135f43189252700b1d4a5ec1918248f8bac' => 
    array (
      0 => 'E:\\XAMPP\\xampplite-win32-1.7.3\\xampplite\\htdocs\\xampp\\EdRepo\\EdRepo\\lib\\smarty/templates/configureTypes.php.tpl',
      1 => 1337897780,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3180753a1ec74c1d618-47697498',
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

<?php if ($_smarty_tpl->getVariable('loggedIn')->value!="true"){?>
<p>Sorry, you must be logged in as an admin to access this page.</p>

<?php }elseif($_smarty_tpl->getVariable('user')->value['type']!="Admin"){?>
<p>Sorry, you must be an admin to access this page.</p>

<?php }else{ ?>

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

<?php if ($_smarty_tpl->getVariable('useTypes')->value=="false"){?>
<p><strong>This Feature Is Not Supported.</strong>
The back-end storage system currently running on this collection does not support using types in read and/or write mode. 
You can not manage catagories using this configuration panel.</p>

<?php }else{ ?>

<p>This configuration panel allows you to view, add, and remove types from this collection. 
Types are used to describe modules. 
EdRepo comes preloaded with a subset of the <a href="http://nsdl.org/contribute/type">NSDL's controlled vocabulary for type</a>. 
Though it is recommended that you use NSDL terms if you plan on exporting your module metadata, feel free to add or remove types that make sense for this collection.</p>

<div class="subblock">
    <h2>Add A New Type</h2>
    <p>To add a new type, enter a title for the new type and select "Add".</p>
    
    <form name="addTypeForm" action="configureTypes.php" method="post">
        <fieldset><input type="hidden" readonly="readonly" name="action" value="doAdd"></input>
        <div class="fieldRow">
            <label for="typeName"><strong>Type Name:</strong></label>
            <input type="text" name="typeName"></input>
        </div></fieldset>
        <fieldset class="buttons"><input type="submit" class="button" name="sub" value="Add"></input></fieldset>
    </form>
</div>

<h2>Current types in this collection:</h2>

<?php if ($_smarty_tpl->getVariable('noTypes')->value=="true"){?>
<p><strong>This collection currently contains no types.</strong>
To add a type, use the "Add Type" box at the top of this page.</p>

<?php }else{ ?> 


<table>
    <thead><tr class="highlight"><th>Type Name</th><th>Remove</th></tr></thead>
    <?php  $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('types')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['type']->key => $_smarty_tpl->tpl_vars['type']->value){
?>
        <tr><td><strong><?php echo $_smarty_tpl->tpl_vars['type']->value['name'];?>
</strong></td>
        <td><a class="button" href="configureTypes.php?action=doRemove&typeID=<?php echo $_smarty_tpl->tpl_vars['type']->value['ID'];?>
">Remove</a></td></tr>
    <?php }} ?>
</table>

<?php }?>

<?php }?>  


<?php }?> 

</div>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
