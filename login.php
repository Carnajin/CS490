<?php
$str_json = file_get_contents('php://input'); //Receiving data from backend
$getresponse = json_decode($str_json, true); //Decoding backend data and putting into a string
$uid_users = "none";
$uid_uid_pass = "none";

if(isset($response['uid_users'])) $uid_users = $response['uid_users']; 
if(isset($response['uid_pass'])) $uid_pass = $response['uid_pass'];
//Checking if user and uid_password entered at login page matches with user and uid_pass in the database


$res_project=login_project($uid_users,md5($uid_pass));

function login_project($uid_users,$uid_pass)
{
	$data = array('uid_users' => $uid_users,'uid_pass' =>$uid_pass);
	$url = "pm458/cs490/back/login.php";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	$response = curl_exec($ch);
	curl_close ($ch);
    return $response;

    //vnp27
}
?>

