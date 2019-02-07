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
    $file_path="./assets/images/team_img/";

    $extensions= array("jpeg","jpg","png","svg");
    if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }
    if(empty($errors)==true){
        $path=$file_path.rand().$file_name;
         if(move_uploaded_file($file_tmp,".".$path)){
         }else{
             echo "Upload Failed";
         }
    }else{
        print_r($errors);
    }
}else{
    echo "0";
}
    
    $name=urlencode($_POST['name']);
    $position=urlencode($_POST['position']);
    $about=urlencode($_POST['about']);

    if($conn->query("INSERT INTO `team`(`name`, `img_src`, `position`, `about`) VALUES ('".$name."','".$path."','".$position."','".$about."')")){
        echo "1";
    }else{
        echo "0";
    }
 

?>