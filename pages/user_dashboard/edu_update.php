<?php
    include "../../includes/mysql_connect.php";
    $conn=connect_mysql();
    $about=$_POST['about'];
    $id=$_POST['id'];
    if($conn->query("UPDATE `user_education` SET `about`='".urlencode($about)."', `join_year`='".urlencode($_POST['join_'])."', `complete_year`='".urlencode($_POST['complete_'])."', `degree`='".urlencode($_POST['degree'])."', `organisation`='".urlencode($_POST['univ'])."' WHERE id=".$id)){
        echo "1";
    }else{
        echo "0";
    }
?>