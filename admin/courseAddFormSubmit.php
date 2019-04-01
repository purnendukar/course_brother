<?php
include "./includes/mysql_connect.php";
$conn=connect_mysql_page();
$u_id=$_POST['u_id'];
$s_id=$_POST['s_id'];
$aff=$_POST['aff'];
$c_id=$_POST['c_id'];
$prg_id=$_POST['prg_id'];
$fees=$_POST['fees'];
$s_fees=$_POST['s_fees'];
$a_fees=$_POST['a_fees'];
$duration=$_POST['duration'];
$desc=$_POST['description'];
$eligible=$_POST['eligible'];
$desc_s=$_POST['desc_s'];
$sem_struc=$_POST['sem_struc'];
$d_id=$_POST['d_mode_id'];
$meta_desc=$_POST['meta_desc'];
$meta_keys=$_POST['meta_keys'];
if($conn->query("SELECT * FROM `full_detail` WHERE c_id=".$c_id." and s_id=".$s_id." and d_mode_id=".$d_id." and u_id=".$u_id)->fetch_assoc()){
    die("Already Exist");
}
if($conn->query("INSERT INTO `full_detail`(`prg_id`, `c_id`, `u_id`, `s_id`, `fees`,`a_fees`,`s_fees`,`term`, `duration`, `a_id`,  `d_mode_id`,`meta_desc`,`meta_key`) VALUES (".$prg_id.",".$c_id.",".$u_id.",".$s_id.",".$fees.",".$a_fees.",".$s_fees.",".$_POST['terms'].",".$duration.",'".$aff."',".$d_id.",'".$meta_desc."','".$meta_keys."')")){
    $id=$conn->insert_id;
    $sem_struc= preg_replace("/[\n\r]/",'<br>',$sem_struc);
    $eligible= preg_replace("/[\n\r]/",'<br>',$eligible);
    if($conn->query("INSERT INTO `about_course`( id , `overview`, `structure`,`short_desc`,`eligible`) VALUES (".$id.",'".urlencode($desc)."','".urlencode($sem_struc)."','".$desc_s."','".$eligible."')")){
        
            $u_name=$conn->query("SELECT * FROM `universities` where u_id=".$u_id)->fetch_assoc()['u_name'];
            $c_name=$conn->query("SELECT * FROM `courses` where id=".$c_id)->fetch_assoc()['c_name'];
            $path=strtolower($u_name);
            if(!(file_exists("../".$path))){
                    mkdir("../".$path);
            }
            $path=strtolower($u_name)."/".strtolower($c_name);
            if(!(file_exists("../".$path))){
                mkdir("../".$path);
            }
            $d_mode=$conn->query("SELECT * FROM `delivery_mode` where id=".$d_id)->fetch_assoc()['d_mode'];
            $path=strtolower($u_name)."/".strtolower($c_name)."/".strtolower($d_mode);
            if(!(file_exists("../".$path))){
                mkdir("../".$path);
            }
            $sub=$conn->query("SELECT * FROM `subject` where id=".$s_id)->fetch_assoc()['sub_name'];
            
            $myfile = fopen("../".$path."/".strtolower($sub).".php", "w") or die("Unable to open file!");
            $txt = 
"<html>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Course Brother | ".ucfirst(strtolower($c_name))." in ".ucfirst(strtolower($sub))." from ".ucfirst(strtolower($u_name))." </title>
        <meta name='description' content='".$meta_desc."'>
        <meta name='keywords' content='course brother, coursebrother,".$meta_keys."'>
        <meta name='author' content='course brother'>
        <script>window.location.href='../../../pages/course-detail?id='+".$id."</script>
    </head>
</html>";
            fwrite($myfile, $txt);
            fclose($myfile);
            echo"1";
            $admin=connect_mysql();
            $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','course added')");
        
    }
}else{
    echo "Something went wrong";
}

?>