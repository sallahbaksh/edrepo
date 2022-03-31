{*****************************************************************************
    File:       configureCategories.php.tpl
    Purpose:    Smarty template for EdRepo's "Configure Categories" page
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

{if $useCategories == "false"}
<p><strong>This Feature Is Not Supported.</strong>
The back-end storage system currently running on this collection does not support using categories in read and/or write mode. 
You can not manage categories using this configuration panel.</p>

{else}

<p>This configuration panel allows you to view, add, and remove categories from this collection. 
Categories are used to organize modules.</p>

{if $categoryAction != "edit"}
<div class="subblock">
    <h2>Add A New Category</h2>
    <p>To add a new category, enter a title and a short description for the new category and select "Add".</p>
    
    <form name="addCategoryForm" action="configureCategories.php" method="post">
        <fieldset><input type="hidden" readonly="readonly" name="categoryAction" value="doAdd"></input>
        <div class="fieldRow">
            <label for="categoryName"><strong>Category Name:</strong></label>
            <input type="text" name="categoryName"></input>
        </div>
        <div class="fieldRow">
            <label for="categoryDescription"><strong>Description:</strong></label>
            <input type="text" name="categoryDescription"></input>
        </div></fieldset>
        <fieldset class="buttons"><input type="submit" class="button" name="sub" value="Add"></input></fieldset>
    </form>
</div>
{/if}

{if $categoryAction == "edit"} 
<div>
    <h2>Edit Category</h2>
    <p>To edit the category, replace a title and a short description for the  category and select "Update".</p>
    
    <form name="editCategoryForm" action="configureCategories.php?action=doEdit&categoryID={$categoryID}" method="post">
        <fieldset><input type="hidden" readonly="readonly" name="categoryAction" value="doEdit"></input>
        <div class="fieldRow">
            <label for="categoryName"><strong>Category Name:</strong></label>
            <input type="text" name="editCategoryName" value="{$categoryInfo.name|default:''}"></input>
        </div>
        <div class="fieldRow">
            <label for="categoryDescription"><strong>Description:</strong></label>
            <input type="text" name="editCategoryDescription" value="{$categoryInfo.description|default:''}"></input>
        </div></fieldset>
        <fieldset class="buttons"><input type="submit" class="button" name="doedit" value="Update"></input></fieldset>
    </form>
</div>
{/if}

<h2>Current categories in this collection:</h2>

{if $noCategories == "true"}
<p><strong>This collection currently contains no categories.</strong>
To add a category, use the "Add Category" box at the top of this page.</p>

{else} {* there is at least one category, so display them *}


<table>
    <thead><tr class="highlight"><th>Category Name</th><th>Description</th><th>Edit</th><th>Remove</th></tr></thead>
    {foreach $categories as $category}
        <tr><td><strong>{$category.name}</strong></td><td>{$category.description}</td>
		<td><a class="button" href="configureCategories.php?categoryAction=edit&categoryID={$category.ID}">Edit</a></td>
        <td><a class="button" href="configureCategories.php?categoryAction=doRemove&categoryID={$category.ID}">Remove</a></td></tr>
    {/foreach}
</table>

{/if}

{/if}  {* end 'can use categories' if *}


{/if} {* end 'logged in as admin' if *}

</div>

{include file="footer.tpl"}