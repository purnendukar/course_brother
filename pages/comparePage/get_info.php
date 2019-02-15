<?php 
$id=$_POST['id'];
include "../../includes/mysql_connect.php";
$conn=connect_mysql_page();
$str="";
if($row=$conn->query("select * from full_detail where id=".$id)->fetch_assoc()){
    $str.=$conn->query("select * from universities where u_id=".$row['u_id'])->fetch_assoc()['img_src']."`";
    $str.=$conn->query("select * from universities where u_id=".$row['u_id'])->fetch_assoc()['u_name']."`";
    $str.=$conn->query("select * from subject where id=".$row[s_id])->fetch_assoc()['sub_name']."`";
    $str.=$conn->query("SELECT * FROM `about_course` where id=".$row[id])->fetch_assoc()['sub_name']."`";
    
}else{

}
?>