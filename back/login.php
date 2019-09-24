<?php
$json_str = file_get_contents('php://input');
$output = json_decode($json_str, true);
$usId="none";
$pass="none";
if(isset($output['username'])) $usId = $output['username'];
if(isset($output['password'])) $pass = $output['password'];
include("account.php");
$db = mysqli_connect($host,$username,$password,$project) OR die(mysqli_connect_error());
mysqli_set_charset($db,'utf8');
if(mysqli_connect_error()){
    echo "Could not connect".mysqli_connect_error();
    exit();
}
print "Success <br>";

mysqli_select_db($db,$project);
print $usId . "<br>" ;
print $pass . "<br>";
$hash = password_hash($pass,PASSWORD_DEFAULT);
$p = "update users set pwdUsers = '$hash' where uidUsers = '$usId'";
print $hash;
($t = mysqli_query($db, $p)) or die (mysqli_error($db));

/*$s = "select * from users where uidUsers='$usId'";
($t = mysqli_query($db, $s)) or die (mysqli_error($db));
$num = mysqli_num_rows($t);
if($num == 0) {
  $out = "false";
}
else {
  $r = mysqli_fetch_array($t,MYSQLI_ASSOC);
  $h = $r['pwdUsers'];
  if(password_verify($pass,$h)){
  echo "Password is valid<br>";
  $out = "true";
  }
  else{
  echo "Invalid password<br>";
  $out = "false";
  }
}
if($out == "true"){
  echo json_encode($out);
}
*/
mysqli_close($db);
?>