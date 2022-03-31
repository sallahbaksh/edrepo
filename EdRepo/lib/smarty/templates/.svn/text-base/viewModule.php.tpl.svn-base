{*****************************************************************************
    File:       viewModule.php.tpl
    Purpose:    Smarty template for EdRepo's "View Module" page
    Author:     Jon Thompson
    Date:       13 May 2011
*****************************************************************************}

{include file="header.tpl"}

<div id="content">

{literal}
<script type="text/javascript" src="lib/jquery/jstree/jquery.jstree.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
  
    // retrieve the ids for the "current" tree node and its parent node
    var current = $("#panel .current").attr("id");
    var parent = $("#panel .current").parent().closest("li").attr("id");
    
    // activate hierachy side panel tree
    $("#hierarchy").jstree({ 
      "core": { 
        "initially_open" : [ current, parent ],
        "animation" : 0,
        "load_open" : true
      },
      "themes" : {
        "theme" : "classic",
        "icons" : false        
      },
      "plugins" : [ "themes", "html_data" ]
    });    
    
  
    $('tr.details').hide();
    
    $('a.details').click(function() {
      var rowID = $(this).attr("id");
      $('tr.'+rowID).toggle();
    });
    
  });
</script>
{/literal}

{if (!isset($noModule) || $noModule == false) && $canViewModule == true}
<div id="panel">
<strong>Navigate:</strong> (<a id="ecAll" href="#">+/- all</a>)
<div id="hierarchy">
{$tree}
</div>
{if count($moduleParents) > 0}
<hr />
<strong>Referring Modules:</strong>
<ul>
    {foreach $moduleParents as $moduleParent} {* Loop through any additional Parent Modules and display them. *}
    <li><a href="viewModule.php?moduleID={$moduleParent.moduleID}">{$moduleParent.title}</a></li>
    {/foreach}
</ul>
{/if}
</div>
<a id="collapse" title="Show/Hide Side Panel"></a>
<div id="page">
{/if}

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

{if isset($noModule) && $noModule == true}
<h2>Module Not Found</h2>

<p>No module with the specified ID was found.  Please try again with a different ID.</p>

<form name="moduleIDSubmission" action="viewModule.php" method="get">
    <input type="text" name="moduleID"></input>
    <input type="submit" class="button" name="sub" value="View Module"></input>
</form>

{else} {* have a module to view *}

