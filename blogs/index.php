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

	<style>
		.accordion {
			background-color: #de4651;
			color: white;
			cursor: pointer;
			padding: 18px;
			width: 60%;
			border: none;
			text-align: left;
			outline: none;
			font-size: 15px;
			transition: 0.4s;
			border-bottom:1px solid white;
		}

		.active, .accordion:hover {
			background-color: #ccc;
		}

		.panel {
			padding: 0 18px;
			background-color: white;
			max-height: 0;
			overflow: hidden;
			transition: max-height 0.2s ease-out;
		}
		.panel .month{
			margin:10px;
			font-size:13px;
			display:block;
			text-decoration:none;
		}
	</style>

</head>
<body>
	<div class="main-container">
		
		<!-- MySQL connector --!>
		<?php
			include "../includes/mysql_connect.php";
			$conn=connect_mysql();
		?>
		<!-- LOGIN_REGISTER_MODALS -->
    <?php if(!(isset($_COOKIE['email']))){ include '../includes/login-register-modal.php'; } ?>
    <!-- /LOGIN_REGISTER_MODALS -->

		<!-- NEWSLETTER_POPUP -->
		<?php include '../includes/newsletter-popup.php'; ?>
		<!-- NEWSLETTER_POPUP -->

		<!-- NAVBAR_MAIN -->
		<?php include '../includes/navbar-main.php' ?>
		<!-- /NAVBAR_MAIN -->

		<div class="container">
			<div class="siema">
				<?php $res=$conn->query("SELECT * FROM `blogs` ORDER BY `read_count` DESC");
					$count_t=0;
					while($row=$res->fetch_assoc()){
					    if($count_t>=3){
					        break;
					    }
				?>
					<div class="siema__image">
						<img src=".<?php echo $row['thumnail']; ?>" alt="">
						<div class="siema__text">
							<h1 ><?php echo $row['heading'];?></h1>
							<p><?php echo substr(str_replace('<br>','',$row['content']),0,60)."..."; ?></p>
							<button class="siema__image__button" onclick="window.location.href='./blog-detail?id=<?php echo $row['id'];?>'" >Read</button>
						</div>
					</div>
				<?php 
						$count_t+=1;
					}
				?>
			</div>
			<button class="next"><i class="fas fa-chevron-right"></i></button>
			<button class="prev"><i class="fas fa-chevron-left"></i></button>
		</div>
		

		<div class="main">
			<div class="main__contents">
				<?php $res=$conn->query("select * from blogs limit 12");
				while($row=$res->fetch_assoc()){
				?>
				<div class="main__contents__snippets">
					<img src="<?php echo ".".$row['thumnail']?>" alt="Blog Image">
					<a href="./blog-detail?id=<?php echo $row['id'];?>"><h3><?php echo $row['heading']?></h3></a>
					
					<p><?php echo substr(str_replace('<br>','',$row['content']),0,60)."... <a style='color:red;' href='./blog-detail?id=".$row["id"]."'>Read More</a>";?></p>
				
				</div>
				<?php } ?>
				<div style="display:block;width:100%;margin:20px;">
					Page: 
					<?php $p=(int)$conn->query("select count(*) as c from blogs")->fetch_assoc()['c']; 
						for($i=1;$i<=(int)($p+12)/12;$i++){
							echo "<a style='text-decoration:none;margin:10px;' href='javascript:select_page(".$i.");'>".$i."</a> ";
						}
					?>
				</div>
			</div>
			
			<div class="main__sidebar">
				<div class="main__sidebar__side">
					<h2>Archive Blog</h2>
					<?php 
					$years=array();
					$res_year=$conn->query("select distinct(year(created)) as years from blogs order by years desc");
					while($row=$res_year->fetch_assoc()){
						?><div class="accordion"><?php echo $row['years'];?></div>
						<div class="panel">
							<a class="month" href="javascript:show_blog('<?php echo $row['years']; ?>','01')">January</a>
							<a class="month" href="javascript:show_blog('<?php echo $row['years']; ?>','02')">February</a>
							<a class="month" href="javascript:show_blog('<?php echo $row['years']; ?>','03')">March</a>
							<a class="month" href="javascript:show_blog('<?php echo $row['years']; ?>','04')">April</a>
							<a class="month" href="javascript:show_blog('<?php echo $row['years']; ?>','05')">May</a>
							<a class="month" href="javascript:show_blog('<?php echo $row['years']; ?>','06')">June</a>
							<a class="month" href="javascript:show_blog('<?php echo $row['years']; ?>','07')">July</a>
							<a class="month" href="javascript:show_blog('<?php echo $row['years']; ?>','08')">August</a>
							<a class="month" href="javascript:show_blog('<?php echo $row['years']; ?>','09')">September</a>
							<a class="month" href="javascript:show_blog('<?php echo $row['years']; ?>','10')">September</a>
							<a class="month" href="javascript:show_blog('<?php echo $row['years']; ?>','11')">November</a>
							<a class="month" href="javascript:show_blog('<?php echo $row['years']; ?>','12')">December</a>
						</div>
						<p style="width:70%; margin-bottom:5px;"><?php echo "<a href='./blog-detail?id=' style='text-decoration:none;'></a>";?></p>
					<?php $count_t += 1; } ?>
				</div>
				<!-- <hr>
				<div class="main__sidebar__social">
					<h2>Connect with us</h2>
					<div class="main__sidebar__social__bar">
						<li><a id="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
						<li><a  id="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
						<li><a id="instagram" href="#"><i class="fab fa-instagram"></i></a></li>
						<li><a id="linkedIn" href="#"><i class="fab fa-linkedin-in"></i></a></li>
					</div>
					
				</div> -->
				<!-- <hr>
				<div class="main__sidebar__tagbar">
					<h2>Tags</h2>
					<div class="main__sidebar__tagbar__tags">
						<div><a href="">javascript</a></div>
						<div><a href="">mongoDB</a></div>
						<div><a href="">React</a></div>
						<div><a href="">Ruby & Rails & a bit of javascript</a></div>
					</div>	
				</div> -->
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
                }
        });
    }, 1000);
    </script>
	<script src="app.js"></script>
	<script>
	var acc = document.getElementsByClassName("accordion");
	var i;

	for (i = 0; i < acc.length; i++) {
		acc[i].addEventListener("click", function() {
			this.classList.toggle("active");
			var panel = this.nextElementSibling;
			if (panel.style.maxHeight){
				panel.style.maxHeight = null;
			} else {
				panel.style.maxHeight = panel.scrollHeight + "px";
			} 
		});
	}
	function show_blog(year,month){
		main__contents=document.getElementsByClassName("main__contents")[0];
		if (window.XMLHttpRequest) {
    	// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp = new XMLHttpRequest();
		} else {
      // code for IE6, IE5
		  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				main__contents.innerHTML = this.responseText;
			}
    };
		xmlhttp.open("GET","get_detail?y="+year+"&m="+month);
    xmlhttp.send();
	}
	function select_page(p){
		main__contents=document.getElementsByClassName("main__contents")[0];
		if (window.XMLHttpRequest) {
    	// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp = new XMLHttpRequest();
		} else {
      // code for IE6, IE5
		  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				main__contents.innerHTML = this.responseText;
			}
    };
		xmlhttp.open("GET","page_blog?p="+p);
    xmlhttp.send();
	}
	</script>
</body>
</html>