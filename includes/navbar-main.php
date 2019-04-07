<?php

//MySQL connector
$conn=connect_mysql();
$s=$_SERVER['REQUEST_URI'];
$s=explode('/',$s);
$d="";
if($s[count($s)-2]=='pages' || $s[count($s)-2]=='blogs' || $s[count($s)-2]=='cart'){
    $d=$d.".";
}else if($s[count($s)-2]=='forms'){
  $d="../.";
}

?>
<script>
    function my_profile(){
        if('<?php echo urldecode($_COOKIE['email'])?>'=='dalmiashyam@yahoo.co.in'){
            window.location.href="<?php echo $d?>./pages/user-dashboard";
        }else{
            alert("Sorry, this feature is being updated. Should be up soon, enjoy other part of website.");
        }
    }
</script>
<!-- PRELOADER -->
<?php include $d.'./includes/preloader.php';
?>
<!-- /PRELOADER -->
<div class='navbar_main'>

  <div class="navbar_main__appendix">

    <div class='navbar_main__appendix__container'>
      <!-- will show only in mobile view -->
      <div class="navbar_main__appendix__hamburger">
        <i class="fa fa-bars"></i>
      </div>

      <!-- will show only in mobile view -->
      <div class="navbar_main__appendix__logo">
        <a href='../index.php'><img src="<?php echo $d;?>./assets/svg/cb-logo.svg" /></a>
      </div>
        <!-- new -->
      <div class="navbar_main__appendix__info">

      </div>

        <!-- new end -->
      <?php if(!(isset($_COOKIE['email']))){?>
      <div class="navbar_main__appendix__login">
        <span><img src="<?php echo $d?>./assets/svg/Icons/red/log-in.svg"  alt="icon"/></span>
        <h5>login</h5>
      </div>

      <div class="navbar_main__appendix__register">
        <span><img src="<?php echo $d?>./assets/svg/Icons/white/clipboard-with-pencil-.svg" alt="icon" /></span>
        <h5>register</h5>
      </div>
        
      <div class="navbar_main__appendix__compare" onclick="window.location.href='<?php echo $d?>./pages/course-results'">
        <span><img src="<?php echo $d;?>./assets/svg/Icons/red/compare.svg" /></span>
        <h5>compare</h5>
      </div>
      <?php } ?>
      <div class="navbar_main__appendix__cart" onclick="window.location='<?php echo $d?>./cart'" style="cursor:pointer;">
        <h5>cart</h5>
        <span><img src="<?php echo $d?>./assets/svg/Icons/white/shopping-cart.svg" alt="icon" /></span>
      </div>
      
      <?php if(isset($_COOKIE['email'])){?>
      
        <div class="navbar_main__appendix__compare" style="margin-right:0;margin-left:5rem;" onclick="window.location.href='<?php echo $d?>./pages/course-results'">
        <span><img src="<?php echo $d;?>./assets/svg/Icons/red/compare.svg" /></span>
        <h5>compare</h5>
        </div>
        <div class="navbar_main__appendix__register " style="margin-right:0;" onclick="my_profile();">
        <span><img src="<?php echo $d?>./assets/svg/Icons/white/clipboard-with-pencil-.svg" alt="icon" /></span>
        <h5>My Profile</h5>
      </div>
      <div class="navbar_main__appendix__login" onclick="window.location='<?php echo $d?>./includes/logout.php'">
        <span><img src="<?php echo $d?>./assets/svg/Icons/red/log-in.svg"  alt="icon"/></span>
        <h5>Logout</h5>
      </div>
      
      <?php } ?>
    </div>

  </div>

  <div class="navbar_main__header">

    <div class='navbar_main__header__container'>

      <div class="navbar_main__header__logo">
        <a href='<?php echo $d?>./'><img src="<?php echo $d?>./assets/svg/cb-logo.svg" alt="icon"/></a>
      </div>

      <div class="navbar_main__header__search">
        <form method="get" action="<?php echo $d?>./pages/course-results" target="_blank" >
          <input id="bar" name="course" type="text" placeholder='search for courses     eg: mba, bba' value="<?php if(isset($_GET['course']))echo $_GET['course']; else echo ""; ?>"/>
          <button class='navbar_main__header__search__button' onclick="submit">
            <!-- will show only in desktop view -->
            <span>LET'S GO</span>
            <!-- will show only in mobile view -->
            <i class='fa fa-search'></i>
          </button>
        </form>
      </div>


        <?php // echo "<script>getElementByName('course').value='".$_GET['course']."';</script>"?>
      <div class="navbar_main__header__contact">
      <?php $res=$conn->query("SELECT * FROM `contact_info`");?>
        <div class="navbar_main__header__contact__item">
          <h4><?php echo $res->fetch_assoc()['info'];?></h4>
          <span><img src="<?php echo $d?>./assets/svg/Icons/white/phone-book.svg" /></span>
        </div>

        <div class="navbar_main__header__contact__item">
          <h4><?php $email= $res->fetch_assoc()['info']; echo $email; ?></h4>
          <span class='tooltip' title='Click to open in your default email application'>
            <a href='mailto:<?php echo $email ?>'><img src="<?php echo $d?>./assets/svg/Icons/white/mail-black-envelope-symbol.svg" alt="icon" /></a>
          </span>
        </div>

      </div>
    </div>
  </div>

  <div class="navbar_main__courses">
    <div class="navbar_main__courses__container">
        <!-- dynamically showing menu -->
        <?php
            $sql="select * from menu";
            $res=$conn->query($sql);
            while($row=$res->fetch_assoc()){
                ?>
                <div class="navbar_main__courses__item">
                    <h3><?php echo $row["menu_name"];?></h3>
                    <span><i class="fa fa-angle-down"></i></span>
                    <div class="navbar_main__courses__item__dropdown">
                        <?php if($row["menu_name"]=="ALL COLLEGES"){?>
                      <div class="navbar_main__courses__item__dropdown__head">
                        <div class='item__arrow'></div>
                      </div>
                      <div class="navbar_main__courses__item__dropdown__content">
                          <?php
                            $res1=$conn->query("select * from universities");
                            while($row1=$res1->fetch_assoc()){
                          ?>
                            <a target="blank" href="<?php echo $d."./pages/course-results?course=".$row1['u_name']?>"><li><?php echo $row1['u_name'] ?></li></a>
                          <?php } ?>
                      </div>
                        <?php } ?>
                        <?php if($row["menu_name"]=="PG COURSES"){?>
                      <div class="navbar_main__courses__item__dropdown__head">
                        <div class='item__arrow'></div>
                      </div>
                      <div class="navbar_main__courses__item__dropdown__content">
                          <?php
                            $res1=$conn->query("select distinct c_id,s_id from full_detail where prg_id=1 or prg_id=5");
                            while($row1=$res1->fetch_assoc()){
                                $t1=$conn->query("select * from courses where id=".$row1['c_id'])->fetch_assoc()['c_name'];
                                $t2=$conn->query("select * from subject where id=".$row1['s_id'])->fetch_assoc()['sub_name'];
                          ?>
                            <a target="blank" href="<?php echo $d."./pages/course-results?course=".$t1." in ".$t2?>"><li><?php echo $t1." in ".$t2 ?></li></a>
                          <?php } ?>
                      </div>
                        <?php } ?>
                        <?php if($row["menu_name"]=="UG COURSES"){?>
                      <div class="navbar_main__courses__item__dropdown__head">
                        <div class='item__arrow'></div>
                      </div>
                      <div class="navbar_main__courses__item__dropdown__content">
                          <?php
                            $res1=$conn->query("select distinct c_id,s_id from full_detail where prg_id=2");
                            while($row1=$res1->fetch_assoc()){
                                $t1=$conn->query("select * from courses where id=".$row1['c_id'])->fetch_assoc()['c_name'];
                                $t2=$conn->query("select * from subject where id=".$row1['s_id'])->fetch_assoc()['sub_name'];
                          ?>
                            <a target="blank" href="<?php echo $d."./pages/course-results?course=".$t1." in ".$t2?>"><li><?php echo $t1." in ".$t2 ?></li></a>
                          <?php } ?>
                      </div>
                        <?php } ?>
                        <?php if($row["menu_name"]=="DIPLOMA"){?>
                      <div class="navbar_main__courses__item__dropdown__head">
                        <div class='item__arrow'></div>
                      </div>
                      <div class="navbar_main__courses__item__dropdown__content">
                          <?php
                            $res1=$conn->query("select distinct c_id,s_id from full_detail where prg_id=4");
                            while($row1=$res1->fetch_assoc()){
                                $t1=$conn->query("select * from courses where id=".$row1['c_id'])->fetch_assoc()['c_name'];
                                $t2=$conn->query("select * from subject where id=".$row1['s_id'])->fetch_assoc()['sub_name'];
                          ?>
                            <a target="blank" href="<?php echo $d."./pages/course-results?course=".$t1." in ".$t2?>"><li><?php echo $t2 ?></li></a>
                          <?php } ?>
                      </div>
                        <?php } ?>
                        <?php if($row["menu_name"]=="CERTIFICATE"){?>
                      <div class="navbar_main__courses__item__dropdown__head">
                        <div class='item__arrow'></div>
                      </div>
                      <div class="navbar_main__courses__item__dropdown__content">
                          <?php
                            $res1=$conn->query("select distinct c_id,s_id from full_detail where prg_id=3");
                            while($row1=$res1->fetch_assoc()){
                                $t1=$conn->query("select * from courses where id=".$row1['c_id'])->fetch_assoc()['c_name'];
                                $t2=$conn->query("select * from subject where id=".$row1['s_id'])->fetch_assoc()['sub_name'];
                          ?>
                            <a target="blank" href="<?php echo $d."./pages/course-results?course=".$t1." in ".$t2?>"><li><?php echo $t2 ?></li></a>
                          <?php } ?>
                      </div>
                        <?php } ?>
                    </div>
                </div>
        <?php } ?>


    </div>
  </div>

