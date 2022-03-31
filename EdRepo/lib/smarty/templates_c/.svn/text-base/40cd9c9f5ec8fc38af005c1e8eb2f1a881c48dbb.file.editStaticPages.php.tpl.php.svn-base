<?php /* Smarty version Smarty-3.0.7, created on 2014-06-18 15:44:27
         compiled from "E:\XAMPP\xampplite-win32-1.7.3\xampplite\htdocs\xampp\EdRepo\EdRepo\lib\smarty/templates/editStaticPages.php.tpl" */ ?>
<?php /*%%SmartyHeaderCode:567053a1ec1ba765d5-22849671%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '40cd9c9f5ec8fc38af005c1e8eb2f1a881c48dbb' => 
    array (
      0 => 'E:\\XAMPP\\xampplite-win32-1.7.3\\xampplite\\htdocs\\xampp\\EdRepo\\EdRepo\\lib\\smarty/templates/editStaticPages.php.tpl',
      1 => 1362598366,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '567053a1ec1ba765d5-22849671',
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

<?php if ($_smarty_tpl->getVariable('action')->value=="display"){?> 
<p>Select the static page you'd like to edit from the menu below:</p>

<ul>
    <li><a href="editStaticPages.php?action=displayEdit&page=home.html&sub=Edit+Page">Home Page</a></li>
    <li><a href="editStaticPages.php?action=displayEdit&page=about.html&sub=Edit+Page">About Page</a></li>
</ul>
  
<?php }elseif($_smarty_tpl->getVariable('action')->value=="displayEdit"||$_smarty_tpl->getVariable('action')->value=="doEdit"){?> 
<p>Use the editor below to make changes to the content which will be displayed on this collection's <?php echo $_smarty_tpl->getVariable('page')->value['name'];?>
.  Click 
"Save Changes" to save your changes, or "Cancel" to return to the collection configuration panel without saving changes.</p>

<form name="editStaticContentForm" method="post" action="editStaticPages.php">
    <input type="hidden" readonly="readonly" name="action" value="doEdit"></input>
    <input type="hidden" readonly="readonly" name="page" value="<?php echo $_smarty_tpl->getVariable('page')->value['file'];?>
"></input>
    <textarea name="content" style="width: 90%; height: 450px;"><?php echo $_smarty_tpl->getVariable('page')->value['content'];?>
</textarea><br>
    <fieldset class="buttons" style="padding-left: 0">
        <input type="submit" class="button" name="sub" value="Save Changes"></input>
        <a href="index.php" class="button">Cancel</a>
    </fieldset>
</form>

<?php }?> 

<?php if ($_smarty_tpl->getVariable('action')->value!="display"){?><p>Back to <a href="editStaticPages.php">Edit Static Pages menu</a>.</p><?php }?>

<?php }?> 

</div>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
