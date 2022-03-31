<?php
/****************************************************************************************************************************
*	header.php - Settings for displaying the collection's header.
*                WARNING: Any changes made in this file must also be made in the write command in configureHeader.php!
******************************************************************************************************************************/

/* Sets how to show logo (one of text, default, or custom */
$HEADER["LOGO"]="default";

/* File name of header logo (in current theme directory) to show if logo is set to "custom" */
$HEADER["LOGO_NAME"]="";

/* Call static header content from file */
$file_location = dirname(__DIR__) . "/staticContent/header.html";

// dirname(__DIR__) puts you in the directory above this one
$HEADER["CONTENT"] = file_get_contents($file_location);

//Default icon location
$HEADER["ICON_NAME"]="icon.ico";

?>