{if $canViewModule == true}

 {* If the module's status is InProgress/PendingModeration, print a warning that the module is not active in the collection. *}
{if $module.status == "InProgress" || $module.status == "PendingModeration"}
    <p><span class="note"><strong>Note:  This module is not yet active in this collection.</strong></span>  This module has not yet been published 
    to this collection, and can not be searched for or viewed by most users.  To activate this module, it must be submitted to 
    the collection via the module submission wizard{if $NEW_MODULES_REQUIRE_MODERATION == TRUE} and approved by a moderator{/if}.</p>
    
{else}
<p class="module-details">
Submitted by <strong>{$submitter.firstName} {$submitter.lastName}</strong> on <strong>{$module.dateTime}</strong>.
{if $ENABLE_VERSIONS == true}&nbsp;&nbsp;&nbsp;<strong>Version {$module.version}</strong>{/if}
</p>
{/if}

{if $canEditModule == true}
<p style="text-align:right">
<a class="button" href="moduleWizard/index.php?moduleID={$module.moduleID}&moduleAction=edit">Edit</a>
</p>
{/if}

<div class="section">
<h2 class="description">Description</h2>
<p>{$module.description}</p>
</div>

{if $CheckInComments != "" && $canSeeComments == TRUE}
<div class="section">
<h2 class="description">Check-In Comments</h2>
<p>{$CheckInComments}</p>
</div>
{/if}

<div class="section">
<h2>General Information</h2>

<table class="MIV">
    {if $showAuthors == true}
    <tr><td class="highlight" rowspan="{count($authors)}">Authors</td>
    <td>{$authors[0]}</td></tr> {* display the first author *}
    {foreach $authors as $author} {* Loop through any additional authors and display them. *}
      {if $author@index > 0}
      <tr><td>{$author}</td></tr>
      {/if}
    {/foreach}
    {/if}

	<tr><td class="highlight">Language</td><td>
		{if $module.language == "chi"}
			Chinese
		{/if}
		{if $module.language == "eng"}
			English
		{/if}
		{if $module.language == "fra"}
			France
		{/if}
		{if $module.language == "ger"}
			German
		{/if}
		{if $module.language == "hin"}
			Hindi
		{/if}
		{if $module.language == "ita"}
			Italian
		{/if}
		{if $module.language == "jpn"}
			Japanese
		{/if}
		{if $module.language == "rus"}
			Russian
		{/if}
		{if $module.language == "spa"}
			Spanish
		{/if}
		{if $module.language == "zxx"}
			No linguistic content
		{/if}
	</td></tr>
	<tr><td class="highlight">Education Level</td><td>{$module.educationLevel}</td></tr>
	
	<tr><td class="highlight">Interactivity Type</td><td>{$module.interactivityType}</td></tr>
	
	{if $module.minutes != 0}<tr><td class="highlight">Minutes</td><td>{$module.minutes}</td></tr>{/if}
  
	<tr><td class="highlight">Rights</td><td>{$module.rights}</td></tr>
	
	<tr><td class="highlight">Restrictions to</td><td>{$module.restrictions}</td></tr>
    
    {if $showCategories == true}
    <tr><td class="highlight" rowspan="{count($categoryNames)}">Categories</td>
    <td>{$categoryNames[0]}</td></tr> {* display the first categoryName *}
    {foreach $categoryNames as $categoryName} {* Loop through any additional categoryNames and display them. *}
      {if $categoryName@index > 0}
      <tr><td>{$categoryName}</td></tr>
      {/if}
    {/foreach}
    {/if}
    
    {if $showTypes == true}
    <tr><td class="highlight" rowspan="{count($typeNames)}">Types</td>
    <td>{$typeNames[0]}</td></tr> {* display the first typeName *}
    {foreach $typeNames as $typeName} {* Loop through any additional typeNames and display them. *}
      {if $typeName@index > 0}
      <tr><td>{$typeName}</td></tr>
      {/if}
    {/foreach}
    {/if}
    
    {if $module.authorComments != ""}<tr><td class="highlight">Comments</td><td>{$module.authorComments}</td></tr>{/if}
    
    {if $readRatings == true}
    <tr><td class="highlight">Module Rating</td><td>
      {* If there are no ratings, indicate that (don't try to determine a numerical rating) *}
      {if $ratings.numberOfRatings <= 0} 
          This module has not yet been rated.
      {else} {* This else runs if there is at least one rating for the module. *}
          {round($ratings.rating/$ratings.numberOfRatings , 2)} of 5 (out of {$ratings.numberOfRatings} total ratings)
      {/if}
      
      {if $writeRatings == true && $module.status == "Active"}
        {if $loggedIn == "true"}
        &nbsp;<a href="rate.php?moduleID={$module.moduleID}">Leave a Rating</a>
        {else}
        &nbsp;<a href="loginLogout.php">Login to leave ratings.</a>
        {/if}
      {/if}
    {/if}
    </td></tr>
	
</table>
</div>

{if count($topics) > 0 || count($objectives) > 0 || count($prereqs) > 0}
<div class="section">
<h2>Topics, Objectives, and Prerequisites</h2>
<table class="MIV">
{if count($topics) >= 1}
    <tr><td class="highlight" rowspan="{count($topics)}">Topics</td>
    <td>{$topics[0].text}</td></tr> {* display the first topic *}
    {foreach $topics as $topic} {* Loop through any additional topics and display them. *}
      {if $topic@index > 0}
      <tr><td>{$topic.text}</td></tr>
      {/if}
    {/foreach}
{/if}

{if count($objectives) >= 1}
    <tr><td class="highlight" rowspan="{count($objectives)}">Objectives</td>
    <td>{$objectives[0].text}</td></tr> {* display the first objective *}
    {foreach $objectives as $objective} {* Loop through any additional objectives and display them. *}
      {if $objective@index > 0}
      <tr><td>{$objective.text}</td></tr>
      {/if}
    {/foreach}
{/if}

{if count($prereqs) >= 1}
    <tr><td class="highlight" rowspan="{count($prereqs)}">Prerequisites</td>
    <td>{$prereqs[0].text}</td></tr> {* display the first prereq *}
    {foreach $prereqs as $prereq} {* Loop through any additional prereqs and display them. *}
      {if $prereq@index > 0}
      <tr><td>{$prereq.text}</td></tr>
      {/if}
    {/foreach}
{/if}
</table>
</div>
{/if}

{if count($moduleChildren) > 0}
<div class="section">
<h2>Attached Modules</h2>
  <ul>
    {foreach $moduleChildren as $moduleChild} {* Loop through Child Modules and display them. *}
      <li><a href="viewModule.php?moduleID={$moduleChild.moduleID}&root={$root}">{$moduleChild.title}</a></li>
    {/foreach}
  </ul>
</table>
</div>
{/if}

{if count($seeAlso) > 0}
<div class="section">
  <h2>See Also...</h2>
  <table>
    <thead>
      <tr>
        <th>Module Title</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
    {foreach $seeAlso as $ref}
      <tr>
        <td><a href="viewModule.php?moduleID={$ref.referencedModuleID}">{$ref.title}</a></td>
        <td>{$ref.description}</td>
      </tr>
    {/foreach}
    </tbody>
  </table>
</div>
{/if}

{if count($externalReferences) > 0}
<div class="section">
  <h2>External References</h2>
  <dl>
  {foreach $externalReferences as $ref}
    <dt><strong>{$ref.link}</strong></dt>
      <dd>{$ref.description}</dd>
  {/foreach}
  </dl>
</div>
{/if}

{if $showMaterials == true && $canView == true}
<div class="section">
<h2>Materials</h2>
{if count($materials) <= 0}
<p>This module contains no materials.</p>

{else} {* has at least one material *}
<table class="MIV">
    <thead>
    <tr>
      <th></th>
      <th>Title</th>
      <th>Type</th>
      <th>Download/View</th>
    </tr>
    </thead>
    <tbody>
  {foreach $materialInfo as $material}
    <tr>
      <td><a class="button details" id="details-{$material.materialID}" title="Show/Hide Details">+</a></td>
      <td><strong>{$material.name}</strong></td>
      <td>
        {if $material.type == "LocalFile"}
          {$material.format}
        {elseif $material.type == "ExternalURL"}
          URL
        {else}
          {$material.type}
        {/if}
      </td>
      <td><a href="viewMaterial.php?materialID={$material.materialID}" class="button">
        {if $material.type == "LocalFile"}Download{else}View{/if}
      </a></td>
    </tr>
    <tr class="details details-{$material.materialID}">
      <td></td>
      <td colspan="3" style="padding-left: 15px;">
        {if $material.type == "LocalFile"}<strong>Filename:</strong> {$material.readableFileName}{else}<strong>Content:</strong> {$material.content}{/if}<br />
        {if $readRateMaterials == true}
        <strong>Rating:</strong>  
          {if $material.numRatings <= 0}
          This material has not been rated yet.
          {else}
          {$material.averageRating} out of 5 (out of {$material.numRatings} total ratings).
          {/if}
          
          {if $writeRateMaterials == true && $module.status == "Active"}
            {if $loggedIn == "true"}
            &nbsp;<a href="rate.php?moduleID={$module.moduleID}&materialID={$material.materialID}">Leave a Rating</a>
            {else}
            &nbsp;<a href="loginLogout.php">Login to leave ratings.</a>
            {/if}
          {/if}
        {/if}
      </td>
    </tr>
  {/foreach}
  </tbody>
</table>
{/if} {* end 'count materials' if *}
</div>

{/if} {* end 'show materials' if *}
</div> <!-- end div id="page" -->
{else} {* can't view module *}
<h2>Insufficient Privileges To View This Module</h2>
<p>You do not have enough permissions to view this module.  Log out and log back in with the right privilege level to view this 
module.</p>

{/if} {* end 'can view module' if *}


{/if} {* end 'have module' if *}

</div>

{include file="footer.tpl"}