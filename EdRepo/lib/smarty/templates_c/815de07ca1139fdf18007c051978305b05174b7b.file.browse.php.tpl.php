<?php /* Smarty version Smarty-3.0.7, created on 2017-01-13 12:11:56
         compiled from "/var/www/html/EdRepo/EdRepo/lib/smarty/templates/browse.php.tpl" */ ?>
<?php /*%%SmartyHeaderCode:192781839158790a5c2702a0-21281727%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '815de07ca1139fdf18007c051978305b05174b7b' => 
    array (
      0 => '/var/www/html/EdRepo/EdRepo/lib/smarty/templates/browse.php.tpl',
      1 => 1484321121,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '192781839158790a5c2702a0-21281727',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include '/var/www/html/EdRepo/EdRepo/lib/smarty/plugins/modifier.date_format.php';
?>

<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<script type="text/javascript">

  $(document).ready(function() {
    // add clear link that unchecks all checkboxes in 'clearable' fieldset
    $('fieldset.clearable').find('h3').html(function(index, oldhtml) {
      var clear = ' <span>(<a href="#" class="clear">clear</a>)</span>';
      return oldhtml + clear;
    });
    
    $('fieldset.clearable a.clear').click(function() {
      var fieldset = $(this).closest('fieldset.clearable');
      fieldset.find('input:checkbox').prop('checked', false);
    });
    
    
    // "Any" refers to the first checkbox in a list of checkboxes that "hasAny"
    // checking "Any" means any/all of the options in the list (i.e. no filter)
    // checking another option unchecks Any
    // checking Any unchecks all others and disables Any checkbox
    
    $('ul.checkboxes input:checkbox.any').each(function(){
      var input = $(this);
      var checked = input.prop("checked");
      // should be disabled if checked
      if (checked) {
        checkAny(input);
      }
    });
    
    $('ul.checkboxes.hasAny input:checkbox').change(function(){
      var input = $(this);
      var list = input.closest('ul.checkboxes');
      var checked = input.prop("checked");
           
      if ( input.hasClass("any") && checked ) {
        checkAny(input);        
      } else {
        
        var anyInput = list.find("input:checkbox.any");
        
        if (checked) {
          anyInput.prop("checked", false);
          anyInput.prop("disabled", false);
          // remove the hidden element added by checkAny
          list.find(".hiddenAny").remove();
        } else {
          // if no checkbox in this group is checked, check the any box
          var numberChecked = list.find(":checked").length;
          if (numberChecked == 0) {
            checkAny(anyInput);
          }
        }       
      }
    });
    
    /* checkAny - checks the any option in a list and unchecks all others
              @param input - jQuery object for the any checkbox input
         */
    function checkAny(input) {
      // get list of checkboxes
      var list = input.closest('ul.checkboxes');
      var value = input.prop('value');
      var name = input.prop('name');
      
      // uncheck all options
      list.find("input").each(function(i) {
        $(this).prop("checked", false);
      });
      
      input.prop("disabled", true);
      input.prop("checked", true);
      // add hidden duplicate of input because disabled elements aren't sent in request
      input.append('<input class="hiddenAny" type="hidden" name="'+name+'" value="'+value+'" />');
    }
    
    // hide sortBy form's submit button. and auto submit on change
    $('#sortBy :submit').hide();
    $('#sortBy select').change(function() {
      $("#sortBy").submit();
    });
    
  });
  

</script>

<div id="content">

<div id="panel">
  <form id="filters" method="post" action="browse.php">
    
    <fieldset>
      <h3>Search by module title</h3>
      <input type="text" name="moduleTitle" value="<?php echo (($tmp = @$_smarty_tpl->getVariable('filters')->value['title'])===null||$tmp==='' ? '' : $tmp);?>
