<?php

include "./includes/mysql_connect.php";
$conn=connect_mysql_page();

$phn_no=$_POST['phn_no'];
$email=$_POST['email'];
$address=$_POST['address'];

if(($conn->query("UPDATE `contact_info` SET `info`='".$phn_no."' WHERE id=1"))&&($conn->query("UPDATE `contact_info` SET `info`='".$email."' WHERE id=2"))&&($conn->query("UPDATE `contact_info` SET `info`='".$address."' WHERE id=3"))){
    echo "1";
}else{
    echo "0";
}
?>