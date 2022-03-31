<?php /* Smarty version Smarty-3.0.7, created on 2014-06-18 15:35:39
         compiled from "E:\XAMPP\xampplite-win32-1.7.3\xampplite\htdocs\xampp\EdRepo\EdRepo\lib\smarty/templates/moduleManagement.php.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3035853a1ea0b498011-34357709%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '79ec9869a8b030b6839f8c6eb182f187a97fe336' => 
    array (
      0 => 'E:\\XAMPP\\xampplite-win32-1.7.3\\xampplite\\htdocs\\xampp\\EdRepo\\EdRepo\\lib\\smarty/templates/moduleManagement.php.tpl',
      1 => 1362598366,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3035853a1ea0b498011-34357709',
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

<form name="filter" action="moduleManagement.php" method="get">
    <input type="hidden" readonly="readonly" name="action" value="filter"></input>
    By title: <input type="text" name="filterText" value="<?php echo (($tmp = @$_smarty_tpl->getVariable('filterText')->value)===null||$tmp==='' ? '' : $tmp);?>
" id="filterTextInput"></input>
    <input type="submit" class="button" name="submit" value="Filter"></input>
</form>

<?php if (count($_smarty_tpl->getVariable('modules')->value)<=0){?>
    <?php if ($_smarty_tpl->getVariable('wasFiltered')->value==true){?>
    <p>No modules were found matching the specified filter.</p>
    <?php }else{ ?>
    <p>There are currently no active modules in this collection.</p>
    <?php }?>
<?php }else{ ?> 

<table class="sortable">
    <thead><tr>
        <th>ID</th>
        <th>Title</th>
        <th>Version</th>
        <th>Date Created</th>
        <th>Status</th>
        <th class="sorttable_nosort">Edit</th>
        <th class="sorttable_nosort">Delete</th>
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
    <td><?php echo $_smarty_tpl->tpl_vars['module']->value['version'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['module']->value['dateTime'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['module']->value['status'];?>
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
    <a href="moduleManagement.php?action=<?php echo $_smarty_tpl->getVariable('action')->value;?>
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
    <a href="moduleManagement.php?action=<?php echo $_smarty_tpl->getVariable('action')->value;?>
&filterText=<?php echo (($tmp = @$_smarty_tpl->getVariable('filterText')->value)===null||$tmp==='' ? '' : $tmp);?>
&page=<?php echo $_smarty_tpl->getVariable('page')->value+1;?>
&recordsPerPage=<?php echo $_smarty_tpl->getVariable('recordsPerPage')->value;?>
">Next Page &gt;</a>
  <?php }else{ ?>
    <a class="disabled">Next Page &gt;</a>
  <?php }?>
</p>

<?php }?> 

<?php if ($_smarty_tpl->getVariable('action')->value!="display"&&$_smarty_tpl->getVariable('action')->value!="filter"){?>
<p><strong>Error.  An Unknown action was specified.</strong></p>
<?php }?> 

<?php }?> 

</div>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
