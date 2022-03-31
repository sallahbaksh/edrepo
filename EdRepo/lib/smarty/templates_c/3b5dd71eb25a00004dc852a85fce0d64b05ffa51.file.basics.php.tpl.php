<?php /* Smarty version Smarty-3.0.7, created on 2017-01-13 12:12:46
         compiled from "/var/www/html/EdRepo/EdRepo/lib/smarty/templates/moduleWizard/basics.php.tpl" */ ?>
<?php /*%%SmartyHeaderCode:116024226858790a8ebebcb7-01244828%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3b5dd71eb25a00004dc852a85fce0d64b05ffa51' => 
    array (
      0 => '/var/www/html/EdRepo/EdRepo/lib/smarty/templates/moduleWizard/basics.php.tpl',
      1 => 1484321121,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '116024226858790a8ebebcb7-01244828',
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

<?php if ($_smarty_tpl->getVariable('hasPermission')->value==true&&$_smarty_tpl->getVariable('moduleAction')->value!="error"){?>

<?php if ($_smarty_tpl->getVariable('moduleAction')->value=="createNewVersion"){?>
<p><strong>Warning:</strong> You are about to create a new version of a previous module. 
If you didn't intend to do this, click the "Exit" button in the sidebar or simply 
<a href="../showMyModules.php">return to My Modules</a>.</p>
<?php }?>
<?php if ($_smarty_tpl->getVariable('moduleAction')->value=="copy"){?>
<p><strong>Warning:</strong> You are about to create a copy of a previous module. 
If you didn't intend to do this, click the "Exit" button in the sidebar or simply 
<a href="../showMyModules.php">return to My Modules</a>.</p>
<?php }?>

<div id="wizard">
<?php $_template = new Smarty_Internal_Template("moduleWizard/wizardNav.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?> 

<script type="text/javascript" src="../lib/jquery/check-changes.js"></script>
<?php $_template = new Smarty_Internal_Template("moduleWizard/moduleWizard-js.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<!-- JQuery Function that allows auto-complete search for titles that gives the ID for the title you created -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script>
function autoComplete(id) {
    var auto = [];
    auto = <?php echo json_encode($_smarty_tpl->getVariable('auto')->value);?>
;
    $(id).autocomplete({
        source:auto,
        select: function(event, ui) {
            var value = $(id).val();
            $('#submitterValue').val(value);
        }
    });
}
</script>

<div id="wizard-form">
  <form method="post" class="tabular" action="index.php">  
    <input type="hidden" readonly="readonly" name="moduleID" value="<?php echo (($tmp = @$_smarty_tpl->getVariable('moduleInfo')->value['moduleID'])===null||$tmp==='' ? '' : $tmp);?>
"></input>
    <input type="hidden" readonly="readonly" name="moduleAction" value="<?php echo $_smarty_tpl->getVariable('moduleAction')->value;?>
"></input>
    
    <input type="hidden" name="noModuleAuthors" value="true" id="noModuleAuthors"></input>
    <input type="hidden" name="noModuleTopics" value="true" id="noModuleTopics"></input>
    <input type="hidden" name="noModuleObjectives" value="true" id="noModuleObjectives"></input>
    <input type="hidden" name="noModulePrereqs" value="true" id="noModulePrereqs"></input>
    <input type="hidden" name="noModuleCategories" value="true" id="noModuleCategories"></input>
    <input type="hidden" name="noModuleTypes" value="true" id="noModuleTypes"></input>
    
    <div class="fieldRow">
      <label><h3>Module Title</h3></label>
      <div class="fieldInput">
		<textarea name="moduleTitle" type="text" <?php if ($_smarty_tpl->getVariable('moduleAction')->value=="createNewVersion"||$_smarty_tpl->getVariable('moduleAction')->value=="edit"){?> disabled="disabled" title="Module title cannot be changed after creation."<?php }?>><?php echo (($tmp = @$_smarty_tpl->getVariable('moduleInfo')->value['title'])===null||$tmp==='' ? '' : $tmp);?>
</textarea>
      </div>
    </div>

	<?php if ($_smarty_tpl->getVariable('type')->value=="Admin"&&$_smarty_tpl->getVariable('moduleAction')->value=="edit"){?>
    <div class="fieldRow">
      <label><h3>Submitter</h3><p>Search User's Name or Email.</p></label>
      <div class = "fieldInput">
		<input id="submitter" type="text" onfocus="autoComplete('#submitter')" value="<?php echo (($tmp = @$_smarty_tpl->getVariable('submitter')->value['firstName'])===null||$tmp==='' ? '' : $tmp);?>
 <?php echo (($tmp = @$_smarty_tpl->getVariable('submitter')->value['lastName'])===null||$tmp==='' ? '' : $tmp);?>
" name="submitter"/>
      </div>
    </div>
    <?php }?>
	
    <div class="fieldRow">
        <label><h3>Description</h3><p>A description of this module.</p></label>
        <div class="fieldInput"><textarea name="moduleDescription" style="width: 100%;"><?php echo (($tmp = @$_smarty_tpl->getVariable('moduleInfo')->value['description'])===null||$tmp==='' ? '' : $tmp);?>
</textarea></div>
    </div>

    <div class="fieldRow">
        <label>
            <h3>Authors</h3>
            <p>You may add as many authors to this module as you wish.  By default, you are the only author.</p>
        </label>
        <div class="fieldInput">
            <div id="AuthorsList"></div>
            <a class="button" onclick="add('Authors', '');">Add Author</a>
        </div>
    </div>

    <div class="fieldRow">
      <label><h3>Language</h3><p>The language corresponding to the module's content.</p></label>
      <div class="fieldInput">
      <select name="moduleLanguage" size="1">
        <option value="chi" <?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['language'])&&$_smarty_tpl->getVariable('moduleInfo')->value['language']=="chi"){?> selected="selected"<?php }?>>Chinese</option>
        <option value="eng" <?php if ((isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['language'])&&$_smarty_tpl->getVariable('moduleInfo')->value['language']=="eng")||!isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['language'])){?> selected="selected"<?php }?>>English</option>
        <option value="fra" <?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['language'])&&$_smarty_tpl->getVariable('moduleInfo')->value['language']=="fra"){?> selected="selected"<?php }?>>French</option>
        <option value="ger" <?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['language'])&&$_smarty_tpl->getVariable('moduleInfo')->value['language']=="ger"){?> selected="selected"<?php }?>>German</option>
        <option value="hin" <?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['language'])&&$_smarty_tpl->getVariable('moduleInfo')->value['language']=="hin"){?> selected="selected"<?php }?>>Hindi</option>
        <option value="ita" <?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['language'])&&$_smarty_tpl->getVariable('moduleInfo')->value['language']=="ita"){?> selected="selected"<?php }?>>Italian</option>
        <option value="jpn" <?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['language'])&&$_smarty_tpl->getVariable('moduleInfo')->value['language']=="jpn"){?> selected="selected"<?php }?>>Japanese</option>
        <option value="rus" <?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['language'])&&$_smarty_tpl->getVariable('moduleInfo')->value['language']=="rus"){?> selected="selected"<?php }?>>Russian</option>
        <option value="spa" <?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['language'])&&$_smarty_tpl->getVariable('moduleInfo')->value['language']=="spa"){?> selected="selected"<?php }?>>Spanish</option>
        <option value="zxx" <?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['language'])&&$_smarty_tpl->getVariable('moduleInfo')->value['language']=="zxx"){?> selected="selected"<?php }?>>No Linguistic Content</option>			
      </select>
      </div>
    </div>
	
	
	<div class="fieldRow">
		<label><h3>Restrictions By Group</h3><p>This module will only be visible to the group selected. (Default: None)</p></label>
		<div class="fieldInput">
		<select name="restrictions" size="1">
			<option value="None" <?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['restrictions'])&&$_smarty_tpl->getVariable('moduleInfo')->value['restrictions']=="None"){?> selected="selected"<?php }?>>None</option>
			<option value="Student" <?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['restrictions'])&&$_smarty_tpl->getVariable('moduleInfo')->value['restrictions']=="Student"){?> selected="selected"<?php }?>>Student</option>
			<option value="Teacher" <?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['restrictions'])&&$_smarty_tpl->getVariable('moduleInfo')->value['restrictions']=="Teacher"){?> selected="selected"<?php }?>>Teacher</option>
			<option value="Professor" <?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['restrictions'])&&$_smarty_tpl->getVariable('moduleInfo')->value['restrictions']=="Professor"){?> selected="selected"<?php }?>>Professor</option>
			<option value="Principal" <?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['restrictions'])&&$_smarty_tpl->getVariable('moduleInfo')->value['restrictions']=="Principal"){?> selected="selected"<?php }?>>Principal</option>
			<option value="Dean" <?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['restrictions'])&&$_smarty_tpl->getVariable('moduleInfo')->value['restrictions']=="Dean"){?> selected="selected"<?php }?>>Dean</option>
			<option value="President" <?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['restrictions'])&&$_smarty_tpl->getVariable('moduleInfo')->value['restrictions']=="President"){?> selected="selected"<?php }?>>President</option>
			<option value="Admin" <?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['restrictions'])&&$_smarty_tpl->getVariable('moduleInfo')->value['restrictions']=="Admin"){?> selected="selected"<?php }?>>Admin</option>
		</select>
		</div>
	</div>
			
    <div class="fieldRow">
      <label><h3>Educational Level</h3><p>The educational level that the module is targeted towards.</p></label>
      <div class="fieldInput">
      <select name="moduleEducationLevel" size="1">
        <option<?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['educationLevel'])&&$_smarty_tpl->getVariable('moduleInfo')->value['educationLevel']=="Pre-Kindergarten"){?> selected="selected"<?php }?>>Pre-Kindergarten</option>
        <option<?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['educationLevel'])&&$_smarty_tpl->getVariable('moduleInfo')->value['educationLevel']=="Elementary School"){?> selected="selected"<?php }?>>Elementary</option>
        <option<?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['educationLevel'])&&$_smarty_tpl->getVariable('moduleInfo')->value['educationLevel']=="Middle School"){?> selected="selected"<?php }?>>Middle School</option>
        <option<?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['educationLevel'])&&$_smarty_tpl->getVariable('moduleInfo')->value['educationLevel']=="High School"){?> selected="selected"<?php }?>>High School</option>
        <option<?php if ((isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['educationLevel'])&&$_smarty_tpl->getVariable('moduleInfo')->value['educationLevel']=="Higher Education")||!isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['educationLevel'])){?> selected="selected"<?php }?>>Higher Education</option>
        <option<?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['educationLevel'])&&$_smarty_tpl->getVariable('moduleInfo')->value['educationLevel']=="Informal"){?> selected="selected"<?php }?>>Informal</option>
        <option<?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['educationLevel'])&&$_smarty_tpl->getVariable('moduleInfo')->value['educationLevel']=="Vocational"){?> selected="selected"<?php }?>>Vocational</option>
      </select>
      </div>
    </div>

    <div class="fieldRow">
      <label>
          <h3>Minutes</h3>
          <p>You may specify how long this module takes to complete in minutes. If length in minutes does not apply, please enter '0'.</p>
      </label>
      <div class="fieldInput">
        <input type="text" maxlength="150" name="moduleMinutes" value="<?php echo (($tmp = @$_smarty_tpl->getVariable('moduleInfo')->value['minutes'])===null||$tmp==='' ? '0' : $tmp);?>
"></input><br />
        <br />
      </div>
    </div>
    
    <div class="fieldRow">
    <label><h3>Types</h3></label>
      <div class="fieldInput">
        <div id="TypesList"></div>
        <a class="button" onclick="add('Types', 0);">Add Type</a>
      </div>
    </div>
    
    
    <div class="fieldRow">
      <label><h3>Categories</h3></label>
      <div class="fieldInput">
        <div id="CategoriesList"></div>
        <a class="button" onclick="add('Categories', 0);">Add Category</a>
      </div>
    </div>
    
    <div class="fieldRow">
      <label><h3>Topics</h3></label>
      <div class="fieldInput">
        <div id="TopicsList"></div>
        <a class="button" onclick="add('Topics', '');">Add Topic</a>
      </div>
    </div>
  
    <div class="fieldRow">
      <label><h3>Objectives</h3></label>
      <div class="fieldInput">
        <div id="ObjectivesList"></div>
        <a class="button" onclick="add('Objectives', '');">Add Objective</a>
      </div>
    </div>
    
    <div class="fieldRow">
      <label><h3>Prerequisites</h3></label>
      <div class="fieldInput">
        <div id="PrereqsList"></div>
        <a class="button" onclick="add('Prereqs', '');">Add Prerequisite</a>
      </div>
    </div>

    <div class="fieldRow">
      <label><h3>Interactivity Type</h3><p>The state of interaction the user can expect with the module.</p></label>
      <div class="fieldInput">
        <select name="moduleInteractivityType" size="1">
          <option <?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['interactivityType'])&&$_smarty_tpl->getVariable('moduleInfo')->value['interactivityType']=="Active"){?> selected="selected"<?php }?>>Active</option>
          <option <?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['interactivityType'])&&$_smarty_tpl->getVariable('moduleInfo')->value['interactivityType']=="Expositive"){?> selected="selected"<?php }?>>Expositive</option>
          <option <?php if (isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['interactivityType'])&&$_smarty_tpl->getVariable('moduleInfo')->value['interactivityType']=="Mixed"){?> selected="selected"<?php }?>>Mixed</option>
          <option <?php if ((isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['interactivityType'])&&$_smarty_tpl->getVariable('moduleInfo')->value['interactivityType']=="Undefined")||!isset($_smarty_tpl->getVariable('moduleInfo',null,true,false)->value['interactivityType'])){?> selected="selected"<?php }?>>Undefined</option>
        </select>
      </div>
    </div>

    <div class="fieldRow">
        <label><h3>Rights</h3><p>A statement describing property rights associated with this resource (e.g. copyright).</p></label>
        <div class="fieldInput"><textarea name="moduleRights" style="width: 100%;"><?php echo (($tmp = @$_smarty_tpl->getVariable('moduleInfo')->value['rights'])===null||$tmp==='' ? 'This work is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License.' : $tmp);?>
</textarea></div>
    </div>
        
    <fieldset class="buttons">
      <input type="submit" name="submit" class="button" value="<?php if ($_smarty_tpl->getVariable('moduleAction')->value=="create"){?>Save New Module<?php }elseif($_smarty_tpl->getVariable('moduleAction')->value=="createNewVersion"){?>Save New Version<?php }elseif($_smarty_tpl->getVariable('moduleAction')->value=="copy"){?>Create Copy<?php }else{ ?>Save Module<?php }?>" />
      <input type="reset" class="button" value="Reset" />
	  <?php if ($_smarty_tpl->getVariable('moduleAction')->value=="edit"){?>
	  <?php if ($_smarty_tpl->getVariable('ENABLE_VERSIONS')->value==true){?><a class="button" href="index.php?moduleAction=createNewVersion&moduleID=<?php echo $_smarty_tpl->getVariable('moduleID')->value;?>
">Create A New Version</a><?php }?>
	  <a class="button" href="index.php?moduleAction=copy&moduleID=<?php echo $_smarty_tpl->getVariable('moduleID')->value;?>
">Create A Copy</a>
    <a class="button" href="index.php?moduleAction=export&moduleID=<?php echo $_smarty_tpl->getVariable('moduleID')->value;?>
">Export</a>
	  <?php }?>
    </fieldset>
  </form>
</div>

</div>
<?php }?> 

</div>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>