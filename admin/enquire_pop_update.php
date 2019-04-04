<?php

include "./includes/mysql_connect.php";
$conn=connect_mysql_page();

if(($conn->query("UPDATE `enquire_popup` SET `head`='".$_POST['head']."' WHERE id=1"))){
    echo "1";
    $admin=connect_mysql();
    $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','updated lead pop up')");
}else{
    echo "0";
}
?>