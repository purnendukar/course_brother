<?php

include "./mysql_connect.php";

$conn=connect_mysql();

$pass=$_POST['pass'];
$f_name=$_POST['f_name'];
$l_name=$_POST['l_name'];
$city=$_POST['city'];
$phn_no=$_POST['phn_no'];
$email=$_POST['email'];

if($conn->query("select * from register_user where email='".$email."'")->fetch_assoc()){
    echo "Email Id Already Used";
}else{
    if($conn->query("INSERT INTO `register_user`(`f_name`, `l_name`, `city`, `phn_no`, `email`, `pass`) VALUES ('".$f_name."','".$l_name."','".$city."','".$phn_no."','".$email."','".$pass."')")){
        $conn->query("INSERT INTO `user_info`(`email`) value ('".$email."') ");
        echo "1";
            
              $name=$f_name." ".$l_name;
            
              ini_set('SMTP','smtp.zoho.com');
              ini_set('smtp_port',465);
              ini_set('sendmail_from', 'shyam.d@coursebrother.com');
              
              //define the receiver of the email
              $to = strtolower($email);
              //define the subject of the email
              $subject = 'Test for title'; 
              //define the message to be sent. Each line should be separated with \n
              $message = $conn->query("SELECT * FROM `lead_popup` where id=1")->fetch_assoc()['message'];; 
              
              //define the headers we want passed. Note that they are separated with \r\n
              $headers = 'From: shyam.d@coursebrother.com\r\n';
              
              //send the email
              mail('shyam.d@coursebrother.com', 'Enquiry', 'New student registered. \n Registration details \n\n Name: '.$name.' \nEmail: '.$email.' \nContact no.: '.$phn_no.' \nCity: '.$city, $headers);
              
              //if the message is sent successfully print "Mail sent correctly". Otherwise print "Mail failed" 
    }else{
        echo "Something Went Wrong";
    }
}

?>