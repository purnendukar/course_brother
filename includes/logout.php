<?php 
    setcookie("email",$_COOKIE['email'],time()-43200,"/");
    header("Location:../");
?>