<?php
//-- Set any error reporting --------------------------------------------
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//-- This will search for the POST data----------------------------------

$functionN = $_POST["functionName"];
    
$functionD = $_POST["functionDesc"];    
    
$functionDi = $_POST["functionDiff"];

$functionT = $_POST["functionTopic"];
    
$testC1 = $_POST["tcs1"];
    
$testC2 = $_POST["tcs2"];
    
/*
if(isset($_POST["examName"])){
    $examN = $_POST["examName"];
    }
*/

$add = ["add"];
//-----------------------------------------------------------------------

$info = ["functionName" => $functionN, "functionDesc" => $functionD, "functionDiff" => $functionDi,
         "functionTopic" => $functionT, "testCase1" => $testC1, "testCase2" => $testC2, "add" => $add];

//-- cURL requst --------------------------------------------------------
$ch = curl_init(); // init curl handler
curl_setopt($ch, CURLOPT_POSTFIELDS, $info); // post the fields
curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~pm458/cs490/back/logic.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch); // store response into variable
curl_close($ch); // free up the curl handler
echo $response; // get the response
//-----------------------------------------------------------------------
?>