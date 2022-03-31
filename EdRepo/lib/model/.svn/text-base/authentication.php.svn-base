<?php
/****************************************************************************************************************************
 *    authentication.php - defines the model functions for auth. (e.g. logging in and out, password recovery)
 *    ---------------------------------------------------------
 *
 *  Version: 1.0
 *  Author: Jon Thompson
 *
 ******************************************************************************************************************************/

require_once(__DIR__ . "/../backends/backend.php");
require_once(__DIR__ . "/model.php");

/* checIfUserIsLoggedIn($authenticationToken) - Checks to see if a user with the given authentication token is properly logged into the system.  Also, 
    purges all expired or otherwise invalid authentication tokens.
  @parm $authenticationToken - A unique number from -9223372036854775808 to 9223372036854775807 which identifies a login.
  @return - Returns "NotImplimented" if this feature is not implimented by the back-end.
    Returns FALSE on any error.  A user with the authentication token not being logged in is not an error.
    Returns an array of information about the logged in user if the authentication token properly points to a logged in user.  The format of this array is 
      the same as that returned by getUserInformationByID().  An empty array indicates the user was not logged in. */
function checkIfUserIsLoggedIn($authenticationToken) {
  /* Start by purging all authentication tokens which have expired... */
  $now = date('Y-m-d H:i:s');
  $result = dataDelete("currentlogins", array("'$now' > Expires"));
  if($result===FALSE) {
    return FALSE;
  }
  
  //Try to find the authentication token given
  $result = dataRead("currentlogins", array("AuthenticationToken=$authenticationToken")); 
  if($result===FALSE || count($result)<=0) { //If true, we didn't find the authentication token...
    return array(); //Return an empty array, since we didn't find anything.
  }
  $userID = $result[0];
  return getUserInformationByID($userID["UserID"]);
}

/* logUserIn($email, $password) - Attempts to log a user into the system.
  @parm $email - The email address of the user attempting to log in.
  @parm $password - The password of the user attempting to log in, in plain text.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error, of this the email/password combination is invalid.
    On successful log in, returns an authentication token which can be used to verify the user. */
function logUserIn($email, $password) {
  /*Start by making sure the email/password pair is valid. */
  $conditions = array (
    "email='$email'",
    "Type!='Disabled'",
    "Type!='Deleted'",
    "Type!='Pending'", 
	"locked!='TRUE'"
  );
  $result = dataRead("users", $conditions);
  if($result===FALSE || count($result)!==1) {
    return FALSE;
  }
  
  $user = $result[0];
  $hash = $user["Password"];
  $salt = substr($hash, 0, 64);
  if($user===FALSE || secureHash($password, NULL, $salt) != $hash) {
    return FALSE;
  }
  srand((double)(microtime()*1000000)); //Seed the random number generator.  This seed from the discussion on PHP.net of the mt_srand function.  It isn't a great seed, but should work okay.
  $max=9223372036854775807; //By default, make the maximum number possibly to generate the maximum number the MySQL table can hold.
  if($max>getrandmax()) { //If the default maximum number to possibly generate is larger than the max PHP can handle, set the max to generate the max PHP can handle.
    $max=getrandmax();
  }
  $authenticationToken=rand(-$max, $max);
  /* Make sure the authentication token is not currently being used... */
  $result = dataRead("currentlogins", array("AuthenticationToken='$authenticationToken'"));
  if($result === FALSE) {
    return FALSE;
  }
  while(count($result)!==0) { //If the authentication token we picked is being used, keep generating new ones until an unused one is found...
    srand((double)(microtime()*1000000));  //Seed the random number generator.  This seed from the discussion on PHP.net of the mt_srand function.  It isn't a great seed, but should work okay.
    $authenticationToken=rand(-$max, $max);
    $result = dataRead("currentlogins", array("AuthenticationToken='$authenticationToken'"));
    if(result === FALSE) {
      return FALSE;
    }
  }
  $fields = array (
    "UserID" => $user["UserID"],
    "AuthenticationToken" => $authenticationToken,
    "Expires" => date('Y-m-d H:i:s', strtotime('+2 days'))
  );
  $result = dataCreate("currentlogins", $fields);
  if($result===FALSE) {
    return FALSE;
  }
  return $authenticationToken;
}

