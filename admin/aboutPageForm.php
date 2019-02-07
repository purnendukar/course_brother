<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Dashboard - About Page Add Menu</title>

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
            function about_edit(){
                var about = document.getElementById("about");
                var f=new FormData();
                f.append('content',about.value);
                
                $.ajax({
                        url: "./about_update.php",
                        type: 'POST',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: f,
                        complete: function (data) {
                            if(data.responseText=='1'){
                                alert("Data Updated Successfully");
                            }else{
                                alert("Data Not Updated Try Again");
                                window.location.href="./aboutPageForm.php";
                            }
                        }
                });
            }
            function provide_edit(){
                var about = document.getElementsByName("provide_");
                var f=new FormData();
                for(var i=0;i<about.length;i++){
                    f.append('provide'+i,about[i].value);
                }
                $.ajax({
                        url: "./provide_update.php",
                        type: 'POST',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: f,
                        complete: function (data) {
                            if(data.responseText=='1111'){
                                alert("Data Updated Successfully");
                            }else{
                                alert("Data Not Updated Try Again");
                                window.location.href="./aboutPageForm.php";
                            }
                        }
                });
            }
            function add_f(){
                var add_one=document.getElementById('add_onef');
                if(add_one.style.display=='none'){
                    add_one.style.display="table-row";
                }else{
                    alert("Already displayed Enter your detail");
                }
            }
            function add_it_f(){
                var input_=document.getElementsByName("input_f");
                var name=input_[0];
                var position=input_[1];
                var about=input_[2];
                if(name.value=="" || position.value=="" || about.value=="" || document.getElementById('img_choosef').value==""){
                    alert("Fill all Feild");
                    return;
                }
                var formData= new FormData();
                formData.append('name',name.value);
                formData.append('position',position.value);
                formData.append('about',about.value);
                formData.append('image',$('#img_choosef')[0].files[0]);
                $.ajax({
                        url: "./team_member_add.php",
                        type: 'POST',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        complete: function (data) {
                            if(data.responseText=='1'){
                                alert("Data Added Successfully");
                                window.location.href="./aboutPageForm.php";
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
            <h3>About Page</h3>
            <div id="accordion">
			  <h3>Slider</h3>
				<div class='row menu-form' >
	              <div class='col-lg-6' style="width:100%;height:100%">
	                  <h2 class='menu-text'>About</h2>
	                  <div id="tab" class='menu-content' style="width:100%">
                          
                          <div class="form-group" id="<?php echo "row".$row['id'] ?>">
                                <?php $t=$conn_p->query("select * from about");?>
                                <textarea id="about" style="min-width:100%;max-width:100%;height:300px;"><?php echo urldecode($t->fetch_assoc()['content']); ?></textarea>
                                <div style="text-align:center;padding:10px;">
                                    <input class="btn btn-primary" type="button" onclick="about_edit();" value="Update" />
                                </div>
                          </div> 
                          
	                  </div>
                        
	              </div>
	            </div>
			  
			  <h3>Provide you</h3>
			    <div class='row menu-form'>
	              <div class='col-lg-6' style="width:100%; height:100%">
	                  <h2 class='menu-text'>WE STRIVE TO PROVIDE YOU WITH</h2>
                      <div id="tab" class='menu-content' style="width:100%">
                        <?php $t=$conn_p->query("select * from provide");?>
                        <div class="form-group" id="<?php echo "row".$row['id'] ?>">
                            <div style="padding-bottom:10px;"><b>VERSATILITY</b></div>
                            <textarea name="provide_" style="min-width:100%;max-width:100%;height:100px;"><?php echo urldecode($t->fetch_assoc()['content']); ?></textarea>
                        </div>
                        <div class="form-group" id="<?php echo "row".$row['id'] ?>">
                            <div style="padding-bottom:10px;"><b>CONVENIENCE</b></div>
                            <textarea name="provide_" style="min-width:100%;max-width:100%;height:100px;"><?php echo urldecode($t->fetch_assoc()['content']); ?></textarea>
                        </div>
                        <div class="form-group" id="<?php echo "row".$row['id'] ?>">
                            <div style="padding-bottom:10px;"><b>AUTHENTICITY</b></div>
                            <textarea name="provide_" style="min-width:100%;max-width:100%;height:100px;"><?php echo urldecode($t->fetch_assoc()['content']); ?></textarea>
                        </div>
                        <div class="form-group" id="<?php echo "row".$row['id'] ?>">
                            <div style="padding-bottom:10px;"><b>SUPPORT</b></div>
                            <textarea name="provide_" style="min-width:100%;max-width:100%;height:100px;"><?php echo urldecode($t->fetch_assoc()['content']); ?></textarea>
                        </div>
                        <div style="text-align:center;padding:10px;">
                            <input class="btn btn-primary" type="button" onclick="provide_edit();" value="Update" />
                        </div>
	                  </div>
	              </div>
	            </div>
			  
                <h3>Team Member</h3>
			    <div class='row menu-form'>
	              <div class='col-lg-6' style="width:100%;">
	                  <h2 class='menu-text'>Team Member</h2>
	                  <form class='menu-content' style="width:100%;">
                      <table id="tab" class='menu-content' style="width:100%">
                          <tr class="form-group">
                              <th style="padding:5px; text-align:center;" >Name</th>
                              <th style="padding:5px; text-align:center;" >Position</th>
                              <th style="padding:5px; text-align:center;" >About</th>
                              <th style="padding:5px; text-align:center;" >Image</th>
                          </tr>
                          <?php
                          $res=$conn_p->query('select * from team');
                          while($row=$res->fetch_assoc()){
                          ?>
                          <tr class="form-group" id="<?php echo "row".$row['id'] ?>">
                                <td style="padding:5px;">
                                    <input name="input_<?php echo $row['id']?>" style="padding:10px;" type="text" class="form-control" value="<?php echo urldecode($row['name']);?>" disabled />
                                </td>
                                <td style="padding:5px;">
                                    <input name="input_<?php echo $row['id']?>" style="padding:10px;" type="text" class="form-control" value="<?php echo urldecode($row['position']);?>" disabled />
                                </td>
                                <td style="padding:5px;">
                                    <input name="input_<?php echo $row['id']?>" style="padding:10px;" type="text" class="form-control" value="<?php echo urldecode($row['about'])?>" disabled />
                                    </td>
                                
                                <td style="padding:5px;width:100px;height:100px;overflow:hidden;">
                                    <img id="img_display<?php echo $row['id']?>" style="width:100px;height:100px;object-fit:cover" src="<?php echo ".".$row['img_src']?>" />
                                    <input id="img_choose<?php echo $row['id']?>" type="file" style="width:200px;display:none;"/></td>
                                <td>
                                    <input id="edit_update<?php echo $row['id']?>" class="btn btn-primary" style="width:85px; margin:5px;" type="button" value="Edit" onclick="edit_('<?php echo $row['id']?>')" /><br>
                                    <input type="button" style="width:85px; margin:5px;" class="btn btn-primary" value="Delete" onclick="delete_('<?php echo $row['id']?>')"/>
                                </td>
                          </tr>
                          <?php } ?>
 
                            <tr id="add_onef" style="display:none">
                                <td style="padding:5px;">
                                    <input type="text" name="input_f" class="form-control" placeholder="Name"/>
                                </td>
                                <td style="padding:5px;">
                                    <input type="text" name="input_f" class="form-control" placeholder="Position"/>
                                </td>
                                <td style="padding:5px;">
                                    <input type="text" name="input_f" class="form-control" placeholder="About"/>
                                </td>
                                <td style="padding:5px;">
                                    <input type="file" id="img_choosef" style="margin:5px;" />
                                </td>
                                <td>
                                    <input class="btn btn-primary" style="width:85px; margin:5px;" type="button" value="Add it" onclick="add_it_f();" />
                                </td>
                            </tr>
                          
	                  </table>
                        <div class="form-group"  style="text-align:center; padding:30px;">
                            <input type="button" style="width:100px;" class="btn btn-primary" value="Add One" onclick="add_f()"/>
                        </div>
	                  </form>
                      
	              </div>
	            </div>
	            <h3>Service Section List</h3>
			    <div class='row menu-form'>
	              <div class='col-lg-6'>
	                  <h2 class='menu-text'>Edit Service Section List</h2>
	                  <form class='menu-content'>
	                    <div class="form-group">
	                      <label for="exampleInputEmail1">Edit Heading 1</label>
	                      <input type="email" class="form-control" placeholder="Add Option">
	                    </div>
	                    <div class="form-group">
	                      <label for="exampleInputEmail1">Edit Description 1</label>
	                      <input type="email" class="form-control" placeholder="Add Option">
	                    </div>
	                    <div class="form-group">
	                      <label for="exampleInputEmail1">Edit Heading 2</label>
	                      <input type="email" class="form-control" placeholder="Add Option">
	                    </div>
	                    <div class="form-group">
	                      <label for="exampleInputEmail1">Edit Description 2</label>
	                      <input type="email" class="form-control" placeholder="Add Option">
	                    </div>
	                    <div class="form-group">
	                      <label for="exampleInputEmail1">Edit Heading 3</label>
	                      <input type="email" class="form-control" placeholder="Add Option">
	                    </div>
	                    <div class="form-group">
	                      <label for="exampleInputEmail1">Edit Description 3</label>
	                      <input type="email" class="form-control" placeholder="Add Option">
	                    </div>
	                    <div class="form-group">
	                      <label for="exampleInputEmail1">Edit Heading 4</label>
	                      <input type="email" class="form-control" placeholder="Add Option">
	                    </div>
	                    <div class="form-group">
	                      <label for="exampleInputEmail1">Edit Description 4</label>
	                      <input type="email" class="form-control" placeholder="Add Option">
	                    </div>
	                    <button type="submit" class="btn btn-primary">Submit</button>
	                  </form>
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
