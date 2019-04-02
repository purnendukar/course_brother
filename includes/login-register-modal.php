<?php ob_start();?>
<?php
$s=$_SERVER['REQUEST_URI'];
$s=explode('/',$s);
$d="";
$url="";
if($s[count($s)-2]=='pages' || $s[count($s)-2]=='blogs' || $s[count($s)-2]=='cart'){
    $d=$d.".";
}

?>

<script>
function register(){
    var input_=document.getElementsByName('input_');
    if(input_[3].value!=input_[4].value){
        alert("Password Doesn't match");
        return;
    }
    var f=new FormData();
    f.append('f_name',input_[0].value);
    f.append('l_name',input_[1].value);
    f.append('email',input_[2].value);
    f.append('pass',input_[3].value);
    f.append('phn_no',input_[5].value);
    f.append('city',input_[6].value);
    $.ajax({
        url: "<?php echo $d ?>./includes/register.php",
        type: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        data: f,
        complete: function (data) {
            if(data.responseText=='1'){
                alert("Successfully Registered");
                $.ajax({
                    url: "<?php echo $d ?>./includes/login.php",
                    type: 'POST',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: f,
                    complete: function (data) {
                        if(data.responseText=='1'){
                            var now=new Date();
                            now.setTime(now.getTime()+ 10*365*24*60*60*1000);
                            var tr=now.toUTCString();
                            document.cookie="e_id="+input_[0].value+";expires="+tr+";path=/";
                            window.location.href=window.location;
                        }else{
                            console.log(data.responseText);
                            alert("Not Able to Login try again");
                        }
                    }
                  });
            }else{
                console.log(data.responseText);
                alert(data.responseText);
            }
        }
    });
}
function login(){
    var input_=document.getElementsByName('input_login');
    var f=new FormData();
    f.append('email',input_[0].value);
    f.append('pass',input_[1].value);
    $.ajax({
        url: "<?php echo $d ?>./includes/login.php",
        type: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        data: f,
        complete: function (data) {
            if(data.responseText=='1'){
                var now=new Date();
                now.setTime(now.getTime()+ 10*365*24*60*60*1000);
                var tr=now.toUTCString();
                document.cookie="e_id="+input_[0].value+";expires="+tr+";path=/";
                window.location.href=window.location;
            }else{
                console.log(data.responseText);
                alert("Not Able to Login try again");
            }
        }
    });
}
</script>
<!-- LOGIN_MODAL -->
<div class="login_modal__backdrop"></div>
    <div class="login_modal">
      <div class="login_modal__close" title='close'>
        <i class='fa fa-times'></i>
      </div>
      <div class="login_modal__main">
        <div class="login_modal__main__title">
          <h2>log in</h2>
          <h4>to your account</h4>
        </div>
        <form class="login_modal__main__form" action="javascript:login();">
          <input name="input_login" required type="email" placeholder='enter email address' />
          <input name="input_login" required type="password" placeholder='enter password' />
          <span class="login_modal__main__form__showpw">
            <i class="fa fa-eye"></i>
          </span>
          <button type='submit'>log in</button>
        </form>
        <div class="login_modal__main__oauth">
          <h3>login with</h3>
          <div class="login_modal__main__oauth__container">
            <div class="login_modal__main__oauth__item"></div>
            <div class="login_modal__main__oauth__item"></div>
            <div class="login_modal__main__oauth__item"></div>
          </div>
        </div>
        <!-- will show only in mobile view -->
        <a class='mob__login_to_reg' href="#">Don't have an account? Register here</a>
      </div>
      <div class="login_modal__appendix">
        <div class="login_modal__appendix__head">
          <h2>welcome back</h2>
          <div class="login_modal__appendix__head__sep"></div>
          <p>enter your login credentials to connect with us again!</p>
        </div>
        <div class="login_modal__appendix__register">
          <p>don't have an account?</p>
          <button>register here</button>
        </div>
      </div>
    </div>
    <!-- /LOGIN_MODAL -->

    <!-- REGISTER_MODAL -->
    <div class="register_modal">
      <div class="register_modal__close" title='close'>
        <i class='fa fa-times'></i>
      </div>
      <div class="register_modal__main">
        <div class="register_modal__main__title">
          <h2>register</h2>
          <h4>to our website</h4>
        </div>
        <form class="register_modal__main__form" method="post" action="javascript:register('<?php echo $d ?>./includes/register.php')">
          <input name='input_' required type="text" placeholder='enter first name' />
          <input name='input_' required type="text" placeholder='enter last name' />
          <input name='input_' required type="text" placeholder='enter email address' />
          <input name='input_' required type="password" placeholder='enter password' />
          <span class="register_modal__main__form__showpw1">
            <i class="fas fa-eye"></i>
          </span>
          <input name='input_' required type="password" placeholder='confirm password' />
          <span class="register_modal__main__form__showpw2">
            <i class="fas fa-eye"></i>
          </span>
          <input name='input_' required type="text" placeholder='enter mobile no.' />
          <input name='input_' required type="text" placeholder='enter city' />
          <div class="register_modal__submit">register</div>
          <button type='submit'>register</button>
        </form>
        <!-- will show only in mobile view -->
        <span class='mob__reg_to_login' href="#">Already have an account? Login here</span>
      </div>
      <div class="register_modal__appendix">
        <div class="register_modal__appendix__head">
          <h2>start a journey</h2>
          <div class="register_modal__appendix__head__sep"></div>
          <p>enter the required details to become a part of our community</p>
        </div>
        <div class="register_modal__appendix__login">
          <p>already have an account?</p>
          <button>login here</button>
        </div>
      </div>
    </div>
    <!-- /REGISTER_MODAL -->
