<?php 

include "./includes/mysql_connect.php";

$conn_p=connect_mysql_page();
$admin=connect_mysql();

if(isset($_POST['id'])){
    $id=$_POST['id'];
    if($conn_p->query("DELETE FROM `courses` WHERE id=".$id) && $conn_p->query("DELETE FROM `full_detail` WHERE c_id=".$id)){
        echo "1";
    }else{
        echo "0";
    }
}else{
    $ids=explode(",",$_POST['ids']);
    $c=0;
    for($i=0;$i<count($ids);$i++){
        if($conn_p->query("DELETE FROM `courses` WHERE id=".$ids[$i])){
            $conn_p->query("DELETE FROM `full_detail` WHERE c_id=".$ids[$i]);
            $c++;
        }
    }
    if($c==count($ids)){
        echo "1";
    }else{
        echo "0";
    }
}

?>