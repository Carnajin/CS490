<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$question = NULL;
$tstCase1 = NULL;
$tstCase2 = NULL;
$tstCase3 = NULL;
$tstCase4 = NULL;
$tstCase5 = NULL;
$tstCase6 = NULL;
$tstCaseResult1 = NULL;
$tstCaseResult2 = NULL;
$tstCaseResult3 = NULL;
$tstCaseResult4 = NULL;
$tstCaseResult5 = NULL;
$tstCaseResult6 = NULL;
$casePoints = NULL;
$namePoints = NULL;
$colPoints = NULL;
$whPoints = NULL;
$fPoints = NULL;
$returnPoints = NULL;
$printPoints = NULL;
if (isset($_POST["question"])) {
    $question = $_POST["question"];
}

if (isset($_POST["difficulty"])) {
    $difficulty = $_POST["difficulty"];
}

if (isset($_POST['casePoints'])) {
    $cPoints = $_POST["casePoints"];
    $casePoints = explode(" ", $cPoints);
}
if (isset($_POST['namePoints'])) {
    $nPoints = $_POST["namePoints"];
    $namePoints = str_split($nPoints);
}
if (isset($_POST['colPoints'])) {
    $cPoints = $_POST["colPoints"];
    $colPoints = str_split($cPoints);
}
if (isset($_POST['whPoints'])) {
    $wPoints = $_POST["whPoints"];
    $whPoints = str_split($wPoints);
}
if (isset($_POST['fPoints'])) {
    $foPoints = $_POST["fPoints"];
    $fPoints = str_split($foPoints);
}
if (isset($_POST['printPoints'])) {
    $pPoints = $_POST["printPoints"];
    $printPoints = str_split($pPoints);
}
if (isset($_POST['returnPoints'])) {
    $retPoints = $_POST["returnPoints"];
    $returnPoints = str_split($retPoints);
}
if (isset($_POST['tce1Points'])) {
    $tc1P = $_POST["tce1Points"];
    $tce1Points = explode(",", $tc1P);
}
if (isset($_POST['tce2Points'])) {
    $tc2P = $_POST["tce2Points"];
    $tce2Points = explode(",", $tc2P);
}
if (isset($_POST['tce3Points'])) {
    $tc3P = $_POST["tce3Points"];
    $tce3Points = explode(",", $tc3P);
}
if (isset($_POST['tce4Points'])) {
    $tc4P = $_POST["tce4Points"];
    $tce4Points = explode(",", $tc4P);
}
if (isset($_POST['tce5Points'])) {
    $tc5P = $_POST["tce5Points"];
    $tce5Points = explode(",", $tc5P);
}
if (isset($_POST['tce6Points'])) {
    $tc6P = $_POST["tce6Points"];
    $tce6Points = explode(",", $tc6P);
}
if (isset($_POST['nPoints'])) {
    $naPoints = $_POST["nPoints"];
    $nPoints = explode(",", $naPoints);
}
if (isset($_POST['rtPoints'])) {
    $rP = $_POST["rtPoints"];
    $rtPoints = explode(",", $rP);
}
if (isset($_POST['whilePoints'])) {
    $wP = $_POST["whilePoints"];
    $whilePoints = explode(",", $wP);
}
if (isset($_POST['colonPoints'])) {
    $cP = $_POST["colonPoints"];
    $colonPoints = explode(",", $cP);
}
if (isset($_POST['prPoints'])) {
    $pP = $_POST["prPoints"];
    $prPoints = explode(",", $pP);
}
if (isset($_POST['forPoints'])) {
    $fP = $_POST["forPoints"];
    $forPoints = explode(",", $fP);
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
if (isset($_POST["tcsr1"])) {
    $tstCaseResult1 = $_POST["tcsr1"];
}
if (isset($_POST['tcs2'])) {
    $tstCase2 = $_POST["tcs2"];
}
if (isset($_POST["tcsr2"])) {
    $tstCaseResult2 = $_POST["tcsr2"];
}
if (isset($_POST['tcs3'])) {
    $tstCase3 = $_POST["tcs3"];
}
if (isset($_POST["tcsr3"])) {
    $tstCaseResult3 = $_POST["tcsr3"];
}
if (isset($_POST['tcs4'])) {
    $tstCase4 = $_POST["tcs4"];
}
if (isset($_POST["tcsr4"])) {
    $tstCaseResult4 = $_POST["tcsr4"];
}
if (isset($_POST['tcs5'])) {
    $tstCase5 = $_POST["tcs5"];
}
if (isset($_POST["tcsr5"])) {
    $tstCaseResult5 = $_POST["tcsr5"];
}
if (isset($_POST['tcs6'])) {
    $tstCase6 = $_POST["tcs6"];
}
if (isset($_POST["tcsr6"])) {
    $tstCaseResult6 = $_POST["tcsr6"];
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
    $code = explode(" ,", $co);
}
if (isset($_POST['questionA'])) {
    $qa = $_POST["questionA"];
    $questionA = explode(",", $qa);
}
$cs = NULL;
if (isset($_POST['cases'])) {
    $cs = $_POST["cases"];
}

include("account.php");

$db = mysqli_connect($host, $username, $password, $project) OR die(mysqli_connect_error());
mysqli_set_charset($db, 'utf8');
if (mysqli_connect_error()) {
    echo "Could not connect" . mysqli_connect_error();
    exit();
}

mysqli_select_db($db, $project);

if ($message == 'CreateQuestion') {
    $p = "INSERT INTO questionBank (Question, Difficulty, Topic, Description, TestCase1, TestCase2, TestCase3, TestCase4, TestCase5, TestCase6, TestCaseResult1, TestCaseResult2, TestCaseResult3, TestCaseResult4, TestCaseResult5, TestCaseResult6)
  VALUES ('$question', '$difficulty', '$topic', '$description', '$tstCase1', '$tstCase2', '$tstCase3', '$tstCase4', '$tstCase5', '$tstCase6', '$tstCaseResult1', '$tstCaseResult2', '$tstCaseResult3', '$tstCaseResult4', '$tstCaseResult5', '$tstCaseResult6')";
    ($t = mysqli_query($db, $p)) or die (mysqli_error($db));

}

if ($message == "CreateExam") {
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
    testCase3 varchar (255),
    testCase4 varchar (255),
    testCase5 varchar (255),
    testCase6 varchar (255),
    testCaseResult1 varchar (255),
    testCaseResult2 varchar (255),
    testCaseResult3 varchar (255),
    testCaseResult4 varchar (255),
    testCaseResult5 varchar (255),
    testCaseResult6 varchar (255),
    answers varchar (255),
    comments varchar (255),
    points varchar (255),
    tcError1 varchar (255),
    tcError2 varchar (255),
    tcError3 varchar (255),
    tcError4 varchar (255),
    tcError5 varchar (255),
    tcError6 varchar (255),
    nameError varchar (255),
    colError varchar (255),
    whileError varchar (255),
    forError varchar (255),
    printError varchar (255),
    returnError varchar (255),
    grade varchar (255),
    FOREIGN KEY (questionID)
        REFERENCES questionBank(questionID),
    PRIMARY KEY (questionID)
  )";
    ($nT = mysqli_query($db, $newT)) or die (mysqli_error($db));
//make insert statement here;
    for ($i = 0; $i < count($qPts); $i++) {
        $in = "INSERT INTO $examN(questionID,question,difficulty,topic,description,testCase1,testCase2, testCase3, testCase4, testCase5, testCase6, testCaseResult1, testCaseResult2, testCaseResult3, testCaseResult4, testCaseResult5, testCaseResult6)
  SELECT questionID, Question, Difficulty, Topic,Description, TestCase1, TestCase2, TestCase3, TestCase4, TestCase5, TestCase6, TestCaseResult1, TestCaseResult2, TestCaseResult3, TestCaseResult4, TestCaseResult5, TestCaseResult6
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
                "comments" => $rt['comments'],
                "grade" => $rt['grade'],
                "tcError1" => $rt['tcError1'],
                "tcError2" => $rt['tcError2'],
                "tcError3" => $rt['tcError3'],
                "tcError4" => $rt['tcError4'],
                "tcError5" => $rt['tcError5'],
                "tcError6" => $rt['tcError6'],
                "nameError" => $rt['nameError'],
                "colError" => $rt['colError'],
                "whileError" => $rt['whileError'],
                "forError" => $rt['forError'],
                "printError" => $rt['printError'],
                "returnError" => $rt['returnError'],
                "points" => $rt['points']);
        }
    }
    echo json_encode($out);
} elseif ($cs != NULL){
  $out = array();
  for($i = 0; $i < count($questionA);$i++){
    $rQ = "select * from $examN WHERE question = '$questionA[$i]'";
    ($q = mysqli_query($db, $rQ)) or die (mysqli_error($db));
    $r = mysqli_fetch_array($q);
            $out[] = array(
                "top" => $r['topic'],
                "testCase1" => $r['testCase1'],
                "testCase2" => $r['testCase2'],
                "testCase3" => $r['testCase3'],
                "testCase4" => $r['testCase4'],
                "testCase5" => $r['testCase5'],
                "testCase6" => $r['testCase6'],
                "testCaseResult1" => $r['testCaseResult1'],
                "testCaseResult2" => $r['testCaseResult2'],
                "testCaseResult3" => $r['testCaseResult3'],
                "testCaseResult4" => $r['testCaseResult4'],
                "testCaseResult5" => $r['testCaseResult5'],
                "testCaseResult6" => $r['testCaseResult6']);
    }
    echo json_encode($out);
}
elseIf ($message == "InstructorViewExam") {
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
                "grade" => $rt['grade'],
                "points" => $rt['points']);
        }

    }
    echo json_encode($out);
}
elseIf ($message == "ReleaseExam") {
  $total = 0;
  $s = "UPDATE allExams SET releaseStatus = '2' WHERE examName = '$examID'";
  ($t = mysqli_query($db, $s)) or die (mysqli_error($db));
  for($i = 0; $i < count($comments);$i++){
  $g = "UPDATE $examID SET comments = '$comments[$i]', tcError1 = '$tce1Points[$i]', tcError2 = '$tce2Points[$i]', tcError3 = '$tce3Points[$i]', tcError4 = '$tce4Points[$i]', tcError5 = '$tce5Points[$i]', tcError6 = '$tce6Points[$i]', nameError = '$nPoints[$i]', colError = '$colonPoints[$i]', whileError = '$whilePoints[$i]', forError = '$forPoints[$i]', printError = '$prPoints[$i]', returnError = '$rtPoints[$i]',  grade = '$grade[$i]' WHERE questionID = '$quest[$i]'";
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

    $totGrade = 0;
    $rQuery = "select * from $examN WHERE question = '$questionA[$i]'";
    ($qr = mysqli_query($db, $rQuery)) or die (mysqli_error($db));
    $r = mysqli_fetch_array($qr, MYSQLI_ASSOC);
    $pts = $r['points'];
    $tc1 = intval($casePoints[$i][0]);
    $tc2 = intval($casePoints[$i][1]);
    $tc3 = intval($casePoints[$i][2]);
    $tc4 = intval($casePoints[$i][3]);
    $tc5 = intval($casePoints[$i][4]);
    $tc6 = intval($casePoints[$i][5]);
    $totGrade = intval($pts) - $tc1 - $tc2 - $tc3 - $tc4 - $tc5 - $tc6 - intval($namePoints[$i]) - intval($colPoints[$i]) - intval($whPoints[$i]) - intval($fPoints[$i]) - intval($printPoints[$i]) - intval($returnPoints[$i]);

    $g = "UPDATE $examN SET answers = '$code[$i]', tcError1 = '$tc1', tcError2 = '$tc2', tcError3 = '$tc3', tcError4 = '$tc4', tcError5 = '$tc5', tcError6 = '$tc6', nameError = '$namePoints[$i]', colError = '$colPoints[$i]', whileError = '$whPoints[$i]', forError = '$fPoints[$i]', printError = '$printPoints[$i]', returnError = '$returnPoints[$i]', grade = '$totGrade' WHERE question = '$questionA[$i]'";
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
                "testCase2" => $r['TestCase2'],
                "testCase3" => $r['TestCase3'],
                "testCase4" => $r['TestCase4'],
                "testCase5" => $r['TestCase5'],
                "testCase6" => $r['TestCase6'],
                "testCaseResult1" => $r['TestCaseResult1'],
                "testCaseResult2" => $r['TestCaseResult2'],
                "testCaseResult3" => $r['TestCaseResult3'],
                "testCaseResult4" => $r['TestCaseResult4'],
                "testCaseResult5" => $r['TestCaseResult5'],
                "testCaseResult6" => $r['TestCaseResult6']);
        }
    }
//end function
    echo json_encode($out);
}

mysqli_close($db);
?>
