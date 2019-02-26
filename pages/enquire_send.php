<?php
    include "../includes/mysql_connect.php";
    $conn=connect_mysql();

    $name="".$_POST['uname'];
    $email="".$_POST['email'];
    $phn="".$_POST['phn'];
    $course="".$_POST['course_t'];
    $city="";
    $str="I am ".strtoupper($name).",";
    if(isset($_POST['city'])){
        $city="".$_POST['city'];
        $str.=" halting from ".strtoupper($city).",";
    }
    $str.=" and I would like to discuss about ".strtoupper($course)." course. My email address is ".$email.", and my phone number is ".strtoupper($phn).". THANK YOU.";
    echo $str;
    $e=$conn->query("SELECT * FROM `contact_info` where id=2")->fetch_assoc()['info'];
    mail($e,"Enquiry",$str,"From: ".$email);
    $t=explode("/",$_GET['url']);
    header("Location: ".$t[count($t)-1]);
    
?>