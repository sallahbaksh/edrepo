<?php
/****************************************************************************************************************************
 *    validate.php - Functions for validating input or results 
 *    --------------------------------------------------------------------------------------
 *  A collection of functions used for validating input and/or results.  
 *
 *  Version: 1.7
 *  Author: Ethan Greer
 *  Editor: Andrew Hagner
 *
 *  Methods contained (Status):
 *	- validateEmail			- (Completed)
 *	- validateName			- (Completed)
 *	- validatePassword		- (Completed)
 *	- validateFileType		- (Working)
 *	- validateFileSize		- (Working)
 *	- validateNotBlank		- (Completed)
 *  - validateFieldLength	- (Completed)
 ******************************************************************************************************************************/

/* validateFieldLength($str, $length)
 * - Checks to see if a string's lenght is less 
 *   than or equal to a given length.
 * * * * * * * * * * * * * * * * * * * *
 * @param $str - the string to be checked.
 * @param $length - the length desired.
 * @return TRUE if str <= length
 */
function validateFieldLength($str, $length) {
 return (strlen($str) <= $length);
}
/* validateNotBlank($value)
 * - Checks to make sure the input isn't blank or only whitespace.
 * * * * * * * * * * * * * * * * * * * * * * * *
 * @param $value - The input to be checked.
 * @return - True/False respectively.
 */
function validateNotBlank($value) {
  return (strlen(ltrim($value))!=0);
}
 
 
/* validateEmail($email) 
 * The validEmail function was written by Douglas Lovell (Jun 01, 2007).
 * Original source and article at: http://www.linuxjournal.com/article/9585
 * Validate an email address.
 * Provide email address (raw input)
 * Returns true if the email address has the email 
 * address format and the domain exists.
 * * * * * * * * * * * * * * * * * * * * * * * * 
 * @parm $email - The email address to validate.
 * @return - Returns TRUE if the email address is considered valid, FALSE otherwise. 
 */
 function validateEmail($email)
{
  $isValid = true;
  $atIndex = strrpos($email, "@");
  if (is_bool($atIndex) && !$atIndex)
  {
      $isValid = false;
  }
  else
  {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
        // local part length exceeded
        $isValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
        // domain part length exceeded
        $isValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
        // local part starts or ends with '.'
        $isValid = false;
      }
      else if (preg_match('/\\.\\./', $local))
      {
        // local part has two consecutive dots
        $isValid = false;
      }
      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
      {
        // character not valid in domain part
        $isValid = false;
      }
      else if (preg_match('/\\.\\./', $domain))
      {
        // domain part has two consecutive dots
        $isValid = false;
      }
      else if
(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
                str_replace("\\\\","",$local)))
      {
        // character not valid in local part unless 
        // local part is quoted
        if (!preg_match('/^"(\\\\"|[^"])+"$/',
            str_replace("\\\\","",$local)))
        {
            $isValid = false;
        }
      }
      if ($isValid && !(checkdnsrr($domain,"MX") || 
        checkdnsrr($domain,"A")))
      {
        // domain not found in DNS
        $isValid = false;
      }
  }
  return $isValid;
}

/* validateName($name) 
 *  - Checks a name for basic validity.
 * * * * * * * * * * * * * * * * * * * *
 *  Current standards (2/19/2011):
 *	- Must be at least 3 characters in length.
 *	- Can contain the 26 alphabet letters.
 *	- Can contain a space, dash, or a period (Allows for uncommon names & titles ex: Dr. , Snr. , Jon-Mark, Un-common Na Me , etc...).
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
 *  @parm $name - The name to validate.
 *  @return - Returns TRUE if the name is considered valid, FALSE otherwise. 
 */
function validateName($name) {
  if(strlen($name)<3) return false; // Minimum 3 letters.
  $numValidChars = strspn($name, "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ .-"); // Valid Char set for name
  return($numValidChars==strlen($name));
}

/* validatePassword($password) 
 *  - Checks a password for a degree of validity/strength.
 *  - The degree of strength can be altered via the true/false switches below, of which only one should be true at a time.
 *  - A custom degree has been left open for administrators who wish to create their own standards.
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * @option $reqWeak   - Requires only that the password length be greater/equal to 5.
 *
 * @option $reqMedium - Requires minimum password length of 5.
 *					  - Requires at least 1 Upper Case letter. 
 *
 * @option $reqStrong - Requires minimum password length of 8.
 *					  - Requires at least one Upper Case letter.
 *					  - Requires at least one Non-Alphabet character.
 *
 * @option $reqAdvanced - Requires minimum password length of 16.
 *						- Requires at least one Upper Case letter.
 *						- Requires at least one Non-Alphabet character.
 *						- Requires at least one Symbol character.
 *						- Requires at least one Numeric character.
 *
 * @option $reqCustom - Administrator defined rules for password.
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * @parm $password - The password to check for validity/strength.
 * @return - Returns TRUE is the password is considered valid and "strong enough", FALSE otherwise.  Note that this is no guaranteed to only validate 
 *           strong passwords.  You are free to accept as weak of passwords as you want, including no password at all.  However, if you want to enforce password 
 *           strength, this is the place to do it. 
 */
function validatePassword($password){

// Strength Option Switches //
 $reqWeak    = true; //Min length 5
 $reqMedium  = false; //Min length 5, must have at least 1UpperCase 
 $reqStrong  = false; //Min length 8, must: 1Upper 1NonAlpha
 $reqAdvanced= false; //Min length 16, must: 1Upper 1NonAlhpa 1Symbol 1Num
 $reqCustom  = false; //Custom
 
// Weak //
if($reqWeak == true)
 {
   return (strlen($password)>=5);
 }

// Medium //
if($reqMedium)
 {
   if(strlen($password)<5) return false;
   return (preg_match('/[A-Z]/', $password));   
 }

// Strong // 
if($reqStrong)
 {
   if(strlen($password) < 8) return false;
   $upper = preg_match('/[A-Z]/', $password);
   $lower = preg_match('/[a-z]/', $password);
   $symbols = strspn($password, "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");
   return ($upper && $lower && (strlen($password)!=$symbols));
 }

// Advanced //
if($reqAdvanced)
 {
  if(strlen($password) < 16) return false;
  $upper = preg_match('/[A-Z]/', $password);
  $lower = preg_match('/[a-z]/', $password);
  $number= preg_match('/[0-9]/', $password);
  $symbols = strspn($password, "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789");
  return ($upper && $lower && $number &&(strlen($password)!=$symbols));

 }

// Custom // 
if($reqCustom)
 {
   /* Admin can create own conditions here. */
 }
 
// Default //
return true;

}


/* validateFileType($type)
 *  - Checks the file type to make sure its valid.
 * * * * * * * * * * * * * * * * * * * * * * * * * 
 * @param $type - The file type.
 * @return - True if valid.
 */
function validateFileType($type) {
  return TRUE;
}

/* validateFileSize($size)
 * - Checks to make sure that a file size is small 
 *   enough to be allowed to be uploaded as a material.  Use this function to 
 *   restrict file sizes.
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * @parm $size - The size of the file to be validated.
 * @return - Returns TRUE if the file is considered okay, FALSE otherwise.
 */
function validateFileSize($size) {
  return TRUE;
}
?>