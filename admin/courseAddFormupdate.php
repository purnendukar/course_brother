<?php 
include "./includes/mysql_connect.php";
$conn=connect_mysql_page();
$id=$_POST['id'];
$aff=$_POST['aff'];
$fees_d=$_POST['fees_d'];
$fees=$_POST['fees'];
$a_fees=$_POST['a_fees'];
$s_fees=$_POST['s_fees'];
$fees_s=$_POST['fees_s'];
$a_fees_s=$_POST['a_fees_s'];
$s_fees_s=$_POST['s_fees_s'];
$duration=$_POST['duration'];
$desc=$_POST['description'];
$eligible=$_POST['eligible'];
$sem_struc=$_POST['sem_struc'];
$meta_desc=$_POST['meta_desc'];
$meta_keys=$_POST['meta_keys'];
if($conn->query("UPDATE `full_detail` SET `fees_d`='".$fees_d."',`fees`='".$fees."',`a_fees`='".$a_fees."',`s_fees`='".$s_fees."',`fee_s`='".$fees_s."',`a_fee_s`='".$a_fees_s."',`s_fee_s`='".$s_fees_s."',`term`='".$_POST['terms']."',`duration`=".$duration.",`a_id`='".$aff."' WHERE id=".$id)){
    $sem_struc= preg_replace("/[\n\r]/",'<br>',$sem_struc);
    $eligible= preg_replace("/[\n\r]/",'<br>',$eligible);
    if($conn->query("UPDATE `about_course` SET `overview`='".$desc."', `structure`='".$sem_struc."',`short_desc`='".$_POST['desc_s']."', eligible='".$eligible."' where id=".$id)){
        
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
}else{
    echo "0";
}
?>