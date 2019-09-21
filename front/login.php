<?php
$json_str = file_get_contents('php://input');
$output = json_decode($json_str, true);
$username="none";
$password="none";

if(isset($output['username'])) $username = $output['username'];
if(isset($output['password'])) $username = $output['password'];

$credentials=pass_credentials($username, md5($password)); // setting up the function
$data = array('$username' => $username, 'password' =>$password); /// data that is passed
print "<h2>".$credentials."</h2>"; // a confirm statement of what was passed

// curl function to mid

function pass_credentials($username,$password){
    $data = array('$username' => $username, 'password' =>$password); // var 1
    $url = "https://web.njit.edu/~vmp27/cs490/mid/login.php"; // var 2
    $ch = curl_init(); // init the curl function 
    curl_setopt($ch, CURLOPT_URL, $url); // destination
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // HTML returned goes into $output
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // contains user/pass, option to use string encode
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}
?>