<?php
$username = $_POST ["username"];
$password = $_POST ["password"];

$json_str = json_decode(file_get_contents('php://input'), true);

$credentials=pass_credentials($username, $password); // setting up the function
$data = array("username" => $username, "password" =>$password); /// data that is passed
print "<h2>".$credentials."</h2>"; // a confirm statement of what was passed

// curl function to mid

function pass_credentials($username,$password){
    $data = array("username" => $username, "password" =>$password); // var 1
    $url = "https://web.njit.edu/~vnp27/cs490/mid/login.php"; // var 2
    $data_string = http_build_query($data);
    $ch = curl_init($url); // init the curl function 
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string); // contains user/pass, option to use string encode
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    echo $output;
    curl_close($ch);
    return $output;
    }
?>