<?php
    include "../../includes/mysql_connect.php";
    $conn=connect_mysql();
    $id=$_POST['id'];
    if($conn->query("UPDATE `user_work_exp` SET `company_name`='".urlencode($_POST['company'])."',`position`='".urlencode($_POST['position'])."',`about_work`='".urlencode($_POST['about'])."',`start_date`='".$_POST['start_']."',`end_date`='".$_POST['end_']."' WHERE id=".$id)){
        echo "1";
    }else{
        echo "0";
    }
?>