<?php
/****************************************************************************************************************************
 *    index.php - The home page for the collection
 *    --------------------------------------------------------------------------------------
 *  A home page.  Responsible for displaying the user interface and anything in the body collection maintainers want.
 *
 *  Version: 1.0
 *  Author: Ethan Greer
 *
 * Modified: 2011-05-05 by Jon Thompson (relocaated)
 *
 *  Notes: (none) 
 ******************************************************************************************************************************/
  
  require(__DIR__ . "/smarty/smarty.php");
  require(__DIR__ . "/backends/backend.php");
  require(__DIR__ . "/model/model.php");
  require(__DIR__ . "/look/look.php");
  require(__DIR__ . "/config/config.php");
  require(__DIR__ . "/config/header.php");
  require(__DIR__ . "/config/footer.php");
  require(__DIR__ . "/authentication.php");
  $backendInformation=getBackendBasicInformation();
  $backendCapabilities=getBackendCapabilities();
  
  // assign the collection name to Smarty
  $smarty->assign("COLLECTION_NAME", $COLLECTION_NAME);
  
  // assign the active "look" directory to Smarty
  $smarty->assign("LOOK_DIR", $LOOK_DIR);
  
  // assign whether or not we're using versions
  $smarty->assign("ENABLE_VERSIONS", $ENABLE_VERSIONS);
  
  // assign array of header config settings to Smarty
  $smarty->assign("HEADER", $HEADER );
  // assign array of footer config settings to Smarty
  $smarty->assign("FOOTER", $FOOTER );
?>