<?php 

include "./includes/mysql_connect.php";
$conn=connect_mysql_page();

$id=$_POST['id'];

if(isset($_FILES['image'])){
    $errors= array();
    $file_name = $_FILES['image']['name'];
    $file_size =$_FILES['image']['size'];
    $file_tmp =$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
    $t=explode('.',mysqli_real_escape_string($conn, $_FILES['image']['name']));
    $file_ext=strtolower(end($t));
    $file_path="./assets/images/team_img/";

    $extensions= array("jpeg","jpg","png");
    if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }
    if(empty($errors)==true){
         if(move_uploaded_file($file_tmp,".".$file_path.$file_name)){
             $path=$file_path.$file_name;
             if($conn->query("UPDATE `team` SET img_src='".$path."' where id=".$id)){
                 echo $path;
             }else{
                 echo "0";
             }
         }
    }else{
        print_r($errors);
    }
}else{
    echo "0";
}
if(isset($_POST['name'])){
    $name=urlencode($_POST['name']);
    $position=urlencode($_POST['position']);
    $about=mysqli_real_escape_string($conn, $_POST['about']);
    
    $admin=connect_mysql();
    if($conn->query("UPDATE `team` SET `name`='".$name."',`position`='".$position."',`about`='".$about."', `display`='".$_POST['display']."',update_by='".$admin->query("select * from user where id=".$_COOKIE['user_id'])->fetch_assoc()['u_name']."' WHERE id=".$id)){
        echo "1";
        $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','update on team id=".$id."')");
    }else{
        echo "0";
    }
}
 

?>