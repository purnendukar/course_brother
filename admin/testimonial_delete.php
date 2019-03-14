<?php 

include "./includes/mysql_connect.php";
$conn=connect_mysql_page();
if(isset($_POST['ids'])){
    $a=explode(",",$_POST['ids']);
    for($i=0;$i<count($a);$i++){
        if(unlink(".".$conn->query("select * from testimonial where id=".$a[$i])->fetch_assoc()['img_src'])){}
        if($conn->query("DELETE FROM `testimonial` WHERE id=".$a[$i])){
            $admin=connect_mysql();
            $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','testimonial deleted')");
        }else{
            echo "0";
        }
    }
}else{
    $id=$_POST['id'];
    if(unlink(".".$conn->query("select * from testimonial where id=".$id)->fetch_assoc()['img_src'])){}
        
    if($conn->query("DELETE FROM `testimonial` WHERE id=".$id)){
        echo "1";
        $admin=connect_mysql();
        $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','testimonial deleted')");
    }else{
        echo "0";
    }
}

?>