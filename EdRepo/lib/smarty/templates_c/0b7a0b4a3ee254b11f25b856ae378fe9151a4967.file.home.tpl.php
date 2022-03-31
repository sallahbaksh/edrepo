<?php /* Smarty version Smarty-3.0.7, created on 2017-01-13 11:40:42
         compiled from "/var/www/html/EdRepo/EdRepo/lib/smarty/templates/home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1981207575879030a86ff43-84776229%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0b7a0b4a3ee254b11f25b856ae378fe9151a4967' => 
    array (
      0 => '/var/www/html/EdRepo/EdRepo/lib/smarty/templates/home.tpl',
      1 => 1484321121,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1981207575879030a86ff43-84776229',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<div id="content">


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


<script type="text/javascript" src="lib/jquery/jstree/jquery.jstree.js"></script>
<script type="text/javascript">
  var LEVELS = <?php echo $_smarty_tpl->getVariable('REPOSITORY_TREE_LEVELS')->value;?>
;

  $(document).ready(function() {
  
    /* addToArray - adds the IDs of the given nodes to the given array
              @param  nodes  - jQuery object of elements
              @param  array 
        */
    function addToArray(nodes, array) {
      nodes.each(function(i) {
        var id = $(this).attr("id");
        array.push(id);
      });
    }
    
    var initOpen = new Array();
    var nodes = $("#hierarchy");
    
    for (i = 0; i < LEVELS; i++)
    {
      nodes = nodes.children("ul").children("li");
      addToArray(nodes, initOpen);
    }
    
    // activate hierachy side panel tree
    $("#hierarchy").jstree({ 
      "core": { 
        "initially_open" : initOpen,
        "animation" : 0,
        "load_open" : true
      },
      "themes" : {
        "theme" : "classic",
        "icons" : false        
      },
      "plugins" : [ "themes", "html_data" ]
    });  
    
  });
  

</script>

<?php if ($_smarty_tpl->getVariable('SHOW_REPOSITORY_TREE')->value==true){?>
<div id="panel">
  <strong>Navigate:</strong> (<a id="ecAll" href="#">+/- all</a>)
  <div id="hierarchy">
  <?php echo $_smarty_tpl->getVariable('tree')->value;?>

  </div>
</div>
<a id="collapse" title="Show/Hide Side Panel"></a>
<?php }?>

<div id="page">

<?php echo (($tmp = @$_smarty_tpl->getVariable('content')->value)===null||$tmp==='' ? "<h1>Error</h1>
<p>A system error has occurred finding the content for this page.
Please contact the site administrator.</p>" : $tmp);?>


</div>

</div>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
