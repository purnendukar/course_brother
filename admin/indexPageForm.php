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
            //testimonial
            function edit_(a){
                var input_= document.getElementsByName('input_'+a);
                var head=input_[0];
                var link=input_[1];
                var img_display=document.getElementById("img_display"+a);
                var img_choose=document.getElementById("img_choose"+a);
                var butt=document.getElementById("edit_update"+a);
                if(butt.value=="Edit"){
                    head.disabled=false;
                    link.disabled=false;
                    butt.value="Update";
                    img_display.style.display="none";
                    img_choose.style.display="block";             
                }else{
                    var formData=new FormData();
                    formData.append('id',a);
                    formData.append('head',escape(head.value));
                    formData.append('link',escape(link.value));

                    $.ajax({
                        url: "./slider_update.php",
                        type: 'POST',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        complete: function (data) {
                            if(data.responseText=='01'){
                                alert("Data Updated");
                            }else{
                                alert("Data Not Updated");
                                window.location.href="./indexPageForm";
                            }
                        }
                    });
                    var img_form=new FormData();
                        img_form.append('image',$('#img_choose'+a+'')[0].files[0]);
                        img_form.append('id',a);
                        $.ajax({
                            url: "./slider_update.php",
                            type: 'POST',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: img_form,
                            complete: function (data) {
                                if(data.responseText!='0'){
                                    img_display.src="."+data.responseText;
                                    alert("Image Updated");
                                }else{
                                    console.log(data.responseText);
                                    alert("Image Not Updated");
                                }
                            }
                        });
                    head.disabled=true;
                    link.disabled=true;
                    butt.value="Edit";
                    img_display.style.display="block";
                    img_choose.style.display="none";
                }
            }
            function delete_(a){
                if(confirm("Going to delete id "+a+" data")){
                var formData= new FormData();
                formData.append("id",a);
                $.ajax({
                        url: "./slider_delete.php",
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
                    add_one.style.display="table-row";
                }else{
                    alert("Already displayed Enter your detail");
                }
            }
            function add_it(){
                var input_=document.getElementsByName("input_");
                var head=input_[0];
                var link=input_[1];
                if(head.value==""||link.value==""||document.getElementById('img_choose').value==''){
                    alert("Fill all Feild");
                    return;
                }
                var formData= new FormData();
                formData.append('head',escape(head.value));
                formData.append('link',escape(link.value));
                formData.append('image',$('#img_choose')[0].files[0]);
                $.ajax({
                        url: "./slider_add.php",
                        type: 'POST',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        complete: function (data) {
                            if(data.responseText=='1'){
                                alert("Data Added Successfully");
                                window.location.href="./indexPageForm";
                            }else{
                                console.log(data.responseText);
                                alert("Data Not Added Try Again");
                            }
                        }
                    });
            }
            
            //Features
            function edit_f(a){
                var input_= document.getElementsByName('input_f'+a);
                var head=input_[0];
                var info=input_[1];
                var img_display=document.getElementById("img_displayf"+a);
                var img_choose=document.getElementById("img_choosef"+a);
                var butt=document.getElementById("edit_updatef"+a);
                if(butt.value=="Edit"){
                    head.disabled=false;
                    info.disabled=false;
                    butt.value="Update";
                    img_display.style.display="none";
                    img_choose.style.display="block";             
                }else{
                    var formData=new FormData();
                    formData.append('id',a);
                    formData.append('head',escape(head.value));
                    formData.append('info',escape(info.value));

                    $.ajax({
                        url: "./feature_update.php",
                        type: 'POST',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        complete: function (data) {
                            if(data.responseText=='01'){
                                alert("Data Updated");
                            }else{
                                alert("Data Not Updated");
                                window.location.href="./indexPageForm";
                            }
                        }
                    });
                    var img_form=new FormData();
                        img_form.append('image',$('#img_choosef'+a+'')[0].files[0]);
                        img_form.append('id',a);
                        $.ajax({
                            url: "./feature_update.php",
                            type: 'POST',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: img_form,
                            complete: function (data) {
                                if(data.responseText!='0'){
                                    img_display.src="."+data.responseText;
                                    alert("Image Updated");
                                }else{
                                    console.log(data.responseText);
                                    alert("Image Not Updated");
                                }
                            }
                        });
                    
                    butt.value="Edit";
                    head.disabled=true;
                    info.disabled=true;
                    img_display.style.display="block";
                    img_choose.style.display="none";
                }
            }
            function delete_f(a){
                if(confirm("Going to delete id "+a+" data")){
                var formData= new FormData();
                formData.append("id",a);
                $.ajax({
                        url: "./feature_delete.php",
                        type: 'POST',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        complete: function (data) {
                            if(data.responseText=='1'){
                                alert("Deleted");
                                document.getElementById("rowf"+a).style.display="none";
                            }else{
                                console.log(data.responseText);
                                alert("Not Deleted");
                            }
                        }
                    });
                }
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
                var head=input_[0];
                var info=input_[1];
                if(head.value==""||info.value==""||document.getElementById('img_choosef').value==""){
                    alert("Fill all Feild");
                    return;
                }
                var formData= new FormData();
                formData.append('head',escape(head.value));
                formData.append('info',escape(info.value));
                formData.append('image',$('#img_choosef')[0].files[0]);
                $.ajax({
                        url: "./feature_add.php",
                        type: 'POST',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        complete: function (data) {
                            if(data.responseText=='1'){
                                alert("Data Added Succedd fully");
                                window.location.href="./indexPageForm";
                            }else{
                                console.log(data.responseText);
                                alert("Data Not Added Try Again");
                            }
                        }
                    });
            }
            
            //Featured Courses
            function f_course_sel(){
                var f_c=document.getElementsByName('featured_c');
                var t=false;
                for(var i=0;i<f_c.length;i++){
                    var formData= new FormData();
                    formData.append('id',f_c[i].value);
                    if(f_c[i].checked){
                        formData.append('check','yes');
                    }else{
                        formData.append('check','no');
                    }
                    t=$.ajax({
                       url: "./featured_checked.php",
                        type: 'POST',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        complete: function (data) {
                            if(data.responseText=='1'){
                                return false;
                            }else{
                                console.log(data.responseText);
                                return true;
                            }
                        } 
                    });
                    if(t==true){
                        alert("Data Not Added Try Again");
                        return;
                    }
                }
                alert("Successfully Added");
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
            <h3>Index Page</h3>
            <div id="accordion">
			  <h3>Slider</h3>
				<div class='row menu-form'>
	              <div class='col-lg-6' style="width:100%; height:100%">
	                  <h2 class='menu-text'>Slider</h2>
	                  <table id="tab" class='menu-content' style="width:100%">
                          <tr class="form-group">
                              <th style="padding:5px; text-align:center;" >Id</th>
                              <th style="padding:5px; text-align:center;" >Heading</th>
                              <th style="padding:5px; text-align:center;" >Link</th>
                              <th style="padding:5px; text-align:center;" >Image</th>
                          </tr>
                          <?php
                          $res=$conn_p->query("select * from slide_show");
                          while($row=$res->fetch_assoc()){
                          ?>
                          <tr class="form-group" id="<?php echo "row".$row['id'] ?>">
                              <td style="padding:5px;"><?php echo $row['id']; ?></td>
                              <td style="padding:5px;"><input name="input_<?php echo $row['id']?>" style="padding:10px;" type="text" class="form-control" value="<?php echo urldecode($row['head']);?>" disabled /></td>
                              <td style="padding:5px;">
                                  <input name="input_<?php echo $row['id']?>" style="padding:10px;" type="text" class="form-control" value="<?php echo urldecode($row['link'])?>" disabled />
                                </td>
                             
                              <td style="padding:5px;width:100px;height:100px;overflow:hidden;">
                                  <img id="img_display<?php echo $row['id']?>" style="width:180px;height:100px;object-fit:cover" src="<?php echo ".".$row['image_src']?>" />
                                  <input id="img_choose<?php echo $row['id']?>" type="file" style="width:200px;display:none;"/></td>
                              <td>
                                  <input id="edit_update<?php echo $row['id']?>" class="btn btn-primary" style="width:85px; margin:5px;" type="button" value="Edit" onclick="edit_('<?php echo $row['id']?>')" /><br>
                                  <input type="button" style="width:85px; margin:5px;" class="btn btn-primary" value="Delete" onclick="delete_('<?php echo $row['id']?>')"/>
                              </td>
                          </tr>
                          <?php } ?>
 
                          <tr id="add_one" style="display:none">
                              <td style="padding:5px;"></td>
                              <td style="padding:5px;"><input type="text" name="input_" class="form-control" placeholder="Heading"/></td>
                              <td style="padding:5px;"><input type="text" name="input_" class="form-control" placeholder="link"/></td>
                              <td style="padding:5px;"><input type="file" id="img_choose" name="" style="margin:5px;" /></td>
                              <td><input class="btn btn-primary" style="width:85px; margin:5px;" type="button" value="Add it" onclick="add_it();" /></td>
                          </tr>
                          
	                  </table>
                        <div class="form-group"  style="text-align:center; padding:30px;"><input type="button" style="width:100px;" class="btn btn-primary" value="Add One" onclick="add()"/></div>
	              </div>
	            </div>
			  
			  <h3>Why Select Us</h3>
			    <div class='row menu-form'>
	              <div class='col-lg-6' style="width:100%; height:100%">
	                  <h2 class='menu-text'>Slider</h2>
	                  <table id="tab" class='menu-content' style="width:100%">
                          <tr class="form-group">
                              <th style="padding:5px; text-align:center;" >Id</th>
                              <th style="padding:5px; text-align:center;" >Heading</th>
                              <th style="padding:5px; text-align:center;" >Information</th>
                              <th style="padding:5px; text-align:center;" >Image</th>
                          </tr>
                          <?php
                          $res=$conn_p->query("select * from features");
                          while($row=$res->fetch_assoc()){
                          ?>
                          <tr class="form-group" id="<?php echo "rowf".$row['id'] ?>">
                              <td style="padding:5px;"><?php echo $row['id']; ?></td>
                              <td style="padding:5px;">
                                  <input name="input_f<?php echo $row['id']?>" style="padding:10px;" type="text" class="form-control" value="<?php echo urldecode($row['heading']);?>" disabled />
                              </td>
                              <td style="padding:5px;">
                                  <input name="input_f<?php echo $row['id']?>" style="padding:10px;" type="text" class="form-control" value="<?php echo urldecode($row['info'])?>" disabled />
                                </td>
                             
                              <td style="padding:5px;width:100px;height:100px;overflow:hidden;">
                                  <img id="img_displayf<?php echo $row['id']?>" style="width:100px;height:100px;" src="<?php echo ".".$row['img_src']?>" />
                                  <input id="img_choosef<?php echo $row['id']?>" type="file" style="width:200px;display:none;"/></td>
                              <td>
                                  <input id="edit_updatef<?php echo $row['id']?>" class="btn btn-primary" style="width:85px; margin:5px;" type="button" value="Edit" onclick="edit_f('<?php echo $row['id']?>')" /><br>
                                  <input type="button" style="width:85px; margin:5px;" class="btn btn-primary" value="Delete" onclick="delete_f('<?php echo $row['id']?>')"/>
                              </td>
                          </tr>
                          <?php } ?>
 
                          <tr id="add_onef" style="display:none">
                              <td style="padding:5px;"></td>
                              <td style="padding:5px;"><input type="text" name="input_f" class="form-control" placeholder="Heading"/></td>
                              <td style="padding:5px;"><input type="text" name="input_f" class="form-control" placeholder="link"/></td>
                              <td style="padding:5px;"><input type="file" id="img_choosef" name="" style="margin:5px;" /></td>
                              <td><input class="btn btn-primary" style="width:85px; margin:5px;" type="button" value="Add it" onclick="add_it_f();" /></td>
                          </tr>
                          
	                  </table>
                        <div class="form-group"  style="text-align:center; padding:30px;"><input type="button" style="width:100px;" class="btn btn-primary" value="Add One" onclick="add_f()"/></div>
	              </div>
	            </div>
			  
                <h3>Featured Courses</h3>
			    <div class='row menu-form'>
	              <div class='col-lg-6'>
                      <?php $res=$conn_p->query('select * from featured_courses');
                      ?>
	                  <h2 class='menu-text'>Featured Courses</h2>
	                  <form class='menu-content' >
	                    <div class="form-group">
                            <?php while($row=$res->fetch_assoc()){ ?>
                                    <div><input name='featured_c' type='checkbox' value='<?php echo $row['id']?>' <?php if($row['checked']=="yes") echo "checked";?> /> <?php echo $row['c_name'];?></div>
                            <?php } ?>
	                    </div>
	                    <button type="button" class="btn btn-primary" onclick="f_course_sel()">Submit</button>
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
