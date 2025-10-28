 <?php
    include("header.php");

    ?>

 <div class="col-lg-12 p-0 m-0" id="content_box">
     <div class="px-3 py-2 text-white mb-3 rounded-3" style="background: linear-gradient(90deg, #0700b8 50%, #00ff88 100%)">
         <h5 class="m-0">Profile Information</h5>
     </div>
     <div class="row m-0 p-4 d-flex align-items-center gap-3 border">
     <div class="col-lg-2">
         <img class=" d-block" src="<?= $_SESSION['user']['directory'] ?>" style="width:150px; height:150px;" />
     </div>
     <div class="col-lg-10 w-50">
         <table class="table table-striped w-75 table-bordered table-hover">
             <tr>
                 <td class="fw-bold text-uppercase bg-success text-white">Names</td>
                 <td><?= strtoupper($_SESSION["user"]["surname"]); ?> <?= strtoupper($_SESSION["user"]["other_names"]); ?> </td>
             </tr>
             <tr>
                 <td class="fw-bold text-uppercase bg-success text-white">User Id</td>
                 <td><?= strtoupper($_SESSION["user"]["user_id"]); ?></td>
             </tr>
             <tr>
                 <td class="fw-bold text-uppercase bg-success text-white">Role</td>
                 <td><?= strtoupper($_SESSION["user"]["user_role"]); ?></td>
             </tr>
             <tr>
                 <td class="fw-bold text-uppercase bg-success text-white">Term</td>
                 <td><?= strtoupper($term); ?> <span class=" text-uppercase">Term</span></td>
             </tr>
             <tr>
                 <td class="fw-bold text-uppercase bg-success text-white">Session</td>
                 <td><?= strtoupper($sess); ?> <span class="text-uppercase"> Session</span></td>
             </tr>
         </table>
     </div>
 </div>