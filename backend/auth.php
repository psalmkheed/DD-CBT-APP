<?php
include("db.php");
if(!empty($_POST["login"])){
$username= filter_var($_POST["username"]);
$password= filter_var($_POST["password"]);
    if(empty($username) || empty($password)){
        $res="All fields are required";
    }
    else{
    $stmt= "SELECT * FROM users WHERE user_id='$username' && auth_code='$password'";
    $query= mysqli_query($conn, $stmt);
    $num= mysqli_num_rows($query);
    if($num>0){
        $row_data= mysqli_fetch_assoc($query);
        session_start();
        $_SESSION["user"]= $row_data;
        $role= $_SESSION["user"]['user_role'];

            switch ($role) {
                case 'student':
                    $res = 'student';
                    break;

                case 'admin':
                    $res = 'admin';
                    break;

                case 'staff':
                    $res = 'staff';
                    break;

                default:
                    "You're not permitted here";
                    break;
            }
        }
        else{
            $res= "Incorrect login credentials";
        }
       
    }
}
echo $res;
