<?php
$s=$_SERVER['REQUEST_URI'];
$s=explode('/',$s);
$d="";
if($s[count($s)-2]=='pages' || $s[count($s)-2]=='blogs' || $s[count($s)-2]=='cart'){
    $d=$d.".";
}else if($s[count($s)-2]=='forms'){
  $d="../.";
}
//MySQL connector
$conn=connect_mysql();
?>
<!-- PRELOADER -->
<?php include $d.'./includes/preloader.php';
?>
<!-- /PRELOADER -->
<div class='navbar_main'>

  <div class="navbar_main__appendix">

    <div class='navbar_main__appendix__container'>
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
      <?php } ?>
      <div class="navbar_main__appendix__cart" onclick="window.location='<?php echo $d?>./cart'" style="cursor:pointer;">
        <h5>cart</h5>
        <span><img src="<?php echo $d?>./assets/svg/Icons/white/shopping-cart.svg" alt="icon" /></span>
      </div>
      
      <?php if(isset($_COOKIE['email'])){?>
        <div class="navbar_main__appendix__register " style="margin-right:0;margin-left:5rem;" onclick="window.location='<?php echo $d?>./pages/user-dashboard'">
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
          <input type="submit" value="LET'S GO!">
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
// For Random Student Popups
// const studentPopup = document.querySelector('.student_popup');
// const studentPopupChildren = studentPopup.children;
// const studentPhrase = document.querySelector('.student_popup__text p');
// const studentPopupAudio = document.querySelector('.student_popup audio');

const randomCities = ['<?php echo str_replace(",","','",$stud['city']);?>'];
const randomNames = ['<?php echo str_replace(",","','",$stud['stud_name']);?>'];
const formNames = ['<?php echo str_replace(",","','",$c_s);?>'];


// function showStudentPopup() {

// let randomName = Math.floor(Math.random() * randomNames.length);
// let randomCity = Math.floor(Math.random() * randomCities.length);
// let randomForm = Math.floor(Math.random() * formNames.length);
// studentPopupAudio.play();

// studentPopupChildren[2].textContent = randomNames[randomName];
// studentPopupChildren[3].textContent = randomCities[randomCity];
// studentPhrase.textContent = `has just filled out the ${formNames[randomForm]} form`;

// studentPopup.classList.add('student_popup--active');
// setTimeout(() => {
//   studentPopup.classList.remove('student_popup--active');
// }, 5000);

// };

// (function studentPopupLoop () {
// let rand = Math.floor(Math.random() * 150000);
// setTimeout(() => {
//   showStudentPopup();
//   studentPopupLoop();
// }, 6000);
// }());
</script>


