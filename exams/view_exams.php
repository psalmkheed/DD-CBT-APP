<?php
include("exams.php");
if (!isset($_SESSION["user"]["user_id"])) {
    header("Location:../index.php");
}

?>
<style>
    .btn-success {
        background: #00c950 !important;
        outline: 0;
        border: 0;
        transition: ease-in-out 0.2s;
    }

    .btn-success:hover {
        background: #00973cff !important;
    }

    table {
        border-collapse: collapse;
        /* This can be collapsed in this method */
        border-spacing: 0;
        border: none;
        /* Remove the main table border */
    }

    th,
    td {
        padding: 10px;
    }

    /* Apply border-radius to the corner cells */
    tr:first-child th:first-child {
        border-top-left-radius: 10px;
        border: 0;
    }

    tr:first-child th:last-child {
        border-top-right-radius: 10px;
        border: 0;
    }

    tr:last-child td:first-child {
        border-bottom-left-radius: 10px;
        border: 0;
    }

    tr:last-child td:last-child {
        border-bottom-right-radius: 10px;
        border: 0;
    }
</style>
<div class="container-fluid m-0 p-0">
    <div class="row m-0 p-0">
        <div class="col-lg-12 p-0 m-0" id="content_box">
            <div class="px-3 py-2 text-white mb-3 rounded-3" style="background: rgba(0, 123, 255, 0.8);">
                <h5 class="m-0">Examination Details</h5>
            </div>
            <?php
            if (empty($_SESSION["exam_data"])) {
                echo "<p class='text-danger fw-bold p-2'> No Records of examinations Found at this time.</p>";
            } else {
                echo "<table class='table table-striped table-hover' id=iqTable'><thead class='align-middle'><tr><th class='bg-success text-white'>Subject</th><th class='bg-success text-white'>Class</th><th class='bg-success text-white'>Total</th><th class='bg-success text-white'>Exam Type</th><th class='bg-success text-white'>Date Created</th><th class='bg-success text-white'>Due Date</th><th class='bg-success text-white'>Status</th><th class='text-center bg-success text-white'>Action</th></tr></thead><tbody class='align-middle'>";
                if ($_SESSION["user"]["user_role"] == "admin") {
                    $role = $_SESSION["user"]["user_role"];
                    foreach ($_SESSION["exam_data"] as $getExams) {
                        $eid = $getExams["exam_id"];
                        $status = $getExams["status"];
                        if ($status === "published") {
                            echo "<tr><td>" . $getExams['subjects'] . "</a></td><td>" . $getExams['class'] . "</td><td>" . $getExams['num_quest'] . "</td><td>" . $getExams['exam_type'] . "</td><td>" . $getExams['date_created'] . "</td><td>" . $getExams['due_date'] . "</td><td>" . ucfirst($getExams['status']) . "</td><td><a title='Edit Exam' class='btn btn-primary btn-sm mx-2' href='../exams/action.php?q=edit&eid=$eid'>Edit</a><a class='view-results btn btn-success btn-sm mx-2' href='../results/index.php?r=admin&eid=$eid'>Results</a><a class='del-exam btn btn-danger btn-sm mx-2' href='../exams/action.php?q=delete&eid=$eid'>Delete</a></td></tr>";
                        } else {
                            echo "<tr><td>" . $getExams['subjects'] . "</a></td><td>" . $getExams['class'] . "</td><td>" . $getExams['num_quest'] . "</td><td>" . $getExams['exam_type'] . "</td><td>" . $getExams['date_created'] . "</td><td>" . $getExams['due_date'] . "</td><td>" . ucfirst($getExams['status']) . "</td><td><a title='Edit Exam' class='btn btn-sm btn-primary mx-2' href='../exams/action.php?q=edit&eid=$eid'>Edit</a><a title='Publish Exam' class='btn btn-warning btn-sm mx-2 pub_exam' href='../exams/action.php?q=publish&eid=$eid'>Publish</a><a class='del_exam btn btn-danger btn-sm mx-2' href='../exams/action.php?q=delete&eid=$eid'>Delete</a></td></tr>";
                        }
                    }
                } else {
                    foreach ($_SESSION["exam_data"] as $getExams) {
                        echo "<tr><td>" . $getExams['subjects'] . "</td><td>" . $getExams['class'] . "</td><td>" . $getExams['num_quest'] . "</td><td>" . $getExams['exam_type'] . "</td><td>" . $getExams['date_created'] . "</td><td>" . $getExams['due_date'] . "</td><td>" . ucfirst($getExams['status']) . "</td><td><a title='Add Questions' class='add_questions mx-2 btn btn-sm btn-primary' href='../questions/add_quest.php?eid=" . $getExams['exam_id'] . "'><i class='text-white'>Add Question</i></a><a title='View Examination results' class='get_results mx-2 btn btn-sm btn-success' href='../results/index.php?r=staff&eid=" . $getExams['exam_id'] . "'><i class='bi bi-view-stacked text-white '>View Results</i></a></td></tr>";
                    }
                }
            }
            ?>
            </tbody>
            </table>
        </div>
    </div>
</div>