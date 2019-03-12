<?php
include "./includes/mysql_connect.php";
$uname=$_POST['uname'];
$fname=$_POST['fname'];
$email=$_POST['email'];
$city=$_POST['city'];
$addr=$_POST['addr'];
$phn_no=$_POST['phn_no'];
$pages=$_POST['pages'];
$pass=$_POST['pass'];

$conn=connect_mysql();
if($conn->query("select * from user where u_name='".$uname."' ")->fetch_assoc()){
    echo "Username already used";
}
else if($conn->query("INSERT INTO `user`(`email`, `u_name`, `f_name`, `password`, `access`, `city`, `phn_no`, `address`) VALUES ( '".$email."','".$uname."','".$fname."','".$pass."','".$pages."','".$city."','".$phn_no."','".$addr."' )")){
    echo "1";
}
?>