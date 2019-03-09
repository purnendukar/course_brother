<?php
include "./includes/mysql_connect.php";
$id=$_POST['id'];
$uname=$_POST['uname'];
$fname=$_POST['fname'];
$email=$_POST['email'];
$city=$_POST['city'];
$addr=$_POST['addr'];
$phn_no=$_POST['phn_no'];
$pages=$_POST['pages'];
$pass=$_POST['pass'];

$conn=connect_mysql();
if($conn->query("select * from user where u_name='".$uname."' and id!=".$id)->fetch_assoc()){
    echo "Username already used";
}
else if($conn->query("UPDATE `user` SET `email`='".$email."',`u_name`='".$uname."',`f_name`='".$fname."',`password`='".$pass."',`access`='".$pages."',`city`='".$city."',`phn_no`='".$phn_no."',`address`='".$addr."' WHERE id=".$id)){
    echo "1";
}
?>