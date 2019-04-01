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

  <!-- ANIMATE CSS -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css' />

  <!-- CUSTOM CSS -->
  <link rel='stylesheet' href='../styles/style.css' />
  <link rel="stylesheet" href="./comparePage/styles.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <style>
.slidecontainer {
  width: 100%;
}

.slider {
  -webkit-appearance: none;
  width: 100%;
  height: 5px;
  border-radius: 5px;
  background: #d3d3d3;
  outline: none;
  opacity: 0.7;
  -webkit-transition: .2s;
  transition: opacity .2s;
}

.slider:hover {
  opacity: 1;
}

.slider::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 15px;
  height: 15px;
  border-radius: 50%;
  background: #DB324D;
  cursor: pointer;
}

.slider::-moz-range-thumb {
  width: 15px;
  height: 15px;
  border-radius: 50%;
  background: #DB324D;
  cursor: pointer;
}
</style>

    <script>
        function filter(a){
            var u_id="";
            var s_id="";
            var a_id="";
            var c_id="";
            var d_id="";
            var m_f="";

            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("show_result").innerHTML = this.responseText;
                }
            };
            var univ= document.getElementsByClassName("univ_id");
            var sub= document.getElementsByClassName("sub");
            var aff= document.getElementsByClassName("affiliate");
            var course= document.getElementsByClassName("c_id");
            var dmode= document.getElementsByClassName("d_mode");
            var myRange=document.getElementById("myRange");

            for(var i=0;i<univ.length;i++){
                if(univ[i].checked)
                    u_id=u_id+(univ[i].value)+",";
            }
            for(var i=0;i<sub.length;i++){
                if(sub[i].checked)
                    s_id=s_id+(sub[i].value)+",";
            }
            for(var i=0;i<aff.length;i++){
                if(aff[i].checked)
                    a_id=a_id+(aff[i].value)+",";
            }
            for(var i=0;i<course.length;i++){
                if(course[i].checked)
                    c_id=c_id+(course[i].value)+",";
            }

            for(var i=0;i<dmode.length;i++){
                if(dmode[i].checked)
                    d_id=d_id+(dmode[i].value)+",";
            }
            m_f=myRange.value;
            xmlhttp.open("GET","get_detail?u_id="+u_id+"&s_id="+s_id+"&m_f="+m_f+"&a_id="+a_id+"&c_id="+c_id+"&d_id="+d_id+"&course=all");
            xmlhttp.send();

        }
        function clear_all(){

            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("show_result").innerHTML = this.responseText;
                }
            };
            var univ= document.getElementsByClassName("univ_id");
            var sub= document.getElementsByClassName("sub");
            var aff= document.getElementsByClassName("affiliate");
            var course= document.getElementsByClassName("c_id");
            var dmode= document.getElementsByClassName("d_mode");
            var myRange=document.getElementById("myRange");

            myRange.value=myRange.max;
            document.getElementById("demo").innerHTML=myRange.max;

            for(var i=0;i<univ.length;i++){
                if(univ[i].checked)
                    univ[i].checked=false;
            }
            for(var i=0;i<sub.length;i++){
                if(sub[i].checked)
                    sub[i].checked=false;
            }
            for(var i=0;i<aff.length;i++){
                if(aff[i].checked)
                    aff[i].checked=false;
            }
            for(var i=0;i<course.length;i++){
                if(course[i].checked)
                    course[i].checked=false;
            }

            for(var i=0;i<dmode.length;i++){
                if(dmode[i].checked)
                    dmode[i].checked=false;
            }
            xmlhttp.open("GET","get_detail?u_id=&s_id=&a_id=&m_f=&c_id=&d_id=&course=all");
            xmlhttp.send();
        }
        
    </script>
  <title>CourseBrother.com | One Stop Destination for Learning</title>
