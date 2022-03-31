<?php 
 /****************************************************************************************************************************
 *    validate.php - This file validates the server. 
 *    --------------------------------------------------------------------------------------
 *  This file validates the server to make sure it is connected properly. Soon it will make sure everything in the server is 
 *	working properly too. EdRepo will not work properly without a proper connection to the server. 
 *
 *  Version: 1.0
 *  Author: Christopher Macco 
 *
 *  Notes: (none) 
 ******************************************************************************************************************************/

require_once("pdo/settings.php"); 

/*Make sure EdRepo is connected to the database, if not kill the page. */
$connect = mysql_connect($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD); 
if ($connect == false)
{
	die ("EdRepo must be connected to the database to work properly. Please see INSTALL.txt for more information. If you have already installed the database please contact your administrator."); 
}

 
?>