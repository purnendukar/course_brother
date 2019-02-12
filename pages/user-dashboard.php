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

    <!-- NAVBAR_SCROLL -->
    <?php include '../includes/navbar-main.php' ?>
    <!-- /NAVBAR_SCROLL -->

    <!-- LOGIN_REGISTER_MODALS -->
    <?php include '../includes/login-register-modal.php' ?>
    <!-- /LOGIN_REGISTER_MODALS -->


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
                <p>Kolkata, West Bengal</p>
              </div>

              <div class="dashboard__header__bg__info__appendix__item">
                <img src="../assets/svg/Icons/white/stopwatch.svg" alt="Location Icon" />
                <p>Member Since 2016</p>
              </div>
            </div>

          </div>
          
        </div>
        <div class="dashboard__header__main">
          <img src="" alt="Student Image" />
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
              <h4 class='dashboard__header__main__info__personal__name'>Lionel Messi</h4>
              <h5 class="dashboard__header__main__info__personal__occupation">Magician</h5>
              <h5 class='dashboard__header__main__info__personal__email'>leomessi@magician.com</h5>
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
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis rem quo hic facere, dignissimos dolorem. Ipsam, qui ipsum officiis cupiditate iure quis nam voluptas, reprehenderit enim expedita repellendus debitis doloribus aliquam necessitatibus asperiores voluptates. Harum fuga adipisci deleniti consectetur labore?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo, quo!</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi nemo ipsam ut, numquam adipisci ad unde vitae laborum architecto. Laboriosam! Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, possimus.</p>
          </div>

          <div id='Education' class="dashboard__content__skills__education">

            <h3>Education</h3>

            <div class="dashboard__content__skills__education__item">
              <img src="../assets/svg/Icons/red/students-cap.svg" alt="Graduation Hat" />
              <div class="dashboard__content__skills__education__item__content">
                <h6>2012 - 2014</h6>
                <div class="dashboard__content__skills__education__item__content__degree">
                  <h5>College of the Greats</h5>
                  <h6>Masters in magic</h6>
                </div>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nihil, soluta distinctio? Sed nostrum officia, voluptatem saepe ex earum veniam cum!</p>
              </div>
            </div>

            <div class="dashboard__content__skills__education__item">
              <img src="../assets/svg/Icons/red/graduate-diploma.svg" alt="Graduation Hat" />
              <div class="dashboard__content__skills__education__item__content">
                <h6>2009 - 2012</h6>
                <div class="dashboard__content__skills__education__item__content__degree">
                  <h5>College of the Aliens</h5>
                  <h6>Masters in control & balance</h6>
                </div>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nihil, soluta distinctio? Sed nostrum officia, voluptatem saepe ex earum veniam cum!</p>
              </div>
            </div>

          </div>

          <div id='WorkExperience' class="dashboard__content__skills__workexp">

            <h3>Work & Experience</h3>

            <div class="dashboard__content__skills__workexp__item">
              <div class="dashboard__content__skills__workexp__item__circle"></div>
              <div class="dashboard__content__skills__workexp__item__content">
                <div class="dashboard__content__skills__workexp__item__content__work">
                  <h5>Magician</h5>
                  <h6>FC Barcelona</h6>
                </div>
                <h6>2000 - 2099</h6>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, commodi veritatis. Asperiores ipsa est quo placeat maxime vel laudantium non!</p>
              </div>
            </div>
            
            <div class="dashboard__content__skills__workexp__item">
              <div class="dashboard__content__skills__workexp__item__circle"></div>
              <div class="dashboard__content__skills__workexp__item__content">
                <div class="dashboard__content__skills__workexp__item__content__work">
                  <h5>Control Freak</h5>
                  <h6>Argentina</h6>
                </div>
                <h6>2010 - 2019</h6>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, commodi veritatis. Asperiores ipsa est quo placeat maxime vel laudantium non!</p>
              </div>
            </div>  

          </div>

          <div id='ProfessionalSkills' class="dashboard__content__skills__proskills">

            <h3>Professional Skills</h3>

            <div class="dashboard__content__skills__proskills__items">
              <div class="dashboard__content__skills__proskills__item">
                <i class="fas fa-award"></i>
                <h6>Magic</h6>
              </div>
              
              <div class="dashboard__content__skills__proskills__item">
                <i class="fas fa-award"></i>
                <h6>Control</h6>
              </div>

              <div class="dashboard__content__skills__proskills__item">
                <i class="fas fa-award"></i>
                <h6>Balance</h6>
              </div>
            </div>

          </div>

          <div id='Awards' class="dashboard__content__skills__awards">

            <h3>Awards</h3>

            <div class="dashboard__content__skills__awards__item">
              <div class="dashboard__content__skills__awards__item__circle"></div>
              <div class="dashboard__content__skills__awards__item__content">
                <div class="dashboard__content__skills__awards__item__content__work">
                  <h5>Top Scorer La Liga</h5>
                </div>
                <h6>JAN 2019</h6>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, commodi veritatis. Asperiores ipsa est quo placeat maxime vel laudantium non!</p>
              </div>
            </div>
            
            <div class="dashboard__content__skills__awards__item">
              <div class="dashboard__content__skills__awards__item__circle"></div>
              <div class="dashboard__content__skills__awards__item__content">
                <div class="dashboard__content__skills__awards__item__content__work">
                  <h5>Most assists in La Liga</h5>
                </div>
                <h6>FEB 2019</h6>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, commodi veritatis. Asperiores ipsa est quo placeat maxime vel laudantium non!</p>
              </div>
            </div>  

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
                <h5>5 - 10 Years</h5>
              </div>
            </div>

            <div class="dashboard__content__overview__item">
              <i class='fas fa-hourglass-half'></i>
              <div class="dashboard__content__overview__item__content">
                <h5>Age</h5>
                <h5>31 Years</h5>
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
                <h5>Male</h5>
              </div>
            </div>

            <div class="dashboard__content__overview__item">
              <i class="fas fa-language"></i>
              <div class="dashboard__content__overview__item__content">
                <h5>Language</h5>
                <h5>Spanish, English</h5>
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

</body>
</html> 