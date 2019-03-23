<?php 

include "./includes/mysql_connect.php";
$conn=connect_mysql_page();
$admin=connect_mysql();

if(isset($_POST['id'])){
    $id=$_POST['id'];
    if($conn->query("DELETE FROM `news_update` WHERE id=".$id)){
        echo "1";
        $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','deleted newsletter of ".$conn->query("select * from universities where u_id=".$u_id)->fetch_assoc()['u_name']." ')");
    }else{
        echo "0";
    }
}else{
    $ids=explode(",",$_POST['ids']);
    $co=0;
    for($i=0;$i<count($ids);$i++){
        echo $ids[$i];
        if($conn->query("DELETE FROM `news_update` WHERE id=".$ids[$i])){
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