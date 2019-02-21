<?php
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip'))
  ob_start("ob_gzhandler");
else
  ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Cache-control" content="public">
  <link rel="shortcut icon" href="..\assets\images\favicon.png" type="image/png" />

  <!-- NORMALIZE CSS -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css' />

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:100,300,400,500,600,700" rel="stylesheet">

  <!-- FONTAWESOME -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- ANIMATE CSS -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css' />

  <!-- CUSTOM CSS -->
  <link rel='stylesheet' href='../styles/style.css' />

  <script>
    function about_edit(a,b){
      var about=document.getElementById("about");
      var about_input=document.getElementById("about_input");
      var update_about=document.getElementById("update_about");
      var edit_about=document.getElementById("edit_about");

      if(a=="edit"){
        about.style.display="none";
        about_input.style.display="block";
        update_about.style.display="block";
        edit_about.style.display="none";
      }else{
        var f = new FormData();
        f.append('id',b);
        f.append('about',about_input.value.replace(/(?:\r\n|\r|\n)/g,"<br/>"));
        about.style.display="block";
        $.ajax({
          url: "./user_dashboard/about.php",
          type: 'POST',
          cache: false,
          contentType: false,
          processData: false,
          data: f,
          complete: function (data) {
            if(data.responseText=='1'){
              alert("Data Updated Successfully");
              about.innerHTML=about_input.value.replace(/(?:\r\n|\r|\n)/g,"<br/>");
            }else{
              alert("Data Not Updated Try Again");
            }
          }
        });
        about_input.style.display="none";
        update_about.style.display="none";
        edit_about.style.display="block";
      }
    }
    function qual_edit(a,b){
      var edit_=document.getElementsByClassName('edit'+b);
      var non_edit_=document.getElementsByClassName('non_edit'+b);
      var edit_qual=document.getElementById("edit_qual"+b);
      var update_qual=document.getElementById("update_qual"+b);
      var delete_qual=document.getElementById("delete_qual"+b);
      var f = new FormData();
      f.append('id',b);
      if(a=="edit"){
        for(var i=0;i<edit_.length;i++){
          edit_[i].style.display="inline";
        }
        for(var i=0;i<non_edit_.length;i++){
          non_edit_[i].style.display="none";
        }
        edit_qual.style.display="none";
        delete_qual.style.display="none";
        update_qual.style.display="block";
      }else if(a=="update"){
        if(!(edit_[0].value>1950 && edit_[0].value<2099 && edit_[2].value>1950 && edit_[2].value<2099 && edit_[3].value && edit_[4].value && edit_[5].value)){
          alert("Fill All Detail Correctly");
          return;
        }
        f.append("join_",edit_[0].value);
        f.append("complete_",edit_[2].value);
        f.append("univ",edit_[3].value);
        f.append("degree",edit_[4].value);
        f.append("about",edit_[5].value);

        $.ajax({
          url: "./user_dashboard/edu_update.php",
          type: 'POST',
          cache: false,
          contentType: false,
          processData: false,
          data: f,
          complete: function (data) {
            if(data.responseText=='1'){
              alert("Data Updated Successfully");
              non_edit_[0].innerHTML=edit_[0].value+" - "+edit_[2].value;
              non_edit_[1].innerHTML=edit_[3].value;
              non_edit_[2].innerHTML=edit_[4].value;
              non_edit_[3].innerHTML=edit_[5].value;
            }else{
              alert("Data Not Updated Try Again");
              console.log(data.responseText);
            }
          }
        });
        for(var i=0;i<edit_.length;i++){
          edit_[i].style.display="none";
        }
        for(var i=0;i<non_edit_.length;i++){
          non_edit_[i].style.display="inline-block";
        }
        edit_qual.style.display="inline";
        delete_qual.style.display="inline";
        update_qual.style.display="none";
      }else{
        if(confirm("Do you want to delete ?")){
          $.ajax({
            url: "./user_dashboard/edu_delete.php",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: f,
            complete: function (data) {
              if(data.responseText=='1'){
                alert("Successfully Deleted");
                document.getElementById('edu_'+b).style.display="none";
              }else{
                alert("Not able to delete! Try Again");
                console.log(data.responseText);
              }
            }
          });
        }
      }
    }
    function add_edu(){
      var add_=document.getElementById("edu_");
      if(add_.style.display=="none"){
        add_.style.display="";
        document.getElementById("add_edu").style.display="none";
      }
    }
    function add_cancel(a){
      var done=false;
      var input_= document.getElementsByClassName("add_edu");
      if(a=='add'){
        var f = new FormData();
        f.append('join_',input_[0].value);
        f.append('end_',input_[1].value);
        f.append('univ_',input_[2].value);
        f.append('qual_',input_[3].value);
        f.append('about',input_[4].value);
        about.style.display="block";
        $.ajax({
          url: "./user_dashboard/add_edu.php",
          type: 'POST',
          cache: false,
          contentType: false,
          processData: false,
          data: f,
          complete: function (data) {
            if(data.responseText.indexOf("success") !== false){
              done=true;
              var id=data.responseText.replace('success','');
              document.getElementById("education_main").innerHTML+='<div id="edu_'+id+'" class="dashboard__content__skills__education__item"><img src="../assets/svg/Icons/red/students-cap.svg" alt="Graduation Hat" /><div class="dashboard__content__skills__education__item__content"><h6 class="non_edit'+id+'">'+input_[0].value+' - '+input_[1].value+'</h6>                  <div><input class="edit'+id+'" type="number" min="1940" max="2099" value="'+input_[0].value+'" style="width:100px;padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;display:none;"/><p class="edit'+id+'" style="display:none">-</p><input class="edit'+id+'" type="number" min="1940" max="2099" value="'+input_[1].value+'" style="width:100px;padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;display:none;"/></div>                 <div class="dashboard__content__skills__education__item__content__degree">                    <h5 class="non_edit'+id+'">'+input_[2].value+'</h5>                    <h6 class="non_edit'+id+'">'+input_[3].value+'</h6>                  </div>                  <div>                    <input class="edit'+id+'" type="text" placeholder="Universities" value="'+input_[2].value+'" style="padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;display:none;"/>                    <input class="edit'+id+'" type="text" placeholder="Qualification" value="'+input_[3].value+'" style="padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;display:none;"/>                  </div>                  <p class="non_edit'+id+'">'+input_[4].value+'</p>                  <textarea class="edit'+id+'" style="padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;width:100%;min-height:100px;display:none;resize:vertical;">'+input_[4].value+'</textarea>                  <div><a id="edit_qual'+id+'" href="javascript:qual_edit(\'edit\',\''+id+'\');" style="text-decoration:none;">Edit</a><a id="delete_qual'+id+'" href="javascript:qual_edit(\'delete\',\''+id+'\');" style="text-decoration:none;margin-left:15px;">Delete</a><button onclick="qual_edit(\'update\',\''+id+'\');" id="update_qual'+id+'" style="outline:none;margin-top:10px;background-color:#F34965; padding:10px 20px; border:none;color:white; border-radius:8px;cursor:pointer; display:none;" >Update</button></div></div></div>';
              alert("Data Updated Successfully");
              if(done==true){
                document.getElementById("edu_").style.display="none";
                document.getElementById("add_edu").style.display="";
                for(var i=0;i<input_.length;i++){
                  input_[i].value="";
                }
              }
            }else{
              alert("Data Not Updated Try Again");
              console.log(data.responseText);
            }
          }
        });
      }else{
        document.getElementById("edu_").style.display="none";
        document.getElementById("add_edu").style.display="";
        for(var i=0;i<input_.length;i++){
          input_[i].value="";
        }
      }

    }
    function work_edit(a,b){
      var work_i=document.getElementsByClassName("work_i"+b);
      var work=document.getElementsByClassName("work_"+b);
      var f = new FormData();
      f.append('id',b);
      if(a=='edit'){
        for(var i=0 ;i<work_i.length;i++){
          work_i[i].style.display="";
        }
        for(var i=0;i<work.length;i++){
          work[i].style.display="none";
        }

      }else if(a=='update'){
        f.append('position',work_i[0].value);
        f.append('company',work_i[1].value);
        f.append('start_',work_i[3].value);
        f.append('end_',work_i[4].value);
        f.append('about',work_i[5].value);
        about.style.display="block";
        $.ajax({
          url: "./user_dashboard/work_update.php",
          type: 'POST',
          cache: false,
          contentType: false,
          processData: false,
          data: f,
          complete: function (data) {
            if(data.responseText=='1'){
              alert("Data Updated Successfully");
              for(var i=0 ;i<work_i.length;i++){
                work_i[i].style.display="none";
              }
              for(var i=0;i<work.length;i++){
                work[i].style.display="";
              }
              work[0].innerHTML=work_i[0].value;
              work[1].innerHTML=work_i[1].value;
              work[2].innerHTML=work_i[3].value+" - "+work_i[4].value;
              work[3].innerHTML=work_i[5].value;
            }else{
              alert("Data Not Updated Try Again");
              console.log(data.responseText);
            }
          }
        });
      }else{
        $.ajax({
          url: "./user_dashboard/work_delete.php",
          type: 'POST',
          cache: false,
          contentType: false,
          processData: false,
          data: f,
          complete: function (data) {
            if(data.responseText=='1'){
              alert("Data deleted Successfully");
              document.getElementById("work_sec"+b).style.display="none";
            }else{
              alert("Data Not deleted Try Again");
              console.log(data.responseText);
            }
          }
        });
      }
    }
    function add_work(a){
      var work_i=document.getElementsByClassName("work_i");
      if(a=="add"){
        document.getElementById("work_sec").style.display="";
        document.getElementById("add_work").style.display="none";
      }else if(a=="cancel"){
        for(var i=0;i<work_i.length;i++){
          work_i[i].value="";
        }
        document.getElementById("work_sec").style.display="none";
        document.getElementById("add_work").style.display="";
      }else{
        var done=false;
        var f=new FormData();
        f.append('position',work_i[0].value);
        f.append('company',work_i[1].value);
        f.append('start_',work_i[2].value);
        f.append('end_',work_i[3].value);
        f.append('about',work_i[4].value);
        about.style.display="block";
        $.ajax({
          url: "./user_dashboard/work_insert.php",
          type: 'POST',
          cache: false,
          contentType: false,
          processData: false,
          data: f,
          complete: function (data) {
            if(data.responseText.indexOf("success") !== false){
              alert("Data Updated Successfully");
              var id=data.responseText.replace("success","");
              document.getElementById("work_sec_have").innerHTML+='<div id="work_sec'+id+'" class="dashboard__content__skills__workexp__item"><div class="dashboard__content__skills__workexp__item__circle"></div><div class="dashboard__content__skills__workexp__item__content"><div class="dashboard__content__skills__workexp__item__content__work"><h5 class="work_'+id+'">'+work_i[0].value+'</h5><h6 class="work_'+id+'">'+work_i[1].value+'</h6><input class="work_i'+id+'" type="text" placeholder="Position" style="display:none;padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;" value="'+work_i[0].value+'"/><input class="work_i'+id+'" type="text" placeholder="Company"style="display:none;padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;" value="'+work_i[1].value+'"/></div><h6 class="work_'+id+'">'+work_i[2].value+' - '+work_i[3].value+'</h6><div class="work_i'+id+'" style="display:none;"><input class="work_i'+id+'" type="date" style="padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;" value="'+work_i[2].value+'"/> - <input class="work_i'+id+'" type="date" placeholder="Company"style="padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;" value="'+work_i[3].value+'"/></div><p class="work_'+id+'">'+work_i[4].value+'</p><textarea class="work_i'+id+'" placeholder="About Job" class="add_edu" style="display:none;padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;width:100%;min-height:100px;resize:vertical;">'+work_i[4].value+'</textarea><div style="margin-top:15px;"><a class="work_'+id+'" href="javascript:work_edit(\'edit\',\''+id+'\');" style="text-decoration:none;">Edit</a><a class="work_'+id+'" href="javascript:work_edit(\'delete\',\''+id+'\');" style="text-decoration:none;margin-left:15px;">Delete</a><button onclick="work_edit(\'update\',\''+id+'\');" class="work_i'+id+'" style="outline:none;margin-top:10px;background-color:#F34965; padding:10px 20px; border:none;color:white; border-radius:8px;cursor:pointer; display:none;" >Update</button></div> </div></div>';
              done=true;
              if(done){
                for(var i=0 ;i<work_i.length;i++){
                  work_i[i].value="";
                }
                document.getElementById("add_work").style.display="";
                document.getElementById("work_sec").style.display="none";
              }
            }else{
              alert("Data Not Updated Try Again");
              console.log(data.responseText);
            }
          }
        });
      }
    }
    function skill_edit(a){
      var skill_edit=document.getElementById("skill_edit");
      var skills=document.getElementById("skills");
      var skill_input=document.getElementById("skill_input");
      if(skill_edit.innerHTML=='Edit'){
        skill_input.style.display="";
        skill_edit.innerHTML="Update";
        skills.style.display="none";
      }else{
        skill_input.style.display="none";
        skill_edit.innerHTML="Edit";
        skills.style.display="";
        var f=new FormData();
        f.append('skill',skill_input.value);
        $.ajax({
          url: "./user_dashboard/skill_update.php",
          type: 'POST',
          cache: false,
          contentType: false,
          processData: false,
          data: f,
          complete: function (data) {
            if(data.responseText=='1'){
              skills.innerHTML="";
              var str=skill_input.value.split(",");
              for(var i=0;i<str.length;i++){
                skills.innerHTML+='<div class="dashboard__content__skills__proskills__item"><i class="fas fa-award"></i><h6>'+str[i]+'</h6></div>';
              }
              alert('Successfully Updated');
            }else{
              console.log(data.responseText);
              alert('Something went wrong');
            }
          }
        });
      }
    }
    function award(a,b){
      var show_=document.getElementsByClassName("award_show"+b);
      var award_input=document.getElementsByClassName("award_input"+b);
      var update_=document.getElementById("award_update"+b);
      var not_update_=document.getElementById("award_not_update"+b);
      var f=new FormData();
      f.append('id',b);
      if(a=="edit"){
        for(var i=0;i<show_.length;i++){
          show_[i].style.display="none";
          award_input[i].style.display="block";
        }
        update_.style.display="";
        not_update_.style.display="none";
      }else if(a=="delete"){
        $.ajax({
          url: "./user_dashboard/award_delete.php",
          type: 'POST',
          cache: false,
          contentType: false,
          processData: false,
          data: f,
          complete: function (data) {
            if(data.responseText=='1'){
              alert('Successfully Deleted');
              document.getElementById("award_row"+b).style.display="none";
            }else{
              console.log(data.responseText);
              alert('Something went wrong! Try Again');
            }
          }
        });
      }else{
        f.append('award_',award_input[0].value);
        f.append('date_',award_input[1].value);
        f.append('about',award_input[2].value);
        $.ajax({
          url: "./user_dashboard/award_update.php",
          type: 'POST',
          cache: false,
          contentType: false,
          processData: false,
          data: f,
          complete: function (data) {
            if(data.responseText=='1'){
              alert('Successfully Updated');
              for(var i=0;i<show_.length;i++){
                show_[i].style.display="";
                show_[i].innerHTML=award_input[i].value;
                award_input[i].style.display="none";
              }
              update_.style.display="none";
              not_update_.style.display="";
            }else{
              console.log(data.responseText);
              alert('Something went wrong');
            }
          }
        });
      }
    }
    function new_award(a){
      var award_row=document.getElementById("award_row");
      var add_new=document.getElementById("new_award");
      var award_input=document.getElementsByClassName("award_input");
      if(a=='add'){
        award_row.style.display="";
        add_new.style.display="none";
      }else if(a=='cancel'){
        award_row.style.display="none";
        add_new.style.display="";
        for(var i=0;i<award_input.length;i++){
          award_input.value="";
        }
      }else{
        var done=false;
        award_row.style.display="";
        add_new.style.display="none";
        var f=new FormData();
        f.append('award_',award_input[0].value);
        f.append('date_',award_input[1].value);
        f.append('about',award_input[2].value);
        $.ajax({
          url: "./user_dashboard/award_insert.php",
          type: 'POST',
          cache: false,
          contentType: false,
          processData: false,
          data: f,
          complete: function (data) {
            if(data.responseText.indexOf("success") !== false){
              var id=data.responseText.replace("success","");
              alert('Successfully Updated');
              document.getElementById("award_sec").innerHTML+='<div id="award_row'+id+'" class="dashboard__content__skills__awards__item"><div class="dashboard__content__skills__awards__item__circle"></div><div class="dashboard__content__skills__awards__item__content"><div class="dashboard__content__skills__awards__item__content__work"><h5 class="award_show'+id+'">'+award_input[0].value+'</h5><input placeholder="Award Name" class="award_input'+id+'" type="text" value="'+award_input[0].value+'" style="display:none;padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;"/></div><h6 class="award_show'+id+'">'+award_input[1].value+'</h6><input placeholder="Award Date" class="award_input'+id+'" type="date" value="'+award_input[1].value+'" style="display:none;padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;"/><p class="award_show'+id+'">'+award_input[2].value+'</p><textarea placeholder="About Award" class="award_input'+id+'" style="display:none;resize:vertical;width:100%;min-height:100px;padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;">'+award_input[2].value+'</textarea><div id="award_update'+id+'" style="margin-top:10px;display:none;"><a style="text-decoration:none;" href="javascript:award(\'update\',\''+id+'\')">Update</a></div><div id="award_not_update'+id+'"><a  style="text-decoration:none;margin:10px 10px 10px 0;" href="javascript:award(\'edit\',\''+id+'\')">Edit</a><a style="text-decoration:none;margin:10px;" href="javascript:award(\'delete\',\''+id+'\')">Delete</a></div></div></div>';
              if(done){
                for(var i=0;i<award_input.length;i++){
                  award_input.value="";
                }
              }
              award_row.style.display="none";
              add_new.style.display="";
            }else{
              console.log(data.responseText);
              alert('Something went wrong');
            }
          }
        });
      }
    }
  </script>

  <title>CourseBrother.com | User Dashboard</title>
