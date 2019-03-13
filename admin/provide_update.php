<?php

include "./includes/mysql_connect.php";
$conn=connect_mysql_page();
for($i=0;$i<4;$i++){
    if($conn->query("UPDATE `provide` SET `content`='".urlencode($_POST['provide'.$i])."' WHERE id=".($i+1))){
        echo "1";
        $admin=connect_mysql();
        $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','updated provide you about page')");
    }else{
        echo "0";
    }
}
?>