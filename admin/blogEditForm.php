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
		<title>Dashboard - Institution Edit Menu</title>

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
				function edit(a){
						window.location.href="./blogEditFormShow?id="+a;
				}
		</script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--if lte IE 8>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<!endif-->

        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>


	</head>

	<body class="no-skin">

		<?php include('./includes/navbar.php'); ?>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<?php include('includes/sidebar.php'); ?>

			<div class="main-content">

					<div class="page-content">

            <?php include('./settingsContainer.php'); ?>
            <div class='row menu-form' >
              <div class='col-lg-6' style="width:100%">
                  <h2 class='menu-text'>Institution Edit Menu</h2>
                  <form class='menu-content'  method="post" action="">
                      <table style="width:100%">
                            <tr style="padding:12px;">
                                <th width="30px" style="text-align:center; padding:10px">Id</th>
                                <th style="text-align:center; padding:10px">Title</th>
                                <th style="text-align:center; padding:10px">Image</th>
                            </tr>
                            <?php $res=$conn_p->query("select * from  blogs");
                            while($row=$res->fetch_assoc()){ echo "<tr class=\"form-group\">";
                          ?>
                          <td style="text-align:center; padding:10px"><?php echo $row['id'];?>
                          </td>
                          <td style="padding:10px" ><input type=text-area class="form-control" value="<?php echo $row['heading'];?>" disabled/>
                          </td>
                          <td style="text-align:center; padding:10px"><img name="<?php echo $row['id']."img"; ?>" width="100px" src="<?php echo ".".$row['thumnail'];?>"/>
                              <input  name="<?php echo $row['id']."image"?>" type="file" class="form-control" style="display:none; width:250px;"/>
                          </td>
                          <td><input type="button" class="btn btn-primary" style="width:80px" value="Edit" onclick="edit('<?php echo $row['id'];?>');"/>
                          </td>
                            <?php echo"</tr>";}
                            ?>
                        </table><!--
                    <div class="form-group">
                      <label for="exampleInputEmail1">Edit</label>
                      <input type="email" class="form-control" placeholder="Add Option">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Edit</label>
                      <input type="text" class="form-control" placeholder="Add Option">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button> -->
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
