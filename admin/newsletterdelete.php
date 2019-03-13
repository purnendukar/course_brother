<?php 

include "./includes/mysql_connect.php";
$conn=connect_mysql_page();

$id=$_POST['id'];

if($conn->query("DELETE FROM `news_update` WHERE id=".$id)){
    echo "1";
    $admin=connect_mysql();
    $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','deleted newsletter of ".$conn->query("select * from universities where u_id=".$u_id)->fetch_assoc()['u_name']." ')");
}else{
    echo "0";
}

?>