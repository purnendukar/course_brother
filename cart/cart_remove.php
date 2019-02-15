<?php 
$id=$_POST['id'];
include '../includes/mysql_connect.php';
$conn=connect_mysql();
if($conn->query("delete from user_cart where id=".$id)){
    echo "1";
}else{
    echo "0";
}
?>