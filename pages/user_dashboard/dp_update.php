<?php
include "../../includes/mysql_connect.php";
$conn_p=connect_mysql();
if(isset($_FILES['image'])){
    $errors= array();
    $file_name = $_FILES['image']['name'];
    $file_size =$_FILES['image']['size'];
    $file_tmp =$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
      $t=explode('.',$_FILES['image']['name']);
    $file_ext=strtolower(end($t));

      $file_path="./assets/images/user_profile_pic/";

    $extensions= array("jpeg","jpg","png");

    if(in_array($file_ext,$extensions)=== false){
       $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }
    if(empty($errors)==true){
      $path=$file_path.rand().$file_name;
       if(move_uploaded_file($file_tmp,"../.".$path)){
           if($conn_p->query("UPDATE `user_info` SET img_src='".$path."' WHERE email='".urldecode($_COOKIE['email'])."'")){
              echo "1";
           }
       }
        $img_src=$file_path.$file_name;
    }else{
        print_r($errors);
    }
}else{
  echo "0";
}
?>