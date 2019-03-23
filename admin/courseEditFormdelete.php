<?php 
include "./includes/mysql_connect.php";
$conn=connect_mysql_page();
$admin=connect_mysql();

if(isset($_POST['ind'])){
    $id=$_POST['ind'];
    $row=$conn->query("SELECT * FROM `full_detail` WHERE id=".$id)->fetch_assoc();
    $u_name=$conn->query("SELECT * FROM `universities` where u_id=".$row['u_id'])->fetch_assoc()['u_name'];
    $c_name=$conn->query("SELECT * FROM `courses` where id=".$row['c_id'])->fetch_assoc()['c_name'];
    $d_mode=$conn->query("SELECT * FROM `delivery_mode` where id=".$row['d_mode_id'])->fetch_assoc()['d_mode'];
    $path=strtolower($u_name)."/".strtolower($c_name)."/".strtolower($d_mode);
    $sub=$conn->query("SELECT * FROM `subject` where id=".$row['s_id'])->fetch_assoc()['sub_name'];
    if($path!=""){
        unlink("../".$path."/".strtolower($sub).".php");
    }
    if($conn->query("DELETE FROM `full_detail` WHERE id=".$id)){
        if($conn->query("DELETE FROM `about_course` WHERE id=".$id)){
            if($conn->query("DELETE FROM `fee_structure` WHERE id=".$id)){
                echo"1";
                $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','course deleted')");
            }
        }
    }else{
        echo "0";
    }
}else{
    $ids=explode(",",$_POST['ids']);
    $c=0;
    for($i=0;$i<count($ids);$i++){
        $id=$ids[$i];
        $row=$conn->query("SELECT * FROM `full_detail` WHERE id=".$id)->fetch_assoc();
        $u_name=$conn->query("SELECT * FROM `universities` where u_id=".$row['u_id'])->fetch_assoc()['u_name'];
        $c_name=$conn->query("SELECT * FROM `courses` where id=".$row['c_id'])->fetch_assoc()['c_name'];
        $d_mode=$conn->query("SELECT * FROM `delivery_mode` where id=".$row['d_mode_id'])->fetch_assoc()['d_mode'];
        $path=strtolower($u_name)."/".strtolower($c_name)."/".strtolower($d_mode);
        $sub=$conn->query("SELECT * FROM `subject` where id=".$row['s_id'])->fetch_assoc()['sub_name'];
        if($path!=""){
            unlink("../".$path."/".strtolower($sub).".php");
        }
        if($conn->query("DELETE FROM `full_detail` WHERE id=".$id)){
            if($conn->query("DELETE FROM `about_course` WHERE id=".$id)){
                if($conn->query("DELETE FROM `fee_structure` WHERE id=".$id)){
                    $c++;
                    $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','course deleted')");
                }
            }
        }
    }
    if($c==count($ids)){
        echo "1";
    }else{
        echo "0";
    }
}
?>