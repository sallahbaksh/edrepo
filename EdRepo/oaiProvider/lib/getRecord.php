<?php
/******************************************************************************************************
 *    getRecord.php - Contains functions neeeded to handle "GetRecord" requests to the provider.
 *    -------------------------------------------------------------------------------------------
 *
 * Version: 1.0
 * Author: Ethan Greer
 *
 * Notes: (none)
 *******************************************************************************************************/

/* getRecord($identifier, $metadataPrefix, $header, $footer) - Gets a single record referenced by $identifier 
	  in format $metadataPrefix and optionally modifies the header and footer based on $header and $footer.
    @parm $identifier: A full identifier to the record to get.  This should be in $REPOSITORY_IDENTIFIER:record format
      (for example, oai:localhost.localdomain:190).  When this is used with SWEnet, the final number is excepted to 
      be a ModuleID from the module table in the SWEnet database.
    @parm $metadataPrefix: The metadata format to return results in.  This should be "oai_dc" at this time.
    @parm $header: Should be either TRUE, FALSE, "", or a string with a tag (for example "<ListRecords>".  If FALSE, 
      no header is printed, only the record inside <record> tags.  If TRUE or "", the default header (<OAI-PMH>, 
      <responseDate>, <request>, and <GetRecord> tags) are included.  If a non-empty string, the result is the same as 
      using TRUE or "" except that the <GetRecord> tag is replaced by whatever is passed to this function via $header.
      This parameter is useful for for other functions which want to call getRecord repeatedly to get many records, but 
      don't want to print the full header every time (for exmaple, the listRecords function).
    @parm $footer: Like $header, expect prints a footer.  FALSE will print no footer, TRUE or "" will print the 
      default footer (</GetRecord> and </OAI-PMH>) and a non-empty string acts like TRUE or "" except that
      </GetRecord> is replaced by the text of the string.  */
