{*****************************************************************************
    File:       submit.php.tpl
    Purpose:    Smarty template for EdRepo's module wizard Submit form
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

<div id="wizard-form">
{if isset($submitSuccess) && $submitSuccess}
<p>Thank you for submitting <a href="../viewModule.php?moduleID={$moduleInfo.moduleID}&forceView=true">your module</a>. Once approved by a moderator, your module will be publicly visible.</p>
{else}
  <form method="post" class="tabular" action="submit.php">  
    <input type="hidden" readonly="readonly" name="moduleID" value="{$moduleInfo.moduleID|default:''}"></input>
    
    <div class="fieldRow">
        <label>
            <h3>Check-In Comments</h3>
            <p>Any final comments you have regarding this module, the submission process, or any information you wish to share with any moderators. These comments are only visable to moderators.</p>
        </label>
        
        <div class="fieldInput">
            <textarea name="moduleCheckInComments">{$moduleInfo.checkInComments|default:''}</textarea>
        </div>
    </div>    
    
    <fieldset class="buttons">
      <input type="submit" name="submit" class="button" value="Submit Module" />
      <a class="button" href="index.php?moduleAction=edit&moduleID={$moduleInfo.moduleID}">Cancel</a>
    </fieldset>
  </form>
{/if} {* end else from if isset($submitSuccess) && $submitSuccess *}
</div>

</div>
{/if} {* end if $hasPermission == true && $action != "error" *}

</div>

{include file="footer.tpl"}