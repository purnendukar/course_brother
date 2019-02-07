<?php

include "./includes/mysql_connect.php";
$conn=connect_mysql_page();

$content=urlencode($_POST['content']);

if($conn->query("UPDATE `about` SET `content`='".$content."' WHERE id=1")){
    echo "1";
}else{
    echo "0";
}
?>