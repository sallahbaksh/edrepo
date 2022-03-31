{*****************************************************************************
    File:       basics.php.tpl
    Purpose:    Smarty template for EdRepo's module wizard Basics page
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

{if $hasPermission == true && $moduleAction != "error"}

{if $moduleAction == "createNewVersion"}
<p><strong>Warning:</strong> You are about to create a new version of a previous module. 
If you didn't intend to do this, click the "Exit" button in the sidebar or simply 
<a href="../showMyModules.php">return to My Modules</a>.</p>
{/if}
{if $moduleAction == "copy"}
<p><strong>Warning:</strong> You are about to create a copy of a previous module. 
If you didn't intend to do this, click the "Exit" button in the sidebar or simply 
<a href="../showMyModules.php">return to My Modules</a>.</p>
{/if}

<div id="wizard">
{include file="moduleWizard/wizardNav.tpl"} 

<script type="text/javascript" src="../lib/jquery/check-changes.js"></script>

{* include JS to enable multi-valued fields like Authors *}
{include file="moduleWizard/moduleWizard-js.tpl"}

<!-- JQuery Function that allows auto-complete search for titles that gives the ID for the title you created -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script>
function autoComplete(id) {ldelim}
    var auto = [];
    auto = {$auto|@json_encode};
    $(id).autocomplete({ldelim}
        source:auto,
        select: function(event, ui) {ldelim}
            var value = $(id).val();
            $('#submitterValue').val(value);
        {rdelim}
    {rdelim});
{rdelim}
</script>

<div id="wizard-form">
  <form method="post" class="tabular" action="index.php">  
    <input type="hidden" readonly="readonly" name="moduleID" value="{$moduleInfo.moduleID|default:''}"></input>
    <input type="hidden" readonly="readonly" name="moduleAction" value="{$moduleAction}"></input>
    
    <input type="hidden" name="noModuleAuthors" value="true" id="noModuleAuthors"></input>
    <input type="hidden" name="noModuleTopics" value="true" id="noModuleTopics"></input>
    <input type="hidden" name="noModuleObjectives" value="true" id="noModuleObjectives"></input>
    <input type="hidden" name="noModulePrereqs" value="true" id="noModulePrereqs"></input>
    <input type="hidden" name="noModuleCategories" value="true" id="noModuleCategories"></input>
    <input type="hidden" name="noModuleTypes" value="true" id="noModuleTypes"></input>
    
    <div class="fieldRow">
      <label><h3>Module Title</h3></label>
      <div class="fieldInput">
		<textarea name="moduleTitle" type="text" {if $moduleAction=="createNewVersion" || $moduleAction=="edit"} disabled="disabled" title="Module title cannot be changed after creation."{/if}>{$moduleInfo.title|default:''}</textarea>
      </div>
    </div>

	{if $type == "Admin" && $moduleAction == "edit"}
    <div class="fieldRow">
      <label><h3>Submitter</h3><p>Search User's Name or Email.</p></label>
      <div class = "fieldInput">
		<input id="submitter" type="text" onfocus="autoComplete('#submitter')" value="{$submitter.firstName|default:''} {$submitter.lastName|default:''}" name="submitter"/>
      </div>
    </div>
    {/if}
	
    <div class="fieldRow">
        <label><h3>Description</h3><p>A description of this module.</p></label>
        <div class="fieldInput"><textarea name="moduleDescription" style="width: 100%;">{$moduleInfo.description|default:''}</textarea></div>
    </div>

    <div class="fieldRow">
        <label>
            <h3>Authors</h3>
            <p>You may add as many authors to this module as you wish.  By default, you are the only author.</p>
        </label>
        <div class="fieldInput">
            <div id="AuthorsList"></div>
            <a class="button" onclick="add('Authors', '');">Add Author</a>
        </div>
    </div>

    <div class="fieldRow">
      <label><h3>Language</h3><p>The language corresponding to the module's content.</p></label>
      <div class="fieldInput">
      <select name="moduleLanguage" size="1">
        <option value="chi" {if isset($moduleInfo.language) && $moduleInfo.language == "chi"} selected="selected"{/if}>Chinese</option>
        <option value="eng" {if (isset($moduleInfo.language) && $moduleInfo.language == "eng") || !isset($moduleInfo.language)} selected="selected"{/if}>English</option>
        <option value="fra" {if isset($moduleInfo.language) && $moduleInfo.language == "fra"} selected="selected"{/if}>French</option>
        <option value="ger" {if isset($moduleInfo.language) && $moduleInfo.language == "ger"} selected="selected"{/if}>German</option>
        <option value="hin" {if isset($moduleInfo.language) && $moduleInfo.language == "hin"} selected="selected"{/if}>Hindi</option>
        <option value="ita" {if isset($moduleInfo.language) && $moduleInfo.language == "ita"} selected="selected"{/if}>Italian</option>
        <option value="jpn" {if isset($moduleInfo.language) && $moduleInfo.language == "jpn"} selected="selected"{/if}>Japanese</option>
        <option value="rus" {if isset($moduleInfo.language) && $moduleInfo.language == "rus"} selected="selected"{/if}>Russian</option>
        <option value="spa" {if isset($moduleInfo.language) && $moduleInfo.language == "spa"} selected="selected"{/if}>Spanish</option>
        <option value="zxx" {if isset($moduleInfo.language) && $moduleInfo.language == "zxx"} selected="selected"{/if}>No Linguistic Content</option>			
      </select>
      </div>
    </div>
	
	
	<div class="fieldRow">
		<label><h3>Restrictions By Group</h3><p>This module will only be visible to the group selected. (Default: None)</p></label>
		<div class="fieldInput">
		<select name="restrictions" size="1">
			<option value="None" {if isset($moduleInfo.restrictions) && $moduleInfo.restrictions == "None"} selected="selected"{/if}>None</option>
			<option value="Student" {if isset($moduleInfo.restrictions) && $moduleInfo.restrictions == "Student"} selected="selected"{/if}>Student</option>
			<option value="Teacher" {if isset($moduleInfo.restrictions) && $moduleInfo.restrictions == "Teacher"} selected="selected"{/if}>Teacher</option>
			<option value="Professor" {if isset($moduleInfo.restrictions) && $moduleInfo.restrictions == "Professor"} selected="selected"{/if}>Professor</option>
			<option value="Principal" {if isset($moduleInfo.restrictions) && $moduleInfo.restrictions == "Principal"} selected="selected"{/if}>Principal</option>
			<option value="Dean" {if isset($moduleInfo.restrictions) && $moduleInfo.restrictions == "Dean"} selected="selected"{/if}>Dean</option>
			<option value="President" {if isset($moduleInfo.restrictions) && $moduleInfo.restrictions == "President"} selected="selected"{/if}>President</option>
			<option value="Admin" {if isset($moduleInfo.restrictions) && $moduleInfo.restrictions == "Admin"} selected="selected"{/if}>Admin</option>
		</select>
		</div>
	</div>
			
    <div class="fieldRow">
      <label><h3>Educational Level</h3><p>The educational level that the module is targeted towards.</p></label>
      <div class="fieldInput">
      <select name="moduleEducationLevel" size="1">
        <option{if isset($moduleInfo.educationLevel) && $moduleInfo.educationLevel == "Pre-Kindergarten"} selected="selected"{/if}>Pre-Kindergarten</option>
        <option{if isset($moduleInfo.educationLevel) && $moduleInfo.educationLevel == "Elementary School"} selected="selected"{/if}>Elementary</option>
        <option{if isset($moduleInfo.educationLevel) && $moduleInfo.educationLevel == "Middle School"} selected="selected"{/if}>Middle School</option>
        <option{if isset($moduleInfo.educationLevel) && $moduleInfo.educationLevel == "High School"} selected="selected"{/if}>High School</option>
        <option{if (isset($moduleInfo.educationLevel) && $moduleInfo.educationLevel == "Higher Education") || !isset($moduleInfo.educationLevel)} selected="selected"{/if}>Higher Education</option>
        <option{if isset($moduleInfo.educationLevel) && $moduleInfo.educationLevel == "Informal"} selected="selected"{/if}>Informal</option>
        <option{if isset($moduleInfo.educationLevel) && $moduleInfo.educationLevel == "Vocational"} selected="selected"{/if}>Vocational</option>
      </select>
      </div>
    </div>

    <div class="fieldRow">
      <label>
          <h3>Minutes</h3>
          <p>You may specify how long this module takes to complete in minutes. If length in minutes does not apply, please enter '0'.</p>
      </label>
      <div class="fieldInput">
        <input type="text" maxlength="150" name="moduleMinutes" value="{$moduleInfo.minutes|default:'0'}"></input><br />
        <br />
      </div>
    </div>
    
    <div class="fieldRow">
    <label><h3>Types</h3></label>
      <div class="fieldInput">
        <div id="TypesList"></div>
        <a class="button" onclick="add('Types', 0);">Add Type</a>
      </div>
    </div>
    
    
    <div class="fieldRow">
      <label><h3>Categories</h3></label>
      <div class="fieldInput">
        <div id="CategoriesList"></div>
        <a class="button" onclick="add('Categories', 0);">Add Category</a>
      </div>
    </div>
    
    <div class="fieldRow">
      <label><h3>Topics</h3></label>
      <div class="fieldInput">
        <div id="TopicsList"></div>
        <a class="button" onclick="add('Topics', '');">Add Topic</a>
      </div>
    </div>
  
    <div class="fieldRow">
      <label><h3>Objectives</h3></label>
      <div class="fieldInput">
        <div id="ObjectivesList"></div>
        <a class="button" onclick="add('Objectives', '');">Add Objective</a>
      </div>
    </div>
    
    <div class="fieldRow">
      <label><h3>Prerequisites</h3></label>
      <div class="fieldInput">
        <div id="PrereqsList"></div>
        <a class="button" onclick="add('Prereqs', '');">Add Prerequisite</a>
      </div>
    </div>

    <div class="fieldRow">
      <label><h3>Interactivity Type</h3><p>The state of interaction the user can expect with the module.</p></label>
      <div class="fieldInput">
        <select name="moduleInteractivityType" size="1">
          <option {if isset($moduleInfo.interactivityType) && $moduleInfo.interactivityType == "Active"} selected="selected"{/if}>Active</option>
          <option {if isset($moduleInfo.interactivityType) && $moduleInfo.interactivityType == "Expositive"} selected="selected"{/if}>Expositive</option>
          <option {if isset($moduleInfo.interactivityType) && $moduleInfo.interactivityType == "Mixed"} selected="selected"{/if}>Mixed</option>
          <option {if (isset($moduleInfo.interactivityType) && $moduleInfo.interactivityType == "Undefined") || !isset($moduleInfo.interactivityType)} selected="selected"{/if}>Undefined</option>
        </select>
      </div>
    </div>

    <div class="fieldRow">
        <label><h3>Rights</h3><p>A statement describing property rights associated with this resource (e.g. copyright).</p></label>
        <div class="fieldInput"><textarea name="moduleRights" style="width: 100%;">{$moduleInfo.rights|default:'This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.'}</textarea></div>
    </div>
        
    <fieldset class="buttons">
      <input type="submit" name="submit" class="button" value="{if $moduleAction=="create"}Save New Module{elseif $moduleAction=="createNewVersion"}Save New Version{elseif $moduleAction=="copy"}Create Copy{else}Save Module{/if}" />
      <input type="reset" class="button" value="Reset" />
	  {if $moduleAction=="edit"}
	  {if $ENABLE_VERSIONS == TRUE}<a class="button" href="index.php?moduleAction=createNewVersion&moduleID={$moduleID}">Create A New Version</a>{/if}
	  <a class="button" href="index.php?moduleAction=copy&moduleID={$moduleID}">Create A Copy</a>
    <a class="button" href="index.php?moduleAction=export&moduleID={$moduleID}">Export</a>
	  {/if}
    </fieldset>
  </form>
</div>

</div>
{/if} {* end if $hasPermission == true && $moduleAction != "error" *}

</div>

{include file="footer.tpl"}