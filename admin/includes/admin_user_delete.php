<?php

$id=$_POST['id'];

include "./mysql_connect.php";

$conn=connect_mysql();

if($conn->query("delete from user where id=".$id)){
    echo "1";
}else{
    echo "0";
}

?>