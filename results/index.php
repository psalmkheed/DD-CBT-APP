<?php
include("header.php");
include_once("../admin/db.php");
session_start();
if(!isset($_SESSION["user"])){
    header("Location:../index.php");
    exit;
}

else{
if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"]=="GET"){
$eid= $_GET["eid"];
if(isset($_GET["r"])){ 
    if($_GET["r"]=="admin"){
           // $eid= $_GET["eid"];
            $sql= "SELECT * FROM results WHERE exam_id='$eid'";
            $query= mysqli_query($conn, $sql) or die(mysqli_error($conn));
            if(mysqli_num_rows($query) > 0){
                $result= mysqli_fetch_all($query, MYSQLI_ASSOC);
                $table="<table class='table w-75'><tr><th>Names</th><th>Student ID</th><th>Scores</th><th>Action</th></tr>";
                foreach($result as $res){
                $user_id= $res["user_id"];
                $names= getUser($conn, $user_id);
                $table.="<tr><td>". $names. "</td><td>". strtoupper($res["user_id"]). "</td><td>". $res["score"]."/". $res["total"]. "</td><td><a class='btn btn-warning' href='../results/del_result.php?eid=".$eid."&uid=".$user_id."'>clear</a></td></tr>";
                }
                echo $table;
            }
            else{
                echo "<h2>Results not available at the moment</h2>";
            }

    }
elseif($_GET["r"]=="staff"){
        $sql= "SELECT * FROM results WHERE exam_id='$eid'";
        $query= mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if(mysqli_num_rows($query) > 0){
            $result= mysqli_fetch_all($query, MYSQLI_ASSOC);
            $table="<table class='table w-50'><tr><th>Student ID</th><th>Names</th><th>Scores</th></tr>";
            foreach($result as $res){
                $user_id= $res["user_id"];
                $names= getUser($conn, $user_id);
                $table.="<tr><td>". $res["user_id"]. "</td><td>". $names. "</td><td>". $res["score"]. "</td><td></td></tr>";
            }
                echo $table;
            }
        else{
            echo "<h2>Results not available at the moment</h2>";
            }
    }
    
    
}
}
}
?>