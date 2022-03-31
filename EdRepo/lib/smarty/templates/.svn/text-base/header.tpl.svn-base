{*****************************************************************************
    File:       header.tpl
    Purpose:    Smarty template for EdRepo's header
    Author:     Jon Thompson
    Date:       29 April 2011
*****************************************************************************}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>{$title|default:"EdRepo"}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="{$baseDir}lib/look/{$LOOK_DIR|default:'default'}/main.css" />
    <link rel ="icon" type="image/ico" href="{$baseDir}/lib/look/{$LOOK_DIR|default:'default'}/{$HEADER.ICON_NAME|default:'icon.ico'}" />
    <script src="{$baseDir}lib/sorttable/sorttable.js" type="text/javascript"></script>
    <script src="{$baseDir}lib/jquery/jquery.js" type="text/javascript"></script>
    <script src="{$baseDir}lib/jquery/jquery-functions.js" type="text/javascript"></script>	
</head>

<body>
<div id="container">
<div id="header">
    <div id="top-bar">
        <form method="get" action="{$baseDir}browse.php" name="search-form" id="search">
            <input type="text" name="moduleTitle" />
            <input type="submit" class="button" value="Search" />
        </form>
		
      {if $loggedIn eq "true"}
        <a href="{$baseDir}userManageAccount.php" id="account-btn">My Account <img src="{$baseDir}/lib/look/{$LOOK_DIR|default:'default'}/down-arrow.png" alt="&darr;" /></a>
        <div id="account">
            <ul>
              <li><a href="{$baseDir}userManageAccount.php">My Account</a></li>
              <li><a href="{$baseDir}showMyModules.php">My Modules</a></li>
              {if $user.type eq "Submitter" || $user.type eq "Editor" || $user.type eq "Admin"}
              <li><a href="{$baseDir}moduleWizard/index.php">Create New Module</a></li>
              {/if}
            </ul>
              <hr />
            <ul>
              <li><a href="{$baseDir}loginLogout.php?action=logout">Logout</a></li>
            </ul>
        </div>
      {else}
        <a href="{$baseDir}loginLogout.php" id="account-btn">Login <img src="{$baseDir}lib/look/{$LOOK_DIR|default:'default'}/down-arrow.png" alt="&darr;" /></a>
        <div id="account">
            <form name="loginForm" method="post" action="{$baseDir}loginLogout.php">
                <input type="hidden" name="action" value="login" />
                <label><strong>Email address:</strong> </label><input name="email" type="text" /><br /><br />
                <label><strong>Password:</strong> </label><input name="password" type="password" /><br /><br />
                <input type="submit" class="button" value="Login" />
            </form>
            
            <hr />
            <ul>
                <li><a href="{$baseDir}createAccount.php">Create New Account</a></li>
            </ul>
        </div>
      {/if}
    </div> <!-- end top-bar -->
    
    <h1><a href="./index.php">
      {if $HEADER.LOGO == 'text'}
        {$COLLECTION_NAME|default:'EdRepo Collection'}
      {elseif $HEADER.LOGO == 'custom'}
      <img src="{$baseDir}/lib/look/{$LOOK_DIR}/{$HEADER.LOGO_NAME}" alt="{$COLLECTION_NAME|default:'EdRepo Collection'}" />
      {else}
      <img src="{$baseDir}/lib/look/default/logo.png" alt="{$COLLECTION_NAME|default:'EdRepo Collection'}" />
      {/if}
    </a></h1>
    
    {$HEADER.CONTENT}	
    
    <div id="nav"><ul>
        <li{if $tab eq "home"} class="active"{/if}><a href="{$baseDir}index.php">Home</a></li>
        <li{if $tab eq "browse"} class="active"{/if}><a href="{$baseDir}browse.php">Browse All</a></li>
    {if $loggedIn eq "true"}
      {if $user.type eq "Submitter" || $user.type eq "Editor" || $user.type eq "Admin"}
        <li{if $tab eq "modules"} class="active"{/if}><a href="{$baseDir}showMyModules.php">My Modules</a></li>
      {/if}
      {if $user.type eq "Editor" || $user.type eq "Admin"}
        <li{if $tab eq "moderate"} class="active"{/if}><a href="{$baseDir}moderate.php">Moderate</a></li>
      {/if}
      {if $user.type eq "Admin"}
        <li{if $tab eq "admin"} class="active"{/if}><a href="{$baseDir}admin/index.php">Admin</a></li>
      {/if}
    {/if}
        <li{if $tab eq "about"} class="active"{/if}><a href="{$baseDir}about.php">About</a></li>
    </ul></div>
</div>
