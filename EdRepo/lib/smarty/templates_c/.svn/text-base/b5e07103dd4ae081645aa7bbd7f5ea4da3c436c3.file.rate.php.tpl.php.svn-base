<?php /* Smarty version Smarty-3.0.7, created on 2014-07-18 11:32:13
         compiled from "E:\XAMPP\xampplite-win32-1.7.3\xampplite\htdocs\xampp\EdRepo\EdRepo\lib\smarty/templates/rate.php.tpl" */ ?>
<?php /*%%SmartyHeaderCode:520253c93dfd227248-52925873%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b5e07103dd4ae081645aa7bbd7f5ea4da3c436c3' => 
    array (
      0 => 'E:\\XAMPP\\xampplite-win32-1.7.3\\xampplite\\htdocs\\xampp\\EdRepo\\EdRepo\\lib\\smarty/templates/rate.php.tpl',
      1 => 1405697530,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '520253c93dfd227248-52925873',
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

<?php if ($_smarty_tpl->getVariable('loggedIn')->value!=true){?>
<h2>You Must Be Logged In To Continue</h2>
<p>Only registered, logged in users may rate materials or modules.  Please <a href="loginLogout.php">log in</a> to continue.</p>

<?php }else{ ?> 

<?php if (isset($_smarty_tpl->getVariable('showRateModule',null,true,false)->value)==true&&$_smarty_tpl->getVariable('showRateModule')->value==true){?>
<h2>Leave A Rating For Module <?php echo $_smarty_tpl->getVariable('module')->value['title'];?>
 version <?php echo $_smarty_tpl->getVariable('module')->value['version'];?>
</h2>
<p>Rate this module on a scale of 0 to 5, with 0 being the the lowest rating and 5 being the best.</p>
<form name="mainForm" action="rate.php" method="post">
    <input type="hidden" readonly="readonly" name="action" value="doRate"></input>
    <input type="hidden" readonly="readonly" name="moduleID" value="<?php echo $_smarty_tpl->getVariable('module')->value['moduleID'];?>
"></input>
    <input type="radio" name="rating" value="0"></input>0 &nbsp;
    <input type="radio" name="rating" value="1"></input>1 &nbsp;
    <input type="radio" name="rating" value="2"></input>2 &nbsp;
    <input type="radio" name="rating" value="3"></input>3 &nbsp;
    <input type="radio" name="rating" value="4"></input>4 &nbsp;
    <input type="radio" name="rating" value="5"></input>5<br /><br />
    <fieldset class="buttons" style="padding-left: 0"><input type="submit" class="button" name="submit" value="Rate This Module"></input>
    <a class="button" href="viewModule.php?moduleID=<?php echo $_smarty_tpl->getVariable('module')->value['moduleID'];?>
">Cancel</a></fieldset>
</form>
<?php }?>

<?php if (isset($_smarty_tpl->getVariable('showRateMaterial',null,true,false)->value)==true&&$_smarty_tpl->getVariable('showRateMaterial')->value==true){?>
<h2>Leave A Rating for Material <?php echo $_smarty_tpl->getVariable('material')->value['name'];?>
</h2>
<p>Rate this material on a scale of 0 to 5, with 0 being the lowest rating and 5 being the best.  You may also leave 
comments about the material if you wish.</p>
<form name="mainForm" action="rate.php" method="post">
    <input type="hidden" readonly="readonly" name="action" value="doRate"></input>
    <input type="hidden" readonly="readonly" name="materialID" value="<?php echo $_smarty_tpl->getVariable('material')->value['materialID'];?>
"></input>
    <input type="hidden" readonly="readonly" name="moduleID" value="<?php echo $_smarty_tpl->getVariable('module')->value['moduleID'];?>
"></input>
    <input type="radio" name="rating" value="0"></input>0 &nbsp;
    <input type="radio" name="rating" value="1"></input>1 &nbsp;
    <input type="radio" name="rating" value="2"></input>2 &nbsp;
    <input type="radio" name="rating" value="3"></input>3 &nbsp;
    <input type="radio" name="rating" value="4"></input>4 &nbsp;
    <input type="radio" name="rating" value="5"></input>5<br><hr>
    <!--Comments (optional)<br>
    <strong>Title:</strong></label><input type="text" name="commentTitle"></input><br />
    <textarea name="comment"></textarea>-->
    <fieldset class="buttons" style="padding: 0"><input type="submit" class="button" name="submit" value="Rate This Material"></input>
    <a class="button" href="viewModule.php?moduleID=<?php echo $_smarty_tpl->getVariable('module')->value['moduleID'];?>
">Cancel</a></fieldset>
</form>
<?php }?>

<a href="viewModule.php?moduleID=<?php echo $_smarty_tpl->getVariable('module')->value['moduleID'];?>
">&larr; Back to module</a>

<?php }?> 

</div>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
