<!-- FOOTER -->
<div class="footer">
  <div class="footer__container wow fadeIn">

    <div class="footer__get_in_touch">
      <h3>GET IN TOUCH</h3>
      <div class="touch_contact">
        <div class="contact_phone">
          <h4>PHONE</h4>
          <span>+91 7044356122</span>
        </div>
        <div class="contact_email">
          <h4>EMAIL</h4>
          <span>shyam.d@gmail.com</span>
        </div>
      </div>
    </div>
    <div class="footer__quick_links">
      <h3>QUICK LINKS</h3>
      <div class="links">
        <a href="<?php $s=$_SERVER['REQUEST_URI'];
            $s=explode('/',$s);
            $d="";
            if($s[count($s)-2]=='pages'){
                echo ".";
            }?>./index.php">HOME</a>
          <a href="<?php $s=$_SERVER['REQUEST_URI'];
            $s=explode('/',$s);
            $d="";
            if($s[count($s)-2]=='pages'){
                echo ".";
            }?>./pages/about-us.php">ABOUT US</a>
        <a href="<?php $s=$_SERVER['REQUEST_URI'];
            $s=explode('/',$s);
            $d="";
            if($s[count($s)-2]=='pages'){
                echo ".";
            }?>./pages/contact-us.php">CONTACT US</a>
        <a href="<?php $s=$_SERVER['REQUEST_URI'];
            $s=explode('/',$s);
            $d="";
            if($s[count($s)-2]=='pages'){
                echo ".";
            }?>./pages/course-results.php?course=all">COURSES</a>
        <a href="#">SERVICES</a>
      </div>
    </div>
    <div class="footer__policies">
      <h3>our policies</h3>
      <div class="links">
        <a href="<?php $s=$_SERVER['REQUEST_URI'];
            $s=explode('/',$s);
            $d="";
            if($s[count($s)-2]=='pages'){
                echo ".";
            }?>./pages/ship-del-policy.php">shipping & delivery policy</a>
        <a href="<?php $s=$_SERVER['REQUEST_URI'];
            $s=explode('/',$s);
            $d="";
            if($s[count($s)-2]=='pages'){
                echo ".";
            }?>./pages/refund-policy.php">refund policy</a>
        <a href="<?php $s=$_SERVER['REQUEST_URI'];
            $s=explode('/',$s);
            $d="";
            if($s[count($s)-2]=='pages'){
                echo ".";
            }?>./pages/disclaimer.php">disclaimer</a>
        <a href="<?php $s=$_SERVER['REQUEST_URI'];
            $s=explode('/',$s);
            $d="";
            if($s[count($s)-2]=='pages'){
                echo ".";
            }?>./pages/terms-conditions.php">terms & conditions</a>
        <a href="<?php $s=$_SERVER['REQUEST_URI'];
            $s=explode('/',$s);
            $d="";
            if($s[count($s)-2]=='pages'){
                echo ".";
            }?>./pages/privacy-policy.php">privacy policy</a>
        <a href="<?php $s=$_SERVER['REQUEST_URI'];
            $s=explode('/',$s);
            $d="";
            if($s[count($s)-2]=='pages'){
                echo ".";
            }?>./pages/legal.php">legal policy</a>
      </div>
    </div>
    <div class="footer__newsletter">
      <h3>SUBSCRIBE TO NEWSLETTER</h3>
      <div class="newsletter_form">
        <form method="post" action="<?php $s=$_SERVER['REQUEST_URI'];
            $s=explode('/',$s);
            $d="";
            if($s[count($s)-2]=='pages'){
                echo ".";
            }?>./pages/subscribe.php?url=<?php echo $_SERVER['REQUEST_URI'];?>">
          <input name="u_name" type='text' placeholder='YOUR NAME' />
          <br />
          <input name="u_email" type='email' placeholder='YOUR EMAIL' />
          <br />
          <input type='submit' value='SUBSCRIBE' />
        </form>
      </div>
    </div>

  </div>
</div>
<!-- /FOOTER -->