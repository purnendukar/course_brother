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
    $file_path="./assets/svg/Icons/white/";

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
    $head=mysqli_real_escape_string($conn, $_POST['head']);
    $info=mysqli_real_escape_string($conn, $_POST['info']);
    

    if($conn->query("INSERT INTO features (img_src,heading,info) VALUES ('".$path."','".$head."','".$info."')")){
        echo "1";
    }else{
        echo "0";
    }
 

?>