<?php 

include "./includes/mysql_connect.php";
$conn=connect_mysql_page();

$id=$_POST['id'];

$admin=connect_mysql();
$admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','delete on team ".$conn->query("select * from team where id=".$id)->fetch_assoc()['name']."')");
if($conn->query("DELETE FROM `team` WHERE id=".$id)){
    echo "1";
}else{
    echo "0";
}

?>