<?php
include("../backend/db.php");
$checkLogin= loginAuth($conn,"mitechconcepts@gmail.com", "Mitech247");
print_r($checkLogin);
?>




<style>
    .form-label{
        font-weight:bold;
        margin-top:5px;
        margin-bottom:5px;
    }
</style>
<body class="bg-light">
<div class='container m-0'>
    <div class='row'>
        <div class="col-lg-4 mx-auto p-2">
            <?php
                include("../header.php");
                $num= 3;
                session_start();
                if(!isset($_SESSION["page_num"])){
                    $page_num=1;
                }
                else{
                    $page_num= $_SESSION["page_num"];
                }
                for($i=1; $i<= $num; $i++){
                    if($i==$page_num){
                        echo "<a class='btn btn-danger mx-2'  href=sample.php?q=$i>" .$i . "</a>";
                    }
                    else{
                    echo "<a class='btn btn-primary mx-2'  href=sample.php?q=$i>" .$i . "</a>";}
                }
            ?>
        </div>
    
            <div class="col-lg-8 mx-auto">
        <div class="col-lg-12 p-2 bg-light text-secondary">Page <?= $page_num ?> of <?=$num;?></div>
        <form action="process_quest.php?q=<?=$page_num?>" method="post">
        <div class="col-lg-12 p-2">
            <h5 class='p-1'>Question <?=$page_num?></h5>
            <textarea id="quest" class='form-control' name='question' rows='4'></textarea>
            <div class="row">
                <div class="col-lg-6">
                    <div class='form-group'>
                        <label class="form-label" for="option a"> Option A </label>
                        <input type='text' class='form-control' name='opt_A'/>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="option b"> Option B </label>
                        <input type='text' class='form-control' name='opt_B'/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class='form-group'>
                        <label class="form-label" for="option c"> Option C </label>
                        <input type='text' class='form-control' placeholder='Choice C' name='opt_C'/>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="option d"> Option D </label>
                        <input type='text' class='form-control' placeholder='Choice D' name='opt_D'/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class='form-label'>Select correct option</label>
                        <select name='correct_answer' class='form-select'>
                            <option value='A'>Option A</value>
                            <option value='B'>Option B</value>
                            <option value='C'>Option C</value>
                            <option value='D'>Option D</value>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row p-2 mt-1 ">
                <input type="hidden" name="total_quest" value="<?=$num?>"/>
                <input class="btn btn-primary btn-lg" type="submit" name="submit_quest" />
            </div>
        <form>
        </div>
    </div>
</div>



    //This section loads the questions page into the displaybox
 //   $(document).on("click", ".add_questions", function(e){
 //   e.preventDefault();
 //   let url= $(this).attr("href");
  //  $("#content_box").load(url);
 //   });

    //This section handles Objectives form
    $(document).on("submit", "#objform", function(e){
    e.preventDefault();
    let data= $(this).serialize();
    let url= "../" + $("#objform").attr("action");
        $.ajax({
            method: "post",
            url: url,
            data: data,
            success: function(res){
                if(res){
                    let data= JSON.parse(res);
                    console.log(data);
                   
                   $("#message").html("<p class='p-2 text-success fw-bolder'> Question added Successfully </p>");
                    $("#objform").trigger("reset");
                }
                else if(res==="duplicate"){
                    $("#message").html("<p class='p-2 text-danger fw-bolder'> You attempted to re-submit an already submitted Question </p>");
                }

            }
        });
    });
