<?php /* Smarty version Smarty-3.0.7, created on 2014-07-01 11:08:15
         compiled from "E:\XAMPP\xampplite-win32-1.7.3\xampplite\htdocs\xampp\EdRepo\EdRepo\lib\smarty/templates/moderate.php.tpl" */ ?>
<?php /*%%SmartyHeaderCode:716053b2cedf3ba540-55830112%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '737d71b326af2ed14ad7d9219a1adfddbc29f75c' => 
    array (
      0 => 'E:\\XAMPP\\xampplite-win32-1.7.3\\xampplite\\htdocs\\xampp\\EdRepo\\EdRepo\\lib\\smarty/templates/moderate.php.tpl',
      1 => 1404227294,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '716053b2cedf3ba540-55830112',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<div id="content">


<script type="text/javascript">
  $(document).ready(function() {
  
    // check/uncheck all checkboxes when .checkAll is clicked
    $('.checkAll').click(function() {
      var checked_status = this.checked;
      $('[type=checkbox]').each( function() {
        $(this).attr('checked', checked_status) 
      } );
    });
    
    // uncheck checkAll if one of the others is unchecked
    $('[type=checkbox]').click(function() {
      if (!this.checked) {
        $('.checkAll').attr('checked', false);
      }
    });
    
  });
</script>


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

<?php if ($_smarty_tpl->getVariable('error')->value=="notLoggedIn"){?>
<h2>You Must Be Logged In To Continue</h2>
<p>You must be logged in to view this page.  You can do so at the <a href="loginLogout.php">log in page</a>.</p>

<?php }elseif($_smarty_tpl->getVariable('error')->value=="backendSupport"){?>
<h2>This Feature Is Not Supported</h2>
<p>The backend in use does not support the "UseModules" and/or "SearchModulesByUserID" features which are required by this page.</p>

<?php }elseif($_smarty_tpl->getVariable('error')->value=="priveleges"){?>
<h2>Insufficient Privileges To Perform This Action</h2>
<p>You do not have enough privileges to moderate modules.
Please log into an account with sufficient privileges to perform this action.</p>

<?php }else{ ?> 

<?php if ($_smarty_tpl->getVariable('action')->value=="display"||$_smarty_tpl->getVariable('action')->value=="Approve"||$_smarty_tpl->getVariable('action')->value=="Deny"||$_smarty_tpl->getVariable('action')->value=="ApproveFamily"||$_smarty_tpl->getVariable('action')->value=="ApproveFamilySelected"||$_smarty_tpl->getVariable('action')->value=="ApproveSelected"||$_smarty_tpl->getVariable('action')->value=="DenySelected"){?>
    
<p><a class="button" href="moduleManagement.php">Manage Active Modules</a></p>

<form name="filter" action="moderate.php" method="get">
    <input type="hidden" readonly="readonly" name="action" value="filter"></input>
    By title: <input type="text" name="filterText" value="<?php echo (($tmp = @$_smarty_tpl->getVariable('filterText')->value)===null||$tmp==='' ? '' : $tmp);?>
" id="filterTextInput"></input>
    <input type="submit" class="button" name="submit" value="Filter"></input>
</form>

<?php if (count($_smarty_tpl->getVariable('modules')->value)<=0){?>
    <?php if ($_smarty_tpl->getVariable('wasFiltered')->value==true){?>
    <p>No modules pending moderation were found matching the specified filter.</p>
    <?php }else{ ?>
    <p>There are currently no modules pending moderation.</p>
    <?php }?>
<?php }else{ ?> 
<form method="get" action="moderate.php" style="border: 0; padding: 0;">
<table class="sortable moduleInformationView">
    <thead>
        <tr>
        <th class="sorttable_nosort">
          <input type="checkbox" name="checkAll" value="checkAll" class="checkAll" />
        </th>
        <th>ID</th>
        <th>Title</th>
        <th>Author</th>
        <?php if ($_smarty_tpl->getVariable('ENABLE_VERSIONS')->value==true){?><th>Version</th><?php }?>
        <th>Date Created</th>
         
        <th class="sorttable_nosort">Action</th>
        </tr>
    </thead>
    <tbody>
     <?php  $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('modules')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['module']->key => $_smarty_tpl->tpl_vars['module']->value){
?>
        <tr>
        <td><input type="checkbox" name="moduleIDs[]" value="<?php echo $_smarty_tpl->tpl_vars['module']->value['moduleID'];?>
" /></td>
        <td><?php echo $_smarty_tpl->tpl_vars['module']->value['moduleID'];?>
</td>
        <td><a href="viewModule.php?moduleID=<?php echo $_smarty_tpl->tpl_vars['module']->value['moduleID'];?>
&forceView=true"><?php echo $_smarty_tpl->tpl_vars['module']->value['title'];?>
</a></td>
        <td><?php echo $_smarty_tpl->tpl_vars['module']->value['authorFirstName'];?>
 <?php echo $_smarty_tpl->tpl_vars['module']->value['authorLastName'];?>
</td>
        <?php if ($_smarty_tpl->getVariable('ENABLE_VERSIONS')->value==true){?><td><?php echo $_smarty_tpl->tpl_vars['module']->value['version'];?>
</td><?php }?>
        <td><?php echo $_smarty_tpl->tpl_vars['module']->value['dateTime'];?>
</td>
        <td>
            <a class="button" href="moderate.php?moduleID=<?php echo $_smarty_tpl->tpl_vars['module']->value['moduleID'];?>
&action=Approve">Approve</a> | 
            <a class="button" href="moderate.php?moduleID=<?php echo $_smarty_tpl->tpl_vars['module']->value['moduleID'];?>
&action=Deny">Deny</a> 
			<?php if (references($_smarty_tpl->tpl_vars['module']->value['moduleID'])!=false){?>
			 | <a class="button" href="moderate.php?moduleID=<?php echo $_smarty_tpl->tpl_vars['module']->value['moduleID'];?>
&action=ApproveFamily">Approve Family</a>
			<?php }?>
        </td>
        </tr>
      <?php }} ?>
    </tbody>
</table>
<p>
  <input class="button" type="submit" name="approveSelected" value="Approve Selected" />
  <input class="button" type="submit" name="denySelected" value="Deny Selected" />
  <!--<input class="button" type="submit" name="approveFamilySelected" value="Approve Family Selected" />-->
</p>
</form>
<?php }?> 

<?php }else{ ?>
<p><strong>Error.  An Unknown action was specified.</strong></p>

<?php }?> 

<?php }?> 


</div>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>