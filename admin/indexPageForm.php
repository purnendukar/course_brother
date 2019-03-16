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
        <style>
			.img_display{
				width:90px;
				height:50px;
				object-fit:cover;
				transition:0.3s;
			}
			.img_display:hover{
				width:180px;
				height:100px;
				cursor:pointer;
				transition:0.3s;
			}
		</style>
		<!-- ace settings handler -->
		<script src="assets/js/ace-extra.min.js"></script>

        <script>
            var head_,link_,select_; 
            //testimonial
            function edit_(a){
                var input_= document.getElementsByName('input_'+a);
                var head=input_[0];
                var link=input_[1];
                var img_display=document.getElementById("img_display"+a);
                var img_choose=document.getElementById("img_choose"+a);
                var butt=document.getElementById("edit_update"+a);
				var select_t=document.getElementsByName('select_'+a)[0];
                head_=head.value;
                link_=link.value;
                select_=select_t.value;
                if(butt.value=="Edit"){
                    head.disabled=false;
                    link.disabled=false;
					select_t.disabled=false;
                    butt.value="Update";
                    img_display.style.display="none";
                    img_choose.style.display="block";
                }else{
                    if(confirm("Want to Update?")){if(confirm("Going to update")){
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
					    select_t.disabled=true;
                        butt.value="Edit";
                        img_display.style.display="block";
                        img_choose.style.display="none";
                    }
                }}
            }
            function delete_(a){
                if(confirm("Want to delete?")){
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
            }
            function add(){
                var add_one=document.getElementById('add_one');
                if(add_one.style.display=='none'){
                    add_one.style.display="";
                }else{
                    alert("Already displayed Enter your detail");
                }
            }
            function cancel_(a){
                var img_display=document.getElementById("img_display"+a);
                var img_choose=document.getElementById("img_choose"+a);
                var input_= document.getElementsByName('input_'+a);
				var select_t=document.getElementsByName('select_'+a)[0];
				if(input_[0].disabled==false){
					input_[0].value=head_;
                	input_[1].value=link_;
					input_[0].disabled=true;
                	input_[1].disabled=true;
					input_[2].disabled=true;
                    img_display.style.display="block";
                    img_choose.style.display="none";
					select_t.value=select_;
					select_t.disabled=true;
				}
            }
            
			function cancel_add(){
				var temp=document.getElementsByName('input_');
				for (var i=0;i<temp.length;i++){
					temp[i].value="";
				}
				document.getElementById('add_one').style.display="none";
			}
            function add_it(){
                if(confirm("Want to Update?")){if(confirm("Going to update")){
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
                }}
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
                    if(confirm("Want to Update?")){if(confirm("Going to update")){
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
                    }}
                }
            }
            function delete_f(a){
                if(confirm("Want to delete id "+a+"?")){
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
                if(confirm("Want to add?")){if(confirm("Going to add")){
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
                }}
            }

            //Featured Courses
            function f_course_sel(){
                if(confirm("Going to update")){
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
            <?php 
                function select_or_not($a){
                    if($a=='Yes'){
                        return 'selected';
                    }
                }
            ?>
			<?php include('includes/sidebar.php'); ?>

			<div class="main-content">

					<div class="page-content">

            <?php include('./settingsContainer.php'); ?>
            <h3>Index Page</h3>
            <div id="accordion">
			  <h3>Slider</h3>
                        <div class="row">
									<div class="col-xs-12">
										<h3 class="header smaller lighter blue">Slider</h3>

										<div class="clearfix">
											<div class="pull-right tableTools-container"></div>
										</div>
										<div class="table-header">
											Results Of Slider
										</div>

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                                <div style="background-color: #EFF3F8;padding:15px 15px 5px 15px;">
                                                    <a href='javascript:delete_checked()' class='tooltip-error ' data-rel='tooltip' title='Delete' >
                                                        <span class='red'>
                                                            <i class='ace-icon fa fa-trash-o bigger-120'></i>
                                                            Selected
                                                        </span>
                                                    </a>
													<a style="margin-left:125px;" class="btn btn-primary" href="javascript:add()">Add New Slider</a>
													<div id="add_one" class="form-group"  style="display:none;width:100%;text-align:center; padding:30px;">			
														<textarea style="resize:vertical;width:100%;" type="text" name="input_" class="form-control" placeholder="Content"></textarea>
														<textarea style="resize:vertical;" type="text" name="input_" class="form-control" placeholder="link"></textarea>
														<input type="file" id="img_choose" accept="image/*" style="margin:5px;" />
														<input class="btn btn-primary" style="width:100px; margin:5px;" type="button" value="Confirm" onclick="add_it();" />
														<input class="btn btn-primary" style="width:85px; margin:5px;" type="button" value="Cancel" onclick="cancel_add()" />
													</div>
                                                </div>
                                                <thead>
													<tr >
													<th class="center sorting_disabled" rowspan="1" colspan="1" aria-label="">
															<label class="pos-rel">
																<input type="checkbox" class="ace">
																<span class="lbl"></span>
															</label>
														</th>
														<th class="center">
															<label class="pos-rel">
																<span class="lbl">Id</span>
															</label>
														</th>
														<th style="text-align:center">Content</th>
														<th style="text-align:center">Link</th>
                                                        <th style="text-align:center">Display</th>
                                                        <th style="text-align:center">Images</th>
														<th style="text-align:center" class="hidden-480">Last Updated By</th>
														<th style="text-align:center">Edit/Delete</th>
													</tr>
												</thead>
												<tbody>
												<?php
                                                    $sql="select * from slide_show";
                                                    $result=$conn_p->query($sql);
                                                    while($row=$result->fetch_assoc())      
                                                    {
												echo  
												"<tr id='row".$row['id']."'>
														<td class='center'>
															<label class='pos-rel'>
																<input name='check_id'  value='".$row['id']."'  type='checkbox' class='ace'>
																<span class='lbl'></span>
															</label>
														</td>
														<td class='center'>
                                                            <label class='pos-rel'>
																<span  class='lbl'>".$row['id']."</span>
															</label>
														</td>

														<td>
                                                            <textarea class='lbl' name='input_".$row['id']."' style='width:100%;resize:vertical;height:35px;' disabled>".urldecode($row['head'])."</textarea>
														</td>
														<td> 
                                                            <textarea class='lbl' name='input_".$row['id']."' style='width:100%;resize:horizontal;height:35px;' disabled>".urldecode($row['link'])."</textarea>
                                                        </td>
														<td>
															<select class='lbl' name='select_".$row['id']."' style='width:100%;resize:vertical;height:auto;' disabled>
																<option value='No' ".select_or_not($row['display']).">No</option>
																<option value='Yes' ".select_or_not($row['display']).">Yes</option>
															</select>
														</td>
                                                        <td>
                                                            <img id='img_display".$row['id']."' class='img_display' src='.".$row['image_src']."' alt='image'/>
                                                            <input id='img_choose".$row['id']."' type='file' style='width:200px;display:none;' accept='image/*'/>
                                                        </td>
														<td class='hidden-480'>
                                                            <span class='label label-sm label-warning' style='height:auto;font-size:13px;' name='display".$row['id']."' >".$row['update_by']." <br/>".str_replace(' ','<br>',$row['updated'])."</span>
														</td>
														<td style='width:120px'>
															<div class='hidden-sm hidden-xs action-buttons'>
																
																<a class='green' href='javascript:edit_(".$row['id'].")' class='tooltip-success'>
																	<i class='ace-icon fa fa-pencil bigger-130'></i>
																</a>

																<a class='red' href='javascript:delete_(".$row['id'].")' >
																	<i class='ace-icon fa fa-trash-o bigger-130'></i>
                                                                </a>
                                                                
                                                                <a class='blue' href='javascript:cancel_(".$row['id'].")' >
																	<i class='ace-icon fa fa-times red2 bigger-130'></i>
																</a>
															</div>

															<div class='hidden-md hidden-lg'>
																<div class='inline pos-rel'>
																	<button class='btn btn-minier btn-yellow dropdown-toggle' data-toggle='dropdown' data-position='auto'>
																		<i class='ace-icon fa fa-caret-down icon-only bigger-120'></i>
																	</button>

																	<ul class='dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close'>
																		
																		<li>
																			<a href='javascript:edit_(".$row['id'].")'  class='tooltip-success' data-rel='tooltip' title='Edit'>
																				<span class='green'>
																					<i class='ace-icon fa fa-pencil-square-o bigger-120'></i>
																				</span>
																			</a>
																		</li>

																		<li>
																			<a href='javascript:delete_(".$row['id'].")' class='tooltip-error' data-rel='tooltip' title='Delete' >
																				<span class='red'>
																					<i class='ace-icon fa fa-trash-o bigger-120'></i>
																				</span>
																			</a>
                                                                        </li>
                                                                        
                                                                        <li>
																			<a href='javascript:cancel_(".$row['id'].")' class='tooltip-info' data-rel='tooltip' title='View'>
																				<span class='blue'>
																					<i class='ace-icon fa fa-times red2 bigger-120'></i>
																				</span>
																			</a>
																		</li>

																	</ul>
																</div>
															</div>
														</td>
													</tr>";} ?>
												</tbody>
											</table>
											<div class="form-group"  style="text-align:center; padding:30px;"></div>
										</div>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
				<!-- <div class='row menu-form'>
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
                                  <img id="img_display<?php echo $row['id']?>" style="width:180px;height:100px;object-fit:cover" src="<?php echo ".".$row['image_src']?>" alt="image"/>
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
	            </div> -->

			  <h3>Why Select Us</h3>
			    <div class='row menu-form'>
	              <div class='col-lg-6' style="width:100%; height:100%">
	                  <h2 class='menu-text'>Why Select Us</h2>
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
                                  <img id="img_displayf<?php echo $row['id']?>" style="width:100px;height:100px;" src="<?php echo ".".$row['img_src']?>" alt="image"/>
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
                              <td><input class="btn btn-primary" style="width:85px; margin:5px;" type="button" value="Confirm" onclick="add_it_f();" /></td>
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

		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>
     <!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>
		<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script src="assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="assets/js/dataTables.buttons.min.js"></script>
		<script src="assets/js/buttons.flash.min.js"></script>
		<script src="assets/js/buttons.html5.min.js"></script>
		<script src="assets/js/buttons.print.min.js"></script>
		<script src="assets/js/buttons.colVis.min.js"></script>
		<script src="assets/js/dataTables.select.min.js"></script>
		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				//initiate dataTables plugin
				var myTable = 
				$('#dynamic-table')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.DataTable( {
					bAutoWidth: false,
					"aoColumns": [
					  { "bSortable": false },{ "bSortable": false },
					  null, null, null, null, null, null,
					  { "bSortable": false }
					],
					"aaSorting": [],
					
					
					//"bProcessing": true,
			        //"bServerSide": true,
			        //"sAjaxSource": "http://127.0.0.1/table.php"	,
			
					//,
					//"sScrollY": "200px",
					//"bPaginate": false,
			
					//"sScrollX": "100%",
					//"sScrollXInner": "120%",
					//"bScrollCollapse": true,
					//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
					//you may want to wrap the table inside a "div.dataTables_borderWrap" element
			
					//"iDisplayLength": 50
			
			
					select: {
						style: 'multi'
					}
			    } );
			
				
				
				$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
				
				new $.fn.dataTable.Buttons( myTable, {
					buttons: [
					  {
						"extend": "colvis",
						"text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
						"className": "btn btn-white btn-primary btn-bold",
						columns: ':not(:first):not(:last)'
					  },
					  {
						"extend": "copy",
						"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "csv",
						"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "excel",
						"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "pdf",
						"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "print",
						"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
						"className": "btn btn-white btn-primary btn-bold",
						autoPrint: false,
						message: 'This print was produced using the Print button for DataTables'
					  }		  
					]
				} );
				myTable.buttons().container().appendTo( $('.tableTools-container') );
				
				//style the message box
				var defaultCopyAction = myTable.button(1).action();
				myTable.button(1).action(function (e, dt, button, config) {
					defaultCopyAction(e, dt, button, config);
					$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
				});
				
				
				var defaultColvisAction = myTable.button(0).action();
				myTable.button(0).action(function (e, dt, button, config) {
					
					defaultColvisAction(e, dt, button, config);
					
					
					if($('.dt-button-collection > .dropdown-menu').length == 0) {
						$('.dt-button-collection')
						.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
						.find('a').attr('href', '#').wrap("<li />")
					}
					$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
				});
			
				////
			
				setTimeout(function() {
					$($('.tableTools-container')).find('a.dt-button').each(function() {
						var div = $(this).find(' > div').first();
						if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
						else $(this).tooltip({container: 'body', title: $(this).text()});
					});
				}, 500);
				
				
				
				
				
				myTable.on( 'select', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
					}
				} );
				myTable.on( 'deselect', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
					}
				} );
			
			
			
			
				/////////////////////////////////
				//table checkboxes
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				
				//select/deselect all rows according to table header checkbox
				$('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#dynamic-table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable.row(row).select();
						else  myTable.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) myTable.row(row).deselect();
					else myTable.row(row).select();
				});
			
			
			
				$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});
				
				
				
				//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table header checkbox
				var active_class = 'active';
				$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if($row.is('.detail-row ')) return;
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});
			
				
			
				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
				
				
				
				
				/***************/
				$('.show-details-btn').on('click', function(e) {
					e.preventDefault();
					$(this).closest('tr').next().toggleClass('open');
					$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
				});
				/***************/
				
				
				
				
				
				/**
				//add horizontal scrollbars to a simple table
				$('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
				  {
					horizontal: true,
					styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
					size: 2000,
					mouseWheelLock: true
				  }
				).css('padding-top', '12px');
				*/
			
			
			});
		</script>
	</body>
</html>
