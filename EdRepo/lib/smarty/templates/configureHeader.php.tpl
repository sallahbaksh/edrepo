{*****************************************************************************
    File:       configureHeader.php.tpl
    Purpose:    Smarty template for EdRepo's "Configure Header" page
    Author:     Jon Thompson
    Date:       10 May 2011
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
<form name="editStaticContentForm" method="post" action="configureHeader.php">
    <input type="hidden" readonly="readonly" name="action" value="doEdit"></input>
    
    <h2>Basic Settings</h2>
    <fieldset>
      <legend>Choose collection logo:</legend>
      <div class="fieldRow" style="">
        <input type="radio" name="logo" value="default"{if $HEADER.LOGO == 'default'} checked="checked"{/if} /> 
        Show default EdRepo logo: 
        <img style="height: 40px; vertical-align: middle" src="{$baseDir}/lib/look/default/logo.png" alt="Default EdRepo Logo" />
      </div>
      <div class="fieldRow">
        <input type="radio" name="logo" value="text"{if $HEADER.LOGO == 'text'} checked="checked"{/if} /> 
        Show collection name as text: <strong>{$COLLECTION_NAME|default:'EdRepo Collection'}</strong> (<a href="configureCollection.php">Change</a>)
      </div>      
      <div class="fieldRow">
        <input type="radio" name="logo" value="custom"{if $HEADER.LOGO == 'custom'} checked="checked"{/if} />
        Show custom logo: <strong>{$HEADER.LOGO_NAME|default:''}</strong><br />
        <p id="logoFilename" style="margin-left: 30px;">
        Logo filename: <input type="text" name="logoName" value="{$HEADER.LOGO_NAME}" /><br />
        <strong>Note:</strong> Logo file must exist in active look directory: <strong>{$LOOK_DIR}</strong>
        </p>
      </div>
      <div class="fieldRow">
        <p id="iconName">
        Icon filename: <input type="text" name="iconName" value="{$HEADER.ICON_NAME}" /><br />
        <strong>Note:</strong> Icon file must exist in active look directory: <strong>{$LOOK_DIR}</strong>
        </p>
    </fieldset>
    
    
    <h2>Other Content</h2>
    <p>Use the editor below to make changes to the content which will be displayed on this collection's header.  Click 
    "Save Changes" to save your changes, or "Cancel" to return to the collection configuration panel without saving changes.</p>
    
    <textarea name="content" style="width: 90%; height: 200px; margin-left: 10px">
        {$cleanHeaderContent}
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
