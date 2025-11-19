<?php
include("header.php");
$staff = getAllStaff($conn);
$exam = getAllExams($conn);
$student = getAllStudents($conn);
$term = getActiveTerm($conn);

// function to get current time greeting
function getCurrentTime()
{
    $t = date("H");
    if ($t < 12) {
        echo "Good Morning,";
    } elseif ($t < 17) {
        echo "Good Afternoon,";
    } else {
        echo "Good Evening,";
    };
}

?>

<div class="container-fluid p-0 m-0">
    <nav class="d-flex align-items-center justify-content-between px-3 bg-dark text-white" style="height: 60px; box-shadow: 0 2px 4px rgba(0,0,0,0.5); border-bottom: 2px solid rgba(0,0,0,0.2);">
        <div class="d-flex align-items-center gap-1">
            <img class="d-inline-block" src="../assets/image/dd-logo.png" style="width:35px; height:35px;">
            <h4 class="ps-2 d-inline-block fw-bolder text- m-0">DD Admin Portal</h4>
        </div>
        <!-- <h4 class="m-0"></h4> -->
        <div class="d-flex align-items-center gap-3">
            <i class="bi bi-bell-fill fs-4"></i>
            <div class="d-flex align-items-center gap-2 py-1 px-3 rounded-2" id="profile-btn">
                <img class="rounded-circle" src="<?= $_SESSION['user']['directory'] ?>" style="width:35px; height:35px;" />
                <p class="text-white fs-6 fw-medium m-0">
                    <?= ucfirst($_SESSION["user"]["other_names"]); ?>
                </p>
                <img src="../assets/icon/chevron-down.svg" alt="dropdown icon" style="width:25px; height:25px;" />
                <div class="bg-dark text-white shadow-sm rounded-bottom-2 text-start" id="profile-dropDown">
                    <ul class="d-flex flex-column text-start profile-list p-2 text-success">
                        <li class="mt-2 p-2" id="profile"> VIEW PROFILE </li>
                        <li class="p-2"> SETTINGS </li>
                        <li class="p-2" id="logout">LOGOUT</li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex flex-col md:flex-row p-0">
        <!-- Sidebar starts here -->
        <div class="">
            <ul class="sidebar p-2 bg-dark text-white d-flex flex-column gap-2 m-0" style="background:rgba(0,0,0,0.5)">
                <li class="active"><img src="../assets/icon/table-of-contents.svg" />Overview</li>
                <li id="new_student"><img src="../assets/icon/user-round-plus.svg" />Create Student</li>
                <li id="new_staff"><img src="../assets/icon/user-plus.svg" />Create Teacher</li>
                <li id="add_exam"><img src="../assets/icon/file-plus-2.svg" />Create Examination</li>
                <li id="view_exams"><img src="../assets/icon/file-search.svg" />View Examinations</li>
                <li id="students"><img src="../assets/icon/database.svg" />Student Records</li>
                <li id="staff"><img src="../assets/icon/database.svg" />Staff Records</li>
                <li><img src="../assets/icon/bell.svg" />Notifications</li>
                <li><img src="../assets/icon/setting.svg" />Settings</li>
            </ul>
        </div>
        <!-- Top NavBar1 -->
        <div class="flex-1">
            <!-- Main Content starts here -->
            <div class="row text-dark main-content px-4 py-2" id="content_box">
                <div class="px-3 py-2 text-white mb-3 rounded-3 w-full" style="background: rgba(0, 123, 255, 0.8);">
                    <h5 class="m-0">Admin Dashboard Overview</h5>
                </div>
                <div class="d-flex flex-column text-white mb-3 p-4 text-start bg-primary rounded-3">
                    <p class="m-0">
                        <?= getCurrentTime(); ?>
                        <b><?= strtoupper($_SESSION["user"]["other_names"]); ?>!</b>
                    </p>
                    <p class="m-0">Here's an overview of your exam management system.</p>
                </div>
                <div class="row m-0 p-2">
                    <div class="dashboard-card-group">
                        <!-- grid-col-1 -->
                        <div class="dashboard-card border-primary">
                            <div class="dashboard-card-icon bg-primary">
                                <img src="../assets/icon/user.svg" alt="icon" />
                            </div>
                            <div class="d-flex flex-column">
                                <h5>Registered Students</h5>
                                <h3 class="text-primary"><?= count($student); ?></h3>

                            </div>
                        </div>
                        <!-- grid-col-2 -->
                        <div class="dashboard-card border-success">
                            <div class="dashboard-card-icon bg-success">
                                <img src="../assets/icon/users.svg" alt="icon" />
                            </div>
                            <div class="d-flex flex-column">
                                <h5>Total Staff</h5>
                                <h3 class="text-success"><?= count($staff); ?></h3>

                            </div>
                        </div>
                        <!-- grid-col-3 -->
                        <div class="dashboard-card border-warning">
                            <div class="dashboard-card-icon bg-warning">
                                <img src="../assets/icon/book-open.svg" alt="icon" />
                            </div>
                            <div class="d-flex flex-column">
                                <h5>Examinations</h5>
                                <h3 class="text-warning"><?= count($exam); ?></h3>

                            </div>
                        </div>
                        <!-- grid-col-4 -->
                        <div class="dashboard-card border-danger">
                            <div class="dashboard-card-icon bg-danger">
                                <img src="../assets/icon/calendar-check-2.svg" alt="icon" />
                            </div>
                            <div class="d-flex flex-column">
                                <h5>Active Term</h5>
                                <h3 class="text-danger" style="font-size: 30px"><?= strtoupper($term); ?></h3>

                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>

    </div>

