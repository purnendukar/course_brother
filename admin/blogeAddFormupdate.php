<?php
include "./includes/mysql_connect.php";
$conn=connect_mysql_page();
$id=$_POST['id'];
$title=$_POST['title'];
$content=$_POST['content'];
if($conn->query("UPDATE `blogs` SET `heading`='".$title."',`content`='".$content."',`content_2`='".$_POST['content2']."' WHERE id=".$id)){
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
  if(isset($_FILES['image1'])){
        $errors= array();
        $file_name = $_FILES['image1']['name'];
        $file_size =$_FILES['image1']['size'];
        $file_tmp =$_FILES['image1']['tmp_name'];
        $file_type=$_FILES['image1']['type'];
          $t=explode('.',$_FILES['image1']['name']);
        $file_ext=strtolower(end($t));

          $file_path="./assets/images/institute_img/";

        $extensions= array("jpeg","jpg","png");

        if(in_array($file_ext,$extensions)=== false){
           $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }
        if(empty($errors)==true){
          $path = $file_path.rand().$file_name;
           if(move_uploaded_file($file_tmp,".".$path)){
               if($conn->query("UPDATE `blogs` SET img_src='".$path."' where id=".$id)){
                  echo "1";
               }
           }
        }else{
            print_r($errors);
        }
  }
      echo "1";
      
    $admin=connect_mysql();
    $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','update blog id=".$id."')");
}else{
  echo "0";
}
?>
