<?php
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip'))
  ob_start("ob_gzhandler");
else
  ob_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Cache-control" content="public">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Dashboard - Course Add Menu</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--if lte IE 9>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<!endif-->
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

		<!--if lte IE 9>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<!endif-->

		<!-- inline styles related to this page -->
		<link rel='stylesheet' href='./assets/custom/menuForm.css' />

		<!-- ace settings handler -->
		<script src="assets/js/ace-extra.min.js"></script>

        <script>
            function show_pass(a){
                var show_pass_=document.getElementById("show_pass_");
                var pass=document.getElementsByName("pass");
                if(a==1){
                    show_pass_.innerHTML="Hide Password";
                    show_pass_.href="javascript:show_pass(2)";
                    pass[0].type="text";
                    pass[1].type="text";
                }else{
                    show_pass_.innerHTML="Show Password";
                    show_pass_.href="javascript:show_pass(1)";
                    pass[0].type="password";
                    pass[1].type="password";
                }
            }
            var pass_="";
            function change_pass(a){
                var con_pass=document.getElementsByClassName("pass_div")[0];
                var pass=document.getElementsByName("pass");
                var update_pass=document.getElementById("password_change");
                var pass_cancel=document.getElementById("pass_cancel");
                if(a==1){
                    con_pass.style.display="";
                    pass[0].disabled=false;
                    update_pass.innerHTML='Update Password';
                    pass_cancel.style.display="";
                    update_pass.href="javascript:change_pass(2)";
                    pass_=pass[0].value;
                }else{
                    if(pass[0].value!=pass[1].value){
                        alert("Password doesn't match");
                        return;
                    }
                    var f=new FormData();
                    f.append("id","<?php echo $_COOKIE['user_id']?>");
                    f.append("pass",pass[0].value);
                    if(confirm("Want to Change Password?")){
                        if(confirm("Going to change password")){
                            $.ajax({
                                url: "./profile_update.php",
                                type: 'POST',
                                cache: false,
                                contentType: false,
                                processData: false,
                                data: f,
                                complete: function (data) {
                                    console.log(data.responseText);
                                    if(data.responseText=='1'){
                                        alert("Successfully Updated");
                                        con_pass.style.display="none";
                                        pass[0].disabled=true;
                                        update_pass.innerHTML='Change Password';
                                        update_pass.href="javascript:change_pass(1)";
                                        pass_cancel.style.display="none";
                                        show_pass(2);
                                    }else{
                                        alert(data.responseText);
                                    }
                                }
                            });
                        }
                    }
                    
                }
            }
            function cancel_pass(){
                var con_pass=document.getElementsByClassName("pass_div")[0];
                var pass=document.getElementsByName("pass");
                var update_pass=document.getElementById("password_change");
                con_pass.style.display="none";
                pass[0].disabled=true;
                pass[0].value=pass_;
                pass[1].value=pass_;
                update_pass.innerHTML='Change Password';
                update_pass.href="javascript:change_pass(1)";
                show_pass(2);
            }
            function pro_pic(input){
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#show_dp')
                            .attr('src', e.target.result)
                            .width(150)
                            .height(150);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
            function update_profile(){
                var input=document.getElementsByClassName("input");
                var f= new FormData();
                f.append("id","<?php echo $_COOKIE['user_id']?>");
                f.append("f_name",input[0].value);
                f.append("phn_no",input[1].value);
                f.append("city",input[2].value);
                f.append("addr",input[3].value);
                f.append("image", $('input[type=file]')[0].files[0]);
                if(confirm("Want to update Profile info?")){
                    if(confirm("Going to update")){
                        $.ajax({
                            url: "./profile_update.php",
                            type: 'POST',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: f,
                            complete: function (data) {
                                console.log(data.responseText);
                                if(data.responseText=='1'){
                                    alert("Successfully Updated");
                                }else{
                                    alert(data.responseText);
                                }
                            }
                        });
                    }
                }
            }
        </script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--if lte IE 8>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<!endif-->
	</head>

	<body class="no-skin">
        
		<?php include('includes/navbar.php'); ?>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<?php include('includes/sidebar.php'); $profile=$conn->query("select * from user where id=".$_COOKIE['user_id'])->fetch_assoc(); ?>

			<div class="main-content">

			<div class="page-content">

            <?php include('./settingsContainer.php'); ?>
            <div class='row menu-form'>
                <div class='col-lg-6' >
                    <h2 class='menu-text'>Profile</h2>
                    <div class='menu-content'>
                        <form method="POST" action="javascript:update_profile();" >
                            <div class="form-group"><img id="show_dp" style="width:150px;heigth:150px;object-fit:cover;" src="./<?php if($profile['profile_pic']!=""){echo $profile['profile_pic'];}else{echo "./assets/images/avatars/user.svg";}?>" alt="not load"/> <input accept="image/*" type="file" onchange="pro_pic(this)"></div>
                            <div class="form-group ">Full Name: <input type="text"  class="form-control input" value="<?php echo urldecode($profile['f_name']);?>"/></div>
                            <div class="form-group">Contact no. : <input type="text"  class="form-control input" value="<?php echo urldecode($profile['phn_no']);?>"/></div>
                            <div class="form-group">City : <input type="text"  class="form-control input" value="<?php echo urldecode($profile['city']);?>"/></div>
                            <div class="form-group">Address: <textarea type="text"  class="form-control input" style="min-height:100px;resize:vertical;" ><?php echo urldecode($profile['address']);?></textarea></div>
                            <div class="form-group" >Password : <input name="pass" type="password"  class="form-control" value="<?php echo urldecode($profile['password']);?>" disabled/></div>
                            <div class="form-group pass_div" style="display:none;">Confirm Password : <input name="pass" type="password"  class="form-control" value="<?php echo urldecode($profile['password']);?>"/><a id="show_pass_" href="javascript:show_pass(1)">Show Password</a></div>
                            <div class="form-group"><a id="password_change" href="javascript:change_pass(1)" style="margin:5px;">Change Password</a> <a id="pass_cancel" style="margin:5px;display:none;" href="javascript:cancel_pass()">Cancel</a></div>
                            <div class="form-group"><input class="btn btn-primary" type="submit" value="Update" /></div>
                        </form>
                    </div>
                </div>
            </div>
            </div><!-- /.page-content -->
			</div><!-- /.main-content -->

			<?php include('./footer.php'); ?>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
        <script src="assets/js/jquery-1.11.3.min.js"></script>
        <![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="assets/js/jquery-ui.custom.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>

		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>
	</body>
</html>
