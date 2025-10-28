<?php
session_start();
include("../admin/db.php");
if(isset($_SESSION["user"]) && isset($_POST)){
    $eid= $_GET["eid"];
    $total= $_GET["tq"];
    $subject= $_GET['sub'];
    if(empty($_POST)){
         echo "<script>alert('Exam completed Successfully. Click OK to Return to Dashboard'); window.location.href='../student/index.php';</script>";
    }
    else{
        $user_id= $_SESSION["user"]["user_id"]; 
        $surname= $_SESSION["user"]["surname"]; 
        $other_names = $_SESSION["user"]["other_names"]; 
        $names= "$surname $other_names"; 
        //check if student answers already existed to avoid duplicate;\
        $q= "SELECT * from student_answers where exam_id= '$eid' && user_id='$user_id'";
        $query=mysqli_query($conn, $q); 
        if($query){
            if (mysqli_num_rows($query) > 0){
                echo "<script>alert('Page can not be re-submitted because this examination has already been taken.'); window.location.href='../student/index.php'</script>";
            }
        else{
            //store student response in the table
            foreach($_POST as $quest_num => $selected_answer){
                $sql = "INSERT INTO student_answers (exam_id, quest_num, user_id, selected_answer) VALUES ('$eid', '$quest_num', '$user_id', '$selected_answer')";
                $query= mysqli_query($conn, $sql) or die(mysqli_error());
            }
        
        //run a query to determine the score and update the result table
        $sql= "SELECT questions.correct_answer, student_answers.selected_answer FROM questions JOIN student_answers ON questions.exam_id= student_answers.exam_id AND questions.quest_num = student_answers.quest_num AND questions.correct_answer= student_answers.selected_answer AND student_answers.user_id='$user_id' AND questions.exam_id='$eid'";
        $query= mysqli_query($conn, $sql);
        $results= mysqli_fetch_all($query, MYSQLI_ASSOC);
        $num_rows= mysqli_num_rows($query);
        if($num_rows >0){
            $score= $num_rows;
            $upd_score= mysqli_query($conn, "UPDATE results SET score='$score' WHERE exam_id= '$eid' AND user_id= '$user_id'") or die(mysqli_error($conn));
            $query= mysqli_query($conn, "INSERT INTO exam_history (exam_id, user_id, subject, score, total, date) VALUES ('$eid', '$user_id', '$subject', '$score', '$total', NOW())");
         echo "<script>alert('Exam completed Successfully. Click OK to view your result in the Exam History'); window.location.href='../student/index.php';</script>";
       // header("Location:../student/index.php");
        }
        else{die(mysqli_connect_error($conn));}
    }
    }
}
}
    
else{header("location:../index.php");}
    
?>