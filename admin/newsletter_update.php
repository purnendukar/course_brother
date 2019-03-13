<?php 

include "./includes/mysql_connect.php";
$conn=connect_mysql_page();

$id=$_POST['id'];

if(isset($_POST['head'])){
    $head=mysqli_real_escape_string($conn, $_POST['head']);
    $content=mysqli_real_escape_string($conn, $_POST['content']);

    if($conn->query("UPDATE `news_update` SET `heading`='".$head."',`content`='".$content."' WHERE id=".$id)){
        echo "1";
        $admin=connect_mysql();
        $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','update newsletter of ".$conn->query("select * from universities where u_id=".$u_id)->fetch_assoc()['u_name']." id=".$id."')");
    }else{
        echo "0";
    }
}
 

?>