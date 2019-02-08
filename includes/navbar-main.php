<?php 
$s=$_SERVER['REQUEST_URI'];
$s=explode('/',$s);
$d="";
if($s[count($s)-2]=='pages'){
    $d=$d.".";
}
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
        <div class="navbar_main__appendix__info__item">
          <!-- <h5>credible institutes</h5> -->
          <span class='tooltip' title='For formal education courses, check the status of the listed universities on the UGC DEB website. https://www.ugc.ac.in/deb/'>
            <img src="<?php echo $d?>./assets/svg/Icons/white/apartments.svg" />
          </span>
        </div>
        <div class="navbar_main__appendix__info__item">
          <!-- <h5>transparent information</h5> -->
          <span class='tooltip' title='CourseBrother.com is not a study center and has no role in admission decisions, 
            examinations and / or awarding any degree or diploma'>
            <img src="<?php echo $d?>./assets/svg/Icons/white/information.svg" />
          </span>
        </div>
        <div class="navbar_main__appendix__info__item">
          <!-- <h5>genuine fee</h5> -->
          <span class='tooltip' title='CourseBrother.com charges no extra fee. No discount is offered by the course provider of any of the courses listed'>
            <img src="<?php echo $d?>./assets/svg/Icons/white/give-money.svg" />
          </span>
        </div>
        <div class="navbar_main__appendix__info__item">
          <!-- <h5>counselling support</h5> -->
          <span class='tooltip' title='Get expert and dedicated counselling support to make an informed education decision'>
            <img src="<?php echo $d?>./assets/svg/Icons/white/phone-receiver.svg" />
          </span>
        </div>
        <div class="navbar_main__appendix__info__item">
          <!-- <h5>study material</h5> -->
          <span class='tooltip' title='Study material is provided by the respective course providers'>
            <img src="<?php echo $d?>./assets/svg/Icons/white/books-stack-of-three.svg" />
          </span>
        </div>
      </div>
        
        <!-- new end -->
        
      <div class="navbar_main__appendix__login">
        <span><img src="<?php echo $d?>./assets/svg/Icons/red/log-in.svg" /></span>
        <h5>login</h5>
      </div>
      
      <div class="navbar_main__appendix__register">
        <span><img src="<?php echo $d?>./assets/svg/Icons/white/clipboard-with-pencil-.svg" /></span>
        <h5>register</h5>
      </div>
      
      <div class="navbar_main__appendix__cart">
        <h5>cart</h5>
        <span><img src="<?php echo $d?>./assets/svg/Icons/white/shopping-cart.svg" /></span>
      </div>
    </div>  

  </div>

  <div class="navbar_main__header">

    <div class='navbar_main__header__container'>

      <div class="navbar_main__header__logo">
        <a href='<?php echo $d?>./index.php'><img src="<?php echo $d?>./assets/svg/cb-logo.svg" /></a>
      </div>
        
      <div class="navbar_main__header__search">
        <form method="get" action="<?php echo $d?>./pages/course-results.php" target="_blank" >
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
            <a href='mailto:<?php echo $email ?>'><img src="<?php echo $d?>./assets/svg/Icons/white/mail-black-envelope-symbol.svg" /></a>
          </span>
        </div>

      </div>

    </div>

  </div>

  <div class="navbar_main__courses">
    <div class="navbar_main__courses__container">
        <!-- dynamically showing menu -->
        <?php
            
            //MySQL connector 
            $conn=connect_mysql();
        
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
                            <a href="<?php echo $d."./pages/course-results.php?course=".$row1['u_name']?>"><li><?php echo $row1['u_name'] ?></li></a>
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
                            <a href="<?php echo $d."./pages/course-results.php?course=".$t1." in ".$t2?>"><li><?php echo $t1." in ".$t2 ?></li></a>
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
                            <a href="<?php echo $d."./pages/course-results.php?course=".$t1." in ".$t2?>"><li><?php echo $t1." in ".$t2 ?></li></a>
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
                            <a href="<?php echo $d."./pages/course-results.php?course=".$t1." in ".$t2?>"><li><?php echo $t2 ?></li></a>
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
                            <a href="<?php echo $d."./pagescourse-results.php?course=".$t1." in ".$t2?>"><li><?php echo $t2 ?></li></a>
                          <?php } ?>
                      </div>
                        <?php } ?>
                    </div>
                </div>
        <?php } ?>  


    </div>
  </div>

</div>

 