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


// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.zoho.com';                        // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'contact@coursebrother.com';        // SMTP username
    $mail->Password = 'Shyam28#';                         // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('contact@coursebrother.com', 'Mailer');
    $mail->addAddress('shyam.d@gmail.com');

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Enquiry';
    $mail->Body    = $str;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

    mail($e,"Enquiry",$str,"From: ".$email);
    $t=explode("/",$_GET['url']);
    //header("Location: ".$t[count($t)-1]);
    
?>