<?php 
$id=$_POST['id'];
include '../includes/mysql_connect.php';
$conn=connect_mysql();
if($row=$conn->query("select * from user_cart where id=".$id)->fetch_assoc()){
    if($conn->query("delete from admission_form where id=".$row['a_id']) && $conn->query("delete from 10th_education where a_id=".$row['a_id'])  && $conn->query("delete from 12th_education where a_id=".$row['a_id'])  && $conn->query("delete from graduation where a_id=".$row['a_id'])){
        if($conn->query(" delete from user_cart where id=".$id)){
            echo "1";
        }
    }
    echo "1";
}else{
    echo "0";
}
?>