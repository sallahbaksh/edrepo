{*****************************************************************************
    File:       loginLogout.php.tpl
    Purpose:    Smarty template for EdRepo's "Login" page
    Author:     Jon Thompson
    Date:       11 May 2011
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

{if $loginSuccess != true}
<p><a class="button" href="createAccount.php">Create New Account</a></p>

<form name="loginForm" method="post" action="loginLogout.php">
    <fieldset>
    <input type="hidden" name="action" value="login" readonly="readonly"></input>
    <div class="fieldRow">
        <label for="email"><strong>Email address:</strong></label>
        <input name="email" type="text" value="{$userEmail|default:''}"></input>
    </div>
    <div class="fieldRow">
        <label for="password"><strong>Password:</strong></label>
        <input name="password" type="password"></input>
    </div>
    </fieldset>
    
    <fieldset class="buttons">
        <input type="submit" class="button" name="submit" value="Login"></input><br><br>
        <a href="forgotPassword.php">Forgot password?</a>
    </fieldset>
</form>
{/if}

</div>

{include file="footer.tpl"}