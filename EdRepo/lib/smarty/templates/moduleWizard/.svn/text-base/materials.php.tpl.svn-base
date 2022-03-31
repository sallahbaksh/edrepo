{*****************************************************************************
    File:       moduleWizard.tpl
    Purpose:    Smarty template for EdRepo's module wizard form
    Author:     Jon Thompson
    Date:       6 June 2011
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

<div id="wizard-form">
{if $action != "deleteMaterial" && $action != "doDeleteMaterial" && $action != "renameMaterial" && $action != "doRenameMaterial"}
<script type="text/javascript">
    var materialType = "LocalFile"; // default
    var action = "{$action}";
    var materialLink = "{$materialInfo.linkToMaterial|default:''}";
    var materialName = "{$materialInfo.readableFileName|default:''}";
    {literal}
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
    {/literal}
</script>
    
<div id="materialForms">
<h2>Attach New Material</h2>
<form enctype="multipart/form-data" method="post" action="materials.php" class="narrow">
    <input type="hidden" name="action" value="addMaterial" />
    <input type="hidden" name="moduleID" value="{$moduleInfo.moduleID}" />
    
    <div class="fieldRow">
        <label>
            <strong>Type:</strong>
        </label>
        <select id="materialType" onchange="showProperInput();" name="materialType">
            <option{if (isset($materialInfo.type) && $materialInfo.type == "LocalFile") || isset($materialInfo.type) == false} selected="selected"{/if} value="LocalFile">Upload File</option>
            <option{if isset($materialInfo.type) && $materialInfo.type == "ExternalURL"} selected="selected"{/if} value="ExternalURL">Internet URL</option>
        </select>
    </div>
    <div class="fieldRow" id="nameRow">
        <label>
            <strong>Name:</strong>
        </label>
        <input id="materialName" type="text" name="materialName" value="{$materialInfo.name|default:''}">
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
    <input type="hidden" name="moduleID" value="{$moduleInfo.moduleID}" />
    <div class="fieldRow">
        <label>
            <strong>Module</strong>
        </label>
        <select id="newChild" name="newChild">
        {foreach $modules as $module}
          <option value={$module["moduleID"]}>{$module["title"]} --- ID:{$module["moduleID"]}</option>                
        {/foreach}
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
    <input type="hidden" name="moduleID" value="{$moduleInfo.moduleID}" />
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
{if count($materials) > 0 && $canView == TRUE}
<h2>Materials</h2>
<table>
    <thead><th>Title</th><th>Type</th><th></th></thead>
    <tbody>
    {foreach $materials as $material}
    <tr>
        <td><a href="../viewMaterial.php?materialID={$material.materialID}">{$material.name}</a></td>
        <td>
        {if $material.type == "LocalFile"}
          {$material.format}
        {elseif $material.type == "ExternalURL"}
          URL
        {else}
          {$material.type}
        {/if}
        </td>
		<td>
			<a class="button" href="materials.php?action=renameMaterial&moduleID={$moduleInfo.moduleID}&materialID={$material.materialID}">Rename</a>
		</td>
        <td>
            <a class="button" href="materials.php?action=deleteMaterial&moduleID={$moduleInfo.moduleID}&materialID={$material.materialID}">Delete</a>
        </td>
    </tr>
    {/foreach}
    </tbody>
</table>
{/if}

{if count($moduleChildren) > 0}
<h2>Attached Modules</h2>
<table>
    <thead><th>Title</th><th></th></thead>
    <tbody>
    {foreach $moduleChildren as $moduleChild} {* Loop through Child Modules and display them. *}
      <tr>
        <td><a href="../viewModule.php?moduleID={$moduleChild.moduleID}">{$moduleChild.title}</a></td>
        <td>
          <a class="button" href="materials.php?action=removeChild&moduleID={$moduleInfo.moduleID}&childID={$moduleChild.moduleID}">Remove</a>
        </td>
      </tr>
    {/foreach}
    </tbody>
</table>
{/if}

</div>
{elseif $action == "deleteMaterial" || $action == "doDeleteMaterial"}
<p>You are about to delete the material <strong>{$materialInfo.name}</strong>. Are you sure you want to <strong>permanently delete</strong> this material?</p>

<p>
    <a class="button" href="materials.php?action=doDeleteMaterial&moduleID={$moduleInfo.moduleID}&materialID={$materialInfo.materialID}">Delete</a>
    <a class="button" href="materials.php?moduleID={$moduleInfo.moduleID}">Cancel</a>
</p>

{elseif $action == "renameMaterial" || $action == "doRenameMaterial"}
<p>You are renaming <strong>{$materialInfo.name}</strong>.</p>

<p>
	<form action="materials.php?action=doRenameMaterial&moduleID={$moduleInfo.moduleID}&materialID={$materialInfo.materialID}" method="POST">
	<input type="text" name="renameMaterial"><br><br>
	<input class="button" type="submit" name="rename" value = "Rename">
	<a class="button" href="materials.php?moduleID={$moduleInfo.moduleID}">Cancel</a>
	</form>
</p>

{/if} {* end $action if *}
</div>

</div>
{/if} {* end if $hasPermission == true && $moduleAction != "error" *}

</div>

{include file="footer.tpl"}