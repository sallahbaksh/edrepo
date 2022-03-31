{*****************************************************************************
    File:       moduleManagement.php.tpl
    Purpose:    Smarty template for EdRepo's "Module Management" page.
    Author:     Jon Thompson
    Date:       28 July 2011
*****************************************************************************}

{include file="header.tpl"}

<div id="content">

<h1>{$pageName}</h1>

{if $loggedIn != true}
<h2>You Must Be Logged In To Continue</h2>
<p>You must be logged in to view this page.  You can do so at the <a href="loginLogout.php">log in page</a>.</p>

{elseif $backendCapable != true}
<h2>This Feature Is Not Supported</h2>
<p>The backend in use does not support the "UseModules" and/or "SearchModulesByUserID" features which are required by this page.</p>

{else}

<form name="filter" action="moduleManagement.php" method="get">
    <input type="hidden" readonly="readonly" name="action" value="filter"></input>
    By title: <input type="text" name="filterText" value="{$filterText|default:''}" id="filterTextInput"></input>
    <input type="submit" class="button" name="submit" value="Filter"></input>
</form>

{if count($modules) <= 0}
    {if $wasFiltered == true}
    <p>No modules were found matching the specified filter.</p>
    {else}
    <p>There are currently no active modules in this collection.</p>
    {/if}
{else} {* display found modules *}

<table class="sortable">
    <thead><tr>
        <th>ID</th>
        <th>Title</th>
        <th>Version</th>
        <th>Date Created</th>
        <th>Status</th>
        <th class="sorttable_nosort">Edit</th>
		{if $ENABLE_VERSIONS == true}<th class="sorttable_nosort">Create New Version</th>{/if}
        <th class="sorttable_nosort">Delete</th>
    </tr></thead><tbody>
    {foreach $modules as $module}
    {if $module@index gte $lowerLimit && $module@index lt $upperLimit && $module@index lt count($modules)}
    <tr><td>{$module.moduleID}</td>
    <td><a href="viewModule.php?moduleID={$module.moduleID}&forceView=true">{$module.title}</a></td>
    <td>{$module.version}</td><td>{$module.dateTime}</td><td>{$module.status}</td>
    <td>
        <a class="button" href="moduleWizard/index.php?moduleID={$module.moduleID}&moduleAction=edit">Edit</a>
	</td>
	{if $ENABLE_VERSIONS == true}
	<td>
        <a class="button" href="moduleWizard/index.php?moduleID={$module.moduleID}&moduleAction=createNewVersion">Create New Version</a>
    </td>
    {/if}
	<td>
        <a class="button" href="moduleWizard/delete.php?moduleID={$module.moduleID}&action=delete">Delete</a>
    </td></tr>
    {/if}
    {/foreach}
    </tbody>
</table>

{* Print any needed "Previous Page" or "Next Page" links *}
<p>
  {if $page gt 1}
    <a href="moduleManagement.php?action={$action}&filterText={$filterText|default:''}&page={$page-1}&recordsPerPage={$recordsPerPage}">&lt; Previous Page</a>
  {else}
    <a class="disabled">&lt; Previous Page</a>
  {/if}
  
    | Page <strong>{$page}</strong> of <strong>{$numPages}</strong> |
    
  {if count($modules) gt ($page * $recordsPerPage)}
    <a href="moduleManagement.php?action={$action}&filterText={$filterText|default:''}&page={$page+1}&recordsPerPage={$recordsPerPage}">Next Page &gt;</a>
  {else}
    <a class="disabled">Next Page &gt;</a>
  {/if}
</p>

{/if} {* end at least one module found if *}

{if $action != "display" && $action != "filter"}
<p><strong>Error.  An Unknown action was specified.</strong></p>
{/if} {* end action if *}

{/if} {* end loggedIn/backendCapable if *}

</div>

{include file="footer.tpl"}
