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
        <?php $res=$conn->query("SELECT * FROM `testimonial`")?>
        <div class="all_testimonials__main__container">
          <?php while($row=$res->fetch_assoc()){?>
          <div class="all_testimonials__main__item">
            <div class="all_testimonials__main__item__img">
              <img src="<?php echo ".".$row['img_src']?>" alt="Image Can't Load" />
            </div>
            <div class="all_testimonials__main__item__content">
              <h4><?php echo urldecode($row['head']);?></h4>
              <h5><?php echo urldecode($row['para']);?></h5>
              <p><?php echo urldecode($row['about']);?></p>
            </div>
          </div>
          <?php } ?>
          
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