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
	<title>Blogs</title>
	<link rel="stylesheet" href="styles.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/siema@1.5.1/dist/siema.min.js"></script>

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
</head>
<body>
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

		<div class="container">
			<div class="siema">
				<div class="siema__image">
					<img src="images/image3.jpeg" alt="">
					<div class="siema__text">
						<h1>Give me money, I will give you Honey</h1>
						<p>Contrary to popular belief, Lorem Ipsum is not.</p>
						<button class="siema__image__button">Read</button>
					</div>
				</div>
				<div class="siema__image">
					<img src="images/image2.jpeg" alt="">
					<div class="siema__text">
						<h1>Give me money, I will give you Honey</h1>
						<p>Contrary to popular belief, Lorem Ipsum is not.</p>
						<button class="siema__image__button">Read</button>
					</div>
				</div>
				<div class="siema__image">
					<img src="images/image1.jpeg" alt="">
					<div class="siema__text">
						<h1>Give me money, I will give you Honey</h1>
						<p>Contrary to popular belief, Lorem Ipsum is not.</p>
						<button class="siema__image__button">Read</button>
					</div>
				</div>
		
			</div>
			<button class="next"><i class="fas fa-chevron-right"></i></button>
			<button class="prev"><i class="fas fa-chevron-left"></i></button>
		</div>
		

		<div class="main">
			<div class="main__contents">
				<?php $res=$conn->query("select * from blogs");
				while($row=$res->fetch_assoc()){
				?>
				<div class="main__contents__snippets">
					<img src="<?php echo ".".$row['thumnail']?>" alt="Blog Image">
					<a href=""><h3><?php echo $row['heading']?></h3></a>
					
					<p><?php echo substr(str_replace('<br>','',$row['content']),0,60)."<a href='#'>...Read More</a>";?></p>
				
				</div>
				<?php } ?>
				
			</div>
			<div class="main__sidebar">
				<div class="main__sidebar__side">
					<h2>Popular Blogs</h2>
					<?php $res=$conn->query("SELECT * FROM `blogs` ORDER BY `read_count` DESC");
					$count=0;
					while($count<5 && $row=$res->fetch_assoc()){
					?>
						<p style="width:70%; margin-bottom:5px;"><?php echo "<a href='#' style='text-decoration:none;'>".$row['heading']."</a>";?></p>
					<?php $count+=1; } ?>
				</div>
				<hr>
				<div class="main__sidebar__social">
					<h2>Connect with us</h2>
					<div class="main__sidebar__social__bar">
						<li><a id="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
						<li><a  id="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
						<li><a id="instagram" href="#"><i class="fab fa-instagram"></i></a></li>
						<li><a id="linkedIn" href="#"><i class="fab fa-linkedin-in"></i></a></li>
					</div>
					
				</div>
				<hr>
				<div class="main__sidebar__tagbar">
					<h2>Tags</h2>
					<div class="main__sidebar__tagbar__tags">
						<div><a href="">javascript</a></div>
						<div><a href="">mongoDB</a></div>
						<div><a href="">React</a></div>
						<div><a href="">Ruby & Rails & a bit of javascript</a></div>
					</div>	
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
	
    <script src="../js/preloader.js"></script>
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
	<script src="app.js"></script>
</body>
</html>