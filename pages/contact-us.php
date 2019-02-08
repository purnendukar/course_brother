<?php
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip'))
  ob_start("ob_gzhandler");
else 
  ob_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Cache-control" content="public">
  <link rel="shortcut icon" href="..\assets\images\favicon.png" type="image/png" />

  <!-- NORMALIZE CSS -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css' />

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:100,300,400,500,600,700" rel="stylesheet">

  <!-- FONTAWESOME -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' />

  <!-- ANIMATE CSS -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css' />

  <!-- CUSTOM CSS -->
  <link rel='stylesheet' href='../styles/style.css' />

  <title>CourseBrother.com | Contact</title>
</head>
<body>
  
  
  <!-- MAIN_CONTAINER -->
  <div class="main-container">
       <!-- MySQL connector --!>
  <?php
        include "../includes/mysql_connect.php";
        $conn=connect_mysql();
    ?>
<!-- LOGIN_REGISTER_MODALS -->
    <?php include '../includes/login-register-modal.php' ?>
    <!-- /LOGIN_REGISTER_MODALS -->
      
      <!-- NEWSLETTER_POPUP -->
    <?php include '../includes/newsletter-popup.php'; ?>
    <!-- NEWSLETTER_POPUP -->

    <!-- NAVBAR_MAIN -->
    <?php include '../includes/navbar-main.php' ?>
    <!-- /NAVBAR_MAIN -->


    <!-- CONTACT_US -->
    <div class="contact_us">

      <div class="contact_us__meet">
        <div class="contact_us__meet__container">
          <h3 class='contact_us__meet__container__title'>plan a meet</h3>

          <div class="contact_us__meet__container__info">
            <?php $res=$conn->query("SELECT * FROM `contact_info`");?>
            <div class="contact_us__meet__container__info__item">
              <div class='contact_us__meet__container__info__item__container'>
                <img src='..\assets\svg\Icons\white\phone-receiver.svg' />
                <h4><?php echo $res->fetch_assoc()['info'];?></h4>
              </div>
            </div>
            <div class="contact_us__meet__container__info__item">
              <div class='contact_us__meet__container__info__item__container'>
                <a href='mailto:shyam.d@gmail.com'>
                  <img src='..\assets\svg\Icons\white\mail-black-envelope-symbol.svg' />
                </a>
                <h4><?php echo $res->fetch_assoc()['info'];?></h4>
              </div>
            </div>
            <div class="contact_us__meet__container__info__item">
              <div class='contact_us__meet__container__info__item__container'>
                <img src='..\assets\svg\Icons\white\maps-and-flags.svg' />
                <h4 style="max-width:55%;"><?php echo $res->fetch_assoc()['info'];?></h4>
              </div>
            </div>

          </div>

        </div>
      </div>

      <div class="contact_us__ping">
        <div class="contact_us__ping__container">
          <h3 class='contact_us__ping__container__title'>ping us</h3>
          <h6>hello,</h6>
          <form method="post" action="./enquire_send.php?url=contact-us.php">
            <p>i am <input name="uname" type='text' placeholder='your full name' required />, hailing from <input type='text' placeholder='your city' name="city" required />, and i would like to discuss about <input type='text' placeholder='course name' name="course_t" required /> course. my email address is <input type='email' placeholder='your email' name="email" required />, and my phone number is <input type='text' placeholder='your ph. no.' name="phn" required />. thank you.
            </p>
            <p>
              <input id="accept" type='checkbox' required /> I authorize CourseBrother.com representative to contact me via phone and/or email. This will override registry on DND/NDNC
            </p>
            <input type="submit" value='SEND' />
          </form>
        </div>
      </div>

    </div>
    <!-- /CONTACT_US -->
    

    <!-- FOOTER -->
    <?php include '../includes/footer.php' ?>
    <!-- /FOOTER -->



  </div>
  <!-- /MAIN_CONTAINER -->


  <!-- jQuery -->
  <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous">
  </script>
    <!-- TweenMax -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>
  <!-- WOW JS -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js'></script>
    <script src='../js/navbar.js'></script>
    <script>
    setInterval(function(){
        var t = parseInt(Math.random()*10000000);
        $.ajax({
          type: "POST",
          url: "../includes/user_track_cookie.php",
          data: {ra:t,url:window.location.href},
          complete: function(data){
                    //data contains the response from the php file.
                    //u can pass it here to the javascript function
                    console.log(data);
                }
        });
    }, 1000);
    </script>
    <script src="../js/preloader.js"></script>

</body>
</html> 