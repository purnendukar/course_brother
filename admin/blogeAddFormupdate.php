<?php
include "./includes/mysql_connect.php";
$conn=connect_mysql_page();
$id=$_POST['id'];
$title=$_POST['title'];
$content=$_POST['content'];
if($conn->query("UPDATE `blogs` SET `heading`='".$title."',`content`='".$content."' WHERE id=".$id)){
  if(isset($_FILES['image'])){
            $errors= array();
            $file_name = $_FILES['image']['name'];
            $file_size =$_FILES['image']['size'];
            $file_tmp =$_FILES['image']['tmp_name'];
            $file_type=$_FILES['image']['type'];
              $t=explode('.',$_FILES['image']['name']);
            $file_ext=strtolower(end($t));

              $file_path="./assets/images/institute_img/";

            $extensions= array("jpeg","jpg","png");

            if(in_array($file_ext,$extensions)=== false){
               $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }
            if(empty($errors)==true){
              $path = $file_path.rand().$file_name;
               if(move_uploaded_file($file_tmp,".".$path)){
                   if($conn->query("UPDATE `blogs` SET thumnail='".$path."' where id=".$id)){
                      echo "1";
                   }
               }
            }else{
                print_r($errors);
            }
      }
      echo "1";
}else{
  echo "0";
}
?>