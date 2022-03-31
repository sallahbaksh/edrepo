{*****************************************************************************
    File:       Install.php.tpl
    Purpose:    Smarty template for Edrepo Installation page.
    Author:     Ben Kos
	Date:       8 July 2011
	
	Notes:      Prompts the user to enter values for each category
	            needed by the config file.
*****************************************************************************}

{include file="header.tpl"}

{include file="addAccount-js.tpl"}


<script type="text/javascript">

document.getElementById(""); 

</script>


<div id="content">

	<h1>Installing Edrepo's MySQL back-end</h1>

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

{if $action == displayConnection}

	<p>Please fill out the following to set up MySQL to support EdRepo</p>
  
	<form action="installmysql.php" method="post" class="tabular" >


	<input type="hidden" readonly="readonly" name="action" value="makeConnection"></input>

	<div class="fieldRow"> 
		<label> Host/Server Name: </label> 
		<input type="text" name="mysqlservername" value="" /> 
	</div> 

	<div class="fieldRow"> 
		<label> Username: </label> 
		<input type="text" name="mysqlusername" value="" /> 
	</div> 

	<div class="fieldRow"> 
		<label> Password: </label> 
		<input type="password" name="mysqlpass" value="" /> 
	</div> 

	<input type="submit" class="button" value="Submit"> 
	</form>
	
{/if}

{if $action == makeConnection}

	<form action="installmysql.php" method="post" class="tabular">
	
	<input type="hidden" readonly="readonly" name="action" value="installConnection"></input>

	<div class="fieldRow"> 
		<label>Database Name: </label> 
		<input type="text" name="edrepodatabasename" value="edrepo" /> 
	</div> 

	<input type="submit" class="button" value="Submit"> 
	</form>
	
{/if}

{if $action == installConnection || $action == addExtras}

	<form action="installmysql.php" method="post" class="tabular">
		<input type="hidden" readonly="readonly" name="action" value="addExtra"></input>
		<input type="submit" class="button" value="Add Users / Install Types">
	</form>
	
	<h3>Or</h3>
	
	<form action="index.php" method="post" class="tabular">
		<input type="submit" class="button" value="Finish">
	</form>
	
{/if}

{if $action == addExtra}

	<form action="installmysql.php" method="post" class="tabular">
		
	<input type="hidden" readonly="readonly" name="action" value="addExtras"></input>
	
	<div class="fieldRow">
    
	<label><h3>Topics to Install:</h3></label><br>
	<input type="radio" value="*" checked="checked" name="type">All<br>
	<input type="radio" value="Select" name="type">Select Topics<br>
	<input type="radio" value="None" name="type">None<br>
	
	<label><h3>Add Accounts:</h3></label>
      <div class="fieldInput">
        <div id="AccountsList"></div>
        <a class="button" onclick="add('Accounts', 0);">Add Account</a>
      </div>
	  
    </div>
	
	<input type="submit" class="button" value="Submit">
	
  </form>
  
{/if}

{if $action == Select} 

<form action="installmysql.php" method="post" class="tabular">

	<input type="hidden" readonly="readonly" name="action" value="addExtras"></input>
	<input type="hidden" readonly="readonly" name="type" value="Selected"></input>
	
	<table border="1" width="auto">
	<tr>
	{foreach $typeArray as $type}
		{if $counter % 5 == 0}
			</tr>
			<tr>
			<td><input type="checkbox" name="types[]" value="{$type}">{$type}</input></td>
		{/if}
		{if $counter % 5 != 0}
			<td><input type="checkbox" name="types[]" value="{$type}">{$type}</input></td>
		{/if}
		<p hidden>{$counter++}</p>
	{/foreach}
	</table>
	
	<input type="submit" class="button" value="Submit">
	
</form> 

{/if}	

</div>

{include file="footer.tpl"}