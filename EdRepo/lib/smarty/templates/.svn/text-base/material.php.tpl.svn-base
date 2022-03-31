{*****************************************************************************
    File:       material.php.tpl
    Purpose:    Smarty template for EdRepo's "Material Management"
    Author:     Jon Thompson
    Date:       23 June 2011
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

{if $action == "add" || $action == "doAdd" || $action == "attachModule"}
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

<br />
<h2>Attach New Material</h2>
<form enctype="multipart/form-data" method="post" action="material.php" class="tabular">
    <input type="hidden" name="action" value="doAdd" />
    <input type="hidden" name="moduleID" value="{$moduleInfo.moduleID}" />
    
    <div class="fieldRow">
        <label>
            <h3>Type</h3>
        </label>
        <select id="materialType" onchange="showProperInput();" name="materialType">
            <option{if (isset($materialInfo.type) && $materialInfo.type == "LocalFile") || isset($materialInfo.type) == false} selected="selected"{/if} value="LocalFile">Upload File</option>
            <option{if isset($materialInfo.type) && $materialInfo.type == "ExternalURL"} selected="selected"{/if} value="ExternalURL">Internet URL</option>
        </select>
    </div>
    <div class="fieldRow" id="nameRow">
        <label>
            <h3>Name</h3>
        </label>
        <div class="fieldInput">
            <input id="materialName" type="text" name="materialName" value="{$materialInfo.name|default:''}">
        </div>
    </div>
    <div class="fieldRow">
        <label>
            <h3>Content</h3>
            {if $action == "edit"}
            <p><strong>Note:</strong> To change a material's content, delete this material and create a new one with the new content.</p>
            {/if}
        </label>
        <div class="fieldInput">
            <div id="materialInputDiv">
                <input id="materialFile" type="file" name="materialFile" />
                <input id="materialURL" type="text" name="materialURL" value="http://" />
            </div>
        </div>
    </div>
    
    <div>
        <div id="left"></div>
        <div id="center">
            <input class="button" id="submit" type="submit" value="{if $action == "add" || $action == "doAdd"}Add Material{else}Save{/if}" name="submit">
            <a class="button" href="index.php?moduleAction=edit&moduleID={$moduleInfo.moduleID}&step=2">Cancel</a>
        </div>
        <div id="right"></div>
    </div>
</form>

<br />
<h2>Attach Existing Module</h2>
<p>Use this form to attach an existing in module to this module as a "child."</p>
<form method="post" action="material.php" class="tabular">
    <input type="hidden" name="action" value="attachModule" />
    <input type="hidden" name="moduleID" value="{$moduleInfo.moduleID}" />
    <div class="fieldRow">
        <label>
            <h3>Module</h3>
        </label>
        <div class="fieldInput">
            <div id="materialInputDiv">
                <select id="newChild" name="newChild">
                {foreach $modules as $module}
                  <option value={$module["moduleID"]}>{$module["title"]}</option>                
                {/foreach}
                </select>
            </div>
        </div>
    </div>
    
    <div>
        <div id="left"></div>
        <div id="center">
            <input class="button" id="submit" type="submit" value="Attach Module" name="submit">
            <a class="button" href="index.php?moduleAction=edit&moduleID={$moduleInfo.moduleID}&step=2">Cancel</a>
        </div>
        <div id="right"></div>
    </div>
</form>

{elseif $action == "delete" || $action == "doDelete"}
<p>You are about to delete the material <strong>{$materialInfo.name}</strong>. Are you sure you want to <strong>permanently delete</strong> this material?</p>

<p>
    <a class="button" href="material.php?action=doDelete&moduleID={$moduleInfo.moduleID}&materialID={$materialInfo.materialID}">Delete</a>
    <a class="button" href="index.php?moduleAction=edit&moduleID={$moduleInfo.moduleID}&step=2">Cancel</a>
</p>

{else}
<p>Undefined action specified. Be sure to only use links on the website to access this page.</p>

{/if} {* end $action if *}

{/if} {* end $hasPermission == true && $moduleAction != "error" if *}
    
    
</div>

{include file="footer.tpl"}
