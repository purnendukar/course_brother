<?php 

include "./includes/mysql_connect.php";
$conn=connect_mysql_page();

$id=$_POST['id'];

if($conn->query("DELETE FROM `testimonial` WHERE id=".$id)){
    echo "1";
}else{
    echo "0";
}

?>