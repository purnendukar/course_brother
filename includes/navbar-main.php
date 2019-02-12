<?php
$s=$_SERVER['REQUEST_URI'];
$s=explode('/',$s);
$d="";
if($s[count($s)-2]=='pages' || $s[count($s)-2]=='blogPage'){
    $d=$d.".";
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

      <div class="navbar_main__appendix__login">
        <span><img src="<?php echo $d?>./assets/svg/Icons/red/log-in.svg"  alt="icon"/></span>
        <h5>login</h5>
      </div>

      <div class="navbar_main__appendix__register">
        <span><img src="<?php echo $d?>./assets/svg/Icons/white/clipboard-with-pencil-.svg" alt="icon" /></span>
        <h5>register</h5>
      </div>

      <div class="navbar_main__appendix__cart">
        <h5>cart</h5>
        <span><img src="<?php echo $d?>./assets/svg/Icons/white/shopping-cart.svg" alt="icon" /></span>
      </div>
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
                            <a href="<?php echo $d."./pages/course-results?course=".$row1['u_name']?>"><li><?php echo $row1['u_name'] ?></li></a>
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
                            <a href="<?php echo $d."./pages/course-results?course=".$t1." in ".$t2?>"><li><?php echo $t1." in ".$t2 ?></li></a>
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
                            <a href="<?php echo $d."./pages/course-results?course=".$t1." in ".$t2?>"><li><?php echo $t1." in ".$t2 ?></li></a>
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
                            <a href="<?php echo $d."./pages/course-results?course=".$t1." in ".$t2?>"><li><?php echo $t2 ?></li></a>
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
                            <a href="<?php echo $d."./pagescourse-results?course=".$t1." in ".$t2?>"><li><?php echo $t2 ?></li></a>
                          <?php } ?>
                      </div>
                        <?php } ?>
                    </div>
                </div>
        <?php } ?>


    </div>
  </div>

</div>
