<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
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

  <title>CourseBrother.com | About</title>
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

    <!-- ABOUT_US -->
    <div class='about_us'>
      <?php $res=$conn->query("SELECT * FROM `about`");?>
      <div class="about_us__header">
        <h1 class='about_us__header__title'>about</h1>
        <div class="about_us__header__para">
          <?php echo urldecode($res->fetch_assoc()['content']);?>
        </div>
      </div>

      <div class="about_us__services">
        <h2 class='about_us__services__title'>we strive to provide you with</h2>
        <div class="about_us__services__container">
          <?php $res=$conn->query("SELECT * FROM `provide`");?>
          <div class="about_us__services__container__item">
            <img src="..\assets\svg\Icons\white\journey.svg" />
            <h5>versatility</h5>
            <p>
              <?php echo urldecode($res->fetch_assoc()['content']);?>
            </p>
          </div>

          <div class="about_us__services__container__item">
            <img src="..\assets\svg\Icons\white\stopwatch.svg" />
            <h5>convenience</h5>
            <p>
            <?php echo urldecode($res->fetch_assoc()['content']);?>
            </p>
          </div>

          <div class="about_us__services__container__item">
            <img src="..\assets\svg\Icons\white\customer.svg" />
            <h5>authenticity</h5>
            <p>
              Get access to 1000+ courses from leading course providers offering recognized and industry standard
            </p>
          </div>

          <div class="about_us__services__container__item">
            <img src="..\assets\svg\Icons\white\support.svg" />
            <h5>support</h5>
            <p>
            <?php echo urldecode($res->fetch_assoc()['content']);?>
            </p>
          </div>

        </div>
      </div>

      <div class="about_us__founders">
        <?php $res=$conn->query("SELECT * FROM `team`")?>
        <h2 class='about_us__founders__title'>Team Members</h2>
        <div class='about_us__founders__container'>
          <?php while($row=$res->fetch_assoc()){?>
          <div class="about_us__founders__item">
            <img src=".<?php echo $row['img_src']?>" />
            <h4><?php echo urldecode($row['name'])?></h4>
            <h5><?php echo urldecode($row['position'])?></h5>
            <p>
            <?php echo urldecode($row['about'])?>
            </p>
          </div>
          <?php } ?>
          
        </div>

      </div>

    </div>
    <!-- /ABOUT_US -->
    

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