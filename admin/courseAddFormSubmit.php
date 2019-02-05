<?php
include "./includes/mysql_connect.php";
$conn=connect_mysql_page();
$u_id=$_POST['u_id'];
$s_id=$_POST['s_id'];
$aff=$_POST['aff'];
$c_id=$_POST['c_id'];
$prg_id=$_POST['prg_id'];
$fees=$_POST['fees'];
$duration=$_POST['duration'];
$desc=$_POST['description'];
$sem_struc=$_POST['sem_struc'];
$d_id=$_POST['d_mode_id'];
$fees_struc=$_POST['fees_struc'];
if($conn->query("INSERT INTO `full_detail`(`prg_id`, `c_id`, `u_id`, `s_id`, `fees`, `duration`, `a_id`,  `d_mode_id`) VALUES (".$prg_id.",".$c_id.",".$u_id.",".$s_id.",".$fees.",".$duration.",'".$aff."',".$d_id.")")){
    $id=$conn->insert_id;
    $sem_struc= preg_replace("/[\n\r]/",'<br>',$sem_struc);
    if($conn->query("INSERT INTO `about_course`( id , `overview`, `structure`) VALUES (".$id.",'".$desc."','".$sem_struc."')")){
        if($conn->query("INSERT INTO `fee_structure`(`id`, `structure`) VALUES (".$id.",'".$fees_struc."')")){
            echo"1";
        }
    }
}else{
    echo "0";
}

?>