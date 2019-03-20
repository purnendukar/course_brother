<?php 
$id=$_POST['u_id'];

include "./mysql_connect.php";
$conn_p=connect_mysql_page();

$admin=connect_mysql();
$admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','deleted university ".$conn_p->query("SELECT * FROM `universities` WHERE u_id=".$id)->fetch_assoc()['u_name']."')");

$i=$conn_p->query("SELECT * FROM `universities` WHERE u_id=".$id)->fetch_assoc();
if(rmdir("../../".strtolower($i['u_name'])));
if(unlink("../.".$i['img_src']));
if($conn_p->query("DELETE FROM `universities` WHERE u_id=".$id)){
    echo "1";
    $conn->query("DELETE FROM `full_detail` WHERE u_id=".$id);
}else{
    echo "0";
}

?>