</head>
<body>

  <!-- MAIN_CONTAINER -->
  <div class="main-container main_container__results">
    <?php include '../includes/mysql_connect.php';?>
    <!-- LOGIN_REGISTER_MODALS -->
    <?php if(!(isset($_COOKIE['email']))){ include '../includes/login-register-modal.php'; } ?>
    <!-- /LOGIN_REGISTER_MODALS -->

    <?php include '../includes/navbar-main.php'; ?>

      <!-- NEWSLETTER_POPUP -->
    <?php include '../includes/newsletter-popup.php'; ?>
    <!-- NEWSLETTER_POPUP -->

    <!--COMPARE PAGE-->
    <?php include "./comparePage/index.php"; ?>
    <!--COMPARE PAGE-->


    <!-- MAIN_CONTAINER -->
    <main class="main_container">
      <!-- FILTER_RESULTS -->
      <div class="filter_results">
        <!-- will only show in mobile view -->
        <div class="filter_results__finisher">
          <div class="filter_results__finisher__apply">
            apply filters
          </div>
          <!-- <div class="filter_results__finisher__close">
            <i class='fa fa-times'></i>
            CLOSE
          </div> -->
        </div>

        <div class="filter_results__head">
          <h3>filter results</h3>
          <button onclick="clear_all();">clear all</button>
        </div>

        <div class="filter_results__item">
          <div class="filter_results__item__head">
            <h5>course category</h5>
            <i class='fa fa-angle-up'></i>
          </div>
          <div class="filter_results__item__content">

            <form class='filter_results__item__form'>
              <!-- <input type="text" placeholder='search category' /> -->
            </form>
            <div class="filter_results__item__check">
                <?php $res_t=$conn->query("select * from courses"); while($row_t=$res_t->fetch_assoc()){ ?>
              <input class="c_id" type="checkbox" value="<?php echo $row_t['id']; ?>" onclick="<?php echo "filter('".$row_t['c_name']."');" ?>"> <?php echo $row_t['c_name']; ?> <br><?php } ?>
            </div>
          </div>
        </div>

        <div class="filter_results__item">
          <div class="filter_results__item__head">
            <h5>institute</h5>
            <i class='fa fa-angle-up'></i>
          </div>
          <div class="filter_results__item__content">
            <form class='filter_results__item__form'>
              <!-- <input type="text" placeholder='search institutes' /> -->
            </form>
            <div class="filter_results__item__check">
                <?php $sql_3="select * from universities";
                    $res_3=$conn->query($sql_3);
                    while($row_3=$res_3->fetch_assoc()){
                        ?><input class="univ_id" type="checkbox" value="<?php echo $row_3['u_id'] ?>" onclick="<?php echo "filter('".$row_3['u_name']."');" ?>"/> <?php echo $row_3['u_name']; ?><br/><?php
                    }
                ?>
            </div>
          </div>
        </div>

        <div class="filter_results__item">
          <div class="filter_results__item__head">
            <h5>specialization</h5>
            <i class='fa fa-angle-up'></i>
          </div>
          <div class="filter_results__item__content">
            <form class='filter_results__item__form'>
              <!-- <input type="text" placeholder='search specializations' /> -->
            </form>
            <div class="filter_results__item__check">
                <?php $sql_3="select * from subject";
                    $res_3=$conn->query($sql_3);
                    while($row_3=$res_3->fetch_assoc()){
                        ?><input class="sub" type="checkbox" value="<?php echo $row_3['id'] ?>" onclick="<?php echo "filter('".$row_3['sub_name']."');" ?>"/> <?php echo $row_3['sub_name']; ?><br/><?php
                    }
                ?>
            </div>
          </div>
        </div>

        <div class="filter_results__item">
          <div class="filter_results__item__head">
            <h5>Course Fees</h5>
            <i class='fa fa-angle-up'></i>
          </div>
          <div class="filter_results__item__content">
            <form class='filter_results__item__form'>
              <!-- <input type="text" placeholder='search specializations' /> -->
            </form>
            <div class="filter_results__item__check">
                <?php $sql_3="select max(fees)+10000 as fee from full_detail";
                    $res_3=$conn->query($sql_3)->fetch_assoc();
                    $res_3=$res_3['fee'];
                    ?>
                    <div class="slidecontainer">
                      <input type="range" min="1" max="<?php echo $res_3;?>" value="<?php echo $res_3;?>" class="slider" id="myRange">
                      <p>Max Fees: <span id="demo"></span></p>
                    </div>
            </div>
          </div>
        </div>

        <!-- <div class="filter_results__item">
          <div class="filter_results__item__head">
            <h5>exam centre</h5>
            <i class='fa fa-angle-up'></i>
          </div>
          <div class="filter_results__item__content">
            <form class='filter_results__item__form'> -->
              <!-- <input type="text" placeholder='search exam centres' /> -->
            <!-- </form>
            <div class="filter_results__item__check">
              <input type="checkbox"> delhi ncr <br>
              <input type="checkbox"> kolkata <br>
              <input type="checkbox"> andhra pradesh <br>
              <input type="checkbox"> hugli <br>
            </div>
          </div>
        </div> -->

        <div class="filter_results__item">
          <div class="filter_results__item__head">
            <h5>affiliation</h5>
            <i class='fa fa-angle-up'></i>
          </div>
          <div class="filter_results__item__content">
            <form class='filter_results__item__form'>
              <!-- <input type="text" placeholder='search affiliations' /> -->
            </form>
            <div class="filter_results__item__check">
              <?php $sql_3="select * from affiliation";
                    $res_3=$conn->query($sql_3);
                    while($row_3=$res_3->fetch_assoc()){
                        ?><input class="affiliate"  type="checkbox" value="<?php echo $row_3['id'];?>" onclick="<?php echo "filter('".$row_3['a_name']."');" ?>" /> <?php echo $row_3['a_name']; ?><br/><?php
                    }
                ?>
            </div>
          </div>
        </div>
