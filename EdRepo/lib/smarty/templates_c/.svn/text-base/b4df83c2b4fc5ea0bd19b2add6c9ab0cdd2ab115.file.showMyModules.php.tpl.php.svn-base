<?php /* Smarty version Smarty-3.0.7, created on 2014-07-21 13:44:04
         compiled from "E:\XAMPP\xampplite-win32-1.7.3\xampplite\htdocs\xampp\EdRepo\EdRepo\lib\smarty/templates/showMyModules.php.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1912053cd5164aefd00-44203569%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b4df83c2b4fc5ea0bd19b2add6c9ab0cdd2ab115' => 
    array (
      0 => 'E:\\XAMPP\\xampplite-win32-1.7.3\\xampplite\\htdocs\\xampp\\EdRepo\\EdRepo\\lib\\smarty/templates/showMyModules.php.tpl',
      1 => 1405964644,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1912053cd5164aefd00-44203569',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<div id="content">

<h1><?php echo $_smarty_tpl->getVariable('pageName')->value;?>
</h1>

<?php if ($_smarty_tpl->getVariable('loggedIn')->value!=true){?>
<h2>You Must Be Logged In To Continue</h2>
<p>You must be logged in to view this page.  You can do so at the <a href="loginLogout.php">log in page</a>.</p>

<?php }elseif($_smarty_tpl->getVariable('backendCapable')->value!=true){?>
<h2>This Feature Is Not Supported</h2>
<p>The backend in use does not support the "UseModules" and/or "SearchModulesByUserID" features which are required by this page.</p>

<?php }else{ ?>

<script type="text/javascript">

  $(document).ready(function() {
    
    // hide sortBy form's submit button. and auto submit on change
    $('#sortBy :submit').hide();
    $('#sortBy select').change(function() {
      $("#sortBy").submit();
    });
    
  });

</script>

<p>
  <a class="button" href="moduleWizard/index.php">Create New Module</a>
</p>

<form name="filter" action="showMyModules.php" method="get">
    <input type="hidden" readonly="readonly" name="action" value="filter"></input>
    By title: <input type="text" name="filterText" value="<?php echo (($tmp = @$_smarty_tpl->getVariable('filterText')->value)===null||$tmp==='' ? '' : $tmp);?>
" id="filterTextInput"></input>
    <input type="submit" class="button" name="submit" value="Filter"></input>
</form>

<form action="showMyModules.php" method="get" id="sortBy">
Sort by 
  <select name="sortBy">
    <option value="title"<?php if ($_smarty_tpl->getVariable('sortBy')->value=="title"){?> selected="selected"<?php }?>>Title</option>
    <option value="dateAsc"<?php if ($_smarty_tpl->getVariable('sortBy')->value=="dateAsc"){?> selected="selected"<?php }?>>Date: Oldest First</option>
    <option value="dateDesc"<?php if ($_smarty_tpl->getVariable('sortBy')->value=="dateDesc"){?> selected="selected"<?php }?>>Date: Newest First</option>
  </select>
  <input type="submit" class="button" value="Sort" />
  <br/>
</form>


<?php if ($_smarty_tpl->getVariable('action')->value!="show"){?>
  <form action="showMyModules.php" method="get"> 
  <input type="hidden" readonly="readonly" name="action" value="show"></input>
  <input type="submit" class="button" value="Show Older Modules" />
  </form>
<?php }?>
<?php if ($_smarty_tpl->getVariable('action')->value=="show"){?>
  <form action="showMyModules.php" method="get">
  <input type="hidden" readonly="readonly" name="action" value="hide"></input>
  <input type="submit" class="button" value="Hide Older Modules" />
  </form>
<?php }?>


<?php if (count($_smarty_tpl->getVariable('modules')->value)<=0){?>
    <?php if ($_smarty_tpl->getVariable('wasFiltered')->value==true){?>
    <p>No modules were found matching the specified filter.</p>
    <?php }else{ ?>
    <p>No modules currently belong to you.</p>
    <?php }?>
<?php }else{ ?> 

<table>
    <thead><tr>
        <th>ID</th>
        <th>Title</th>
        <?php if ($_smarty_tpl->getVariable('ENABLE_VERSIONS')->value==true){?><th>Version</th><?php }?>
        <th>Date Created</th>
        <th>Status</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr></thead><tbody>
    <?php  $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('modules')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['module']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['module']->key => $_smarty_tpl->tpl_vars['module']->value){
 $_smarty_tpl->tpl_vars['module']->index++;
?>
    <?php if ($_smarty_tpl->tpl_vars['module']->index>=$_smarty_tpl->getVariable('lowerLimit')->value&&$_smarty_tpl->tpl_vars['module']->index<$_smarty_tpl->getVariable('upperLimit')->value&&$_smarty_tpl->tpl_vars['module']->index<count($_smarty_tpl->getVariable('modules')->value)){?>
    <tr><td><?php echo $_smarty_tpl->tpl_vars['module']->value['moduleID'];?>
</td>
    <td><a href="viewModule.php?moduleID=<?php echo $_smarty_tpl->tpl_vars['module']->value['moduleID'];?>
&forceView=true"><?php echo $_smarty_tpl->tpl_vars['module']->value['title'];?>
</a></td>
    <?php if ($_smarty_tpl->getVariable('ENABLE_VERSIONS')->value==true){?><td><?php echo $_smarty_tpl->tpl_vars['module']->value['version'];?>
</td><?php }?>
    <td><?php echo $_smarty_tpl->tpl_vars['module']->value['dateTime'];?>
</td>
    <td><?php echo $_smarty_tpl->tpl_vars['module']->value['status'];?>
</td>
    <td>
        <a class="button" href="moduleWizard/index.php?moduleID=<?php echo $_smarty_tpl->tpl_vars['module']->value['moduleID'];?>
&moduleAction=edit">Edit</a>
        <?php if ($_smarty_tpl->getVariable('ENABLE_VERSIONS')->value==true){?>
        <a class="button" href="moduleWizard/index.php?moduleID=<?php echo $_smarty_tpl->tpl_vars['module']->value['moduleID'];?>
&moduleAction=createNewVersion">Create New Version</a>
        <?php }?>
    </td>
    <td>
        <a class="button" href="moduleWizard/delete.php?moduleID=<?php echo $_smarty_tpl->tpl_vars['module']->value['moduleID'];?>
&action=delete">Delete</a>
    </td></tr>
    <?php }?>
    <?php }} ?>
    </tbody>
</table>
<p>
  <?php if ($_smarty_tpl->getVariable('page')->value>1){?>
    <a href="showMyModules.php?action=<?php echo $_smarty_tpl->getVariable('action')->value;?>
&filterText=<?php echo (($tmp = @$_smarty_tpl->getVariable('filterText')->value)===null||$tmp==='' ? '' : $tmp);?>
&page=<?php echo $_smarty_tpl->getVariable('page')->value-1;?>
&recordsPerPage=<?php echo $_smarty_tpl->getVariable('recordsPerPage')->value;?>
">&lt; Previous Page</a>
  <?php }else{ ?>
    <a class="disabled">&lt; Previous Page</a>
  <?php }?>
  
    | Page <strong><?php echo $_smarty_tpl->getVariable('page')->value;?>
</strong> of <strong><?php echo $_smarty_tpl->getVariable('numPages')->value;?>
</strong> |
    
  <?php if (count($_smarty_tpl->getVariable('modules')->value)>($_smarty_tpl->getVariable('page')->value*$_smarty_tpl->getVariable('recordsPerPage')->value)){?>
    <a href="showMyModules.php?action=<?php echo $_smarty_tpl->getVariable('action')->value;?>
&filterText=<?php echo (($tmp = @$_smarty_tpl->getVariable('filterText')->value)===null||$tmp==='' ? '' : $tmp);?>
&page=<?php echo $_smarty_tpl->getVariable('page')->value+1;?>
&recordsPerPage=<?php echo $_smarty_tpl->getVariable('recordsPerPage')->value;?>
">Next Page &gt;</a>
  <?php }else{ ?>
    <a class="disabled">Next Page &gt;</a>
  <?php }?>
</p>

<?php }?> 

<?php if (($_smarty_tpl->getVariable('action')->value!="display"&&$_smarty_tpl->getVariable('action')->value!="filter")&&($_smarty_tpl->getVariable('action')->value!="show"&&$_smarty_tpl->getVariable('action')->value!="hide")){?>
<p><strong>Error.  An Unknown action was specified.</strong></p>
<?php }?> 

<?php }?> 

</div>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
