<?php

include "./includes/mysql_connect.php";
$conn=connect_mysql_page();

$id=$_POST['id'];
$status=$_POST['status'];

if(($conn->query("UPDATE `admission_report` SET `status`='".$status."' WHERE a_id=".$id))){
    echo "1";
}else{
    echo "0";
}
?>