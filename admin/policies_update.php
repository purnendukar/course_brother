<?php

include "./includes/mysql_connect.php";
$conn=connect_mysql_page();

$id=$_POST['id'];
$content=urlencode($_POST['content']);
$t=['shipping policy','refund policy','disclaimer','term & condition','privacy policy','legal policy'];
if($conn->query("UPDATE `policies` SET `content`='".$content."' WHERE id=".$id)){
    echo "1";
    $admin=connect_mysql();
    $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','update on ".$t[$id-1]."')");
}else{
    echo "0";
}
?>