function getRecord($identifier, $metadataPrefix, $header, $footer) {
  require(__DIR__ . "/config.php");
  require(dirname(dirname(__DIR__)) . "/lib/config/config.php");
  $identifier=urldecode($identifier);
 // echo '$identifier= '.$identifier."\n";
  //echo 'getBaseRepI= '.getBaseRepositoryIdentifier()."\n";
  
  $backendCapabilities=getBackendCapabilities(); //Get a list of backend capabilities, since we'll need to make sure that the back-end supports working with modules.
  $len = strlen(getBaseRepositoryIdentifier());
  $requestedRepository = substr($identifier, 0, $len); //The requested repository if the repository component of the identifier (after the schema and hostname buy before any sets/resources).
  
  //echo '$len_______= '.$len."\n";
  //echo '$requestedR= '.$requestedRepository."\n";
  
  if($requestedRepository!=getBaseRepositoryIdentifier()) {
    badArgument("badArgument", 'identifier="'.htmlspecialchars(urlencode($identifier)).'"', "The repository requested (".htmlspecialchars($identifier).") does not match this repository (".$COLLECTION_SHORTNAME.").");
  }
  
  /* Look for the record component of the identifier.  This is the part after the "/" after the repository identifier component of the identifier (ie, oai:domain.com:COLLECTION_SHORTNAME/RECORD). */
  $requestedRecord = substr($identifier, $len+1, strlen($identifier)); //The record is the part of the string starting at the position the repository identifier stops at at the "/" which seperates it from the record itself ($len+1) and continues to the end of the identifier.
  //Requested record should now contain either module-<something> or material-<something> indicating if we're to get a moudle or material.  Test to 
  //see which it is, setting $moduleOrMaterial to be either "module", "material", or FALSE on error.
  $moduleOrMaterial=FALSE; //By default, assume neither module- or material- was given as part of the record, which would be an error.
  if(substr($requestedRecord, 0, 7)=="module-") { //Did we find "module-" at the beginning or the requested record?
    $moduleOrMaterial="module"; //Tell record to search by module.
    $requestedRecord=substr($requestedRecord, 7, strlen($requestedRecord)); //Chop the "module-" part out of $requested record, leave only the actual record.
  } elseif(substr($requestedRecord, 0, 9)=="material-") { //Did we find "material-" at the beginning of the requested record?
    $moduleOrMaterial="material";
    $requestedRecord=substr($requestedRecord, 9, strlen($requestedRecord));
  }
  
  //echo '<br>mom= '.$moduleOrMaterial."\n<br>";
  //echo "<br>reqrecord= ".$requestedRecord."\n<br>";
  
  if(!in_array("UseModules", $backendCapabilities["read"])) {  //If true, the back-end does not support reading modules, so the provider can not function.
    badArgument("idDoesNotExist", 'identifier="'.str_replace(array("\"", "\\"), "", $identifier).'"', "This repository is currently not functional.  All requests will fail.");
  }
  if($moduleOrMaterial===FALSE) {
    badArgument("idDoesNotExist", 'identifier="'.urlencode($identifier).'"', "Records must be prefixed with either module- or material- to specify the resource type.");
  }
  
  if($metadataPrefix!="oai_dc" && $metadataPrefix != "nsdl_dc") {
    echo $OAI_TOP;
    echo "<responseDate>".strftime("%Y-%m-%dT%H:%M:%SZ", time())."</responseDate>\n";
    echo '<request verb="GetRecord" identifier="'.htmlspecialchars(urlencode($identifier)).'" metadataPrefix="'.$metadataPrefix.'">'.getRequestURL()."</request>\n";
    echo "<error code=\"cannotDisseminateFormat\">The metadata format requested cannot be served.  This repository only supports oai_dc and nsdl_dc metadataPrefix-es.</error>\n";
    echo "</OAI-PMH>";
    die("");
  }
  
  /* This if-else block gets either a module or material, depending on what $moduleOrMaterial is set to. */
  if($moduleOrMaterial=="module") {
    $record=getModuleByID($requestedRecord);
  } else {
    $record=getMaterialByID($requestedRecord);
  }
  
  if($record===FALSE || $record=="NotImplimented" || count($record)<=0) { /* No record was found, or an error occurrend, or the back-end didn't support reading records, so claim the record doesn't exist (idDoesNotExist). */
    badArgument("idDoesNotExist", "identifier=\"".str_replace(Array("\"", "\\"), "", $identifier)."\"", "The record requested (".$moduleOrMaterial."-".$requestedRecord.") does not exist in this repository.</error>\n");
  }
  
  /* We have gotten the record, so print it out. */
  if($header!==FALSE) { // Unless is was specifically requested not to print a header, print one.
    echo $OAI_TOP."\n";
    echo "<responseDate>".strftime("%Y-%m-%dT%H:%M:%SZ", time())."</responseDate>\n";
    echo '<request verb="GetRecord" identifier="'.urlencode($identifier).'" metadataPrefix="'.$metadataPrefix.'">'.getRequestURL()."</request>\n";
    if($header === TRUE || $header == "") {
      echo "<GetRecord>\n";
    } else {
      echo $header;
    }
  }
  
  if($moduleOrMaterial=="module") {
    echo "<record>\n";
    echo "<header>\n<identifier>".urlencode($identifier)."</identifier>\n";
    echo "<datestamp>".datesToOai($record["dateTime"])."</datestamp>\n";
    echo "<setSpec>modules</setSpec></header>\n";
    echo "<metadata>\n";
    if ($metadataPrefix=="nsdl_dc") {
      echo '<nsdl_dc:nsdl_dc schemaVersion="1.02.020" xmlns:nsdl_dc="http://ns.nsdl.org/nsdl_dc_v1.02/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:dct="http://purl.org/dc/terms/" xmlns:ieee="http://www.ieee.org/xsd/LOMv1p0" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://ns.nsdl.org/nsdl_dc_v1.02/ http://ns.nsdl.org/schemas/nsdl_dc/nsdl_dc_v1.02.xsd">'."\n";
    } else { // oai_dc
      echo "<oai_dc:dc xmlns:oai_dc=\"http://www.openarchives.org/OAI/2.0/oai_dc/\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.openarchives.org/OAI/2.0/oai_dc/ http://www.openarchives.org/OAI/2.0/oai_dc.xsd\">\n";
    }
    echo "<dc:title>".htmlspecialchars($record["title"], ENT_NOQUOTES)."</dc:title>\n";
    echo "<dc:identifier>".htmlspecialchars(returnModuleSource($record["moduleID"]), ENT_NOQUOTES)."</dc:identifier>\n";
    echo "<dc:description>".htmlspecialchars($record["description"], ENT_NOQUOTES)."</dc:description>\n";
    echo "<dc:date>".datesToOAI($record["dateTime"], ENT_NOQUOTES)."</dc:date>\n";
    echo "<dc:publisher>".htmlspecialchars($record["authorFirstName"].' '.$record["authorLastName"], ENT_NOQUOTES)."</dc:publisher>\n";
    echo "<dc:language>".htmlspecialchars($record["language"], ENT_NOQUOTES)."</dc:language>\n";
    echo "<dc:rights>".htmlspecialchars($record["rights"], ENT_NOQUOTES)."</dc:rights>\n";
    if ($metadataPrefix=="nsdl_dc") {
      echo "<dct:educationLevel>".htmlspecialchars($record["educationLevel"], ENT_NOQUOTES)."</dct:educationLevel>\n";
    }
    $authors=getModuleAuthors($record["moduleID"]);
    foreach($authors as $author) {
      echo "<dc:creator>".htmlspecialchars($author, ENT_NOQUOTES)."</dc:creator>\n";
    }
    if ($metadataPrefix=="nsdl_dc") {
      echo "<dct:accessRights>";
      if ($record["minimumUserType"] == "Unregistered") {
        echo "Free access";
      }
      else if ($record["minimumUserType"] == "Viewer") {
        echo "Free access with registration";
      }
      else {
        echo "Limited free access";
      }
      echo "</dct:accessRights>\n";
      
      echo "<ieee:interactivityType>".htmlspecialchars($record["interactivityType"], ENT_NOQUOTES)."</ieee:interactivityType>\n";
    }
    $typeIDs = getModuleTypeIDs($record["moduleID"]);
    foreach($typeIDs as $typeID) {
      $type = getTypeByID($typeID);
      echo "<dc:type>".htmlspecialchars($type["name"], ENT_NOQUOTES)."</dc:type>\n";
    }
    $categoryIDs = getModuleCategoryIDs($record["moduleID"]);
    foreach($categoryIDs as $catID) {
      $cat = getCategoryByID($catID);
      echo "<dc:subject>".htmlspecialchars($cat["name"], ENT_NOQUOTES)."</dc:subject>\n";
    }
    $topics=getModuleTopics($record["moduleID"]);
    foreach($topics as $topic) {
      echo "<dc:subject>".htmlspecialchars($topic["text"], ENT_NOQUOTES)."</dc:subject>\n";
    }
    echo "<dc:source>".returnModuleSource($record["moduleID"])."</dc:source>\n";
    if ($metadataPrefix=="nsdl_dc") {
      $attachedmaterials=getAllMaterialsAttatchedToModule($record["moduleID"]);
      foreach($attachedmaterials as $material) {
        echo "<dct:hasPart>".htmlspecialchars(returnMaterialSource($material), ENT_NOQUOTES)."</dct:hasPart>\n";
      }
      $exreferences=getExternalReferences($record["moduleID"]);
      foreach($exreferences as $reference) {
        echo "<dct:References>".htmlspecialchars($reference["link"], ENT_NOQUOTES)."</dct:References>\n";
      }
      $inreferences=getInternalReferences($record["moduleID"]);
      foreach($inreferences as $reference) {
        echo "<dct:References>".htmlspecialchars(returnModuleSource($reference["referencedModuleID"]), ENT_NOQUOTES)."</dct:References>\n";
      }
    }
    if ($metadataPrefix=="nsdl_dc") {
      echo "</nsdl_dc:nsdl_dc>\n";
    } else { //oai_dc
      echo "</oai_dc:dc>\n";
    }
    echo "</metadata>\n";
    echo "</record>\n";
  } 
	// The record wasn't a module, so instead print information pertaining to a material.
	else { 
    echo "<record>\n";
    echo "<header>\n<identifier>".urlencode($identifier)."</identifier>\n";
    echo "<datestamp>".datesToOai($record["dateTime"])."</datestamp>\n";
    echo "<setSpec>materials</setSpec></header>\n";
    echo "<metadata>\n";    
    if ($metadataPrefix=="nsdl_dc") {
      echo '<nsdl_dc:nsdl_dc schemaVersion="1.02.020" xmlns:nsdl_dc="http://ns.nsdl.org/nsdl_dc_v1.02/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:dct="http://purl.org/dc/terms/" xmlns:ieee="http://www.ieee.org/xsd/LOMv1p0" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://ns.nsdl.org/nsdl_dc_v1.02/ http://ns.nsdl.org/schemas/nsdl_dc/nsdl_dc_v1.02.xsd">'."\n";
    } else { // oai_dc
      echo "<oai_dc:dc xmlns:oai_dc=\"http://www.openarchives.org/OAI/2.0/oai_dc/\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.openarchives.org/OAI/2.0/oai_dc/ http://www.openarchives.org/OAI/2.0/oai_dc.xsd\">\n";
    }
    echo "<dc:title>".htmlspecialchars($record["name"], ENT_NOQUOTES)."</dc:title>\n";
    echo "<dc:identifier>".htmlspecialchars(returnMaterialSource($record["materialID"]), ENT_NOQUOTES)."</dc:identifier>\n";
    echo "<dc:date>".htmlspecialchars($record["dateTime"], ENT_NOQUOTES)."</dc:date>\n";
    echo "<dc:format>".htmlspecialchars($record["format"], ENT_NOQUOTES)."</dc:format>\n";
    if ($metadataPrefix=="nsdl_dc") {
      $attachedmodules=getAllModulesAttatchedToMaterial($record["materialID"]);
      foreach($attachedmodules as $module) {
        echo "<dct:isPartOf>".htmlspecialchars($module, ENT_NOQUOTES)."</dct:isPartOf>\n";
      }
    }
    echo "<dc:source>".returnMaterialSource($record["materialID"])."</dc:source>\n";
    if ($metadataPrefix=="nsdl_dc") {
      echo "</nsdl_dc:nsdl_dc>\n";
    } else { //oai_dc
      echo "</oai_dc:dc>\n";
    }
    echo "</metadata>\n";
    echo "</record>\n";
  }
  if($footer !== FALSE) { //Unless it was specifically requested not to print a footer, print one.
    if($footer === TRUE || $footer == "") { //If a standard footer was requested, print it.  Otherwise, print whatever footer was given.
      echo "</GetRecord>\n";
    } else {
      echo $footer;
    }
    echo "</OAI-PMH>";
  }
}

