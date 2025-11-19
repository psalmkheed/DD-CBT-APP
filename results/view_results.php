<?php
session_start();
include("../admin/db.php");
include("header.php");
if(!isset($_SESSION["user"])){
    header("Location:../index.php");
    exit;
}
else{
    $eid= $_GET["eid"];
    $user_id= $_SESSION["user"]["user_id"];
    
    $sql= "SELECT * FROM results WHERE exam_id='$eid' AND user_id='$user_id'";
    $query= mysqli_query($conn, $sql);
    $results= mysqli_fetch_assoc($query);
    $total= $results["total"];
    $score = $results["score"];

    //run a query to get the questions to be displayed along with their answers

    /** Get the total number of rows **/
    $sql= "SELECT questions. quest_num, questions.question, questions.option_a, questions.option_b, questions.option_c, questions.option_d, questions.correct_answer, student_answers.selected_answer FROM questions JOIN student_answers ON questions.exam_id=student_answers.exam_id AND questions.quest_num = student_answers.quest_num AND student_answers.user_id= '$user_id' AND questions.exam_id='$eid'";
    $query= mysqli_query($conn, $sql);
    $num_of_rows= mysqli_num_rows($query);
    $limit= 2;
    $total_page= ceil($num_of_rows/$limit);

   if(isset($_GET["pg_num"])){
        $pg_num= $_GET["pg_num"];
          if($pg_num < 1){
                header("Location:view_results.php?eid=$eid&pg_num=1");
                 exit;
            }
    }
    else{
        $pg_num=1;
    }
   
    if($pg_num >= 1){
        $offset= ($pg_num - 1) * $limit;
    }
    else{
        $offset=0;
    }

 /** Limit the rows to 2 per page */
 $sql= "SELECT questions. quest_num, questions.question, questions.option_a, questions.option_b, questions.option_c, questions.option_d, questions.correct_answer, student_answers.selected_answer FROM questions JOIN student_answers ON questions.exam_id=student_answers.exam_id AND questions.quest_num = student_answers.quest_num AND student_answers.user_id= '$user_id' AND questions.exam_id='$eid' LIMIT $offset, $limit";
$query= mysqli_query($conn, $sql);
$result= mysqli_fetch_all($query, MYSQLI_ASSOC);
$username= strtoupper($_SESSION["user"]["surname"]. " ". $_SESSION["user"]["other_names"]); 
$subject= strtoupper(checkSubject($conn, $eid));
    // This is the logic for Grade Report
    $gradeReport = ($score < $total / 1.5) ? '<span class=\'text-danger fw-bold flex items-center gap-2 fs-5\'><img src=\'../assets/image/poor.png\' width=\'40\' />POOR Grade you can do better</span>' : '<span class=\' fw-bold flex items-center gap-2 fs-5\' style=\'color: green;\'><img src=\'../assets/image/thumb-up.png\' width=\'50\' />Well Done Keep it up</span>';
    $header = "<body class='p-0 m-0'  style='overflow-x:hidden;'><header class='position-fixed w-full top-0 p-0 bg-success text-light py-2' style=''><ul class='header-links d-flex justify-content-between align-items-center'><li class='flex align-items-center gap-2'><img src='../assets/image/dd-logo.png' width='40' /><h5>Result Page</h5></li><li class='bg-success-subtle rounded-2'><h5 class='m-0 fw-bold text-danger text-center'>SCORE: $score/$total </h5></li>
<li class='text-2xl font-bold bg-success-subtle rounded-2 px-3 py-1'>
    $gradeReport
</li>




    <li><a class='btn btn-danger' href='../student/index.php'><i class='bi bi-x-circle'></i>Close</a></li></ul>
</header>";
    $header .= " <div class='container p-3' style='margin-top: 80px;'><h4>Question Level Analysis</h4><div class='row p-2'>";
    echo $header;

    /** run a loop to get the questions **/
foreach($result as $r){
    $correct= $r["correct_answer"];
    $select= $r["selected_answer"];
        if ($correct == "A" && $select == "A") {
            $class_a = "<span class='text-success fw-bold mx-1'>&#10003</span>";
            $class_b = '';
            $class_c = '';
            $class_d = '';
        }
    elseif($correct=="A" && $select=="B"){$class_a= "<span class='text-success fw-bold mx-1'>&#10003</span>"; $class_b="<span class='text-danger fw-bolder mx-1' style='font-size:1.7rem; line-height:1rem;'>&times;</span>"; $class_c=''; $class_d='';}
    elseif($correct==="A" && $select==="C"){$class_a= "<span class='text-success fw-bold mx-1'>&#10003</span>"; $class_b=''; $class_c="<span class='text-danger fw-bolder mx-1' style='font-size:1.7rem; line-height:1rem;'>&times;</span>"; $class_d='';}
    elseif($correct==="A" && $select==="D"){$class_a= "<span class='text-success fw-bold mx-1'>&#10003</span>"; $class_b=''; $class_c=''; $class_d="<span class='text-danger fw-bolder mx-1' style='font-size:1.7rem; line-height:1rem;'>&times;</span>";}
    elseif($correct==="B" && $select==="B"){$class_a=''; $class_b= "<span class='text-success fw-bold mx-1'>&#10003</span>"; $class_c=''; $class_d='';}
    elseif($correct==="B" && $select==="A"){$class_a= "<span class='text-danger fw-bolder mx-1' style='font-size:1.7rem; line-height:1rem;'>&times;</span>"; $class_b="<span class='text-success fw-bold mx-1'>&#10003</span>"; $class_c=''; $class_d='';}
    elseif($correct==="B" && $select==="C"){$class_a= ''; $class_b="<span class='text-success fw-bold mx-1'>&#10003</span>"; $class_c="<span class='text-danger fw-bolder mx-1' style='font-size:1.7rem; line-height:1rem;'>&times;</span>"; $class_d='';}
    elseif($correct==="B" && $select==="D"){$class_a= ''; $class_b="<span class='text-success fw-bold mx-1'>&#10003</span>"; $class_c=''; $class_d="<span class='text-danger fw-bolder mx-1' style='font-size:1.7rem; line-height:1rem;'>&times;</span>";}
    elseif($correct==="C" && $select==="C"){$class_a=''; $class_b=''; $class_c= "<span class='text-success fw-bold mx-1'>&#10003</span>"; $class_d='';}
    elseif($correct==="C" && $select==="A"){$class_a="<span class='text-danger fw-bolder mx-1' style='font-size:1.7rem; line-height:1rem;'>&times;</span>"; $class_b=''; $class_c= "<span class='text-success fw-bold mx-1'>&#10003</span>"; $class_d='';}
    elseif($correct==="C" && $select==="B"){$class_a=''; $class_b="<span class='text-danger fw-bolder mx-1' style='font-size:1.7rem; line-height:1rem;'>&times;</span>"; $class_c= "<span class='text-success fw-bold mx-1'>&#10003</span>"; $class_d='';}
    elseif($correct==="C" && $select==="D"){$class_a=''; $class_b=''; $class_c= "<span class='text-success fw-bold mx-1'>&#10003</span>"; $class_d="<span class='text-danger fw-bolder mx-1' style='font-size:1.7rem; line-height:1rem;'>&times;</span>";}
    elseif($correct==="D" && $select==="D"){$class_a=''; $class_b=''; $class_c= ''; $class_d="<span class='text-success fw-bold mx-1'>&#10003</span>";}
    elseif($correct==="D" && $select==="A"){$class_a="<span class='text-danger fw-bolder mx-1' style='font-size:1.7rem; line-height:1rem;'>&times;</span>"; $class_b=''; $class_c= ''; $class_d="<span class='text-success fw-bold mx-1'>&#10003</span>";}
    elseif($correct==="D" && $select==="B"){$class_a=''; $class_b="<span class='text-danger fw-bolder mx-1' style='font-size:1.7rem; line-height:1rem;'>&times;</span>"; $class_c= ''; $class_d="<span class='text-success fw-bold mx-1'>&#10003</span>";}
    else{$class_a=''; $class_b=''; $class_c= "<span class='text-danger fw-bolder mx-1' style='font-size:1.7rem; line-height:1rem;'>&times;</span>"; $class_d="<span class='text-success fw-bold mx-1'>&#10003</span>";
    }

        $content = "<div class='w-100 rounded-4 p-4 bg-light shadow-md fs-5 mb-3'><span class='fw-bold'>" . $r["quest_num"] . ".<span class='ms-1'></span>" . $r["question"] . "</span><p class=''><ol class='quest-links'><li>" . ucfirst($r["option_a"]) . "$class_a</li><li>" . ucfirst($r["option_b"]) . "$class_b</li><li>" . ucfirst($r["option_c"]) . "$class_c</li><li>" . ucfirst($r["option_d"]) . "$class_d</li></ol></div></div>";

echo $content;
} 

if($pg_num > $total_page) {
    header("Location:view_results.php?eid=$eid&pg_num=1");
    exit;
}
    echo "<div class='col-lg-12 text-center mt-2 flex bg-success-subtle p-3 align-items-center justify-content-center gap-3'><a class='px-3 py-2 btn btn-success d-flex align-items-center justify-content-center' href='../results/view_results.php?eid=$eid&pg_num=" . ($pg_num - 1) . "'><img src='../assets/icon/chevrons-left.svg' alt='Previous' style='width: 30px; height: 30px;'><b>Previous</b></a>";
    // for($i=1; $i <= $total_page; $i++){
    //         echo "<a class='btn btn-success px-3 py-2 mx-2 mb-2' href='../results/view_results.php?eid=$eid&pg_num=$i'>" . $i . "</a>";
    // }
    echo "<a class='btn btn-success px-3 py-2 d-flex align-items-center justify-content-center' href='../results/view_results.php?eid=$eid&pg_num=" . ($pg_num + 1) . "'> <b>Next</b> <img src='../assets/icon/chevrons-right.svg' alt='Next' style='width: 30px; height: 30px;'></a></div></div>";
        
}

?>