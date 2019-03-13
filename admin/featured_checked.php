<?php
include "./includes/mysql_connect.php";
$conn=connect_mysql_page();

if($conn->query("UPDATE featured_courses SET checked='".$_POST['check']."' WHERE id=".$_POST['id'])){
    echo "1";
    $admin=connect_mysql();
    $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','changes on featured courses')");
}else{
    echo "0";
}

?>