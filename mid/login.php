<?php
//Checking if user and uid_password entered at login page matches with user and password in the database
$username = $_POST["ucid"];
$password = $_POST["pass"];

$res_project=login_project($username,$password);
echo $res_project;
function login_project($username,$password)
{
	$data = array('ucid' => $username,'pass' =>$password);
	$url = "https://web.njit.edu/~pm458/cs490/back/login.php";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	curl_close ($ch);
	return $output;

    //vnp27
}

 //curl njit
 
$njitlogin = login_njit($username, $password);

function login_njit($username,$password)
{
  
	$url = "https://aevitepr2.njit.edu/MyHousing/login.cfm";
	$data = array('ucid' => $username,'pass' =>$password);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
	$output = curl_exec($ch);
	curl_close ($ch);
 
	return $output;

}
echo $njitlogin;
/*if($njitlogin == "NJIT Accept")
{
  echo json_encode("1");
  
}
else
{
  echo json_encode("0");
}
*/
?>

