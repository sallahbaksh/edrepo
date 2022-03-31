{*****************************************************************************
    File:       wizardNav.tpl
    Purpose:    Smarty template for EdRepo's module wizard sidebar
    Author:     Jon Thompson
    Date:       27 March 2011
*****************************************************************************}


    <div id="wizard-nav">
        <ul class="tabs">
          <li{if $section == "Basics"} class="active"{/if}><a href="index.php{if isset($moduleInfo)}?moduleAction=edit&moduleID={$moduleInfo.moduleID}{/if}">Basic Info</a></li>
          <li{if $section == "Materials"} class="active"{/if}><a href="materials.php{if isset($moduleInfo)}?moduleID={$moduleInfo.moduleID}{/if}">Materials</a></li>
          <li{if $section == "References"} class="active"{/if}><a href="references.php{if isset($moduleInfo)}?moduleID={$moduleInfo.moduleID}{/if}">References</a></li>
          <li{if $section == "Misc"} class="active"{/if}><a href="misc.php{if isset($moduleInfo)}?moduleID={$moduleInfo.moduleID}{/if}">Misc</a></li>
        </ul>
        <ul>
          {if isset($moduleInfo.status) && $moduleInfo.status=="InProgress"}
          <li><a class="button" href="submit.php?moduleID={$moduleInfo.moduleID}">Submit Module</a></li>
          {/if}
          {if isset($moduleInfo) && (!isset($moduleAction) || $moduleAction != "create" && $moduleAction != "createNewVersion")}
          <li><a class="button" href="delete.php?action=delete&moduleID={$moduleInfo.moduleID}">Delete Module</a></li>
          {/if}
          <li><a class="button" href="../showMyModules.php">Exit</a></li>
        </ul>
    </div>
    