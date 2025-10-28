<?php
include_once("../admin/db.php");

session_start();
if(!isset($_SESSION["user"])){header("Location:../index.php"); exit;}

//get all published exams from the exams table
$class= $_SESSION["user"]["class"];
$sql= "SELECT * FROM exams WHERE status='published' && class='$class' ";
$query= mysqli_query($conn, $sql);
if($query){
    $num= mysqli_num_rows($query);

    if($num > 0){
        $student_exams= mysqli_fetch_all($query, MYSQLI_ASSOC);
    }
    else{
        echo "<h4>No examinations available at this time</h4>";
	
        exit;
    }
}
else{
    die("An error was encountered". mysqli_error($conn));
}


?>

<div class="py-3 avail-exam flex align-items-center bg-white"><h4 class="text-xl fw-bold m-0"> Available Exams </h4></div>

<!-- Fetching card from the database -->

<div class="grid lg:grid-cols-3 bg-light gap-4 w-full py-3 m-0">
    <?php
        foreach($student_exams as $exams){
            $eid= $exams["exam_id"];
            $tq= $exams["num_quest"];
            $s= $exams["subjects"];
            $time= ($exams["duration"] / 60);
           echo "
           <div class='p-3 cursor-pointer flex flex-col gap-2 fetch-card' style='transition: ease-in-out 0.3s;'>
                <div class='flex align-items-center justify-content-between'> <p class='text-xl font-bold m-0'>
                ".$exams['subjects']. "
                </p> 
                <div class='bg-crimson px-2 py-1 rounded-full fw-medium d-flex align-items-center justify-content-center gap-1' style='font-size: 11px; color:#fff;'>
                <img src='../assets/icon/clock-5.png' style='width:15px;' />
                ".strtoupper($exams['status']). "
                 </div>
                 </div>
                <div class='fs-6 font-medium'>
                Total Question: ". $exams['num_quest']. "
                </div>
                <div class='fs-6 font-medium'>
                Exam Type: ".$exams['exam_type']."
                </div>
                <div class='fs-6 font-medium d-flex align-items-center  gap-1'><img src='../assets/icon/timer.png' style='width:20px;' />" .$time." Minutes</div>
                <div class='mt-3'><a title='Take Exams' class='d-flex align-items-center justify-content-center gap-1 btn btn-crimson text-white fw-medium btn-sm w-full p-2 fs-6' href='../exams/take_exam.php?eid=" .$exams['exam_id']. "&s=$s&tq=$tq'><img src='../assets/icon/play.png' width='20' />Take Exam</a>
                </div>
            </div>";
        }
        ?>
</div>