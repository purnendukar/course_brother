<?php 
    include "./includes/mysql_connect.php";
    $conn=connect_mysql_page();
    $sql=$_POST['query'];
    $row=$conn->query($sql)->fetch_assoc();
    $keys_=array_keys($row);
    $str="";
    for($i=0;$i<count($keys_);$i++){
        if($i<count($keys_)-1){
            $str.=urldecode($row[$keys_[$i]])."|";
        }else{
            $str.=urldecode($row[$keys_[$i]]);
        }
    }
    echo $str;

?>