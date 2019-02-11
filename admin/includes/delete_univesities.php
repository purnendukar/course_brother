<?php 
$id=$_POST['u_id'];

include "./mysql_connect.php";

$conn_p=connect_mysql_page();
$i=$conn_p->query("SELECT * FROM `universities` WHERE u_id=".$id)->fetch_assoc();
rmdir("../../".$i['u_name']);
unlink("../.".$i['img_src']);
if($conn_p->query("DELETE FROM `universities` WHERE u_id=".$id)){
    echo "1";
}else{
    echo "0";
}


?>