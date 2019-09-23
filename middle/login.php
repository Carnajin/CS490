<?php
$json_str = file_get_contents('php://input'); //Receiving data from backend
$getoutput = json_decode($json_str, true); //Decoding backend data and putting into a string
$username = "none";
$password = "none";

if(isset($output['username'])) $username = $output['username']; 
if(isset($output['uid_pass'])) $uid_pass = $output['uid_pass'];
//Checking if user and uid_password entered at login page matches with user and uid_pass in the database


$res_project=login_project($username,md5($uid_pass));

function login_project($username,$uid_pass)
{
	$data = array('username' => $username,'uid_pass' =>$uid_pass);
	$url = "pm458/cs490/back/login.php";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	$output
 = curl_exec($ch);
	curl_close ($ch);
	return $output
;

    //vnp27
}
?>

