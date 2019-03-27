<?php

include "./includes/mysql_connect.php";
$conn=connect_mysql_page();


if(($conn->query("UPDATE `student_popup` SET `stud_name`='".$_POST['stud']."',`city`='".$_POST['city']."' WHERE id=1"))){
    echo "1";
    $admin=connect_mysql();
    $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','updated student pop up')");
}else{
    echo "0";
}
?>