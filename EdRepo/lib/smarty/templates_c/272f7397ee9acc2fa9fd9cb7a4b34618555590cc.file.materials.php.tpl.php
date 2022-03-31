<?php /* Smarty version Smarty-3.0.7, created on 2014-07-14 15:22:53
         compiled from "E:\XAMPP\xampplite-win32-1.7.3\xampplite\htdocs\xampp\EdRepo\EdRepo\lib\smarty/templates/moduleWizard/materials.php.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3246453c42e0d27f339-56487133%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '272f7397ee9acc2fa9fd9cb7a4b34618555590cc' => 
    array (
      0 => 'E:\\XAMPP\\xampplite-win32-1.7.3\\xampplite\\htdocs\\xampp\\EdRepo\\EdRepo\\lib\\smarty/templates/moduleWizard/materials.php.tpl',
      1 => 1405365734,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3246453c42e0d27f339-56487133',
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
<?php if ($_smarty_tpl->getVariable('action')->value!="deleteMaterial"&&$_smarty_tpl->getVariable('action')->value!="doDeleteMaterial"&&$_smarty_tpl->getVariable('action')->value!="renameMaterial"&&$_smarty_tpl->getVariable('action')->value!="doRenameMaterial"){?>
<script type="text/javascript">
    var materialType = "LocalFile"; // default
    var action = "<?php echo $_smarty_tpl->getVariable('action')->value;?>
";
    var materialLink = "<?php echo (($tmp = @$_smarty_tpl->getVariable('materialInfo')->value['linkToMaterial'])===null||$tmp==='' ? '' : $tmp);?>
";
    var materialName = "<?php echo (($tmp = @$_smarty_tpl->getVariable('materialInfo')->value['readableFileName'])===null||$tmp==='' ? '' : $tmp);?>
";
    
    // showProperInput replaces setProperMaterialSourceInput from original EdRepo - Jon Thompson
    function showProperInput()
    {
      var value = $('#materialType').val();
      
      $("#materialFile").hide();
      $("#materialURL").hide();
      
      if (value == "LocalFile") {
        $("#materialFile").show();
      } else if (value == "ExternalURL") {
        $("#materialURL").show();
      } else {
        $("#materialFile").show();
      }
    }
    
    $(document).ready(function() {
        showProperInput();
    });
    
</script>
    
<div id="materialForms">
<h2>Attach New Material</h2>
<form enctype="multipart/form-data" method="post" action="materials.php" class="narrow">
    <input type="hidden" name="action" value="addMaterial" />
    <input type="hidden" name="moduleID" value="<?php echo $_smarty_tpl->getVariable('moduleInfo')->value['moduleID'];?>
" />
    
    <div class="fieldRow">
        <label>
            <strong>Type:</strong>
        </label>
        <select id="materialType" onchange="showProperInput();" name="materialType">
            <option<?php if ((isset($_smarty_tpl->getVariable('materialInfo',null,true,false)->value['type'])&&$_smarty_tpl->getVariable('materialInfo')->value['type']=="LocalFile")||isset($_smarty_tpl->getVariable('materialInfo',null,true,false)->value['type'])==false){?> selected="selected"<?php }?> value="LocalFile">Upload File</option>
            <option<?php if (isset($_smarty_tpl->getVariable('materialInfo',null,true,false)->value['type'])&&$_smarty_tpl->getVariable('materialInfo')->value['type']=="ExternalURL"){?> selected="selected"<?php }?> value="ExternalURL">Internet URL</option>
        </select>
    </div>
    <div class="fieldRow" id="nameRow">
        <label>
            <strong>Name:</strong>
        </label>
        <input id="materialName" type="text" name="materialName" value="<?php echo (($tmp = @$_smarty_tpl->getVariable('materialInfo')->value['name'])===null||$tmp==='' ? '' : $tmp);?>
">
    </div>
    <div class="fieldRow">
        <label>
            <strong>Content:</strong>
        </label>
        <input id="materialFile" type="file" name="materialFile" />
        <input id="materialURL" type="text" name="materialURL" value="http://" />
    </div>
    
    <fieldset class="buttons">
      <input class="button" id="submit" type="submit" value="Add Material" name="submit">
    </fieldset>
</form>
<br />
<br />
<h2>Attach Existing Module</h2>
<p>Use this form to attach an <strong><u>existing</u></strong> module to this module as a "child."</p>
<form method="post" action="materials.php" class="narrow">
    <input type="hidden" name="action" value="addChild" />
    <input type="hidden" name="moduleID" value="<?php echo $_smarty_tpl->getVariable('moduleInfo')->value['moduleID'];?>
" />
    <div class="fieldRow">
        <label>
            <strong>Module</strong>
        </label>
        <select id="newChild" name="newChild">
        <?php  $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('modules')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['module']->key => $_smarty_tpl->tpl_vars['module']->value){
?>
          <option value=<?php echo $_smarty_tpl->tpl_vars['module']->value["moduleID"];?>
><?php echo $_smarty_tpl->tpl_vars['module']->value["title"];?>
 --- ID:<?php echo $_smarty_tpl->tpl_vars['module']->value["moduleID"];?>
</option>                
        <?php }} ?>
        </select>
    </div>
    
    <fieldset class="buttons">
      <input class="button" id="submit" type="submit" value="Attach Module" name="submit">
    </fieldset>
</form>
<br />
<br />

<h2>Attach A New Quick Module</h2>
<p>Use this form to attach a <strong><u>new</u></strong> module to this module as a "child."</p>
<form method="post" action="materials.php" class="narrow">
    <input type="hidden" name="action" value="addNewChild" />
    <input type="hidden" name="moduleID" value="<?php echo $_smarty_tpl->getVariable('moduleInfo')->value['moduleID'];?>
" />
    <div class="fieldRow">
        <label>
            <strong>Title:</strong>
        </label>
		<input id="moduleName" type="text" name="moduleName" />
		</br>
		<label>
			<strong>Description:</strong>
		</label>
		<textArea id="moduleDescription" name="moduleDescription" style="width: 50%;"></textArea>
    </div>
    
    <fieldset class="buttons">
      <input class="button" id="submit" type="submit" value="Attach New Module" name="submit">
    </fieldset>
</form>
<br />
<br />



<!-- Here is the rich text editor but the JavaScript files will not work, works with /lib/look/richTextEditor.js  AND  lib/jscolor/jscolor.js

<div id="richText" onload="iFrameOn();">
<h2>Input Rich Text</h2>
<p>Use this to input rich text as a material.</p>
<form action="materials.php" name = "myform" value = "myform" method="post" class="narrow">
<script type="text/javascript" src="../lib/look/richTextEditor.js"></script>
<p>Entry Body:<br>
<div id="textEdit" style="padding: 8pxl width: 500px;">
	<input type="button" onClick="Bold()" value="Bold">
	<input type="button" onClick="Underline()" value="Underline">
	<input type="button" onClick="Italics()" value="Italics">
	<select id ="size" onChange="JavaScript:Size();" >
		<option value = "1">8</option>
		<option value = "2">10</option>
		<option selected="selected" value = "3">12</option>
		<option value = "4">16</option>
		<option value = "5">18</option>
		<option value = "6">24</option>
		<option value = "7">32</option>
	</select>
	<script type="text/javascript" src="..lib/jscolor/jscolor.js"></script>
	<input type="button" class="color" onChange="JavaScript:Color();" id="color">
	<input type="button" onClick="Link()" value="Link">
	<input type="button" onClick="Unlink()" value="Unlink">
</div>
<textarea style="display:none;" name="textArea" id="textArea" col="200" rows="14"></textarea>
<iframe name="richTextArea" id="richTextArea" width="700px" height="300px"></iframe>
</p>
<input name="submit" type="button" value="Add Text" onClick="JavaScript:submitForm();"/>
</form>
</div>
-->

</div>

<div id="materialList">
<?php if (count($_smarty_tpl->getVariable('materials')->value)>0){?>
<h2>Materials</h2>
<table>
    <thead><th>Title</th><th>Type</th><th></th></thead>
    <tbody>
    <?php  $_smarty_tpl->tpl_vars['material'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('materials')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['material']->key => $_smarty_tpl->tpl_vars['material']->value){
?>
    <tr>
        <td><a href="../viewMaterial.php?materialID=<?php echo $_smarty_tpl->tpl_vars['material']->value['materialID'];?>
"><?php echo $_smarty_tpl->tpl_vars['material']->value['name'];?>
</a></td>
        <td>
        <?php if ($_smarty_tpl->tpl_vars['material']->value['type']=="LocalFile"){?>
          <?php echo $_smarty_tpl->tpl_vars['material']->value['format'];?>

        <?php }elseif($_smarty_tpl->tpl_vars['material']->value['type']=="ExternalURL"){?>
          URL
        <?php }else{ ?>
          <?php echo $_smarty_tpl->tpl_vars['material']->value['type'];?>

        <?php }?>
        </td>
		<td>
			<a class="button" href="materials.php?action=renameMaterial&moduleID=<?php echo $_smarty_tpl->getVariable('moduleInfo')->value['moduleID'];?>
&materialID=<?php echo $_smarty_tpl->tpl_vars['material']->value['materialID'];?>
">Rename</a>
		</td>
        <td>
            <a class="button" href="materials.php?action=deleteMaterial&moduleID=<?php echo $_smarty_tpl->getVariable('moduleInfo')->value['moduleID'];?>
&materialID=<?php echo $_smarty_tpl->tpl_vars['material']->value['materialID'];?>
">Delete</a>
        </td>
    </tr>
    <?php }} ?>
    </tbody>
</table>
<?php }?>

<?php if (count($_smarty_tpl->getVariable('moduleChildren')->value)>0){?>
<h2>Attached Modules</h2>
<table>
    <thead><th>Title</th><th></th></thead>
    <tbody>
    <?php  $_smarty_tpl->tpl_vars['moduleChild'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('moduleChildren')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['moduleChild']->key => $_smarty_tpl->tpl_vars['moduleChild']->value){
?> 
      <tr>
        <td><a href="../viewModule.php?moduleID=<?php echo $_smarty_tpl->tpl_vars['moduleChild']->value['moduleID'];?>
"><?php echo $_smarty_tpl->tpl_vars['moduleChild']->value['title'];?>
</a></td>
        <td>
          <a class="button" href="materials.php?action=removeChild&moduleID=<?php echo $_smarty_tpl->getVariable('moduleInfo')->value['moduleID'];?>
&childID=<?php echo $_smarty_tpl->tpl_vars['moduleChild']->value['moduleID'];?>
">Remove</a>
        </td>
      </tr>
    <?php }} ?>
    </tbody>
</table>
<?php }?>

</div>
<?php }elseif($_smarty_tpl->getVariable('action')->value=="deleteMaterial"||$_smarty_tpl->getVariable('action')->value=="doDeleteMaterial"){?>
<p>You are about to delete the material <strong><?php echo $_smarty_tpl->getVariable('materialInfo')->value['name'];?>
</strong>. Are you sure you want to <strong>permanently delete</strong> this material?</p>

<p>
    <a class="button" href="materials.php?action=doDeleteMaterial&moduleID=<?php echo $_smarty_tpl->getVariable('moduleInfo')->value['moduleID'];?>
&materialID=<?php echo $_smarty_tpl->getVariable('materialInfo')->value['materialID'];?>
">Delete</a> | 
    <a class="button" href="materials.php?moduleID=<?php echo $_smarty_tpl->getVariable('moduleInfo')->value['moduleID'];?>
">Cancel</a>
</p>

<?php }elseif($_smarty_tpl->getVariable('action')->value=="renameMaterial"||$_smarty_tpl->getVariable('action')->value=="doRenameMaterial"){?>
<p>You are renaming <strong><?php echo $_smarty_tpl->getVariable('materialInfo')->value['name'];?>
</strong>.</p>

<p>
	<form action="materials.php?action=doRenameMaterial&moduleID=<?php echo $_smarty_tpl->getVariable('moduleInfo')->value['moduleID'];?>
&materialID=<?php echo $_smarty_tpl->getVariable('materialInfo')->value['materialID'];?>
" method="POST">
	<input type="text" name="renameMaterial"><br><br>
	<input type="submit" name="rename" value = "Rename"> | 
	<a class="button" href="materials.php?moduleID=<?php echo $_smarty_tpl->getVariable('moduleInfo')->value['moduleID'];?>
">Cancel</a>
	</form>
</p>

<?php }?> 
</div>

</div>
<?php }?> 

</div>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>