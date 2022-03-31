<?php /* Smarty version Smarty-3.0.7, created on 2014-07-22 14:00:56
         compiled from "E:\XAMPP\xampplite-win32-1.7.3\xampplite\htdocs\xampp\EdRepo\EdRepo\lib\smarty/templates/viewModule.php.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2890253cea6d8891b30-95955224%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '68df0df17938929b15f6453a99b59564465aaeff' => 
    array (
      0 => 'E:\\XAMPP\\xampplite-win32-1.7.3\\xampplite\\htdocs\\xampp\\EdRepo\\EdRepo\\lib\\smarty/templates/viewModule.php.tpl',
      1 => 1406051976,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2890253cea6d8891b30-95955224',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<div id="content">


<script type="text/javascript" src="lib/jquery/jstree/jquery.jstree.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
  
    // retrieve the ids for the "current" tree node and its parent node
    var current = $("#panel .current").attr("id");
    var parent = $("#panel .current").parent().closest("li").attr("id");
    
    // activate hierachy side panel tree
    $("#hierarchy").jstree({ 
      "core": { 
        "initially_open" : [ current, parent ],
        "animation" : 0,
        "load_open" : true
      },
      "themes" : {
        "theme" : "classic",
        "icons" : false        
      },
      "plugins" : [ "themes", "html_data" ]
    });    
    
  
    $('tr.details').hide();
    
    $('a.details').click(function() {
      var rowID = $(this).attr("id");
      $('tr.'+rowID).toggle();
    });
    
  });
</script>


<?php if ((!isset($_smarty_tpl->getVariable('noModule',null,true,false)->value)||$_smarty_tpl->getVariable('noModule')->value==false)&&$_smarty_tpl->getVariable('canViewModule')->value==true){?>
<div id="panel">
<strong>Navigate:</strong> (<a id="ecAll" href="#">+/- all</a>)
<div id="hierarchy">
<?php echo $_smarty_tpl->getVariable('tree')->value;?>

</div>
<?php if (count($_smarty_tpl->getVariable('moduleParents')->value)>0){?>
<hr />
<strong>Referring Modules:</strong>
<ul>
    <?php  $_smarty_tpl->tpl_vars['moduleParent'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('moduleParents')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['moduleParent']->key => $_smarty_tpl->tpl_vars['moduleParent']->value){
?> 
    <li><a href="viewModule.php?moduleID=<?php echo $_smarty_tpl->tpl_vars['moduleParent']->value['moduleID'];?>
"><?php echo $_smarty_tpl->tpl_vars['moduleParent']->value['title'];?>
</a></li>
    <?php }} ?>
</ul>
<?php }?>
</div>
<a id="collapse" title="Show/Hide Side Panel"></a>
<div id="page">
<?php }?>

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

<?php if (isset($_smarty_tpl->getVariable('noModule',null,true,false)->value)&&$_smarty_tpl->getVariable('noModule')->value==true){?>
<h2>Module Not Found</h2>

<p>No module with the specified ID was found.  Please try again with a different ID.</p>

<form name="moduleIDSubmission" action="viewModule.php" method="get">
    <input type="text" name="moduleID"></input>
    <input type="submit" class="button" name="sub" value="View Module"></input>
</form>

<?php }else{ ?> 

<?php if ($_smarty_tpl->getVariable('canViewModule')->value==true){?>
<?php if ($_smarty_tpl->getVariable('module')->value['status']=="InProgress"||$_smarty_tpl->getVariable('module')->value['status']=="PendingModeration"){?>
    <p><span class="note"><strong>Note:  This module is not yet active in this collection.</strong></span>  This module has not yet been published 
    to this collection, and can not be searched for or viewed by most users.  To activate this module, it must be submitted to 
    the collection via the module submission wizard<?php if ($_smarty_tpl->getVariable('NEW_MODULES_REQUIRE_MODERATION')->value==true){?> and approved by a moderator<?php }?>.</p>
    
<?php }else{ ?>
<p class="module-details">
Submitted by <strong><?php echo $_smarty_tpl->getVariable('submitter')->value['firstName'];?>
 <?php echo $_smarty_tpl->getVariable('submitter')->value['lastName'];?>
</strong> on <strong><?php echo $_smarty_tpl->getVariable('module')->value['dateTime'];?>
</strong>.
<?php if ($_smarty_tpl->getVariable('ENABLE_VERSIONS')->value==true){?>&nbsp;&nbsp;&nbsp;<strong>Version <?php echo $_smarty_tpl->getVariable('module')->value['version'];?>
</strong><?php }?>
</p>
<?php }?>

<?php if ($_smarty_tpl->getVariable('canEditModule')->value==true){?>
<p style="text-align:right">
<a class="button" href="moduleWizard/index.php?moduleID=<?php echo $_smarty_tpl->getVariable('module')->value['moduleID'];?>
&moduleAction=edit">Edit</a>
</p>
<?php }?>

<div class="section">
<h2 class="description">Description</h2>
<p><?php echo $_smarty_tpl->getVariable('module')->value['description'];?>
</p>
</div>

<?php if ($_smarty_tpl->getVariable('CheckInComments')->value!=''&&$_smarty_tpl->getVariable('canSeeComments')->value==true){?>
<div class="section">
<h2 class="description">Check-In Comments</h2>
<p><?php echo $_smarty_tpl->getVariable('CheckInComments')->value;?>
</p>
</div>
<?php }?>

<div class="section">
<h2>General Information</h2>

<table class="MIV">
    <?php if ($_smarty_tpl->getVariable('showAuthors')->value==true){?>
    <tr><td class="highlight" rowspan="<?php echo count($_smarty_tpl->getVariable('authors')->value);?>
">Authors</td>
    <td><?php echo $_smarty_tpl->getVariable('authors')->value[0];?>
</td></tr> 
    <?php  $_smarty_tpl->tpl_vars['author'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('authors')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['author']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['author']->key => $_smarty_tpl->tpl_vars['author']->value){
 $_smarty_tpl->tpl_vars['author']->index++;
?> 
      <?php if ($_smarty_tpl->tpl_vars['author']->index>0){?>
      <tr><td><?php echo $_smarty_tpl->tpl_vars['author']->value;?>
</td></tr>
      <?php }?>
    <?php }} ?>
    <?php }?>

	<tr><td class="highlight">Language</td><td>
		<?php if ($_smarty_tpl->getVariable('module')->value['language']=="chi"){?>
			Chinese
		<?php }?>
		<?php if ($_smarty_tpl->getVariable('module')->value['language']=="eng"){?>
			English
		<?php }?>
		<?php if ($_smarty_tpl->getVariable('module')->value['language']=="fra"){?>
			France
		<?php }?>
		<?php if ($_smarty_tpl->getVariable('module')->value['language']=="ger"){?>
			German
		<?php }?>
		<?php if ($_smarty_tpl->getVariable('module')->value['language']=="hin"){?>
			Hindi
		<?php }?>
		<?php if ($_smarty_tpl->getVariable('module')->value['language']=="ita"){?>
			Italian
		<?php }?>
		<?php if ($_smarty_tpl->getVariable('module')->value['language']=="jpn"){?>
			Japanese
		<?php }?>
		<?php if ($_smarty_tpl->getVariable('module')->value['language']=="rus"){?>
			Russian
		<?php }?>
		<?php if ($_smarty_tpl->getVariable('module')->value['language']=="spa"){?>
			Spanish
		<?php }?>
		<?php if ($_smarty_tpl->getVariable('module')->value['language']=="zxx"){?>
			No linguistic content
		<?php }?>
	</td></tr>
	<tr><td class="highlight">Education Level</td><td><?php echo $_smarty_tpl->getVariable('module')->value['educationLevel'];?>
</td></tr>
	
	<tr><td class="highlight">Interactivity Type</td><td><?php echo $_smarty_tpl->getVariable('module')->value['interactivityType'];?>
</td></tr>
	
	<?php if ($_smarty_tpl->getVariable('module')->value['minutes']!=0){?><tr><td class="highlight">Minutes</td><td><?php echo $_smarty_tpl->getVariable('module')->value['minutes'];?>
</td></tr><?php }?>
  
	<tr><td class="highlight">Rights</td><td><?php echo $_smarty_tpl->getVariable('module')->value['rights'];?>
</td></tr>
	
	<tr><td class="highlight">Restrictions to</td><td><?php echo $_smarty_tpl->getVariable('module')->value['restrictions'];?>
</td></tr>
    
    <?php if ($_smarty_tpl->getVariable('showCategories')->value==true){?>
    <tr><td class="highlight" rowspan="<?php echo count($_smarty_tpl->getVariable('categoryNames')->value);?>
">Categories</td>
    <td><?php echo $_smarty_tpl->getVariable('categoryNames')->value[0];?>
</td></tr> 
    <?php  $_smarty_tpl->tpl_vars['categoryName'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('categoryNames')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['categoryName']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['categoryName']->key => $_smarty_tpl->tpl_vars['categoryName']->value){
 $_smarty_tpl->tpl_vars['categoryName']->index++;
?> 
      <?php if ($_smarty_tpl->tpl_vars['categoryName']->index>0){?>
      <tr><td><?php echo $_smarty_tpl->tpl_vars['categoryName']->value;?>
</td></tr>
      <?php }?>
    <?php }} ?>
    <?php }?>
    
    <?php if ($_smarty_tpl->getVariable('showTypes')->value==true){?>
    <tr><td class="highlight" rowspan="<?php echo count($_smarty_tpl->getVariable('typeNames')->value);?>
">Types</td>
    <td><?php echo $_smarty_tpl->getVariable('typeNames')->value[0];?>
</td></tr> 
    <?php  $_smarty_tpl->tpl_vars['typeName'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('typeNames')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['typeName']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['typeName']->key => $_smarty_tpl->tpl_vars['typeName']->value){
 $_smarty_tpl->tpl_vars['typeName']->index++;
?> 
      <?php if ($_smarty_tpl->tpl_vars['typeName']->index>0){?>
      <tr><td><?php echo $_smarty_tpl->tpl_vars['typeName']->value;?>
</td></tr>
      <?php }?>
    <?php }} ?>
    <?php }?>
    
    <?php if ($_smarty_tpl->getVariable('module')->value['authorComments']!=''){?><tr><td class="highlight">Comments</td><td><?php echo $_smarty_tpl->getVariable('module')->value['authorComments'];?>
</td></tr><?php }?>
    
    <?php if ($_smarty_tpl->getVariable('readRatings')->value==true){?>
    <tr><td class="highlight">Module Rating</td><td>
      <?php if ($_smarty_tpl->getVariable('ratings')->value['numberOfRatings']<=0){?> 
          This module has not yet been rated.
      <?php }else{ ?> 
          <?php echo round($_smarty_tpl->getVariable('ratings')->value['rating']/$_smarty_tpl->getVariable('ratings')->value['numberOfRatings'],2);?>
 of 5 (out of <?php echo $_smarty_tpl->getVariable('ratings')->value['numberOfRatings'];?>
 total ratings)
      <?php }?>
      
      <?php if ($_smarty_tpl->getVariable('writeRatings')->value==true&&$_smarty_tpl->getVariable('module')->value['status']=="Active"){?>
        <?php if ($_smarty_tpl->getVariable('loggedIn')->value=="true"){?>
        &nbsp;<a href="rate.php?moduleID=<?php echo $_smarty_tpl->getVariable('module')->value['moduleID'];?>
">Leave a Rating</a>
        <?php }else{ ?>
        &nbsp;<a href="loginLogout.php">Login to leave ratings.</a>
        <?php }?>
      <?php }?>
    <?php }?>
    </td></tr>
	
</table>
</div>

<?php if (count($_smarty_tpl->getVariable('topics')->value)>0||count($_smarty_tpl->getVariable('objectives')->value)>0||count($_smarty_tpl->getVariable('prereqs')->value)>0){?>
<div class="section">
<h2>Topics, Objectives, and Prerequisites</h2>
<table class="MIV">
<?php if (count($_smarty_tpl->getVariable('topics')->value)>=1){?>
    <tr><td class="highlight" rowspan="<?php echo count($_smarty_tpl->getVariable('topics')->value);?>
">Topics</td>
    <td><?php echo $_smarty_tpl->getVariable('topics')->value[0]['text'];?>
</td></tr> 
    <?php  $_smarty_tpl->tpl_vars['topic'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('topics')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['topic']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['topic']->key => $_smarty_tpl->tpl_vars['topic']->value){
 $_smarty_tpl->tpl_vars['topic']->index++;
?> 
      <?php if ($_smarty_tpl->tpl_vars['topic']->index>0){?>
      <tr><td><?php echo $_smarty_tpl->tpl_vars['topic']->value['text'];?>
</td></tr>
      <?php }?>
    <?php }} ?>
<?php }?>

<?php if (count($_smarty_tpl->getVariable('objectives')->value)>=1){?>
    <tr><td class="highlight" rowspan="<?php echo count($_smarty_tpl->getVariable('objectives')->value);?>
">Objectives</td>
    <td><?php echo $_smarty_tpl->getVariable('objectives')->value[0]['text'];?>
</td></tr> 
    <?php  $_smarty_tpl->tpl_vars['objective'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('objectives')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['objective']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['objective']->key => $_smarty_tpl->tpl_vars['objective']->value){
 $_smarty_tpl->tpl_vars['objective']->index++;
?> 
      <?php if ($_smarty_tpl->tpl_vars['objective']->index>0){?>
      <tr><td><?php echo $_smarty_tpl->tpl_vars['objective']->value['text'];?>
</td></tr>
      <?php }?>
    <?php }} ?>
<?php }?>

<?php if (count($_smarty_tpl->getVariable('prereqs')->value)>=1){?>
    <tr><td class="highlight" rowspan="<?php echo count($_smarty_tpl->getVariable('prereqs')->value);?>
">Prerequisites</td>
    <td><?php echo $_smarty_tpl->getVariable('prereqs')->value[0]['text'];?>
</td></tr> 
    <?php  $_smarty_tpl->tpl_vars['prereq'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('prereqs')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['prereq']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['prereq']->key => $_smarty_tpl->tpl_vars['prereq']->value){
 $_smarty_tpl->tpl_vars['prereq']->index++;
?> 
      <?php if ($_smarty_tpl->tpl_vars['prereq']->index>0){?>
      <tr><td><?php echo $_smarty_tpl->tpl_vars['prereq']->value['text'];?>
</td></tr>
      <?php }?>
    <?php }} ?>
<?php }?>
</table>
</div>
<?php }?>

<?php if (count($_smarty_tpl->getVariable('moduleChildren')->value)>0){?>
<div class="section">
<h2>Attached Modules</h2>
  <ul>
    <?php  $_smarty_tpl->tpl_vars['moduleChild'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('moduleChildren')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['moduleChild']->key => $_smarty_tpl->tpl_vars['moduleChild']->value){
?> 
      <li><a href="viewModule.php?moduleID=<?php echo $_smarty_tpl->tpl_vars['moduleChild']->value['moduleID'];?>
&root=<?php echo $_smarty_tpl->getVariable('root')->value;?>
"><?php echo $_smarty_tpl->tpl_vars['moduleChild']->value['title'];?>
</a></li>
    <?php }} ?>
  </ul>
</table>
</div>
<?php }?>

<?php if (count($_smarty_tpl->getVariable('seeAlso')->value)>0){?>
<div class="section">
  <h2>See Also...</h2>
  <table>
    <thead>
      <tr>
        <th>Module Title</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
    <?php  $_smarty_tpl->tpl_vars['ref'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('seeAlso')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['ref']->key => $_smarty_tpl->tpl_vars['ref']->value){
?>
      <tr>
        <td><a href="viewModule.php?moduleID=<?php echo $_smarty_tpl->tpl_vars['ref']->value['referencedModuleID'];?>
"><?php echo $_smarty_tpl->tpl_vars['ref']->value['title'];?>
</a></td>
        <td><?php echo $_smarty_tpl->tpl_vars['ref']->value['description'];?>
</td>
      </tr>
    <?php }} ?>
    </tbody>
  </table>
</div>
<?php }?>

<?php if (count($_smarty_tpl->getVariable('externalReferences')->value)>0){?>
<div class="section">
  <h2>External References</h2>
  <dl>
  <?php  $_smarty_tpl->tpl_vars['ref'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('externalReferences')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['ref']->key => $_smarty_tpl->tpl_vars['ref']->value){
?>
    <dt><strong><?php echo $_smarty_tpl->tpl_vars['ref']->value['link'];?>
</strong></dt>
      <dd><?php echo $_smarty_tpl->tpl_vars['ref']->value['description'];?>
</dd>
  <?php }} ?>
  </dl>
</div>
<?php }?>

<?php if ($_smarty_tpl->getVariable('showMaterials')->value==true){?>
<div class="section">
<h2>Materials</h2>
<?php if (count($_smarty_tpl->getVariable('materials')->value)<=0){?>
<p>This module contains no materials.</p>

<?php }else{ ?> 
<table class="MIV">
    <thead>
    <tr>
      <th></th>
      <th>Title</th>
      <th>Type</th>
      <th>Download/View</th>
    </tr>
    </thead>
    <tbody>
  <?php  $_smarty_tpl->tpl_vars['material'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('materialInfo')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['material']->key => $_smarty_tpl->tpl_vars['material']->value){
?>
    <tr>
      <td><a class="button details" id="details-<?php echo $_smarty_tpl->tpl_vars['material']->value['materialID'];?>
" title="Show/Hide Details">+</a></td>
      <td><strong><?php echo $_smarty_tpl->tpl_vars['material']->value['name'];?>
</strong></td>
      <td>
        <?php if ($_smarty_tpl->tpl_vars['material']->value['type']=="LocalFile"){?>
          <?php echo $_smarty_tpl->tpl_vars['material']->value['format'];?>

        <?php }elseif($_smarty_tpl->tpl_vars['material']->value['type']=="ExternalURL"){?>
          URL
        <?php }else{ ?>
          <?php echo $_smarty_tpl->tpl_vars['material']->value['type'];?>

        <?php }?>
      </td>
      <td><a href="viewMaterial.php?materialID=<?php echo $_smarty_tpl->tpl_vars['material']->value['materialID'];?>
" class="button">
        <?php if ($_smarty_tpl->tpl_vars['material']->value['type']=="LocalFile"){?>Download<?php }else{ ?>View<?php }?>
      </a></td>
    </tr>
    <tr class="details details-<?php echo $_smarty_tpl->tpl_vars['material']->value['materialID'];?>
">
      <td></td>
      <td colspan="3" style="padding-left: 15px;">
        <?php if ($_smarty_tpl->tpl_vars['material']->value['type']=="LocalFile"){?><strong>Filename:</strong> <?php echo $_smarty_tpl->tpl_vars['material']->value['readableFileName'];?>
<?php }else{ ?><strong>Content:</strong> <?php echo $_smarty_tpl->tpl_vars['material']->value['content'];?>
<?php }?><br />
        <?php if ($_smarty_tpl->getVariable('readRateMaterials')->value==true){?>
        <strong>Rating:</strong>  
          <?php if ($_smarty_tpl->tpl_vars['material']->value['numRatings']<=0){?>
          This material has not been rated yet.
          <?php }else{ ?>
          <?php echo $_smarty_tpl->tpl_vars['material']->value['averageRating'];?>
 out of 5 (out of <?php echo $_smarty_tpl->tpl_vars['material']->value['numRatings'];?>
 total ratings).
          <?php }?>
          
          <?php if ($_smarty_tpl->getVariable('writeRateMaterials')->value==true&&$_smarty_tpl->getVariable('module')->value['status']=="Active"){?>
            <?php if ($_smarty_tpl->getVariable('loggedIn')->value=="true"){?>
            &nbsp;<a href="rate.php?moduleID=<?php echo $_smarty_tpl->getVariable('module')->value['moduleID'];?>
&materialID=<?php echo $_smarty_tpl->tpl_vars['material']->value['materialID'];?>
">Leave a Rating</a>
            <?php }else{ ?>
            &nbsp;<a href="loginLogout.php">Login to leave ratings.</a>
            <?php }?>
          <?php }?>
        <?php }?>
      </td>
    </tr>
  <?php }} ?>
  </tbody>
</table>
<?php }?> 
</div>

<?php }?> 
</div> <!-- end div id="page" -->
<?php }else{ ?> 
<h2>Insufficient Privileges To View This Module</h2>
<p>You do not have enough permissions to view this module.  Log out and log back in with the right privilege level to view this 
module.</p>

<?php }?> 


<?php }?> 

</div>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>