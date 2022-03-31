{*****************************************************************************
    File:       browse.php.tpl
    Purpose:    Smarty template for EdRepo's browse.php
    Author:     Jon Thompson
    Date:       2 May 2011
*****************************************************************************}

{include file="header.tpl"}

<script type="text/javascript">
{literal}
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
  
{/literal}
</script>

<div id="content">

<div id="panel">
  <form id="filters" method="post" action="browse.php">
    
    <fieldset>
      <h3>Search by module title</h3>
      <input type="text" name="moduleTitle" value="{$filters.title|default:''}" />
      <input class="button" type="submit" value="Search" />
    </fieldset>

    <fieldset class="clearable">
      <h3>General</h3>
      <ul class="checkboxes">
        {strip}
        <li>
        <label><input type="checkbox" name="topLevel" value="*"
        {if isset($filters.topLevel) && $filters.topLevel} checked="checked"{/if}
        /> Show only top-level modules

<!--You are passing filters and other filters everytime you call aoumtOfModules which isn't a good thing to do-->

    <!--GET RID OF THE DOUBLE CALLS BY USING A VARIABLE-->


<!-- mountOfModules(type, name, typeCount, categoryCount, statusCount) -->

  		{foreach $filters.topLevel as $module}
      {$count = amountOfModules("topLevel", "topLevel", $typeCount, $categoryCount, $statusCount)}
      {if $count > 0} 
      ({$count}) {/if}
      {/foreach}
		</label>
		</li>
        {/strip}
        {strip}
        <li>
        <label><input type="checkbox" name="hasMaterial" value="*"
        {if isset($filters.hasMaterial) && $filters.hasMaterial} checked="checked"{/if}
        /> Show only modules with materials
		{foreach $filters.hasMaterial as $module}
    {$count = amountOfModules("hasMaterial", "hasMaterial", $typeCount, $categoryCount, $statusCount)}
		{if $count > 0} 
    ({$count}) {/if}
		{/foreach}
		</label>
		</li>
        {/strip}
      </ul>
    </fieldset>      
    
  {if $useCategories eq "true"}
    <fieldset>
      <h3>Category</h3>
      <ul class="checkboxes hasAny">
        {strip}
        <li>
        <label><input class="any" type="checkbox" name="moduleCategory[]" value="*"
        {if isset($filters.category) && in_array("*", $filters.category)} checked="checked"{/if}
        /> Any{$count = amountOfModules("ALL", "", "", "", "")}{if $count > 0} ({$count}) {/if}
		</label>
		</li>
        {/strip}
        {foreach $categories as $category}
          {strip}
          <li><label>
          <input type="checkbox" name="moduleCategory[]" value="{$category.ID}" 
          {if isset($filters.category) && in_array($category.ID, $filters.category)} checked="checked"{/if}
          > {$category.name}{$count = amountOfModules("category", $category.name, $typeCount, $categoryCount, $statusCount)}{if $count > 0} 
          ({$count}) {/if}
          </label>
		  </li>
          {/strip}
        {/foreach}
      </ul>
    </fieldset>      
  {/if} {* end useCategories if *}
    
  {if $useTypes eq "true"}
    <fieldset>
      <h3>Type</h3>
      <ul class="checkboxes hasAny">
        {strip}
        <li>
        <label><input class="any" type="checkbox" name="moduleType[]" value="*"
        {if isset($filters.type) && in_array("*", $filters.type)} checked="checked"{/if}
        /> Any{$count = amountOfModules("ALL", "", "", "", "")}{if $count > 0} ({$count}) {/if}
		</label>
		</li>
        {/strip}
        {foreach $types as $type}
          {strip}
          <li><label>
          <input type="checkbox" name="moduleType[]" value="{$type.ID}"
          {if isset($filters.type) && in_array($type.ID, $filters.type)} checked="checked"{/if}
          > {$type.name}{$count = amountOfModules("type", $type.name, $typeCount, $categoryCount, $statusCount)} {if $count > 0} 
          ({$count}) {/if}
          </label>  
		  </li>
          {/strip}
        {/foreach}
      </ul>
    </fieldset>      
  {/if} {* end useTypes if *}
    
  {if $adminOrEditor}
    <fieldset>
      <h3>Status</h3>
      <ul class="checkboxes hasAny">
        {strip}
        <li>
        <label><input class="any" type="checkbox" name="moduleStatus[]" value="*"
        {if isset($filters.status) && in_array("*", $filters.status)} checked="checked"{/if}
        /> Any{$count = amountOfModules("ALL", "", "", "", "")}{if $count > 0} ({$count}) {/if}
		</label>
		</li>
        {/strip}
        {strip}
        <li><label>
        <input type="checkbox" name="moduleStatus[]" value="Active"
        {if isset($filters.status) && in_array("Active", $filters.status)} checked="checked"{/if}
        > Active{$count = amountOfModules("status", "Active", $typeCount, $categoryCount, $statusCount)}{if $count > 0} 
        ({$count}) {/if}
		</label>
		</li>
        {/strip}
        {strip}
        <li><label>
        <input type="checkbox" name="moduleStatus[]" value="InProgress"
        {if isset($filters.status) && in_array("InProgress", $filters.status)} checked="checked"{/if}
        > InProgress{$count = amountOfModules("status", "InProgress", $typeCount, $categoryCount, $statusCount)}{if $count > 0} 
        ({$count}) {/if}
        </label>
		</li>
        {/strip}
        {strip}
        <li><label>
        <input type="checkbox" name="moduleStatus[]" value="PendingModeration"
        {if isset($filters.status) && in_array("PendingModeration", $filters.status)} checked="checked"{/if}
        > PendingModeration{$count = amountOfModules("status", "PendingModeration", $typeCount, $categoryCount, $statusCount)}{if $count > 0}
         ({$count}) {/if}
        </label>
		</li>
        {/strip}
        {strip}
        <li><label>
        <input type="checkbox" name="moduleStatus[]" value="Locked"
        {if isset($filters.status) && in_array("Locked", $filters.status)} checked="checked"{/if}
        > Locked{$count = amountOfModules("status", "Locked", $typeCount, $categoryCount, $statusCount)}{if $count > 0}
         ({$count}) {/if}
        </label>		
		</li>
        {/strip}
      </ul>
    </fieldset>      
  {/if} {* end adminOrEditor if *}
  
   <!--{if $admin} 		This will eventually show the restriction categories and display ones in that category
   <fieldset>
      <h3>Status</h3>
      <ul class="checkboxes hasAny">
        {strip}
        <li>
        <label><input class="any" type="checkbox" name="moduleRestrictions[]" value="*"
        {if isset($filters.status) && in_array("*", $filters.status)} checked="checked"{/if}
        /> Any
		</label>
		<label>
		{if amountOfModules("") > 0} ({amountOfModules("")}) {/if}
		</label>
		</li>
        {/strip}
      </ul>
	</fieldset>
	{/if}-->
  
  <fieldset>
    <input type="submit" class="button" value="Apply" />
    <input type="submit" class="button" name="clearFilters" value="Clear Filters" />
  </fieldset>
  
  </form>