/* cleanTextForOai - Cleans text for OAI-PMH responses by either removing offending characters or by converting them 
	to acceptable form.
    @parm $toClean - A string of text to clean.
    @return - The cleaned text. */
function cleanTextForOai($toClean) {
  $toClean = preg_replace('/<[\/]?[a-zA-Z0-9]*[\/]?>/', '', $toClean); //Get rid of any HTML tags.
  $toClean = preg_replace('/(&[a-zA-Z0-9?]*;)|(&[^a-zA-Z0-9;]?)/e', 'checkValidAmpEscape("$1","$2")', $toClean);
  return $toClean;
}

/* checkValidAmpEscape - Checks to see if a valid HTML escape sequence is give (ie in the form &sequence;) or if only an "&" is given. 
      This function is designed to be a helper with a preg_replace() which which will find all escaped and unescaped &'s and replace them with 
      the output of this function.  The preg_replace this helper function is designed to be used with is:
	$cleanedText = preg_replace('/(&[a-zA-Z0-9?]*;)|(&[^a-zA-Z0-9;]?)/e', 'checkValidAmpEscape("$1","$2")', $textToClean);
  @parm $properEscape - This is matched by the regular expression above if a valid escape sequence is found.
  @parm $invalidEscape - This is matched by the regular expression abou if a plain & is found.
  @return - Returns $properEscape unchanged if present, the string "&amp;" otherwise. */
function checkValidAmpEscape($properEscape, $invalidEscape) {
  if($properEscape) { /*If $properEscape is present and as a ";" in it, assume the regualr expression found a proper escape sequence.  Just return it back. */
    return $properEscape;
  }
  return "&amp;";
}

/* returnSource - Returns a formatted URL which points to a web page for the source of the SWEnet module identified by $modID.  This is a function 
      so that it can be easily changed should SWEnet every change its URL schemes.
    @parm $ID - The moduleID of the module whose source should be returned.  This should be a number which corresponds to a moduleID from the 
      SWEnet database.
    @return - Returns a string formatted as a URL which points to a web page containing information and a place to download the module. */
function returnModuleSource($ID) {
  require(dirname(dirname(__DIR__)) . "/lib/config/config.php"); //Get global system configuration
  return "http://".$_SERVER["SERVER_NAME"].$COLLECTION_BASE_URL."viewModule.php?moduleID=".$ID;
}

function returnMaterialSource($ID) {
  require(dirname(dirname(__DIR__)) . "/lib/config/config.php");
  return "http://".$_SERVER["SERVER_NAME"].$COLLECTION_BASE_URL."viewMaterial.php?materialID=".$ID;
}
?>
