{*****************************************************************************
    File:       admin.tpl
    Purpose:    Smarty template for EdRepo's static admin pages
    Author:     Jon Thompson
    Date:       5 May 2011
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

{$content|default:"<p>Sorry the page you tried to access doesn't exist.
If you believe this is an error please contact the site administrator.</p>"}
{/if}

</div>

{include file="footer.tpl"}
