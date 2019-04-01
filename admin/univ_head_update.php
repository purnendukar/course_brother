<?php 
include "./includes/mysql_connect.php";
$conn=connect_mysql_page();
$t=$_POST['head'];
if($conn->query("UPDATE `head_content` SET `head`='".$t."' WHERE id=".$_POST['id'])){
    echo "1";
}else{
    echo "0";
}
?>