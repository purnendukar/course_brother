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
    $e=$conn->query("SELECT * FROM `contact_info` where id=2")->fetch_assoc()['info'];
    
    

    ini_set('SMTP','smtp.zoho.com');
    ini_set('smtp_port',465);
    ini_set('sendmail_from', 'shyam.d@coursebrother.com');
    
    //define the receiver of the email
    $to = 'rijusuman1996@gmail.com';
    //define the subject of the email
    $subject = 'Test for title'; 
    //define the message to be sent. Each line should be separated with \n
    $message = 'Message to send'; 
    
    //define the headers we want passed. Note that they are separated with \r\n
    $headers = 'From: shyam.d@coursebrother.com\r\n';
    
    //send the email
    $mail_sent = mail($to, $subject, $message, $headers);
    mail($to, $subject, $message, $headers);
    
    //if the message is sent successfully print "Mail sent correctly". Otherwise print "Mail failed" 
    echo $mail_sent ? "<script>alert('Enquiry send')</script>" : "<script>alert('Something went wrong')</script>";
    
    
//   $to = "rijusuman1996@gmail.com"; // <– replace with your address here
//   $subject = "Test mail";
//   $message = "Hello! This is a simple test email message.";
//   $from = "ghonta@coursebrother.com";
//   $headers = "From:" . $from;
//   mail($to,$subject,$message,$headers);


// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// //Load Composer's autoloader
// require '../vendor/autoload.php';

// $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
// try {
//     //Server settings
//     $mail->SMTPDebug = 2;                                 // Enable verbose debug output
//     $mail->isSMTP();                                      // Set mailer to use SMTP
//     $mail->Host = 'smtp.zoho.com';                        // Specify main and backup SMTP servers
//     $mail->SMTPAuth = true;                               // Enable SMTP authentication
//     $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
//     $mail->Port = 465;                                    // TCP port to connect to
//     $mail->Username = 'contact@coursebrother.com';        // SMTP username
//     $mail->Password = 'Shyam82#';                         // SMTP password

//     //Recipients
//     $mail->setFrom('suman@coursebrother.com', 'Mailer');
//     $mail->addAddress('rijusuman1996@gmail.com');

//     //Content
//     $mail->isHTML(true);                                  // Set email format to HTML
//     $mail->Subject = 'Enquiry';
//     $mail->Body    = $str;

//     $mail->send();
//     echo 'Message has been sent';
// } catch (Exception $e) {
//     echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
// }

    $t=explode("/",$_GET['url']);
    echo "";
    header("Location: ".$t[count($t)-1]);
    
?>