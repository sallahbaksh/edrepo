<?php

/* backend.php - Datamanager and backend selection.
                 This file is used to select the datamanager and back-end used by the system.  Datamanagers and backends are distributed togeather, and 
                 each one should have its own subdirectory.  They should all be accessed through the "datamanager.php" file, so switching backends is as
                 simple as requiring a different datamanager. */

/* Change the line below to point to the datamanager for the backend you want to use. */
require("pdo/datamanager.php");

// Test to be sure all necessary functions are defined
$necessaryFunctions = array(
  "getBackendCapabilities",
  "getBackendBasicInformation",
  "dataCreate",
  "dataRead",
  "dataUpdate",
  "dataDelete"
);

$error = "EdRepo back end not installed properly. Missing necessary function: ";

foreach($necessaryFunctions as $f) { 
  $r = function_exists($f) or exit($error . $f);
}

// Check if optional functions have been defined. If not, define them.

if (!function_exists("dataJoin")) {
  // dataJoin() - performs inner join $relationA and $relationB on $relationA.$keyA = $relationB.$keyB and returns the joined rows
  // note that this function is inefficient, it is better for the datamanager to implement join using a back-end-specific method
  function dataJoin($relationA, $relationB, $keyA, $keyB, $conditions = array()) {
    $result = array();
    $aConditions = array();
    $bConditions = array();
    
    // separate the conditions to the appropriate relation
    foreach ($conditions as $c) {
      if (strpos($c, "$relationA.") !== FALSE) {
        $aConditions[] = $c;
      } elseif (strpos($c, "$relationB.") !== FALSE) {
        $bConditions[] = $c;
      }
    }
    
    $aResults = dataRead($relationA, $aConditions);
    if (!$aResults) {
      return FALSE;
    }
    
    foreach ($aResults as $a) {
      $key = $a[$keyA];
      $c = $bConditions;
      $c[] = "$keyB = '$key'";
      $bResults = dataRead($relationB, $c);
      if ($bResults === FALSE) {
        return FALSE;
      }
      foreach ($bResults as $b) {
        $result[] = array_merge($a, $b);
      }
    }
    
    return $result;
  }
}

?>