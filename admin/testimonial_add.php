<?php 

include "./includes/mysql_connect.php";
$conn=connect_mysql_page();
$path="";
if(isset($_FILES['image'])){
    $errors= array();
    $file_name = $_FILES['image']['name'];
    $file_size =$_FILES['image']['size'];
    $file_tmp =$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
    $t=explode('.',$_FILES['image']['name']);
    $file_ext=strtolower(end($t));
    $file_path="./assets/images/testimonial/";

    $extensions= array("jpeg","jpg","png");
    if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }
    if(empty($errors)==true){
         if(move_uploaded_file($file_tmp,".".$file_path.$file_name)){
             $path=$file_path.$file_name;
         }
    }else{
        print_r($errors);
    }
}else{
    echo "0";
}
    $head=mysqli_real_escape_string($conn, $_POST['head']);
    $para=mysqli_real_escape_string($conn, $_POST['para']);
    $about=mysqli_real_escape_string($conn, $_POST['about']);
    

    if($conn->query("INSERT INTO testimonial (head,para,about,img_src) VALUES ('".$head."','".$para."','".$about."','".$path."')")){
        echo "1";
        
        $admin=connect_mysql();
        $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','testimonial added')");
    }else{
        echo "0";
    }
 

?>