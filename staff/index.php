 <?php
 include("header.php");
 //include("chart.php");
 include("../admin/db.php");
 session_start();
 if(!isset($_SESSION["user"]["user_id"])){
    header("Location:../index.php");
    exit;
 }
 $acad_info= getAcadYear($conn);
 $term= $acad_info["term"];
 $sess= $acad_info["year"];
 ?>
  
 <style>
    body{
        font-size:14px;
       font-family: sans-serif;
    }
    .side-nav{
        background-color:#fff;
        height:100vh;
    }

    .sidebar{
        margin:0;
        padding:0;
    }
   .side-nav .sidebar li{
        display:block;
        margin-top:15px;
        margin-bottom:15px;
        padding-top:0.75em;
        padding-bottom:0.75em;
        padding-left:0.4em;
        padding-right:0.4em;
        color:#333!important;
        cursor: pointer;
       
    }
   .side-nav .sidebar .active{
   background: linear-gradient(to right, #13a147ff, #22c55e);
   border-radius:5px;
   color:#fff!important;
   font-weight: bold;
   }
   .side-nav .sidebar .active:hover{
   background: linear-gradient(to right, #13a147ff, #22c55e);
   }
   
   .side-nav .sidebar .active i{
    color:#fff!important;
   }

  .sidebar li i, i{
        color:#000;
        font-size:14px;!important
    }
</style>

<div class="container-fluid">
    <div class="row p-0">
        <div class="col-lg-2 py-3 bg-light side-nav">
            <ul class="sidebar">
                <li id="dashboard" class="active"><i class="bi bi-grid-fill me-3"></i>Overview</li>
                <li id="view_exams"><i class="bi bi-view-stacked me-3"></i> View Examinations</li>
                <li><i class="bi bi-bell-fill me-3"></i> Notifications </li>
                <li><i class="bi bi-broadcast me-3"></i> Send Broadcast </li>
                <li><i class="bi bi-chat-left-fill me-3"></i>Memo</li>
                <li><i class="bi bi-gear-fill me-3"></i>Settings</li>
                 <li id="logout" class="mt-3"><i class="bi bi-box-arrow-right me-3"></i></i>LogOut</li>
            </ul>
        </div>
        <div class="col-lg-10 p-2">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <div class="container-fluid">
                             <div class="row p-2 mb-2">
                            <div class="col-lg-12 border-1 border-bottom border-secondary" style="font-family:georgia; font-size:25px;">
                            <span class="fw-bolder">
                                <img class="d-inline-block" src="../assets/image/ded.png" style="width:55px; height:55px;"><h3 class="text-dark p-2 d-inline-block fw-bold" style="font-family: sans-serif;"> DOESTDOT INTERNATIONAL SCHOOLS </h3>
                            </span>
                            </div>
                        </div>
                            <div class="row text-dark px-3" id="content_box">
                                <div class="col-lg-12" style="background:#fff;">
                                    <div class="container">
                                        <div class="row p-2 rounded-3">
                                            <div class="col-lg-4">
                                                <img class="img-thumbnail d-block" src="../admin/<?=$_SESSION['user']['directory'] ?>" style="width:150px; height:150px;"/>
                                            </div>
                                            <div class="col-lg-7 mx-auto">
                                                <h4>Staff Profile</h4>
                                                <table class="table table-striped">
                                                    <tr><td>Names</td><td><?= $_SESSION["user"]["surname"]; ?> <?= $_SESSION["user"]["other_names"]; ?></td></tr>
                                                    <tr><td>User_id</td><td><?= $_SESSION["user"]["user_id"]; ?></td></tr>
                                                    <tr><td>Role</td><td><?= $_SESSION["user"]["user_role"]; ?></td></tr>
                                                    
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
$(document).ready(function(){
    $(".sidebar li").click(function(){
        $(".sidebar li").removeClass("active");
        $(this).addClass("active");
    });

    $("#dashboard").click(function(){
        location.href=""
    });

    $("#view_exams").click(function(){
        $("#content_box").load("../exams/view_exams.php?qs=view_exams");
    });

    $("#logout").click(function(){
        location.href="../logout.php"
    });

    $(document).on("click", ".get_results", function(e){
    e.preventDefault();
    let url= $(this).attr("href");
    $("#content_box").load(url);
    });
});



</script>
