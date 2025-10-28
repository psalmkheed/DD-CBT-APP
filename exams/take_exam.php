<!doctype html5>
<html lang="en">

<head>
    <link rel="icon" type="image" href="../assets/image/dd-logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DD CBT-Exam Page</title>

    <!-- Bootstrap CSS -->
    <style>
        body {
            background: #fff;
            padding-top: 100px;
        }

        input[type="radio"] {
            width: 20px;
            height: 20px;
        }

        .sticky-card {
            position: sticky;
            top: 60px;
            z-index: 10000;
            max-height: calc(100vh - 120px);
            overflow-y: auto;
        }

        .question-card {
            background: #fefefe;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .fw-bold {
            font-weight: 600 !important;
        }

        label {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    include("header.php");
    include("../admin/db.php");
    if (isset($_SESSION["user"]) && isset($_GET)) {

        $eid = $_GET["eid"];
        $tq = $_GET["tq"];
        $sub = $_GET["s"];
        $user_id = $_SESSION["user"]["user_id"];
        date_default_timezone_set("Africa/Lagos");
        $duration = 0;

        //check student already has a result.
        $sql = "SELECT * FROM results WHERE user_id='$user_id' AND exam_id='$eid' ";
        $query = mysqli_query($conn, $sql);
        $query_result = mysqli_fetch_assoc($query);
        if (mysqli_num_rows($query) > 0) {
            if ($query_result["score"] > 0){
                echo "<script>alert('You have already taken this Examination.'); window.location.href='../student/index.php';</script>";
            }
            else {
                $to_start = time();
                $start_time = date("Y-m-d H:i:s", $to_start);
                mysqli_query($conn, "UPDATE results SET start_time= '$start_time' where exam_id='$eid' AND user_id='$user_id'");
                $sql = "SELECT * FROM results WHERE user_id='$user_id' AND exam_id='$eid' ";
                $query = mysqli_query($conn, $sql);
                $query_result = mysqli_fetch_assoc($query);
                $duration = strtotime($query_result["end_time"]) - strtotime($query_result["start_time"]);
                if ($duration < 0) $duration = 0;
            }
        } else {
            $to_start = time();
            $start_time = date("Y-m-d H:i:s", $to_start);
            $query = mysqli_query($conn, "select * from exams where exam_id= '$eid'") or die(mysqli_connect_error());
            $row = mysqli_fetch_assoc($query);
            $exam_duration = $row["duration"];
            $to_end = $to_start + $exam_duration;
            $end_time = date("Y-m-d H:i:s", $to_end);
            mysqli_query($conn, "INSERT INTO results (user_id, exam_id, start_time, end_time, score, total) VALUES ('$user_id', '$eid', '$start_time', '$end_time', 0, '$tq')");
            $duration = $to_end - $to_start;
        }
    ?>

        <!-- Top Nav -->
        <nav class="d-flex gap-2 p-4 text-white bg-success fixed-top align-items-center justify-content-between">
            <div class="d-flex gap-2 align-items-center">
                <img src="../assets/image/dd-logo.png" alt="DED Logo" style="height:50px; width:auto;" />
                <h2 class="m-0">DED CBT EXAM PAGE</h2>
            </div>
            <div class="text-end">
                <span class="bg-danger p-2 rounded-3 text-light fw-bolder" style="font-size:1.5em">
                    Time Left: <span id="timer" class="ms-2"></span>
                </span>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="container-fluid py-3 px-2">
            <div class="row g-4 px-5">
                <!-- Left Pane: Questions -->
                <div class="col-lg-8 col-md-7 col-sm-12">
                    <h4 class="mb-4"><?= strtoupper($sub); ?></h4>

                    <?php
                    if (empty($_SESSION["user"]["user_id"])) {
                        header("Location: ../index.php");
                        exit;
                    } else {
                        if (isset($_GET["eid"])) {
                            $eid = $_GET["eid"];
                            $sql = "SELECT * FROM questions WHERE exam_id=?";
                            $query = mysqli_prepare($conn, $sql);
                            mysqli_stmt_bind_param($query, 's', $eid);
                            mysqli_stmt_execute($query);
                            $res = mysqli_stmt_get_result($query);
                            $tq = mysqli_num_rows($res);

                            echo "<form method='post' action='submit_exam.php?eid=$eid&sub=$sub&tq=$tq' id='examform' class='w-75'>";
                            while ($row = mysqli_fetch_assoc($res)) {
                                echo "
                                <div class='question-card'>
                                    <h6 class='fw-bold text-uppercase'>Question " . $row['quest_num'] . "</h6>
                                    <div class='my-3'>" . $row['question'] . "</div>
                                    <div class='row'>
                                        <div class='col-6 mb-2 d-flex align-items-center'>
                                            <span class='fw-bold me-2'>A.</span>
                                            <input class='me-2' type='radio' name='" . $row['quest_num'] . "' value='A'>
                                            <label>" . ucfirst($row['option_a']) . "</label>
                                        </div>
                                        <div class='col-6 mb-2 d-flex align-items-center'>
                                            <span class='fw-bold me-2'>B.</span>
                                            <input class='me-2' type='radio' name='" . $row['quest_num'] . "' value='B'>
                                            <label>" . ucfirst($row['option_b']) . "</label>
                                        </div>
                                        <div class='col-6 mb-2 d-flex align-items-center'>
                                            <span class='fw-bold me-2'>C.</span>
                                            <input class='me-2' type='radio' name='" . $row['quest_num'] . "' value='C'>
                                            <label>" . ucfirst($row['option_c']) . "</label>
                                        </div>
                                        <div class='col-6 mb-2 d-flex align-items-center'>
                                            <span class='fw-bold me-2'>D.</span>
                                            <input class='me-2' type='radio' name='" . $row['quest_num'] . "' value='D'>
                                            <label>" . ucfirst($row['option_d']) . "</label>
                                        </div>
                                    </div>
                                </div>
                                ";
                            }
                        }
                    }
                    ?>
                    <button type="submit" class="btn btn-lg btn-success text-uppercase fw-bold mt-2">Submit Exam</button>
                    </form>
                </div>

                <!-- Right Pane: Sticky Instructions -->
                <div class="col-lg-4 col-md-5 col-sm-12 sticky-card ">
                    <div class="card sticky-card">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Instructions</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Please read the instructions carefully before starting the exam.</p>
                            <ul>
                                <li>Attempt all questions.</li>
                                <li>Each question carries equal marks.</li>
                                <li>Do not refresh or close the page.</li>
                                <li>Click “Submit” when done.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script>
            $(document).ready(function() {
                const form = document.getElementById("examform");
                const duration = parseInt('<?= $duration; ?>');
                let time = duration;

                const countdown = setInterval(function() {
                    let minutes = Math.floor(time / 60);
                    let seconds = time % 60;
                    minutes = minutes.toString().padStart(2, '0');
                    seconds = seconds.toString().padStart(2, '0');
                    $("#timer").text(minutes + " : " + seconds);

                    if (time <= 600) {
                        $("#timer").addClass("text-warning fw-bold");
                    }

                    if (time <= 0) {
                        clearInterval(countdown);
                        alert("Time is up! Your exam will be submitted automatically.");
                        form.submit();
                    }
                    time--;
                }, 1000);
            });

            form.addEventListener('submit', function(e) {
                const unanswered = Array.from(form.querySelectorAll('.question-card'))
                    .filter(card => !card.querySelector('input[type=radio]:checked')).length;

                if (unanswered > 0 && !confirm(`You have ${unanswered} unanswered question(s). Submit anyway?`)) {
                    e.preventDefault();
                }
            });
        </script>

    <?php
    } else {
        header("location:index.php");
    }
    ?>
</body>

</html>