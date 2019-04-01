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

  <title>CourseBrother.com | When we were almost caught doing bank fraud</title>
</head>
<body>
  
  
  <!-- MAIN_CONTAINER -->
  <div class="main-container">

    <?php
        include "../includes/mysql_connect.php";
        $conn=connect_mysql();
    ?>
    <!-- NAVBAR_MAIN -->
    <?php include '../includes/navbar-main.php' ?>
    <!-- /NAVBAR_MAIN -->

    <!-- LOGIN_REGISTER_MODALS -->
    <?php include '../includes/login-register-modal.php' ?>
    <!-- /LOGIN_REGISTER_MODALS -->

    <?php $id=$_GET['id'];
      $row=$conn->query("select * from blogs where id=".$id)->fetch_assoc();
    ?>
    <!-- BLOG_DETAIL -->
    <main class="blog_detail">

      <div class="blog_detail__header" style="background:url('<?php echo $d.$row['title_bg']; ?>');background-size: cover;background-position: center;">
        <div class="blog_detail__header__title">
          <h1><?php echo $row['heading'];?></h1>
        </div>
        <div class="blog_detail__footer">
          <div class="blog_detail__footer__desc">
            <h4>by <b><?php echo $row['author'];?></b></h4>
            <h5><b><?php $d=explode('-',explode(' ',$row['updated'])[0]);echo $d[2]."-".$d[1]."-".$d[0]; ?><b></h5>
          </div>
          <div class="blog_detail__footer__share">
            <h5 class="blog_detail__footer__share__item">share on facebook</h5>
            <h5 class="blog_detail__footer__share__item">tweet on twitter</h5>
          </div>
        </div>
      </div>

      <div class="blog_detail__main">

        <div class="blog_detail__content">
          <div class="blog_detail__content__para1">
            <p>
              <?php echo $row['content'];?>
            </p>
            <?php if($row['img_src']!=null){?>
              <div class="blog_detail__content__image">
                <img src=".<?php echo $row['img_src'];?>" alt="Not Loaded"/>
              </div>
            <?php } ?>
            <p>
              <?php if($row['content_2']!=null){echo $row['content_2'];};?>
            </p>
          </div>
          <div class="blog_detail__content__sep"></div>
        </div>

        <div class="blog_detail__aside">
          <?php $res=$conn->query("select * from sponsor_course");
            while($row=$res->fetch_assoc()){
          ?>
          <div class="blog_detail__aside__ad" style="height:auto;">
            <img src=".<?php echo $row['img_src']?>" onclick="window.open('<?php echo $row['link']?>');" style="width:100%;display:block;"/>
          </div>
          <?php } ?>
        </div>

      </div>

      <div class="blog_detail__see_more">

        <h4 class='blog_detail__see_more__title'>you may also like</h4>
        <div class="blog_detail__see_more__items">
        <?php $n=0; 
        $row_1=$conn->query("SELECT * FROM blogs ORDER BY RAND() LIMIT 1")->fetch_assoc();
        ?>
          <div class="blog_detail__see_more__item" onclick="window.location.href='./blog-detail?id=<?php echo $row_1['id'];?>'">
            <img src=".<?php echo $row_1['thumnail']?>" alt="" />
            <div class="blog_detail__see_more__item__title">
              <h5><?php echo $row_1['heading']; ?></h5>
            </div>
          </div>
          <?php
            $row_2=$conn->query("SELECT * FROM blogs ORDER BY RAND() LIMIT 1")->fetch_assoc();
          ?>
          <div class="blog_detail__see_more__item" onclick="window.location.href='./blog-detail?id=<?php echo $row_2['id'];?>'">
            <img src=".<?php echo $row_2['thumnail']?>" alt="" />
            <div class="blog_detail__see_more__item__title">
              <h5><?php echo $row_2['heading']; ?></h5>
            </div>
          </div>

        </div>

      </div>

    </main>
    <!-- /BLOG_DETAIL -->

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
  <!-- WOW JS -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js'></script>
  <!-- CUSTOM JS -->
  <script src='../js/navbar.js'></script>
  <!-- TweenMax -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>
  <script src="../js/preloader.js"></script>

</body>
</html> 