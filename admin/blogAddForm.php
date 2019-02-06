<!DOCTYPE html>
<html lang="en">
	<head>
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

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--if lte IE 8>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<!endif-->
	</head>

	<body class="no-skin">
		
		<?php include('includes/navbar.php'); ?>
        <?php if(isset($_POST['submit'])){
            $title="";
            $content="";
            $errors[]="";
            if(isset($_POST['title'])){
                $title=$_POST['title'];
            }
            if(isset($_FILES['image'])){
                $errors= array();
                $file_name = $_FILES['image']['name'];
                $file_size =$_FILES['image']['size'];
                $file_tmp =$_FILES['image']['tmp_name'];
                $file_type=$_FILES['image']['type'];
                $t=explode('.',$_FILES['image']['name']);
                $file_ext=strtolower(end($t));
                $file_path="./assets/images/blogs_thumnail/";
            
                $extensions= array("jpeg","jpg","png");
                if(in_array($file_ext,$extensions)=== false){
                     $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                }
                if(empty($errors)==true){
                     if(move_uploaded_file($file_tmp,".".$file_path.$file_name)){
                         $path=$file_path.$file_name;
                     }
                }else{
                    print_r($errors);
                }
            }
            if(isset($_POST['title'])){
                $content=preg_replace("/[\n\r]/",'<br>',$_POST['content']);
                $res=$conn_p->query("INSERT INTO `blog`(`title`, `content`, `thumnail`) VALUES ('".$title."','".$content."','".$path."')");
                if($res){
                    echo "<script>alert('Successfully Added');window.location.href='./institutionAddForm.php';</script>";
                }else{
                    echo "<script>alert('Failed')</script>";
                }
           }
        } ?>
		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<?php include('includes/sidebar.php'); ?>

			<div class="main-content">

					<div class="page-content">
            
            <?php include('./settingsContainer.php'); ?>

            <div class='row menu-form'>
              <div class='col-lg-6'>
                  <h2 class='menu-text'>Add Blog</h2>
                  <form method="post" class='menu-content' action="" enctype="multipart/form-data" >
                    <div class="form-group">
                      <label for="title">Title</label>
                      <input name="title" type="text" class="form-control" placeholder="Blog Title" required>
                    </div>
                    <div class="form-group">
                      <label for="content">Content</label>
                      <textarea name="content" type="text" class="form-control" style="min-heigth:500px;min-width:100%;max-width:100%;"placeholder="Content" required></textarea>
                    </div>
                    <div class="form-group">
                      <label for="image">Thumnail</label>
                      <input name="image" type="file" class="form-control" placeholder="About Universities" required>
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
