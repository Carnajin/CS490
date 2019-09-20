<?php
include("account.php");
$db = mysqli_connect($host,$username,$password,$project) OR die(mysqli_connect_error());
mysqli_set_charset($db,'utf8');
if(mysqli_connect_error()){
    echo "Could not connect".mysqli_connect_error();
    exit();
}
print "Success";
mysqli_select_db($db,$project);
if($_POST['user'] $$ $_POST['password']){
    $pass = $_POST['password'];
    $uId = $_POST['user'];
}
$hash = password_hash($pass,PASSWORD_DEFAULT);
$p = "update users set pwdUsers = '$hash' where uidUsers = '$uId'";
($t = mysqli_query($db, $p)) or die (mysqli_error($db));
mysqli_close($db);
?>