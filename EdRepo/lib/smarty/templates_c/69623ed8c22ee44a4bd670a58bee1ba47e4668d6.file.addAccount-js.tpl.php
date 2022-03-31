<?php /* Smarty version Smarty-3.0.7, created on 2017-01-13 11:40:51
         compiled from "/var/www/html/EdRepo/EdRepo/lib/smarty/templates/addAccount-js.tpl" */ ?>
<?php /*%%SmartyHeaderCode:180358286158790313e414f7-48583722%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '69623ed8c22ee44a4bd670a58bee1ba47e4668d6' => 
    array (
      0 => '/var/www/html/EdRepo/EdRepo/lib/smarty/templates/addAccount-js.tpl',
      1 => 1484321122,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '180358286158790313e414f7-48583722',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<script type="text/javascript">


var fieldCounter = new Array();
fieldCounter["Accounts"] = 0;

var limit = 10;
function add(field, value){
    var counter = fieldCounter[field];
    if (counter === limit)  {
        alert("You have reached the limit of adding " + counter + " inputs");
    }
    else {
        var parent = field + "List";
        var newDiv = document.createElement('div');
        newDiv.setAttribute("id", ""+field+"Div"+counter);
        newDiv.setAttribute("class", "fieldItem");
        switch (field)
        {
        case "Accounts":
            newDiv.innerHTML = '<button class="button" type="button"'
                + ' onclick="removeDIV(\''+field+'\', '+counter+')">X</button>'
                + '<br><p><label>Email: </label><input type="text" name="' + field + 'Email' + counter + '"'
				+ ' /></p>'
				+ '<p><label>First Name: </label><input type="text" name="' + field + 'FirstName' + counter + '"'
                + ' /></p>'
				+ '<p><label>Last Name: </label><input type="text" name="' + field + 'LastName' + counter + '"'
                + ' /></p>'
                + '<p><label>Password: </label><input type="password" name="' + field + 'Password' + counter + '"'
                + ' /></p>'
                + '<p><label>Type: </label><select name="' + field + 'Type' + counter + '">'
				+ printTypesFromDB()
                + ' </select></p>'
                + '<p><label>Group: </label><select name="' + field + 'Group' + counter + '">'
				+ printGroupsFromDB(); 
                + ' </select></p>';

            break;
        default:
            alert("Error: Don't know how to handle the field: " + field);
        }
        document.getElementById(parent).appendChild(newDiv);
        fieldCounter[field]++;
        
        var noModule = document.getElementById("noModule" + field);
        if (fieldCounter[field] > 0) {            
            noModule.value="false";
        } else {
            noModule.value="true"
        }
    }
}

function removeDIV(field, id){
    var parent = document.getElementById(field + "List");
    var child = document.getElementById("" + field + "Div" + id);
	if (parent != child) {
		parent.removeChild(child);
        var i;
        for (i=id+1; i < fieldCounter[field]; i++) {
            var child = document.getElementById("" + field + "Div" + i);
			var newID = i - 1;
            var newID = i; 
			child.setAttribute("id", "" + field + "Div" + newID );            
			if (field == "Accounts") {
                child.lastChild.setAttribute("name", "moduleCategory" + newID);
            } else {
                child.lastChild.setAttribute("name", "" + field + newID);
            }
            // set button's onclick action
            child.firstChild.setAttribute("onclick=", "remove(\''+field+'\', '+newID+')")			
        }
        
        fieldCounter[field]--;
        
        var noModule = document.getElementById("noModule" + field);
        if (fieldCounter[field] > 0) {            
            noModule.value="false";
        } else {
            noModule.value="true"
        }
    }
}

//This prints the types and groups from a default text file in options 
function printTypesFromDB(){
  var userType=new Array();
  var i;
  var r=""; //r will be what is returned.  It is a series of <option> tags.
  <?php  $_smarty_tpl->tpl_vars['types'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('userTypes')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['types']->key => $_smarty_tpl->tpl_vars['types']->value){
?>
  userType.push("<?php echo $_smarty_tpl->tpl_vars['types']->value;?>
");
  <?php }} ?>
  for(i=0; i<userType.length; i++) {
    r=r+"<option value=\""+userType[i]+"\">"+userType[i]+"</option>";
  }
  return r;
 }
function printGroupsFromDB(){
  var userGroups=new Array();
  var i;
  var r=""; //r will be what is returned.  It is a series of <option> tags.
  <?php  $_smarty_tpl->tpl_vars['groups'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('userGroups')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['groups']->key => $_smarty_tpl->tpl_vars['groups']->value){
?>
  userGroups.push("<?php echo $_smarty_tpl->tpl_vars['groups']->value;?>
");
  <?php }} ?>
  for(i=0; i<userGroups.length; i++) {
    r=r+"<option value=\""+userGroups[i]+"\">"+userGroups[i]+"</option>";
  }
  return r;
 }

function createBoxes(savedAccounts) {
  var i;
  //Create a box for savedAccounts
  for(i=0; i<savedAccounts.length; i++) {
    add("Accounts", savedAccounts[i]);
  }
}
 

    var savedAccounts=new Array();
    
    // initial fill array 
    <?php if ($_smarty_tpl->getVariable('section')->value=="Basics"){?>
        <?php if (isset($_smarty_tpl->getVariable('savedAuthors',null,true,false)->value)){?>
          <?php  $_smarty_tpl->tpl_vars['savedAuthor'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('savedAuthors')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['savedAuthor']->key => $_smarty_tpl->tpl_vars['savedAuthor']->value){
?>
              savedAuthors.push("<?php echo $_smarty_tpl->tpl_vars['savedAuthor']->value;?>
");
          <?php }} ?>
        <?php }elseif($_smarty_tpl->getVariable('moduleAction')->value=="create"){?>
          savedAuthors.push("<?php echo $_smarty_tpl->getVariable('user')->value['firstName'];?>
 <?php echo $_smarty_tpl->getVariable('user')->value['lastName'];?>
");
        <?php }?>
        <?php if (isset($_smarty_tpl->getVariable('saveAccounts',null,true,false)->value)){?>
          <?php  $_smarty_tpl->tpl_vars['saveAccount'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('saveAccounts')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['saveAccount']->key => $_smarty_tpl->tpl_vars['saveAccount']->value){
?>
              saveAccount.push("<?php echo $_smarty_tpl->tpl_vars['saveAccount']->value;?>
");
          <?php }} ?>
        <?php }?>
    <?php }?>
    
    
    $(document).ready(function() {
        createBoxes(saveAccounts);
        
        $('input:reset').click(function(){
          // erase all fields
          for (var field in fieldCounter) {
            if (fieldCounter[field] > 0) {
              var list = "#" + field + "List";
              $(list).html("");
              fieldCounter[field] = 0;
            }
          }
          // recreate boxes from saved fields
          createBoxes(saveAccounts);
          
          isDirty = false;
        });
        
        $('.fieldInput .button').click(function(){
          isDirty = true;
        });
    });
    	
</script>