<?php
session_start();
include("../admin/db.php");
if(!isset($_SESSION["user"])){
    header("Location:../index.php");
    exit;
}
else{
    $eid= $_GET["eid"];
    $uid= $_GET["uid"];

    $query= mysqli_query($conn, "DELETE FROM results WHERE exam_id='$eid' && user_id='$uid'");
    if($query){
           $query= mysqli_query($conn, "DELETE FROM exam_history WHERE exam_id='$eid' && user_id='$uid'");
           if($query){
                $query= mysqli_query($conn, "DELETE FROM student_answers WHERE exam_id='$eid' && user_id='$uid'");
           }
    }

     echo "alert('Exam Reset Successful. Click OK to Return to Dashboard'); window.location.href='';";
}


?>