" />
      <input class="button" type="submit" value="Search" />
    </fieldset>

    <fieldset class="clearable">
      <h3>General</h3>
      <ul class="checkboxes">
        <li><label><input type="checkbox" name="topLevel" value="*"<?php if (isset($_smarty_tpl->getVariable('filters',null,true,false)->value['topLevel'])&&$_smarty_tpl->getVariable('filters')->value['topLevel']){?> checked="checked"<?php }?>/> Show only top-level modules<!--You are passing filters and other filters everytime you call aoumtOfModules which isn't a good thing to do--><!--GET RID OF THE DOUBLE CALLS BY USING A VARIABLE--><?php  $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('filters')->value['topLevel']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['module']->key => $_smarty_tpl->tpl_vars['module']->value){
?><?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(amountOfModules("topLevel",$_smarty_tpl->tpl_vars['module']->value['ID'],$_smarty_tpl->getVariable('filters')->value), null, null);?><?php if ($_smarty_tpl->getVariable('count')->value>0){?>(<?php echo $_smarty_tpl->getVariable('count')->value;?>
) <?php }?><?php }} ?></label></li>
        <li><label><input type="checkbox" name="hasMaterial" value="*"<?php if (isset($_smarty_tpl->getVariable('filters',null,true,false)->value['hasMaterial'])&&$_smarty_tpl->getVariable('filters')->value['hasMaterial']){?> checked="checked"<?php }?>/> Show only modules with materials<?php  $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('filters')->value['hasMaterial']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['module']->key => $_smarty_tpl->tpl_vars['module']->value){
?><?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(amountOfModules("hasMaterial",$_smarty_tpl->tpl_vars['module']->value['ID'],$_smarty_tpl->getVariable('filters')->value), null, null);?><?php if ($_smarty_tpl->getVariable('count')->value>0){?>(<?php echo $_smarty_tpl->getVariable('count')->value;?>
) <?php }?><?php }} ?></label></li>
      </ul>
    </fieldset>      
    
  <?php if ($_smarty_tpl->getVariable('useCategories')->value=="true"){?>
    <fieldset>
      <h3>Category</h3>
      <ul class="checkboxes hasAny">
        <li><label><input class="any" type="checkbox" name="moduleCategory[]" value="*"<?php if (isset($_smarty_tpl->getVariable('filters',null,true,false)->value['category'])&&in_array("*",$_smarty_tpl->getVariable('filters')->value['category'])){?> checked="checked"<?php }?>/> Any<?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(amountOfModules("ALL",'','',''), null, null);?><?php if ($_smarty_tpl->getVariable('count')->value>0){?> (<?php echo $_smarty_tpl->getVariable('count')->value;?>
) <?php }?></label></li>
        <?php  $_smarty_tpl->tpl_vars['category'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('categories')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value){
?>
          <li><label><input type="checkbox" name="moduleCategory[]" value="<?php echo $_smarty_tpl->tpl_vars['category']->value['ID'];?>
"<?php if (isset($_smarty_tpl->getVariable('filters',null,true,false)->value['category'])&&in_array($_smarty_tpl->tpl_vars['category']->value['ID'],$_smarty_tpl->getVariable('filters')->value['category'])){?> checked="checked"<?php }?>> <?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
<?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(amountOfModules("category",$_smarty_tpl->tpl_vars['category']->value['ID'],$_smarty_tpl->getVariable('filters')->value), null, null);?><?php if ($_smarty_tpl->getVariable('count')->value>0){?>(<?php echo $_smarty_tpl->getVariable('count')->value;?>
) <?php }?></label></li>
        <?php }} ?>
      </ul>
    </fieldset>      
  <?php }?> 
    
  <?php if ($_smarty_tpl->getVariable('useTypes')->value=="true"){?>
    <fieldset>
      <h3>Type</h3>
      <ul class="checkboxes hasAny">
        <li><label><input class="any" type="checkbox" name="moduleType[]" value="*"<?php if (isset($_smarty_tpl->getVariable('filters',null,true,false)->value['type'])&&in_array("*",$_smarty_tpl->getVariable('filters')->value['type'])){?> checked="checked"<?php }?>/> Any<?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(amountOfModules("ALL",'','',''), null, null);?><?php if ($_smarty_tpl->getVariable('count')->value>0){?> (<?php echo $_smarty_tpl->getVariable('count')->value;?>
) <?php }?></label></li>
        <?php  $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('types')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['type']->key => $_smarty_tpl->tpl_vars['type']->value){
?>
          <li><label><input type="checkbox" name="moduleType[]" value="<?php echo $_smarty_tpl->tpl_vars['type']->value['ID'];?>
"<?php if (isset($_smarty_tpl->getVariable('filters',null,true,false)->value['type'])&&in_array($_smarty_tpl->tpl_vars['type']->value['ID'],$_smarty_tpl->getVariable('filters')->value['type'])){?> checked="checked"<?php }?>> <?php echo $_smarty_tpl->tpl_vars['type']->value['name'];?>
<?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(amountOfModules("type",$_smarty_tpl->tpl_vars['type']->value['ID'],$_smarty_tpl->getVariable('filters')->value), null, null);?> <?php if ($_smarty_tpl->getVariable('count')->value>0){?>(<?php echo $_smarty_tpl->getVariable('count')->value;?>
) <?php }?></label></li>
        <?php }} ?>
      </ul>
    </fieldset>      
  <?php }?> 
    
  <?php if ($_smarty_tpl->getVariable('adminOrEditor')->value){?>
    <fieldset>
      <h3>Status</h3>
      <ul class="checkboxes hasAny">
        <li><label><input class="any" type="checkbox" name="moduleStatus[]" value="*"<?php if (isset($_smarty_tpl->getVariable('filters',null,true,false)->value['status'])&&in_array("*",$_smarty_tpl->getVariable('filters')->value['status'])){?> checked="checked"<?php }?>/> Any<?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(amountOfModules("ALL",'','',''), null, null);?><?php if ($_smarty_tpl->getVariable('count')->value>0){?> (<?php echo $_smarty_tpl->getVariable('count')->value;?>
) <?php }?></label></li>
        <li><label><input type="checkbox" name="moduleStatus[]" value="Active"<?php if (isset($_smarty_tpl->getVariable('filters',null,true,false)->value['status'])&&in_array("Active",$_smarty_tpl->getVariable('filters')->value['status'])){?> checked="checked"<?php }?>> Active<?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(amountOfModules("status","Active",$_smarty_tpl->getVariable('filters')->value), null, null);?><?php if ($_smarty_tpl->getVariable('count')->value>0){?>(<?php echo $_smarty_tpl->getVariable('count')->value;?>
) <?php }?></label></li>
        <li><label><input type="checkbox" name="moduleStatus[]" value="InProgress"<?php if (isset($_smarty_tpl->getVariable('filters',null,true,false)->value['status'])&&in_array("InProgress",$_smarty_tpl->getVariable('filters')->value['status'])){?> checked="checked"<?php }?>> InProgress<?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(amountOfModules("status","InProgress",$_smarty_tpl->getVariable('filters')->value), null, null);?><?php if ($_smarty_tpl->getVariable('count')->value>0){?>(<?php echo $_smarty_tpl->getVariable('count')->value;?>
) <?php }?></label></li>
        <li><label><input type="checkbox" name="moduleStatus[]" value="PendingModeration"<?php if (isset($_smarty_tpl->getVariable('filters',null,true,false)->value['status'])&&in_array("PendingModeration",$_smarty_tpl->getVariable('filters')->value['status'])){?> checked="checked"<?php }?>> PendingModeration<?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(amountOfModules("status","PendingModeration",$_smarty_tpl->getVariable('filters')->value), null, null);?><?php if ($_smarty_tpl->getVariable('count')->value>0){?>(<?php echo $_smarty_tpl->getVariable('count')->value;?>
) <?php }?></label></li>
        <li><label><input type="checkbox" name="moduleStatus[]" value="Locked"<?php if (isset($_smarty_tpl->getVariable('filters',null,true,false)->value['status'])&&in_array("Locked",$_smarty_tpl->getVariable('filters')->value['status'])){?> checked="checked"<?php }?>> Locked<?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(amountOfModules("status","Locked",$_smarty_tpl->getVariable('filters')->value), null, null);?><?php if ($_smarty_tpl->getVariable('count')->value>0){?>(<?php echo $_smarty_tpl->getVariable('count')->value;?>
) <?php }?></label></li>
      </ul>
    </fieldset>      
  <?php }?> 
  
   <!--<?php if ($_smarty_tpl->getVariable('admin')->value){?> 		This will eventually show the restriction categories and display ones in that category
   <fieldset>
      <h3>Status</h3>
      <ul class="checkboxes hasAny">
        <li><label><input class="any" type="checkbox" name="moduleRestrictions[]" value="*"<?php if (isset($_smarty_tpl->getVariable('filters',null,true,false)->value['status'])&&in_array("*",$_smarty_tpl->getVariable('filters')->value['status'])){?> checked="checked"<?php }?>/> Any</label><label><?php if (amountOfModules('')>0){?> (<?php echo amountOfModules('');?>
) <?php }?></label></li>
      </ul>
	</fieldset>
	<?php }?>-->
  
  <fieldset>
    <input type="submit" class="button" value="Apply" />
    <input type="submit" class="button" name="clearFilters" value="Clear Filters" />
  </fieldset>
  
  </form>
