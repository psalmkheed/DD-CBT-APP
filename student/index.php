<?php
include("../admin/db.php");
session_start();

if (!isset($_SESSION["user"]["user_id"])) {
    header("Location: ../index.php");
    exit;
}

include("header.php");
?>

<style>
    /* Fixed header height */
    :root {
        --header-h: 65px;
        --sidebar-w: 200px;
        /* adjust if your sidebar width differs */
    }

    /* Make sure body content starts below header */
    body {
        padding-top: var(--header-h);
    }

    /* Navbar already fixed in your markup, just ensure z-index is high */
    nav.fixed-top-like {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: var(--header-h);
        z-index: 1000;
    }

    /* Sidebar: fixed to left, take full height minus header */
    .side-nav {
        position: fixed;
        top: var(--header-h);
        left: 0;
        width: var(--sidebar-w);
        height: calc(100vh - var(--header-h));
        background-color: #f8f9fa;
        padding-top: 1rem;
        border-right: 1px solid #e6e6e6;
        z-index: 900;
        padding: 10px;
    }

    /* Sidebar list style */
    .side-nav .sidebar {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .side-nav .sidebar li {
        padding: 12px 18px;
        cursor: pointer;
        border-bottom: 1px solid #eee;
    }

    .side-nav .sidebar li.active,
    .side-nav .sidebar li:hover {
        background-color: #22c55e;
        color: #fff;
    }

    /* Main content area: offset from left by sidebar width */
    .main-content {
        margin-left: var(--sidebar-w);
        min-height: calc(100vh - var(--header-h));
        padding: 24px;
        background: #f8fafc;
    }

    /* Inner content box should scroll normally */
    #content_box {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Greeting card tweak */
    .greeting {
        padding: 20px;
        border-radius: 8px;
    }

    /* Responsive: collapse sidebar on small screens */
    @media (max-width: 991.98px) {
        :root {
            --sidebar-w: 0px;
        }

        .side-nav {
            transform: translateX(-110%);
            transition: transform .25s ease;
            width: 220px;
            /* when opened */
        }

        .side-nav.open {
            transform: translateX(0);
            z-index: 1100;
        }

        .main-content {
            margin-left: 0;
            padding: 16px;
        }

        /* show a small top bar control to toggle the sidebar */
        .mobile-menu-btn {
            display: inline-block;
        }
    }

    /* Hidden by default (mobile-first) */
    #profileInfo {
        display: none !important;
    }

    /* Show on tablets & desktops */
    @media (min-width: 768px) {
        #profileInfo {
            display: flex !important;
        }
    }

    #profileInfo {
        display: flex;
    }

    @media (max-width: 768px) {
        #profileInfo {
            display: none;
        }
    }


    /* small utility styles */
    .rounded-circle {
        border-radius: 50% !important;
    }
</style>

<div class="container-fluid">
    <!-- Navbar -->
    <nav class="d-flex justify-content-between align-items-center shadow-sm p-3 w-100 bg-success text-white fixed-top-like"
        style="height: 65px;">
        <div class="d-flex align-items-center gap-2">
            <img src="../assets/image/dd-logo.png" style="width: 35px; height: 35px;" alt="Logo" />
            <h3 class="m-0 fw-bolder">DD CBT Portal</h3>
        </div>

        <div class="d-flex align-items-center gap-2">
            <!-- Profile Picture and Name -->
            <div class="d-flex align-items-center gap-2" id="profileInfo">
                <img class="rounded-circle shadow-md"
                    src="../admin/<?= htmlspecialchars($_SESSION['user']['directory']) ?>"
                    style="width:35px; height:35px;" alt="Profile" />
                <p class="p-0 m-0 text-white">
                    <?= strtoupper($_SESSION["user"]["surname"]) . " " . strtoupper($_SESSION["user"]["other_names"]); ?>
                </p>
            </div>
            <button class="btn btn-lg btn-light d-lg-none mobile-menu-btn" id="toggleSidebar" style="display:none;">
                ☰
            </button>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="side-nav shadow-lg" id="sideNav">
        <ul class="sidebar">
            <li id="dashboard" class="active">Overview</li>
            <li id="view_exams">View Examinations</li>
            <li id="exam_history">Exam History</li>
            <li>Notifications</li>
            <li id="logout" class="mt-3 fw-bold text-center" style="background:#dc2626; color:#fff; border-radius:0 0 10px 10px;">
                LOGOUT
            </li>
        </ul>
    </div>

    <!-- Main content: margin-left ensures it's not under the fixed sidebar -->
    <main class="main-content">
        <div id="content_box">
            <div class="shadow-sm d-lg-flex rounded-3 align-items-center mb-4 gap-3 greeting"
                style="background: linear-gradient(to right, #13a147, #22c55e);">
                <div class="flex-1">
                    <h3 class="text-white">Welcome Back <?= strtoupper($_SESSION["user"]["surname"]); ?> <?= strtoupper($_SESSION["user"]["other_names"]); ?>!</h3>
                    <p class="text-white">You have successfully logged into your student portal... <span class="fw-bold fs-5">Good luck!</span></p>
                </div>
                <div>
                    <img src="../assets/icon/online-exam.svg" style="width:200px; transform: scaleX(-1);" alt="Exam" />
                </div>
            </div>

            <!-- other content goes here -->
        </div>
    </main>
</div>

<script>
    $(document).ready(function() {
        // Sidebar active class behavior
        $(".sidebar li").click(function() {
            $(".sidebar li").removeClass("active");
            $(this).addClass("active");
        });

        // Buttons that load content
        $("#dashboard").click(function() {
            window.location.reload();
        });
        $("#view_exams").click(function() {
            $("#content_box").load("../exams/view_student_exams.php");
        });

        $("#exam_history").click(function() {
            $("#content_box").load("../exams/exam_history.php");
        });

        $("#logout").click(function() {
            location.href = "../logout.php";
        });

        $(document).on("click", ".get_results", function(e) {
            e.preventDefault();
            let url = $(this).attr("href");
            $("#content_box").load(url);
        });

        // Mobile sidebar toggle
        function updateMobileBtnVisibility() {
            if (window.innerWidth < 992) {
                $(".mobile-menu-btn").show();
                $("#toggleSidebar").show();
                // hide sidebar by default
                $("#sideNav").removeClass("open");
            } else {
                $(".mobile-menu-btn").hide();
                $("#toggleSidebar").hide();
                $("#sideNav").removeClass("open");
            }
        }

        $("#toggleSidebar").click(function() {
            $("#sideNav").toggleClass("open");
        });

        $(window).on("resize", updateMobileBtnVisibility);
        updateMobileBtnVisibility();
    });
</script>