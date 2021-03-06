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

  <!-- jQuery Plugins -->

  <!-- TOOLTIPSTER -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/css/tooltipster.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/css/themes/tooltipster-shadow.min.css' />

  <!-- ANIMATE CSS -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css' />

  <!-- CUSTOM CSS -->
  <link rel='stylesheet' href='../styles/style.css' />
  <script>
    function apply_now(){
      if(document.cookie){
        window.location.href='./form?id=<?php echo $_GET['id'];?>';
      }else{
        alert('Login to apply');
        const loginButton = document.querySelector('.navbar_main__appendix__login');
        const loginModal = document.querySelector('.login_modal');
        const loginModalBackdrop = document.querySelector('.login_modal__backdrop');
        const loginModalClose = document.querySelector('.login_modal__close');
        loginModalBackdrop.classList.add('login_modal__backdrop--active');
        loginModal.classList.add('login_modal--active');
      }
    }
  </script>

  <title>CourseBrothers | One Stop Destination for Learning</title>
</head>
<body>

  <!-- MAIN_CONTAINER -->
  <div class="main-container">

      <!-- MySQL connector -->
  <?php
        include "../includes/mysql_connect.php";
        $conn=connect_mysql();
    ?>

    <!-- LOGIN_REGISTER_MODALS -->
    <?php if(!(isset($_COOKIE['email']))){ include '../includes/login-register-modal.php'; } ?>
    <!-- /LOGIN_REGISTER_MODALS -->


    <!-- NAVBAR_MAIN -->
    <?php include('../includes/navbar-main.php'); ?>
    <!-- /NAVBAR_MAIN -->

      <!-- NEWSLETTER_POPUP -->
    <?php include('../includes/newsletter-popup.php'); ?>
    <!-- NEWSLETTER_POPUP -->

    <?php include "../includes/lead_popup.php"; ?>


    <!-- COURSE_DETAIL -->
    <div class="course_detail">
        <?php
            $d_id='';
            if(isset($_GET['id'])){
                $d_id=$_GET['id'];
            }
            $sql="select * from full_detail where id=".$d_id;
            $res=$conn->query($sql);
            if($res){
                $row=$res->fetch_assoc();
        ?>
      <!-- COURSE_DETAIL_HEADER -->
      <div class="course_detail__header">
        <div class='detail__skew'></div>
        <div class="detail__info">
          <div class="detail__info__head">
              <?php $sql_t="select * from courses where id=".$row['c_id']; $res_t=$conn->query($sql_t); $row_course=$res_t->fetch_assoc(); ?>
            <h2><?php echo $row_course['c_name']; ?> IN <?php $p=$conn->query("select sub_name from subject where id=".$row['s_id']); echo $p->fetch_assoc()['sub_name']; ?></h2>
              <?php $sql_t="select * from universities where u_id=".$row['u_id']; $res_t=$conn->query($sql_t); $row_univ=$res_t->fetch_assoc();?>
            <h5><?php  echo $row_univ['u_name']; ?></h5>
          </div>
          <div class="detail__info__appendix">
            <h4><?php echo $row['duration'];?> YEARS</h4>
            <h5><?php echo strtoupper($conn->query("select * from delivery_mode where id=".$row['d_mode_id'])->fetch_assoc()['d_mode']);?></h5>
          </div>
          <div class="detail__info__payment">
            <div class="detail__info__payment__onetime">
              <h4><?php $fees=(int)$row['fees']; echo $fees; ?></h4>
              <h4>ONE TIME PAYMENT</h4>
            </div>
            <div class="detail__info__payment__annual">
              <h4><?php echo $row["a_fees"]; ?></h4>
              <h4>ANNUAL PAYMENT</h4>
            </div>
          </div>
        </div>
        <div class="detail__img">
          <img src='.<?php  echo $row_univ['img_src']; ?>' alt="image"/>
        </div>
      </div>
      <!-- /COURSE_DETAIL_HEADER -->

      <!-- COURSE_DETAIL_BODY -->
      <div class="course_detail__body">

        <div class="course_detail__body__nav">
          <ul>
            <li class='tab'>OVERVIEW</li>
            <li class='tab'>STRUCTURE</li>
            <li class='tab'>FEE</li>
            <li class='tab'>ELIGIBILITY</li>
          </ul>
          <button onclick="lead_popup();">APPLY NOW</button>
        </div>
        <div class="course_detail__body__main">
          <div id='tab-container' class="main_content tab-container">

            <ul class='etabs'>
              <li class='tab'><a class='a1' href="#tabs-overview">OVERVIEW</a></li>
              <li class='tab'><a class='a2' href="#tabs-structure">STRUCTURE</a></li>
              <li class='tab'><a class='a3' href="#tabs-fee">FEE</a></li>
              <li class='tab'><a class='a4' href="#tabs-eligibility">ELIGIBILITY</a></li>
            </ul>
              <!-- Get data from about course -->
                <?php $sql_1="select * from about_course where id=".$d_id;
                $row_1=$conn->query($sql_1)->fetch_assoc();
                ?>
            <div id="tabs-overview">
              <h3 class='main_content__title'>COURSE OVERVIEW</h3>

              <p class='main_content__body'>
                <?php echo urldecode($row_1['overview']); ?>
              </p>
            </div>

            <div id="tabs-structure">
              <h3 class='main_content__title'>COURSE STRUCTURE</h3>
              
              <table>
                  <?php
                    $c=0;$i=1;
                    $sem=explode("|",urldecode($row_1['structure']));
                    while($c<$row['duration']){
                  ?>
                  <tr>
                    <?php
                      for($j=0;$j<2;$j++){
                        if($c==0 && $j==0){
                          ?><th>1ST SEMESTER</th><?php
                        }else if($c==0 && $i<2*$row['duration'] && $j=1){
                          ?><th>2ND SEMESTER</th><?php
                        }else{
                          echo "<th>".($i)."TH SEMESTER</th>";
                        }
                        $i++;
                      }

                    ?>
                  </tr>
                  <tr>
                    <td>
                      <?php echo urldecode($sem[$i-3]); ?>
                    </td>
                    <td>
                    <?php if(($i-1)<=2*$row['duration']){echo urldecode($sem[$i-2]);} ?>
                    </td>
                  </tr>
                  <?php $c++; } ?>
                </table>
            </div>

            <div id="tabs-fee">
              <h3 class='main_content__title'>COURSE FEE</h3>
              <?php $co=1;?>
              <p class="main_content__body"><?php echo $row['fees_d']; ?></p>
              <?php if($row['fees']!=""){?>
              <h4 class='main_content__title'>Option <?php echo $co++;?>:</h4>
              <table>
                <tr>
                  <th>Structure </th>
                  <th>Amount </th>
                </tr>
                <tr>
                  <td>Admission Processing Fee </td>
                  <td><?php echo "Rs ".$conn->query("select * from universities where u_id=".$row['u_id'])->fetch_assoc()['fees'];?></td>
                </tr>
                <tr>
                  <td>Program fee per year </td>
                  <td><?php echo $row['fees']; ?> </td>
                </tr>
              </table>
              <?php } ?>
              <?php if($row['a_fees']!=""){?>
              <h4 class='main_content__title'>Option <?php echo $co++;?>:</h4>
              <table>
                <tr>
                  <th>Structure </th>
                  <th>Amount </th>
                </tr>
                <tr>
                  <td>Admission Processing Fee </td>
                  <td><?php echo "Rs ".$conn->query("select * from universities where u_id=".$row['u_id'])->fetch_assoc()['fees'];?></td>
                </tr>
                <tr>
                  <td>Program fee per year </td>
                  <td><?php echo $row['a_fees']; ?> </td>
                </tr>
              </table>
              <?php } ?>
              <?php if($row['s_fees']!=""){?>
              <h4 class='main_content__title'>Option <?php echo $co++;?>:</h4>
              <table>
                <tr>
                  <th>Structure </th>
                  <th>Amount </th>
                </tr>
                <tr>
                  <td>Admission Processing Fee </td>
                  <td><?php echo "Rs ".$conn->query("select * from universities where u_id=".$row['u_id'])->fetch_assoc()['fees'];?></td>
                </tr>
                <tr>
                  <td>Program fee per year </td>
                  <td><?php echo $row['s_fees']; ?> </td>
                </tr>
              </table>
              <?php } ?>
              <br>
                <h3 class='main_content__title'>Terms & Condition</h3>
                <div>
                  <?php echo $row['term']; ?>
                </div>
            </div>

            <div id="tabs-eligibility">
              <h3 class='main_content__title'>COURSE ELIGIBILITY</h3>
              <p class='main_content__body'>
                <?php echo urldecode($conn->query("select * from about_course where id=".$_GET['id'])->fetch_assoc()['eligible']);?>
              </p>
            </div>

          </div>
          <div class="lead_form">
            <div class="lead_form__header"><h5>TALK TO AN EXPERT COUNSELLOR FOR FREE</h5></div>
            <form method="post" action="./enquire_send?url=course-detail?id=<?php echo $_GET['id'];?>">
              <input name="uname" type="text" placeholder='NAME' required />
              <input name="email" type="email" placeholder='EMAIL ADDRESS' required="required" />
              <input name="phn" type="text" placeholder='PHONE' required="required" />
              <input name="course_t" type="text" placeholder='COURSE' required="required" />
              <input type="submit" value='ENQUIRE' />
            </form>
          </div>
        </div>

      </div>
      <!-- /COURSE_DETAIL_BODY -->


      <!-- RELATED_COURSES -->
      <div class="related_courses">
        <h2 class='related_courses__title'>RELATED COURSES</h2>
        <div class="related_courses__container">
            <?php $sql_t="select * from full_detail where c_id=".$row['c_id']." and id!=".$row['id'];

                $t=$conn->query("select count(s.u_id) as t from (".$sql_t.") as s")->fetch_assoc();
                $t_num=$t['t'];
                $id_d=0;
                $used='';
              for($i=0;$i<2;$i++){
                if($i<$t_num){
                        $id_d=rand()%$t_num;
                    $res_t=$conn->query($sql_t);
                    for($j=0;$j<=$id_d;$j++){
                        $row_t=$res_t->fetch_assoc();
                    }
                }else{
                    $sql_t="select * from full_detail where c_id!=".$row['c_id']." and u_id=".$row['u_id'];
                    $res_t=$conn->query($sql_t);
                    for($k=0;$k<=$i;$k++){
                        $row_t=$res_t->fetch_assoc();
                    }
                }
                $used=$id_d;
            ?>
            <?php if($row_t['id']!=""){ ?>
          <div class="related_courses__item" onclick="window.location.href='./course-detail?id=<?php echo $row_t['id']; ?>'">
            <h3 class='related_courses__item__uni'><?php $p=$conn->query("select u_name from universities where u_id=".$row_t['u_id']); echo $p->fetch_assoc()['u_name']; ?></h3>
            <div class="related_courses__item__sep"></div>
            <h4 class='related_courses__item__name'><?php $p=$conn->query("select c_name from courses where id=".$row_t['c_id']); echo $p->fetch_assoc()['c_name']; ?> in <?php $p=$conn->query("select sub_name from subject where id=".$row_t['s_id']); echo $p->fetch_assoc()['sub_name']; ?></h4>
            <div class="related_courses__item__info">
              <h4 class='related_courses__item__info__price'>Rs <?php echo $row_t['fees'] ?></h4>
              <h4 class='related_courses__item__info__duration'><?php if($row_t['duration']>1){echo $row_t['duration']." YEARS";}else{echo $row_t['duration']." YEAR";}?>  </h4>
            </div>
          </div>
            <?php }?>
            <?php } ?>

        </div>
      </div>
      <!-- /RELATED_COURSES -->
        <?php } ?>
    </div>
    <!-- /COURSE_DETAIL -->

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
  <!-- EasyTabs -->
  <script
    src='https://cdnjs.cloudflare.com/ajax/libs/jquery.easytabs/3.2.0/jquery.easytabs.min.js'>
  </script>
  <!-- ToolTipster -->
  <script
    src='https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/js/jquery.tooltipster.min.js'>
  </script>
  <!-- WOW JS -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js'></script>
  <!-- CUSTOM JS -->
  <script src='../js/courseDetail.js'></script>
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
                }
        });
    }, 1000);
    </script>
    <script src="../js/preloader.js"></script>
</body>
</html>
