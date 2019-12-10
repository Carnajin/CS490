<?php
$examN = NULL;
$message = NULL;
$questionA = NULL;
$tCase1 = NULL;
$tCase2 = NULL;
$tCase3 = NULL;
$tCase4 = NULL;
$tCase5 = NULL;
$tCase6 = NULL;
$tCaseResult1 = NULL;
$tCaseResult2 = NULL;
$tCaseResult3 = NULL;
$tCaseResult4 = NULL;
$tCaseResult5 = NULL;
$tCaseResult6 = NULL;
$topicQ = NULL;
$examID = NULL;
if (isset($_POST["question"])) {
    $question = $_POST["question"];
}
if (isset($_POST['description'])) {
    $description = $_POST["description"];
}

if (isset($_POST['message'])) {
    $message = $_POST["message"];
}
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
if (isset($_POST['code'])) {
    $code = $_POST["code"];
}
if (isset($_POST['questionA'])) {
    $questionA = $_POST["questionA"];
}

$cs = "sendCases";
$data = array("examName" => $examN, "questionA" => $questionA, "cases" => $cs);
$ch = curl_init("https://web.njit.edu/~pm458/cs490/back/logic.php");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$res = json_decode($response,true);
$tstCases = array();
$tstCaseResults = array();
$top = array();
for($k = 0;$k<count($res);$k++){

    $tCase1 = $res[$k]["testCase1"];
    $tCase2 = $res[$k]["testCase2"];
    $tCase3 = $res[$k]["testCase3"];
    $tCase4 = $res[$k]["testCase4"];
    $tCase5 = $res[$k]["testCase5"];
    $tCase6 = $res[$k]["testCase6"];
    $topicQ = $res[$k]["top"];
    $tCaseResult1 = $res[$k]["testCaseResult1"];
    $tCaseResult2 = $res[$k]["testCaseResult2"];
    $tCaseResult3 = $res[$k]["testCaseResult3"];
    $tCaseResult4 = $res[$k]["testCaseResult4"];
    $tCaseResult5 = $res[$k]["testCaseResult5"];
    $tCaseResult6 = $res[$k]["testCaseResult6"];
    array_push($top,$topicQ);
    array_push($tstCases,$tCase1);
    array_push($tstCases,$tCase2);
    array_push($tstCases,$tCase3);
    array_push($tstCases,$tCase4);
    array_push($tstCases,$tCase5);
    array_push($tstCases,$tCase6);
    array_push($tstCaseResults,$tCaseResult1);
    array_push($tstCaseResults,$tCaseResult2);
    array_push($tstCaseResults,$tCaseResult3);
    array_push($tstCaseResults,$tCaseResult4);
    array_push($tstCaseResults,$tCaseResult5);
    array_push($tstCaseResults,$tCaseResult6);

}
curl_close($ch);
function get_string_between($string, $start, $end)
{
    $string = ' ' . $string;
    $initial = strpos($string, $start);
    if ($initial == 0) return '';
    $initial += strlen($start);
    $len = strpos($string, $end, $initial) - $initial;
    return substr($string, $initial, $len);
}
function autograde($code,$questionA,$tstCases,$tstCaseResults,$top)
{
    $fNamePoints = "";
    $fCasePoints = "";
    $colonPoints = "";
    $whilePoints = "";
    $forPoints = "";
    $prPoints = "";
    $rtPoints = "";
    $caseResults = array();
    $txt = explode(" ,",$code);
    $questionN = explode(",",$questionA);
    $m = 0;
    $l = 6;
    for($it = 0;$it<count($txt);$it++){
        $col = strpos($txt[$it],"):");

        if($top[$it] == "while"){
            $wh = strpos($txt[$it],"while");
            if($wh != false){
                $whilePoints .= "0";
            }
            else{
                $whilePoints .= "2";
            }
        }
        else{
            $whilePoints .= "0";
        }
        if($top[$it] == "for"){
            $fr = strpos($txt[$it],"for");
            if($fr != false){
                $forPoints .= "0";
            }
            else{
                $forPoints .= "2";
            }
        }
        else{
            $forPoints .= "0";
        }
        if($top[$it] == "print"){
            $pr = strpos($txt[$it],"print");
            if($pr != false){
                $prPoints .= "0";
            }
            else{
                $prPoints .= "2";
                $rtPoints .= "0";
            }
        }
        else{
            $prPoints .= "0";
            $rt = strpos($txt[$it],"return");
            if($rt != false){
                $rtPoints .= "0";
            }
            else{
                $rtPoints .= "2";
            }
        }
        if($col != false){
            $colonPoints .= "0";
        }
        else{
            $colonPoints .= "2";
        }

        $parsed = get_string_between($txt[$it], "def ","(");

        for($j = $m; $j< $l;$j++) {

            if($tstCases[$j] == ""){
                $fCasePoints .= "0";
                continue;
            }

            $fl = 'test.py';
            $mFile = fopen($fl, "w");
            fwrite($mFile, $txt[$it]);
            fwrite($mFile, "\nprint($parsed($tstCases[$j]))");
            fclose($mFile);
            $output = exec("python $fl");
            $filecontents = file_get_contents($fl);
            $out = rtrim($output);
            array_push($caseResults,$filecontents);
            array_push($caseResults,$out);
            /*
            $file = 'test.py';
            $myfile = fopen($file, "w");
            fwrite($myfile, $txt[$it]);
            fwrite($myfile, "\nprint($parsed($tstCases[$j]))");
            fclose($myfile);
            $output = exec("python $file");
            $filecontents = file_get_contents($file);
            $out = rtrim($output);
            array_push($caseResults,$filecontents);
            array_push($caseResults,$out);
            */
            if ($tstCaseResults[$j] != "") {
                if ($out == $tstCaseResults[$j]){
                    $fCasePoints .= "0";
                }
                else{
                    $fCasePoints .= "2";
                }
            }

        }
        if(($m + 1) != count($tstCases)){
            $m += 6;
            $l += 6;
        }
        $fCasePoints .= " ";
    }

    for($i = 0;$i < count($questionN);$i++){
        $parsed = get_string_between($txt[$i], "def ","(");
        if($parsed == $questionN[$i]){
            $fNamePoints .= "0";
        }
        else{
            $fNamePoints .= "2";
        }
    }

    return array($fCasePoints,$fNamePoints,$colonPoints,$whilePoints,$forPoints,$prPoints,$rtPoints,$caseResults);
}

$answer = autograde($code,$questionA,$tstCases,$tstCaseResults,$top);
$casePoints = $answer[0];
$namePoints = $answer[1];
$colPoints = $answer[2];
$whPoints = $answer[3];
$fPoints = $answer[4];
$printPoints = $answer[5];
$returnPoints = $answer[6];
echo json_encode($answer);
$data = array("code" => $code, "casePoints" => $casePoints, "namePoints" => $namePoints, "colPoints" => $colPoints, "whPoints" => $whPoints, "fPoints" => $fPoints, "printPoints" => $printPoints, "returnPoints" => $returnPoints, "examName" => $examN, "questionA" => $questionA, "message" => $message);
$ch = curl_init("https://web.njit.edu/~pm458/cs490/back/logic.php");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

?>
