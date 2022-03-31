{*****************************************************************************
    File:       Install.php.tpl
    Purpose:    Smarty template for Edrepo Installation page.
    Author:     Ben Kos (from general format by Jon Thompson)
	Date:       23 June 2011
	
	Notes:      Prompts the user to enter values for each category
	            needed by the config file.
*****************************************************************************}

{include file="header.tpl"}

<div id="content">

<h1>Installing the Edrepo front-end</h1>

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

<p>To manually install EdRepo please click below. Otherwise fill out the form below to automatically install EdRepo.</p>
<form action="install.php" method="post">

<input type="hidden" readonly="readonly" name="action" value="manualInstall"></input>
<input type="submit" class="button" value="Manually Install EdRepo"></input>

</form>

<p>Please fill out the following to set up your Edrepo collection.</p>

<form action="install.php" method="post" class="tabular" >

<input type="hidden" readonly="readonly" name="action" value="doEdit"></input>

<input type="hidden" readonly="readonly" name="install" value="TRUE"></input>

<div class="fieldRow"> 
	<label><h3>Collection Name</h3></label> 
	<input type="text" name="collection_name" value="{$COLLECTION_NAME}" /> 
</div> 

<div class="fieldRow"> 
	<label><h3>Base URL</h3>
  <p>The base directory where you installed EdRepo. For example if your URL is "http://mysite.com/stuff/edrepo" the Base URL would be "/stuff/edrepo".</p>
  </label>
  	<input type="radio" name="baseURL" name="auto" value="{$collectionBaseURL}" checked="checked"><b>{$collectionBaseURL}</b></input>
  	<p style="display:inline">or</p>
	<input type="radio" name="baseURL" name="entered"><input type="text" name="collection_base_url" value="{$COLLECTION_BASE_URL}" /></input>
</div> 

<div class="fieldRow">  
	<label><h3>Material Storage Directory</h3>
  <p>Absolute path to a directory on your server's filesystem to save this collection's materials.</p></label>  
	<input type="text" name="material_storage_dir" value="{$MATERIAL_STORAGE_DIR}" /> 
</div> 

<div class="fieldRow"> 
	<label><h3>Approval For New Accounts</h3><p>New accounts require administrator approval.</p></label>  
	<input type="checkbox" name="new_accounts_require_approval" 
	{if $NEW_ACCOUNTS_REQUIRE_APPROVAL == "TRUE"} checked="checked"{/if} />
</div> 

<div class="fieldRow">
	<label><h3>Auto-approval for modules.</h3> 
	<p>Automatically approves modules when submitted. (Default: Admin, Editor)</p></label>
	{foreach $selectedTypes as $selectedUser}
		<input type="checkbox" name="auto_approve_accounts[]" value="{$selectedUser}" checked="checked">
		{$selectedUser}
		</input>
	{/foreach}
	{foreach $accountType as $accountTypes}
		<input type="checkbox" name="auto_approve_accounts[]" value="{$accountTypes}">
		{$accountTypes}
		</input>
	{/foreach}

</div>

<div class="fieldRow"> 
	<label><h3>Default New Account Type</h3></label> 
	<select name="new_accounts_account_type" value="{$NEW_ACCOUNTS_ACCOUNT_TYPE}" />
		<option {if isset($NEW_ACCOUNTS_ACCOUNT_TYPE) && $NEW_ACCOUNTS_ACCOUNT_TYPE == "Viewer"} selected="selected"{/if}>Viewer</option>
		<option {if isset($NEW_ACCOUNTS_ACCOUNT_TYPE) && $NEW_ACCOUNTS_ACCOUNT_TYPE == "Super Viewer"} selected="selected"{/if}>Super Viewer</option>
		<option {if isset($NEW_ACCOUNTS_ACCOUNT_TYPE) && $NEW_ACCOUNTS_ACCOUNT_TYPE == "Submitter"} selected="selected"{/if}>Submitter</option>
		<option {if isset($NEW_ACCOUNTS_ACCOUNT_TYPE) && $NEW_ACCOUNTS_ACCOUNT_TYPE == "Editor"} selected="selected"{/if}>Editor</option>
		<option {if isset($NEW_ACCOUNTS_ACCOUNT_TYPE) && $NEW_ACCOUNTS_ACCOUNT_TYPE == "Admin"} selected="selected"{/if}>Admin</option>
	</select>
</div> 

<div class="fieldRow"> 
	<label><h3>Moderate New Modules</h3><p>New modules require moderator approval to become public.</p></label>  
	<input type="checkbox" name="new_modules_require_moderation" 
	{if $NEW_MODULES_REQUIRE_MODERATION == "TRUE"} checked="checked"{/if} /> 
</div> 	

<div class="fieldrow">
	<label><h3>Show Versions</h3><p>Module Versions will be shown and can be made.</p></label>
	<input type="checkbox" name="enable_versions"
	{if $ENABLE_VERSIONS == "TRUE"} checked="checked"{/if} />
</div>

<input type="submit" class="button" value="Submit Information"> 

</form>

<p>Once you are pleased with your settings, please select which back-end you would like to use to support your EdRepo system.</p>

<form action="installmysql.php" method="post" class="tabular">
<div class="fieldRow"> 
	<label> Back-End to be used: </label> 
	<select name="backend_type">
		<option>MySQL (default)</option>
		<option>Custom</option>
	</select> 
</div> 

<input type="submit" class="button" value="Continue"> 

</form>

</div>


{include file="footer.tpl"}