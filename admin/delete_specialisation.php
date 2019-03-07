<?php 
$id=$_POST['id'];

include "./includes/mysql_connect.php";

$conn_p=connect_mysql_page();
if($conn_p->query("DELETE FROM `subject` WHERE id=".$id)){
    echo "1";
}else{
    echo "0";
}


?>