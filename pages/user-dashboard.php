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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- ANIMATE CSS -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css' />

  <!-- CUSTOM CSS -->
  <link rel='stylesheet' href='../styles/style.css' />

  <title>CourseBrother.com | User Dashboard</title>
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
    <!-- NAVBAR_SCROLL -->
    <?php include '../includes/navbar-main.php' ?>
    <!-- /NAVBAR_SCROLL -->

    <?php 
      if(!(isset($_COOKIE['email']))){
        header("Location:../index.php");
      }
    ?>
    <?php $user=$conn->query("SELECT * FROM `register_user` WHERE email='".$_COOKIE['email']."'")->fetch_assoc(); ?>
    <?php $user_info=$conn->query("select * from user_info where email='".$_COOKIE['email']."'")->fetch_assoc();?>
    <!-- USER_DASHBOARD -->
    <div class="user_dashboard">

      <!-- DASHBOARD_HEADER -->
      <div class="dashboard__header">
        <div class="dashboard__header__bg">

          <div class="dashboard__header__bg__circle"></div>
          <div class="dashboard__header__bg__info">

            <div class="dashboard__header__bg__info__id">
              <b>ID</b>: ad56ww0pqzqt
            </div>

            <div class="dashboard__header__bg__info__appendix">
              <div class="dashboard__header__bg__info__appendix__item">
                <img src="../assets/svg/Icons/white/maps-and-flags.svg" alt="Location Icon" />
                <p><?php echo $user['city'];?></p>
              </div>

              <div class="dashboard__header__bg__info__appendix__item">
                <img src="<?php if(isset($user_info['img_src'])){echo $user_info['img_src'];}else{echo "../assets/svg/Icons/white/stopwatch.svg";}?>" alt="Location Icon" />
                <p>Member Since <?php $since=new DateTime($user['created']); echo $since->format("Y");?></p>
              </div>
            </div>

          </div>
          
        </div>
        <div class="dashboard__header__main">
          <img src="../assets/svg/Icons/white/user.svg" alt="Student Image" />
          <div class="dashboard__header__main__info">

            <div class="dashboard__header__main__info__media">
              <div class="dashboard__header__main__info__media__item">
                <a href="#"><i class="fab fa-twitter"></i></a>
              </div>
              <div class="dashboard__header__main__info__media__item">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
              </div>
              <div class="dashboard__header__main__info__media__item">
                <a href="#"><i class="fab fa-google"></i></a>
              </div>
            </div>
            <div class="dashboard__header__main__info__personal">
              <h4 class='dashboard__header__main__info__personal__name'><?php echo $user['f_name']." ".$user['l_name']; ?></h4>
              <h5 class="dashboard__header__main__info__personal__occupation"><?php if(isset($user_info['occupation'])){echo ucwords($user_info['occupation']);}?></h5>
              <h5 class='dashboard__header__main__info__personal__email'><?php echo $user['email'];?></h5>
            </div>
            <div class="dashboard__header__main__info__cv">
              <button>Download CV &nbsp; <i class='fa fa-arrow-down'></i></button>
            </div>

          </div>

          <div class="dashboard__header__main__navbar">
            <ul>
              <li><a href="">Candidate About</a></li>
              <li><a href="">Education</a></li>
              <li><a href="">Work Experience</a></li>
              <li><a href="">Professional Skills</a></li>
              <li><a href="">Awards</a></li>
            </ul>
          </div>

        </div>
      </div>
      <!-- /DASHBOARD_HEADER -->

      <!-- DASHBOARD__CONTENT -->
      <div class="dashboard__content">
        
        <!-- DASHBOARD_SKILLS -->
        <div class="dashboard__content__skills">

          <div id='CandidateAbout' class="dashboard__content__skills__about">
            <h3>Candidate's About</h3>
            <p><?php echo $user_info['about']; ?></p>
          </div>

          <div id='Education' class="dashboard__content__skills__education">

            <h3>Education</h3>
            <?php $user_edu=$conn->query("SELECT * FROM `user_education` where email='".$_COOKIE['email']."'");
            while($edu_row=$user_edu->fetch_assoc()){
            ?>
            <div class="dashboard__content__skills__education__item">
              <img src="../assets/svg/Icons/red/students-cap.svg" alt="Graduation Hat" />
              <div class="dashboard__content__skills__education__item__content">
                <h6><?php echo $edu_row['join_year'];?> - <?php echo $edu_row['complete_year'];?></h6>
                <div class="dashboard__content__skills__education__item__content__degree">
                  <h5><?php echo $edu_row['organisation'];?></h5>
                  <h6><?php echo $edu_row['degree'];?></h6>
                </div>
                <p><?php echo $edu_row['about'];?></p>
              </div>
            </div>
            <?php } ?>
            <!-- <div class="dashboard__content__skills__education__item">
              <img src="../assets/svg/Icons/red/graduate-diploma.svg" alt="Graduation Hat" />
              <div class="dashboard__content__skills__education__item__content">
                <h6>2009 - 2012</h6>
                <div class="dashboard__content__skills__education__item__content__degree">
                  <h5>College of the Aliens</h5>
                  <h6>Masters in control & balance</h6>
                </div>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nihil, soluta distinctio? Sed nostrum officia, voluptatem saepe ex earum veniam cum!</p>
              </div>
            </div> -->

          </div>

          <div id='WorkExperience' class="dashboard__content__skills__workexp">

            <h3>Work & Experience</h3>
            <?php $user_exp=$conn->query("SELECT * FROM `user_work_exp` where email='".$_COOKIE['email']."'");
            while($exp_row=$user_exp->fetch_assoc()){
            ?>
            <div class="dashboard__content__skills__workexp__item">
              <div class="dashboard__content__skills__workexp__item__circle"></div>
              <div class="dashboard__content__skills__workexp__item__content">
                <div class="dashboard__content__skills__workexp__item__content__work">
                  <h5><?php echo $exp_row['position'];?></h5>
                  <h6><?php echo $exp_row['company_name'];?></h6>
                </div>
                <h6><?php echo $exp_row['start_date'];?> - <?php echo $exp_row['end_date']?></h6>
                <p><?php echo $exp_row['about_work'];?></p>
              </div>
            </div>
            <?php } ?>
             

          </div>

          <div id='ProfessionalSkills' class="dashboard__content__skills__proskills">

            <h3>Professional Skills</h3>

            <div class="dashboard__content__skills__proskills__items">
              <?php $temp=explode(",",$user_info['skills']);
              for($i=0;$i<count($temp);$i++){
              ?>
              <div class="dashboard__content__skills__proskills__item">
                <i class="fas fa-award"></i>
                <h6><?php echo $temp[$i];?></h6>
              </div>
              <?php } ?>
            </div>

          </div>

          <div id='Awards' class="dashboard__content__skills__awards">

            <h3>Awards</h3>
            <?php $user_award=$conn->query("select * from user_award where email='".$_COOKIE['email']."'");
            while($award_row=$user_award->fetch_assoc()){
            ?>
            <div class="dashboard__content__skills__awards__item">
              <div class="dashboard__content__skills__awards__item__circle"></div>
              <div class="dashboard__content__skills__awards__item__content">
                <div class="dashboard__content__skills__awards__item__content__work">
                  <h5><?php echo $award_row['award'];?></h5>
                </div>
                <h6><?php echo $award_row['award_date'];?></h6>
                <p><?php echo $award_row['about'];?></p>
              </div>
            </div>
            <?php } ?>

          </div>

        </div>
        <!-- /DASHBOARD_SKILLS -->

        <!-- DASHBOARD_OVERVIEW -->
        <div class="dashboard__content__overview">

          <h3>Candidate Overview</h3>

          <div class="dashboard__content__overview__container">

            <div class="dashboard__content__overview__item">
              <i class='fas fa-sliders-h'></i>
              <div class="dashboard__content__overview__item__content">
                <h5>Experience</h5>
                <h5><?php echo $user_info['experience']?></h5>
              </div>
            </div>

            <div class="dashboard__content__overview__item">
              <i class='fas fa-hourglass-half'></i>
              <div class="dashboard__content__overview__item__content">
                <h5>Age</h5>
                <h5><?php $now=new DateTime(); $dob=new DateTime($user_info['dob']); echo $now->diff($dob)->y;?></h5>
              </div>
            </div>
            
            <div class="dashboard__content__overview__item">
              <i class="far fa-money-bill-alt"></i>
              <div class="dashboard__content__overview__item__content">
                <h5>Current Salary</h5>
                <h5>57 million</h5>
              </div>
            </div>

            <div class="dashboard__content__overview__item">
              <i class='fas fa-chart-line'></i>
              <div class="dashboard__content__overview__item__content">
                <h5>Expected Salary</h5>
                <h5>100 million</h5>
              </div>
            </div>

            <div class="dashboard__content__overview__item">
              <i class="fas fa-transgender"></i>
              <div class="dashboard__content__overview__item__content">
                <h5>Gender</h5>
                <h5><?php echo ucwords($user_info['gender'])?></h5>
              </div>
            </div>

            <div class="dashboard__content__overview__item">
              <i class="fas fa-language"></i>
              <div class="dashboard__content__overview__item__content">
                <h5>Language</h5>
                <h5><?php echo ucwords($user_info['language'])?></h5>
              </div>
            </div>

          </div>

        </div>
        <!-- /DASHBOARD_OVERVIEW -->

      </div>
      <!-- /DASHBOARD__CONTENT -->

    </div>
    <!-- /USER_DASHBOARD -->
    

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
  <script src='../js/userDashboard.js'></script>
  <script src="../js/preloader.js"></script>

</body>
</html> 