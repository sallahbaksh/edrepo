{*****************************************************************************
    File:       configureTypes.php.tpl
    Purpose:    Smarty template for EdRepo's "Configure Types" page
    Author:     Jon Thompson
    Date:       6 May 2011
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

{if $useTypes == "false"}
<p><strong>This Feature Is Not Supported.</strong>
The back-end storage system currently running on this collection does not support using types in read and/or write mode. 
You can not manage catagories using this configuration panel.</p>

{else}

<p>This configuration panel allows you to view, add, and remove types from this collection. 
Types are used to describe modules. 
EdRepo comes preloaded with a subset of the <a href="http://nsdl.org/contribute/type">NSDL's controlled vocabulary for type</a>. 
Though it is recommended that you use NSDL terms if you plan on exporting your module metadata, feel free to add or remove types that make sense for this collection.</p>

<div class="subblock">
    <h2>Add A New Type</h2>
    <p>To add a new type, enter a title for the new type and select "Add".</p>
    
    <form name="addTypeForm" action="configureTypes.php" method="post">
        <fieldset><input type="hidden" readonly="readonly" name="action" value="doAdd"></input>
        <div class="fieldRow">
            <label for="typeName"><strong>Type Name:</strong></label>
            <input type="text" name="typeName"></input>
        </div></fieldset>
        <fieldset class="buttons"><input type="submit" class="button" name="sub" value="Add"></input></fieldset>
    </form>
</div>

<h2>Current types in this collection:</h2>

{if $noTypes == "true"}
<p><strong>This collection currently contains no types.</strong>
To add a type, use the "Add Type" box at the top of this page.</p>

{else} {* there is at least one type, so display them *}


<table>
    <thead><tr class="highlight"><th>Type Name</th><th>Remove</th></tr></thead>
    {foreach $types as $type}
        <tr><td><strong>{$type.name}</strong></td>
        <td><a class="button" href="configureTypes.php?action=doRemove&typeID={$type.ID}">Remove</a></td></tr>
    {/foreach}
</table>

{/if}

{/if}  {* end 'can use types' if *}


{/if} {* end 'logged in as admin' if *}

</div>

{include file="footer.tpl"}
