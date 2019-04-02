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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- ANIMATE CSS -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css' />

  <!-- CUSTOM CSS -->
  <link rel='stylesheet' href='../styles/style.css' />

  <title>CourseBrother.com | Legal Policy</title>
</head>
<body>


  <!-- MAIN_CONTAINER -->
  <div class="main-container">

    <!-- MySQL connector --!>
    <?php
        include "../includes/mysql_connect.php";
        $conn=connect_mysql();
    ?>

    <!-- NAVBAR_SCROLL -->
    <?php include '../includes/navbar-main.php' ?>
    <!-- /NAVBAR_SCROLL -->

    <!-- LOGIN_REGISTER_MODALS -->
    <?php include '../includes/login-register-modal.php' ?>
    <!-- /LOGIN_REGISTER_MODALS -->

    <!-- NEWS_EVENTS -->
    <div class="news_events">

      <div class="news_events__header">
        <h3 class='news_events__header__title'>news and events</h3>
      </div>
        <?php $row=$conn->query("select * from news_update where id=".$_GET['id'])->fetch_assoc();?>
      <div class="news_events__main">
        <div class="news_events__main__head">
          <h4><?php echo urldecode($row['heading']); ?></h4>
          <h5 style="color:white;"><?php echo urldecode($conn->query("select * from universities where u_id=".$row['u_id'])->fetch_assoc()['u_name']);?></h5>
          <h6><?php echo implode('-',array_reverse(explode('-',explode(' ',$row['created'])[0])));?> </h6>
        </div>
        <div class="news_events__main__share">
          share update &nbsp;
          <i class='fas fa-share'></i>
        </div>
        <div class="news_events__main__content">
          <p>
            <?php echo urldecode($row['content']);?>
          </p>
        </div>
      </div>
        <?php $res=$conn->query("select * from news_update where u_id=".$row['u_id']." and id!=".$_GET['id']." ORDER BY created DESC");
        if($row1=$res->fetch_assoc()){
        ?>
        <div class="news_events__more_updates">
            <h4 class="news_events__more_updates__title">more updates</h4>
            <div class="news_events__more_updates__container">
            <div class="news_events__more_updates__item" onclick="window.location.href='./news-updates?id=<?php echo $row1['id']?>'">
                <h3><?php echo urldecode($row1['heading'])?></h3>
                <h4><?php echo implode('-',array_reverse(explode('-',explode(' ',$row1['created'])[0])));?></h4>
                <h5><?php echo substr(urldecode($row1['content']),0,130)."...<b>Read more</b>"; ?></h5>
            </div>
            <?php $c=0;
                while($c<2 ){
                    $row1=$res->fetch_assoc();
            ?>
                    <div class="news_events__more_updates__item" onclick="window.location.href='./news-updates?id=<?php echo $row1['id']?>'">
                        <h3><?php echo urldecode($row1['heading']);?></h3>
                        <h4><?php echo implode('-',array_reverse(explode('-',explode(' ',$row1['created'])[0])));?></h4>
                        <h5><?php echo substr(urldecode($row1['content']),0,130)."...<b>Read more</b>"; ?></h5>
                    </div>
            <?php
                    $c++;
                }
            ?>
            </div>
        </div>
        <?php } ?>

    </div>
    <!-- /NEWS_EVENTS -->

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
  <!-- CUSTOM JS -->
  <script src='../js/navbar.js'></script>
  <script src='../js/preloader.js'></script>

</body>
</html>  