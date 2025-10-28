<?php
date_default_timezone_set("Africa/Lagos");
// a snippet to test run PHP dates functions
$start_time= time();
echo "$start_time <br/>";
$duration= 30 * 60;
$end_time= $start_time + $duration;
echo "$end_time <br/>";
 $diff= $end_time - $start_time;
 $t= date("Y/m/d H:i:s", $end_time);
 echo "<br/>$t<br/>";
 echo date("Y/m/d H:i:s", $start_time) . "<br/> $diff<br/>";

 echo strtotime(date("Y-m-d H:i:s", $diff));
 //echo $t;
//$diff= $time1 -$time2;
//echo $time1/(60);
//$end_date = $current_date + strtotime("30 minutes");
//$diff= $future_date - $current_date;
//$time_in_days = $diff / (24*60*60*365);
//echo $current_date;


echo "<script>alert('You have already taken this Examination.'); window.location.href='../student/index.php';</script>";




//echo "There are ". $time_in_days. " year(s) between " .$current_date. " and ". $future_date;

include("admin/db.php");
$check= checkScore($conn, "DIS/S/LA/001", "687c14b47e751");
//echo $check;
?>

    //check if student has not started the exam.
        if($query_res["start_time"]==""){
        //insert records in Results table to track exam information
        $to_start= time();
        echo $to_start(); exit;
        $start_time= strtotime("Y-m-d H:i:s", $to_start);
        $to_end = $start_time + $exam_duration;
        $duration= strtotime($to_end) - $to_start;
        $end_time= date("Y-m-d H:i:s", $to_end);
        mysqli_query($conn, "INSERT INTO results (user_id, exam_id, start_time, end_time, score, total) VALUES ('$user_id', '$eid', '$start_time', '$end_time', 0, '$tq')");
        }
        else{
        $start_time= strtotime($query_res["start_time"]);
        $end_time = strtotime($query_res["end_time"]);
        $duration= $end_time- $start_time;
        }




        foreach($_SESSION["results_data"] as $row){
            $correct= $row["correct_answer"]; $select= $row["selected_answer"]; 
            // colour scheme for correct and wrong answers
                                
            if($correct==="A" && $select==="A"){$class_a= 'bg-success text-light'; $class_b=''; $class_c=''; $class_d='';}
            elseif($correct==="A" && $select==="B"){$class_a= 'bg-success text-light'; $class_b='bg-danger text-light'; $class_c=''; $class_d='';}
            elseif($correct==="A" && $select==="C"){$class_a= 'bg-success text-light'; $class_b=''; $class_c='bg_danger'; $class_d='';}
            elseif($correct==="A" && $select==="D"){$class_a= 'bg-success text-light'; $class_b=''; $class_c=''; $class_d='bg-danger text-light';}
            elseif($correct==="B" && $select==="B"){$class_a=''; $class_b= 'bg-success text-light'; $class_c=''; $class_d='';}
            elseif($correct==="B" && $select==="A"){$class_a= 'bg-danger text-light'; $class_b='bg-success text-light'; $class_c=''; $class_d='';}
            elseif($correct==="B" && $select==="C"){$class_a= ''; $class_b='bg-success text-light'; $class_c='bg-danger text-light'; $class_d='';}
            elseif($correct==="B" && $select==="D"){$class_a= ''; $class_b='bg-success text-light'; $class_c=''; $class_d='bg-danger text-light';}
            elseif($correct==="C" && $select==="C"){$class_a=''; $class_b=''; $class_c= 'bg-success text-light'; $class_d='';}
            elseif($correct==="C" && $select==="A"){$class_a='bg-danger text-light'; $class_b=''; $class_c= 'bg-success text-light'; $class_d='';}
            elseif($correct==="C" && $select==="B"){$class_a=''; $class_b='bg-danger text-light'; $class_c= 'bg-success text-light'; $class_d='';}
            elseif($correct==="C" && $select==="D"){$class_a=''; $class_b=''; $class_c= 'bg-success text-light'; $class_d='bg-danger text-light';}
            elseif($correct==="D" && $select==="D"){$class_a=''; $class_b=''; $class_c= ''; $class_d='bg-success text-light';}
            elseif($correct==="D" && $select==="A"){$class_a='bg-danger text-light'; $class_b=''; $class_c= ''; $class_d='bg-success text-light';}
            elseif($correct==="D" && $select==="B"){$class_a=''; $class_b='bg-danger text-light'; $class_c= ''; $class_d='bg-success text-light';}
            else{$class_a=''; $class_b=''; $class_c= 'bg-danger text-light'; $class_d='bg-success text-light';}

            $analysis= "<div class='row'>
                        <div class='col'>" .$row["quest_num"]. "</col>";
                        
            $analysis.= "<div class='col'>". $row["question"]. "<p><ul class='p-0 m-0'>";
            $analysis.= "<li>".$row["option_a"]. "</li><li>".$row["option_b"]. "</li><li>" .$row["option_c"]. "</li><li>" .$row["option_d"]. "</li></ul></p></div>";          
            
            echo $analysis;






    //Get Last Question number
    $sql="SELECT MAX(quest_num) AS last_qn FROM questions WHERE exam_id= '$eid'";
    $result= mysqli_query($conn, $sql);
    $quest_row= mysqli_fetch_assoc($result);
        if($quest_row["last_qn"]===null){
            $quest_num= 1;
        }
        else{
            $quest_num= $quest_row["last_qn"] + 1;
        }
        
    //Get Exam details
    $sql="SELECT * FROM exams where exam_id= '$eid'";
    $query=mysqli_query($conn, $sql);
        if($query && mysqli_num_rows($query) >0){
            $row= mysqli_fetch_assoc($query);
            $sub =$row["subjects"];
            $num= $row["num_quest"];
            $_SESSION["quest_data"]["subject"]= $sub;
            $_SESSION["quest_data"]["num"]= $num;
        
        }
        else{
            die("Query failed due to". mysqli_error());
        }
} 

}
?>