<!--
        <div class="filter_results__item">
          <div class="filter_results__item__head">
            <h5>certification type</h5>
            <i class='fa fa-angle-up'></i>
          </div>
          <div class="filter_results__item__content">
            <form class='filter_results__item__form'>
              <input type="text" placeholder='search certification types' />
            </form>
            <div class="filter_results__item__check">
              <input type="checkbox"> distance <br>
            </div>
          </div>
        </div>

        <div class="filter_results__item">
          <div class="filter_results__item__head">
            <h5>course type</h5>
            <i class='fa fa-angle-up'></i>
          </div>
          <div class="filter_results__item__content">
            <form class='filter_results__item__form'>
              <input type="text" placeholder='search course types' />
            </form>
            <div class="filter_results__item__check">
              <input type="checkbox"> distance <br>
            </div>
          </div>
        </div>
-->
        <div class="filter_results__item">
          <div class="filter_results__item__head">
            <h5>delivery mode</h5>
            <i class='fa fa-angle-up'></i>
          </div>
          <div class="filter_results__item__content">
            <form class='filter_results__item__form'>
              <!-- <input type="text" placeholder='search delivery modes' /> -->
            </form>
            <div class="filter_results__item__check">
                <?php
                    $res=$conn->query("select * from delivery_mode");
                    while($row=$res->fetch_assoc()){
                ?>
              <input class="d_mode" value="<?php echo $row['id']; ?>" type="checkbox" onclick="<?php echo "filter('".$row['d_mode']."');" ?>" > <?php echo $row['d_mode']; ?><br>
                <?php }?>
            </div>
          </div>
        </div>
        
      </div>
      <!-- /FILTER_RESULTS -->

        <?php
        // Remove unnecessary words from the search term and return them as an array
        function filterSearchKeys($query){
            $query = trim(preg_replace("/(\s+)+/", " ", $query));
            $words = array();
            // expand this list with your words.
            $list = array("in","it","a","the","of","or","I","you","he","me","us","they","she","to","but","that","this","those","then");
            $c = 0;
            foreach(explode(" ", $query) as $key){
                if (in_array($key, $list)){
                    continue;
                }
                $words[] = strtoupper($key);
                if ($c >= 15){
                    break;
                }
                $c++;
            }
            return $words;
        }
        function table_search($course,$t_name,$conn){
            $id=array();
            foreach($course as $test){
                $que="";
                $count_=0;
                if($count_==0)
                    $que=$que." keyword like '%".strtoupper($test)."%'";
                else
                    $que=$que." or keyword like '%".strtoupper($test)."%'";
                $count_++;
                $que=" where ".$que;
                $res=$conn->query("select * from ".$t_name.$que);
                if($res){
                    while($row=$res->fetch_assoc()){
                        if($t_name=="universities")
                            $id[]=$row['u_id'];
                        else
                            $id[]=$row['id'];
                    }
                }
            }
            return $id;
        }
        $course="";
        if(isset($_GET['course'])){
          if(strtoupper($_GET['course'])!='ALL'){

              $course = filterSearchKeys(strtolower($_GET['course']));
              $c_id = table_search($course,"courses",$conn);
              $s_id=table_search($course,"subject",$conn);
              $u_id=table_search($course,"universities",$conn);
              $a_id=table_search($course,"affiliation",$conn);
              $d_id=table_search($course,"delivery_mode",$conn);
              echo "<script>
              var univ= document.getElementsByClassName(\"univ_id\");
              var sub= document.getElementsByClassName(\"sub\");
              var aff= document.getElementsByClassName(\"affiliate\");
              var course= document.getElementsByClassName(\"c_id\");
              var dmode= document.getElementsByClassName(\"d_mode\");
              for(var i=0;i<univ.length;i++){
                  if([ ".implode(" , ",$u_id)." ].includes(parseInt(univ[i].value)))
                      univ[i].checked=\"checked\";
              }
              for(var i=0;i<sub.length;i++){
                  if([ ".implode(" , ",$s_id)." ].includes(parseInt(sub[i].value)))
                      sub[i].checked=\"checked\";
              }
              for(var i=0;i<aff.length;i++){
                  if([ ".implode(" , ",$a_id)." ].includes(parseInt(aff[i].value)))
                      aff[i].checked=\"checked\";
              }
              for(var i=0;i<course.length;i++){
                  if([ ".implode(" , ",$c_id)." ].includes(parseInt(course[i].value)))
                      course[i].checked=\"checked\";
              }

              for(var i=0;i<dmode.length;i++){
                  if([ ".implode(" , ",$d_id)." ].includes(parseInt(dmode[i].value)))
                      dmode[i].checked=\"checked\";
              }
              </script>";
              $str="";
              $temp="";
              $count_=0;
              $count_t=0;
              foreach($c_id as $id){
                  if($count_== 0)
                      $temp=$temp." c_id=".$id;
                  else
                      $temp=$temp." or c_id=".$id;
                  $count_++;
              }
              if($temp!=""){
                  if($count_t==0){
                      $str=$str." (".$temp.")";
                  }else{
                      $str=$str." and (".$temp.")";
                  }
                  $count_t++;
              }
              $temp="";
              $count_=0;
              foreach($s_id as $id){
                  if($count_== 0)
                      $temp=$temp." s_id=".$id;
                  else
                      $temp=$temp." or s_id=".$id;
                  $count_++;
              }
              if($temp!=""){
                  if($count_t==0){
                      $str=$str." (".$temp.")";
                  }else{
                      $str=$str." and (".$temp.")";
                  }
                  $count_t++;
              }
              $temp="";
              $count_=0;
              foreach($u_id as $id){
                  if($count_== 0)
                      $temp=$temp." u_id=".$id;
                  else
                      $temp=$temp." or u_id=".$id;
                  $count_++;
              }
              if($temp!=""){
                  if($count_t==0){
                      $str=$str." (".$temp.")";
                  }else{
                      $str=$str." and (".$temp.")";
                  }
                  $count_t++;
              }
              $temp="";
              $count_=0;
              foreach($a_id as $id){
                  if($count_== 0)
                      $temp=$temp." a_id=".$id;
                  else
                      $temp=$temp." or a_id=".$id;
                  $count_++;
              }
              if($temp!=""){
                  if($count_t==0){
                      $str=$str." (".$temp.")";
                  }else{
                      $str=$str." and (".$temp.")";
                  }
                  $count_t++;
              }
              $temp="";
              $count_=0;
              foreach($d_id as $id){
                  if($count_== 0)
                      $temp=$temp." d_mode_id=".$id;
                  else
                      $temp=$temp." or d_mode_id=".$id;
                  $count_++;
              }
              if($temp!=""){
                  if($count_t==0){
                      $str=$str." (".$temp.")";
                  }else{
                      $str=$str." and (".$temp.")";
                  }
                  $count_t++;
              }

              $sql_2="select * from full_detail where ".$str;
          }else{
              $sql_2="select * from full_detail ";
          }
        }else{
          $course="ALL";
          $sql_2="select * from full_detail ";
        }
        $res_2=$conn->query($sql_2);
      ?>
      <!-- COURSE_RESULTS -->

      <!-- will show only in mobile view -->
        <div class="course_results__mob__filter">
          <i class='fa fa-filter'></i>
        </div>

      <div id="show_result" class="course_results">


        <div class="course_results__head">
            <h3>FOUND <b id="num_res"><?php if($res_=$conn->query("select count(c_id) as c from (".$sql_2.") as t")) echo $res_->fetch_assoc()['c']; else echo "0";  ?></b> RESULT(S) <?php if($course!='ALL'){?> FOR <b id="course"><?php echo strtoupper($_GET['course']);?></b><?php }?> </h3>

        </div>

        <div class="course_results__container" >
            <?php if($res_2){
                while($row_2=$res_2->fetch_assoc()){
                    $res_u=$conn->query("select * from universities where u_id=".$row_2['u_id'])->fetch_assoc();
            ?>
          <div class="course_results__item">
            <div class="course_results__item__img">
              <img src="<?php echo ".".$res_u['img_src'];?>" alt="image" />
            </div>
            <div class="course_results__item__content">
              <div class="course_results__item__content__head">
                <h4><a href=<?php echo "'./course-detail?id=".$row_2['id']."'"; ?> target="_blank"><?php echo $conn->query("select * from courses where id=".$row_2['c_id'])->fetch_assoc()['c_name'];?> IN <?php echo $conn->query("select * from subject where id=".$row_2['s_id'])->fetch_assoc()['sub_name']; ?></a></h4>
                <h5><?php echo $res_u['u_name']?></h5>
              </div>
              <div class="course_results__item__content__info">
                <div class="course_results__item__content__info__dur">
                  <img src="../assets/svg/Icons/red/stopwatch.svg" alt="image"/>
                  <h5><?php echo $row_2['duration']?> years</h5>
                </div>
                <div class="course_results__item__content__info__dm">
                  <h5>delivery mode</h5>
                  <h6><?php echo $conn->query("select * from delivery_mode where id=".$row_2['d_mode_id'])->fetch_assoc()['d_mode'];?></h6>
                </div>
              </div>
              <div class="course_results__item__content__price">
                <h3>Rs <?php echo $row_2['fees']?> <span>(Full Fees)</span></h3>
              </div>
            </div>
            <div class="course_results__item__buttons">
              <button onclick=<?php echo "\"window.open('./course-detail?id=".$row_2['id']."')\""; ?>  >go to course</button>
              <button onclick="compare_('<?php echo $row_2['id'];?>')">add to compare</button>
            </div>
          </div>
            <?php }
      }?>

        </div>

      </div>
      <!-- /COURSE_RESULTS -->

      <!-- AD_BANNERS -->
      <div class="ad_banners">
        <?php $res=$conn->query("select * from sponsor_course");
          while($row=$res->fetch_assoc()){
        ?>
          <div class="ad_banners__item">
            <img src=".<?php echo $row['img_src']?>" onclick="window.open('<?php echo $row['link']?>');" style="width:100%;display:block;"/>
          </div>
          <?php } ?>
      </div>
      <!-- /AD_BANNERS -->

    </main>
    <!-- /MAIN_CONTAINER -->


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
  <!-- WOW JS -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js'></script>
  <!-- CUSTOM JS -->
  <script src='../js/courseResults.js'></script>
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

        var slider = document.getElementById("myRange");
        var output = document.getElementById("demo");
        output.innerHTML = slider.value;

        slider.oninput = function() {
          output.innerHTML = this.value;
          filter(this.value);
        }
    </script>

    <script src="../js/preloader.js"></script>

    <script src="./comparePage/app.js"></script>
</body>
</html>
