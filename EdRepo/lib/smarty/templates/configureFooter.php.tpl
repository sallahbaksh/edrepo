{*****************************************************************************
    File:       configureFooter.php.tpl
    Purpose:    Smarty template for EdRepo's "Configure Footer" page
    Author:     Jon Thompson
    Date:       11 May 2011
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

{if $action == "displayEdit" || $action == "doEdit"} {* ACTION: EDIT ************************}
<form name="editStaticContentForm" method="post" action="configureFooter.php">
    <input type="hidden" readonly="readonly" name="action" value="doEdit"></input>
    <h2>Basic Settings</h2>
    <p>
        <input type="checkbox" name="name" value="TRUE"{if $FOOTER.SHOW_NAME==TRUE} checked="checked"{/if} /> 
        Show collection name: <strong>{$COLLECTION_NAME}</strong><br>
        <input type="checkbox" name="links" value="TRUE"{if $FOOTER.SHOW_LINKS==TRUE} checked="checked"{/if} /> 
        Show menu links.
    </p>
    
    <h2>Other Content</h2>
    <p>Use the editor below to make changes to the content which will be displayed on this collection's footer.  Click 
    "Save Changes" to save your changes, or "Cancel" to return to the collection configuration panel without saving changes.</p>
    <textarea name="content" style="width: 90%; height: 200px; margin-left: 10px">
        {$cleanFooterContent}
    </textarea><br>
    
    <fieldset class="buttons" style="padding-left: 0">
        <input type="submit" class="button" name="sub" value="Save Changes"></input>
        <a href="index.php" class="button">Cancel</a>
    </fieldset>
</form>
{* END ACTION: EDIT *******************************************************}

{/if} {* end 'action' if *}

{/if} {* end 'logged in as admin' if *}

</div>

{include file="footer.tpl"}