</div>
</div>
</div>

</div>

</div>

</div>
</div>
</div>
<!--JQuery Begins here -->
<script>
    $(document).ready(function() {
        $(".active").click(function() {
            location.href = "";
        });
        $(".sidebar li").click(function() {
            $("li").removeClass("active");
            $(this).addClass("active");
        });
        $("#students").click(function() {
            $("#content_box").load("get_students.php");
        });

        $("#staff").click(function() {
            $("#content_box").load("get_staffs.php");
        });
        $("#view_exams").click(function() {
            $("#content_box").load("../exams/view_exams.php?qs=view_exams");
        });
        $("#new_student").click(function() {
            $("#content_box").load("create_student.php");
        });

        $("#new_staff").click(function() {
            $("#content_box").load("create_staff.php");
        });

        $("#add_exam").click(function() {
            $("#content_box").load("../exams/add_exam.php");
        });
        $("#profile").click(function() {
            $("#content_box").load("./profile.php");
        });
        $("#logout").click(function() {
            location.href = "../logout.php"
        });

        $(document).on("submit", "#myform2", function(event) {
            event.preventDefault();
            var url = "create_student_account.php";
            var formdata = new FormData(this);
            $.ajax({
                url: url,
                method: "POST",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(res) {
                    $("#result").html(res);
                },
                error: function(xhr, status, error) {
                    $("#result").html("Ajax Error" + xhr.responseText);
                }
            });
        });

        $(document).on("click", ".pub_exam", function(e) {
            e.preventDefault();
            let url = $(this).attr("href");
            $.ajax({
                url: url,
                method: "GET",
                success: function(res) {
                    alert(res);
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    alert("Ajax Error" + xhr.responseText);
                }
            });

        });

        $(document).on("click", ".del_exam", function(e) {
            e.preventDefault();
            let url = $(this).attr("href");
            alert(url);
            $.ajax({
                url: url,
                method: "GET",
                success: function(res) {
                    alert(res);
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    alert("Ajax Error" + xhr.responseText);
                }
            });

        });

        $(document).on("click", ".view-results", function(e) {
            e.preventDefault();
            let url = $(this).attr("href");
            console.log(url);
            $("#content_box").load(url);
        });

        $(document).on("click", ".del-result", function(e) {
            e.preventDefault();
            let url = "../" + $(this).attr("href");
            $.ajax({
                url: url,
                method: "GET",
                success: function(res) {
                    alert(res);
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    alert("Ajax Error" + xhr.responseText);
                }
            });

        });

    });
</script>