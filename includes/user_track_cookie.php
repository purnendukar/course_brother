<?php

include "./mysql_connect.php";
$conn=connect_mysql();
if(isset($_COOKIE['e_id'])){
$sql="select * from user_session where email='".$_COOKIE['e_id']."'";
$id=$conn->query($sql)->fetch_assoc()['id'];
$id_l=$conn->query("select id from user_session_track where (user_id=".$id." and page='".$_POST['url']."' ) order by id DESC")->fetch_assoc()['id'];

update_checker($_POST['ra']);
}

function update_checker($r){
        if($GLOBALS['conn']->query("UPDATE `user_session_track` SET `checker`= ".$r." WHERE id=".$GLOBALS['id_l']))
            echo "here ";
    else echo $_POST['url'];
}
?>