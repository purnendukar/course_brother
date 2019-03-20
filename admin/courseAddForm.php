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
            function add_course(){
                var duration=document.getElementsByName('duration')[0].value;
                var structure_sec=document.getElementById("structure_sec");
                var sem=2*(duration);
                var i=1;
                for(i=1;i<=sem;i++){
                    structure_sec.innerHTML+='<p style="text-transform: uppercase; font-weight: 400; font-size: 14px;">Semester '+i+'</p><textarea name="sem'+i+'" class="form-control" style="width:100%; min-width:100%; max-width:100%;" required></textarea>';
                }
                if(i!=1){
                    document.getElementById("add_course").style.display="none";
                }else{
                    alert("Give a interger value in course value");
                }
            }

            function add_fees(){
                var duration=document.getElementsByName('duration')[0].value;
                var structure_sec=document.getElementById("structure_fees");
                var sem=2*(duration);
                var i=1;
                for(i=1;i<=sem;i++){
                    structure_sec.innerHTML+='<p style="text-transform: uppercase; font-weight: 400; font-size: 14px;">Semester '+i+'</p><input type="number" step="0.2" name="sem'+i+'fees" class="form-control" style="width:100%; min-width:100%; max-width:100%;" required>';
                }
                if(i!=1){
                    document.getElementById("add_fees").style.display="none";
                }else{
                    alert("Give a interger value in course value");
                }
            }

            function submit_it(){
                if(confirm("Want to add?")){if(confirm("Going to add")){
                var duration=document.getElementsByName('duration')[0].value;
                var univ=document.getElementsByName("univ")[0];
                var u_id=univ.options[univ.selectedIndex].value;
                if(u_id==""){
                    alert("University not selected");
                    return;
                }
                var program=document.getElementsByName("program")[0];
                var prg_id=program.options[program.selectedIndex].value;
                if(prg_id==""){
                    alert("Program not selected");
                    return;
                }
                var course=document.getElementsByName("course")[0];
                var c_id=course.options[course.selectedIndex].value;
                if(c_id==""){
                    alert("Course not selected");
                    return;
                }
                var subject=document.getElementsByName("subject")[0];
                var s_id=subject.options[subject.selectedIndex].value;
                if(s_id==""){
                    alert("Specialisation not selected");
                    return;
                }
                var d_mode=document.getElementsByName("d_mode")[0];
                var d_mode_id=d_mode.options[d_mode.selectedIndex].value;
                if(d_mode_id==""){
                    alert("Delivery Mode not selected");
                    return;
                }

                var formData = new FormData();
                formData.append("u_id",u_id);
                formData.append("prg_id",prg_id);
                formData.append("c_id",c_id);
                formData.append("s_id",s_id);
                formData.append("fees",document.getElementsByName('fees')[0].value);
                formData.append("duration",duration);
                formData.append("description",document.getElementsByName('c_desc')[0].value);
                var i=1;
                var sem=2*(duration);
                var s="";
                var count=0;
                try{
                for(i=1;i<=sem;i++){
                    var te=document.getElementsByName('sem'+i)[0].value;
                    if(count>0){
                        s+=" | "
                    }
                    s+=te;
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
                for(i=1;i<=sem;i++){
                    var te=document.getElementsByName('sem'+i+'fees')[0].value;
                    if(count>0){
                        s+=","
                    }
                    s+=te;
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
                formData.append("d_mode_id",d_mode_id);
                var meta_desc=document.getElementsByName("meta_desc")[0].value;
                var meta_keys=document.getElementsByName("meta_keys")[0].value;
                formData.append("meta_keys",meta_keys);
                formData.append("meta_desc",meta_desc);
                $.ajax({
                    url: "./courseAddFormSubmit.php",
                    type: 'POST',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    complete: function (data) {
                        console.log(data.responseText);
                        if(data.responseText=='1'){
                            alert("Successfully Added");
                            window.location.href="./courseAddForm";
                        }else{
                            alert(data.responseText);
                        }
                    }
                });
                }}
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
				<a href="javascript:window.history.back();">Back</a>

            <?php include('./settingsContainer.php'); ?>
            <div class='row menu-form'>
              <div class='col-lg-6'>
                  <h2 class='menu-text'>Course Add Menu</h2>
                  <form class='menu-content' id="form1" name="form1" method="post" action="javascript:submit_it()">
                    <div class="form-group">
                    <label for="exampleInputPassword1">Add University</label>
                        <?php $res=$conn_p->query("select * from universities"); ?>
               		<select class='course__add__select' name="univ" >
               			<option value="" selected>University</option>
               			<?php while($row=$res->fetch_assoc()){ ?><option value="<?php echo $row['u_id'];?>"><?php echo $row['u_name']; ?></option><?php } ?>
               		</select>
               		</div>
               		<div class="form-group">
                    <label for="exampleInputPassword1">Add program</label>
               		<?php $res=$conn_p->query("select * from program"); ?>
               		<select class='course__add__select' name="program">
               			<option value="" selected>Program</option>
               			<?php while($row=$res->fetch_assoc()){ ?><option value="<?php echo $row['p_id'];?>"><?php echo strtoupper($row['p_name']); ?></option><?php } ?>
               		</select>
               		</div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Course Name</label>
                      <?php $res=$conn_p->query("select * from courses"); ?>
               		<select class='course__add__select' name="course">
               			<option value="" selected>Course</option>
               			<?php while($row=$res->fetch_assoc()){ ?><option value="<?php echo $row['id'];?>"><?php echo strtoupper($row['c_name']); ?></option><?php } ?>
               		</select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Specialisation Name</label>
                      <?php $res=$conn_p->query("select * from subject"); ?>
               		<select class='course__add__select' name="subject">
               			<option value="" selected>Specialisation</option>
               			<?php while($row=$res->fetch_assoc()){ ?><option value="<?php echo $row['id'];?>"><?php echo strtoupper($row['sub_name']); ?></option><?php } ?>
               		</select>
                    </div>
               		<div class="form-group">
                    <label for="exampleInputPassword1">Add Fees</label>
               		<input name="fees" type="number" step="0.0" class="form-control" placeholder="Fees" required>
               		</div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Course Duration</label>
                      <input name="duration" type="number" step="0.0" class="form-control" placeholder="Course Duration In Years" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Course Description</label>
                      <input name="c_desc" type="text" class="form-control" placeholder="Course Description" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" >Add Course Structure</label><br/>
                        <a id="add_course"  href="javascript:add_course();">Click Here</a>
                        <div id="structure_sec">

                        </div>
               		</div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" >Add Fee Structure</label><br/>
                        <a id="add_fees"  href="javascript:add_fees();">Click Here</a>
                        <div id="structure_fees">

                        </div>
               		</div>
                    <div class="form-group">
                      <label for="exampleInputPassword1" required>Affiliation</label><br/>
                      <?php $res=$conn_p->query("select * from affiliation"); ?>
               			<?php while($row=$res->fetch_assoc()){ ?><input name="aff" type="checkbox" value="<?php echo $row['id'];?>" ><?php echo strtoupper($row['a_name']); ?><br/><?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Delivery Mode</label>
                      <?php $res=$conn_p->query("select * from delivery_mode"); ?>
               		<select class='course__add__select' name="d_mode">
               			<option value="" selected>Delivery Mode</option>
               			<?php while($row=$res->fetch_assoc()){ ?><option value="<?php echo $row['id'];?>"><?php echo strtoupper($row['d_mode']); ?></option><?php } ?>
               		</select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Meta Description</label>
                      <input type="text" name="meta_desc" class="form-control" placeholder="Meta Description">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Meta Keyword</label>
                      <input type="text" name="meta_keys" class="form-control" placeholder="Meta Keyword">
                    </div>
                    <br>
                    <input type="submit" class="btn btn-primary" name="btnsubmit" value="Submit"/>
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
