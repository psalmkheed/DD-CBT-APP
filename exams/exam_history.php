<?php
include_once("../admin/db.php");
session_start();
if (!isset($_SESSION["user"])) {
    header("Location:../index.php");
    exit;
}
$user_id = $_SESSION["user"]["user_id"];
//get all published exams from the exams table

$sql = "SELECT * FROM exam_history WHERE user_id='$user_id'";
$query = mysqli_query($conn, $sql);
if ($query) {
    $num = mysqli_num_rows($query);

    if ($num > 0) {
        $exam_history = mysqli_fetch_all($query, MYSQLI_ASSOC);
    } else {
        echo "<h3 class='fw-medium p-2 text-danger'>No Examination Record Found</h3>";

        exit;
    }
} else {
    die("An error was encountered" . mysqli_error($conn));
}

?>

<div class="" style="overflow-x:auto;">
    <table class='table table-striped table-hover table-bordered' id="qTable"
        style=" width: 100%;">
        <thead>
            <tr class="align-middle">
                <th class="bg-success text-white">Subject</th>
                <th class="bg-success text-white">Score</th>
                <th class="bg-success text-white">Total</th>
                <th class="bg-success text-white">Date Taken</th>
                <th class="bg-success text-white">Action</th>
            </tr>
        </thead>
        <tbody class="align-middle">
            <?php
            foreach ($exam_history as $history) {
                echo "<tr><td>" . $history["subject"] . "</td><td>" . $history['score'] . "</td><td>" . $history['total'] . "</td><td>" . $history['date'] . "</td><td><a title='View Result' class='btn btn-success mx-1 fw-medium btn-sm' href='../results/view_results.php?eid=" . $history['exam_id'] . "'>View Result</a></td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>