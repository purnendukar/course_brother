<?php
    include "../../includes/mysql_connect.php";
    $conn=connect_mysql();
    if($conn->query("UPDATE `register_user` SET `f_name`='".urlencode($_POST['f_name'])."',`l_name`='".urlencode($_POST['l_name'])."' WHERE email='".urldecode($_COOKIE['email'])."'")){
        echo "1";
    }else{
        echo "0";
    }
?>
