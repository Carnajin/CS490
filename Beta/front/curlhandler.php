<?php
//*****receive post data from user based on message post field*****

$message = $_POST["message"];

switch($message) {
  
  case "CreateQuestion":
    $testCase1 = $_POST["tcs1"];
    $testCase2 = $_POST["tcs2"];
    $funcName = $_POST["question"];
    $description = $_POST["description"];
    $difficulty = $_POST["difficulty"];
    $topic = $_POST["topic"];
    
    $comp = array(
      "message" => $message,
      "tcs1" => $testCase1,
      "tcs2" => $testCase2,
      "question" => $funcName,
      "description" => $description,
      "difficulty" => $difficulty,
      "topic" => $topic
    );
    break;

  case "CreateExam":    
    $examName = $_POST["examName"];
    $questionID = $_POST["questionID"];
    $points = $_POST["points"];
    
    $comp = array(
      "message" => $message,
      "examName" => $examName,
      "questionID" => $questionID,
      "points" => $points,
    );
    break;

  case "ReleaseExam":
    $examId = $_POST["examId"];
    $questionID = $_POST["questionID"];
    $comments = $_POST["comments"];
    $grade = $_POST["grade"];
    $loop = $_POST["loop"];
    $return = $_POST["return"];
    $funcName = $_POST["funcName"];
    $extra = $_POST["extra"];
   
    $comp = array(
      "message" => $message,
      "examId" => $examId,
      "questionID" => $questionID,
      "comments" => $comments,
      "grade" => $grade,
      "loop" => $loop,
      "return" => $return,
      "funcName" => $funcName,
      "extra" => $extra
    );
    break;

  case "TakeExam":
    $examId = $_POST["examId"];
    $questionID = $_POST["questionID"];
    $code = $_POST["code"];
    $points = $_POST["points"];
    
    $comp = array(
      "message" => $message,
      "examId" => $examId,
      "questionID" => $questionID,
      "code" => $code,
      "points" => $points
    );
    break;
    
  case "StudentViewExam":
    $examId = $_POST["examId"];
  
    $comp = array(
      "message" => $message,
      "examId" => $examId
    );
    break;

  case "GetExam":
    $examId = $_POST["examId"];
  
    $comp = array(
      "message" => $message,
      "examId" => $examId
    );
    break;

  case "GetQuestions":
    $id = $_POST[$id];
  
    $comp = array(
      "message" => $message,
      "id" => $id
    );
    break;
    
  case "InstructorViewExam":
    $examId = $_POST["examId"];
    
    $comp = array(
      "message" => $message,
      "examId" => $examId 
    );
    break;
  
  default:
    echo "defaulted case";
}

//------------CURL Request to Mid--------------------------------------------

$ch = curl_init("https://web.njit.edu/~pm458/cs490/back/logic.php");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $comp);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);
echo $response;
?>