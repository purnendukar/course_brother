<?php
    include "../../includes/mysql_connect.php";
    $conn=connect_mysql();
    if($conn->query("UPDATE `user_info` SET `experience`='".$_POST['exp']."' WHERE email='".urldecode($_COOKIE['email'])."'")){
        echo "1";
    }else{
        echo "0";
    }
?>
