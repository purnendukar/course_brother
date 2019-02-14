<?php
$s=$_SERVER['REQUEST_URI'];
$s=explode('/',$s);
$d="";
if($s[count($s)-2]=='pages' || $s[count($s)-2]=='blogs' || $s[count($s)-2]=='cart'){
    $d=$d.".";
}
?>
<!-- FOOTER -->
<div class="footer">
  <div class="footer__container wow fadeIn">

    <div class="footer__get_in_touch">
      <h3>GET IN TOUCH</h3>
      <div class="touch_contact">
      <?php $res=$conn->query("SELECT * FROM `contact_info`");?>
        <div class="contact_phone">
          <h4>PHONE</h4>
          <span><?php echo $res->fetch_assoc()['info'];?></span>
        </div>
        <div class="contact_email">
          <h4>EMAIL</h4>
          <span><?php echo $res->fetch_assoc()['info'];?></span>
        </div>
      </div>
    </div>
    <div class="footer__quick_links">
      <h3>QUICK LINKS</h3>
      <div class="links">
        <a href="<?php echo $d; ?>./">HOME</a>
        <a href="<?php echo $d; ?>./pages/about-us">ABOUT US</a>
        <a href="<?php echo $d; ?>./pages/contact-us">CONTACT US</a>
        <a href="<?php echo $d; ?>./pages/course-results?course=all">COURSES</a>
        <a href="<?php echo $d; ?>./blogs">BLOGS</a>
      </div>
    </div>
    <div class="footer__policies">
      <h3>our policies</h3>
      <div class="links">
        <a href="<?php echo $d; ?>./pages/ship-del-policy">shipping & delivery policy</a>
        <a href="<?php echo $d; ?>./pages/refund-policy">refund policy</a>
        <a href="<?php echo $d; ?>./pages/disclaimer">disclaimer</a>
        <a href="<?php echo $d; ?>./pages/terms-conditions">terms & conditions</a>
        <a href="<?php echo $d; ?>./pages/privacy-policy">privacy policy</a>
        <a href="<?php echo $d; ?>./pages/legal">legal policy</a>
      </div>
    </div>
    <div class="footer__newsletter">
      <h3>SUBSCRIBE TO NEWSLETTER</h3>
      <div class="newsletter_form">
        <form method="post" action="<?php echo $d; ?>./pages/subscribe?url=<?php echo $_SERVER['REQUEST_URI'];?>">
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