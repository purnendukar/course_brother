<?php

$id_l="";
    if(isset($_POST['email_id'])){
        if($_POST['email_id']!=''){
          $sql="INSERT INTO `enquire`(`email`, `name`, `city`, `phn_no`) VALUES ( '".$e_id."', '";
                if(isset($_POST['full_name'])){
                    $sql=$sql.$_POST['full_name']."', '";
                }
                if(isset($_POST['c_name'])){
                    $sql=$sql.$_POST['c_name']."', '";
                }
                if(isset($_POST['phn_num'])){
                    $sql=$sql.$_POST['phn_num']."')";
                }
                $conn->query($sql);
            if($conn->query($sql)){
              
              $name="".$_POST['uname'];
              $email=$_POST['email_id'];
              $phn="".$_POST['phn'];
              $course="".$_POST['course_t'];
              $city="";
              $str="I am ".strtoupper($name).",";
              if(isset($_POST['city'])){
                  $city="".$_POST['city'];
                  $str.=" halting from ".strtoupper($city).",";
              }
              $e=$conn->query("SELECT * FROM `enquire_popup` where id=1")->fetch_assoc()['message'];

              ini_set('SMTP','smtp.zoho.com');
              ini_set('smtp_port',465);
              ini_set('sendmail_from', 'shyam.d@coursebrother.com');
              
              //define the receiver of the email
              $to = strtolower($email);
              //define the subject of the email
              $subject = 'Test for title'; 
              //define the message to be sent. Each line should be separated with \n
              $message = $e; 
              
              //define the headers we want passed. Note that they are separated with \r\n
              $headers = 'From: shyam.d@coursebrother.com\r\n';
              
              //send the email
              $mail_sent = mail($to, $subject, $message, $headers);
              mail('shyam.d@coursebrother.com', 'Enquiry', 'Name: '.$name.' \nEmail: '.$email.' \nContact no.: '.$phn_no.' \nCity: '.$city, $headers);
              
              //if the message is sent successfully print "Mail sent correctly". Otherwise print "Mail failed" 
              echo $mail_sent ? "<script>alert('Enquiry send, We will contact you shortly.');</script>" : "<script>alert('Something went wrong');</script>";
            }
        }
    }
?>
<!-- Lead_POPUP -->
<div class="newsletter_popup__backdrop1"></div>
<div class="newsletter_popup1">
  <div class="newsletter_popup__main1">
    <div class="newsletter_popup__main__close1"><i class="fa fa-times"></i></div>
    <h2 class='newsletter_popup__main__title' style="text-align:center;width:100%;margin-top:25px;"><?php echo $conn->query("select * from enquire_popup where id=1")->fetch_assoc()['head']; ?></h2>
    <div class="newsletter_popup__main__form">
      <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
        <input name="full_name" type="text" placeholder='your full name'>
        <input name="c_name" type="text" placeholder='your city name'>
        <input name="phn_num" type="tel" placeholder='your phone number'>
        <input name="email_id" type="email" placeholder='your email address' required>
        <span style="text-align:center;width:100%;">
          <input type="submit" value="Submit" style="position:relative;left:26%;"/>
        </span>
      </form>
    </div>
  </div>
</div>

<!-- /Lead_POPUP -->
