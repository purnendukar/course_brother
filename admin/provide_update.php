<?php

include "./includes/mysql_connect.php";
$conn=connect_mysql_page();
for($i=0;$i<4;$i++){
    if($conn->query("UPDATE `provide` SET `content`='".urlencode($_POST['provide'.$i])."' WHERE id=".($i+1))){
        echo "1";
    }else{
        echo "0";
    }
}
?>