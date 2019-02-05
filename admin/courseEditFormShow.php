
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
            
            
            function submit_it(){
                var duration=document.getElementsByName('duration')[0].value;
                
                var formData = new FormData();
                formData.append("fees",document.getElementsByName('fees')[0].value);
                formData.append("duration",duration);
                formData.append("description",escape(document.getElementsByName('c_desc')[0].value));
                var i=1;
                var sem=2*(duration);
                var s="";
                var count=0;
                try{
                    var te=document.getElementsByName('sem_struc');
                for(i=0;i<te.length;i++){
                    if(count>0){
                        s+="|"
                    }
                    if(te[i].value==null || te[i]==""){
                        alert("Fill semester "+(i+1)+" Structure");
                        return;
                    }
                    s+=escape(te[i].value);
                    count++;
                }
                }catch(e){
                    alert("Add Course Structure ");
                    return;
                }
                formData.append("sem_struc",s);
                var i=1;
                var sem=2*(duration);
                var s="";
                var count=0;
                try{
                    var te=document.getElementsByName('sem_fees');
                for(i=0;i<te.length;i++){
                    if(count>0){
                        s+=","
                    }
                    if(te[i].value==null || te[i].value==""){
                        alert("Fill semester "+(i+1)+" Fees");
                        return;
                    }
                    s+=te[i].value;
                    count++;
                }
                }catch(e){
                    alert("Add Fees Structure ");
                    return;
                }
                formData.append("fees_struc",s);
                var aff=document.getElementsByName("aff");
                var t="";
                var count=0;
                for(var i=0;i<aff.length;i++){
                    if(aff[i].checked){
                        if(count>0){
                            t+=",";
                        }
                        t+=aff[i].value;
                        count++;
                    }
                }
                if(t==""){
                    alert("Select affiliation");
                    return;
                }
                formData.append("aff",t);
                formData.append("id","<?php echo $_GET['id']?>");
                $.ajax({
                    url: "./courseAddFormupdate.php",
                    type: 'POST',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    complete: function (data) {
                        console.log(data.responseText);
                        if(data.responseText=='1'){
                            alert("Successfully Added");
                            window.location.href="./courseEditForm.php";
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
                $row=$conn_p->query("select * from full_detail where id=".$id)->fetch_assoc();
                ?>
              <div class='col-lg-6'>
                  <h2 class='menu-text'>Edit Course Details</h2>
                  <form class='menu-content' id="form1" name="form1" method="post" action="javascript:submit_it()">
                      <?php ?>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Add University</label>
                        <?php $res=$conn_p->query("select * from universities"); ?>
               		<input class="form-control" value="<?php echo $conn_p->query("select * from universities where u_id=".$row['u_id'])->fetch_assoc()['u_name']; ?>" disabled/>
               		</div>
               		<div class="form-group">
                    <label for="exampleInputPassword1">Add program</label>
               		<?php $res=$conn_p->query("select * from program"); ?>
               		<input class="form-control" value="<?php echo $conn_p->query("select * from program where p_id=".$row['prg_id'])->fetch_assoc()['p_name']; ?>" disabled/>
               		</div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Course Name</label>
                      <?php $res=$conn_p->query("select * from courses"); ?>
               		<input class="form-control" value="<?php echo $conn_p->query("select * from courses where id=".$row['c_id'])->fetch_assoc()['c_name']; ?>" disabled/>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Specialisation Name</label>
                      <?php $res=$conn_p->query("select * from subject"); ?>
               		<?php $res=$conn_p->query("select * from courses"); ?>
               		<input class="form-control" value="<?php echo $conn_p->query("select * from subject where id=".$row['s_id'])->fetch_assoc()['sub_name']; ?>" disabled/>
                    </div>
               		<div class="form-group">
                    <label for="exampleInputPassword1">Add Fees</label>
               		<input name="fees" type="number" step="0.0" class="form-control" value="<?php echo $row['fees']; ?>" required>
               		</div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Course Duration</label>
                      <input name="duration" type="number" step="0.0" class="form-control" value="<?php echo $row['duration']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Course Description</label>
                      <input name="c_desc" type="text" class="form-control" value="<?php echo $conn_p->query("select * from about_course where id=".$row['id'])->fetch_assoc()['overview']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" >Course Structure</label><br/>
                        <div id="structure_sec">
                            <?php $c_struc=$conn_p->query("select * from about_course where id=".$row['id'])->fetch_assoc()['structure']; 
                            $c_struc=explode("|",$c_struc);
                            for($i=0;$i<count($c_struc);$i++){
                                $s=str_replace("<br>","\n",$c_struc[$i]);
                                echo "<p>Semester ".($i+1)."</p>"."<textarea name='sem_struc' class=\"form-control\">".$s."</textarea>";
                            }?>
                        </div>
               		</div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" >Fee Structure</label><br/>
                        <div id="structure_fees">
                            <?php $f_struc=$conn_p->query("select * from fee_structure where id=".$row['id'])->fetch_assoc()['structure']; 
                            $f_struc=explode(",",$f_struc);
                            for($i=0;$i<count($f_struc);$i++){
                                echo "<p>Semester ".($i+1)."</p>"."<input type='number' step=\"0.1\" class=\"form-control\" name='sem_fees' value='".$f_struc[$i]."' />";
                            }?>
                        </div>
               		</div>
                    <div class="form-group">
                      <label for="exampleInputPassword1" required>Affiliation</label><br/>
                      <?php $res1=$conn_p->query("select * from affiliation"); ?>
               			<?php while($row1=$res1->fetch_assoc()){ ?><input name="aff" type="checkbox" value="<?php echo $row1['id'];?>" <?php if(strpos($row['a_id'],$row1['id'])!==false){echo "checked";}?> ><?php echo strtoupper($row1['a_name']); ?><br/><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Delivery Mode</label>
               		<input class="form-control" value="<?php echo $conn_p->query("select * from delivery_mode where id=".$row['d_mode_id'])->fetch_assoc()['d_mode']; ?>" disabled/>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Meta Name</label>
                      <input type="text" class="form-control" placeholder="Meta Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Meta Description</label>
                      <input type="text" class="form-control" placeholder="Meta Description">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Meta Tag</label>
                      <input type="text" class="form-control" placeholder="Meta Tag">
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
