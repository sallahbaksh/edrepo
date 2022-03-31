{*****************************************************************************
    File:       editStaticPages.php.tpl
    Purpose:    Smarty template for EdRepo's "Edit Static Pages" page
    Author:     Jon Thompson
    Date:       9 May 2011
*****************************************************************************}

{include file="header.tpl"}

<div id="content">

<h1>{$pageName|default:"404 Error"}</h1>

{if $loggedIn != "true"}
<p>Sorry, you must be logged in as an admin to access this page.</p>

{elseif $user.type != "Admin"}
<p>Sorry, you must be an admin to access this page.</p>

{else}

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

{if $action == "display"} {* ACTION: DISPLAY *****************************}
<p>Select the static page you'd like to edit from the menu below:</p>

<ul>
    <li><a href="editStaticPages.php?action=displayEdit&page=home.html&sub=Edit+Page">Home Page</a></li>
    <li><a href="editStaticPages.php?action=displayEdit&page=about.html&sub=Edit+Page">About Page</a></li>
</ul>
{* END ACTION: DISPLAY *******************************************************}
  
{elseif $action == "displayEdit" || $action == "doEdit"} {* ACTION: EDIT *****************************}
<p>Use the editor below to make changes to the content which will be displayed on this collection's {$page.name}.  Click 
"Save Changes" to save your changes, or "Cancel" to return to the collection configuration panel without saving changes.</p>

<form name="editStaticContentForm" method="post" action="editStaticPages.php">
    <input type="hidden" readonly="readonly" name="action" value="doEdit"></input>
    <input type="hidden" readonly="readonly" name="page" value="{$page.file}"></input>
    <textarea name="content" style="width: 90%; height: 450px;">{$page.content}</textarea><br>
    <fieldset class="buttons" style="padding-left: 0">
        <input type="submit" class="button" name="sub" value="Save Changes"></input>
        <a href="index.php" class="button">Cancel</a>
    </fieldset>
</form>
{* END ACTION: EDIT *******************************************************}

{/if} {* end 'action' if *}

{if $action != "display"}<p>Back to <a href="editStaticPages.php">Edit Static Pages menu</a>.</p>{/if}

{/if} {* end 'logged in as admin' if *}

</div>

{include file="footer.tpl"}
