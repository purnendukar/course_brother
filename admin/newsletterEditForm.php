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
            function edit_(a,b){
                window.location.href="./newsletterShow.php?id="+a+"&u_id="+b;
            }
            function delete_(a){
                if(confirm("Going to delete id "+a+" data")){
                var formData= new FormData();
                formData.append("id",a);
                $.ajax({
                        url: "./newsletterdelete.php",
                        type: 'POST',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        complete: function (data) {
                            if(data.responseText=='1'){
                                alert("Deleted");
                                document.getElementById("row"+a).style.display="none";
                            }else{
                                console.log(data.responseText);
                                alert("Not Deleted");
                            }
                        }
                    });
                }
            }
            function add(){
                var add_one=document.getElementById('add_one');
                if(add_one.style.display=='none'){
                    add_one.style.display="block";
                }else{
                    alert("Already displayed Enter your detail");
                }
            }
            function add_it(a){
                var input_=document.getElementsByName("input_");
                var heading=input_[0];
                var content=input_[1];
                if(heading.value==""||content.value==""){
                    alert("Fill all Feild");
                    return;
                }//problem in php
                var formData= new FormData();
                formData.append('heading',escape(heading.value));
                formData.append('content',escape(content.value));
                formData.append('u_id',a);
                $.ajax({
                        url: "./newsletteradd.php",
                        type: 'POST',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        complete: function (data) {
                            if(data.responseText=='1'){
                                alert("Data Added Succedd fully");
                                window.location.href="./newsletterEditForm.php?id="+a;
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
                if(isset($_GET['id'])){
                    $u_id=$_GET['id'];
                }
            ?>
				<div class='row menu-form'>
	              <div class='col-lg-6' style="width:100%; height:100%">
	                  <h2 class='menu-text'>News & Update <?php if(isset($_GET['id'])){echo "For ".$conn_p->query("select * from universities where u_id=".$u_id)->fetch_assoc()['u_name'];} ?></h2>
	                  <table id="tab" class='menu-content' style="width:100%">
                          <tr class="form-group">
                            <th style="padding:5px; text-align:center;" >id</th>
                              <th style="padding:5px; text-align:center;" >Heading</th>
                              <th style="padding:5px; text-align:center;" >Content</th>
                              <th style="padding:5px; text-align:center;" >Last Updated</th>
                          </tr>
                          <?php
                          $res=$conn_p->query("select * from news_update where u_id=".$u_id);
                          while($row=$res->fetch_assoc()){
                          ?>
                          <tr class="form-group" id="<?php echo "row".$row['id'] ?>">
                                <td style="text-align:center">
                                    <?php echo $row['id'];?>
                                </td>
                                <td style="padding:5px;">
                                  <input name="input_<?php echo $row['id']?>" style="padding:10px;" type="text" class="form-control" value="<?php echo urldecode($row['heading']);?>" disabled />
                                </td>
                                <td style="padding:5px;">
                                  <input name="input_<?php echo $row['id']?>" style="padding:10px;" type="text" class="form-control" value="<?php echo urldecode($row['content']);?>" disabled />
                                </td>
                                <td style="text-align:center">
                                    <?php echo $row['updated'];?>
                                </td>
                              <td>
                                  <input id="edit_update<?php echo $row['id']?>" class="btn btn-primary" style="width:85px; margin:5px;" type="button" value="Edit" onclick="edit_('<?php echo $row['id']?>','<?php echo $u_id;?>')" /><br>
                                  <input type="button" style="width:85px; margin:5px;" class="btn btn-primary" value="Delete" onclick="delete_('<?php echo $row['id']?>')"/>
                              </td>
                          </tr>
                            
                          <?php } ?>
                        </table>
                            <div id="add_one" style="width:100%; display:none;">
                                <div style="padding:5px; width:100%;"><input style="width:100%;" type="text" name="input_" class="form-control" placeholder="Heading"/></div>
                                <div style="padding:5px; width:100%;"><textarea style="min-width:100%;max-width:100%;height:100px;" type="text" name="input_" class="form-control" placeholder="Content"/></textarea></div>
                                <div style="width:100%;">
                                    <div style="text-align:center;">
                                        <input class="btn btn-primary" style="width:85px; margin:5px;" type="button" value="Add it" onclick="add_it('<?php echo $u_id;?>');" />
                                    </div>
                                </div>
                            </div>
                        <div class="form-group"  style="text-align:center; padding:30px;"><input type="button" style="width:100px;" class="btn btn-primary" value="Add One" onclick="add()"/></div>
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
