<?php
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
$p = "update users set pwdUsers = '$hash' where uidUsers = '$usId'";
print $hash;
($t = mysqli_query($db, $p)) or die (mysqli_error($db));

*/
$s = "select * from users where uidUsers='$usId'";
($t = mysqli_query($db, $s)) or die (mysqli_error($db));
$num = mysqli_num_rows($t);
if($num == 0) {
  $out = "false";
}
else {
  $r = mysqli_fetch_array($t,MYSQLI_ASSOC);
  $h = $r['pwdUsers'];
  if(password_verify($pass,$h)){
  $out = array("back"=>"1");
  }
  else{
  $out = array("back"=>"0");
  }
}
echo json_encode($out);
mysqli_close($db);
?>