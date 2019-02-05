<?php 
$id=$_POST['ind'];
include "./includes/mysql_connect.php";
$conn=connect_mysql_page();
if($conn->query("DELETE FROM `full_detail` WHERE id=".$id)){
    if($conn->query("DELETE FROM `about_course` WHERE id=".$id)){
        if($conn->query("DELETE FROM `fee_structure` WHERE id=".$id)){
            echo"1";
        }
    }
}else{
    echo "0";
}
?>