<?php
$username = $_POST ["username"];
$password = $_POST ["password"];

$json_str = file_get_contents('php://input');
$output = json_decode($json_str, true);

$credentials=pass_credentials($username, $password); // setting up the function
$data = array("username" => $username, "password" =>$password); /// data that is passed
print "<h2>".$credentials."</h2>"; // a confirm statement of what was passed

// curl function to mid

function pass_credentials($username,$password){
    $data = array("username" => $username, "password" =>$password); // var 1
    $url = "test/index.html"; // var 2
    $data_string = http_build_query($data);
    $ch = curl_init($url); // init the curl function 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true); // destination
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string); // contains user/pass, option to use string encode
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
    }
?>