 <?php
    include("header.php");
    //include("chart.php");
    include("../admin/db.php");
    session_start();
    if (!isset($_SESSION["user"]["user_id"])) {
        header("Location:../index.php");
        exit;
    }
    $acad_info = getAcadYear($conn);
    $term = $acad_info["term"];
    $sess = $acad_info["year"];
    ?>

  <div class="container-fluid p-0 m-0">
     <nav class="d-flex align-items-center justify-content-between px-3 bg-success text-white" style="height: 60px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
         <div class="d-flex align-items-center gap-1">
             <img class="d-inline-block" src="../assets/image/dd-logo.png" style="width:35px; height:35px;">
             <h4 class="ps-2 d-inline-block fw-bolder text- m-0">Exam Portal</h4>
         </div>
         <h4 class="m-0"></h4>
         <div class="d-flex align-items-center gap-3">
             <i class="bi bi-bell-fill fs-4"></i>
             <div class="d-flex align-items-center gap-2 py-1 px-3 rounded-2" id="profile-btn">
                 <img class="rounded-circle" src="../admin/<?= $_SESSION['user']['directory'] ?>" style="width:35px; height:35px;" />
                 <p class="text-white fs-6 fw-medium m-0">
                     <?= ucfirst($_SESSION["user"]["other_names"]); ?>
                 </p>
             </div>
         </div>
     </nav>

     <div class="row p-0 flex-lg-row m-0">
         <div class="col-lg-2 py-3 text-secondary side-nav">
             <ul class="sidebar">
                 <li id="dashboard" class="active"><i class="bi bi-grid-fill me-2"></i>Overview</li>
                 <li id="view_exams"><i class="bi bi-view-stacked me-2"></i> View Examinations</li>
                 <!-- <li id="add_exam"><i class="bi bi-table me-2"></i> Results</li> -->
                 <li id="exam_history"><i class="bi bi-database-fill me-2"></i>Exam History</li>
                 <li><i class="bi bi-bell-fill me-2"></i> Notifications </li>
                 <li id="logout" class="mt-3 fw-bold bg-red-500 text-white"><i class="bi bi-box-arrow-right me-2"></i>LOGOUT</li>
             </ul>
         </div>
         <div class="col-lg-10 bg-gray-100">
             <div class="container-fluid">
                 <div class="row">
                     <div class="col-lg-12 m-0 p-0">
                         <div class="container-fluid m-0 p-0">
                             <div class="row py-2 m-0">
                                 <div class=" shadow-sm d-lg-flex rounded-3 align-items-center justify-between mb-4 gap-3 greeting" style="background: linear-gradient(to right, #13a147ff, #22c55e);">
                                     <div class="flex-1">
                                         <h3 class="text-white">Welcome Back <?= strtoupper($_SESSION["user"]["surname"]); ?> <?= strtoupper($_SESSION["user"]["other_names"]); ?>!</h3>
                                         <p class="text-white ">You have successfully logged into your student portal. You can now view and take your examinations. Please ensure to check your exam schedule and be prepared for your upcoming exams. <span class="fw-bold fs-5">Good luck!</span></p>
                                     </div>
                                     <div class="">
                                         <img class="" src="../assets/icon/online-exam.svg" style="width:200px; transform: scaleX(-1);" />
                                     </div>
                                 </div>

                                 <div class="row m-0 p-0 text-dark w-full" id="content_box">

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
         $(".sidebar li").click(function() {
             $(".sidebar li").removeClass("active");
             $(this).addClass("active");
         });

         $("#dashboard").click(function() {
             location.href = ""
         });

         $("#view_exams").click(function() {
             $("#content_box").load("../exams/view_student_exams.php");
         });

         $("#exam_history").click(function() {
             $("#content_box").load("../exams/exam_history.php");
         });

         $("#logout").click(function() {
             location.href = "../logout.php"
         });

         $(document).on("click", ".get_results", function(e) {
             e.preventDefault();
             let url = $(this).attr("href");
             $("#content_box").load(url);
         });

     });
 </script>