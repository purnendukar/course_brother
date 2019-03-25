<?php 

include "./includes/mysql_connect.php";
$conn=connect_mysql_page();

$id=$_POST['id'];

if(isset($_POST['p_name'])){
    $p_name=mysqli_real_escape_string($conn, $_POST['p_name']);

    if($conn->query("UPDATE `program` SET `program`='".$p_name."' WHERE p_id=".$id)){
        echo "1";
        $admin=connect_mysql();
        $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','update program of id=".$id."')");
    }else{
        echo "0";
    }
}
 

?>