<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="assets\images\favicon.png" type="image/png" />

  <!-- NORMALIZE CSS -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css' />

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:100,300,400,500,600,700" rel="stylesheet">

  <!-- FONTAWESOME -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' />

  <!-- jQuery Plugins -->

  <!-- RESPONSIVE SLIDES -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ResponsiveSlides.js/1.55/responsiveslides.min.css" />

  <!-- TOOLTIPSTER -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/css/tooltipster.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/css/themes/tooltipster-shadow.min.css' />

  <!-- ANIMATE CSS -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css' />

  <!-- CUSTOM CSS -->
  <link rel='stylesheet' href='./styles/style.css' />
    


  <title>CourseBrother.com | One Stop Destination for Learning</title>
</head>
<body>
    
  <!-- MySQL connector --!>
  <?php
        include "./includes/mysql_connect.php";
        $conn=connect_mysql();
    ?>
<?php ?>

  <!-- MAIN CONTAINER -->
  <div class="main-container">


    <!-- NEWSLETTER_POPUP -->
    <?php include 'includes/newsletter-popup.php'; ?>
    <!-- NEWSLETTER_POPUP -->
    

    <!-- BACK_TO_TOP -->
    <?php include 'includes/back-to-top.php'; ?>
    <!-- /BACK_TO_TOP -->

    <!-- LOGIN_REGISTER_MODALS -->
    <?php include 'includes/login-register-modal.php' ?>
    <!-- /LOGIN_REGISTER_MODALS -->
      
    <!-- NAVBAR_MAIN -->
    <?php include './includes/navbar-main.php' ?>
    <!-- /NAVBAR_MAIN -->


    <!-- HEADER -->
    <div class="header">

      <div class="header__testimonial">
        <a href="./pages/all-testimonials.php">
          <ul class="rslides header__testimonial__slides">
            <?php 
              $res=$conn->query("select * from testimonial");
                while($row=$res->fetch_assoc()){
              ?>
            <li class='header__testimonial__slides__item'>
              <div class="header__testimonial__slides__item__overlay"></div>
              <img src="<?php echo $row['img_src']; ?>" alt="Sky Scrapers" />
              <div class="header__testimonial__slides__item__content">
                <h4><?php echo urldecode($row['head']);?></h4>
                <h5><?php echo urldecode($row['para']); ?></h5>
                <div class="header__testimonial__slides__item__sep"></div>
                <p><?php echo urldecode($row['about']); ?></p>
              </div>
            </li>
              <?php } ?>
            </ul>
        </a>
      </div>
        <div class="header__carousel">
        <div class="header__carousel__container siema">
            <?php
                $res=$conn->query("select * from slide_show");
                while($row=$res->fetch_assoc()){
            ?>
            <div class="header__carousel__item">
            <img src="<?php echo $row['image_src'];?>" alt="Not able to load image due to some reason" />
            <div class="header__carousel__item__content">
              <h4><?php echo urldecode($row['head']); ?></h4>
              <div class="header__carousel__item__content__sep"></div>
              <button><a href="#">know more</a></button>
            </div>
          </div>
            <?php } ?>
        </div>

        <div class="header__carousel__buttons">
        </div>
      </div>

    </div>
    <!-- /HEADER -->


    <!-- UNIVERSITIES_COLLEGES -->
    <div class="uni_and_col">

      <div class="uni_and_col__title">trusted by 10+ universities & colleges</div>
        
      <ul class="rslides ">
          <?php $sql="select * from universities";
                $res=$conn->query($sql);
          $count=0; // for <li> 
            while($row=$res->fetch_assoc()){
                if($count%5==0) echo "<li>";
          ?>
          <a href="./pages/course-results.php?course=<?php echo $row['u_name'];?>" target="_blank"><img  src="<?php echo $row['img_src']?>"  /></a><?php
                $count++; 
                if($count%5==0) echo "</li>";
            }
            if($count%5!=0){ echo "</li>";}
            ?>

      </ul>

    </div>
    <!-- /UNIVERSITIES_COLLEGES -->


    <!-- FEATURED_COURSES -->
    <div class="featured_courses">

      <div class="featured_courses__main">

        <div class="featured_courses__main__head">
          <h2>featured courses</h2>
        </div>

        <div class="featured_courses__main__nav">
          <ul>
              <?php
                $sql1="select * from featured_courses where checked='yes'";
                    $res1=$conn->query($sql1);
                    while($row1=$res1->fetch_assoc()){
                ?> 
                       <li><a href=''><?php echo $row1['c_name'];?></a></li>
                <?php
                    }
              ?>
          </ul>
        </div>

        <div class="featured_courses__body">

  
          <div class="featured_courses__body__container">
              <?php
              /* flag is to count number of result */
              $flag=0;
                $sql="select * from full_detail where prg_id=5";
                    $res=$conn->query($sql);
                    while($row=$res->fetch_assoc() and $flag<4){
              ?>
            <div style="background: linear-gradient(0deg, rgba(219, 50, 78, 0.900), rgba(219, 50, 78, 0.900)), url('<?php $sql_t="select * from universities where u_id=".$row['u_id']; $res_t=$conn->query($sql_t); while($row_t=$res_t->fetch_assoc()) echo $row_t['img_src'];?>') 100% 80%/cover;" 
              class="featured_courses__body__item">
              
                <h4><?php $sql_t="select * from universities where u_id=".$row['u_id']; $res_t=$conn->query($sql_t); while($row_t=$res_t->fetch_assoc()) echo $row_t['u_name'];?></h4>
              
                <div class="featured_courses__body__item__course">
                    <span><?php $sql_t="select * from subject where id=".$row['s_id']; $res_t=$conn->query($sql_t); while($row_t=$res_t->fetch_assoc()) echo $row_t['sub_name'];?></span>
                </div>
              <div class="featured_courses__body__item__info">
                <div class="featured_courses__body__item__info__price">
                  Rs <?php echo $row['fees'];?>
                </div>
                <div class="featured_courses__body__item__info__year">
                  <?php echo $row['duration']." Years" ?>
                </div>
              </div>
              <div class="featured_courses__body__item__buttons">
                <button>apply now</button>
                  <button onclick=<?php echo "\"window.location.href='./pages/course-detail.php?id=".$row['id']."'\""?>)>read more</button>
              </div>
            </div>
            <?php $flag++;}?>
              
          </div>
            
            <div class="featured_courses__body__container">
              <?php
              /* flag is to count number of result */
              $flag=0;
                $sql="select * from full_detail where prg_id=1";
                    $res=$conn->query($sql);
                    while($row=$res->fetch_assoc() and $flag<4){
              ?>
            <div style="background: linear-gradient(0deg, rgba(219, 50, 78, 0.900), rgba(219, 50, 78, 0.900)), url('<?php $sql_t="select * from universities where u_id=".$row['u_id']; $res_t=$conn->query($sql_t); while($row_t=$res_t->fetch_assoc()) echo $row_t['img_src'];?>') 100% 80%/cover;" 
              class="featured_courses__body__item">
              <h4><?php $sql_t="select * from universities where u_id=".$row['u_id']; $res_t=$conn->query($sql_t); while($row_t=$res_t->fetch_assoc()) echo $row_t['u_name'];?></h4>
              <div class="featured_courses__body__item__course">
                <span><?php $sql_t="select * from subject where id=".$row['s_id']; $res_t=$conn->query($sql_t); while($row_t=$res_t->fetch_assoc()) echo $row_t['sub_name'];?></span>
              </div>
              <div class="featured_courses__body__item__info">
                <div class="featured_courses__body__item__info__price">
                  Rs <?php echo $row['fees'];?>
                </div>
                <div class="featured_courses__body__item__info__year">
                  <?php echo $row['duration']." Years" ?>
                </div>
              </div>
              <div class="featured_courses__body__item__buttons">
                <button>apply now</button>
                <button onclick=<?php echo "\"window.location.href='./pages/course-detail.php?id=".$row['id']."'\""?>)>read more</button>
              </div>
            </div>
            <?php $flag++;}?>
              
          </div>
            
            <div class="featured_courses__body__container">
              <?php
              /* flag is to count number of result */
              $flag=0;
                $sql="select * from full_detail where prg_id=2";
                    $res=$conn->query($sql);
                    while($row=$res->fetch_assoc() and $flag<4){
              ?>
            <div style="background: linear-gradient(0deg, rgba(219, 50, 78, 0.900), rgba(219, 50, 78, 0.900)), url('<?php $sql_t="select * from universities where u_id=".$row['u_id']; $res_t=$conn->query($sql_t); while($row_t=$res_t->fetch_assoc()) echo $row_t['img_src'];?>') 100% 80%/cover;" 
              class="featured_courses__body__item">
              <h4><?php $sql_t="select * from universities where u_id=".$row['u_id']; $res_t=$conn->query($sql_t); while($row_t=$res_t->fetch_assoc()) echo $row_t['u_name'];?></h4>
              <div class="featured_courses__body__item__course">
                <span><?php $sql_t="select * from subject where id=".$row['s_id']; $res_t=$conn->query($sql_t); while($row_t=$res_t->fetch_assoc()) echo $row_t['sub_name'];?></span>
              </div>
              <div class="featured_courses__body__item__info">
                <div class="featured_courses__body__item__info__price">
                  Rs <?php echo $row['fees'];?>
                </div>
                <div class="featured_courses__body__item__info__year">
                  <?php echo $row['duration']." Years" ?>
                </div>
              </div>
              <div class="featured_courses__body__item__buttons">
                <button>apply now</button>
                <button onclick=<?php echo "\"window.location.href='./pages/course-detail.php?id=".$row['id']."'\""?>)>read more</button>
              </div>
            </div>
            <?php $flag++;}?>
              
          </div>
            
            <div class="featured_courses__body__container">
              <?php
              /* flag is to count number of result */
              $flag=0;
                $sql="select * from full_detail where prg_id=4";
                    $res=$conn->query($sql);
                    while($row=$res->fetch_assoc() and $flag<4){
              ?>
            <div style="background: linear-gradient(0deg, rgba(219, 50, 78, 0.900), rgba(219, 50, 78, 0.900)), url('<?php $sql_t="select * from universities where u_id=".$row['u_id']; $res_t=$conn->query($sql_t); while($row_t=$res_t->fetch_assoc()) echo $row_t['img_src'];?>') 100% 80%/cover;" 
              class="featured_courses__body__item">
              <h4><?php $sql_t="select * from universities where u_id=".$row['u_id']; $res_t=$conn->query($sql_t); while($row_t=$res_t->fetch_assoc()) echo $row_t['u_name'];?></h4>
              <div class="featured_courses__body__item__course">
                <span><?php $sql_t="select * from subject where id=".$row['s_id']; $res_t=$conn->query($sql_t); while($row_t=$res_t->fetch_assoc()) echo $row_t['sub_name'];?></span>
              </div>
              <div class="featured_courses__body__item__info">
                <div class="featured_courses__body__item__info__price">
                  Rs <?php echo $row['fees'];?>
                </div>
                <div class="featured_courses__body__item__info__year">
                  <?php echo $row['duration']." Years" ?>
                </div>
              </div>
              <div class="featured_courses__body__item__buttons">
                <button>apply now</button>
                <button onclick=<?php echo "\"window.location.href='./pages/course-detail.php?id=".$row['id']."'\""?>)>read more</button>
              </div>
            </div>
            <?php $flag++;}?>
              
          </div>
            
            <div class="featured_courses__body__container">
              <?php
              /* flag is to count number of result */
              $flag=0;
                $sql="select * from full_detail where prg_id=3";
                    $res=$conn->query($sql);
                    while($row=$res->fetch_assoc() and $flag<4){
              ?>
            <div style="background: linear-gradient(0deg, rgba(219, 50, 78, 0.900), rgba(219, 50, 78, 0.900)), url('<?php $sql_t="select * from universities where u_id=".$row['u_id']; $res_t=$conn->query($sql_t); while($row_t=$res_t->fetch_assoc()) echo $row_t['img_src'];?>') 100% 80%/cover;" 
              class="featured_courses__body__item">
              <h4><?php $sql_t="select * from universities where u_id=".$row['u_id']; $res_t=$conn->query($sql_t); while($row_t=$res_t->fetch_assoc()) echo $row_t['u_name'];?></h4>
              <div class="featured_courses__body__item__course">
                <span><?php $sql_t="select * from subject where id=".$row['s_id']; $res_t=$conn->query($sql_t); while($row_t=$res_t->fetch_assoc()) echo $row_t['sub_name'];?></span>
              </div>
              <div class="featured_courses__body__item__info">
                <div class="featured_courses__body__item__info__price">
                  Rs <?php echo $row['fees'];?>
                </div>
                <div class="featured_courses__body__item__info__year">
                  <?php echo $row['duration']." Years" ?>
                </div>
              </div>
              <div class="featured_courses__body__item__buttons">
                <button>apply now</button>
                <button onclick=<?php echo "\"window.location.href='./pages/course-detail.php?id=".$row['id']."'\""?>)>read more</button>
              </div>
            </div>
            <?php $flag++;}?>
              
          </div>

        </div>

      </div>

    </div>
    <!-- /FEATURED_COURSES -->


      <!-- FEATURES -->
    <div class="site_features">
      <div class='site_features__out'>
        <h1 class='site_features__title wow fadeIn'>FEW REASONS WHY STUDENTS PREFER US</h1>
        <h3 class='site_features__subtitle'><span>CourseBrother.com</span> is your one-stop destination for course exploration & making an informed education decision</h3>
        <div class="site_features__container">
        
          <?php
                $sql="select * from features";
                $res=$conn->query($sql);
                $delay=[0.0,0.2,0.4,0.6,0.8];
                $i=0;
                while($row=$res->fetch_assoc()){
            ?>
                <div class="site_features__section wow fadeIn"  data-wow-delay='<?php echo $delay[$i++]; ?>s'>
                  <div class="section_icon"><span><img src="<?php echo $row['img_src']?>" /></span></div>
                  <div class="section_text">
                    <h3><?php echo urldecode($row['heading'])?></h3>
                    <p><?php echo urldecode($row['info'])?></p>
                  </div>
                </div>
            <?php
                }
            ?>
        
        </div>
      </div>
    </div>
    <!-- /FEATURES -->


    <!-- TOP_COURSES -->
    <div class="top_courses">
      
      <h2 class='top_courses__title'>our top picks</h2>
      <div class="top_courses__container">
        
          <?php 
            $sql="select * from out_top_picks" ;
            $res=$conn->query($sql);
            while($row=$res->fetch_assoc()){?>
                <div class="top_courses__item">
                  <img src="<?php echo $row['img_src']?>" />
                  <h3><?php echo $row['heading']?></h3>
                  <div class="top_courses__item__section">
                    <div class="top_courses__item__section__button">
                      <i class='fa fa-times'></i>
                    </div>
                    <div class='top_courses__item__section__container'>
                      <h4>TOP <?php echo $row['heading']?></h4>
                      <ul>
                          <?php
                            if($row['heading']=="graduate & post-graduate"){
                                $res_t1=$conn->query("select DISTINCT(c_id) as c from full_detail where prg_id=1 or prg_id=2 ");
                                while($row_t1=$res_t1->fetch_assoc()){
                                ?> <a href='<?php $t_cname=$conn->query("select c_name from courses where id=".$row_t1['c'])->fetch_assoc()['c_name']; echo "./pages/course-results.php?course=".$t_cname; ?>'><li><?php echo $t_cname;?></li></a>  <?php }
                            }if($row['heading']=="specialization courses"){
                                $res_t1=$conn->query("select * from subject");
                                while($row_t1=$res_t1->fetch_assoc()){
                                ?> <a href='<?php echo "./pages/course-results.php?course=".$row_t1['sub_name']; ?>'><li><?php echo $row_t1['sub_name'];?></li></a>  <?php }
                            }if($row['heading']=="universities"){
                                $res_t1=$conn->query("select * from universities");
                                while($row_t1=$res_t1->fetch_assoc()){
                                ?> <a href='<?php echo "./pages/course-results.php?course=all ".$row_t1['u_name']; ?>'><li><?php echo $row_t1['u_name'];?></li></a>  <?php }
                            }if($row['heading']=="diploma & pg diploma courses"){
                                $res_t1=$conn->query("select DISTINCT(s_id) as c from full_detail where prg_id=4 ");
                                while($row_t1=$res_t1->fetch_assoc()){
                                ?> <a href='<?php $t_sname=$conn->query("select sub_name from subject where id=".$row_t1['c'])->fetch_assoc()['sub_name']; echo "./pages/course-results.php?course=DIPLOMA ".$t_sname; ?>'><li><?php echo $t_sname;?></li></a>  <?php }
                            }
                          ?>
                      </ul>
                    </div>
                  </div>
                </div>
            <?php }
        ?>

      </div>

    </div>
    <!-- /TOP_COURSES -->

    <!-- NEWS_UPDATES -->
    <div class="news_updates">

      <div class="news_updates__back">
        <i class='fa fa-angle-left'></i>
      </div>

      <div class="news_updates__container">
        <div class="news_updates__head">
          <h2>news & updates</h2>
        </div>
        <div class="news_updates__main siema">
            <?php 
            $sql_t="select * from universities"; 
            $res_t=$conn->query($sql_t);
            $co=$conn->query('select count(*) as c from universities ')->fetch_assoc()['c'];
            $co=intval(($co+1)/2);
            for($i=0;$i<$co;$i++){
                $j=0;
            ?>
          <div class="news_updates__main__container">
            <?php 
                while($j<2 && $row_t=$res_t->fetch_assoc()){
                $sql_1="select * from news_update where u_id=".$row_t['u_id']." order by id DESC";
                $res_1=$conn->query($sql_1);
            ?>
            <div class="news_updates__main__section">
              <h5 class="news_updates__main__section__title">
                <?php echo $row_t['u_name']; ?>
              </h5>
              <div class="news_updates__main__section__sep"></div>
              <div class="news_updates__main__section__content">
                  <?php while($row_1=$res_1->fetch_assoc()){ ?>
                <div class="news_updates__main__section__content__item">
                  <h3><?php echo $row_1['heading']; ?></h3>
                  <p>
                    <?php echo substr($row_1['content'],0,80)."..."; ?>
                    <a href="#">read more</a>
                  </p>
                </div>
                  <?php } ?>
              </div>
            </div>
           <?php $j++; }?>
            </div>
            <?php } ?>
        </div>
      </div>

      <div class="news_updates__next">
        <i class='fa fa-angle-right'></i>
      </div>

    </div>
    <!-- /NEWS_UPDATES -->

    <!-- LATEST_BLOGS -->
    <div class="latest_blogs">

      <h2 class='latest_blogs__title'>latest blog posts</h2>

      <div class="latest_blogs__container">
        <?php 
            $sql_t="select * from blogs order by id DESC";
            $res_t=$conn->query($sql_t);
            $i=0; // for check number of blogs
            while($i<4 && $row_t=$res_t->fetch_assoc()){
          ?>
        <div class="latest_blogs__item">
          <div class='latest_blogs__item__bg__container'>
            <div style="background-image: url('<?php echo $row_t['thumnail']?>')" class="latest_blogs__item__bg"></div>
          </div>
          <div class="latest_blogs__item__content">
            <h5 class="latest_blogs__item__content__title">
              <?php echo $row_t['heading']; ?>
            </h5>
            <div class="latest_blogs__item__content__sep"></div>
            <p><?php echo substr($row_t['content'],0,100)."..."; ?>
            </p>
            <div class="latest_blogs__item__continue">
              <a href="">continue reading</a>
            </div>
          </div>
        </div>
          <?php $i++; } ?>
      </div>

    </div>
    <!-- /LATEST_BLOGS -->

    <!-- FOOTER -->
    <?php include 'includes/footer.php' ?>
    <!-- /FOOTER -->


  </div>
  <!-- /MAIN CONTAINER -->


  <!-- jQuery -->
  <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous">
  </script>
  <!-- TweenMax -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>
  <!-- ToolTipster -->
  <script 
    src='https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/js/jquery.tooltipster.min.js'>
  </script>
  <!-- EasyTabs -->
  <script 
    src='https://cdnjs.cloudflare.com/ajax/libs/jquery.easytabs/3.2.0/jquery.easytabs.min.js'>
  </script>
  <!-- RESPONSIVE SLIDES -->
  <script 
    src='https://cdnjs.cloudflare.com/ajax/libs/ResponsiveSlides.js/1.55/responsiveslides.min.js'>
  </script>
  <!-- SIEMA CAROUSEL -->
  <script 
    src='https://cdn.jsdelivr.net/npm/siema@1.5.1/dist/siema.min.js'>
  </script>
  <!-- WOW JS -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js'></script>
  <!-- CUSTOM JS -->
  <script src='./js/custom.js'></script>
    
     <script src='./js/navbar.js'></script>
    
    <script>
    setInterval(function(){
        var t = parseInt(Math.random()*10000000);
        $.ajax({
          type: "POST",
          url: "./includes/user_track_cookie.php",
          data: {ra:t,url:window.location.href},
          complete: function(data){
                    //data contains the response from the php file.
                    //u can pass it here to the javascript function
                    console.log(data);
                }
        });
    }, 1000);
    </script>
    <script src="./js/preloader.js"></script>
</body>
</html>
