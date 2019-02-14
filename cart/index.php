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
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
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
</head>
<body>
    <div class="main-container">
     <!-- MySQL connector -->
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

        <div class="container">
            <div class="container__header">
                <button class="container__back">BACK TO COURSES</button>
                <h1> MY COURSE CART</h1>
                <hr>
            </div>
            <div class="container__main">
                <div class="container__main__courses">
                    <div class="container__main__courses__items">
                        <div class="container__main__courses__items__img"><img src="image.jpg" alt=""></div>
                        <div class="container__main__courses__items__description">
                            <div class="container__main__courses__items__description__above">
                                <h2>MBA IN SUPPLY CHAIN</h2>
                                <p>ASSAM DOWNTOWN UNIVERSITY</p>
                            </div>
                            
                            <div class="container__main__courses__items__description__middle">
                                <p class="container__main__courses__items__description__middle__time">2 YEARS</p>
                                <p class="container__main__courses__items__description__middle__delivery">DELIVERY MODE</p>
                            </div>
                            
                            <p class="container__main__courses__items__description__cost">Rs 34,000 <span>(annual)</span></p>
                            
                        </div>
                        <button>Remove</button>
                    </div>
                    <div class="container__main__courses__items">
                        <div class="container__main__courses__items__img"><img src="image.jpg" alt=""></div>
                        <div class="container__main__courses__items__description">
                            <div class="container__main__courses__items__description__above">
                                <h2>MBA IN SUPPLY CHAIN</h2>
                                <p >ASSAM DOWNTOWN UNIVERSITY</p>
                            </div>
                            
                            <div class="container__main__courses__items__description__middle">
                                <p class="container__main__courses__items__description__middle__time">2 YEARS</p>
                                <p class="container__main__courses__items__description__middle__delivery">DELIVERY MODE</p>
                                <P>BOOKS, ONLINE SHOPPING</P>
                            </div>
                            <div class="container__main__courses__items__description__below">
                                <p class="container__main__courses__items__description__cost">Rs 34,000 <span>(annual)</span></p>
                            </div>
                            
                        </div>
                        <button>Remove</button>
                    </div>
                </div>
                <div class="container__main__checkout">
                    <div class="container__main__checkout__column">
                        <div class="container__main__checkout__row">
                            <P>MBA IN SUPPLY CHAIN</P>
                            <P class="price">Rs 34,000</P>
                        </div>
                        <div class="container__main__checkout__row">
                            <P>MBA IN HR MANAGEMENT</P>
                            <P class="price">Rs 23,000</P>
                        </div>
                    </div>
                    <hr>
                    <div class="container__main__checkout__total">
                        <div class="container__main__checkout__row">
                            <p>GRAND TOTAL</p>
                            <p class="price">Rs 57,000</p>
                        </div>
                    </div>
                    <button>CHECKOUT</button>
                </div>
            </div>
        </div>
    <!-- FOOTER -->
    <?php include '../includes/footer.php' ?>
    <!-- /FOOTER -->
    </div>
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