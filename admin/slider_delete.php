<?php 

include "./includes/mysql_connect.php";
$conn=connect_mysql_page();

$id=$_POST['id'];

if($conn->query("DELETE FROM `slide_show` WHERE id=".$id)){
    $admin=connect_mysql();
    $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','slide deleted from slider')");

    echo "1";
}else{
    echo "0";
}

?>