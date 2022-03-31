<?php
/*****************************************************************************************************
 *    listRecords.php - Handles ListRecords requests to the OAI-PMH provider.
 *    -----------------------------------------------------------------------
 *  Handles ListRecords requests to the OAI-PMH provider via the listRecords() function.  Designed
 *  to be called from the main provider file (provider.php).
 *
 * Author: Ethan Greer
 * Version: 1.0 (based off SWEnet OAI-PMH provider, also by Ethan Greer).
 *
 * Notes: (none)
 ******************************************************************************************************/


/* listRecords($metadataPrefix) - Lists all the records in a database, using the metadataPrefix given.
	This function will look for "from", "until", "set", and "resumptionToken" parameters from GET
	or POST inputs.  "set" and "resumptionToken" aren't supported and will generate errors.  "from"
	and "until" will be used to limit the returned results to the time period given by "from" and "until"
	as described by the OAI-PMH documentation for the parameters.
    @parm $metadataPrefix: The metadataPrefix to return results in.  Currently only "oai_dc" is supported.*/
function listRecords($metadataPrefix) {
  require(__DIR__ . "/config.php");
  
  if($metadataPrefix != "oai_dc" && $metadataPrefix != "nsdl_dc") { /* We only support oai_dc and nsdl_dc */
    badArgument("cannotDisseminateFormat", "metadataPrefix=\"".$metadataPrefix."\"", "This repository only supports the following for metadataPrefix: oai_dc, nsdl_dc");
  }
  
  $set=FALSE; //Default to assume no set was asked for.
  if(isset($_REQUEST["set"])) { /* Did they ask for a set? */
    $set=$_REQUEST["set"];
  }
  
 /* If either the from or until parameters were passed, get them. */
  if(isset($_REQUEST["from"])) {
    $from=$_REQUEST["from"];
    if(dateFormatOkay($from)!==TRUE) {
      badArgument("badArgument", "", "The date/time given as a 'from' is invalid.");
    }
  }
  if(isset($_REQUEST["until"])) {
    $until=$_REQUEST["until"];
    if(dateFormatOkay($until)!==TRUE) {
      badArgument("badArgument", "", "The date/time given as an 'until' is invalid.");
    }
  }
  
  if(isset($from) && isset($until)) {
    if(validDates($from, $until)===FALSE) {
      badArgument("badArgument", "", "The from and/or until parameters are invalid.");
    }
  }
  
  /* If either $from and/or $until have not been set by POST/GET parameters, set them to defaults of "everything". */
  if(!isset($from)) {
    $from="*";
  }
  if(!isset($until)) {
    $until="*";
  }
  
  if(dateNotBeforeEarliestDatestamp($until)!==TRUE) { //Check to make sure that "until" is less than the earliest date in the repository.
    badArgument("badArgument", "", "You have requested a record from a date/time earlier than the earliest record in this repository.");
  }
  
  if($set===FALSE || $set=="modules") { //If no set was specified or the set specified was "modules", get all modules matching $from and $until.
    $moduleResults=searchModules(array("minDate"=>$from, "maxDate"=>$until, "status"=>"Active"));
    if($moduleResults===FALSE || $moduleResults=="NotImplimented") { //Just handle these errors as if no results were found.
      $moduleResults=array();
    }
  }
  if($set===FALSE || $set=="materials") { //If no set was specified or the set specified was "materials", get all materials matching $from and $until
    $materialResults=searchMaterials(array("minDate"=>$from, "maxDate"=>$until));
    if($materialResults===FALSE || $materialResults=="NotImplimented") { //Just handle these errors as if no results were found.
      $materialResults=array();
    }
  }
  
  /* Explination:
     ( If neither $moduleResults or $materialResults is )    ( If no set was specified, but no modules or materials were found, )    ( If the set specified was modules, but no  )    ( If the set specified was materials, but no    )
     ( set than an unkown set was specified, which means) OR ( than everything was searched but nothing was found.              ) OR ( results were found when searching         ) OR ( materials were found when searching materials )
     ( no records were found.                           )    (                                                                  )    ( modules, than nothing was found.          )    ( than nothing was found.                       ) */
  if((!isset($moduleResults) && !isset($materialResults)) || ($set===FALSE && (count($moduleResults)+count($materialResults))<=0) || ($set=="modules" && count($moduleResults)<=0) || ($set=="materials" && count($materialResults)<=0)) { //If true, than no records mathed queryAdd
    if($from && !$until) {
      badArgument("noRecordsMatch", "from=\"".datesToOAI($from)."\"", "Sorry, but your query returned no results.");
    }
    if($until && !$from) {
      badArgument("noRecordsMatch", "until=\"".datesToOAI($until)."\"", "Sorry, but your query returned no results.");
    }
    if($until && $from) {
      badArgument("noRecordsMatch", "from=\"".datesToOAI($from)."\" until=\"".datesToOAI($until)."\"", "Sorry, but your query returned no results.");
    }
    if(!$until && !$from) {
      badArgument("noRecordsMatch", "", "Sorry, but your query returned no results.  Either the repository isn't working right or it is empty.");
    }
  }
  
  /* If we're this far, than at least one record was found.  So print it. */
  echo $OAI_TOP."\n";
  echo "<responseDate>".strftime("%Y-%m-%dT%H:%M:%SZ", time())."</responseDate>\n";
  echo '<request verb="ListRecords">'.getRequestURL()."</request>\n";
  echo "<ListRecords>\n";
  if($set===FALSE || $set=="modules") { //Print modules if no set was given or the set to list was modules.
    /* NOTE:  Everything inside this for loop should be EXACTLY the same as as would be output by a GetRecord query.  The reason it is copied here instead
        of just re-using the getRecord() function is because we already have all the information we need to print the output, and calling getRecord() again
        for every record would needlessly add twice the amount of work (or more) to the back-end.  If performance is no object, and you prefer the absolutely
        easiest-to-maintain code, convert the contents of the for loop to just keep making calls to getRecord with the approperate parameters. */
    foreach($moduleResults as $record) {
      echo "<record>\n";
      echo "<header>\n<identifier>".urlencode(getBaseRepositoryIdentifier()."/module-".$record["moduleID"])."</identifier>\n";
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
  }
  if($set===FALSE || $set=="materials") { //Print materials if no set was given or the set was materials.
    /* NOTE: The contents of this loop should be the same thing printed as by a GetRecord request. */
    foreach($materialResults as $record) {
      echo "<record>\n";
      echo "<header>\n<identifier>".urlencode(getBaseRepositoryIdentifier()."/material-".$record["materialID"])."</identifier>\n";
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
  }
  
  echo "</ListRecords>\n";
  echo "</OAI-PMH>";  
}

?>
