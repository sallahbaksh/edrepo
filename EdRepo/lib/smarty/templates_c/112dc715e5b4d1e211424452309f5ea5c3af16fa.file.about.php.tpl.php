<?php /* Smarty version Smarty-3.0.7, created on 2014-06-18 15:35:46
         compiled from "E:\XAMPP\xampplite-win32-1.7.3\xampplite\htdocs\xampp\EdRepo\EdRepo\lib\smarty/templates/about.php.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2511153a1ea12ec4ff3-90337966%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '112dc715e5b4d1e211424452309f5ea5c3af16fa' => 
    array (
      0 => 'E:\\XAMPP\\xampplite-win32-1.7.3\\xampplite\\htdocs\\xampp\\EdRepo\\EdRepo\\lib\\smarty/templates/about.php.tpl',
      1 => 1362598366,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2511153a1ea12ec4ff3-90337966',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<div id="content">

<?php echo (($tmp = @$_smarty_tpl->getVariable('content')->value)===null||$tmp==='' ? "<h1>About EdRepo</h1>" : $tmp);?>


<hr />

<h3>Acknowledgment and Disclaimer</h3>

<p><img src="<?php echo $_smarty_tpl->getVariable('baseDir')->value;?>
/lib/look/default/nfs_logo_sm.gif" alt="NSF Logo" id="nsf-logo" />This material is based upon work supported by the National Science Foundation under Grant No. DUE-0840721. Any opinions, findings, and conclusions or recommendations expressed in this material are those of the author(s) and do not necessarily reflect the views of the National Science Foundation.</p>

<h3>Copyright and Use</h3>

<p>Materials on this site are copyrighted by the authors but generally available for academic use. Materials are available under the <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/deed.en_US">Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License</a>, unless otherwise noted.</p>

<p>The EdRepo software is released under the <a href="http://www.gnu.org/licenses/gpl.html">GPL 3.0 license</a>.</p>

</div>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
