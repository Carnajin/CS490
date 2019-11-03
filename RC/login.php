<?php
//-- Set any error reporting --------------------------------------------
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//-- This will search for the POST data----------------------------------
$username = $_POST["ucid"];
$password = $_POST["pass"];
//-----------------------------------------------------------------------

$info = ["ucid" => $username, "pass" => $password];

//-- cURL requst --------------------------------------------------------
$ch = curl_init(); // init curl handler
curl_setopt($ch, CURLOPT_POSTFIELDS, $info); // post the fields
curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~vnp27/cs490/mid/login.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch); // store response into variable
curl_close($ch); // free up the curl handler
echo $response; // get the response
//-----------------------------------------------------------------------

?>