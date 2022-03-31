{*****************************************************************************
    File:       editComposition.php.tpl
    Purpose:    Smarty template for EdRepo's "Edit Compositions" page.
    Author:     Ben Kos
    Date:       12 August 2011
*****************************************************************************}

{include file="header.tpl"}

<div id="content">

<h1>{$pageName}</h1>

{if $loggedIn != true}
<h2>You Must Be Logged In To Continue</h2>
<p>You must be logged in to view this page.  You can do so at the <a href="loginLogout.php">log in page</a>.</p>

{elseif $backendCapable != true}
<h2>This Feature Is Not Supported</h2>
<p>The backend in use does not support the features which are required by this page.</p>

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

<h2>Current Relationships</h2>
<table class="MIV">

{if count({$moduleparents}) >= 1}
    <tr class="highlight"><td>Parent Module</td><td>Child Module</td><td></td></tr>
	{section name=thing loop=$moduleparents}
		<form action="editCompositions.php" method="post" class="tabular">
			<input type="hidden" readonly="readonly" name="action" value="deleteComp"></input>
			<tr><td><input type="hidden" readonly="readonly" name="actualParent" value="{$moduleparents[thing]["moduleID"]}"><a href="viewModule.php?moduleID={$moduleparents[thing]["moduleID"]}">{$moduleparents[thing]["title"]}</a></td>
			<td><input type="hidden" readonly="readonly" name="actualChild" value="{$modulechildren[thing]["moduleID"]}"></input><a href="viewModule.php?moduleID={$modulechildren[thing]["moduleID"]}">{$modulechildren[thing]["title"]}</a></td>
			<td><input type="submit" class="button" value="Delete"></td></tr>
		</form>
	{/section}
   
</table>

<h2>Set a New Relationship</h2>

<form action="editCompositions.php" method="post">

<input type="hidden" readonly="readonly" name="action" value="editComp"></input>

<div class="fieldRow">
	<label><strong>Parent Module:</strong></label> 
	<select name="newParent"/>
		<option value="">Choose a module below</option>
		{section name=i loop=$usermodules}
			<option value={$usermodules[i]["moduleID"]}>{$usermodules[i]["title"]}</option>
		{/section}
	</select>
</div> 

<div class="fieldRow"> 
	<label><strong>Child Module:</strong></label> 
	<select name="newChild"/>
		<option value="">Choose a module below</option>
		{section name=i loop=$usermodules}
		<option value={$usermodules[i]["moduleID"]}>{$usermodules[i]["title"]}</option>
		{/section}
	</select>
</div> 

<fieldset class="buttons">
  <input type="submit" class="button" value="Create Relationship"> 
</fieldset>

</form>


{* <h2>Eliminate a Relationship</h2>

<form action="editCompositions.php" method="post" class="tabular" >

<input type="hidden" readonly="readonly" name="action" value="deleteComp"></input>

<div class="fieldRow"> 
	<label>Parent Module:</label> 
	<select name="deleteParent"/>
		<option value="">Choose a module below</option>
		{section name=i loop=$usermodules}
			<option value={$usermodules[i]["moduleID"]}>{$usermodules[i]["title"]}</option>
		{/section}
	</select>
</div> 

<div class="fieldRow"> 
	<label>Child Module:</label> 
	<select name="deleteChild"/>
		<option value="">Choose a module below</option>
		{section name=i loop=$usermodules}
		<option value={$usermodules[i]["moduleID"]}>{$usermodules[i]["title"]}</option>
		{/section}
	</select>
</div> 

<input type="submit" class="button" value="Delete Relationship"> 

</form> *}

{/if}

{/if} {* Closes if loggedin statement *}

</div>

{include file="footer.tpl"}
