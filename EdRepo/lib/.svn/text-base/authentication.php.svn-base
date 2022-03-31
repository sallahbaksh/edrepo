<?php
 /****************************************************************************************************************************
 *    authentication.php - Runs authentication functions to get user information
 *    --------------------------------------------------------------------------------------
 *    Create logout($smarty) function
 *    Tests to see if authentication token is set, and gets user info if it is.
 *
 *  Version: 1.0
 *  Author: Ethan Greer (Relocated by Jon Thompson)
 *
 *  Notes: 
 ******************************************************************************************************************************/

 $smarty->assign("loggedIn", "false"); // default to show logged out first
 
function logout($smarty) { // Smarty must be passed in order for logout() to use it
    if(isset($_SESSION["authenticationToken"])) {
      $logOutResult=logUserOut($_SESSION["authenticationToken"]);
    }
    unset($_SESSION["authenticationToken"]);
    unset($_SESSION["filters"]);
    
    $smarty->assign("loggedIn", "false");
}

if(isset($_SESSION["authenticationToken"])) { //Check if we think someone is already logged in.
    $userInformation=checkIfUserIsLoggedIn($_SESSION["authenticationToken"]);
    if(count($userInformation)==0) { //If true, than the user wasn't found
      logout($smarty);
      unset($userInformation);
    }
    
    if( isset($userInformation) )
    {
        $smarty->assign("loggedIn", "true");
        
        // Assign all user information to a "user" Smarty attribute
        $smarty->assign("user", array(
            "userID" => $userInformation["userID"],
            "email" => $userInformation["email"],
            "firstName" => $userInformation["firstName"],
            "lastName" => $userInformation["lastName"],
            "password" => $userInformation["password"],
            "type" => $userInformation["type"] ));
    }
}

?>