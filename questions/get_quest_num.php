<?php
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
     
?>