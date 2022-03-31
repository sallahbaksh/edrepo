<?php /* Smarty version Smarty-3.0.7, created on 2014-07-11 13:00:34
         compiled from "E:\XAMPP\xampplite-win32-1.7.3\xampplite\htdocs\xampp\EdRepo\EdRepo\lib\smarty/templates/moduleWizard/moduleWizard-js.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3054253c01832162f64-03741637%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2467dff973f60dc42926e7c45a91968e4ef8f543' => 
    array (
      0 => 'E:\\XAMPP\\xampplite-win32-1.7.3\\xampplite\\htdocs\\xampp\\EdRepo\\EdRepo\\lib\\smarty/templates/moduleWizard/moduleWizard-js.tpl',
      1 => 1405098028,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3054253c01832162f64-03741637',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<script type="text/javascript">


var fieldCounter = new Array();
fieldCounter["Authors"] = 0;
fieldCounter["Topics"] = 0;
fieldCounter["Objectives"] = 0;
fieldCounter["Prereqs"] = 0;
fieldCounter["Categories"] = 0;
fieldCounter["Types"] = 0;
fieldCounter["IRefs"] = 0;
fieldCounter["ERefs"] = 0;

var limit = 99;
function add(field, value){
    var counter = fieldCounter[field];
    if (counter === limit)  {
        alert("You have reached the limit of adding " + counter + " inputs");
    }
    else {
        var parent = field + "List";
        var newDiv = document.createElement('div');
        newDiv.setAttribute("id", "module"+field+"Div"+counter);
        newDiv.setAttribute("class", "fieldItem");
        switch (field)
        {
        case "Authors":
            newDiv.innerHTML = '<button class="button" type="button"'
                + ' onclick="remove(\''+field+'\', '+counter+')">X</button>'
                + '<input type="text" name="module' + field + counter + '"'
                + ' value="' + value + '" />';
            break;
        case "Categories":
            newDiv.innerHTML = '<button class="button" type="button"'
                + ' onclick="remove(\''+field+'\', '+counter+')">X</button>'
                + '<select name="moduleCategory' + counter + '">'
                + printCategorySelectInnerHTML(value) + '</select>';
            break;
        case "Types":
            newDiv.innerHTML = '<button class="button" type="button"'
                + ' onclick="remove(\''+field+'\', '+counter+')">X</button>'
                + '<select name="moduleType' + counter + '">'
                + printTypeSelectInnerHTML(value) + '</select>';
            break;
        case "IRefs":
        case "ERefs":  
            var val = value.split('$$$delim$$$');
            if (val.length != 2) {
                val[0] = "";
                val[1] = "";
            }
            var inner = '<button class="button" type="button"'
                + ' onclick="remove(\''+field+'\', '+counter+')">X</button>'
                + '<strong>Description of resource:</strong><br />'
                + '<textarea id="module' + field + 'textarea' + counter + '"'
                + ' name="module' + field + counter + '">' + val[0] + '</textarea><br />'
                + '<strong>';
            if (field == "IRefs") {
                inner += 'Search Module Title or ID of reference:';
            } else {
                inner += 'Citation for external reference:';
            }
            inner += '</strong><br />'
                + '<input id="module' + field + 'input' + counter + '" type="text"'
				+ '  onclick="autoComplete(\'#module'+field+'\input' +counter+'\')"'
				+ ' name="module' + field + 'Link' + counter + '" size="20" value="' + val[1] + '"/>';
			newDiv.innerHTML = inner;	
            break;
        case "Topics":
        case "Objectives":
        case "Prereqs":
             newDiv.innerHTML = '<button class="button" type="button"'
                + ' onclick="remove(\''+field+'\', '+counter+')">X</button>'
				+ '<textarea name="module' + field + counter + '">'
                + value + '</textarea>';
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

function remove(field, id){
    var parent = document.getElementById(field + "List");
    var child = document.getElementById("module" + field + "Div" + id);
	if (parent != child) {
		parent.removeChild(child);
        var i;
        for (i=id+1; i < fieldCounter[field]; i++) {
            var child = document.getElementById("module" + field + "Div" + i);
			var newID = i - 1;
            var newID = i; 
			child.setAttribute("id", "module" + field + "Div" + newID );            
			if (field == "Categories") {
                child.lastChild.setAttribute("name", "moduleCategory" + newID);
            } else if (field == "Types") {
                child.lastChild.setAttribute("name", "moduleType" + newID);
            } else if (field == "IRefs" || field == "ERefs") {
                var child_textarea = document.getElementById('module' + field + 'textarea' + i);
                var child_input = document.getElementById('module' + field + 'input' + i);
                child_textarea.setAttribute("id", 'module' + field + 'textarea' + newID);
                child_textarea.setAttribute("name", 'module' + field + newID);
                child_input.setAttribute("id", 'module' + field + 'input' + newID);
                child_input.setAttribute("name", 'module' + field + 'Link' + newID);
            } else {
                child.lastChild.setAttribute("name", "module" + field + newID);
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


function createBoxes(savedAuthors, savedObjectives, savedTopics, savedPrereqs, savedCategoriesIDs, savedIRefs, savedERefs) {
  var i;
  //Create a box for all saved authors
  for(i=0; i<savedAuthors.length; i++) {
    add("Authors", savedAuthors[i]);
  }
  //Create a box for all saved objectives
  for(i=0; i<savedObjectives.length; i++) {
    add("Objectives", savedObjectives[i]);
  }
  //Create a box for all saved topics
  for(i=0; i<savedTopics.length; i++) {
    add("Topics", savedTopics[i]);
  }
  //Create a box for all saved prereqs
  for(i=0; i<savedPrereqs.length; i++) {
    add("Prereqs", savedPrereqs[i]);
  }
  //Create a box for all saved categories
  for(i=0; i<savedCategoriesIDs.length; i++) {
    add("Categories", savedCategoriesIDs[i]);
  }
  //Create a box for all saved types
  for(i=0; i<savedTypesIDs.length; i++) {
    add("Types", savedTypesIDs[i]);
  }
  //Create a box for all saved internal references
  for(i=0; i<savedIRefs.length; i++) {
    add("IRefs", savedIRefs[i]);
  }
  //Create a box for all saved external references
  for(i=0; i<savedERefs.length; i++) {
    add("ERefs", savedERefs[i]);
  }
}
    
    

// function from original EdRepo, adapted for Smarty by Jon Thompson
function printCategorySelectInnerHTML(preSelectedID) {
  var tempIDs=new Array();
  var tempNames=new Array();
  var i;
  var r=""; //r will be what is returned.  It is a series of <option> tags.
  <?php  $_smarty_tpl->tpl_vars['category'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('allCategories')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value){
?>
    tempIDs.push("<?php echo $_smarty_tpl->tpl_vars['category']->value['ID'];?>
");
    tempNames.push("<?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
");
  <?php }} ?>
  
  for(i=0; i<tempIDs.length; i++) {
    if(preSelectedID===tempIDs[i]) {
      r=r+"<option value=\""+tempIDs[i]+"\" selected=\"selected\">"+tempNames[i]+"</option>";
    } else {
      r=r+"<option value=\""+tempIDs[i]+"\">"+tempNames[i]+"</option>";
    }
  }
  return r;
}
function printTypeSelectInnerHTML(preSelectedID) {
  var tempIDs=new Array();
  var tempNames=new Array();
  var i;
  var r=""; //r will be what is returned.  It is a series of <option> tags.
  <?php  $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('allTypes')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['type']->key => $_smarty_tpl->tpl_vars['type']->value){
?>
    tempIDs.push("<?php echo $_smarty_tpl->tpl_vars['type']->value['ID'];?>
");
    tempNames.push("<?php echo $_smarty_tpl->tpl_vars['type']->value['name'];?>
");
  <?php }} ?>
  
  for(i=0; i<tempIDs.length; i++) {
    if(preSelectedID===tempIDs[i]) {
      r=r+"<option value=\""+tempIDs[i]+"\" selected=\"selected\">"+tempNames[i]+"</option>";
    } else {
      r=r+"<option value=\""+tempIDs[i]+"\">"+tempNames[i]+"</option>";
    }
  }
  return r;
}

    var savedAuthors=new Array();
    var savedTopics=new Array();
    var savedObjectives=new Array();
    var savedPrereqs=new Array();
    var savedCategoriesIDs=new Array();
    var savedTypesIDs=new Array();
    var savedIRefs=new Array();
    var savedERefs=new Array();
    
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
        <?php if (isset($_smarty_tpl->getVariable('savedObjectives',null,true,false)->value)){?>
          <?php  $_smarty_tpl->tpl_vars['savedObjective'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('savedObjectives')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['savedObjective']->key => $_smarty_tpl->tpl_vars['savedObjective']->value){
?>
              savedObjectives.push("<?php echo $_smarty_tpl->tpl_vars['savedObjective']->value;?>
");
          <?php }} ?>
        <?php }?>
        <?php if (isset($_smarty_tpl->getVariable('savedTopics',null,true,false)->value)){?>
          <?php  $_smarty_tpl->tpl_vars['savedTopic'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('savedTopics')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['savedTopic']->key => $_smarty_tpl->tpl_vars['savedTopic']->value){
?>
              savedTopics.push("<?php echo $_smarty_tpl->tpl_vars['savedTopic']->value;?>
");
          <?php }} ?>
        <?php }?>
        <?php if (isset($_smarty_tpl->getVariable('savedPrereqs',null,true,false)->value)){?>
          <?php  $_smarty_tpl->tpl_vars['savedPrereq'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('savedPrereqs')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['savedPrereq']->key => $_smarty_tpl->tpl_vars['savedPrereq']->value){
?>
              savedPrereqs.push("<?php echo $_smarty_tpl->tpl_vars['savedPrereq']->value;?>
");
          <?php }} ?>
        <?php }?>
        <?php if (isset($_smarty_tpl->getVariable('savedCategories',null,true,false)->value)){?>
          <?php  $_smarty_tpl->tpl_vars['savedCategory'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('savedCategories')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['savedCategory']->key => $_smarty_tpl->tpl_vars['savedCategory']->value){
?>
              savedCategoriesIDs.push("<?php echo $_smarty_tpl->tpl_vars['savedCategory']->value;?>
");
          <?php }} ?>
        <?php }?>
        <?php if (isset($_smarty_tpl->getVariable('savedTypes',null,true,false)->value)){?>
          <?php  $_smarty_tpl->tpl_vars['savedType'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('savedTypes')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['savedType']->key => $_smarty_tpl->tpl_vars['savedType']->value){
?>
              savedTypesIDs.push("<?php echo $_smarty_tpl->tpl_vars['savedType']->value;?>
");
          <?php }} ?>
        <?php }?>
    <?php }elseif($_smarty_tpl->getVariable('section')->value=="References"){?>
        <?php  $_smarty_tpl->tpl_vars['savedIRef'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('savedIRefs')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['savedIRef']->key => $_smarty_tpl->tpl_vars['savedIRef']->value){
?>
            savedIRefs.push("<?php echo $_smarty_tpl->tpl_vars['savedIRef']->value;?>
");
        <?php }} ?>
        <?php  $_smarty_tpl->tpl_vars['savedERef'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('savedERefs')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['savedERef']->key => $_smarty_tpl->tpl_vars['savedERef']->value){
?>
            savedERefs.push("<?php echo $_smarty_tpl->tpl_vars['savedERef']->value;?>
");
        <?php }} ?>
    <?php }?>
    
    
    $(document).ready(function() {
        createBoxes(savedAuthors, savedObjectives, savedTopics, savedPrereqs, savedCategoriesIDs, savedIRefs, savedERefs);
        
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
          createBoxes(savedAuthors, savedObjectives, savedTopics, savedPrereqs, savedCategoriesIDs, savedIRefs, savedERefs);
          
          isDirty = false;
        });
        
        $('.fieldInput .button').click(function(){
          isDirty = true;
        });
    });
    	
</script>