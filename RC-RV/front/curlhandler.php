<?php
//---------Message for cases-------------------
$message = $_POST["message"];
//---------Cases for sending POST data-----------------------
switch($message) {
  
  case "CreateExam":    
    $examName = $_POST["examName"];
    $questionID = $_POST["questionID"];
    $points = $_POST["points"];
    
    $data = array(
      "message" => $message,
      "examName" => $examName,
      "questionID" => $questionID,
      "points" => $points,
    );
    break;
  case "CreateQuestion":
    $testCase1 = $_POST["tcs1"];
    $testCase2 = $_POST["tcs2"];
    $testCase3 = $_POST["tcs3"];
    $testCase4 = $_POST["tcs4"];
    $testCase5 = $_POST["tcs5"];
    $testCase6 = $_POST["tcs6"];
    $testCaseResult1 = $_POST["tcsr1"];
    $testCaseResult2 = $_POST["tcsr2"];
    $testCaseResult3 = $_POST["tcsr3"];
    $testCaseResult4 = $_POST["tcsr4"];
    $testCaseResult5 = $_POST["tcsr5"];
    $testCaseResult6 = $_POST["tcsr6"];
    $question = $_POST["question"];
    $description = $_POST["description"];
    $difficulty = $_POST["difficulty"];
    $topic = $_POST["topic"];
    
    $data = array(
      "message" => $message,
      "tcs1" => $testCase1,
      "tcs2" => $testCase2,
      "tcs3" => $testCase3,
      "tcs4" => $testCase4,
      "tcs5" => $testCase5,
      "tcs6" => $testCase6,
      "tcsr1" => $testCaseResult1,
      "tcsr2" => $testCaseResult2,
      "tcsr3" => $testCaseResult3,
      "tcsr4" => $testCaseResult4,
      "tcsr5" => $testCaseResult5,
      "tcsr6" => $testCaseResult6,
      "question" => $question,
      "description" => $description,
      "difficulty" => $difficulty,
      "topic" => $topic
    );
    break;
  case "ReleaseExam":
    $examID = $_POST["examId"];
    $questionID = $_POST["questionID"];
    $comments = $_POST["comments"];
    $grade = $_POST["grade"];
    $fname = $_POST["nameE"];
    $return = $_POST["return"];
    $while = $_POST["while"];
    $colon = $_POST["colon"];
    $print = $_POST["print"];
    $for = $_POST["for"];
    $tce1 = $_POST["tce1"];
    $tce2 = $_POST["tce2"];
    $tce3 = $_POST["tce3"];
    $tce4 = $_POST["tce4"];
    $tce5 = $_POST["tce5"];
    $tce6 = $_POST["tce6"];
   
    $data = array(
      "message" => $message,
      "examId" => $examID,
      "questionID" => $questionID,
      "comments" => $comments,
      "grade" => $grade,
      "nPoints" => $fname,
      "rtPoints" => $return,
      "whilePoints" => $rwhile,
      "colonPoints" => $colon,
      "prPoints" => $print,
      "forPoints" => $for,
      "tce1Points" => $tce1,
      "tce2Points" => $tce2,
      "tce3Points" => $tce3,
      "tce4Points" => $tce4,
      "tce5Points" => $tce5,
      "tce6Points" => $tce6
    );
    break;
  case "TakeExam":
    $examName = $_POST["examName"];
    $examID = $_POST["examId"];
    $questionA = $_POST["questionA"];
    $code = $_POST["code"];
    $points = $_POST["points"];
    
    $data = array(
      "message" => $message,
      "examName" => $examName,
      "examId" => $examID,
      "questionA" => $questionA,
      "code" => $code,
      "points" => $points
    );
    break;
    
  case "StudentViewExam":
    $examID = $_POST["examId"];
  
    $data = array(
      "message" => $message,
      "examId" => $examID
    );
    break;
  case "InstructorViewExam":
    $examID = $_POST["examId"];
    
    $data = array(
      "message" => $message,
      "examId" => $examID 
    );
    break;
  case "GetExam":
    $examId = $_POST["examId"];
  
    $data = array(
      "message" => $message,
      "examId" => $examID
    );
    break;
  case "GetQuestions":
    $id = $_POST[$id];
  
    $data = array(
      "message" => $message,
      "id" => $id
    );
    break;
  
  default:
    echo "Error(front): Check Cases!";
}
//------------CURL Request to Mid--------------------------------------------
// $ch = curl_init("https://web.njit.edu/~pm458/cs490/back/logic.php");
$ch = curl_init("https://web.njit.edu/~vnp27/cs490/mid/curlhandler.php");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
echo $response;
?>