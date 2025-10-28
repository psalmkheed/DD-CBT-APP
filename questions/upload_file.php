<?php
include("../admin/db.php");
if(isset($_FILES)){
$eid= $_POST["eid"];
$uploaded_file= basename($_FILES["uploads"]["name"]);
$temp_name= $_FILES["uploads"]["tmp_name"];
//$allowed_ext=array("jpeg", "jpg", "png", "PNG", "JPG", "xlsx", "csv");
$file_type= pathinfo($uploaded_file, PATHINFO_EXTENSION);
$dir= "exam_files/".$uploaded_file;


if(move_uploaded_file($temp_name, $dir)){
    $query= mysqli_query($conn, "INSERT INTO exam_files (exam_id, dir) VALUES ('$eid', '$dir')");
    if($query){
        echo "success";
    }
    else{
        die("Upload Failed". mysqli_error($conn));
    }
}
}
//else{

//}
?>