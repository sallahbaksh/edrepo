<?php /* Smarty version Smarty-3.0.7, created on 2014-06-26 11:45:25
         compiled from "E:\XAMPP\xampplite-win32-1.7.3\xampplite\htdocs\xampp\EdRepo\EdRepo\lib\smarty/templates/configureCategories.php.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1946653ac4014f27f02-02119303%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd79a59f8143281772f797443150d25157627cd4e' => 
    array (
      0 => 'E:\\XAMPP\\xampplite-win32-1.7.3\\xampplite\\htdocs\\xampp\\EdRepo\\EdRepo\\lib\\smarty/templates/configureCategories.php.tpl',
      1 => 1403797518,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1946653ac4014f27f02-02119303',
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

<?php if ($_smarty_tpl->getVariable('useCategories')->value=="false"){?>
<p><strong>This Feature Is Not Supported.</strong>
The back-end storage system currently running on this collection does not support using categories in read and/or write mode. 
You can not manage categories using this configuration panel.</p>

<?php }else{ ?>

<p>This configuration panel allows you to view, add, and remove categories from this collection. 
Categories are used to organize modules.</p>

<?php if ($_smarty_tpl->getVariable('categoryAction')->value!="edit"){?>
<div class="subblock">
    <h2>Add A New Category</h2>
    <p>To add a new category, enter a title and a short description for the new category and select "Add".</p>
    
    <form name="addCategoryForm" action="configureCategories.php" method="post">
        <fieldset><input type="hidden" readonly="readonly" name="categoryAction" value="doAdd"></input>
        <div class="fieldRow">
            <label for="categoryName"><strong>Category Name:</strong></label>
            <input type="text" name="categoryName"></input>
        </div>
        <div class="fieldRow">
            <label for="categoryDescription"><strong>Description:</strong></label>
            <input type="text" name="categoryDescription"></input>
        </div></fieldset>
        <fieldset class="buttons"><input type="submit" class="button" name="sub" value="Add"></input></fieldset>
    </form>
</div>
<?php }?>

<?php if ($_smarty_tpl->getVariable('categoryAction')->value=="edit"){?> 
<div>
    <h2>Edit Category</h2>
    <p>To edit the category, replace a title and a short description for the  category and select "Update".</p>
    
    <form name="editCategoryForm" action="configureCategories.php?action=doEdit&categoryID=<?php echo $_smarty_tpl->getVariable('categoryID')->value;?>
" method="post">
        <fieldset><input type="hidden" readonly="readonly" name="categoryAction" value="doEdit"></input>
        <div class="fieldRow">
            <label for="categoryName"><strong>Category Name:</strong></label>
            <input type="text" name="editCategoryName" value="<?php echo (($tmp = @$_smarty_tpl->getVariable('categoryInfo')->value['name'])===null||$tmp==='' ? '' : $tmp);?>
"></input>
        </div>
        <div class="fieldRow">
            <label for="categoryDescription"><strong>Description:</strong></label>
            <input type="text" name="editCategoryDescription" value="<?php echo (($tmp = @$_smarty_tpl->getVariable('categoryInfo')->value['description'])===null||$tmp==='' ? '' : $tmp);?>
"></input>
        </div></fieldset>
        <fieldset class="buttons"><input type="submit" class="button" name="doedit" value="Update"></input></fieldset>
    </form>
</div>
<?php }?>

<h2>Current categories in this collection:</h2>

<?php if ($_smarty_tpl->getVariable('noCategories')->value=="true"){?>
<p><strong>This collection currently contains no categories.</strong>
To add a category, use the "Add Category" box at the top of this page.</p>

<?php }else{ ?> 


<table>
    <thead><tr class="highlight"><th>Category Name</th><th>Description</th><th>Edit</th><th>Remove</th></tr></thead>
    <?php  $_smarty_tpl->tpl_vars['category'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('categories')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value){
?>
        <tr><td><strong><?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
</strong></td><td><?php echo $_smarty_tpl->tpl_vars['category']->value['description'];?>
</td>
		<td><a class="button" href="configureCategories.php?categoryAction=edit&categoryID=<?php echo $_smarty_tpl->tpl_vars['category']->value['ID'];?>
">Edit</a></td>
        <td><a class="button" href="configureCategories.php?categoryAction=doRemove&categoryID=<?php echo $_smarty_tpl->tpl_vars['category']->value['ID'];?>
">Remove</a></td></tr>
    <?php }} ?>
</table>

<?php }?>

<?php }?>  


<?php }?> 

</div>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>