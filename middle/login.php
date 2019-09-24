<?php
$json_str = file_get_contents('php://input'); //Receiving data from backend
$output = json_decode($json_str, true); //Decoding backend data and putting into a string

if(isset($_POST['username'], $_POST['password']))
{
	$username = ($_POST['username']);
	$password = ($_POST['password']);
}

//Checking if user and uid_password entered at login page matches with user and password in the database


$res_project=login_project($username, $password);
echo $res_project;
function login_project($username,$password)
{
	$data = array('username' => $username,'password' =>password);
	$url = "pm458/cs490/back/login.php";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	$output = curl_exec($ch);
	curl_close ($ch);
	return $output;

    //vnp27
}


// curl njit
/*
function login_njit($username,$password)
{
	$url = "https://cp4.njit.edu/cp/home/login";
	$data= array("username" => $username,"password" =>$password,"uuid" => "0xACA021");
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); 
	$output = curl_exec($ch);
	curl_close ($ch);
	if (strpos($output,"Error: Failed Login")==false) return "NJIT Accept";
	return "NJIT Reject";
}
$res_project2 = login_njit("vnp27", "fsadf");
echo $res_project2;
*/
?>

