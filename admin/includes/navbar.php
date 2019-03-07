<?php ob_start();
if(!(isset($_COOKIE['user_id']))){
    header('Location: login');
}
include "./includes/mysql_connect.php";
$conn_p=connect_mysql_page();
?>

<div id="navbar" class="navbar navbar-default ace-save-state" >
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="index.php" class="navbar-brand">
						<small>
							<i class="fa fa-leaf"></i>
							Course Brother
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						
						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="assets/images/avatars/user.jpg" alt="Jason's Photo" />
								<span class="user-info">
									<small>Welcome,</small>
									<?php
                                        $conn=connect_mysql();
                                        $res=$conn->query("select * from user where id=".$_COOKIE['user_id']);
                                        if($row=$res->fetch_assoc()){
                                            $user_name=$row['u_name'];
                                            $user_type=$row['type'];
                                            echo $row['f_name'];
                                        }
                                    ?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<!-- <li>
									<a href="#">
										<i class="ace-icon fa fa-cog"></i>
										Settings
									</a>
								</li>

								<li>
									<a href="profile.html">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li> -->

								<li>
									<a href="logout.php">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
</div>
<?php

if($user_type=="content_manager"){
    $a=['user.php','lead.php','admission_form.php'];
    $contain=false;
    for($i=0;$i<count($a);$i++){
        if(strpos($_SERVER['REQUEST_URI'],$a[$i])){
            $contain=true;
            break;
        }
    }
    if($contain===true){
        echo "<script>alert('You can not access this page');window.location.href='./index.php';</script>";
    }
        
}


if($user_type=="author"){
    $a=['blogAddForm.php','blogEditForm.php','blogDeleteForm.php'];
    $contain=false;
    for($i=0;$i<count($a);$i++){
        if(strpos($_SERVER['REQUEST_URI'],$a[$i])){
            $contain=true;
            break;
        }
    }
    if($contain===false){
        echo "<script>alert('You can not access this page');window.location.href='./index.php';</script>";
    }
        
}

?>