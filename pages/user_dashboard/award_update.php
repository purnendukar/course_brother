<?php
    include "../../includes/mysql_connect.php";
    $conn=connect_mysql();
    $about=$_POST['about'];
    $id=$_POST['id'];
    if($conn->query("UPDATE `user_award` SET `about`='".urlencode($about)."', `award_date`='".urlencode($_POST['date_'])."', `award`='".urlencode($_POST['award_'])."' WHERE id=".$id)){
        echo "1";
    }else{
        echo "0";
    }
?>
