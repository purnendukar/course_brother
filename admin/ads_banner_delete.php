<?php 

include "./includes/mysql_connect.php";
$conn=connect_mysql_page();
if(isset($_POST['ids'])){
    $c=0;
    $a=explode(",",$_POST['ids']);
    for($i=0;$i<count($a);$i++){
        if($conn->query("DELETE FROM `sponsor_course` WHERE id=".$a[$i])){
            $c++;
            $admin=connect_mysql();
            $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','ads banner deleted')");
        }else{
            echo "0";
        }
    }
    if($c==count($a)){
        echo "1";
    }else{
        echo "0";
    }
}else{
    $id=$_POST['id'];
        
    if($conn->query("DELETE FROM `sponsor_course` WHERE id=".$id)){
        echo "1";
        $admin=connect_mysql();
        $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','ads banner deleted')");
    }else{
        echo "0";
    }
}

?>