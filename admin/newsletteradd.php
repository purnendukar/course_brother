<?php 

include "./includes/mysql_connect.php";
$conn=connect_mysql_page();

    $head=mysqli_real_escape_string($conn, $_POST['heading']);
    $content=mysqli_real_escape_string($conn, $_POST['content']);
    $u_id=mysqli_real_escape_string($conn, $_POST['u_id']);
    
    if($conn->query("INSERT INTO `news_update`(`u_id`, `heading`, `content`) VALUES (".$u_id.",'".$head."','".$content."')")){
        echo "1";
    }else{
        echo "0";
    }
 

?>