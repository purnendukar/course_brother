<?php
$s=$_POST['id'];

include "../includes/mysql_connect.php";
$conn=connect_mysql();

if($res=$conn->query("select * from full_detail where id=".$s)){
    $row=$res->fetch_assoc();
    echo $row['prg_id']."`".$row['c_id']."`".$row['s_id']."`".$row['u_id']."`".$row['d_mode_id'];
}

?>