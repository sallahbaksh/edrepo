{*****************************************************************************
    File:       rate.php.tpl
    Purpose:    Smarty template for EdRepo's "Rate" page
    Author:     Jon Thompson
    Date:       20 May 2011
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

{if $loggedIn != true}
<h2>You Must Be Logged In To Continue</h2>
<p>Only registered, logged in users may rate materials or modules.  Please <a href="loginLogout.php">log in</a> to continue.</p>

{else} {* logged in... *}

{if isset($showRateModule) == true && $showRateModule == true}
<h2>Leave A Rating For Module {$module.title} version {$module.version}</h2>
<p>Rate this module on a scale of 0 to 5, with 0 being the the lowest rating and 5 being the best.</p>
<form name="mainForm" action="rate.php" method="post">
    <input type="hidden" readonly="readonly" name="action" value="doRate"></input>
    <input type="hidden" readonly="readonly" name="moduleID" value="{$module.moduleID}"></input>
    <input type="radio" name="rating" value="0"></input>0 &nbsp;
    <input type="radio" name="rating" value="1"></input>1 &nbsp;
    <input type="radio" name="rating" value="2"></input>2 &nbsp;
    <input type="radio" name="rating" value="3"></input>3 &nbsp;
    <input type="radio" name="rating" value="4"></input>4 &nbsp;
    <input type="radio" name="rating" value="5"></input>5<br /><br />
    <fieldset class="buttons" style="padding-left: 0"><input type="submit" class="button" name="submit" value="Rate This Module"></input>
    <a class="button" href="viewModule.php?moduleID={$module.moduleID}">Cancel</a></fieldset>
</form>
{/if}

{if isset($showRateMaterial) == true && $showRateMaterial == true}
<h2>Leave A Rating for Material {$material.name}</h2>
<p>Rate this material on a scale of 0 to 5, with 0 being the lowest rating and 5 being the best.  You may also leave 
comments about the material if you wish.</p>
<form name="mainForm" action="rate.php" method="post">
    <input type="hidden" readonly="readonly" name="action" value="doRate"></input>
    <input type="hidden" readonly="readonly" name="materialID" value="{$material.materialID}"></input>
    <input type="hidden" readonly="readonly" name="moduleID" value="{$module.moduleID}"></input>
    <input type="radio" name="rating" value="0"></input>0 &nbsp;
    <input type="radio" name="rating" value="1"></input>1 &nbsp;
    <input type="radio" name="rating" value="2"></input>2 &nbsp;
    <input type="radio" name="rating" value="3"></input>3 &nbsp;
    <input type="radio" name="rating" value="4"></input>4 &nbsp;
    <input type="radio" name="rating" value="5"></input>5<br><hr>
    <!--Comments (optional)<br>
    <strong>Title:</strong></label><input type="text" name="commentTitle"></input><br />
    <textarea name="comment"></textarea>-->
    <fieldset class="buttons" style="padding: 0"><input type="submit" class="button" name="submit" value="Rate This Material"></input>
    <a class="button" href="viewModule.php?moduleID={$module.moduleID}">Cancel</a></fieldset>
</form>
{/if}

<a href="viewModule.php?moduleID={$module.moduleID}">&larr; Back to module</a>

{/if} {* end logged in if *}

</div>

{include file="footer.tpl"}
