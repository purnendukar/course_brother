<?php 
$id=$_POST['id'];

include "./includes/mysql_connect.php";

$conn_p=connect_mysql_page();

$admin=connect_mysql();
$admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','added speicalisation ".$conn->query("select * from subject where id=".$id)->fetch_assoc()['sub_name']."')");
if($conn_p->query("DELETE FROM `subject` WHERE id=".$id)){
    echo "1";
}else{
    echo "0";
}


?>