<?php /* Smarty version Smarty-3.0.7, created on 2014-06-18 15:45:39
         compiled from "E:\XAMPP\xampplite-win32-1.7.3\xampplite\htdocs\xampp\EdRepo\EdRepo\lib\smarty/templates/configureHierarchy.php.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1290353a1ec63def490-89987993%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c8b743ed77cfc96ab2bcb2a3fb0c56bcbc256797' => 
    array (
      0 => 'E:\\XAMPP\\xampplite-win32-1.7.3\\xampplite\\htdocs\\xampp\\EdRepo\\EdRepo\\lib\\smarty/templates/configureHierarchy.php.tpl',
      1 => 1352331700,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1290353a1ec63def490-89987993',
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


<p>Use this page to set which active modules will be part of the repository hierarchy on the homepage.</p>


<div class="hierarchyConfig">
<form name="changeSettings" action="configureHierarchy.php" method="post">
  <input type="hidden" name="action" value="changeSettings" />
  <fieldset>
    <legend>Settings</legend>
    <table>
    <tr>
        <td><label for="repositoryTreeName"><strong>Hierarchy Name:</strong></label></td>
        <td><input type="text" name="repositoryTreeName" value="<?php echo $_smarty_tpl->getVariable('REPOSITORY_TREE_NAME')->value;?>
" /></td>
    </tr>
    <tr>
        <td><label for="showTree"><strong>Show hierarchy tree on home page:</strong></label></td>
        <td><input type="checkbox" id="navTree" name="navTree"<?php if ($_smarty_tpl->getVariable('SHOW_REPOSITORY_TREE')->value==true){?> checked="checked"<?php }?> /></td>
    </tr>
    <tr>
        <td><label for="repositoryTreeName"><strong>Number of levels to open initially:</strong></label></td>
        <td>
          <select id="navTreeLevels" name="navTreeLevels" value="<?php echo $_smarty_tpl->getVariable('REPOSITORY_TREE_LEVELS')->value;?>
">
          <?php unset($_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['name'] = 'navLevels';
$_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['start'] = (int)0;
$_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['loop'] = is_array($_loop=5) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['step'] = ((int)1) == 0 ? 1 : (int)1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['loop'];
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['navLevels']['total']);
?>
            <?php $_smarty_tpl->tpl_vars["i"] = new Smarty_variable($_smarty_tpl->getVariable('smarty')->value['section']['navLevels']['index'], null, null);?>
            <option value="<?php echo $_smarty_tpl->getVariable('i')->value;?>
"<?php if ($_smarty_tpl->getVariable('REPOSITORY_TREE_LEVELS')->value==$_smarty_tpl->getVariable('i')->value){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('i')->value;?>
</option>
          <?php endfor; endif; ?>
          </select>
        </td>
    </tr>
    <tr>
      <td></td>
      <td><input type="submit" class="button" name="sub" value="Save"></input>
      <input type="reset" class="button" value="Reset" /></td>
    </tr>
    </table>
  </fieldset>
</form>

<form method="post" action="configureHierarchy.php">
  <fieldset>
    <legend>Add Module to Hierarchy</legend>
    <input type="hidden" name="action" value="addModule" />
    <div class="fieldRow">
        <label>
            <strong>Module</strong>
        </label>
        <select id="moduleID" name="moduleID">
        <?php  $_smarty_tpl->tpl_vars['eligibleModule'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('eligibleModules')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['eligibleModule']->key => $_smarty_tpl->tpl_vars['eligibleModule']->value){
?>
          <option value=<?php echo $_smarty_tpl->tpl_vars['eligibleModule']->value["moduleID"];?>
><?php echo $_smarty_tpl->tpl_vars['eligibleModule']->value["title"];?>
</option>                
        <?php }} ?>
        </select>
    </div>
    
    <fieldset class="buttons">
      <input class="button" id="submit" type="submit" value="Add Module" name="submit">
    </fieldset>
  </fieldset>
</form>
</div>

<div class="hierarchyModules">
<h2>Modules in Hierarchy</h2>
<?php if (isset($_smarty_tpl->getVariable('hierarchyModules',null,true,false)->value)&&count($_smarty_tpl->getVariable('hierarchyModules')->value)>0){?>
<table>
    <thead><th>Title</th><th></th></thead>
    <tbody>
    <?php  $_smarty_tpl->tpl_vars['hierarchyModule'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('hierarchyModules')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['hierarchyModule']->key => $_smarty_tpl->tpl_vars['hierarchyModule']->value){
?> 
      <tr>
        <td><a href="../viewModule.php?moduleID=<?php echo $_smarty_tpl->tpl_vars['hierarchyModule']->value['moduleID'];?>
"><?php echo $_smarty_tpl->tpl_vars['hierarchyModule']->value['title'];?>
</a></td>
        <td>
          <a class="button" href="configureHierarchy.php?action=removeModule&moduleID=<?php echo $_smarty_tpl->tpl_vars['hierarchyModule']->value['moduleID'];?>
">Remove</a>
        </td>
      </tr>
    <?php }} ?>
    </tbody>
</table>
<?php }else{ ?>
No modules have been put in the hierarchy.
<?php }?>
</div>


<?php }?> 

</div>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
