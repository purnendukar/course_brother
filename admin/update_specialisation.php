<?php
$s_id=$_POST['id'];

include "./includes/mysql_connect.php";

$conn_p=connect_mysql_page();

if(isset($_POST['s_name'])){
    $s_name=mysqli_real_escape_string($conn_p,strtoupper($_POST['s_name']));

    $sql="UPDATE `subject` SET `sub_name`='".$s_name."',`keyword`='".$s_name."' where id=".$s_id;
    if($conn_p->query($sql)){
        echo "1";
        
    $admin=connect_mysql();
    $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','updated speicalisation id=".$s_id."')");
    }
}
?>