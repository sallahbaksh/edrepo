<?php /* Smarty version Smarty-3.0.7, created on 2014-06-17 13:16:29
         compiled from "E:\XAMPP\xampplite-win32-1.7.3\xampplite\htdocs\xampp\EdRepo\EdRepo\lib\smarty/templates/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1928753a077edd941d6-89103155%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '428811abaecd10feaed9a649254c36c9d99ce379' => 
    array (
      0 => 'E:\\XAMPP\\xampplite-win32-1.7.3\\xampplite\\htdocs\\xampp\\EdRepo\\EdRepo\\lib\\smarty/templates/footer.tpl',
      1 => 1337897780,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1928753a077edd941d6-89103155',
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
