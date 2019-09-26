<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$usId=$_POST["ucid"];
$pass=$_POST["pass"];
include("account.php");
$db = mysqli_connect($host,$username,$password,$project) OR die(mysqli_connect_error());
mysqli_set_charset($db,'utf8');
if(mysqli_connect_error()){
    echo "Could not connect".mysqli_connect_error();
    exit();
}

mysqli_select_db($db,$project);
/*$hash = password_hash($pass,PASSWORD_DEFAULT);
$p = "update user set pwdUsers = '$hash' where uidUsers = '$usId'";
print $hash;
($t = mysqli_query($db, $p)) or die (mysqli_error($db));

*/
$s = "select * from user where uidUsers='$usId'";
($t = mysqli_query($db, $s)) or die (mysqli_error($db));
$num = mysqli_num_rows($t);
if($num == 0) {
  $out = 0;
}
else {
  $r = mysqli_fetch_array($t,MYSQLI_ASSOC);
  $h = $r['pwdUsers'];
  if(password_verify($pass,$h)){
  $out = 1;
  }
  else{
  $out = 0;
  }
}
echo json_encode($out);
mysqli_close($db);
?>