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

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--if lte IE 8>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<!endif-->

        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

        <script>
            function send_data(u_id,u_name,about,image,reg_fees){
                $.ajax({
                      type: "POST",
                      url: "./includes/update_univesities.php",
                      data: {u_id:u_id,u_name:u_name,about:about,reg_fees:reg_fees},
                      complete: function(data){
                                //data contains the response from the php file.
                                //u can pass it here to the javascript function
                                console.log(data.responseText);
                                if(data.responseText=='01'){
                                    alert("data updated");
                                }else{
                                    alert("data not updated");
                                }
                            }
                    });

                var formData = new FormData();
                formData.append('image',$('#'+u_id+'image')[0].files[0]);
                formData.append('u_id',u_id);

                $.ajax({
                    url: "./includes/update_univesities.php",
                    type: 'POST',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    complete: function (data) {
                        if(data.responseText!='0'){
                            image.src="."+data.responseText;
                            alert("image updated");
                        }else{
                            alert("image not updated");
                        }
                    }
                });

            }


            function change_(a){
                var but=document.getElementsByName(a+"edit_update");
                var u_name=document.getElementsByName(a+"u_name");
                var about=document.getElementsByName(a+"about");
                var reg_fees=document.getElementsByName(a+"reg_fees");
                var img=document.getElementsByName(a+"img");
                var image=document.getElementsByName(a+"image");
                if(u_name[0].disabled){
                    u_name[0].disabled=false;
                    about[0].disabled=false;
                    img[0].style.display="none";
                    image[0].style.display="block";
                    image[0].disable=false;
                    reg_fees[0].disabled=false;
                }else{
                  if(confirm("Want to Update?")){if(confirm("Going to update")){
                    console.log(image[0].files);
                    send_data(a,u_name[0].value,about[0].value,img[0],reg_fees[0].value);
                    u_name[0].disabled=true;
                    about[0].disabled=true;
                    reg_fees[0].disabled=true;
                    //if(image[0].files.length==0){
                        img[0].style.display="block";
                        image[0].style.display="none";
                    //}else{
//                        img[0].style.display="none";
//                        image[0].style.display="block";
//                    }
                  }}
                }

            }
            function delete_(a){
              if(confirm("Want to delete data of id "+a+"?")){if(confirm("Going to delete data of id "+a)){
                var d=document.getElementById('row_'+a);
                $.ajax({
                          type: "POST",
                          url: "./includes/delete_univesities.php",
                          data: {u_id:a},
                          complete: function(data){
                                    //data contains the response from the php file.
                                    //u can pass it here to the javascript function
                                    console.log(data.responseText);
                              if(data.responseText=='1'){
                                  d.style.display="none";
                                  alert("deleted");
                              }else{
                                  alert("not deleted due to some error");
                              }
                            }
                        });
              }}
            }
            function cancel_(a){
              
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
                                    url: "./includes/delete_univesities.php",
                                    type: 'POST',
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    data: formData,
                                    complete: function (data) {
                                        if(data.responseText==1){
																					alert("all selected data deleted");
                                        }else{
																					alert("not all selected data deleted");
                                        }
																				window.location.href="./institutionEditForm";
                                    }
                                });
                    }
                }
            }
        </script>

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
				<a href="javascript:window.history.back();">Back</a>

            <?php include('./settingsContainer.php'); ?>


            <div class="row">
								<div class="col-xs-12">
										<h3 class="header smaller lighter blue">Institute dataTables</h3>

										<div class="clearfix">
											<div class="pull-right tableTools-container"></div>
										</div>
										<div class="table-header">
											Results Of Institute
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
																<span class="lbl">Sl No</span>
															</label>
														</th>
                                                        <th class="center">University Name</th>
                                                        <th class="center">About</th>
														<th class="hidden-480 center">Registation Fees</th>
                                                        <th class="center">Image</th>
														<th class="hidden-480 center">
															<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                              Last Updated By
                            </th>

														<th class="center">Edit/Delete</th>
													</tr>
												</thead>
												<tbody>
												<?php
                                                    $sql="SELECT * FROM universities";
                                                    $result=$conn_p->query($sql);
                                                    while($row=$result->fetch_assoc())      
                                                    {
												echo  
												"<tr id='row_".$row['u_id']."'>
														<td class='center'>
															<label class='pos-rel'>
																<input name='check_id'  value='".$row['u_id']."'  type='checkbox' class='ace'>
																<span class='lbl'></span>
															</label>
														</td>
														<td class='center'>
															<label class='pos-rel'>
																<span  class='lbl'>".$row['u_id']."</span>
															</label>
														</td>
														<td> 
                                                            <textarea disabled class='lbl' name='".$row['u_id']."u_name' >".urldecode($row['u_name'])."</textarea>
                                                        </td>
                                                        <td>
                                                            <textarea disabled class='lbl' name='".$row['u_id']."about' >".urldecode($row['about'])."</textarea>
                                                        </td>
                                                        <td class='hidden-480'>
                                                            <input type='number' disabled class='lbl' name='".$row['u_id']."reg_fees' value='".urldecode($row['fees'])."'/>
														                            </td>
														<td class='hidden-480'>
                              <img name=".$row['u_id']."img width='100px' src='.".$row['img_src']."'' alt='image'/>
                              <input id='".$row['u_id']."image' name='".$row['u_id']."image' type='file' class='form-control' style='display:none; width:250px;'/>
                            </td>
														<td class='hidden-480' style='text-align:center'>
                                                            <span class='label label-sm label-warning' style='height:auto;font-size:13px;' name='display".$row['u_id']."' >".$row['update_by']." <br/>".implode('-',array_reverse(explode('-',explode(' ',$row['updated'])[0])))."<br>".explode(' ',$row['updated'])[1]."</span>
														</td>
														<td style='width:120px'>
															<div class='hidden-sm hidden-xs action-buttons'>
																<!--<a class='blue' href='#'>
																	<i class='ace-icon fa fa-search-plus bigger-130'></i>
																</a>-->

																<a class='green' href='javascript:change_(".$row['u_id'].")' class='tooltip-success'>
																	<i class='ace-icon fa fa-pencil bigger-130'></i>
																</a>

																<a class='red' href='javascript:delete_(".$row['u_id'].")' >
																	<i class='ace-icon fa fa-trash-o bigger-130'></i>
																</a>
                                <a class='blue' href='javascript:cancel_(".$row['u_id'].")' >
																	<i class='ace-icon fa fa-times red2 bigger-130'></i>
																</a>
															</div>

															<div class='hidden-md hidden-lg'>
																<div class='inline pos-rel'>
																	<button class='btn btn-minier btn-yellow dropdown-toggle' data-toggle='dropdown' data-position='auto'>
																		<i class='ace-icon fa fa-caret-down icon-only bigger-120'></i>
																	</button>

																	<ul class='dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close'>
																		<!--<li>
																			<a href='#' class='tooltip-info' data-rel='tooltip' title='View'>
																				<span class='blue'>
																					<i class='ace-icon fa fa-search-plus bigger-120'></i>
																				</span>
																			</a>
																		</li>-->

																		<li>
																			<a href='javascript:change_(".$row['u_id'].")'  class='tooltip-success' data-rel='tooltip' title='Edit'>
																				<span class='green'>
																					<i class='ace-icon fa fa-pencil-square-o bigger-120'></i>
																				</span>
																			</a>
																		</li>

																		<li>
																			<a href='javascript:delete_(".$row['u_id'].")' class='tooltip-error' data-rel='tooltip' title='Delete' >
																				<span class='red'>
																					<i class='ace-icon fa fa-trash-o bigger-120'></i>
																				</span>
																			</a>
																		</li>

                                    <li>
																			<a href='javascript:cancel_(".$row['u_id'].")' class='tooltip-info' data-rel='tooltip' title='View'>
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
										</div>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->

					</div><!-- /.page-content -->
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
					  null, null, null,null, { "bSortable": false }, null,
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
