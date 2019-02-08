<?php

include "./includes/mysql_connect.php";
$conn=connect_mysql_page();

$id=$_POST['id'];
$content=urlencode($_POST['content']);

if($conn->query("UPDATE `policies` SET `content`='".$content."' WHERE id=".$id)){
    echo "1";
}else{
    echo "0";
}
?>