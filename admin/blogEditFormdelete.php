<?php 
$id=$_POST['ind'];
include "./includes/mysql_connect.php";
$conn=connect_mysql_page();
$admin=connect_mysql();
$admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','added speicalisation ".$conn->query("select * from blogs where id=".$id)->fetch_assoc()['heading']."')");
if($conn->query("DELETE FROM `blogs` WHERE id=".$id)){
    echo "1";
}else{
    echo "0";
}
?>