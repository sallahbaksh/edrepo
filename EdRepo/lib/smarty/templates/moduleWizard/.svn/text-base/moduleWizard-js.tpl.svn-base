{*****************************************************************************
    File:       moduleWizard-js.tpl
    Purpose:    Defines the JavaScript for the module wizard, enabling multi-
                valued fields (e.g. Authors, Topics, Types, etc.).
    Author:     Jon Thompson
    Date:       27 March 2012
*****************************************************************************}

<script type="text/javascript">
{literal}

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
                + ' onclick="removeDIV(\''+field+'\', '+counter+')">X</button>'
                + '<input type="text" name="module' + field + counter + '"'
                + ' value="' + value + '" />';
            break;
        case "Categories":
            newDiv.innerHTML = '<button class="button" type="button"'
                + ' onclick="removeDIV(\''+field+'\', '+counter+')">X</button>'
                + '<select name="moduleCategory' + counter + '">'
                + printCategorySelectInnerHTML(value) + '</select>';
            break;
        case "Types":
            newDiv.innerHTML = '<button class="button" type="button"'
                + ' onclick="removeDIV(\''+field+'\', '+counter+')">X</button>'
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
                //+ ' onclick="removeDIV(\''+field+'\', '+counter+')">X</button>'
                + ' onclick="if(confirm(\'Are you sure you want to remove this module?\')){removeDIV(\''+field+'\', '+counter+');}">X</button>'
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
				+ '  onfocus="autoComplete(\'#module'+field+'\input' +counter+'\')"'
				+ ' name="module' + field + 'Link' + counter + '" size="20" value="' + val[1] + '"/>';
			newDiv.innerHTML = inner;	
            break;
        case "Topics":
        case "Objectives":
        case "Prereqs":
             newDiv.innerHTML = '<button class="button" type="button"'
                  + ' onclick="removeDIV(\''+field+'\', '+counter+')">X</button>'
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

function removeDIV(field, id){

    var searchValue = document.getElementById("module"+field+"input"+id); 

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
      
      //remove the Refs and figure out how to ties these togther as in removing with js and removing through mysql
      var key = searchValue.value; 

      if (field == "IRefs")
      {
        var irefInput = document.getElementById("delIRefModules"); 
        var irefValue = irefInput.value; 
        
        if (irefValue == ""){
          //alert(key); 
          irefInput.setAttribute("value", key);
        }
        else{
          //alert(irefValue + "&" + key); 
          irefInput.setAttribute("value", irefValue + "&" + key);
        }
      }
      else
      {
        var erefInput = document.getElementById("delERefModules"); 
        var erefValue = erefInput.value; 
        
        if (erefValue == ""){
          //alert(key); 
          erefInput.setAttribute("value", key);
        }
        else{
          //alert(erefValue + "&" + key); 
          erefInput.setAttribute("value", erefValue + "&" + key);
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
    
{/literal}    

// function from original EdRepo, adapted for Smarty by Jon Thompson
function printCategorySelectInnerHTML(preSelectedID) {literal}{{/literal}
  var tempIDs=new Array();
  var tempNames=new Array();
  var i;
  var r=""; //r will be what is returned.  It is a series of <option> tags.
  {foreach $allCategories as $category}
    tempIDs.push("{$category.ID}");
    tempNames.push("{$category.name}");
  {/foreach}
  {literal}
  for(i=0; i<tempIDs.length; i++) {
    if(preSelectedID===tempIDs[i]) {
      r=r+"<option value=\""+tempIDs[i]+"\" selected=\"selected\">"+tempNames[i]+"</option>";
    } else {
      r=r+"<option value=\""+tempIDs[i]+"\">"+tempNames[i]+"</option>";
    }
  }
  return r;
}{/literal}
function printTypeSelectInnerHTML(preSelectedID) {literal}{{/literal}
  var tempIDs=new Array();
  var tempNames=new Array();
  var i;
  var r=""; //r will be what is returned.  It is a series of <option> tags.
  {foreach $allTypes as $type}
    tempIDs.push("{$type.ID}");
    tempNames.push("{$type.name}");
  {/foreach}
  {literal}
  for(i=0; i<tempIDs.length; i++) {
    if(preSelectedID===tempIDs[i]) {
      r=r+"<option value=\""+tempIDs[i]+"\" selected=\"selected\">"+tempNames[i]+"</option>";
    } else {
      r=r+"<option value=\""+tempIDs[i]+"\">"+tempNames[i]+"</option>";
    }
  }
  return r;
}{/literal}

    var savedAuthors=new Array();
    var savedTopics=new Array();
    var savedObjectives=new Array();
    var savedPrereqs=new Array();
    var savedCategoriesIDs=new Array();
    var savedTypesIDs=new Array();
    var savedIRefs=new Array();
    var savedERefs=new Array();
    
    // initial fill array 
    {if $section == "Basics"}
        {if isset($savedAuthors)}
          {foreach $savedAuthors as $savedAuthor}
              savedAuthors.push("{$savedAuthor}");
          {/foreach}
        {elseif $moduleAction == "create"}
          savedAuthors.push("{$user.firstName} {$user.lastName}");
        {/if}
        {if isset($savedObjectives)}
          {foreach $savedObjectives as $savedObjective}
              savedObjectives.push("{$savedObjective}");
          {/foreach}
        {/if}
        {if isset($savedTopics)}
          {foreach $savedTopics as $savedTopic}
              savedTopics.push("{$savedTopic}");
          {/foreach}
        {/if}
        {if isset($savedPrereqs)}
          {foreach $savedPrereqs as $savedPrereq}
              savedPrereqs.push("{$savedPrereq}");
          {/foreach}
        {/if}
        {if isset($savedCategories)}
          {foreach $savedCategories as $savedCategory}
              savedCategoriesIDs.push("{$savedCategory}");
          {/foreach}
        {/if}
        {if isset($savedTypes)}
          {foreach $savedTypes as $savedType}
              savedTypesIDs.push("{$savedType}");
          {/foreach}
        {/if}
    {elseif $section == "References"}
        {foreach $savedIRefs as $savedIRef}
            savedIRefs.push("{$savedIRef}");
        {/foreach}
        {foreach $savedERefs as $savedERef}
            savedERefs.push("{$savedERef}");
        {/foreach}
    {/if}
    
    {literal}
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
    {/literal}	
</script>