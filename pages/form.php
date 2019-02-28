<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/formstyle.css">
    <!-- NORMALIZE CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css' />

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,300,400,500,600,700" rel="stylesheet">

    <!-- FONTAWESOME -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' />

    <!-- ANIMATE CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css' />

    
    <title>Document</title>
</head>
<body>
    <!-- MAIN_CONTAINER -->
    <div class="main-container">
        <!-- MySQL connector -->
        <?php
            include "../includes/mysql_connect.php";
            $conn=connect_mysql();
        ?>

        <!-- NAVBAR_MAIN -->
        <?php include('../includes/navbar-main.php'); ?>
        <!-- /NAVBAR_MAIN -->
        <div class="container_">
            <div class="form_container">
                <div>
                    <ul class="steps">
                        <li class="stepnum"><a href="javascript:page_(0)">Step 1</a></li>
                        <li class="stepnum"><a href="javascript:page_(1)">Step 2</a></li>
                    </ul>
                </div>
                <form id="step1" class="form" method="post" action="javascript:next_form('1');">
                    <div class="name">
                        <select name="salutation">
                            <option value="Mr.">Mr<option>
                            <option value="Miss">Miss<option>
                            <option value="Mrs.">Mrs<option>
                        </select>
                        <input name="f_name" type="text" placeholder="First Name" />
                        <input name="l_name" type="text" placeholder="Last Name"/>
                    </div>
                    <div class="name">
                        <select name="salutation" disabled>
                            <option value="Mr." selected>Mr<option>
                            <option value="Miss">Miss<option>
                            <option value="Mrs.">Mrs<option>
                        </select>
                        <input name="f_f_name" type="text" placeholder="Father's First Name" />
                        <input name="f_l_name" type="text" placeholder="Father's Last Name" />
                    </div>
                    <div class="name">
                        <select name="salutation" disabled>
                            <option value="Mr.">Mr<option>
                            <option value="Miss">Miss<option>
                            <option value="Mrs." selected>Mrs<option>
                        </select>
                        <input name="m_f_name" type="text" placeholder="Mother's First Name" />
                        <input name="m_l_name" type="text" placeholder="Mother's Last Name" />
                    </div>
                    <div class="contact">
                        <input name="email" type="email" placeholder="Email ID" >
                        <input name="email" type="text" placeholder="Contact Number">
                    </div>
                    <div class="address">
                        <textarea name="p_addr" placeholder="Permanent Address" ></textarea>
                        <textarea id="c_addr" name="c_addr" placeholder="Current Address" ></textarea>
                        <div><input type="checkbox" onchange="remove_c_addr(this);"> Current Address is same as Permanent Address</div>
                    </div>
                    <div class="contact">
                        <input name="email" type="email" placeholder="Alternate Email ID(Optional)">
                        <input name="email" type="text" placeholder="Alternate Contact Number">
                    </div>
                    <div class="identification">
                        <p style="padding-left:8px;">Identity Prove: </p>
                        <input type="file" />
                    </div>
                    <div>
                        <input style="padding:10px 20px 10px 20px;" class="next" type="submit" value="Next"/>
                    </div>
                </form>
                <form id="step2" class="form" method="post">
                    <div class="choose_program">
                        <h5>Choose Program</h5>
                        <div class="program_select">
                            <?php $res=$conn->query("select * from program");
                            while($row=$res->fetch_assoc()){?>
                                <div>
                                    <input onclick="program_select('<?php echo $row['p_id'];?>')" type='radio' name='program' value='<?php echo $row['p_id'];?>'/> <?php echo $row['program'];?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div style="margin-top:25px;">
                        <select id="_course_" name="_course_" onchange="_course(this);" required>
                            <option value="">Course</option>
                        </select>
                        <select id="specialization" name="_sub_" onchange="_sub(this);" required>
                            <option value="">Specialization</option>
                        </select>
                        <select id="college" name="_univ_" onchange="_univ(this)" required>
                            <option value="">College</option>
                        </select>
                        <select id="delivery_mode" name="_d_mode_" required>
                            <option value="">Delivery mode</option>
                        </select>
                    </div>
                    <div>
                        <input style="padding:10px 20px 10px 20px;" class="next" type="submit" value="Next"/>
                    </div>
                </form>
            </div>
        </div>
        <?php include"../includes/footer.php";?>
    </div>
    <script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.easytabs/3.2.0/jquery.easytabs.min.js"></script>
    <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous">
  </script>
    <!-- TweenMax -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>
  <!-- WOW JS -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js'></script>
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
                    console.log(data);
                }
        });
    }, 1000);
    </script>
    <script src="../js/preloader.js"></script>
    <script src="../js/formjs.js"></script>
    
</body>
</html>