<?php
    $email=$_POST['u_email'];
    $name=$_POST['u_name'];
    include "../includes/mysql_connect.php";
    $conn=connect_mysql();
    $conn->query("INSERT INTO `subscribe`(`name`, `email`) VALUES ( '".$name."' , '".$email."')");
    $t=$_GET['url'];
    $url= str_replace("/course-brothers-master",".",$t);
    header ("Location: .".$url);
?>