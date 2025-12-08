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

<div class="container-fluid p-0" style="height: 100vh; background: #F2FDFD;">
    <div class="flex flex-col md:flex-row gap-5 p-3 max-h-screen">
        <!-- Sidebar starts here -->
        <div class="overflow-visible
 sidebar bg-white shadow-md rounded-xl pb-2 lg:w-[200px]" style="position: sticky; top: 0; left: 0; height: calc(100vh - 30px); z-index: 1000;">
            <!-- Brand Logo -->
            <div class="d-flex align-items-center gap-3 p-2 mb-2">
                <img class="" src="../assets/image/dd-logo.png" style="width:35px; height:35px;">
                <h6 class="fw-bold text- m-0">CBT Admin</h6>
            </div>
            <ul class="text-gray-700 ps-0 pe-2">
                <li class="active hover:bg-green-100 hover:text-green-500"><i class="fa-solid fa-bars text-sm"></i>Overview</li>
                <li class="hover:bg-sky-100 hover:text-sky-500" id="new_student"><i class="fa-solid fa-user-plus text-sm"></i>Add Student</li>
                <li class="hover:bg-orange-100 hover:text-orange-500" id="new_staff"><i class="fa-solid fa-user text-sm"></i>Add Teacher</li>
                <li class="hover:bg-purple-100 hover:text-purple-500" id="add_exam"><i class="fa-solid fa-file text-sm"></i>Add Examination</li>
                <li class="hover:bg-yellow-100 hover:text-yellow-500" id="view_exams"><i class="fa-solid fa-file text-sm"></i>View Examinations</li>
                <li class="hover:bg-cyan-100 hover:text-cyan-500" id="students"><i class="fa-solid fa-database text-sm"></i>Student Records</li>
                <li class="hover:bg-green-100 hover:text-green-500" id="staff"><i class="fa-solid fa-database text-sm"></i>Staff Records</li>
                <li class="hover:bg-red-100 hover:text-red-500"><i class="fa-solid fa-bell text-sm"></i>Notifications</li>
                <li class="hover:bg-blue-100 hover:text-blue-500"><i class="fa-solid fa-gear text-sm"></i>Settings</li>
            </ul>
            <!-- user-profile sidebar -->
            <div class="bg-green-200 rounded-2 flex align-items-center gap-1  py-2 px-2 mx-2 justify-between">
                <div class="flex gap-1">
                    <img class="rounded-circle" src="<?= $_SESSION['user']['directory'] ?>" style="width:25px; height:25px;" />
                    <div class="flex flex-col align-items-start gap-0">
                        <p class="text-xs fw-medium m-0">
                            <?= ucfirst($_SESSION["user"]["other_names"]); ?>
                        </p>
                        <p class="fw-medium m-0 text-gray-500" style="font-size: 10px;">
                            <?= ucfirst($_SESSION["user"]["user_role"]); ?>
                        </p>
                    </div>
                </div>
                <!-- <div class="relative group inline-block overflow-visible
"> -->
                <i class="fa-solid fa-arrow-right-from-bracket 
               text-red-500 text-lg 
               hover:text-red-600 
               transition cursor-pointer p-2"
                    id="logout" title="Logout">
                </i>

                <!-- Tooltip
                    <span class="absolute left-1/2 -translate-x-1/2 mt-2 
                 opacity-0 group-hover:opacity-100 
                 bg-gray-800 text-white text-xs 
                 px-2 py-1 rounded shadow-lg 
                 whitespace-nowrap transition">
                        Logout
                    </span>
                </div> -->

            </div>
            <div class="text-center text-gray-500 small mt-2">
                &copy; <b><?= date("Y"); ?></b> CBT Management System
            </div>
        </div>
        <!-- Top NavBar1 -->
        <div class="lg:w-[calc(100%-200px)]">
            <nav class="rounded-xl d-flex align-items-center justify-content-end px-3 py-4 bg-white text-gray-700" style="height: 40px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">

                <div class="d-flex align-items-center me-3">
                    <input
                        type="text"
                        id="searchQuery"
                        class="w-full p-2 border rounded me-2"
                        placeholder="Type to search...">

                    <select id="searchType" class="p-2 border rounded">
                        <option value="user">Users</option>
                        <option value="exam">Exams</option>
                    </select>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center gap-2 py-1 px-3 rounded-2" id="profile-btn">

                        <img class="rounded-circle" src="<?= $_SESSION['user']['directory'] ?>" style="width:30px; height:30px;" />

                        <div class="flex flex-col justify-start text-start">
                            <p class="text-sm fw-medium m-0">
                                <?= ucfirst($_SESSION["user"]["other_names"]); ?>
                            </p>
                            <p class="fw-medium m-0 text-gray-500" style="font-size: 10px;">
                                <?= ucfirst($_SESSION["user"]["user_role"]); ?>
                            </p>
                        </div>
                        <img src="../assets/icon/chevron-down.svg" alt="dropdown icon" class="drop-down-chevron" />
                        <div class="bg-white text-gray-700 shadow-sm rounded-bottom-2 text-start" id="profile-dropDown">
                            <ul class="d-flex flex-column text-start profile-list p-2 text-gray-700">
                                <li class="mt-2 p-2" id="profile"> View Profile </li>
                                <li class="p-2"> Setings </li>
                                <li class="p-2" id="logout">Logout</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Main Content starts here -->
            <div class="row text-dark main-content px-3 py-2 mb-5" id="content_box">

                <div class="px-3 py-2 text-primary mb-3 rounded-3 w-full">
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
                <div id="results" class="mt-4 mb-5"></div>
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

    // Search Functionality

    $(document).ready(function() {

        function fetchResults() {
            let query = $("#searchQuery").val();
            let type = $("#searchType").val();

            if (query.length < 1) {
                $("#results").html("");
                return;
            }

            $.ajax({
                url: "../backend/search.php",
                type: "GET",
                data: {
                    query: query,
                    type: type
                },
                beforeSend: function() {
                    $("#results").html("<p class='text-gray-400'>Searching...</p>");
                },
                success: function(data) {
                    $("#results").html(data);
                }
            });
        }

        let typingTimer;
        let doneTypingInterval = 300;

        $("#searchQuery").on("keyup", function() {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(fetchResults, doneTypingInterval);
        });

        $("#searchQuery").on("keydown", function() {
            clearTimeout(typingTimer);
        });

        function highlight(text, query) {
            let regex = new RegExp(`(${query})`, "gi");
            return text.replace(regex, "<span class='bg-yellow-200'>$1</span>");
        }
        if (query.length < 1) {
            $("#search_results").html(""); // clear only search results
            return;
        }
        $("#results").html(highlight($("#results").html(), query));

    });
</script>