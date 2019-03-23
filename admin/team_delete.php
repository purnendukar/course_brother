<?php 

include "./includes/mysql_connect.php";
$conn=connect_mysql_page();
$admin=connect_mysql();

if(isset($_POST['id'])){
    $id=$_POST['id'];
    $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','delete on team ".$conn->query("select * from team where id=".$id)->fetch_assoc()['name']."')");
    if($conn->query("DELETE FROM `team` WHERE id=".$id)){
        echo "1";
    }else{
        echo "0";
    }
}else{
    $ids=explode(",",$_POST['ids']);
    $c++;
    for($i=0;$i<count($ids);$i++){
        if($conn->query("DELETE FROM `team` WHERE id=".$ids[$i])){
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