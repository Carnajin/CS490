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
    $question = $_POST["question"];
    $description = $_POST["description"];
    $difficulty = $_POST["difficulty"];
    $topic = $_POST["topic"];
    
    $data = array(
      "message" => $message,
      "tcs1" => $testCase1,
      "tcs2" => $testCase2,
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
    $loop = $_POST["loop"];
    $return = $_POST["return"];
    $question = $_POST["funcName"];
    $extra = $_POST["extra"];
   
    $data = array(
      "message" => $message,
      "examId" => $examID,
      "questionID" => $questionID,
      "comments" => $comments,
      "grade" => $grade,
      "loop" => $loop,
      "return" => $return,
      "funcName" => $question,
      "extra" => $extra
    );
    break;

  case "TakeExam":
    $examID = $_POST["examId"];
    $questionID = $_POST["questionID"];
    $code = $_POST["code"];
    $points = $_POST["points"];
    
    $data = array(
      "message" => $message,
      "examId" => $examID,
      "questionID" => $questionID,
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
    echo "Error: Check Cases!";
}

//------------CURL Request to Mid--------------------------------------------

$ch = curl_init("https://web.njit.edu/~pm458/cs490/back/logic.php");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);
echo $response;
?>