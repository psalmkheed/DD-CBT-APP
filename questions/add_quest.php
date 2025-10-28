<?php 
session_start();
if(isset($_SESSION["user"]["user_id"])){
include("header.php");
include("../admin/db.php");
echo "<header class='p-2 col-lg-12 bg-success'><img src='../assets/image/ded.png' class='d-inline-block' style='width:50px; height:50px;'/><span class='text-light p-1 mx-2 d-inline-block' style='line-height:; font-size:24px;'>Do-EstDot International School CBT Portal</span></header>";
//Retrieve exam ID from the link
if(isset($_GET["eid"])){
$eid= $_GET["eid"];
$query= mysqli_query($conn, "SELECT * FROM exams WHERE exam_id='$eid'");
$exam_records= mysqli_fetch_assoc($query);
$tqn= $exam_records["num_quest"];
$paper_type= $exam_records["paper_type"]; 
$sub= $exam_records["subjects"];
$class= $exam_records["class"];
if($paper_type==="Theory"){
    include("get_quest_num");
  
    if($quest_num > $tqn){
        $qd= "UPDATE exams SET status= 'ready' WHERE exam_id='$eid'";
        mysqli_query($conn, $qd);
        echo "<script>alert('You have reached the Limit of $num Questions'); window.location.href='../questions/success.php';</script>";
        }
    if(isset($_GET['res'])){
        $res= $_GET['res'];
        if($res=="success"){$message= "<p class='p-2 text-success fw-bolder'> Question added Successfully </p>";}
        else{$message="<p class='p-2 text-danger  fw-bolder'> Question submission failed </p>";}
        }
        else {$message="";}
        echo '<div class="container-fluid">
            <div class="row bg-light rounded-3 p-3">
                <div class="col-lg-7 p-1">
                    <div class="row p-3">
                        <div class="col-lg-12 p-2 d-flex">
                            <h5 class="p-1">'.$exam_type. '</h5>
                            <h5 class="p-1">'.$exam_records["subjects"]. '</h5>
                        </div>
                        <form action="questions.php?type=theory" method="post" id="myform">
                            <div class="col-lg-12 p-2">
                                <h5 class="p-1">Question ' .$quest_num. ' of ' .$tqn. '</h5>
                                <h6 class="p-1">' .$message.'</h5>
                            </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <textarea class="form-control my-2" name="question" rows="5" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 p-2">
                                    <label class="form-label p-2">Select Score</label>
                                    <select name="score" class="form-select">
                                        <option value="0">1</option>
                                        <option value="1">2</option>
                                        <option value="2">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row p-2 mt-1 ">
                                <input type="hidden" name="total_quest" value="<?=$snum?>"/>
                                <input type="hidden" name="quest_num" value="<?=$quest_num?>"/>
                                <input type="hidden" name="exam_id" value="<?=$eid?>"/>
                                <input type="hidden" name="subject" value="<?=$sub?>"/>
                            </div>
                            <div class="row">
                                <input class="btn btn-lg w-50 mx-auto" type="submit" name="submit_quest" value="Submit Question" style="background:#000088; color:#fff;"/>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>';

        }
    else{
        include("get_quest_num.php");
        if(isset($_GET["res"])){
            $res= $_GET["res"];  
            if($res=="added"){
                $message="<h6 class='text-center p-2 py-3 rounded-3 bg-success text-light' style='height:50px; width:300px;'> Question added Successfully </h6>";} 
            else{
                $message="<h6 class='p-2 py-3 bg-danger rounded-3 text-light' style='height:80px; width:380px;'>You attempted to re-submit an already submitted Question</h6>";}
            }
            else{$message="";}
            if($quest_num > $tqn){
                  echo $tqn;
                $qd= "UPDATE exams SET status= 'ready' WHERE exam_id='$eid'";
                mysqli_query($conn, $qd);
                echo "<script>alert('You have reached the Limit of $tqn Questions'); window.location.href='../questions/success.php';</script>";}
            echo '
                <div class="container-fluid p-0">
                <div class="row bg-light">
                    <div class="col-lg-8  py-1 px-0 d-flex justify-content-start align-items-center text-muted">
                        <h6 class="mx-3"> Paper Type: ' .$paper_type. '</h6>
                        <h6 class="mx-3"> Subject: ' .$sub. '</h6>
                        <h6 class="mx-3"> Class: ' .$class. '</h6>
                    </div>
                    <div class="col-lg-4 py-1 text-end"><span>'.date("D, m, Y").'</span><button class="btn btn-danger mx-3" id="close">Close Page</button></div>
                </div>
            
                <div class="row border border-muted border-1 rounded-2 py-1 px-2">
                    <div class="col-lg-4 bg-light p-3" style="overflow-y:scroll; overflow-x:hidden; height:100vh;">
                    <div class="col-lg-12 text-center mx-auto">'.$message. '</div>
                    <h6 class="text-muted">Question ' .$quest_num. ' of ' .$tqn. '</h6>
                    <form action="questions.php" method="post" id="objform">
                    <div class="row">
                        <div class="form-group">
                            <textarea class="form-control my-2" name="question" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 p-2">
                            <input type="text" class="form-control" name="opt_A" placeholder="Option A" required/>
                        </div>
                        <div class="col-lg-12 p-2">
                            <input type="text" class="form-control" name="opt_B" placeholder="Option B" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 p-2">
                            <input type="text" class="form-control" placeholder="Option C" name="opt_C" required/>
                        </div>
                        <div class="col-lg-12 p-2">
                            <input type="text" class="form-control" placeholder="Option D" name="opt_D" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 p-2">
                            <label class="form-label p-2 fw-medium">Select Answer</label>
                            <select name="correct_answer" class="form-select">
                                <option value="A">Option A</option>
                                <option value="B">Option B</option>
                                <option value="C">Option C</option>
                                <option value="D">Option D</option>
                            </select>
                        </div>
                    </div>
                    <div class="row p-2 mt-1 ">
                        <input type="hidden" name="total_quest" value="'.$tqn.'"/>
                        <input type="hidden" name="quest_num" value="'.$quest_num.'"/>
                        <input type="hidden" name="exam_id" value="'.$eid.'"/>
                        <input type="hidden" name="subject" value="'.$sub.'"/>
                    </div>
                    <div class="col-lg-5 p-2 ">
                        <input class="btn btn-md btn-secondary" id="submit_quest" type="submit" name="submit_quest" value="Submit Question"/>
                    </div>
                    </form>
                    </div>
                    <div class="col-lg-4 p-2" style="overflow-y:scroll; height:100vh;">
                        <h5 class="p-2 text-muted">Questions Preview</h5>
                        <div id="preview"></div>
                    </div>
                    <div class="col mx-auto"><h5 class="p-2 text-muted">Attach files for questions involving diagrams</h5>
                    <form method="post" enctype="multipart/form-data" id="fileupload">    
                        <div class="form-group">
                            <label class="form-label">Upload files</label>
                            <input class="form-control" type="file" name="uploads" />
                            <input type="hidden" name="eid" value="' .$eid. '" />
                            <span class="d-block text-dark p-2 fw-bold" style="font-size:12px;">Ensure to upload a JPG/PNG file. Other file formats such as .DOCX, CSV will be supported later</span>
                            <button class="btn btn-md btn-secondary text-light">Upload File</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>';
        } 
    }
}

else{
    echo "Access Denied. This is a protected page!";
}
?>
<script>
    $(document).ready(function(){
        $("#close").click(function(){
            window.location.href= "../staff"
        });

        let url="questions.php?qs=get_quest&eid=<?=$eid?>";
        $("#preview").load(url);

        $("#fileupload").submit(function(event){
            event.preventDefault();
            var formdata= new FormData(this);
            console.log(formdata);
            $.ajax({
                method: "POST",
                data: formdata,
                url: "upload_fie.php",
                success: function(res){
                    $("#fileupload").reset[0];
                    alert(res);
                    
                }
            });
        });



    })
</script>