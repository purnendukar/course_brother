<?php
    include "../../includes/mysql_connect.php";
    $conn=connect_mysql();
    $id=$_POST['id'];
    if($conn->query("DELETE FROM `user_education` WHERE id=".$id)){
        echo "1";
    }else{
        echo "0";
    }
?>