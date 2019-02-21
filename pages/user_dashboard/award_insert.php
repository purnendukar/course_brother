<?php
    include "../../includes/mysql_connect.php";
    $conn=connect_mysql();
    if($conn->query("INSERT INTO `user_award`(`email`, `award`, `about`, `award_date`) VALUES ('".urldecode($_COOKIE['email'])."','".urlencode($_POST['award_'])."','".urlencode($_POST['about'])."','".urlencode($_POST['date_'])."')")){
        echo "success".$conn->insert_id;
    }else{
        echo "0";
    }
?>
