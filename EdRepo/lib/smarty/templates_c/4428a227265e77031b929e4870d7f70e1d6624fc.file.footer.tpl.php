<?php /* Smarty version Smarty-3.0.7, created on 2017-01-13 11:37:50
         compiled from "/var/www/html/EdRepo/EdRepo/lib/smarty/templates/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1081961535879025e1c8470-44724803%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4428a227265e77031b929e4870d7f70e1d6624fc' => 
    array (
      0 => '/var/www/html/EdRepo/EdRepo/lib/smarty/templates/footer.tpl',
      1 => 1484321121,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1081961535879025e1c8470-44724803',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<div id="footer">
    <?php if ($_smarty_tpl->getVariable('FOOTER')->value['SHOW_NAME']==true||$_smarty_tpl->getVariable('FOOTER')->value['SHOW_LINKS']==true){?>
    <p>
        <?php if ($_smarty_tpl->getVariable('FOOTER')->value['SHOW_NAME']==true){?>
            <strong><?php echo $_smarty_tpl->getVariable('COLLECTION_NAME')->value;?>
</strong><br />
        <?php }?>
        <?php if ($_smarty_tpl->getVariable('FOOTER')->value['SHOW_LINKS']==true){?>
            <a href="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
index.php">Home</a> | 
            <a href="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
about.php">About</a> | 
            <a href="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
browse.php">Browse</a> | 
            <a href="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
showMyModules.php">My Modules</a> | 
            <a href="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
moderate.php">Moderate</a> | 
            <a href="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
admin/index.php">Admin</a>
        <?php }?>
    </p>
    <?php }?>
    
    <?php echo $_smarty_tpl->getVariable('FOOTER')->value['CONTENT'];?>

    <!--<p>Powered by <a href="http://sourceforge.net/projects/edrepo/">EdRepo</a>.</p>-->
</div>

</div>
</body>
</html>      
