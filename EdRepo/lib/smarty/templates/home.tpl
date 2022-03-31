{*****************************************************************************
    File:       home.tpl
    Purpose:    Smarty template for EdRepo's home page
    Author:     Jon Thompson
    Date:       15 October 2012
*****************************************************************************}

{include file="header.tpl"}

<div id="content">


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


<script type="text/javascript" src="lib/jquery/jstree/jquery.jstree.js"></script>
<script type="text/javascript">
  var LEVELS = {$REPOSITORY_TREE_LEVELS};
{literal}
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
  
{/literal}
</script>

{if $SHOW_REPOSITORY_TREE == true}
<div id="panel">
  <strong>Navigate:</strong> (<a id="ecAll" href="#">+/- all</a>)
  <div id="hierarchy">
  {$tree}
  </div>
</div>
<a id="collapse" title="Show/Hide Side Panel"></a>
{/if}

<div id="page">

{$content|default:"<h1>Error</h1>
<p>A system error has occurred finding the content for this page.
Please contact the site administrator.</p>"}

</div>

</div>

{include file="footer.tpl"}
