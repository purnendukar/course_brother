<?php
$u_id=$_POST['u_id'];

include "./mysql_connect.php";

$conn_p=connect_mysql_page();

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
                         if(move_uploaded_file($file_tmp,"../.".$file_path.$file_name)){
                             $path=$file_path.$file_name;
                             if($conn_p->query("UPDATE `universities` SET img_src='".$path."' where u_id=".$u_id)){
                                echo $path;
                             }
                         }
                          $img_src=$file_path.$file_name;
                      }else{
                          print_r($errors);
                      }
                }else{
                    echo "0";
                }
if(isset($_POST['u_name'])){
    $u_name=mysqli_real_escape_string($conn_p,strtoupper($_POST['u_name']));
    $about=mysqli_real_escape_string($conn_p,$_POST['about']);
    $path="";
    $key=str_replace("UNIVERSITY","",$u_name);
    $key=str_replace("COLLEGE","",$key);

    $status= false;

    $sql="UPDATE `universities` SET `u_name`='".$u_name."',`about`='".$about."',`keyword`='".$key."' where u_id=".$u_id;
    if($conn_p->query($sql)){
        echo "1";
    }
}
?>