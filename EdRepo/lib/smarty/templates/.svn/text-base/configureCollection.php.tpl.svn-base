{*****************************************************************************
    File:       configureCollection.php.tpl
    Purpose:    Smarty template for EdRepo's "Configure Collection" page
    Author:     Jon Thompson
    Date:       11 May 2011
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

{if $action == "displayEdit" || $action == "doEdit"} {* ACTION: EDIT ************************}
<form name="editStaticContentForm" method="post" action="configureCollection.php">
    <input type="hidden" readonly="readonly" name="action" value="doEdit"></input>
    <h2>Basic Settings</h2>
    <fieldset>
        <div class="fieldRow">
          Collection name: 
          <input type="text" name="name" value="{$COLLECTION_NAME}" />
        </div>
    </fieldset>
    
    <fieldset class="buttons" style="padding-left: 0">
        <input type="submit" class="button" name="sub" value="Save Changes"></input>
        <a href="index.php" class="button">Cancel</a>
    </fieldset>
</form>
{* END ACTION: EDIT *******************************************************}

{/if} {* end 'action' if *}

{/if} {* end 'logged in as admin' if *}

</div>

{include file="footer.tpl"}
