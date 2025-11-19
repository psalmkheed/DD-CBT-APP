<?php
include_once("../admin/db.php");

session_start();
if (!isset($_SESSION["user"])) {
    header("Location:../index.php");
    exit;
}

//get all published exams from the exams table
$class = $_SESSION["user"]["class"];
$sql = "SELECT * FROM exams WHERE status='published' && class='$class' ";
$query = mysqli_query($conn, $sql);
if ($query) {
    $num = mysqli_num_rows($query);

    if ($num > 0) {
        $student_exams = mysqli_fetch_all($query, MYSQLI_ASSOC);
    } else {
        echo "<h4>No examinations available at this time</h4>";

        exit;
    }
} else {
    die("An error was encountered" . mysqli_error($conn));
}

?>

<div class="py-2 avail-exam flex align-items-center bg-success" style="border-radius: 10px 10px 0 0 ">
    <h4 class="text-xl fw-bold m-0 text-white"> Available Exams </h4>
</div>

<div class="grid lg:grid-cols-3 bg-white gap-4 w-full py-3 m-0 px-0">
    <?php
    foreach ($student_exams as $exams) {
        $eid = $exams["exam_id"];
        $tq = $exams["num_quest"];
        $s = $exams["subjects"];
        $time = ($exams["duration"] / 60);
        $uid = $_SESSION["user"]["user_id"];
        $query = mysqli_query($conn, "select * from exam_history where exam_id='$eid' && user_id='$uid'");
        if (mysqli_num_rows($query) > 0) {
            echo "
           <div class='p-3 cursor-pointer flex flex-col gap-2 fetch-card-success justify-content-between' style='transition: ease-in-out 0.3s;'>
                <div class='flex flex-col gap-2'>
                    <div class='flex align-items-start justify-content-between'>
                        <p class='text-xl font-bold m-0'>" . $exams['subjects'] . "</p>
                        <div class='bg-success px-2 text-xs py-1 rounded-full fw-medium d-flex align-items-center justify-content-center gap-0' style='font-size: 11px; color:#fff;'><img src='../assets/icon/check.svg' style='width:15px;'>COMPLETED
                        </div>
                    </div>
                    <div class='fs-6 font-medium'>Total Question: " . $exams['num_quest'] . "</div>
                    
                    <div class='fs-6 font-medium d-flex align-items-center  gap-1'>
                        <img src='../assets/icon/timer.png' style='width:20px;' />" . $time . " Minutes
                    </div>
                </div>
                    <div class='mt-3'>
                        <button class='d-flex align-items-center justify-content-center gap-1 btn btn-success text-white fw-medium btn-sm w-full p-2 fs-6' title='Exam Taken' disabled>
                        <img src='../assets/icon/badge-check.svg' width='20' />
                        Exam Taken
                        </button>
                    </div>
        </div>";
        } else {
            echo "
           <div class='p-3 cursor-pointer flex flex-col gap-2 fetch-card justify-content-between' style='transition: ease-in-out 0.3s;'>
           <div class='flex flex-col gap-2'>
                <div class='flex align-items-center justify-content-between'> <p class='text-xl font-bold m-0'>" . $exams['subjects'] . "</p> <div class='bg-warning px-2 py-1 rounded-full fw-medium d-flex align-items-center justify-content-center gap-1' style='font-size: 11px; color:#fff;'><img src='../assets/icon/clock-5.svg' style='width:15px;' />" . strtoupper($exams['status']) . "</div></div>
                <div class='fs-6 font-medium'>Total Question: " . $exams['num_quest'] . "</div>
     
                <div class='fs-6 font-medium d-flex align-items-center  gap-1'><img src='../assets/icon/timer.png' style='width:20px;' />" . $time . " Minutes</div>
                </div>
                <div class='mt-3'><a title='Take Exams' class='d-flex align-items-center justify-content-center gap-1 btn btn-warning text-white fw-medium btn-sm w-full p-2 fs-6' href='../exams/take_exam.php?eid=" . $exams['exam_id'] . "&s=$s&tq=$tq'><img src='../assets/icon/play.svg' width='20' />Take Exam</a>
                </div>
            </div>";
        }
    }
    ?>
</div>