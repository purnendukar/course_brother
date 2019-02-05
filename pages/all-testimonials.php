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

  <title>CourseBrother.com | Testimonials</title>
</head>
<body>
  
    <!-- MySQL connector --!>
  <?php
        include "../includes/mysql_connect.php";
        $conn=connect_mysql();
    ?>
  
  <!-- MAIN_CONTAINER -->
  <div class="main-container">


    <!-- NAVBAR_MAIN -->
    <?php include '../includes/navbar-main.php' ?>
    <!-- /NAVBAR_MAIN -->

    <!-- LOGIN_REGISTER_MODALS -->
    <?php include '../includes/login-register-modal.php' ?>
    <!-- /LOGIN_REGISTER_MODALS -->


    <!-- ALL_TESTIMONIALS -->
    <div class="all_testimonials__container">

      <div class="all_testimonials__aside">
        <div class="all_testimonials__aside__mark">
          <i class="fa fa-quote-left"></i>
        </div>
      </div>

      <main class="all_testimonials__main">
        <div class="all_testimonials__main__sep"></div>
        <h1 class="all_testimonials__main__title">what students say about us</h1>

        <div class="all_testimonials__main__container">

          <div class="all_testimonials__main__item">
            <div class="all_testimonials__main__item__img">
              <img src="http://1.bp.blogspot.com/-hNC-oT6f-fY/TeXxO26yjvI/AAAAAAAAAOY/qfkOqdKkBi8/s1600/platon-photographer-putin-man-of-the-year-portrait.jpg" alt="Image of student" />
            </div>
            <div class="all_testimonials__main__item__content">
              <h4>andrew laedis</h4>
              <h5>nmims</h5>
              <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illum optio labore reiciendis atque, eius</p>
            </div>
          </div>
          <div class="all_testimonials__main__item">
            <div class="all_testimonials__main__item__img">
              <img src="http://www.aadhu.com/wp-content/uploads/2018/01/google-camera-port-with-portrait-mode-now-works-on-samsung-galaxy-s7-s8-and-note-8-exynos.jpg" alt="Image of student" />
            </div>
            <div class="all_testimonials__main__item__content">
              <h4>dazai osamu</h4>
              <h5>bharati vidyapeeth</h5>
              <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illum optio labore reiciendis atque, eius distinctio sit eveniet voluptatibus. .</p>
            </div>
          </div>
          <div class="all_testimonials__main__item">
            <div class="all_testimonials__main__item__img">
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQq1CDNNwbHat-PN5RsYZjfYMcYCLjtWo_oC3NSpHOPnv3YoJ1c" alt="Image of student" />
            </div>
            <div class="all_testimonials__main__item__content">
              <h4>kunikida</h4>
              <h5>assam downtown university</h5>
              <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illum optio labore reiciendis at.</p>
            </div>
          </div>
          <div class="all_testimonials__main__item">
            <div class="all_testimonials__main__item__img">
              <img src="http://www.chennaiportraitphotography.com/wp-content/uploads/2015/08/IMG_0013_1.jpg" alt="Image of student" />
            </div>
            <div class="all_testimonials__main__item__content">
              <h4>madara uchiha</h4>
              <h5>scdl</h5>
              <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illum optio labore reiciendis atque, eius distinctio sit.</p>
            </div>
          </div>
          <div class="all_testimonials__main__item">
            <div class="all_testimonials__main__item__img">
              <img src="https://akm-img-a-in.tosshub.com/indiatoday/images/photogallery/201708/thumb_082117102744.jpg" alt="Image of student" />
            </div>
            <div class="all_testimonials__main__item__content">
              <h4>madara uchiha</h4>
              <h5>scdl</h5>
              <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illum optio labore reiciendis atque, eius distinctio sit eveniet </p>
            </div>
          </div>
          <div class="all_testimonials__main__item">
            <div class="all_testimonials__main__item__img">
              <img src="https://media.gettyimages.com/photos/indian-defense-scientist-apj-abdul-kalam-poses-for-a-portrait-in-this-picture-id1127521?s=612x612" alt="Image of student" />
            </div>
            <div class="all_testimonials__main__item__content">
              <h4>madara uchiha</h4>
              <h5>scdl</h5>
              <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illum optio labore reiciendis atque, eius distinctio sit eveniet voluptat.</p>
            </div>
          </div>

        </div>
      </main>

    </div>
    <!-- /ALL_TESTIMONIALS -->

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
  <!-- CUSTOM JS -->
  <script src='../js/navbar.js'></script>
  <script src='../js/preloader.js'></script>

</body>
</html> 