</head>
<body>


  <!-- MAIN_CONTAINER -->
  <div class="main-container">
    <!-- MySQL connector -->
		<?php
			include "../includes/mysql_connect.php";
			$conn=connect_mysql();
		?>
    <!-- LOGIN_REGISTER_MODALS -->
    <?php include '../includes/login-register-modal.php' ?>
    <!-- /LOGIN_REGISTER_MODALS -->
    <!-- NAVBAR_SCROLL -->
    <?php include '../includes/navbar-main.php' ?>
    <!-- /NAVBAR_SCROLL -->

    <?php
      if(!(isset($_COOKIE['email']))){
        header("Location:../index.php");
      }
    ?>
    <?php $user=$conn->query("SELECT * FROM `register_user` WHERE email='".$_COOKIE['email']."'")->fetch_assoc(); ?>
    <?php $user_info=$conn->query("select * from user_info where email='".$_COOKIE['email']."'")->fetch_assoc();?>
    <!-- USER_DASHBOARD -->
    <div class="user_dashboard">

      <!-- DASHBOARD_HEADER -->
      <div class="dashboard__header">
        <div class="dashboard__header__bg">

          <div class="dashboard__header__bg__circle"></div>
          <div class="dashboard__header__bg__info">

            <div class="dashboard__header__bg__info__id">
              <b>ID</b>: ad56ww0pqzqt
            </div>

            <div class="dashboard__header__bg__info__appendix">
              <div class="dashboard__header__bg__info__appendix__item">
                <img src="../assets/svg/Icons/white/maps-and-flags.svg" alt="Location Icon" />
                <p><?php echo $user['city'];?></p>
              </div>

              <div class="dashboard__header__bg__info__appendix__item">
                <img src="<?php if(isset($user_info['img_src'])){echo $user_info['img_src'];}else{echo "../assets/svg/Icons/white/stopwatch.svg";}?>" alt="Location Icon" />
                <p>Member Since <?php $since=new DateTime($user['created']); echo $since->format("Y");?></p>
              </div>
            </div>

          </div>

        </div>
        <div class="dashboard__header__main">
          <img src="../assets/svg/Icons/white/user.svg" alt="Student Image" />
          <div class="dashboard__header__main__info">

            <div class="dashboard__header__main__info__media">
              <div class="dashboard__header__main__info__media__item">
                <a href="#"><i class="fab fa-twitter"></i></a>
              </div>
              <div class="dashboard__header__main__info__media__item">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
              </div>
              <div class="dashboard__header__main__info__media__item">
                <a href="#"><i class="fab fa-google"></i></a>
              </div>
            </div>
            <div class="dashboard__header__main__info__personal">
              <h4 class='dashboard__header__main__info__personal__name'><?php echo $user['f_name']." ".$user['l_name']; ?></h4>
              <h5 class="dashboard__header__main__info__personal__occupation"><?php if(isset($user_info['occupation'])){echo ucwords($user_info['occupation']);}?></h5>
              <h5 class='dashboard__header__main__info__personal__email'><?php echo $user['email'];?></h5>
            </div>
            <div class="dashboard__header__main__info__cv">
              <button style="outline:none;">Download CV &nbsp; <i class='fa fa-arrow-down'></i></button>
            </div>
          </div>

          <div class="dashboard__header__main__navbar">
            <ul>
              <li><a href="">Candidate About</a></li>
              <li><a href="">Education</a></li>
              <li><a href="">Work Experience</a></li>
              <li><a href="">Professional Skills</a></li>
              <li><a href="">Awards</a></li>
            </ul>
          </div>

        </div>
      </div>
      <!-- /DASHBOARD_HEADER -->

      <!-- DASHBOARD__CONTENT -->
      <div class="dashboard__content">

        <!-- DASHBOARD_SKILLS -->
        <div class="dashboard__content__skills">

          <div id='CandidateAbout' class="dashboard__content__skills__about">
            <h3>Candidate's About</h3>
            <p id="about"><?php echo $user_info['about']; ?></p>
            <textarea id="about_input" placeholder="About the Course" style="resize:vertical;width:100%;min-height:200px;display:none;padding:10px;border:1px solid #cccccc;border-radius:3px;"><?php echo str_replace("<br/>","\n",$user_info['about']); ?></textarea>
            <a id="edit_about" href="javascript:about_edit('edit','<?php echo $user_info['id'];?>');" style="text-decoration:none;">Edit</a>
            <button id="update_about" style="outline:none;margin-top:10px;background-color:#F34965; padding:10px 20px; border:none;color:white; border-radius:8px;cursor:pointer; display:none;" onclick="about_edit('update','<?php echo $user_info['id'];?>');">Update</button>
          </div>

          <div id='Education' class="dashboard__content__skills__education">

            <h3>Education</h3>
            <div id="education_main">
              <?php $user_edu=$conn->query("SELECT * FROM `user_education` where email='".$_COOKIE['email']."'");
              while($edu_row=$user_edu->fetch_assoc()){
              ?>
              <div id="edu_<?php echo $edu_row['id'];?>" class="dashboard__content__skills__education__item">
                <img src="../assets/svg/Icons/red/students-cap.svg" alt="Graduation Hat" />
                <div class="dashboard__content__skills__education__item__content">
                  <h6 class="non_edit<?php echo $edu_row['id']; ?>"><?php echo $edu_row['join_year'];?> - <?php echo $edu_row['complete_year'];?></h6>
                  <div><input class="edit<?php echo $edu_row['id']; ?>" type="number" min="1940" max="2099" value="<?php echo $edu_row['join_year'];?>" style="width:100px;padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;display:none;"/><p class="edit<?php echo $edu_row['id']; ?>" style="display:none">-</p><input class="edit<?php echo $edu_row['id']; ?>" type="number" min="1940" max="2099" value="<?php echo $edu_row['complete_year'];?>" style="width:100px;padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;display:none;"/></div>
                  <div class="dashboard__content__skills__education__item__content__degree">
                    <h5 class="non_edit<?php echo $edu_row['id']; ?>"><?php echo urldecode($edu_row['organisation']);?></h5>
                    <h6 class="non_edit<?php echo $edu_row['id']; ?>"><?php echo urldecode($edu_row['degree']);?></h6>
                  </div>
                  <div>
                    <input class="edit<?php echo $edu_row['id']; ?>" type="text" placeholder="Universities" value="<?php echo urldecode($edu_row['organisation']);?>" style="padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;display:none;"/>
                    <input class="edit<?php echo $edu_row['id']; ?>" type="text" placeholder="Qualification" value="<?php echo urldecode($edu_row['degree']);?>" style="padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;display:none;"/>
                  </div>
                  <p class="non_edit<?php echo $edu_row['id']; ?>"><?php echo urldecode($edu_row['about']);?></p>
                  <textarea class="edit<?php echo $edu_row['id']; ?>" style="padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;width:100%;min-height:100px;display:none;resize:vertical;"><?php echo urldecode($edu_row['about']);?></textarea>
                  <div>
                    <a id="edit_qual<?php echo $edu_row['id']?>" href="javascript:qual_edit('edit','<?php echo $edu_row['id'];?>');" style="text-decoration:none;">Edit</a>
                    <a id="delete_qual<?php echo $edu_row['id']?>" href="javascript:qual_edit('delete','<?php echo $edu_row['id'];?>');" style="text-decoration:none;margin-left:15px;">Delete</a>
                    <button onclick="qual_edit('update','<?php echo $edu_row['id'];?>');" id="update_qual<?php echo $edu_row['id']?>" style="outline:none;margin-top:10px;background-color:#F34965; padding:10px 20px; border:none;color:white; border-radius:8px;cursor:pointer; display:none;" >Update</button>
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>
            <div id="edu_" class="dashboard__content__skills__education__item" style="display:none;">
              <img src="../assets/svg/Icons/red/students-cap.svg" alt="Graduation Hat" />
              <div class="dashboard__content__skills__education__item__content">
                <div><input placeholder="Join Year" class="add_edu" type="number" min="1940" max="2099" value="" style="width:100px;padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;"/> - <input class="add_edu" placeholder="End Year" type="number" min="1940" max="2099" value="" style="width:100px;padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;"/></div>
                <div>
                  <input class="add_edu" type="text" placeholder="Universities" value="" style="padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;"/>
                  <input class="add_edu" type="text" placeholder="Qualification" value="" style="padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;"/>
                </div>
                <textarea placeholder="About the Course" class="add_edu" style="padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;width:100%;min-height:100px;resize:vertical;"></textarea>
                <div style="margin-top:15px;">
                  <a href="javascript:add_cancel('add');" style="text-decoration:none;">Add it</a>
                  <a href="javascript:add_cancel('delete');" style="text-decoration:none;margin-left:15px;">Cancel</a>
                </div>
              </div>
            </div>
            <a id="add_edu" style="text-decoration:none;margin:10px 0px;" href="javascript:add_edu()">Add +</a>
          </div>

          <div id='WorkExperience' class="dashboard__content__skills__workexp">

            <h3>Work & Experience</h3>
            <div id="work_sec_have">
              <?php $user_exp=$conn->query("SELECT * FROM `user_work_exp` where email='".$_COOKIE['email']."'");
              while($exp_row=$user_exp->fetch_assoc()){
              ?>
              <div id="work_sec<?php echo $exp_row['id'];?>" class="dashboard__content__skills__workexp__item">
                <div class="dashboard__content__skills__workexp__item__circle"></div>
                <div class="dashboard__content__skills__workexp__item__content">
                  <div class="dashboard__content__skills__workexp__item__content__work">
                    <h5 class="work_<?php echo $exp_row['id']?>"><?php echo urldecode($exp_row['position']);?></h5>
                    <h6 class="work_<?php echo $exp_row['id']?>"><?php echo urldecode($exp_row['company_name']);?></h6>
                    <input class="work_i<?php echo $exp_row['id']?>" type="text" placeholder="Position" style="display:none;padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;" value="<?php echo urldecode($exp_row['position']);?>"/>
                    <input class="work_i<?php echo $exp_row['id']?>" type="text" placeholder="Company"style="display:none;padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;" value="<?php echo urldecode($exp_row['company_name']);?>"/>
                  </div>
                  <h6 class="work_<?php echo $exp_row['id']?>"><?php echo $exp_row['start_date'];?> - <?php echo $exp_row['end_date']?></h6>
                  <div class="work_i<?php echo $exp_row['id']?>" style="display:none;">
                    <input class="work_i<?php echo $exp_row['id']?>" type="date" style="padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;" value="<?php echo $exp_row['start_date'];?>"/> - <input class="work_i<?php echo $exp_row['id']?>" type="date" placeholder="Company"style="padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;" value="<?php echo $exp_row['end_date']?>"/>
                  </div>
                  <p class="work_<?php echo $exp_row['id']?>"><?php echo urldecode($exp_row['about_work']);?></p>
                  <textarea class="work_i<?php echo $exp_row['id']?>" placeholder="About Job" class="add_edu" style="display:none;padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;width:100%;min-height:100px;resize:vertical;"><?php echo urldecode($exp_row['about_work']);?></textarea>
                  <div style="margin-top:15px;">
                    <a class="work_<?php echo $exp_row['id']?>" href="javascript:work_edit('edit','<?php echo $exp_row['id'];?>');" style="text-decoration:none;">Edit</a>
                    <a class="work_<?php echo $exp_row['id']?>" href="javascript:work_edit('delete','<?php echo $exp_row['id'];?>');" style="text-decoration:none;margin-left:15px;">Delete</a>
                    <button onclick="work_edit('update','<?php echo $exp_row['id'];?>');" class="work_i<?php echo $exp_row['id']?>" style="outline:none;margin-top:10px;background-color:#F34965; padding:10px 20px; border:none;color:white; border-radius:8px;cursor:pointer; display:none;" >Update</button>
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>
            <div id="work_sec" class="dashboard__content__skills__workexp__item" style="display:none">
              <div class="dashboard__content__skills__workexp__item__circle"></div>
              <div class="dashboard__content__skills__workexp__item__content">
                <div class="dashboard__content__skills__workexp__item__content__work">
                  <input class="work_i" type="text" placeholder="Position" style="padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;" value=""/>
                  <input class="work_i" type="text" placeholder="Company"style="padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;" value=""/>
                </div>
                <div>
                  <input class="work_i" type="date" style="padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;" value=""/> - <input class="work_i" type="date" placeholder="Company"style="padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;" value=""/>
                </div>
                <textarea class="work_i" placeholder="About Job" class="add_edu" style="padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;width:100%;min-height:100px;resize:vertical;"><?php echo urldecode($exp_row['about_work']);?></textarea>
                <div style="margin-top:15px;">
                  <a class="work_i" href="javascript:add_work('add_it');" style="text-decoration:none;">Add it</a>
                  <a class="work_i" href="javascript:add_work('cancel');" style="text-decoration:none;margin-left:15px;">Cancel</a>
                </div>
              </div>
            </div>
            <a id="add_work" style="text-decoration:none;margin:10px 0px;" href="javascript:add_work('add')">Add +</a>
          </div>

          <div id='ProfessionalSkills' class="dashboard__content__skills__proskills">

            <h3>Professional Skills</h3>

            <div id="skills" class="dashboard__content__skills__proskills__items">
              <?php $temp=explode(",",$user_info['skills']);
              for($i=0;$i<count($temp);$i++){
              ?>
              <div class="dashboard__content__skills__proskills__item">
                <i class="fas fa-award"></i>
                <h6><?php echo $temp[$i];?></h6>
              </div>
              <?php } ?>
            </div>
            <div style="padding-top:20px;">
              <input type="text" id="skill_input" style="display:none;padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;" value="<?php echo $user_info['skills'];?>" />
              <a id="skill_edit" href="javascript:skill_edit();" style="text-decoration:none;">Edit</a>
            </div>
          </div>

          <div id='Awards' class="dashboard__content__skills__awards">

            <h3>Awards</h3>
            <div id="award_sec">
              <?php $user_award=$conn->query("select * from user_award where email='".$_COOKIE['email']."'");
              while($award_row=$user_award->fetch_assoc()){
              ?>
              <div id="award_row<?php echo $award_row['id'];?>" class="dashboard__content__skills__awards__item">
                <div class="dashboard__content__skills__awards__item__circle"></div>
                <div class="dashboard__content__skills__awards__item__content">
                  <div class="dashboard__content__skills__awards__item__content__work">
                    <h5 class="award_show<?php echo $award_row['id']; ?>"><?php echo urldecode($award_row['award']);?></h5>
                    <input placeholder="Award Name" class="award_input<?php echo $award_row['id']; ?>" type="text" value="<?php echo urldecode($award_row['award']);?>" style="display:none;padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;"/>
                  </div>
                  <h6 class="award_show<?php echo $award_row['id']; ?>"><?php echo urldecode($award_row['award_date']);?></h6>
                  <input placeholder="Award Date" class="award_input<?php echo $award_row['id']; ?>" type="date" value="<?php echo urldecode($award_row['award_date']);?>" style="display:none;padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;"/>
                  <p class="award_show<?php echo $award_row['id']; ?>"><?php echo urldecode($award_row['about']);?></p>
                  <textarea placeholder="About Award" class="award_input<?php echo $award_row['id']; ?>" style="display:none;resize:vertical;width:100%;min-height:100px;padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;"><?php echo urldecode($award_row['about']);?></textarea>
                  <div id="award_update<?php echo $award_row['id']; ?>" style="margin-top:10px;display:none;">
                    <a style="text-decoration:none;" href="javascript:award('update','<?php echo $award_row['id']; ?>')">Update</a>
                  </div>
                  <div id="award_not_update<?php echo $award_row['id']; ?>">
                    <a  style="text-decoration:none;margin:10px 10px 10px 0;" href="javascript:award('edit','<?php echo $award_row['id']; ?>')">Edit</a>
                    <a style="text-decoration:none;margin:10px;" href="javascript:award('delete','<?php echo $award_row['id']; ?>')">Delete</a>
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>
            <div id="award_row" class="dashboard__content__skills__awards__item" style="display:none">
              <div class="dashboard__content__skills__awards__item__circle"></div>
              <div class="dashboard__content__skills__awards__item__content">
                <div class="dashboard__content__skills__awards__item__content__work">
                  <input placeholder="Award Name" class="award_input" type="text" value="" style="padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;"/>
                </div>
                <input placeholder="Award Date" class="award_input" type="date" value="" style="padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;"/>
                <textarea placeholder="About Award" class="award_input" style="resize:vertical;width:100%;min-height:100px;padding:7px;margin:3px;border:1px solid #cccccc;border-radius:3px;"></textarea>

                <div id="award_not_update" style="margin-top:10px;">
                  <a  style="text-decoration:none;margin:10px 10px 10px 0;" href="javascript:new_award('add_it')">Add it</a>
                  <a style="text-decoration:none;margin:10px;" href="javascript:new_award('cancel')">Cancel</a>
                </div>
              </div>
            </div>
          </div>
          <div id="new_award" style="margin-top:20px;">
            <a href="javascript:new_award('add')" style="text-decoration:none;">Add +</a>
          </div>
        </div>
        <!-- /DASHBOARD_SKILLS -->

        <!-- DASHBOARD_OVERVIEW -->
        <div class="dashboard__content__overview">

          <h3>Candidate Overview</h3>

          <div class="dashboard__content__overview__container">

            <div class="dashboard__content__overview__item">
              <i class='fas fa-sliders-h'></i>
              <div class="dashboard__content__overview__item__content">
                <h5>Experience</h5>
                <h5><?php echo $user_info['experience']?></h5>
              </div>
            </div>

            <div class="dashboard__content__overview__item">
              <i class='fas fa-hourglass-half'></i>
              <div class="dashboard__content__overview__item__content">
                <h5>Age</h5>
                <h5><?php $now=new DateTime(); $dob=new DateTime($user_info['dob']); echo $now->diff($dob)->y;?></h5>
              </div>
            </div>

            <div class="dashboard__content__overview__item">
              <i class="far fa-money-bill-alt"></i>
              <div class="dashboard__content__overview__item__content">
                <h5>Current Salary</h5>
                <h5>57 million</h5>
              </div>
            </div>

            <div class="dashboard__content__overview__item">
              <i class='fas fa-chart-line'></i>
              <div class="dashboard__content__overview__item__content">
                <h5>Expected Salary</h5>
                <h5>100 million</h5>
              </div>
            </div>

            <div class="dashboard__content__overview__item">
              <i class="fas fa-transgender"></i>
              <div class="dashboard__content__overview__item__content">
                <h5>Gender</h5>
                <h5><?php echo ucwords($user_info['gender'])?></h5>
              </div>
            </div>

            <div class="dashboard__content__overview__item">
              <i class="fas fa-language"></i>
              <div class="dashboard__content__overview__item__content">
                <h5>Language</h5>
                <h5><?php echo ucwords($user_info['language'])?></h5>
              </div>
            </div>

          </div>

        </div>
        <!-- /DASHBOARD_OVERVIEW -->

      </div>
      <!-- /DASHBOARD__CONTENT -->

    </div>
    <!-- /USER_DASHBOARD -->


    <!-- FOOTER -->
    <?php include '../includes/footer.php' ?>
    <!-- /FOOTER -->



  </div>
  <!-- /MAIN_CONTAINER -->


  <!-- jQuery -->
  <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous">
  </script>
  <!-- TweenMax -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>
  <!-- CUSTOM JS -->
  <script src='../js/navbar.js'></script>
  <script src='../js/userDashboard.js'></script>
  <script src="../js/preloader.js"></script>

</body>
</html>
