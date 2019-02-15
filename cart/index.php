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
    <script>
      function remove_cart(a){
        var f=new FormData();
        f.append('id',a);
        $.ajax({
          url: "./cart_remove.php",
          type: 'POST',
          cache: false,
          contentType: false,
          processData: false,
          data: f,
          complete: function (data) {
            console.log(data.responseText);
            if(data.responseText=='1'){
              alert("Item Removed");
              document.getElementById('item'+a).style.display="none";
              document.getElementById('item_checkout'+a).style.display="none";
            }else{
              alert("Something went wrong submit again");
            }
            var t= document.getElementsByClassName("price");
              var sum=0;
            var temp=document.getElementsByClassName("container__main__checkout__row");
              for(var i=0;i<t.length-1;i++){
                if(temp[i].style.display!="none"){
                  sum+=parseInt(t[i].innerHTML.replace("Rs ",''));
                }
              }
              document.getElementById("grand_total").innerHTML="Rs "+sum;
          }
        });
      }
    </script>
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
                <button class="container__back" onclick="window.location.href='../pages/course-results'">BACK TO COURSES</button>
                <h1> MY COURSE CART</h1>
                <hr>
            </div>
            <?php
              if(isset($_COOKIE['email'])){
                $cart=$conn->query("select * from user_cart where email='".$_COOKIE['email']."'");
            ?>
            <div class="container__main">
                <div class="container__main__courses">
                  <?php if($cart->num_rows){
                    while($cart_row=$cart->fetch_assoc()){
                    $detail=$conn->query("select * from full_detail where id=".$cart_row['f_id'])->fetch_assoc();
                  ?>
                    <div class="container__main__courses__items" id="item<?php echo $cart_row['id'];?>">
                        <div class="container__main__courses__items__img"><img src="<?php echo ".".$conn->query("select * from universities where u_id=".$detail['u_id'])->fetch_assoc()['img_src'];?>" alt="University Image"></div>
                        <div class="container__main__courses__items__description">
                            <div class="container__main__courses__items__description__above">
                                <h2><?php echo $conn->query("select * from courses where id=".$detail['c_id'])->fetch_assoc()['c_name']." IN ".$conn->query("select * from subject where id=".$detail['s_id'])->fetch_assoc()['sub_name']; ?></h2>
                                <p><?php echo $conn->query("select * from universities where u_id=".$detail['u_id'])->fetch_assoc()['u_name']; ?></p>
                            </div>

                            <div class="container__main__courses__items__description__middle">
                                <p class="container__main__courses__items__description__middle__time"><?php if($detail['duration']>1){echo $detail['duration']." YEARS";}else{echo $detail['duration']." YEAR";}?></p>
                                <p class="container__main__courses__items__description__middle__delivery">DELIVERY MODE</p>
                            </div>

                            <p class="container__main__courses__items__description__cost">Rs <?php echo $detail['fees']; ?> <span>(Full fees)</span></p>

                        </div>
                        <button onclick="remove_cart('<?php echo $cart_row['id'];?>')">Remove</button>
                    </div>
                  <?php }
                    }else{
                    echo "<div style='padding-bottom:100px;'>Cart is Empty</div>";
                  }?>
                </div>
                <div class="container__main__checkout">
                  <?php if(isset($_COOKIE['email'])){
                    $cart=$conn->query("select * from user_cart where email='".$_COOKIE['email']."'");
                    if($cart->num_rows){
                      $total_=0;
                  ?>
                    <div class="container__main__checkout__column">
                      <?php while($cart_row=$cart->fetch_assoc()){
                      $detail=$conn->query("select * from full_detail where id=".$cart_row['f_id'])->fetch_assoc();
                      $total_+=$detail['fees'];
                      ?>
                        <div class="container__main__checkout__row" id="item_checkout<?php echo $cart_row['id'];?>">
                            <p><?php echo $conn->query("select * from courses where id=".$detail['c_id'])->fetch_assoc()['c_name']." IN ".$conn->query("select * from subject where id=".$detail['s_id'])->fetch_assoc()['sub_name']."<br>(".$conn->query("select * from universities where u_id=".$detail['u_id'])->fetch_assoc()['u_name'].")"; ?></p>
                            <p class="price">Rs <?php echo $detail['fees']; ?></p>
                        </div>
                      <?php }?>
                    </div>

                    <hr>
                    <div class="container__main__checkout__total">
                        <div class="container__main__checkout__row">
                            <p>GRAND TOTAL</p>
                            <p class="price" id="grand_total">Rs <?php echo $total_;?></p>
                        </div>
                    </div>
                    <button>CHECKOUT</button>
                  <?php }else{
                      echo "Cart is Empty";
                    }}?>
                </div>
            </div>
          <?php } else{
            echo "<div style='padding:50px; width:100%;'></div>
            <script>
              alert('Login to see your cart');
              const loginButton = document.querySelector('.navbar_main__appendix__login');
              const loginModal = document.querySelector('.login_modal');
              const loginModalBackdrop = document.querySelector('.login_modal__backdrop');
              const loginModalClose = document.querySelector('.login_modal__close');
              loginModalBackdrop.classList.add('login_modal__backdrop--active');
              loginModal.classList.add('login_modal--active');
            </script>";
          }?>
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
