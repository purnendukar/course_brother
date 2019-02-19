<?php
    include "../../includes/mysql_connect.php";
    $conn=connect_mysql();
    $about=$_POST['about'];
    if($conn->query("INSERT INTO `user_work_exp` (`email`, `company_name`, `position`, `about_work`, `start_date`, `end_date`) VALUES ('".urldecode($_COOKIE['email'])."','".urlencode($_POST['company'])."','".urlencode($_POST['position'])."','".urlencode($_POST['about'])."','".urlencode($_POST['start_'])."','".urlencode($_POST['end_'])."')")){
        echo "success".$conn->insert_id;
    }else{
        echo "0";
    }
?>