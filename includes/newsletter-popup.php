<?php

$id_l="";
$conn=connect_mysql();
function set_s_cookie($e_id){
        $cookie_id="e_id";
        if (setcookie($cookie_id, $e_id , time() + 10*365*24*60*60,"/")){
            $conn=connect_mysql();
        echo "<script>var now=new Date();
 console.log(now.toUTCString());
 now.setTime(now.getTime()+ 24*60*60*1000);
 console.log(now.toUTCString()); 
 var tr=now.toUTCString();
 document.cookie=\"e_id=".$e_id.";expires=\"+tr+\";path=/\";</script>";
            
            try{
                $sql="INSERT INTO `user_session`(`email`, `full_name`, `city`, `phn_no`) VALUES ( '".$e_id."', '";
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
            }catch(Exception $e){
                
            }
            $sql="select * from user_session where email='".$e_id."'";
            $id=$conn->query($sql)->fetch_assoc()['id'];
            $sql="INSERT INTO user_session_track (user_id,page) VALUES (".$id.",'".$_SERVER['REQUEST_URI']."')";
            if($conn->query($sql)){}
        }else{
            echo "Failed to generate cookie";
        }
    }

    if(isset($_POST['e_id'])){
        if($_POST['e_id']!=''){
            $e_id=$_POST['e_id'];
            set_s_cookie($e_id);
            
              $name="".$_POST['uname'];
              $email=$_POST['e_id'];
              $phn="".$_POST['phn'];
              $city="";
              $str="I am ".strtoupper($name).",";
              if(isset($_POST['city'])){
                  $city="".$_POST['city'];
                  $str.=" halting from ".strtoupper($city).",";
              }
            
              ini_set('SMTP','smtp.zoho.com');
              ini_set('smtp_port',465);
              ini_set('sendmail_from', 'shyam.d@coursebrother.com');
              
              //define the receiver of the email
              $to = strtolower($email);
              //define the subject of the email
              $subject = 'Test for title'; 
              //define the message to be sent. Each line should be separated with \n
              $message = 'Newsletter Subscribe'; 
              
              //define the headers we want passed. Note that they are separated with \r\n
              $headers = 'From: shyam.d@coursebrother.com\r\n';
              
              //send the email
              $mail_sent = mail($to, $subject, $message, $headers);
              mail('shyam.d@coursebrother.com', 'Enquiry', 'Lead Generated \n\n Name: '.$name.' \nEmail: '.$email.' \nContact no.: '.$phn_no.' \nCity: '.$city, $headers);
              
              //if the message is sent successfully print "Mail sent correctly". Otherwise print "Mail failed" 
              echo $mail_sent ? "<script>alert('Thank you');</script>" : "<script>alert('Something went wrong');</script>";
        }
    }?>
<!-- NEWSlETTER_POPUP -->
<div class="newsletter_popup__backdrop"></div>
<div class="newsletter_popup">
  <div class="newsletter_popup__illustration">
    <div class="newsletter_popup__illustration__img"></div>
  </div>
  <div class="newsletter_popup__main">
    <div class="newsletter_popup__main__close"><i class="fa fa-times"></i></div>
    <h2 class='newsletter_popup__main__title'><?php echo $conn->query("select * from lead_popup where id=1")->fetch_assoc()['head'];?></h2>
    <div class="newsletter_popup__main__form">
      <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
        <input name="full_name" type="text" placeholder='your full name'>
        <input name="c_name" type="text" placeholder='your city name'>
        <input name="phn_num" type="tel" placeholder='your phone number'>
        <input name="e_id" type="email" placeholder='your email address' required>
        <span>
          <input type="submit" value="yes, i'm in">
          <div>no, thanks</div>
        </span>
      </form>
    </div>
  </div>
</div>

<!-- /NEWSlETTER_POPUP -->
<?php if(isset($_COOKIE['e_id'])){ 
    //echo "<script>alert('here i m ');</script>";
    $sql="select * from user_session where email='".$_COOKIE['e_id']."'";
    $id=$conn->query($sql)->fetch_assoc()['id'];
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $sql="INSERT INTO user_session_track (user_id,page) values (".$id.",'".$actual_link."')";
    $conn->query($sql);
        
}
?>