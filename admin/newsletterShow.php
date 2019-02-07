<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Dashboard - Index Page Add Menu</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />
		<!-- jquery accordian -->
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
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
            
            function add_it(a,b){
                var input_=document.getElementsByName("input_");
                var head=input_[0];
                var content=input_[1];
                if(head.value==""||content.value==""){
                    alert("Fill all Feild");
                    return;
                }
                var formData= new FormData();
                formData.append('id',a);
                formData.append('head',escape(head.value));
                formData.append('content',escape(content.value));
                
                $.ajax({
                        url: "./newsletter_update.php",
                        type: 'POST',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        complete: function (data) {
                            if(data.responseText=='1'){
                                alert("Data Added Succedd fully");
                                window.location.href="./newsletterEditForm.php?id="+b;
                            }else{
                                console.log(data.responseText);
                                alert("Data Not Added Try Again");
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
            <?php 
                $u_id='';
                $id='';
                if(isset($_GET['u_id']) && isset($_GET['id'])){
                    $u_id=$_GET['u_id'];
                    $id=$_GET['id'];
                }else{
                    header('./index.php');
                }
                $row=$conn_p->query("select * from news_update where id=".$id)->fetch_assoc();
            ?>
				<div class='row menu-form'>
	              <div class='col-lg-6' style="width:100%; height:100%">
	                  <h2 class='menu-text'>News & Update <?php if(isset($_GET['id'])){echo "For ".$conn_p->query("select * from universities where u_id=".$u_id)->fetch_assoc()['u_name'];} ?></h2>
                            <div id="add_one" style="width:100%;">
                                <div style="padding:5px; width:100%;"><input style="width:100%;" type="text" name="input_" class="form-control" required value="<?php echo urldecode($row['heading'])?>"/></div>
                                <div style="padding:5px; width:100%;"><textarea style="min-width:100%;max-width:100%;height:300px;" type="text" required name="input_" class="form-control" /><?php echo urldecode($row['content']);?></textarea></div>
                                <div style="width:100%;">
                                    <div style="text-align:center;">
                                        <input class="btn btn-primary" style="width:85px; margin:5px;" type="button" value="Update" onclick="add_it('<?php echo $id;?>','<?php echo $u_id;?>');" />
                                    </div>
                                </div>
                            </div>
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
		<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
			$( "#accordion" ).accordion();
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
