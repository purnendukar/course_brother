<?php

include "./mysql_connect.php";

$id=$_POST['id'];
$u_name=$_POST['u_name'];
$email=$_POST['email'];
$f_name=$_POST['f_name'];
$phn_no=$_POST['phn_no'];
$city=$_POST['city'];

$conn=connect_mysql();
$email_exist=$conn->query("select * from user where email='".$email."' and id!=".$id);
$t=true;
while($row=$email_exist->fetch_assoc()){
    $t=false;
    echo "Email id already used";
}
$u_name_exist=$conn->query("select * from user where u_name='".$u_name."' and id!=".$id);
while($row=$u_name_exist->fetch_assoc()){
    $t=false;
    echo "Username already used";
}

if($t){
    try{$conn->query("UPDATE `user` SET `email`='".$email."',`u_name`='".$u_name."',`f_name`='".$f_name."',`type`='".$type."',`city`='".$city."',`phn_no`='".$phn_no."' WHERE id=".$id);
        echo "1";
    }catch(Exception $e){
        echo $e;
    }
}


?>