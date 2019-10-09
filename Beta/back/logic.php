<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/*
if(isset($_POST['functionName']){
  $question = $_POST["functionName"];
}
if(isset($_POST['functionDiff']){
  $difficulty = $_POST["functionDiff"];
}
if(isset($_POST['functionTopic']){
  $topic = $_POST["functionTopic"];
}
$points = 50;
if(isset($_POST['functionDesc']){
  $description = $_POST["functionDesc"];
}
if(isset($_POST['testCase1']){
  $tstCase1 = $_POST["testCase1"];
}
if(isset($_POST['testCase2']){
  $tstCase2 = $_POST["testCase2"];
}
*/
include("account.php");

$db = mysqli_connect($host,$username,$password,$project) OR die(mysqli_connect_error());
mysqli_set_charset($db,'utf8');
if(mysqli_connect_error()){
    echo "Could not connect".mysqli_connect_error();
    exit();
}

mysqli_select_db($db,$project);
/*
$p = "INSERT INTO questionBank (Question, Difficulty, Topic, Points, Description, TestCase1, TestCase2)
VALUES ('$question', '$difficulty', '$topic', '$points', '$description', '$tstCase1', '$tstCase2')";
($t = mysqli_query($db, $p)) or die (mysqli_error($db));
*/
$s = "select * from questionBank";
($t = mysqli_query($db, $s)) or die (mysqli_error($db));
$num = mysqli_num_rows($t);
$out = array();
if($num == 0) {
  $out = array("Nothing" => "Empty");
}
else{
  while($r = mysqli_fetch_array($t)){
  $out[] = array(
  "question" => $r['Question'],
  "difficulty" => $r['Difficulty'],
  "topic" => $r['Topic'],
  "points" => $r['Points'],
  "description" => $r['Description'],
  "testCase1" => $r['TestCase1'],
  "testCase2" => $r['TestCase2']);
  }
}

echo json_encode($out);

?>
