<?php 

include "./includes/mysql_connect.php";

$conn_p=connect_mysql_page();
$admin=connect_mysql();

if(isset($_POST['id'])){
    $id=$_POST['id'];

    $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','added speicalisation ".$conn_p->query("select * from subject where id=".$id)->fetch_assoc()['sub_name']."')");
    if($conn_p->query("DELETE FROM `subject` WHERE id=".$id)){
        echo "1";
    }else{
        echo "0";
    }
}else{
    $ids=explode(",",$_POST['ids']);
    $c=0;
    for($i=0;$i<count($ids);$i++){
        $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','added speicalisation ".$conn_p->query("select * from subject where id=".$ids[$i])->fetch_assoc()['sub_name']."')");
        if($conn_p->query("DELETE FROM `subject` WHERE id=".$ids[$i]))
        $c++;
    }
    if($c==count($ids)){
        echo "1";
    }else{
        echo "0";
    }
}

?>