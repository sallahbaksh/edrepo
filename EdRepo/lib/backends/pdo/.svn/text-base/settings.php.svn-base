<?php
/****************************************************************************************************************************
 *    settings.php - Settings used by the PHP Data Objects (PDO) backend.
 *    --------------------------------------------------------------------------------------
 *  Constants used by the PDO backend.  These are required for the PDO backend to work, and should not be used outside
 *  the backend.
 *
 *  Version: 1.0
 *  Author: Jon Thompson
 *
 ******************************************************************************************************************************/ 
$DB_HOSTNAME = "localhost";
$DB_USERNAME = "edrepo";
$DB_DATABASE = "edrepo";
$DB_PASSWORD = "edrepo";

//Array can include:
//(Recommended) Admin, Editor, 
//(Others) Submitter, SuperViewer, Viewer
$AUTO_APPROVE_MODULES_TYPE = array("Editor", "Admin");


/* The following DSN line is written for using a MySQL database.
    If using something other than MySQL, consult the PDO
    documentation for the appropriate DSN to use for your database. 
    <http://php.net/manual/en/pdo.drivers.php> */
$DB_DSN = "mysql:dbname=" . $DB_DATABASE . ";host=" . $DB_HOSTNAME;
?>