/* logUserOut($authenticationToken) - Logs a user out of the system.
  @parm $authenticationToken - The authentication token of the user to log out.
  @return - Returns "NotImplimented" if this feature is not supported by the back-end.
    Returns FALSE on any error.
    Returns TRUE on successful log out. */
function logUserOut($authenticationToken) {
  $result = dataDelete("currentlogins", array("AuthenticationToken=$authenticationToken"));
  return $result;
}

/* secureHash($password, $email, $salt) - Hashing function based on code by ElbertF:
         http://elbertf.com/2010/01/store-passwords-safely-with-php-and-mysql/
    @param  $password  - Password to hash
    @param  $email - NULL or email of user to generate a salt for
    @param  $salt  - NULL or 64-character random string
    @return a 128-char long string (64 salt followed by the 64 hashed pass) 
    
    NOTE: Either $email or $salt is NULL - not both.
               If $salt is NULL, $email is used to generate a salt (e.g. when changing a password)
               Otherwise, the given salt is used 
                  (e.g. when comparing given password against DB hash when logging in)
     */
function secureHash($password, $email, $salt) {
  $SALT_LENGTH = 64; // valid salt length in characters

  // check validity of $salt 
  if ($salt == NULL || strlen($salt) != $SALT_LENGTH) {
    $salt = false;
  }

  // if we weren't given a valid salt, one needs to be generated from the email address
  if ($salt === false) {
    // if invalid email was given, we can't continue
    if ($email == NULL || $email == false || strlen($email) < 1) {
      return false;
    }
    
    // Create a 256 bit (64 characters) long random salt
    // Let's add 'something random' and the email
    // to the salt as well for added security
    $salt = hash('sha256', uniqid(mt_rand(), true) . 'something random' . strtolower($email));
  }
  
   
  // Prefix the password with the salt
  $hash = $salt . $password;
   
  // Hash the salted password a bunch of times
  for ( $i = 0; $i < 100000; $i ++ )
  {
      $hash = hash('sha256', $hash);
  }
   
  // Prefix the hash with the salt so we can find it back later
  $hash = $salt . $hash;
  
  return $hash;
}

/* createRecoveryToken($userID) - Creates and stores a password recovery token 
    @param $userID  -  user ID of the user who forgot password and needs recovery token
    @return  - the generated token or FALSE on error
*/
function createRecoveryToken($userID) {  
  // generate token
  $token = hash('sha256', uniqid(mt_rand(), true) . '3dR3P0t0k3n' . strtolower($userID));
  
  $fields = array (
    "UserID" => $userID,
    "Token" => $token,
    "Expires" => date('Y-m-d H:i:s', strtotime('+1 days'))
  );
  
  $result = dataCreate("recovery", $fields);
  if ($result === FALSE) {
    return FALSE;
  }
  return $token;
}

/* clearRecoveryTokens() - removes all expired recovery tokens
    @return - true on success, else false */
function clearRecoveryTokens() {  
  $now = date('Y-m-d H:i:s');
  $result = dataDelete("recovery", array("'$now' > Expires"));
  return $result;
}

/* getRecoveryToken($userID) - Returns stored recovery token 
    @param $userID  -  user ID of the user 
    @return  - stored recovery token of the user, false on error
*/
function getRecoveryToken($userID) {  
  $result = dataRead("recovery", array("UserID='$userID'"));
  
  if (!$result || count($result) != 1) {
    return FALSE;
  }
  
  return $result[0]["Token"];
}

/* removeRecoveryToken($userID) - Removes all stored tokens for a user
    @param $userID  -  user ID of the user 
    @return  - true on success, false otherwise
*/
function removeRecoveryTokens($userID) {
  return dataDelete("recovery", array("UserID='$userID'"));
}


?>
