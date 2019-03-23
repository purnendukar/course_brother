<?php 

include "./mysql_connect.php";
$conn_p=connect_mysql_page();

$admin=connect_mysql();
if(isset($_POST['u_id'])){
    $id=$_POST['u_id'];
    $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','deleted university ".$conn_p->query("SELECT * FROM `universities` WHERE u_id=".$id)->fetch_assoc()['u_name']."')");

    $i=$conn_p->query("SELECT * FROM `universities` WHERE u_id=".$id)->fetch_assoc();
    if(rmdir("../../".strtolower($i['u_name'])));
    if($conn_p->query("DELETE FROM `universities` WHERE u_id=".$id)){
        echo "1";
        $conn_p->query("DELETE FROM `full_detail` WHERE u_id=".$id);
    }else{
        echo "0";
    }
}else{
    $ids=explode(",",$_POST['ids']);
    $c=0;
    for($i=0;$i<count($ids);$i++){
        $inni=$conn_p->query("SELECT * FROM `universities` WHERE u_id=".$ids[$i])->fetch_assoc();
        if(rmdir("../../".strtolower($inni['u_name'])));
        if($conn_p->query("DELETE FROM `universities` WHERE u_id=".$ids[$i])){
            $c++;
            if($conn_p->query("DELETE FROM `full_detail` WHERE u_id=".$ids[$i]));
        }
    }
    if($c==count($ids)){
        echo "1";
    }else{
        echo "0";
    }
}
?>