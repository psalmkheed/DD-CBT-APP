<?php
if(isset($_SESSION["user"]) && $_SESSION["user"]["user_role"]==="staff"){
    echo $_SESSION["user"]["user_role"];
}
else{

}

?>