<?php
    include "../../includes/mysql_connect.php";
    $conn=connect_mysql();
    $about=$_POST['about'];
    if($conn->query("INSERT INTO `user_education`(`email`, `organisation`, `degree`, `join_year`, `complete_year`, `about`) VALUES ('".urldecode($_COOKIE['email'])."','".urlencode($_POST['univ_'])."','".urlencode($_POST['qual_'])."','".urlencode($_POST['join_'])."','".urlencode($_POST['end_'])."','".urlencode($about)."')")){
        echo "success".$conn->insert_id;
    }else{
        echo "0";
    }
?>