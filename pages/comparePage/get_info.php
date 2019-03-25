<?php
$id=$_POST['id'];
include "../../includes/mysql_connect.php";
$conn=connect_mysql();
$str="";
if($row=$conn->query("select * from full_detail where id=".$id)->fetch_assoc()){
    $str.=$conn->query("select * from universities where u_id=".$row['u_id'])->fetch_assoc()['img_src']."`";
    $str.=$conn->query("select * from courses where id=".$row['c_id'])->fetch_assoc()['c_name']."`";
    $str.=$conn->query("select * from universities where u_id=".$row['u_id'])->fetch_assoc()['u_name']."`";
    $str.=$conn->query("select * from subject where id=".$row['s_id'])->fetch_assoc()['sub_name']."`";
    $str.=urldecode($row['meta_desc'])."`";
    $str.=$row['duration']."`";
    $str.=$row['fees']."`";
    $str.=$conn->query("select * from delivery_mode where id=".$row['d_mode_id'])->fetch_assoc()['d_mode'];
    echo $str;
}else{

}
?>
