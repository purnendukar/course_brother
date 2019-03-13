<?php 

include "./includes/mysql_connect.php";
$conn=connect_mysql_page();

$id=$_POST['id'];

if($conn->query("DELETE FROM `testimonial` WHERE id=".$id)){
    echo "1";
    $admin=connect_mysql();
    $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','testimonial deleted')");
}else{
    echo "0";
}

?>