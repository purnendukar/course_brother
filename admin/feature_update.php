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
    $file_path="./assets/images/features/";

    $extensions= array("jpeg","jpg","png","svg");
    if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }
    if(empty($errors)==true){
        $path=$file_path.rand().$file_name;
         if(move_uploaded_file($file_tmp,".".$path)){
             if($conn->query("UPDATE `slide_show` SET img_src='".$path."' where id=".$id)){
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
if(isset($_POST['head'])){
    $head=mysqli_real_escape_string($conn, $_POST['head']);
    $info=mysqli_real_escape_string($conn, $_POST['info']);
    $admin=connect_mysql();

    if($conn->query("UPDATE `features` SET `heading`='".$head."',`info`='".$info."',display='".$_POST['display']."',`update_by`='".$admin->query("select * from user where id=".$_COOKIE['user_id'])->fetch_assoc()['u_name']."' WHERE id=".$id)){
        echo "1";
        $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','update on why select us')");
    }else{
        echo "0";
    }
}


?>