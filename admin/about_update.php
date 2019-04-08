<?php

include "./includes/mysql_connect.php";
$conn=connect_mysql_page();

$content=urlencode($_POST['content']);

if($conn->query("UPDATE `about` SET `content`='".$content."',head='".$_POST['head']."' WHERE id=1")){
    echo "1";
    $admin=connect_mysql();
    $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','updated about section about page')");
}else{
    echo "0";
}
?>