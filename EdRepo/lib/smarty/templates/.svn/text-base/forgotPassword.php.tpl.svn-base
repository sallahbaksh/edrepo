{*****************************************************************************
    File:       forgotPassword.php.tpl
    Purpose:    Smarty template for EdRepo's "Forgot Password" page
    Author:     Jon Thompson
    Date:       20 May 2011
*****************************************************************************}

{include file="header.tpl"}

<div id="content">

{if $action=="unLock"}<h1>Unlock Account</h1>
{else}<h1>{$pageName|default:"404 Error"}</h1>{/if}

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

<script type="text/javascript">
function quickValidateAllFormFields() {
  var email=document.getElementById("email").value;
  var firstName=document.getElementById("firstName").value;
  var lastName=document.getElementById("lastName").value;
  if(firstName.search("\"")!=-1 || lastName.search("\"")!=-1 || email.search("\"")!=-1 || firstName.search("\'")!=-1 || lastName.search("\'")!=-1 || email.search("\'")!=-1) {
    //Don't allow quote marks.
    alert("Sorry, but first names, last, names, and email addresses may not contain quote marks.");
    return false;
  }
  return true;
}
</script>

{if $backendCapable !=true}
<h2>This Feature Is Not Supported</h2>
<p>The backend in use does not currently support this feature.</p>

{elseif $loggedIn == true}
<h2>Please Use The Your "My Account" Panel to Change Your Password</h2>
<p>You are currently logged in.  To change your password, use the your "My Account" panel.</p>
  
{else} {* free to continue *}

{if $action == "display"}
<p>To recover your password, enter your email address below and click "Recover Password" to send your password to your email address.</p>
<form name="passwordRecoveryForm" method="post" action="forgotPassword.php">
    <input type="hidden" readonly="readonly" name="action" value="recover"></input>
    <div class="fieldRow">
        <label for="email"><strong>Email Address:</strong></label>
        <input type="text" name="email" value="{$email|default:''}"></input>
    </div>
    
    <fieldset class="buttons">
        <input type="submit" class="button" name="sub" value="Recover Password"></input>
    </fieldset>
</form>

{elseif $action == "recover"}
{* an alert will be sent, no need for other output here *}

{elseif $action == "reset" || $action == "doReset" || $action == "unLock"}
 {if $showForm == true}
<p>To reset your password, enter your new password twice in the form below.</p>
<form name="passwordRecoveryForm" method="post" action="forgotPassword.php">
    <input type="hidden" readonly="readonly" name="action" value="doReset"></input>
    <input type="hidden" readonly="readonly" name="userID" value="{$userID}"></input>
    <input type="hidden" readonly="readonly" name="token" value="{$token}"></input>
    <div class="fieldRow">
        <label for="password1"><strong>New Password:</strong></label>
        <input type="password" name="password1"></input>
    </div>
    <div class="fieldRow">
        <label for="password2"><strong>Retype Password:</strong></label>
        <input type="password" name="password2"></input>
    </div>
    
    <fieldset class="buttons">
        <input type="submit" class="button" name="sub" value="Save Password"></input>
    </fieldset>
</form> 
 
 {/if} {* end showForm if *}

{else}
<p>Unable to process your request.  An unknown action was specified</p>

{/if} {* end action if *}

{/if} {* end backendCapable/loggedIn if *}

</div>

{include file="footer.tpl"}
