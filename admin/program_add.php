<?php 
include "./includes/mysql_connect.php";
$conn_p=connect_mysql_page();
if(isset($_POST['p_name'])){
	$admin=connect_mysql();
	$res=$conn_p->query("INSERT INTO `program`(`program`,`update_by`) VALUES ('".$_POST['p_name']."','".$admin->query("select * from user where id=".$_COOKIE['user_id'])->fetch_assoc()['u_name']."')");
	if($res){
    $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','added program ".$_POST['p_name']."')");
		echo "1";
	}else{
		echo "0";
	}
}
?>
