<?php
include("../admin/db.php");
session_start();
//check if exam questions has been fully submitted.
if(isset($_SESSION["user"]["user_id"]) && isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"]==="POST"){

$total= $_POST["total_quest"];
$question= mysqli_real_escape_string($conn, $_POST["question"]);
$optA= mysqli_real_escape_string($conn, $_POST["opt_A"]);
$optB= mysqli_real_escape_string($conn, $_POST["opt_B"]);
$optC= mysqli_real_escape_string($conn, $_POST["opt_C"]);
$optD= mysqli_real_escape_string($conn, $_POST["opt_D"]);
$correct_opt= $_POST["correct_answer"];
$exam_id= $_POST["exam_id"];
$subject= $_POST["subject"];
$quest_num= $_POST["quest_num"];
$acad_info= getAcadYear($conn);
$sess= $acad_info["year"];
$term= $acad_info["term"];
$acad_year= $term. " " . $sess;


if($quest_num <= $total){
   $check= mysqli_query($conn, "select * from questions where exam_id='$exam_id' && question= '$question' && option_a='$optA' && option_b= '$optB' && option_c='$optC' && option_d= '$optD'");
   if(!$check){
      die ("Query operation failed". mysqli_connect_error());
   }
   else{
      if(mysqli_num_rows($check) > 0){
         header("Location: ../questions/add_quest.php?eid=$exam_id&res=duplicate");
      }
      else{
         $sql= "insert into questions (exam_id, quest_num, question, option_a, option_b, option_c, option_d, correct_answer, acad_year, subject) values ('$exam_id', '$quest_num', '$question', '$optA', '$optB', '$optC', '$optD', '$correct_opt', '$acad_year', '$subject')";
         
         $query= mysqli_query($conn, $sql);
            if(!$query) {
               return mysqli_connect_error();
            }
            else{
               header("Location: ../questions/add_quest.php?eid=$exam_id&res=added");

            }
         }
      }
      
   }
}

elseif(isset($_SESSION["user"]["user_id"])){
if(isset($_GET["qs"])){
   $exam_id= $_GET["eid"];
   $sql= "SELECT * FROM questions WHERE exam_id= '$exam_id'";
   $query= mysqli_query($conn, $sql);
   if(mysqli_num_rows($query) > 0){
      $result_array= mysqli_fetch_all($query, MYSQLI_ASSOC);
      foreach($result_array as $r){
         echo "<div class='col-lg-12 d-flex justify-content-start align-items-center text-dark'><span class='p-2'>".$r["quest_num"]. ".</span><span style='color:000088; font-size:14px;'>" .$r["question"]."</span></div><ul class='text-muted d-flex justify-content-start mb-2' style='list-style-type:none; color:800080; font-size:12px;'><li class='mx-2'>A. ". $r["option_a"]. "</li><li class='mx-2'>B.". $r["option_b"]. "</li><li class='mx-2'>C.". $r["option_c"]. "</li><li class='mx-2'>D.". $r["option_d"]. "</li></ul>";
      }
   }
}
}
//if user tried to access the link directly, redirect to login page
else{
   header("Location:/cbt/errors/404.html");
   exit;
}

?>

