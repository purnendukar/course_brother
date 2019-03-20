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
            function submit_(a,b){
                var f= new FormData();
                f.append('id',b);
                f.append('status',a);
                $.ajax({
                    url: "./admission_status.php",
                    type: 'POST',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: f,
                    complete: function (data) {
                        console.log(data.responseText);
                        if(data.responseText=='1'){
                            alert("Successfully Updated");
                            window.location.href="./admission_form_view?id="+b;
                        }else{
                            alert("Something went wrong submit again");
                        }
                    }
                });
            }
        </script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--if lte IE 8>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<!endif-->
        <style>
            .head_{
                font-size:20px; 
                padding: 10px 0;
                display:block; 
                width:100%;
                text-align:center;
                background-color:#D9D9D9;
            }
        </style>
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
				<a href="javascript:window.history.back();">Back</a>

            <?php include('./settingsContainer.php'); ?>
            <div class='row menu-form'>
                <?php if(isset($_GET['id'])){
                $id=$_GET['id'];
                $row=$conn_p->query("select * from admission_form where id=".$id)->fetch_assoc();
                $a_id=$row['id'];
                ?>
                <div class='col-lg-6' style="width:100%;">
                    <h2 class='menu-text'>Admission Form</h2>
                    <div class='menu-content'>
                        <div class="head_">Basic Information</div>
                        <div style="font-size:15px; "><p style="width:30%;display:inline-block;">Student Name: </p><p style="width:70%;display:inline-block;"><?php echo urldecode($row['stud_name']);?></p></div>
                        <div style="font-size:15px;"><p style="width:30%;display:inline-block;">Father Name: </p><p style="width:70%;display:inline-block;"><?php echo urldecode($row['father_name']);?></p></div>
                        <div style="font-size:15px;"><p style="width:30%;display:inline-block;">Mother Name: </p><p style="width:70%;display:inline-block;"><?php echo urldecode($row['mother_name']);?></p></div>
                        <div style="font-size:15px;"><p style="width:30%;display:inline-block;">Email: </p><p style="width:70%;display:inline-block;"><?php echo urldecode($row['email']);?></p></div>
                        <div style="font-size:15px;"><p style="width:30%;display:inline-block;">Contact Number: </p><p style="width:70%;display:inline-block;"><?php echo urldecode($row['phn_no']);?></p></div>
                        <div style="font-size:15px;"><p style="width:30%;display:inline-block;">Permanent Address: </p><p style="width:70%;display:inline-block;"><?php echo urldecode($row['p_addr']);?></p></div>
                        <div style="font-size:15px;"><p style="width:30%;display:inline-block;">Current Address: </p><p style="width:70%;display:inline-block;"><?php echo urldecode($row['c_addr']);?></p></div>
                        <div style="font-size:15px;"><p style="width:30%;display:inline-block;">Alternate E-mail: </p><p style="width:70%;display:inline-block;"><?php if(urldecode($row['a_email'])!=""){echo urldecode($row['a_email']);}else{echo "Not Available";};?></p></div>
                        <div style="font-size:15px;"><p style="width:30%;display:inline-block;">Alternate Number: </p><p style="width:70%;display:inline-block;"><?php if(urldecode($row['a_phn_no'])!=""){echo urldecode($row['a_phn_no']);}else{echo "Not Available";};?></p></div>
                        <div style="font-size:15px;"><p style="width:30%;display:inline-block;">Identity: </p><p style="width:70%;display:inline-block;"><a target="blank" href="<?php echo $row['identity']; ?>">CLick Here</a></p></div>
                        <?php $f_id=$row['f_d_id']; $f=$conn_p->query("select * from full_detail where id=".$f_id)->fetch_assoc();?>
                        <div style="font-size:15px;"><p style="width:30%;display:inline-block;">Program: </p><p style="width:70%;display:inline-block;"><?php echo $conn_p->query("select * from program where p_id=".$f['prg_id'])->fetch_assoc()['p_name'];?></p></div>
                        <div style="font-size:15px;"><p style="width:30%;display:inline-block;">Course: </p><p style="width:70%;display:inline-block;"><?php echo $conn_p->query("select * from courses where id=".$f['c_id'])->fetch_assoc()['c_name'];?></p></div>
                        <div style="font-size:15px;"><p style="width:30%;display:inline-block;">Specialisation: </p><p style="width:70%;display:inline-block;"><?php echo $conn_p->query("select * from subject where id=".$f['s_id'])->fetch_assoc()['sub_name'];?></p></div>
                        <div style="font-size:15px;"><p style="width:30%;display:inline-block;">Delivery Mode: </p><p style="width:70%;display:inline-block;"><?php echo $conn_p->query("select * from delivery_mode where id=".$f['d_mode_id'])->fetch_assoc()['d_mode'];?></p></div>
                        <div style="font-size:15px;"><p style="width:30%;display:inline-block;">University: </p><p style="width:70%;display:inline-block;"><?php echo $conn_p->query("select * from universities where u_id=".$f['u_id'])->fetch_assoc()['u_name'];?></p></div>
                        <?php if($detail=$conn_p->query("select * from 10th_education where a_id=".$a_id)->fetch_assoc()){ ?>
                            <div class="head_">10th Education Detail</div>
                            <div style="font-size:15px;"><p style="width:30%;display:inline-block;"> School Name: </p><p style="width:70%;display:inline-block;"><?php echo urldecode($detail['school_name']);?></p></div>
                            <div style="font-size:15px;"><p style="width:30%;display:inline-block;"> Board: </p><p style="width:70%;display:inline-block;"><?php echo urldecode($detail['board']);?></p></div>
                            <div style="font-size:15px;"><p style="width:30%;display:inline-block;"> Percentage: </p><p style="width:70%;display:inline-block;"><?php echo urldecode($detail['percentage']);?></p></div>
                            <div style="font-size:15px;"><p style="width:30%;display:inline-block;"> Completion Year: </p><p style="width:70%;display:inline-block;"><?php echo urldecode($detail['c_year']);?></p></div>
                        <?php } ?>
                        <?php if($detail=$conn_p->query("select * from 12th_diploma where a_id=".$a_id)->fetch_assoc()){ ?>
                            <div class="head_"><?php echo $detail['degree'];?> Education Detail</div>
                            <div style="font-size:15px;"><p style="width:30%;display:inline-block;"> School Name: </p><p style="width:70%;display:inline-block;"><?php echo urldecode($detail['institute']);?></p></div>
                            <div style="font-size:15px;"><p style="width:30%;display:inline-block;"> Board: </p><p style="width:70%;display:inline-block;"><?php echo urldecode($detail['board']);?></p></div>
                            <div style="font-size:15px;"><p style="width:30%;display:inline-block;"> Specialisation: </p><p style="width:70%;display:inline-block;"><?php echo urldecode($detail['specialisation']);?></p></div>
                            <div style="font-size:15px;"><p style="width:30%;display:inline-block;"> Percentage: </p><p style="width:70%;display:inline-block;"><?php echo urldecode($detail['percentage']);?></p></div>
                            <div style="font-size:15px;"><p style="width:30%;display:inline-block;"> Completion Year: </p><p style="width:70%;display:inline-block;"><?php echo urldecode($detail['c_year']);?></p></div>
                        <?php } ?>
                        <?php if($detail=$conn_p->query("select * from graduation where a_id=".$a_id)->fetch_assoc()){ ?>
                            <div class="head_">Graduation Detail</div>
                            <div style="font-size:15px;"><p style="width:30%;display:inline-block;"> School Name: </p><p style="width:70%;display:inline-block;"><?php echo urldecode($detail['institute']);?></p></div>
                            <div style="font-size:15px;"><p style="width:30%;display:inline-block;"> Board: </p><p style="width:70%;display:inline-block;"><?php echo urldecode($detail['board']);?></p></div>
                            <div style="font-size:15px;"><p style="width:30%;display:inline-block;"> Course: </p><p style="width:70%;display:inline-block;"><?php echo urldecode($detail['degree']);?></p></div>
                            <div style="font-size:15px;"><p style="width:30%;display:inline-block;"> Specialisation: </p><p style="width:70%;display:inline-block;"><?php echo urldecode($detail['specialisation']);?></p></div>
                            <div style="font-size:15px;"><p style="width:30%;display:inline-block;"> Percentage: </p><p style="width:70%;display:inline-block;"><?php echo urldecode($detail['percentage']);?></p></div>
                            <div style="font-size:15px;"><p style="width:30%;display:inline-block;"> Completion Year: </p><p style="width:70%;display:inline-block;"><?php echo urldecode($detail['c_year']);?></p></div>
                        <?php } ?>
                    </div>
                </div>
                <?php }?>
            </div>
            </div><!-- /.page-content -->
			</div><!-- /.main-content -->

			<?php include('./footer.php'); ?>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
        <!-- <div style="position:fixed;top:0;width:100%;height:100%;background:rgb(0,0,0,0.2);">
            <img style="height:80%;top:50%;" src="<?php echo urldecode($row['identity']);?>" />
        </div> -->
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
