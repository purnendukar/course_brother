<?php
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip'))
  ob_start("ob_gzhandler");
else 
  ob_start(); 
?><!DOCTYPE html>

<html lang="en">
	<head>
	
	<meta http-equiv="Cache-control" content="public">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Dashboard - Institution Add Menu</title>

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

		<!--if lte IE 9-->
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

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--if lte IE 8-->
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<!endif-->

        <script>
            function edit_(a){
              if(confirm("Want to update?")){if(confirm("Going to update")){
                var uname=document.getElementsByName('username')[0];
                var fname=document.getElementsByName('f_name')[0];
                var email=document.getElementsByName('email')[0];
                var city=document.getElementsByName('city')[0];
                var addr=document.getElementsByName('addr')[0];
                var phn_no=document.getElementsByName('phn_no')[0];
                var pass=document.getElementsByName('pass')[0];
                var pages=document.getElementsByName('pages');
                var s="";
                for(var i=0;i<pages.length;i++){
                    if(pages[i].checked){
                        if(s==""){
                            s+=pages[i].value;
                        }else{
                            s+=","+pages[i].value;
                        }
                    }
                }
                s+=",profile";
                var formData=new FormData();
                formData.append('id',a);
                formData.append('uname',uname.value);
                formData.append('fname',fname.value);
                formData.append('email',email.value);
                formData.append('city',city.value);
                formData.append('addr',addr.value);
                formData.append('phn_no',phn_no.value);
                formData.append('pages',s);
                formData.append('pass',pass.value);
                $.ajax({
                    url: "./user_edit_update.php",
                    type: 'POST',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    complete: function (data) {
                        console.log(data.responseText);
                        if(data.responseText=='1'){
                            alert("Successfully Added");
                            window.location.href="./user";
                        }else{
                            alert(data.responseText);
                        }
                    }
                });
              }}
            }
            function make_check(a){
              var t=a.split(',');
              var pages=document.getElementsByName("pages");
              for(var i=0;i<pages.length;i++){
                for(var j=0;j<t.length;j++){
                  if(pages[i].value==t[j]){
                    pages[i].checked=true;
                  }
                }
              }
            }
        </script>
	</head>

	<body class="no-skin">

		<?php include('includes/navbar.php'); ?>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<?php include('includes/sidebar.php'); ?>

			<div class="main-content">

					<div class="page-content">

            <?php include('./settingsContainer.php'); ?>

            <div class='row menu-form'>
              <div class='col-lg-6' style="width:100%;">
                  <h2 class='menu-text'>User Info Edit</h2>
                  <?php $row=$conn->query("select * from user where id=".$_GET['id'])->fetch_assoc();?>
                  <form method="post" class='menu-content' action="javascript:edit_(<?php echo $_GET['id'];?>)" enctype="multipart/form-data" >
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input name="username" type="text" class="form-control" placeholder="Username" value="<?php echo urldecode($row['u_name']);?>" required>
                    </div>
                    <div class="form-group">
                      <label for="f_name">Full Name</label>
                      <input name="f_name" type="text" class="form-control" style="min-heigth:500px;min-width:100%;max-width:100%;"placeholder="Full Name" value="<?php echo urldecode($row['f_name']);?>" required>
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input name="email" type="text" class="form-control" style="min-heigth:500px;min-width:100%;max-width:100%;"placeholder="Email" value="<?php echo urldecode($row['email']);?>" required>
                    </div>
                    <div class="form-group">
                      <label for="pages">Pages</label><br/>
                      <div style="display:inline-block;font-size:15px;padding:5px;"><input name="pages" type="checkbox" value="index"> Dashboard</div>
                      <div style="display:inline-block;font-size:15px;padding:5px;"><input name="pages" type="checkbox" value="indexPageForm" > Index Edit</div>
                      <div style="display:inline-block;font-size:15px;padding:5px;"><input name="pages" type="checkbox" value="aboutPageForm" > About us Edit</div>
                      <div style="display:inline-block;font-size:15px;padding:5px;"><input name="pages" type="checkbox" value="contactPageForm" > Contact us Edit</div>
                      <div style="display:inline-block;font-size:15px;padding:5px;"><input name="pages" type="checkbox" value="shippingPageForm" > Shipping Policy Edit</div>
                      <div style="display:inline-block;font-size:15px;padding:5px;"><input name="pages" type="checkbox" value="refundPageForm" > Refund Policy Edit</div>
                      <div style="display:inline-block;font-size:15px;padding:5px;"><input name="pages" type="checkbox" value="disclaimerPageForm" > Disclaimer Edit</div>
                      <div style="display:inline-block;font-size:15px;padding:5px;"><input name="pages" type="checkbox" value="termnconditionPageForm" > Term & Condition Edit</div>
                      <div style="display:inline-block;font-size:15px;padding:5px;"><input name="pages" type="checkbox" value="privacyPageForm" > Privacy Policy Edit</div>
                      <div style="display:inline-block;font-size:15px;padding:5px;"><input name="pages" type="checkbox" value="legalPageForm" > Legal Policy Edit</div>
                      <div style="display:inline-block;font-size:15px;padding:5px;"><input name="pages" type="checkbox" value="blogAddForm,blogEditForm,blogEditFormShow" <?php if(strpos($row['access'], 'blogAddForm,blogEditForm,blogEditFormShow') !== false){echo 'checked';} ?>> Blog</div>
                      <?php $r=$conn_p->query("select * from universities");
                        while($t=$r->fetch_assoc()){
                      ?>
                      <div style="display:inline-block;font-size:15px;padding:5px;"><input name="pages" type="checkbox" value="newsletterall,newsletterEditForm?id=<?php echo $t['u_id']?>,newsletterAddForm?u_id=<?php echo $t['u_id']?>" <?php if(strpos($row['access'], 'newsletterall,newsletterEditForm?id='.$t['u_id'].',newsletterAddForm?u_id='.$t['u_id']) !== false){echo 'checked';} ?>> News & Update of <?php echo $t['u_name'];?></div>
                        <?php } ?>
                      <div style="display:inline-block;font-size:15px;padding:5px;"><input name="pages" type="checkbox" value="Testimonial"  > Testimonial Edit</div>
                      <div style="display:inline-block;font-size:15px;padding:5px;"><input name="pages" type="checkbox" value="institutionAddForm,institutionEditForm,institutionDeleteForm" <?php if(strpos($row['access'], 'institutionAddForm,institutionEditForm,institutionDeleteForm') !== false){echo 'checked';} ?>> University Edit</div>
                      <div style="display:inline-block;font-size:15px;padding:5px;"><input name="pages" type="checkbox" value="courseAddForm,courseEditForm" <?php if(strpos($row['access'], 'courseAddForm,courseEditForm') !== false){echo 'checked';} ?>> Course Edit</div>
                      <div style="display:inline-block;font-size:15px;padding:5px;"><input name="pages" type="checkbox" value="specialisation_add,specialisation_edit,specialisation_delete" <?php if(strpos($row['access'], 'specialisation_add,specialisation_edit,specialisation_delete') !== false){echo 'checked';} ?>> Specialisation Edit</div>
                      <div style="display:inline-block;font-size:15px;padding:5px;"><input name="pages" type="checkbox" value="user" > User</div>
                      <div style="display:inline-block;font-size:15px;padding:5px;"><input name="pages" type="checkbox" value="user_edit"> User Edit</div>
                      <div style="display:inline-block;font-size:15px;padding:5px;"><input name="pages" type="checkbox" value="user_add"> User Add</div>
                      <div style="display:inline-block;font-size:15px;padding:5px;"><input name="pages" type="checkbox" value="admission_form" > Admission Form</div>
                      <div style="display:inline-block;font-size:15px;padding:5px;"><input name="pages" type="checkbox" value="lead" > Leads</div>
                      <div style="display:inline-block;font-size:15px;padding:5px;"><input name="pages" type="checkbox" value="activity_log" > Activity Log</div>
                    </div>
                    <script>make_check('<?php echo $row['access'];?>');</script>
                    <div class="form-group">
                      <label for="city">City</label>
                      <input name="city" type="text" class="form-control" style="min-heigth:500px;min-width:100%;max-width:100%;"placeholder="City" value="<?php echo urldecode($row['city']);?>" required>
                    </div>
                    <div class="form-group">
                      <label for="addr">Address</label>
                      <input name="addr" type="text" class="form-control" style="min-heigth:500px;min-width:100%;max-width:100%;"placeholder="Address" value="<?php echo urldecode($row['address']);?>" required>
                    </div>
                    <div class="form-group">
                      <label for="phn_no">Contact Number</label>
                      <input name="phn_no" type="text" class="form-control" style="min-heigth:500px;min-width:100%;max-width:100%;"placeholder="Contact Number" value="<?php echo urldecode($row['phn_no']);?>" required>
                    </div>
                    <div class="form-group">
                      <label for="pass">Password</label>
                      <input name="pass" type="text" class="form-control" style="min-heigth:500px;min-width:100%;max-width:100%;"placeholder="Password" value="<?php echo $row['password'];?>" required>
                    </div>
                    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                  </form>
              </div>
            </div>

					</div><!-- /.page-content -->
				</div>
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
