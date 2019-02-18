<?php
    include "../../includes/mysql_connect.php";
    $conn=connect_mysql();
    $about=$_POST['about'];
    $id=$_POST['id'];
    if($conn->query("UPDATE `user_education` SET `about`='".$about."', `join_year`='".$_POST['join_']."', `complete_year`='".$_POST['complete_']."', `degree`='".$_POST['degree']."', `organisation`='".$_POST['univ']."' WHERE id=".$id)){
        echo "1";
    }else{
        echo "0";
    }
?>