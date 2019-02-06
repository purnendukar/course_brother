
<?php ob_start();?>
<!DOCTYPE html>
<html lang="en">
	<head>
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


            function submit_it(a){
                var input_=document.getElementsByName('input_');
                var formData = new FormData();
                formData.append('id',a);
                formData.append('title',input_[0].value);
                formData.append('content',input_[1].value);
                formData.append('image', $('input[type=file]')[0].files[0]);
                $.ajax({
                    url: "./blogeAddFormupdate.php",
                    type: 'POST',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    complete: function (data) {
                        console.log(data.responseText);
                        if(data.responseText=='1' || data.responseText=='11'){
                            alert("Successfully Added");
                            window.location.href="./blogEditForm.php";
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
                <?php if(isset($_GET['id'])){
                $id=$_GET['id'];
                $row=$conn_p->query("select * from blog where id=".$id)->fetch_assoc();
                ?>
              <div class='col-lg-6'>
                  <h2 class='menu-text'>Edit Blog</h2>
                  <form class='menu-content' id="form1" name="form1" method="post" action="javascript:submit_it('<?php echo $id; ?>')">
                      <?php $row=$conn_p->query("select * from blog")->fetch_assoc(); ?>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Title</label>
               		<input name="input_" class="form-control" value="<?php echo $row['title'] ?>" />
               		</div>
               		<div class="form-group">
                    <label for="exampleInputPassword1">Content</label>
               		<textarea name="input_" class="form-control" style="min-width:100%;max-width:100%;height:300px;" ><?php echo str_replace("<br>","\n",$row['content']); ?></textarea>
               		</div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Thumnail</label>
                      <input id="thumnail" type="file" class="form-control">
                    </div>
                    <br>
                    <input type="submit" class="btn btn-primary" name="btnsubmit" value="Update"/>
                  </form>
              </div>
                <?php } ?>
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
