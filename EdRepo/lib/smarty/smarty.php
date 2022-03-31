<?php
 /****************************************************************************************************************************
 *    smarty.php - Smarty object initialization and set up
 *    --------------------------------------------------------------------------------------
 *    Initializes the Smarty object for use as the template engine.
 *    Sets various settings like debugging and the relative locations of the template folders.
 *
 *  Version: 1.0
 *  Author: Jon Thompson
 *
 *  Notes: __DIR__ is a PHP magic constant that returns the path of THIS FILE's directory.
 ******************************************************************************************************************************/
 
require(__DIR__ . '/Smarty.class.php'); // includes Smarty class, must come first!

$smarty = new Smarty; // Initializes new Smarty object. Must come second! Required for template engine to work.

//$smarty->force_compile = true;
$smarty->debugging = false;
$smarty->caching = false;
$smarty->cache_lifetime = 120;

$smarty->template_dir = __DIR__ . '/templates/';
$smarty->compile_dir  = __DIR__ . '/templates_c/';
$smarty->config_dir   = __DIR__ . '/configs/';
$smarty->cache_dir    = __DIR__ . '/cache/';
?>
