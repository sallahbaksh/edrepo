{*****************************************************************************
    File:       showMyModules.php.tpl
    Purpose:    Smarty template for EdRepo's "Show My Modules" page.
    Author:     Jon Thompson
    Date:       20 May 2011
*****************************************************************************}

{include file="header.tpl"}

<div id="content">

<h1>{$pageName}</h1>

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

{if $loggedIn != true}
<h2>You Must Be Logged In To Continue</h2>
<p>You must be logged in to view this page.  You can do so at the <a href="loginLogout.php">log in page</a>.</p>

{elseif $backendCapable != true}
<h2>This Feature Is Not Supported</h2>
<p>The backend in use does not support the "UseModules" and/or "SearchModulesByUserID" features which are required by this page.</p>

{else}

<script type="text/javascript">
{literal}
  $(document).ready(function() {
    
    // hide sortBy form's submit button. and auto submit on change
    $('#sortBy :submit').hide();
    $('#sortBy select').change(function() {
      $("#sortBy").submit();
    });
    
  });
{/literal}
</script>

{if $user.type eq "Submitter" || $user.type eq "Editor" || $user.type eq "Admin"}
<p>
  <a class="button" href="moduleWizard/index.php">Create New Module</a>
  <h3> OR </h3>
  <form name="file" action="showMyModules.php" method="post" enctype="multipart/form-data">
    <input type="hidden" readonly="readonly" name="action" value="file"></input>
    <input type="file" accept=".csv" name="importModule" id="importModule"></input>
    <input type="submit" class="button" name="importModule" value="Import"></input>
  </form>
</p>
{/if}

<form name="filter" action="showMyModules.php" method="get">
    <input type="hidden" readonly="readonly" name="action" value="filter"></input>
    By title: <input type="text" name="filterText" value="{$filterText|default:''}" id="filterTextInput"></input>
    <input type="submit" class="button" name="submit" value="Filter"></input>
</form>

<form action="showMyModules.php" method="get" id="sortBy">
Sort by 
  <select name="sortBy">
    <option value="title"{if $sortBy == "title"} selected="selected"{/if}>Title</option>
    <option value="dateAsc"{if $sortBy == "dateAsc"} selected="selected"{/if}>Date: Oldest First</option>
    <option value="dateDesc"{if $sortBy == "dateDesc"} selected="selected"{/if}>Date: Newest First</option>
  </select>
  <input type="submit" class="button" value="Sort" />
  <br/>
</form>


{if $action != "show"}
  <form action="showMyModules.php" method="get"> 
  <input type="hidden" readonly="readonly" name="action" value="show"></input>
  <input type="submit" class="button" value="Show Older Modules" />
  </form>
{/if}
{if $action == "show"}
  <form action="showMyModules.php" method="get">
  <input type="hidden" readonly="readonly" name="action" value="hide"></input>
  <input type="submit" class="button" value="Hide Older Modules" />
  </form>
{/if}


{if count($modules) <= 0}
    {if $wasFiltered == true}
    <p>No modules were found matching the specified filter.</p>
    {else}
    <p>No modules currently belong to you.</p>
    {/if}
{else} {* display found modules *}

<table>
    <thead><tr>
        <th>ID</th>
        <th>Title</th>
        {if $ENABLE_VERSIONS == true}<th>Version</th>{/if}
        <th>Date Created</th>
        <th>Status</th>
        <th>Edit</th>
        <th>Delete</th>
        <th>Export</th>
    </tr></thead><tbody>
    {foreach $modules as $module}
    {if $module@index gte $lowerLimit && $module@index lt $upperLimit && $module@index lt count($modules)}
    <tr><td>{$module.moduleID}</td>
    <td><a href="viewModule.php?moduleID={$module.moduleID}&forceView=true">{$module.title}</a></td>
    {if $ENABLE_VERSIONS == true}<td>{$module.version}</td>{/if}
    <td>{$module.dateTime}</td>
    <td>{$module.status}</td>
    <td>
        <a class="button" href="moduleWizard/index.php?moduleID={$module.moduleID}&moduleAction=edit">Edit</a>
    </td>
    <td>
        <a class="button" href="moduleWizard/delete.php?moduleID={$module.moduleID}&action=delete">Delete</a>
    </td>
    <td>
        <a class="button" href="moduleWizard/index.php?moduleID={$module.moduleID}&moduleAction=export">Export</a>
    </td></tr>
    {/if}
    {/foreach}
    </tbody>
</table>

{* Print any needed "Previous Page" or "Next Page" links *}
<p>
  {if $page gt 1}
    <a href="showMyModules.php?action={$action}&filterText={$filterText|default:''}&page={$page-1}&recordsPerPage={$recordsPerPage}">&lt; Previous Page</a>
  {else}
    <a class="disabled">&lt; Previous Page</a>
  {/if}
  
    | Page <strong>{$page}</strong> of <strong>{$numPages}</strong> |
    
  {if count($modules) gt ($page * $recordsPerPage)}
    <a href="showMyModules.php?action={$action}&filterText={$filterText|default:''}&page={$page+1}&recordsPerPage={$recordsPerPage}">Next Page &gt;</a>
  {else}
    <a class="disabled">Next Page &gt;</a>
  {/if}
</p>

{/if} {* end at least one module found if *}

{if ($action != "display" && $action != "filter" && $action !="file") && ($action != "show" && $action != "hide")}
<p><strong>Error.  An Unknown action was specified.</strong></p>
{/if} {* end action if *}

{/if} {* end loggedIn/backendCapable if *}

</div>

{include file="footer.tpl"}
