<?php /* Smarty version Smarty-3.0.7, created on 2017-01-13 12:13:04
         compiled from "/var/www/html/EdRepo/EdRepo/lib/smarty/templates/moduleWizard/misc.php.tpl" */ ?>
<?php /*%%SmartyHeaderCode:31938323758790aa010fe13-15229458%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '634138bcdb272e57c4f2f0a3255728cdbee439a6' => 
    array (
      0 => '/var/www/html/EdRepo/EdRepo/lib/smarty/templates/moduleWizard/misc.php.tpl',
      1 => 1484321121,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31938323758790aa010fe13-15229458',
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

<?php if ($_smarty_tpl->getVariable('hasPermission')->value==true&&$_smarty_tpl->getVariable('action')->value!="error"){?>

<div id="wizard">
<?php $_template = new Smarty_Internal_Template("moduleWizard/wizardNav.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<script type="text/javascript" src="../lib/jquery/check-changes.js"></script>

<div id="wizard-form">
  <form method="post" class="tabular" action="misc.php">  
    <input type="hidden" readonly="readonly" name="moduleID" value="<?php echo (($tmp = @$_smarty_tpl->getVariable('moduleInfo')->value['moduleID'])===null||$tmp==='' ? '' : $tmp);?>
"></input>
    <div class="fieldRow">
        <label>
            <h3>Minimum User Level To View Module</h3>
            <p>Specifies the minimum level a user must be to view your module. The lowest level is "No Restrictions", which will allow everyone, including unregistered users, to view your module. Other possible values coorespond to privilege levels of registered users. It is reccomended you set this as low as possible, to prevent unintended blocking of your module. In addition, please note that everyone can search for and see basic information about your module (such as title, author, etc). Restricting access here will only prevent restricted users from viewing details about your module or the module's materials.</p>
        </label>
        
        <div class="fieldInput">
            <select name="moduleMinimumUserType">
                <option<?php if ((isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['minimumUserType'])&&$_smarty_tpl->getVariable('moduleInfo')->value['minimumUserType']=="Unregistered")||isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['minimumUserType'])==false){?> selected="selected"<?php }?> value="Unregistered">Unregistered Users (do not restrict access to anyone) [Reccomended]</option>
                <option<?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['minimumUserType'])&&$_smarty_tpl->getVariable('moduleInfo')->value['minimumUserType']=="Viewer"){?> selected="selected"<?php }?> value="Viewer">Viewers or higher</option>
                <option<?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['minimumUserType'])&&$_smarty_tpl->getVariable('moduleInfo')->value['minimumUserType']=="SuperViewer"){?> selected="selected"<?php }?> value="SuperViewer">SuperViewers or higher</option>
                <option<?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['minimumUserType'])&&$_smarty_tpl->getVariable('moduleInfo')->value['minimumUserType']=="Submitter"){?> selected="selected"<?php }?> value="Submitter">Submitters or higher</option>
                <option<?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['minimumUserType'])&&$_smarty_tpl->getVariable('moduleInfo')->value['minimumUserType']=="Editor"){?> selected="selected"<?php }?> value="Editor">Editors or higher</option>
                <option<?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['minimumUserType'])&&$_smarty_tpl->getVariable('moduleInfo')->value['minimumUserType']=="Admin"){?> selected="selected"<?php }?> value="Admin">Administrators Only</option>
            </select>
        </div>
    </div>
    
    <div class="fieldRow">
        <label>
            <h3>Comments</h3>
            <p>Comments about this module. These comments are viewable by anyone who can view details about this module.</p>
        </label>
        
        <div class="fieldInput">
            <textarea name="moduleAuthorComments"><?php echo (($tmp = @$_smarty_tpl->getVariable('moduleInfo')->value['authorComments'])===null||$tmp==='' ? '' : $tmp);?>
</textarea>
        </div>
    </div>
    
    <fieldset class="buttons">
      <input type="submit" name="submit" class="button" value="Save Module" />
      <input type="reset" class="button" value="Reset" />
    </fieldset>
  </form>
</div>

</div>
<?php }?> 

</div>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>