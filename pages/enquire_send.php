<?php
    include "../includes/mysql_connect.php";
    
    $conn=connect_mysql();

    $name="".$_POST['uname'];
    $email="".$_POST['email'];
    $phn="".$_POST['phn'];
    $course="".$_POST['course_t'];
    $city="";
    if(isset($_POST['city'])){
        $city="".$_POST['city'];
    }
        try{$conn->query("INSERT INTO `enquire`(`name`, `email`, `course`, `phn_no`, `city`) VALUES ('".$name."','".$email."','".$course."','".$phn."','".$city."')");
        }
        catch(mysqli_sql_exception $e){
            echo $e->getMessage();
        }
    $t=explode("/",$_GET['url']);
    header("Location: ".$t[count($t)-1]);
    
?>