{*****************************************************************************
    File:       references.tpl
    Purpose:    Smarty template for EdRepo's module wizard References form
    Author:     Jon Thompson
    Date:       27 March 2011
*****************************************************************************}

{include file="header.tpl"}

<div id="content">

<h1>{$pageName|default:"404 Error"}</h1>

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

{if $hasPermission == true && $action != "error"}

<div id="wizard">
{include file="moduleWizard/wizardNav.tpl"}

<script type="text/javascript" src="../lib/jquery/check-changes.js"></script>

{* include JS to enable multi-valued fields like Authors *}
{include file="moduleWizard/moduleWizard-js.tpl"}

<!-- JQuery Function that allows auto-complete search for titles that gives the ID for the title you created -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script>
function autoComplete(name) {ldelim}
	var obj = []; 
	obj = {$auto|@json_encode}; 
	$(name).autocomplete({ldelim}
		source:obj
	{rdelim});
 
{rdelim}
</script>

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

<div id="wizard-form">
  <form method="post" class="tabular" action="references.php">  
    <input type="hidden" readonly="readonly" name="moduleID" value="{$moduleInfo.moduleID|default:''}"></input>
    <input id="noModuleERefs" type="hidden" value="true" name="noModuleERefs">
    <input id="noModuleIRefs" type="hidden" value="true" name="noModuleIRefs">
    <input id="delIRefModules" type="hidden" value="" name="delIRefModules">
    <input id="delERefModules" type="hidden" value="" name="delERefModules">
    
    <div class="fieldRow">
        <label>
            <h3>Related Modules</h3>
            <p>If other modules in this collection relate to this module, add them here, along with a brief description of the relation.</p>
        </label>
        <div class="fieldInput">
            <div id="IRefsList"></div>
            <button class="button" onclick="add('IRefs', '')" type="button">Add Related Module</button>
        </div>
    </div>
    
    <div class="fieldRow">
        <label>
            <h3>External References</h3>
            <p>External references are references to sources outside this collection that viewers of your module may be interested in. It is recommended you provide these references in the form of a citation (for example, in APA or MLA style).</p>
        </label>
        <div class="fieldInput">
            <div id="ERefsList"></div>
            <button class="button" onclick="add('ERefs', '')" type="button">Add External Reference</button>
        </div>
    </div>
	
    <fieldset class="buttons">
      <input type="submit" name="submit" class="button" value="Save References" />
      <input type="reset" class="button" value="Reset" />
    </fieldset>
  </form>
</div>

<div id="wizard-form">
 <form method="post" class="tabular" action="references.php">  
    <input type="hidden" readonly="readonly" name="moduleID" value="{$moduleInfo.moduleID|default:''}"></input>
	<input id="order" type="hidden" value="" name="order">
	
	{if count($seeAlso) > 0}
	<div class="fieldRow">
	<div class="section">
	  <h2>References</h2>
	  <h5>Click and drag to reorder.</h5>
	  <table>
		<thead>
		  <tr>
			<th>Module Title</th>
			<th>Description</th>
		  </tr>
		</thead>
		<tbody id="sortable">
		{foreach $seeAlso as $ref}
		  <tr id="order_{$ref.referencedModuleID}">
			<td><a href="../viewModule.php?moduleID={$ref.referencedModuleID}">{$ref.title}</a></td>
			<td>{$ref.description}</td>
		  </tr>  
		{/foreach}
		</tbody>
	  </table>
	</div>
	</div>
	
	<fieldset class="buttons">
      <input type="submit" name="submitOrder" class="button" value="Save Order" />
    </fieldset>
	{/if}
 </form>
</div>

</div>
{/if} {* end if $hasPermission == true && $action != "error" *}

</div>

{include file="footer.tpl"}