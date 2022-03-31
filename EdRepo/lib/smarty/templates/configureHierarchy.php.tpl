{*****************************************************************************
    File:       configureHierarchy.php.tpl
    Purpose:    Smarty template for EdRepo's "Configure Collection Hierarchy" page
    Author:     Jon Thompson
    Date:       27 Oct 2012
*****************************************************************************}

{include file="header.tpl"}

<div id="content">

<h1>{$pageName|default:"404 Error"}</h1>

{if $loggedIn != "true"}
<p>Sorry, you must be logged in as an admin to access this page.</p>

{elseif $user.type != "Admin"}
<p>Sorry, you must be an admin to access this page.</p>

{else}

{if $alert.message != ""}
    <p class="alert {$alert.type|default:"positive"}">
      {if $alert.type == "negative"}
        <img src="{$baseDir}lib/look/{$LOOK_DIR}/failure.png" alt="Failure: " />
      {else}
        <img src="{$baseDir}lib/look/{$LOOK_DIR}/success.png" alt="Success: " />
      {/if}
      
        {$alert.message}
    </p>
{/if}


<p>Use this page to set which active modules will be part of the repository hierarchy on the homepage.</p>


{literal}
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<style>
#sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
#sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
#sortable li span { position: absolute; margin-left: -1.3em; }
</style>
<script>
$(function() {
$( "#sortable" ).sortable({
		update: function(event, ui) {
			var postData = $("#sortable").sortable('serialize'); 
			$('#order').val(postData); 	
		}
	});
$( "#sortable" ).disableSelection({
		
	});
});
</script>
{/literal}


<div class="hierarchyConfig">
<form name="changeSettings" action="configureHierarchy.php" method="post">
  <input type="hidden" name="action" value="changeSettings" />
  <fieldset>
    <legend>Settings</legend>
    <table>
    <tr>
        <td><label for="repositoryTreeName"><strong>Hierarchy Name:</strong></label></td>
        <td><input type="text" name="repositoryTreeName" value="{$REPOSITORY_TREE_NAME}" /></td>
    </tr>
    <tr>
        <td><label for="showTree"><strong>Show hierarchy tree on home page:</strong></label></td>
        <td><input type="checkbox" id="navTree" name="navTree"{if $SHOW_REPOSITORY_TREE == true} checked="checked"{/if} /></td>
    </tr>
    <tr>
        <td><label for="repositoryTreeName"><strong>Number of levels to open initially:</strong></label></td>
        <td>
          <select id="navTreeLevels" name="navTreeLevels" value="{$REPOSITORY_TREE_LEVELS}">
          {section name=navLevels start=0 loop=5 step=1}
            {assign var="i" value=$smarty.section.navLevels.index}
            <option value="{$i}"{if $REPOSITORY_TREE_LEVELS == $i} selected="selected"{/if}>{$i}</option>
          {/section}
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
        {foreach $eligibleModules as $eligibleModule}
          <option value={$eligibleModule["moduleID"]}>{$eligibleModule["title"]}</option>                
        {/foreach}
        </select>
    </div>
    
    <fieldset class="buttons">
      <input class="button" id="submit" type="submit" value="Add Module" name="submit">
    </fieldset>
  </fieldset>
</form>
</div>

<div class="hierarchyModules">
<form method="post" action="configureHierarchy.php">
<h2>Modules in Hierarchy</h2>
{if isset($hierarchyModules) && count($hierarchyModules) > 0}
<input type="hidden" name="action" value="reOrder" />
<input id="order" type="hidden" value="" name="order">
<h5>Drag to re-order modules.</h5>
<table>
    <thead><th>Title</th><th></th></thead>
    <tbody id="sortable">
    {foreach $hierarchyModules as $hierarchyModule} {* Loop through Child Modules and display them. *}
      <tr id="order_{$hierarchyModule.moduleID}">
        <td><a href="../viewModule.php?moduleID={$hierarchyModule.moduleID}">{$hierarchyModule.title}</a></td>
        <td>
          <a class="button" href="configureHierarchy.php?action=removeModule&moduleID={$hierarchyModule.moduleID}">Remove</a>
        </td>
      </tr>
    {/foreach}
    </tbody>
</table>
<fieldset class="buttons">
	<input type="submit" name="submit" class="button" value="Save Order" />
</fieldset>
{else}
No modules have been put in the hierarchy.
{/if}
</form>
</div>
{/if} {* end 'logged in as admin' if *}

</div>

{include file="footer.tpl"}
