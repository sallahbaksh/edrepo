<?php /* Smarty version Smarty-3.0.7, created on 2014-06-18 15:45:09
         compiled from "E:\XAMPP\xampplite-win32-1.7.3\xampplite\htdocs\xampp\EdRepo\EdRepo\lib\smarty/templates/configureHeader.php.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2448053a1ec45eeaee7-75267427%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '55a6d775e6a50c3fef5a1e3b6502ca672aebe05b' => 
    array (
      0 => 'E:\\XAMPP\\xampplite-win32-1.7.3\\xampplite\\htdocs\\xampp\\EdRepo\\EdRepo\\lib\\smarty/templates/configureHeader.php.tpl',
      1 => 1337897780,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2448053a1ec45eeaee7-75267427',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<div id="content">

<h1><?php echo (($tmp = @$_smarty_tpl->getVariable('pageName')->value)===null||$tmp==='' ? "404 Error" : $tmp);?>
</h1>

<?php if ($_smarty_tpl->getVariable('loggedIn')->value!="true"){?>
<p>Sorry, you must be logged in as an admin to access this page.</p>

<?php }elseif($_smarty_tpl->getVariable('user')->value['type']!="Admin"){?>
<p>Sorry, you must be an admin to access this page.</p>

<?php }else{ ?>

<?php if ($_smarty_tpl->getVariable('alert')->value['message']!=''){?>
    <p class="alert <?php echo (($tmp = @$_smarty_tpl->getVariable('alert')->value['type'])===null||$tmp==='' ? "positive" : $tmp);?>
">
      <?php if ($_smarty_tpl->getVariable('alert')->value['type']=="negative"){?>
        <img src="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
lib/look/<?php echo $_smarty_tpl->getVariable('LOOK_DIR')->value;?>
/failure.png" alt="Failure: " />
      <?php }else{ ?>
        <img src="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
lib/look/<?php echo $_smarty_tpl->getVariable('LOOK_DIR')->value;?>
/success.png" alt="Success: " />
      <?php }?>
      
        <?php echo $_smarty_tpl->getVariable('alert')->value['message'];?>

    </p>
<?php }?>

<script type="text/javascript" src="../lib/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
    tinyMCE.init({
      // General options
      mode : "textareas",
      theme : "advanced",
      plugins : "pagebreak,style,layer,table,advhr,advimage,advlink,emotions,inlinepopups,insertdatetime,searchreplace,paste,fullscreen,visualchars,nonbreaking,xhtmlxtras",
            
      // Theme options
      theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
      theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
      theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,iespell,media,advhr,|,ltr,rtl,|,fullscreen",
      theme_advanced_buttons4 : "moveforward,movebackward,|,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,blockquote,pagebreak",
      theme_advanced_toolbar_location : "top",
      theme_advanced_toolbar_align : "left",
      theme_advanced_statusbar_location : "bottom",
      theme_advanced_resizing : false,

      // Example content CSS (should be your site CSS)
      //content_css : "../lib/look/default/main.css",

      // Drop lists for link/image/media/template dialogs
      template_external_list_url : "js/template_list.js",
      external_link_list_url : "js/link_list.js",
      external_image_list_url : "js/image_list.js",
      media_external_list_url : "js/media_list.js",

      // Replace values for the template plugin
      //template_replace_values : {
      //  username : "Some User",
      //  staffid : "991234"
      //}
    });
</script>

<?php if ($_smarty_tpl->getVariable('action')->value=="displayEdit"||$_smarty_tpl->getVariable('action')->value=="doEdit"){?> 
<form name="editStaticContentForm" method="post" action="configureHeader.php">
    <input type="hidden" readonly="readonly" name="action" value="doEdit"></input>
    
    <h2>Basic Settings</h2>
    <fieldset>
      <legend>Choose collection logo:</legend>
      <div class="fieldRow" style="">
        <input type="radio" name="logo" value="default"<?php if ($_smarty_tpl->getVariable('HEADER')->value['LOGO']=='default'){?> checked="checked"<?php }?> /> 
        Show default EdRepo logo: 
        <img style="height: 40px; vertical-align: middle" src="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
/lib/look/default/logo.png" alt="Default EdRepo Logo" />
      </div>
      <div class="fieldRow">
        <input type="radio" name="logo" value="text"<?php if ($_smarty_tpl->getVariable('HEADER')->value['LOGO']=='text'){?> checked="checked"<?php }?> /> 
        Show collection name as text: <strong><?php echo (($tmp = @$_smarty_tpl->getVariable('COLLECTION_NAME')->value)===null||$tmp==='' ? 'EdRepo Collection' : $tmp);?>
</strong> (<a href="configureCollection.php">Change</a>)
      </div>      
      <div class="fieldRow">
        <input type="radio" name="logo" value="custom"<?php if ($_smarty_tpl->getVariable('HEADER')->value['LOGO']=='custom'){?> checked="checked"<?php }?> />
        Show custom logo: <strong><?php echo (($tmp = @$_smarty_tpl->getVariable('HEADER')->value['LOGO_NAME'])===null||$tmp==='' ? '' : $tmp);?>
</strong><br />
        <p id="logoFilename" style="margin-left: 30px;">
        Logo filename: <input type="text" name="logoName" value="<?php echo $_smarty_tpl->getVariable('HEADER')->value['LOGO_NAME'];?>
" /><br />
        <strong>Note:</strong> Logo file must exist in active look directory: <strong><?php echo $_smarty_tpl->getVariable('LOOK_DIR')->value;?>
</strong>
        </p>
      </div>
      <div class="fieldRow">
        <p id="iconName">
        Icon filename: <input type="text" name="iconName" value="<?php echo $_smarty_tpl->getVariable('HEADER')->value['ICON_NAME'];?>
" /><br />
        <strong>Note:</strong> Icon file must exist in active look directory: <strong><?php echo $_smarty_tpl->getVariable('LOOK_DIR')->value;?>
</strong>
        </p>
    </fieldset>
    
    
    <h2>Other Content</h2>
    <p>Use the editor below to make changes to the content which will be displayed on this collection's header.  Click 
    "Save Changes" to save your changes, or "Cancel" to return to the collection configuration panel without saving changes.</p>
    
    <textarea name="content" style="width: 90%; height: 200px; margin-left: 10px">
        <?php echo $_smarty_tpl->getVariable('cleanHeaderContent')->value;?>

    </textarea><br>
    <fieldset class="buttons" style="padding-left: 0">
        <input type="submit" class="button" name="sub" value="Save Changes"></input>
        <a href="index.php" class="button">Cancel</a>
    </fieldset>
</form>

<?php }?> 

<?php }?> 

</div>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
