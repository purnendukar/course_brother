<?php
include "./includes/mysql_connect.php";
$conn=connect_mysql_page();

if($conn->query("UPDATE featured_courses SET checked='".$_POST['check']."' WHERE id=".$_POST['id'])){
    echo "1";
}else{
    echo "0";
}

?>