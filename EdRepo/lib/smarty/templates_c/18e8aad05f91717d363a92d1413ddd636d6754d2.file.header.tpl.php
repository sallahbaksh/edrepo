<?php /* Smarty version Smarty-3.0.7, created on 2017-01-13 11:37:49
         compiled from "/var/www/html/EdRepo/EdRepo/lib/smarty/templates/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3168374215879025ddd8e01-22650731%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '18e8aad05f91717d363a92d1413ddd636d6754d2' => 
    array (
      0 => '/var/www/html/EdRepo/EdRepo/lib/smarty/templates/header.tpl',
      1 => 1484321121,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3168374215879025ddd8e01-22650731',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo (($tmp = @$_smarty_tpl->getVariable('title')->value)===null||$tmp==='' ? "EdRepo" : $tmp);?>
</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
lib/look/<?php echo (($tmp = @$_smarty_tpl->getVariable('LOOK_DIR')->value)===null||$tmp==='' ? 'default' : $tmp);?>
/main.css" />
    <link rel ="icon" type="image/ico" href="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
/lib/look/<?php echo (($tmp = @$_smarty_tpl->getVariable('LOOK_DIR')->value)===null||$tmp==='' ? 'default' : $tmp);?>
/<?php echo (($tmp = @$_smarty_tpl->getVariable('HEADER')->value['ICON_NAME'])===null||$tmp==='' ? 'icon.ico' : $tmp);?>
" />
    <script src="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
lib/sorttable/sorttable.js" type="text/javascript"></script>
    <script src="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
lib/jquery/jquery.js" type="text/javascript"></script>
    <script src="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
lib/jquery/jquery-functions.js" type="text/javascript"></script>	
</head>

<body>
<div id="container">
<div id="header">
    <div id="top-bar">
        <form method="get" action="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
browse.php" name="search-form" id="search">
            <input type="text" name="moduleTitle" />
            <input type="submit" class="button" value="Search" />
        </form>
		
      <?php if ($_smarty_tpl->getVariable('loggedIn')->value=="true"){?>
        <a href="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
userManageAccount.php" id="account-btn">My Account <img src="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
/lib/look/<?php echo (($tmp = @$_smarty_tpl->getVariable('LOOK_DIR')->value)===null||$tmp==='' ? 'default' : $tmp);?>
/down-arrow.png" alt="&darr;" /></a>
        <div id="account">
            <ul>
              <li><a href="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
userManageAccount.php">My Account</a></li>
              <li><a href="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
showMyModules.php">My Modules</a></li>
              <?php if ($_smarty_tpl->getVariable('user')->value['type']=="Submitter"||$_smarty_tpl->getVariable('user')->value['type']=="Editor"||$_smarty_tpl->getVariable('user')->value['type']=="Admin"){?>
              <li><a href="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
moduleWizard/index.php">Create New Module</a></li>
              <?php }?>
            </ul>
              <hr />
            <ul>
              <li><a href="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
loginLogout.php?action=logout">Logout</a></li>
            </ul>
        </div>
      <?php }else{ ?>
        <a href="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
loginLogout.php" id="account-btn">Login <img src="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
lib/look/<?php echo (($tmp = @$_smarty_tpl->getVariable('LOOK_DIR')->value)===null||$tmp==='' ? 'default' : $tmp);?>
/down-arrow.png" alt="&darr;" /></a>
        <div id="account">
            <form name="loginForm" method="post" action="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
loginLogout.php">
                <input type="hidden" name="action" value="login" />
                <label><strong>Email address:</strong> </label><input name="email" type="text" /><br /><br />
                <label><strong>Password:</strong> </label><input name="password" type="password" /><br /><br />
                <input type="submit" class="button" value="Login" />
            </form>
            
            <hr />
            <ul>
                <li><a href="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
createAccount.php">Create New Account</a></li>
            </ul>
        </div>
      <?php }?>
    </div> <!-- end top-bar -->
    
    <h1><a href="./index.php">
      <?php if ($_smarty_tpl->getVariable('HEADER')->value['LOGO']=='text'){?>
        <?php echo (($tmp = @$_smarty_tpl->getVariable('COLLECTION_NAME')->value)===null||$tmp==='' ? 'EdRepo Collection' : $tmp);?>

      <?php }elseif($_smarty_tpl->getVariable('HEADER')->value['LOGO']=='custom'){?>
      <img src="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
/lib/look/<?php echo $_smarty_tpl->getVariable('LOOK_DIR')->value;?>
/<?php echo $_smarty_tpl->getVariable('HEADER')->value['LOGO_NAME'];?>
" alt="<?php echo (($tmp = @$_smarty_tpl->getVariable('COLLECTION_NAME')->value)===null||$tmp==='' ? 'EdRepo Collection' : $tmp);?>
" />
      <?php }else{ ?>
      <img src="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
/lib/look/default/logo.png" alt="<?php echo (($tmp = @$_smarty_tpl->getVariable('COLLECTION_NAME')->value)===null||$tmp==='' ? 'EdRepo Collection' : $tmp);?>
" />
      <?php }?>
    </a></h1>
    
    <?php echo $_smarty_tpl->getVariable('HEADER')->value['CONTENT'];?>
	
    
    <div id="nav"><ul>
        <li<?php if ($_smarty_tpl->getVariable('tab')->value=="home"){?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
index.php">Home</a></li>
        <li<?php if ($_smarty_tpl->getVariable('tab')->value=="browse"){?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
browse.php">Browse All</a></li>
    <?php if ($_smarty_tpl->getVariable('loggedIn')->value=="true"){?>
      <?php if ($_smarty_tpl->getVariable('user')->value['type']=="Submitter"||$_smarty_tpl->getVariable('user')->value['type']=="Editor"||$_smarty_tpl->getVariable('user')->value['type']=="Admin"){?>
        <li<?php if ($_smarty_tpl->getVariable('tab')->value=="modules"){?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
showMyModules.php">My Modules</a></li>
      <?php }?>
      <?php if ($_smarty_tpl->getVariable('user')->value['type']=="Editor"||$_smarty_tpl->getVariable('user')->value['type']=="Admin"){?>
        <li<?php if ($_smarty_tpl->getVariable('tab')->value=="moderate"){?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
moderate.php">Moderate</a></li>
      <?php }?>
      <?php if ($_smarty_tpl->getVariable('user')->value['type']=="Admin"){?>
        <li<?php if ($_smarty_tpl->getVariable('tab')->value=="admin"){?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
admin/index.php">Admin</a></li>
      <?php }?>
    <?php }?>
        <li<?php if ($_smarty_tpl->getVariable('tab')->value=="about"){?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
about.php">About</a></li>
    </ul></div>
</div>
