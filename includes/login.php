<?php

include "./mysql_connect.php";

$conn=connect_mysql();

$pass=$_POST['pass'];
$email=$_POST['email'];

if($conn->query("select * from register_user where email='".$email."' and pass='".$pass."'")->fetch_assoc()){
    echo "1";
}else{
    echo "Incorrect Email-id or Password";
}

?>