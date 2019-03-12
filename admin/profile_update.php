<?php

include "./includes/mysql_connect.php";
$conn=connect_mysql();

$id=$_POST['id'];
if(isset($_POST['pass'])){
    if($conn->query("UPDATE `user` SET `password`='".urlencode($_POST['pass'])."' WHERE id=".$id)){
        echo "1";
    }
}else{
    $f_name=$_POST['f_name'];
    $phn_no=$_POST['phn_no'];
    $city=$_POST['city'];

    $path="";
    if(isset($_FILES['image'])){
        $errors= array();
        $file_name = $_FILES['image']['name'];
        $file_size =$_FILES['image']['size'];
        $file_tmp =$_FILES['image']['tmp_name'];
        $file_type=$_FILES['image']['type'];
        $t=explode('.',$_FILES['image']['name']);
        $file_ext=strtolower(end($t));

        $file_path="./assets/images/avatars/";

        $extensions= array("jpeg","jpg","png");

        if(in_array($file_ext,$extensions)=== false){
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }
        if(empty($errors)==true){
            $path = $file_path.rand().$file_name;
            if(move_uploaded_file($file_tmp,$path)){
                if($conn->query("UPDATE `user` SET `f_name`='".urlencode($f_name)."',`city`='".urlencode($city)."',`phn_no`='".urlencode($phn_no)."',`address`='".urlencode($_POST['addr'])."',`profile_pic`='".$path."' WHERE id=".$id)){
                    echo "1";
                }
            }
        }else{
            print_r($errors);
        }
    }else{
        if($conn->query("UPDATE `user` SET `f_name`='".urlencode($f_name)."',`city`='".urlencode($city)."',`phn_no`='".urlencode($phn_no)."',`address`='".urlencode($_POST['addr'])."',`profile_pic`='".$path."' WHERE id=".$id)){
            echo "1";
        }
    }
}

?>