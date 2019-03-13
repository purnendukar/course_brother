<?php 
include "./includes/mysql_connect.php";
$conn=connect_mysql_page();
$id=$_POST['id'];
$aff=$_POST['aff'];
$fees=$_POST['fees'];
$duration=$_POST['duration'];
$desc=$_POST['description'];
$sem_struc=$_POST['sem_struc'];
$fees_struc=$_POST['fees_struc'];
$meta_desc=$_POST['meta_desc'];
$meta_keys=$_POST['meta_keys'];
if($conn->query("UPDATE `full_detail` SET `fees`=".$fees.",`duration`=".$duration.",`a_id`='".$aff."' WHERE id=".$id)){
    $sem_struc= preg_replace("/[\n\r]/",'<br>',$sem_struc);
    if($conn->query("UPDATE `about_course` SET `overview`='".$desc."', `structure`='".$sem_struc."' where id=".$id)){
        if($conn->query("UPDATE `fee_structure` SET `structure`='".$fees_struc."' WHERE id=".$id)){
            $row=$conn->query("select * from full_detail where id=".$id)->fetch_assoc();
            $u_id=$row['u_id'];
            $c_id=$row['c_id'];
            $u_name=$conn->query("SELECT * FROM `universities` where u_id=".$u_id)->fetch_assoc()['u_name'];
            $c_name=$conn->query("SELECT * FROM `courses` where id=".$c_id)->fetch_assoc()['c_name'];
            $d_mode=$conn->query("SELECT * FROM `delivery_mode` where id=".$row['d_mode_id'])->fetch_assoc()['d_mode'];
            $path=strtolower($u_name)."/".strtolower($c_name)."/".strtolower($d_mode);
            $sub=$conn->query("SELECT * FROM `subject` where id=".$row['s_id'])->fetch_assoc()['sub_name'];
            unlink("../".$path."/".strtolower($sub).".php");
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
            $admin->query("INSERT INTO `user_activity`(`user_id`, `activity`) VALUES ('".$_COOKIE['user_id']."','course updated id=".$id."')");
        }
    }
}else{
    echo "0";
}
?>