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
            function submit_it(a){
							var input_=document.getElementsByName('input_');
							var butt=document.getElementById('butt');
							if(butt.value=="Update"){
                if(confirm("Want to update?")){
									if(confirm("Going to Update")){
										var formData = new FormData();
										formData.append('id',a);
										formData.append('title',input_[0].value);
										formData.append('content',input_[1].value);
										formData.append('image2', $('input[type=file]')[0].files[0]);
										formData.append('image1', $('input[type=file]')[1].files[0]);
										formData.append('content2',input_[2].value);
										formData.append('display',document.getElementsByName("select_")[0].value);
										formData.append('image', $('input[type=file]')[2].files[0]);
										$.ajax({
												url: "./blogeAddFormupdate.php",
												type: 'POST',
												cache: false,
												contentType: false,
												processData: false,
												data: formData,
												complete: function (data) {
														console.log(data.responseText);
														if(data.responseText=='1' || data.responseText=='11' || data.responseText=='111' || data.responseText=='1111'){
																alert("Successfully Added");
																butt.value="Edit";
																for(var i=0;i<input_.length;i++){
																	input_[i].disabled=true;
																}
																document.getElementsByName("image_")[0].disabled=true;
																document.getElementsByName("image_")[1].disabled=true;
																document.getElementsByName("image_")[2].disabled=true;
																document.getElementsByName("select_")[0].disabled=true;
																window.location.href="./blogEditForm";
														}else{
																alert("Something went wrong submit again");
														}
												}
										});
									}
								}
								}else{
									butt.value="Update";
									for(var i=0;i<input_.length;i++){
										input_[i].disabled=false;
									}
									document.getElementsByName("image_")[0].disabled=false;
									document.getElementsByName("image_")[1].disabled=false;
									document.getElementsByName("image_")[2].disabled=false;
									document.getElementsByName("select_")[0].disabled=false;
								}
            }
						function cancel_(a){
							var input_=document.getElementsByName('input_');
							var butt=document.getElementById('butt');
							if(butt.value=="Update"){
								butt.value="Edit";
								var formData= new FormData();
								formData.append('query','select * from blogs where id='+a);
								$.ajax({
									url: "./get_info.php",
									type: 'POST',
									cache: false,
									contentType: false,
									processData: false,
									data: formData,
									complete: function (data) {
										var temp=data.responseText.split("|");
										input_[0].value=temp[1];
										input_[1].value=temp[2];
										input_[2].value=temp[4];
										document.getElementsByName("select_")[0].value=temp[9];
									}
								});
								for(var i=0;i<input_.length;i++){
									input_[i].disabled=true;
								}
								document.getElementsByName("image_")[0].value=null;
								document.getElementsByName("image_")[1].value=null;
									document.getElementsByName("image_")[0].disabled=true;
									document.getElementsByName("image_")[1].disabled=true;
									document.getElementsByName("select_")[0].disabled=true;
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

			<?php include('includes/sidebar.php'); ?>

			<?php 
                function select_or_not($a){
                    if($a=='Yes'){
                        return 'selected';
                    }
                }
            ?>

			<div class="main-content">

					<div class="page-content">
				<a href="javascript:window.history.back();">Back</a>

            <?php include('./settingsContainer.php'); ?>
            <div class='row menu-form'>
                <?php if(isset($_GET['id'])){
                $id=$_GET['id'];
                $row=$conn_p->query("select * from blogs where id=".$id)->fetch_assoc();
                ?>
              <div class='col-lg-6' style="width:100%;">
                  <h2 class='menu-text'>Edit Blog</h2>
                  <form class='menu-content' id="form1" name="form1">
                      
                    <div class="form-group">
                    <label for="exampleInputPassword1">Title</label>
               		<input disabled name="input_" class="form-control" value="<?php echo $row['heading'] ?>" />
									 </div>
									 <div class="form-group">
									 	<?php if($row['title_bg']!="" && $row['title_bg']!=null){
											 echo "<img id='title_bg' src='.".$row['title_bg']."' style='width:50%;height:20rem;object-fit: cover;'><br>";
										 }?>
                      <label for="exampleInputPassword1">Title Bar Background</label>
                      <input disabled type="file" name="image_" accept="image/*" class="form-control">
                    </div>
               		<div class="form-group">
                    <label for="exampleInputPassword1">Content 1</label>
               		<textarea disabled name="input_" class="form-control" style="min-width:100%;max-width:100%;height:300px;" ><?php echo str_replace("<br>","\n",$row['content']); ?></textarea>
               		</div>
									 <div class="form-group">
									 	<?php if($row['img_src']!="" && $row['img_src']!=null){
											 echo "<img id='blog_img' src='.".$row['img_src']."' style='width:50%;height:100px;object-fit:cover;'><br>";
										 }?>
                      <label for="exampleInputPassword1">Blog Image</label>
                      <input disabled type="file" name="image_" accept="image/*" class="form-control">
                    </div>
									 <div class="form-group">
                    <label for="exampleInputPassword1">Content 2</label>
               		<textarea disabled name="input_" class="form-control" style="min-width:100%;max-width:100%;height:300px;" ><?php echo str_replace("<br>","\n",$row['content_2']); ?></textarea>
               		</div>
									 <select class='lbl' name='select_' style='width:100%;resize:vertical;height:auto;' disabled>
											<option value='No' <?php echo select_or_not($row['display'])?>>No</option>
											<option value='Yes' <?php echo select_or_not($row['display'])?> >Yes</option>
										</select>
                    <div class="form-group">
											<label for="exampleInputPassword1">Thumnail</label>
											<?php if($row['thumnail']!="" && $row['thumnail']!=null){
											 echo "<br><img id='thumnail' src='.".$row['thumnail']."' style='width:25%;'>";
										 }?>
                      <input disabled id="thumnail" type="file" name="image_" accept="image/*" class="form-control">
                    </div>
                    <br>
                    <input type="button" id="butt" class="btn btn-primary" onclick="submit_it('<?php echo $id; ?>')" name="btnsubmit" value="Edit"/>
                    <input type="button" class="btn btn-primary" onclick="cancel_('<?php echo $id; ?>')" value="Cancel"/>
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
