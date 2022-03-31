{*****************************************************************************
    File:       misc.php.tpl
    Purpose:    Smarty template for EdRepo's module wizard Misc form
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

<div id="wizard-form">
  <form method="post" class="tabular" action="misc.php">  
    <input type="hidden" readonly="readonly" name="moduleID" value="{$moduleInfo.moduleID|default:''}"></input>
    <div class="fieldRow">
        <label>
            <h3>Minimum User Level To View Module</h3>
            <p>Specifies the minimum level a user must be to view your module. The lowest level is "No Restrictions", which will allow everyone, including unregistered users, to view your module. Other possible values coorespond to privilege levels of registered users. It is reccomended you set this as low as possible, to prevent unintended blocking of your module. In addition, please note that everyone can search for and see basic information about your module (such as title, author, etc). Restricting access here will only prevent restricted users from viewing details about your module or the module's materials.</p>
        </label>
        
        <div class="fieldInput">
            <select name="moduleMinimumUserType">
                <option{if (isset($moduleInfo.minimumUserType) && $moduleInfo.minimumUserType == "Unregistered") || isset($moduleInfo.minimumUserType) == false} selected="selected"{/if} value="Unregistered">Unregistered Users (do not restrict access to anyone) [Reccomended]</option>
                <option{if isset($moduleInfo.minimumUserType) && $moduleInfo.minimumUserType == "Viewer"} selected="selected"{/if} value="Viewer">Viewers or higher</option>
                <option{if isset($moduleInfo.minimumUserType) && $moduleInfo.minimumUserType == "SuperViewer"} selected="selected"{/if} value="SuperViewer">SuperViewers or higher</option>
                <option{if isset($moduleInfo.minimumUserType) && $moduleInfo.minimumUserType == "Submitter"} selected="selected"{/if} value="Submitter">Submitters or higher</option>
                <option{if isset($moduleInfo.minimumUserType) && $moduleInfo.minimumUserType == "Editor"} selected="selected"{/if} value="Editor">Editors or higher</option>
                <option{if isset($moduleInfo.minimumUserType) && $moduleInfo.minimumUserType == "Admin"} selected="selected"{/if} value="Admin">Administrators Only</option>
            </select>
        </div>
    </div>
    
    <div class="fieldRow">
        <label>
            <h3>Comments</h3>
            <p>Comments about this module. These comments are viewable by anyone who can view details about this module.</p>
        </label>
        
        <div class="fieldInput">
            <textarea name="moduleAuthorComments">{$moduleInfo.authorComments|default:''}</textarea>
        </div>
    </div>
    
    <fieldset class="buttons">
      <input type="submit" name="submit" class="button" value="Save Module" />
      <input type="reset" class="button" value="Reset" />
    </fieldset>
  </form>
</div>

</div>
{/if} {* end if $hasPermission == true && $action != "error" *}

</div>

{include file="footer.tpl"}