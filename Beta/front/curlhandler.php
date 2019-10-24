<?php
//---------Message for cases-------------------
$operation = $_POST["message"];

//---------Cases for sending POST data-----------------------
switch($operation) {
  
  case "CreateExam":    
    $examName = $_POST["examName"];
    $questionID = $_POST["questionID"];
    $points = $_POST["points"];
    
    $data = array(
      "message" => $operation,
      "examName" => $examName,
      "questionID" => $questionID,
      "points" => $points,
    );
    break;

  case "CreateQuestion":
    $testCase1 = $_POST["tcs1"];
    $testCase2 = $_POST["tcs2"];
    $testCaseResult1 = $_POST["tcsr1"];
    $testCaseResult2 = $_POST["tcsr2"];
    $question = $_POST["question"];
    $description = $_POST["description"];
    $difficulty = $_POST["difficulty"];
    $topic = $_POST["topic"];
    
    $data = array(
      "message" => $operation,
      "tcs1" => $testCase1,
      "tcs2" => $testCase2,
      "tcsr1" => $testCaseResult1,
      "tcsr2" => $testCaseResult2,
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
    $fname = $_POST["fName"];
    $return = $_POST["return"];
   
    $data = array(
      "message" => $operation,
      "examId" => $examID,
      "questionID" => $questionID,
      "comments" => $comments,
      "grade" => $grade,
      "fName" => $fname,
      "return" => $return
    );
    break;

  case "TakeExam":
    $examName = $_POST["examName"];
    $examID = $_POST["examId"];
    $questionA = $_POST["questionA"];
    $code = $_POST["code"];
    $points = $_POST["points"];
    
    $data = array(
      "message" => $operation,
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
      "message" => $operation,
      "examId" => $examID
    );
    break;

  case "InstructorViewExam":
    $examID = $_POST["examId"];
    
    $data = array(
      "message" => $operation,
      "examId" => $examID 
    );
    break;

  case "GetExam":
    $examId = $_POST["examId"];
  
    $data = array(
      "message" => $operation,
      "examId" => $examID
    );
    break;

  case "GetQuestions":
    $id = $_POST[$id];
  
    $data = array(
      "message" => $operation,
      "id" => $id
    );
    break;
  
  default:
    echo "Error: Check Cases!";
}

//------------CURL Request to Mid--------------------------------------------

$ch = curl_init("https://web.njit.edu/~vnp27/cs490/mid/curlhandler.php");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);
echo $response;
?>