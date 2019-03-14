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
		<style>
			.img_display{
				width:50px;
				height:60px;
				object-fit:cover;
				transition:0.3s;
			}
			.img_display:hover{
				width:100px;
				height:120px;
				cursor:pointer;
				transition:0.3s;
			}
		</style>
		<!-- inline styles related to this page -->
		<link rel='stylesheet' href='./assets/custom/menuForm.css' />

		<!-- ace settings handler -->
		<script src="assets/js/ace-extra.min.js"></script>

        <script>
			//testimonial
			function cancel_(a){
                var img_display=document.getElementById("img_display"+a);
                var img_choose=document.getElementById("img_choose"+a);
                var input_= document.getElementsByName('input_'+a);
				if(input_[0].disabled==false){
					input_[0].value=head_;
                	input_[1].value=para_;
					input_[2].value=about_;
					input_[0].disabled=true;
                	input_[1].disabled=true;
					input_[2].disabled=true;
                    img_display.style.display="block";
                    img_choose.style.display="none";
				}
			}
			var head_;
			var para_;
			var about_;
            function edit_(a){
                var input_= document.getElementsByName('input_'+a);
                var head=input_[0];
                var para=input_[1];
				var about=input_[2];
				head_=head.value;
				para_=para.value;
				about_=about.value;
                var img_display=document.getElementById("img_display"+a);
                var img_choose=document.getElementById("img_choose"+a);
                if(input_[0].disabled==true){
                    for(var i=0;i<input_.length;i++){
                        input_[i].disabled=false;
                    }
                    img_display.style.display="none";
                    img_choose.style.display="block";
                }else{
                    if(confirm("Want to Update id "+a+" ?")){
                        if(confirm("Going to Update id "+a)){
                            var formData=new FormData();
                            formData.append('id',a);
                            formData.append('head',escape(head.value));
                            formData.append('para',escape(para.value));
                            formData.append('about',escape(about.value));

                            $.ajax({
                                url: "./testimonial_update.php",
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
                                        window.location.href="./Testimonial";
                                    }
                                }
                            });
                            var img_form=new FormData();
                                img_form.append('image',$('#img_choose'+a+'')[0].files[0]);
                                img_form.append('id',a);
                                $.ajax({
                                    url: "./testimonial_update.php",
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
                        }
                    }
                    head.disabled=true;
                    para.disabled=true;
                    about.disabled=true;
                    img_display.style.display="block";
                    img_choose.style.display="none";
                }
            }
            function delete_checked(){
                if(confirm("want to delete all checked data?")){
                    if(confirm("Going to delete all checked data")){
						var checked_=document.getElementsByName("check_id");
						var a="";
                        for(var i=0;i<checked_.length;i++){
                            if(checked_[i].checked){
								if(a==''){
									a+=checked_[i].value
								}else{
									a+=","+checked_[i].value;
								}
                            }
						}
                                var formData= new FormData();
                                formData.append("ids",a);
                                $.ajax({
                                    url: "./testimonial_delete.php",
                                    type: 'POST',
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    data: formData,
                                    complete: function (data) {
                                        if(data.responseText!='0'){
											window.location.href="./Testimonial"
                                        }else{
                                            console.log(data.responseText);
                                        }
                                    }
                                });
                    }
                }
            }
            function delete_(a){
                if(confirm("want to delete id "+a+"?")){
                    if(confirm("Going to delete id "+a+" data")){
                    var formData= new FormData();
                    formData.append("id",a);
                    $.ajax({
                            url: "./testimonial_delete.php",
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
            function add_it(){
                if(confirm("Want to add?")){
                    if(confirm("Going to add data")){
                        var input_=document.getElementsByName("input_");
                        var head=input_[0];
                        var para=input_[1];
                        var about=input_[2];
                        if(head.value==""||para.value==""||about.value==""||document.getElementById('img_choose').value==''){
                            alert("Fill all Feild");
                            return;
                        }
                        var formData= new FormData();
                        formData.append('head',escape(head.value));
                        formData.append('para',escape(para.value));
                        formData.append('about',escape(about.value));
                        formData.append('image',$('#img_choose')[0].files[0]);
                        $.ajax({
                                url: "./testimonial_add.php",
                                type: 'POST',
                                cache: false,
                                contentType: false,
                                processData: false,
                                data: formData,
                                complete: function (data) {
                                    if(data.responseText=='1'){
                                        alert("Data Added Succedd fully");
                                        window.location.href="./Testimonial"
                                    }else{
                                        console.log(data.responseText);
                                        alert("Data Not Added Try Again");
                                    }
                                }
                            });
                    }
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

			<div class="main-content">

					<div class="page-content">

            <?php include('./settingsContainer.php'); ?>
            <div class="row">
									<div class="col-xs-12">
										<h3 class="header smaller lighter blue">Testimonial</h3>

										<div class="clearfix">
											<div class="pull-right tableTools-container"></div>
										</div>
										<div class="table-header">
											Results Of testimonial
										</div>

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                                <div style="background-color: #EFF3F8;padding:15px 15px 5px 15px;">
                                                    <a href='javascript:delete_checked()' class='tooltip-error' data-rel='tooltip' title='Delete' >
                                                        <span class='red'>
                                                            <i class='ace-icon fa fa-trash-o bigger-120'></i>
                                                            Selected
                                                        </span>
                                                    </a>
                                                </div>
                                                <thead>
													<tr >
														<th class="center">
															<label class="pos-rel">
																<span class="lbl">Sl No</span>
															</label>
														</th>
														<th>Heading</th>
														<th>Sub-Heading</th>
                                                        <th>About</th>
                                                        <th>Images</th>
														<th class="hidden-480">Last Updated By</th>
														<th>Edit/Delete</th>
													</tr>
												</thead>
												<tbody>
												<?php
                                                    $sql="select * from testimonial";
                                                    $result=$conn_p->query($sql);
                                                    while($row=$result->fetch_assoc())      
                                                    {
												echo  
												"<tr id='row".$row['id']."'>
														<td class='center'>
                                                            <label class='pos-rel'>
                                                                <input name='check_id' type='checkbox' value='".$row['id']."' style='display:none;'/>
																<span  class='lbl'>".$row['id']."</span>
															</label>
														</td>

														<td>
                                                            <textarea class='lbl' name='input_".$row['id']."' style='width:100%;resize:vertical;height:35px;' disabled>".urldecode($row['head'])."</textarea>
														</td>
														<td> 
                                                            <textarea class='lbl' name='input_".$row['id']."' style='width:100%;resize:vertical;height:35px;' disabled>".urldecode($row['para'])."</textarea>
                                                        </td>
                                                        <td>
                                                            <textarea class='lbl' name='input_".$row['id']."' style='width:100%;resize:vertical;height:auto;' disabled>".urldecode($row['about'])."</textarea>
                                                        </td>
                                                        <td>
                                                            <img id='img_display".$row['id']."' class='img_display' src='.".$row['img_src']."' alt='image'/>
                                                            <input id='img_choose".$row['id']."' type='file' style='width:200px;display:none;' accept='image/*'/>
                                                        </td>
														<td class='hidden-480'>
                                                            <span class='label label-sm label-warning' style='height:auto' name='display".$row['id']."' >".$row['update_by']." <br/> ".$row['updated']."</span>
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
											<div id="add_one" class="form-group"  style="display:none;width:100%;text-align:center; padding:30px;">			
												<textarea style="resize:vertical;" type="text" name="input_" class="form-control" placeholder="Heading"></textarea>
												<textarea style="resize:vertical;" type="text" name="input_" class="form-control" placeholder="Sub Heading"></textarea>
												<textarea style="resize:vertical;" type="text" name="input_" class="form-control" placeholder="About"></textarea>
												<input type="file" id="img_choose" name="" style="margin:5px;" />
												<input class="btn btn-primary" style="width:85px; margin:5px;" type="button" value="Add it" onclick="add_it();" />
											</div>
											<div class="form-group"  style="text-align:center; padding:30px;"><input type="button" style="width:100px;" class="btn btn-primary" value="Add One" onclick="add()"/></div>
										</div>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
				

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
		</script>
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

		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

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
					  { "bSortable": false },
					  null, null, null, null, null,
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
