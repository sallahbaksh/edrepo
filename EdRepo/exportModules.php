<?php session_start();
/****************************************************************************************************************************
 *    exportModules.php - This pages handles exporting modules. 
 *    --------------------------------------------------------------------------------------
 *  Modules owned by a user can be exported into a CSV format from the general format below. This page will take the 
 *  information from the module and export it when a button is clicked. It will immediatly download to the users download
 *  directory. 
 *
 *  Version: 1.0
 *  Author: Christopher Macco 
 *
 *  Notes: (none) 
 ******************************************************************************************************************************/

	/*exportModule($moduleInfo) - this will actually export the module to the user's downloads folder specified by their browser
	*@params - $moduleInfo, this is the module information coming from the index.php page where the module is selected by ID. The 
	*			the information selected by the ID will be exported into a CSV file in one line. 
	*
	*/
	function exportModule($moduleInfo){ 
		$fileName = "modules.csv"; 
	    header('Content-Type: application/csv');
		header('Content-Disposition: attachement; filename="'.$fileName.'";');
		$file = fopen("php://output", "w");
		fputcsv($file, $moduleInfo);
	    ob_start(); 
		fpassthru($file);
	    ob_clean();
	    flush();
		fclose($file); 
		exit;
	}









?>