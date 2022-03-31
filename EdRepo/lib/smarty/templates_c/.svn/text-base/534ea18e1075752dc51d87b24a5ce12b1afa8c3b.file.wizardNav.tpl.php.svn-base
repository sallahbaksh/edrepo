<?php /* Smarty version Smarty-3.0.7, created on 2014-06-18 15:33:39
         compiled from "E:\XAMPP\xampplite-win32-1.7.3\xampplite\htdocs\xampp\EdRepo\EdRepo\lib\smarty/templates/moduleWizard/wizardNav.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3210453a1e993e87115-48044369%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '534ea18e1075752dc51d87b24a5ce12b1afa8c3b' => 
    array (
      0 => 'E:\\XAMPP\\xampplite-win32-1.7.3\\xampplite\\htdocs\\xampp\\EdRepo\\EdRepo\\lib\\smarty/templates/moduleWizard/wizardNav.tpl',
      1 => 1352331700,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3210453a1e993e87115-48044369',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>



    <div id="wizard-nav">
        <ul class="tabs">
          <li<?php if ($_smarty_tpl->getVariable('section')->value=="Basics"){?> class="active"<?php }?>><a href="index.php<?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value)){?>?moduleAction=edit&moduleID=<?php echo $_smarty_tpl->getVariable('moduleInfo')->value['moduleID'];?>
<?php }?>">Basic Info</a></li>
          <li<?php if ($_smarty_tpl->getVariable('section')->value=="Materials"){?> class="active"<?php }?>><a href="materials.php<?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value)){?>?moduleID=<?php echo $_smarty_tpl->getVariable('moduleInfo')->value['moduleID'];?>
<?php }?>">Materials</a></li>
          <li<?php if ($_smarty_tpl->getVariable('section')->value=="References"){?> class="active"<?php }?>><a href="references.php<?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value)){?>?moduleID=<?php echo $_smarty_tpl->getVariable('moduleInfo')->value['moduleID'];?>
<?php }?>">References</a></li>
          <li<?php if ($_smarty_tpl->getVariable('section')->value=="Misc"){?> class="active"<?php }?>><a href="misc.php<?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value)){?>?moduleID=<?php echo $_smarty_tpl->getVariable('moduleInfo')->value['moduleID'];?>
<?php }?>">Misc</a></li>
        </ul>
        <ul>
          <?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['status'])&&$_smarty_tpl->getVariable('moduleInfo')->value['status']=="InProgress"){?>
          <li><a class="button" href="submit.php?moduleID=<?php echo $_smarty_tpl->getVariable('moduleInfo')->value['moduleID'];?>
">Submit Module</a></li>
          <?php }?>
          <?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value)&&(!isset($_smarty_tpl->getVariable('moduleAction',null,true,false)->value)||$_smarty_tpl->getVariable('moduleAction')->value!="create"&&$_smarty_tpl->getVariable('moduleAction')->value!="createNewVersion")){?>
          <li><a class="button" href="delete.php?action=delete&moduleID=<?php echo $_smarty_tpl->getVariable('moduleInfo')->value['moduleID'];?>
">Delete Module</a></li>
          <?php }?>
          <li><a class="button" href="../showMyModules.php">Exit</a></li>
        </ul>
    </div>
    