</div>
<a id="collapse" title="Show/Hide Side Panel"></a>

<div id="page">

<h1>{$pageName}</h1>

{if $moduleError=="true"} {* Did searching for records return an error or a "NotImplimented"? *}
<p>This collection does not currently support browsing.</p>

{else} {* This else block runs if searching for records to browse by did not return an error. *}

{if $numRecords lte 0}
<p>No modules were found.</p>

{else} {* At least one module found *}

<p>Use the filters on the left to help find what you're looking for.</p>

<form action="browse.php" method="get" id="sortBy">
Sort by 
  <select name="sortBy">
    <option value="title"{if $sortBy == "title"} selected="selected"{/if}>Title</option>
    <option value="dateAsc"{if $sortBy == "dateAsc"} selected="selected"{/if}>Date: Oldest First</option>
    <option value="dateDesc"{if $sortBy == "dateDesc"} selected="selected"{/if}>Date: Newest First</option>
  </select>
  <input type="submit" class="button" value="Sort" />
</form>

<table>
    <thead><tr>
        <th>ID</th>
        <th>Title</th>
        <th>
          <img title="Has material" src="{$baseDir}lib/look/{$LOOK_DIR|default:'default'}/doc.png" />
        </th>
        <th>Submitter</th>
        <th>Date</th>
        {if $useCategories eq "true"}<th>Category</th>{/if}        
        {if $ENABLE_VERSIONS == true}<th>Version</th>{/if}
        {if $adminOrEditor}
        <th>Status</th>
        <th>Edit</th>
        <th>Delete</th>
		<!--{if $ENABLE_VERSIONS == true}<th>Create New Version</th>{/if}-->
        {/if}
    </thead><tbody>
    
    {foreach $records as $record} {* loop through found modules *}
    {if $record@index gte $lowerLimit && $record@index lt $upperLimit && $record@index lt $numRecords}
    <tr>
        <td>{$record.moduleID}</td>
        <td><a href="viewModule.php?moduleID={$record.moduleID}">{$record.title}</a></td>
        <td>{if $record.hasMaterials}<img title="Has material" src="{$baseDir}lib/look/{$LOOK_DIR|default:'default'}/doc.png" />{/if}</td>
        <td>{$record.authorFirstName} {$record.authorLastName}</td>
        <td>{$record.dateTime|date_format}</td>
      {if $useCategories eq "true"}
        <td>
        {$recordCategories[$record@index]}
        </td>
      {/if}
      {if $ENABLE_VERSIONS == true}<td>{$record.version}</td>{/if}
      {if $adminOrEditor}
        <td>{$record.status}</td>
        <td>
            <a class="button" href="moduleWizard/index.php?moduleID={$record.moduleID}&moduleAction=edit">Edit</a>
        </td>
        <td>
            <a class="button" href="moduleWizard/delete.php?moduleID={$record.moduleID}&action=delete">Delete</a>
        </td>
		<!--{if $ENABLE_VERSIONS == true}
		<td>
            <a class="button" href="moduleWizard/index.php?moduleID={$record.moduleID}&moduleAction=createNewVersion">Create New Version</a>
		</td>
		{/if}-->
      {/if}        
    </tr>
    {/if}
    {/foreach}
</table>

{* Print any needed "Previous Page" or "Next Page" links *}
<p>
  {if $page gt 1}
    <a href="browse.php?page={$page-1}&recordsPerPage={$recordsPerPage}">&lt; Previous Page</a>
  {else}
    <a class="disabled">&lt; Previous Page</a>
  {/if}
  
    | Page <strong>{$page}</strong> of <strong>{$numPages}</strong> |
    
  {if $numRecords gt ($page * $recordsPerPage)}
    <a href="browse.php?page={$page+1}&recordsPerPage={$recordsPerPage}">Next Page &gt;</a>
  {else}
    <a class="disabled">Next Page &gt;</a>
  {/if}
</p>

{/if} {* end at least one module found if *}

{/if} {* end record error if *}

</div>

</div>

{include file="footer.tpl"}
