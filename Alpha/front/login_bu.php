<?php

$username = "none";
$password = "none";

if(isset($output['user'])) $username = $output['user'];
if(isset($output['pass'])) $password = $output['pass'];

$url = "https://web.njit.edu/~vnp27/cs490/mid/login.php"; // var 2
$data = array("user" => $username, "pass" => $password); // var 1
$data_string = json_encode($data); // readable string
$ch = curl_init($url); // init the curl function
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string); // contains user/pass, option to use string encode
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // true to store the response in $output
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' .strlen($data_string))
);

$response = curl_exec($ch);
echo($response);
curl_close($ch);

?>
