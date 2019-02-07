<?php 
$id=$_POST['ind'];
include "./includes/mysql_connect.php";
$conn=connect_mysql_page();
if($conn->query("DELETE FROM `blogs` WHERE id=".$id)){
    echo "1";
}else{
    echo "0";
}
?>