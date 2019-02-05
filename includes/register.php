<?php

include "./mysql_connect.php";

$conn=connect_mysql();

$pass=$_POST['pass'];
$f_name=$_POST['f_name'];
$l_name=$_POST['l_name'];
$city=$_POST['city'];
$phn_no=$_POST['phn_no'];
$email=$_POST['email'];

if($conn->query("select * from register_user where email='".$email."'")->fetch_assoc()){
    echo "Email Id Already Used";
}else{
    if($conn->query("INSERT INTO `register_user`(`f_name`, `l_name`, `city`, `phn_no`, `email`, `pass`) VALUES ('".$f_name."','".$l_name."','".$city."','".$phn_no."','".$email."','".$pass."')")){
        echo "1";
    }else{
        echo "Something Went Wrong";
    }
}

?>