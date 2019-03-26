<?php 
include "./includes/mysql_connect.php";
$conn=connect_mysql_page();
$admin=connect_mysql();

$id=$_POST['id'];
if($conn->query("UPDATE `full_detail` SET `display`='".$_POST['display']."',`update_by`='".$admin->query("select * from user where id=".$_COOKIE['user_id'])->fetch_assoc()['u_name']."' WHERE id=".$id)){
    $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','course updated id=".$id."')");
    echo "1";
}else{
    echo "0";
}
?>