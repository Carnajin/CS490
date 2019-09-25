<?php
$username = $_POST["ucid"];
$password = $_POST["pass"];

$info = ["ucid" => $username, "pass" => $pwd];

$ch = curl_init();
curl_setopt($ch, CURLOPT_POSTFIELDS, $info);
curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~vnp27/cs490/mid/login.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

echo $response;
?>