<style>
.form-label{
    font-weight:bold; margin-top:5px; margin-bottom:5px;
}
</style>
<body>

    <?php
        //Get the last question number
   $sub=$_SESSION["quest_data"]["subject"];
    $eid=$_SESSION["quest_data"]["eid"];    
    $sql="SELECT MAX(quest_num) AS last_qn FROM questions WHERE exam_id= '$eid'";
    $result= mysqli_query($conn, $sql);
    $quest_row= mysqli_fetch_assoc($result);
        if($quest_row["last_qn"]===null){
            $quest_num= 1; 

        }
        else{
            $quest_num= $quest_row["last_qn"] + 1;
        }
    $snum= $_SESSION["quest_data"]["num"];
    if(isset($_GET["st"])){
            if($_GET["res"]=="success"){
                $message= "<p class='p-2 text-success fw-bolder'> Question added Successfully </p>";
            }
            elseif($_GET["st"==="fail"]){
                $message="<p class='p-2 text-danger  fw-bolder'> Question submission failed </p>";
            }
        } else {
            $message="";
        }
       
        if($quest_num>$snum){
            $qd= "UPDATE exams SET status= 'ready' WHERE exam_id='$eid'";
            mysqli_query($conn, $qd);
            $message="<script>alert('You have reached the Limit of $num Questions'); window.location.href='../questions/success.php';</script>";
        }
    ?>
    <div class="container">
        <div class="row rounded-3 p-3">
            <div class="container">
                <div class="row bg-light mt-3 rounded-3 py-3">
                    <div class="col-lg-7 p-1">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12 p-2">
                                    <h5 class="p-1"> <?=$sub?> </h5>
                                    <h5 class="p-1"> <?=$message?> </h5>
                                    <p><a class='btn btn-secondary btn-lg' href='../staff/index.php'>Close Page</a></p>
                                </div>
                                <form action="questions.php" method="post" id="myform">
                                <div class="col-lg-12 p-2">
                                    <h5 class="p-1">Question <?=$quest_num?>  of <?=$snum?> </h5>
                                </div>
                            </div>
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
                                    <label class="form-label p-2">Select Answer</label>
                                    <select name="correct_answer" class="form-select">
                                        <option value="A">Option A</option>
                                        <option value="B">Option B</option>
                                        <option value="C">Option C</option>
                                        <option value="D">Option D</option>
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
                    <div class="col-lg-5 p-2">
                       
                        <?php
                            for($i=1; $i<= $snum; $i++){
                                if($i==$quest_num){
                                    echo "<a class='btn btn-warning mx-3 my-3 rounded-circle'  href=sample.php?q=$i>" .$i . "</a>";
                                }
                                elseif($i < $quest_num){
                                    echo "<a class='btn btn-secondary mx-3 my-3 rounded-circle'  href=sample.php?q=$i>" .$i . "</a>";
                                }
                                else{
                                    echo "<a class='btn btn-light mx-3 my-3 rounded-circle'  href=sample.php?q=$i>" .$i . "</a>";
                                }
                             }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>




                    

<style>
ul{
    list-style-type:none;
}
#navheader{
    background-color:#333;
    margin-bottom:83px;
}

#navheader .brand img{
   height:60px;
   width:60px;
}
#navheader .brand span, #navheader .brand span i{
    color:#fff;
}

#navheader .nav-links{
    overflow-x:auto;
    white-space: nowrap;
}

.cat{
    overflow-x:auto;
    white-space: nowrap;
}




#navheader .nav-links ul{
display:flex;
flex-direction: row;
flex-wrap: nowrap;
list-style-type: none;
}
   
#navheader .nav-links ul li{
    list-style-type:none;
    display:inline-block;
    margin:15px;
    olor:#fff !important;
}
  
#navheader .nav-links ul li a {
    text-decoration: none;
    display:block;
    padding:10px;
  color:#ffffff !important;
}
 #main{

    background-image: url("assets/img/banner.png");
    background-position:center;
    background-repeat: no-repeat;
    background-size: cover;
}

/*Small screen*/
@media (max-width: 991.98px){
#main{
    display:block;
}

#navheader{
   /* height:53px;    */
}

#navheader .brand img{
    height:50px;
    width:50px;
}

#navheader .brand{
    background-color:#fff;
    padding-left:1.2em;
    padding-right:1.2em;
}    
 
#navheader .brand span{
    color:#333;
    font-size:17px;
    font-stretch:expanded;
}
 
#navheader .nav-links{
    background-color:#000;
    display:none;
    color:#f8f9fa;
    padding-left:1.2em;
    padding-right:1.2em;
}

#navheader .nav-links .ul li a{
    text-decoration:none;
    color:#fff;
    display:block;
}
.cat{
     background-color:#000;
     color:#f8f9fa;
}

}

