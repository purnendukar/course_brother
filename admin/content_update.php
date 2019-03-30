<?php 
include "./includes/mysql_connect.php";
$conn=connect_mysql_page();
$str="";
if(isset($_POST['content'])){
    $str=$_POST['content'];
}
if($conn->query("UPDATE `head_update` SET `head`='".$_POST['head']."',content='".$str."' WHERE id=".$_POST['id'])){
    echo "1";
}else{
    echo "0";
}
?>