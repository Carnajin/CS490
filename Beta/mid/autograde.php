<?php
$question = NULL;
if (isset($_POST["question"])) {
    $question = $_POST["question"];
}

if (isset($_POST["difficulty"])) {
    $difficulty = $_POST["difficulty"];
}
if (isset($_POST['topic'])) {
    $topic = $_POST["topic"];
}

if (isset($_POST['description'])) {
    $description = $_POST["description"];
}
if (isset($_POST['tcs1'])) {
    $tstCase1 = $_POST["tcs1"];
}
if (isset($_POST['tcs2'])) {
    $tstCase2 = $_POST["tcs2"];
}
if (isset($_POST["tcsr1"])) {
    $tstCaseResult1 = $_POST["tcsr1"];
}
if (isset($_POST["tcsr2"])) {
    $tstCaseResult2 = $_POST["tcsr2"];
}
$message = NULL;
if (isset($_POST['message'])) {
    $message = $_POST["message"];
}
if (isset($_POST['fName'])) {
    $fName = $_POST["fName"];
}
if (isset($_POST['return'])) {
    $return = $_POST["return"];
}
$examN = NULL;
$examID = NULL;
if (isset($_POST['examId'])) {
    $examID = $_POST["examId"];
}
if (isset($_POST['examName'])) {
    $examN = $_POST["examName"];
}
if (isset($_POST['questionID'])) {
    $qtID = $_POST["questionID"];
    $quest = explode(",", $qtID);
}
if (isset($_POST['points'])) {
    $pts = $_POST["points"];
    $qPts = explode(",", $pts);
}
if (isset($_POST['grade'])) {
    $gr = $_POST["grade"];
    $grade = explode(",", $gr);
}
if (isset($_POST['comments'])) {
    $com = $_POST["comments"];
    $comments = explode(",", $com);
}
if (isset($_POST['code'])) {
    $code = $_POST["code"];
}
if (isset($_POST['questionA'])) {
    $questionA = $_POST["questionA"];
}

function get_string_between($string, $start, $end)
{
    $string = ' ' . $string;
    $initial = strpos($string, $start)+4;
    if ($initial == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $initial) - $initial;
    return substr($string, $initial, $len);
}


function autograde($code,$questionA)
{
$comment = " ";
$testCasePoints = "";
$fNamePoints = "";
// running student's code
//$file = "textfile.txt";
//$myfile = fopen($file, "w");
$txt = explode(": ",$code);
$questionN = explode(",",$questionA);
//fwrite($myfile, $txt);
//fclose($myfile);
//$output = exec('python ' . $file); // getting

//$outputs = explode(" ", $output);
//echo $outputs
for($i = 0;$i < count($questionN);$i++){
  $parsed = get_string_between($txt[$i], "def ","(");
  if($parsed == $questionN[$i]){
    $fNamePoints .= "0";
  }
  else{
    $fNamePoints .= "5";
  }
}
return $fNamePoints;
}

$fPts = autograde($code,$questionA);
$data = array("code" => $code, "error1" => $fPts, "examName" => $examN, "questionA" => $questionA, "message" => $message);
$ch = curl_init("https://web.njit.edu/~pm458/cs490/back/logic.php");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
// echo $response;
/*

//curl
// StudentViewExam  , ex examid: 41, 43, 47
$data = array("message" => "StudentViewExam", "examID" => "47"); // returning "nothing" talk to backend guy
// $data = array("message" => "Stude");
echo $outputs;


$ch = curl_init("https://web.njit.edu/~pm458/cs490/back/logic.php");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
// echo $response;

// parse the response to get answers
// then compare the answers with the output


/*
$key = explode(" ", $keywords);

for($x=0;$x<count($key);$x++)
{
    $val = strpos($txt, $key[$x]);

    if(is_numeric($val))
    {
        $points -= 0;
    }

    else if($key[$x] == "return")
    {
        $comment .= "Missing return statement, -5 points\n";
        $points -= 5;
    }
    else if($key[$x] == "for")
    {
        $comment .= "Missing for loop, -5 points\n";
        $points -= 5;
    }
    else if($key[$x] == "if")
    {
        $comment .= "Missing if statement, -5 points\n";
        $points -= 5;
    }
    else
    {
        $parsed = get_string_between($txt, 'def ', '(');
        if(strpos($key[$x], $parsed) !== false)
        {
            $points -= 0;
        }
        else
        {
            $comment .= "Incorrect function name, -5 points\n";
            $points -= 5;
        }
    }
    */
// }
  // return the number of points
  // echo $points;
//}

//$test = "print('Hello')";
//$num_of_points = autograde($test); // take the num of points and store in the database.
// basically make a curl call to 'examName' as the key, and the value is exam name.

/*

When you take points off for exec instead do:
$tstCasePoints += 10;
then check if the second test case works if not:
$tstCasePoints += 10;

Then check the function name:
if it doesnt work,
$fNamePoints += 10;

$output = array("error1" => $fNamePoints, "error2" => $tstCasePoints);
return $output;
after the function curl this to me
*/
?>
