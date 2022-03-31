{*****************************************************************************
    File:       delete.php.tpl
    Purpose:    Smarty template for EdRepo's "Delete Module"
    Author:     Jon Thompson
    Date:       24 June 2011
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

{if $action == "delete"}
<p><span class="warning"><strong>Are you sure you want to delete the module "{$moduleInfo.title}"?</strong></span></p>

<p>Deleting this module will permanently remove it, and you will loose all changes you have made to it.</p>

{if $user.userID != $moduleInfo.submitterUserID}
<p><span class="warning"><strong>WARNING:  You are deleting a module which does not belong to you!</strong></span><br />
Deleting a module which does not belong to you is not recomended.  If you submit this module, the origional module owner will no 
longer be able to edit or create new versions of this module.  It is strongly suggested, therefore, that you stop editing this 
module.  If you choose to continue editing this module, it is STRONGLY reccomended you do not submit it for moderation or publish 
it to the collection.</p>
{/if}

<p><a class="button" href="delete.php?action=doDelete&moduleID={$moduleInfo.moduleID}">Delete</a>
<a class="button" href="../showMyModules.php">Cancel</a></p>

{elseif $action != "doDelete" && $action != "error"}
<p>Unknown action specified.</p>

{/if} {* end action if *}

{/if} {* end $hasPermission == true && $moduleAction != "error" if *}

{if $user.type == "Submitter" || $user.type == "Editor" || $user.type == "Admin"}
<p><a href="../showMyModules.php">Return to "My Modules"</a></p>
{/if}
    
</div>

{include file="footer.tpl"}
