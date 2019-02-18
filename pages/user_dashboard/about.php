<?php
    include "../../includes/mysql_connect.php";
    $conn=connect_mysql();
    $about=$_POST['about'];
    $id=$_POST['id'];
    if($conn->query("UPDATE `user_info` SET `about`='".$about."' WHERE id=".$id)){
        echo "1";
    }else{
        echo "0";
    }
?>