</div>
<a id="collapse" title="Show/Hide Side Panel"></a>

<div id="page">

<h1><?php echo $_smarty_tpl->getVariable('pageName')->value;?>
</h1>

<?php if ($_smarty_tpl->getVariable('moduleError')->value=="true"){?> 
<p>This collection does not currently support browsing.</p>

<?php }else{ ?> 

<?php if ($_smarty_tpl->getVariable('numRecords')->value<=0){?>
<p>No modules were found.</p>

<?php }else{ ?> 

<p>Use the filters on the left to help find what you're looking for.</p>

<form action="browse.php" method="get" id="sortBy">
Sort by 
  <select name="sortBy">
    <option value="title"<?php if ($_smarty_tpl->getVariable('sortBy')->value=="title"){?> selected="selected"<?php }?>>Title</option>
    <option value="dateAsc"<?php if ($_smarty_tpl->getVariable('sortBy')->value=="dateAsc"){?> selected="selected"<?php }?>>Date: Oldest First</option>
    <option value="dateDesc"<?php if ($_smarty_tpl->getVariable('sortBy')->value=="dateDesc"){?> selected="selected"<?php }?>>Date: Newest First</option>
  </select>
  <input type="submit" class="button" value="Sort" />
</form>

<table>
    <thead><tr>
        <th>ID</th>
        <th>Title</th>
        <th>
          <img title="Has material" src="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
lib/look/<?php echo (($tmp = @$_smarty_tpl->getVariable('LOOK_DIR')->value)===null||$tmp==='' ? 'default' : $tmp);?>
/doc.png" />
        </th>
        <th>Submitter</th>
        <th>Date</th>
        <?php if ($_smarty_tpl->getVariable('useCategories')->value=="true"){?><th>Category</th><?php }?>        
        <?php if ($_smarty_tpl->getVariable('ENABLE_VERSIONS')->value==true){?><th>Version</th><?php }?>
        <?php if ($_smarty_tpl->getVariable('adminOrEditor')->value){?>
        <th>Status</th>
        <th>Edit</th>
        <th>Delete</th>
		<!--<?php if ($_smarty_tpl->getVariable('ENABLE_VERSIONS')->value==true){?><th>Create New Version</th><?php }?>-->
        <?php }?>
    </thead><tbody>
    
    <?php  $_smarty_tpl->tpl_vars['record'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('records')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['record']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['record']->key => $_smarty_tpl->tpl_vars['record']->value){
 $_smarty_tpl->tpl_vars['record']->index++;
?> 
    <?php if ($_smarty_tpl->tpl_vars['record']->index>=$_smarty_tpl->getVariable('lowerLimit')->value&&$_smarty_tpl->tpl_vars['record']->index<$_smarty_tpl->getVariable('upperLimit')->value&&$_smarty_tpl->tpl_vars['record']->index<$_smarty_tpl->getVariable('numRecords')->value){?>
    <tr>
        <td><?php echo $_smarty_tpl->tpl_vars['record']->value['moduleID'];?>
</td>
        <td><a href="viewModule.php?moduleID=<?php echo $_smarty_tpl->tpl_vars['record']->value['moduleID'];?>
"><?php echo $_smarty_tpl->tpl_vars['record']->value['title'];?>
</a></td>
        <td><?php if ($_smarty_tpl->tpl_vars['record']->value['hasMaterials']){?><img title="Has material" src="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
lib/look/<?php echo (($tmp = @$_smarty_tpl->getVariable('LOOK_DIR')->value)===null||$tmp==='' ? 'default' : $tmp);?>
/doc.png" /><?php }?></td>
        <td><?php echo $_smarty_tpl->tpl_vars['record']->value['authorFirstName'];?>
 <?php echo $_smarty_tpl->tpl_vars['record']->value['authorLastName'];?>
</td>
        <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['record']->value['dateTime']);?>
</td>
      <?php if ($_smarty_tpl->getVariable('useCategories')->value=="true"){?>
        <td>
        <?php echo $_smarty_tpl->getVariable('recordCategories')->value[$_smarty_tpl->tpl_vars['record']->index];?>

        </td>
      <?php }?>
      <?php if ($_smarty_tpl->getVariable('ENABLE_VERSIONS')->value==true){?><td><?php echo $_smarty_tpl->tpl_vars['record']->value['version'];?>
</td><?php }?>
      <?php if ($_smarty_tpl->getVariable('adminOrEditor')->value){?>
        <td><?php echo $_smarty_tpl->tpl_vars['record']->value['status'];?>
</td>
        <td>
            <a class="button" href="moduleWizard/index.php?moduleID=<?php echo $_smarty_tpl->tpl_vars['record']->value['moduleID'];?>
&moduleAction=edit">Edit</a>
        </td>
        <td>
            <a class="button" href="moduleWizard/delete.php?moduleID=<?php echo $_smarty_tpl->tpl_vars['record']->value['moduleID'];?>
&action=delete">Delete</a>
        </td>
		<!--<?php if ($_smarty_tpl->getVariable('ENABLE_VERSIONS')->value==true){?>
		<td>
            <a class="button" href="moduleWizard/index.php?moduleID=<?php echo $_smarty_tpl->tpl_vars['record']->value['moduleID'];?>
&moduleAction=createNewVersion">Create New Version</a>
		</td>
		<?php }?>-->
      <?php }?>        
    </tr>
    <?php }?>
    <?php }} ?>
</table>
<p>
  <?php if ($_smarty_tpl->getVariable('page')->value>1){?>
    <a href="browse.php?page=<?php echo $_smarty_tpl->getVariable('page')->value-1;?>
&recordsPerPage=<?php echo $_smarty_tpl->getVariable('recordsPerPage')->value;?>
">&lt; Previous Page</a>
  <?php }else{ ?>
    <a class="disabled">&lt; Previous Page</a>
  <?php }?>
  
    | Page <strong><?php echo $_smarty_tpl->getVariable('page')->value;?>
</strong> of <strong><?php echo $_smarty_tpl->getVariable('numPages')->value;?>
</strong> |
    
  <?php if ($_smarty_tpl->getVariable('numRecords')->value>($_smarty_tpl->getVariable('page')->value*$_smarty_tpl->getVariable('recordsPerPage')->value)){?>
    <a href="browse.php?page=<?php echo $_smarty_tpl->getVariable('page')->value+1;?>
&recordsPerPage=<?php echo $_smarty_tpl->getVariable('recordsPerPage')->value;?>
">Next Page &gt;</a>
  <?php }else{ ?>
    <a class="disabled">Next Page &gt;</a>
  <?php }?>
</p>

<?php }?> 

<?php }?> 

</div>

</div>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
