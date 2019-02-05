<?php 
include "./includes/mysql_connect.php";
$conn=connect_mysql_page();
$id=$_POST['id'];
$aff=$_POST['aff'];
$fees=$_POST['fees'];
$duration=$_POST['duration'];
$desc=$_POST['description'];
$sem_struc=$_POST['sem_struc'];
$fees_struc=$_POST['fees_struc'];
if($conn->query("UPDATE `full_detail` SET `fees`=".$fees.",`duration`=".$duration.",`a_id`='".$aff."' WHERE id=".$id)){
    $sem_struc= preg_replace("/[\n\r]/",'<br>',$sem_struc);
    if($conn->query("UPDATE `about_course` SET `overview`='".$desc."', `structure`='".$sem_struc."' where id=".$id)){
        if($conn->query("UPDATE `fee_structure` SET `structure`='".$fees_struc."' WHERE id=".$id)){
            echo"1";
        }
    }
}else{
    echo "0";
}
?>