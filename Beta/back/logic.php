<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
if (isset($_POST['error1'])) {
    $err = $_POST["error1"];
    $error1 = str_split($err);
}
if (isset($_POST['error2'])) {
    $error2 = $_POST["error2"];
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
    $co = $_POST["code"];
    $code = explode(";,", $co);
}
if (isset($_POST['questionA'])) {
    $qa = $_POST["questionA"];
    $questionA = explode(",", $qa);
}


include("account.php");

$db = mysqli_connect($host, $username, $password, $project) OR die(mysqli_connect_error());
mysqli_set_charset($db, 'utf8');
if (mysqli_connect_error()) {
    echo "Could not connect" . mysqli_connect_error();
    exit();
}

mysqli_select_db($db, $project);

if ($question != NULL) {
    $p = "INSERT INTO questionBank (Question, Difficulty, Topic, Description, TestCase1, TestCase2, TestCaseResult1, TestCaseResult2)
  VALUES ('$question', '$difficulty', '$topic', '$description', '$tstCase1', '$tstCase2', '$tstCaseResult1', '$tstCaseResult2')";
    ($t = mysqli_query($db, $p)) or die (mysqli_error($db));

}

if ($examN != NULL && $message != "TakeExam" ) {
    $e = "INSERT INTO allExams(examName, releaseStatus)
  VALUES ('$examN', 0)";
    ($eQuery = mysqli_query($db, $e)) or die (mysqli_error($db));
    $newT = "CREATE TABLE $examN (
    questionID int (255) NOT NULL AUTO_INCREMENT,
    question varchar(255),
    difficulty varchar(255),
    topic varchar(255),
    description varchar(255),
    testCase1 varchar(255),
    testCase2 varchar (255),
    testCaseResult1 varchar (255),
    testCaseResult2 varchar (255),
    answers varchar (255),
    comments varchar (255),
    points varchar (255),
    error1 varchar (255),
    error2 varchar (255),
    grade varchar (255),
    FOREIGN KEY (questionID)
        REFERENCES questionBank(questionID),
    PRIMARY KEY (questionID)
  )";
    ($nT = mysqli_query($db, $newT)) or die (mysqli_error($db));
//make insert statement here;
    for ($i = 0; $i < count($qPts); $i++) {
        $in = "INSERT INTO $examN(questionID,question,difficulty,topic,description,testCase1,testCase2,testCaseResult1,testCaseResult2)
  SELECT questionID, Question, Difficulty, Topic,Description, TestCase1,TestCase2, TestCaseResult1, TestCaseResult2
  FROM questionBank
  WHERE questionID = $quest[$i]";
        $exT = "UPDATE $examN SET points = '$qPts[$i]' WHERE questionID = $quest[$i]";
        ($ex = mysqli_query($db, $in)) or die (mysqli_error($db));
        ($v = mysqli_query($db, $exT)) or die (mysqli_error($db));
    }
}

if ($message == "GetExam") {
    $s = "select * from allExams";
    ($t = mysqli_query($db, $s)) or die (mysqli_error($db));
    $num = mysqli_num_rows($t);
    $out = array();
    if ($num == 0) {
        $out = array("Nothing" => "Empty");
    } else {
        while ($r = mysqli_fetch_array($t)) {
            $out[] = array(
                "examID" => $r['examID'],
                "examName" => $r['examName'],
                "releaseStatus" => $r['releaseStatus']);
        }
    }
    echo json_encode($out);
} elseif ($message == "StudentViewExam") {
    $s = "select * from allExams WHERE examName = '$examID'";
    ($t = mysqli_query($db, $s)) or die (mysqli_error($db));
    $num = mysqli_num_rows($t);
    $out = array();
    if ($num == 0) {
        $out = array("Nothing" => "Empty");
    } else {
        $r = mysqli_fetch_array($t, MYSQLI_ASSOC);
        $rQuery = "select * from $examID";
        ($qr = mysqli_query($db, $rQuery)) or die (mysqli_error($db));
        while ($rt = mysqli_fetch_array($qr)) {
            $out[] = array(
                "question" => $rt['question'],
                "questionID" => $rt['questionID'],
                "description" => $rt['description'],
                "topic" => $rt['topic'],
                "code" => $rt['answers'],
                "grade" => $rt['grade'],
                "comments" => $rt['comments'],
                "error1" => $rt['error1'],
                "error2" => $rt['error2'],
                "points" => $rt['points']);
        }
    }
    echo json_encode($out);
} elseIf ($message == "InstructorViewExam") {
    $s = "select * from allExams WHERE examID = '$examID'";
    ($t = mysqli_query($db, $s)) or die (mysqli_error($db));
    $num = mysqli_num_rows($t);
    $out = array();
    if ($num == 0) {
        $out = array("Nothing" => "Empty", "examId" => $examID, "examName" => $examN);
    } else {
        $r = mysqli_fetch_array($t, MYSQLI_ASSOC);
        $eN = $r['examName'];
        $rQuery = "select * from $eN";
        ($qr = mysqli_query($db, $rQuery)) or die (mysqli_error($db));
        while ($rt = mysqli_fetch_array($qr)) {
            $out[] = array(
                "question" => $rt['question'],
                "description" => $rt['description'],
                "points" => $rt['points']);
        }

    }
    echo json_encode($out);
}
elseIf ($message == "ReleaseExam") {
  $total = 0;
  $s = "UPDATE allExams SET releaseStatus = '2' WHERE examName = '$examID'";
  ($t = mysqli_query($db, $s)) or die (mysqli_error($db));
  for($i = 0; $i < count($grade);$i++){
  $g = "UPDATE $examID SET comments = '$comments[$i]', grade = '$grade[$i]' WHERE questionID = '$quest[$i]'";
  ($at = mysqli_query($db, $g)) or die (mysqli_error($db));
  $total += intval($grade[$i]);
  }
  $totG = "UPDATE allExams SET grade = '$total' WHERE examName = '$examID'";
  ($to = mysqli_query($db, $totG)) or die (mysqli_error($db));

}
elseIf($message == "TakeExam"){

  $s = "UPDATE allExams SET releaseStatus = 1 WHERE examName = '$examN'";
  $out = array();
  ($t = mysqli_query($db, $s)) or die (mysqli_error($db));
  for($i = 0; $i < count($code);$i++){
     $g = "UPDATE $examN SET answers = '$code[$i]', error1 = '$error1[$i]',error2 = 0 WHERE question = '$questionA[$i]'";
    ($at = mysqli_query($db, $g)) or die (mysqli_error($db));

  }

}
else {

    $s = "select * from questionBank";
    ($t = mysqli_query($db, $s)) or die (mysqli_error($db));
    $num = mysqli_num_rows($t);
    $out = array();
    if ($num == 0) {
        $out = array("Nothing" => "Empty");
    } else {
        while ($r = mysqli_fetch_array($t)) {
            $out[] = array(
                "questionID" => $r['questionID'],
                "question" => $r['Question'],
                "difficulty" => $r['Difficulty'],
                "topic" => $r['Topic'],
                "description" => $r['Description'],
                "testCase1" => $r['TestCase1'],
                "testCaseResult1" => $r['TestCaseResult1'],
                "testCaseResult2" => $r['TestCaseResult2'],
                "testCase2" => $r['TestCase2']);
        }
    }
//end function
    echo json_encode($out);
}

mysqli_close($db);
?>
