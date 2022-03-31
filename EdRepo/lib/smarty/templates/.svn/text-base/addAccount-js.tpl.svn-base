{*****************************************************************************
    File:       addAccount-js.tpl
    Purpose:    Adds demos or admin accounts when installing EdRepo
                valued fields (Accounts.).
    Author:     Chris Macco
    Date:       15 September 2014
*****************************************************************************}

<script type="text/javascript">
{literal}

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
  {/literal}{foreach $userTypes as $types}{literal}
  userType.push({/literal}"{$types}"{literal});
  {/literal}{/foreach}{literal}
  for(i=0; i<userType.length; i++) {
    r=r+"<option value=\""+userType[i]+"\">"+userType[i]+"</option>";
  }
  return r;
 }
function printGroupsFromDB(){
  var userGroups=new Array();
  var i;
  var r=""; //r will be what is returned.  It is a series of <option> tags.
  {/literal}{foreach $userGroups as $groups}{literal}
  userGroups.push({/literal}"{$groups}"{literal});
  {/literal}{/foreach}{literal}
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
{/literal} 

    var savedAccounts=new Array();
    
    // initial fill array 
    {if $section == "Basics"}
        {if isset($savedAuthors)}
          {foreach $savedAuthors as $savedAuthor}
              savedAuthors.push("{$savedAuthor}");
          {/foreach}
        {elseif $moduleAction == "create"}
          savedAuthors.push("{$user.firstName} {$user.lastName}");
        {/if}
        {if isset($saveAccounts)}
          {foreach $saveAccounts as $saveAccount}
              saveAccount.push("{$saveAccount}");
          {/foreach}
        {/if}
    {/if}
    
    {literal}
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
    {/literal}	
</script>