</div>

<!-- STUDENT_POPUP -->
<div class="student_popup">
  <audio>
    <source src="<?php echo $d;?>./audio/pop.wav" type="audio/wav">
    <source src="<?php echo $d;?>./audio/pop.mp3" type="audio/mpeg">
    Your browser does not support the audio tag.
  </audio> 
  <div class="student_popup__image">
    <img src="<?php echo $d;?>./assets/svg/Icons/white/user.svg" alt="profile image" />
  </div>
  <div class="student_popup__name"></div>
  <div class="student_popup__city"></div>
  <div class="student_popup__text">
    <p></p>
  </div>
</div>
<!-- /STUDENT_POPUP -->
<!-- MOBILE_SIDEBAR -->
<div class="mob__sidebar">
  <div class="mob__sidebar__closer">
    <i class='fa fa-times'></i>
  </div>
  <div class="mob__sidebar__container">
  <?php if(!(isset($_COOKIE['email']))){?>
    <div class="mob__sidebar__login">
      <button>LOG IN / REGISTER</button>
    </div>
  <?php } else{ ?>
    <div class="mob__sidebar__compare" style="padding-top:1rem" onclick="my_profile();">
      <h4>My Profile</h4>
    </div>
    <div class="mob__sidebar__compare"  style="padding-top:1rem" onclick="window.location='<?php echo $d?>./includes/logout.php'">
      <h4>Logout</h4>
    </div>
  <?php }?>
    <div class="mob__sidebar__compare" onclick="window.location.href='<?php echo $d?>./pages/course-results'">
      <img src="<?php echo $d?>./assets/svg/Icons/red/compare.svg" alt="compare icon" />
      <h4>compare courses</h4>
    </div>


    <div class="mob__sidebar__sep"></div>

    <div class="mob__sidebar__courses">
      <h3>CATEGORIES</h3>
      <div class="mob__sidebar__courses__container">
        <a href="<?php echo $d; ?>./pages/course-results?course=all">ALL COLLEGES</a>
        <?php $temp=$conn->query("select distinct(c_id) as c_id from full_detail where prg_id=1 or prg_id=5");
          $str="";
          while($r=$temp->fetch_assoc()){ 
            $str.=$conn->query("select * from courses where id=".$r['c_id'])->fetch_assoc()['c_name']." ";
          } 
        ?>
        <a href="<?php echo $d; ?>./pages/course-results?course=<?php echo $str; ?>">PG COURSES</a>
        <?php $temp=$conn->query("select distinct(c_id) as c_id from full_detail where prg_id=2");
          $str="";
          while($r=$temp->fetch_assoc()){ 
            $str.=$conn->query("select * from courses where id=".$r['c_id'])->fetch_assoc()['c_name']." ";
          } 
        ?>
        <a href="<?php echo $d; ?>./pages/course-results?course=<?php echo $str; ?>">UG COURSES</a>
        <?php $temp=$conn->query("select distinct(c_id) as c_id from full_detail where prg_id=4");
          $str="";
          while($r=$temp->fetch_assoc()){ 
            $str.=$conn->query("select * from courses where id=".$r['c_id'])->fetch_assoc()['c_name']." ";
          } 
        ?>
        <a href="<?php echo $d; ?>./pages/course-results?course=<?php echo $str; ?>">DIPLOMA</a>
        <?php $temp=$conn->query("select distinct(c_id) as c_id from full_detail where prg_id=3");
          $str="";
          while($r=$temp->fetch_assoc()){ 
            $str.=$conn->query("select * from courses where id=".$r['c_id'])->fetch_assoc()['c_name']." ";
          } 
        ?>
        <a href="<?php echo $d; ?>./pages/course-results?course=<?php echo $str; ?>">CERTIFICATE</a>
      </div>
    </div>

    <div class="mob__sidebar__sep"></div>

    <div class="mob__sidebar__contact">
      <h3>CONTACT</h3>
      <div class="mob__sidebar__contact__phone">
        <h5>PHONE</h5>
        <?php $res=$conn->query("SELECT * FROM `contact_info`");?>
        <h6><?php echo $res->fetch_assoc()['info'];?></h6>
      </div>
      <div class="mob__sidebar__contact__email">
        <h5>EMAIL</h5>
        <h6><?php echo $email ?></h6>
      </div>
    </div>

  </div>
</div>
<!-- MOBILE_SIDEBAR --> 




<?php $stud=$conn->query("select * from student_popup where id=1")->fetch_assoc();
$c=$conn->query("select * from courses");
$c_s="";
$i=0;

while($co=$c->fetch_assoc()){
  if($i==0){
    $c_s.=$co['c_name'];
  }else{
    $c_s.=",".$co['c_name'];
  }
  $i++;
}
?>
<script>

const randomCities = ['<?php echo str_replace(",","','",$stud['city']);?>'];
const randomNames = ['<?php echo str_replace(",","','",$stud['stud_name']);?>'];
const formNames = ['<?php echo str_replace(",","','",$c_s);?>'];
const sentence = ['<?php echo str_replace(",","','",$stud['sentence']);?>'];

</script>


