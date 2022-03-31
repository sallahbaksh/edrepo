{*****************************************************************************
    File:       createAccount.php.tpl
    Purpose:    Smarty template for EdRepo's "Create Account" page
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

<script type="text/javascript">
    function quickValidateAllFormFields() {
      var email=document.getElementById("email").value;
      var firstName=document.getElementById("firstName").value;
      var lastName=document.getElementById("lastName").value;
      if(firstName.search("\"")!=-1 || lastName.search("\"")!=-1 || email.search("\"")!=-1) { //Don't allow quote marks.
        alert("Sorry, but first names, last, names, and email addresses may not contain quote marks.");
        return false;
      }
      return true;
    }
</script>

{if $backendCapable !=true}
<h2>This Feature Is Not Supported</h2>
<p>The backend in use does not currently support this feature.</p>

{elseif $loggedIn != false}
<h2>You Must Log Out To Continue</h2>
<p>You are currently logged in.  You must log out before creating a new account.</p>
    {if $user.type == "Admin"}
    <p><strong>Admin Users:</strong> To create or manage user accounts, use the "User Management" tool from the admin menu.</p>
    {/if}
  
{else} {* display form *}

{if $result != "success"}
<p>To create a new account, fill in all of the information below and select "Create Account".</p>
{if $NEW_ACCOUNTS_REQUIRE_APPROVAL == true}
  <p><span class="note">Your account will require approval before it becomes active.</span>  The maintainer of this collection requires 
  that new accounts be approved before they can be used.  Once your account is created, it will not be accessible until it is approved.</p>
{/if}

<form name="createAccountFrom" action="createAccount.php" method="post">
    <input type="hidden" readonly="readonly" name="action" value="doCreateAccount"></input>
    <div class="fieldRow{if $result == "BadFirstName"} error{/if}">
        <label for="firstName"><strong>First Name:</strong></label>
        <input type="text" name="firstName" id="firstName" value="{$firstName|default:''}"></input>
    </div>
    <div class="fieldRow{if $result == "BadLastName"} error{/if}">
        <label for="lastName"><strong>Last Name:</strong></label>
        <input type="text" name="lastName" id="lastName" value="{$lastName|default:''}"></input>
    </div>
    <div class="fieldRow{if $result == "BadEmail" || $result == "EmailAlreadyExists"} error{/if}">
        <label for="email"><strong>Email Address:</strong></label>
        <input type="text" name="email" id="email" value="{$email|default:''}"></input>
        {if $result == "EmailAlreadyExists"}
            <span class="error">This email address is already in use.</span>
        {/if}
    </div>
    <div class="fieldRow">
        <label for="password1"><strong>Password:</strong></label>
        <input type="password" name="password1"></input>
    </div>
    <div class="fieldRow">
        <label for="password2"><strong>Retype Password:</strong></label>
        <input type="password" name="password2"></input>
    </div>

    <fieldset class="buttons">
    <input class="button" type="submit" name="submit" value="Create Account" onclick="return quickValidateAllFormFields();"></input>
    </fieldset>
</form>
{/if}
{* end 'not success' if *}

{/if} {* end backendCapable/loggedIn if *}

{if $action != "display" && $action != "doCreateAccount"}
<p>Unable to process your request.  An unknown action was specified</p>
{/if}

</div>

{include file="footer.tpl"}
