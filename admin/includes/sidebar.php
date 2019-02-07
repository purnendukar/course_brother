<div id="sidebar" class="sidebar responsive ace-save-state" >
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<ul class="nav nav-list">

					<li class="">
						<a href="index.php">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>
					</li> <!-- Dashboard Side Option Ends -->
					<li class="">
						<a href="#" class='dropdown-toggle'>
              			  <i class="menu-icon fa fa-leaf"></i>
							<span class="menu-text"> Website Page </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						

						<ul class="submenu">

							<li class="">
								<a href="#" class='dropdown-toggle'>
              			          <i class="menu-icon fa fa-leaf"></i>
							       <span class="menu-text"> Page List </span>
							      <b class="arrow fa fa-angle-down"></b>
						        </a>
								<ul class="submenu">

									<li class="">
										<a href="./indexPageForm.php">
											<i class="menu-icon fa fa-caret-right"></i>
											<b class="fa fa-edit"></b> &nbsp; Index Page
										</a>
									</li>

									<li class="">
										<a href="./aboutPageForm.php">
											<i class="menu-icon fa fa-caret-right"></i>
											<b class="fa fa-edit"></b> &nbsp; About Us
										</a>
									</li>
									<li class="">
										<a href=".contactPAgeForm.php">
											<i class="menu-icon fa fa-caret-right"></i>
											<b class="fa fa-edit"></b> &nbsp; Contact Us
										</a>
									</li>
									<li class="">
										<a href=".contactPAgeForm.php">
											<i class="menu-icon fa fa-caret-right"></i>
											<b class="fa fa-edit"></b> &nbsp; Shipping Policy
										</a>
									</li>
									<li class="">
										<a href=".contactPAgeForm.php">
											<i class="menu-icon fa fa-caret-right"></i>
											<b class="fa fa-edit"></b> &nbsp; Refund Policy
										</a>
									</li>
									<li class="">
										<a href=".contactPAgeForm.php">
											<i class="menu-icon fa fa-caret-right"></i>
											<b class="fa fa-edit"></b> &nbsp; Disclaimer
										</a>
									</li>
									<li class="">
										<a href=".contactPAgeForm.php">
											<i class="menu-icon fa fa-caret-right"></i>
											<b class="fa fa-edit"></b> &nbsp; Terms & Condition
										</a>
									</li>
									<li class="">
										<a href=".contactPAgeForm.php">
											<i class="menu-icon fa fa-caret-right"></i>
											<b class="fa fa-edit"></b> &nbsp; Privacy Policy
										</a>
									</li>
									<li class="">
										<a href=".contactPAgeForm.php">
											<i class="menu-icon fa fa-caret-right"></i>
											<b class="fa fa-edit"></b> &nbsp; Legal Policy
										</a>
									</li>
								</ul>
							</li>

						</ul>
					</li>

					<li class="">
						<a href="#" class='dropdown-toggle'>
              			  <i class="menu-icon fa fa-leaf"></i>
							<span class="menu-text"> Logo </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						

						<ul class="submenu">

							<li class="">
								<a href="./logoAddDropzone.php">
									<i class="menu-icon fa fa-caret-right"></i>
									<b class="fa fa-plus"></b> &nbsp; Add
								</a>
							</li>

							<li class="">
								<a href="./logoEditDropzone.php">
									<i class="menu-icon fa fa-caret-right"></i>
									<b class="fa fa-edit"></b> &nbsp; Edit
								</a>
							</li>

						</ul>
					</li>

					<!-- NexGen Shiksha Side Option Ends -->

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-bars"></i>
							<span class="menu-text"> Menu </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							<li class="">
								<a href="./menuAddForm.php">
									<i class="menu-icon fa fa-caret-right"></i>
									<b class="fa fa-plus"></b> &nbsp; Add
								</a>
							</li>

							<li class="">
								<a href="./all_menu.php">
									<i class="menu-icon fa fa-caret-right"></i>
									<b class="fa fa-edit"></b> &nbsp; All Menu
								</a>
							</li>
						</ul>
					</li> <!-- Menu Side Option Ends -->

					<li class="">
						<a href="#" class="dropdown-toggle">
              			<i class="menu-icon fa fa-file"></i>
							<span class="menu-text"> Index Page </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							
							<li class="">
								<a href="./indexPageForm.php">
									<i class="menu-icon fa fa-caret-right"></i>
									<b class="fa fa-edit"></b> &nbsp; Edit
								</a>
							</li>

						</ul>
					</li> <!-- Index Page Side Option Ends -->

					<li class="">
						<a href="#" class="dropdown-toggle">
              			<i class="menu-icon fa fa-file"></i>
							<span class="menu-text"> Blogs </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							
						<li class="">
								<a href="./blogAddForm.php">
									<i class="menu-icon fa fa-caret-right"></i>
									<b class="fa fa-plus"></b> &nbsp; Add
								</a>
							</li>
							<li class="">
								<a href="./blogEditForm.php">
									<i class="menu-icon fa fa-caret-right"></i>
									<b class="fa fa-edit"></b> &nbsp; Edit
								</a>
							</li>
							<li class="">
								<a href="./blogDeleteForm.php">
									<i class="menu-icon fa fa-caret-right"></i>
									<b class="fa fa-minus"></b> &nbsp; Delete
								</a>
							</li>

						</ul>
					</li><!-- Blog Section -->

					<li class="">
						<a href="#" class="dropdown-toggle">
              			<i class="menu-icon fa fa-file"></i>
							<span class="menu-text"> News & Update</span>
							<b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							<?php $r=$conn_p->query("select * from universities");
							while($ro=$r->fetch_assoc()){ ?>
							<li class="">
								<a href="./newsletterEditForm.php?id=<?php echo $ro['u_id'];?>">
									<i class="menu-icon fa fa-caret-right"></i>
									<b class="fa fa-edit"></b> &nbsp; <?php echo $ro['u_name']?>
								</a>
							</li>
							<?php } ?>

						</ul>
					</li><!-- Blog Section -->
                    
                    <li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-building"></i>
              <span class="menu-text"> Testimonial </span>
              <b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							
							<li class="">
								<a href="./Testimonial.php">
									<i class="menu-icon fa fa-caret-right"></i>
									<b class="fa fa-edit"></b> &nbsp; Edit
								</a>
							</li>

						</ul>

					</li> <!-- Testimonial  -->


					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-building"></i>
              <span class="menu-text"> University </span>
              <b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							
							<li class="">
								<a href="./institutionAddForm.php">
									<i class="menu-icon fa fa-caret-right"></i>
									<b class="fa fa-plus"></b> &nbsp; Add
								</a>
							</li>
							<li class="">
								<a href="./institutionEditForm.php">
									<i class="menu-icon fa fa-caret-right"></i>
									<b class="fa fa-edit"></b> &nbsp; Edit
								</a>
							</li>
							<li class="">
								<a href="./institutionDeleteForm.php">
									<i class="menu-icon fa fa-caret-right"></i>
									<b class="fa fa-minus"></b> &nbsp; Delete
								</a>
							</li>

						</ul>

					</li> <!-- Institution Side Option Ends -->

					<li class="">
						<a href="#" class='dropdown-toggle'>
							<i class="menu-icon fa fa-book"></i>
							<span class="menu-text"> Courses </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<ul class="submenu">
							
							<li class="">
								<a href="./courseAddForm.php">
									<i class="menu-icon fa fa-caret-right"></i>
									<b class="fa fa-plus"></b> &nbsp; Add
								</a>
							</li>
							<li class="">
								<a href="./courseEditForm.php">
									<i class="menu-icon fa fa-caret-right"></i>
									<b class="fa fa-edit"></b> &nbsp; Edit
								</a>
							</li>
							<li class="">
								<a href="./courseDeleteForm.php">
									<i class="menu-icon fa fa-caret-right"></i>
									<b class="fa fa-minus"></b> &nbsp; Delete
								</a>
							</li>

						</ul>
					</li>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-bars"></i>
							<span class="menu-text"> User </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							<li class="">
								<a href="./user.php">
									<i class="menu-icon fa fa-caret-right"></i>
									<b class="fa fa-plus"></b> &nbsp; Team Members
								</a>
							</li>

							<li class="">
								<a href="./lead.php">
									<i class="menu-icon fa fa-caret-right"></i>
									<b class="fa fa-edit"></b> &nbsp; Lead User Info
								</a>
							</li>
						</ul>
					</li> <!-- Menu Side Option Ends -->

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list-alt"></i>

							<span class="menu-text">
								Forms
							</span>
							<b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Form 1
								</a>
							</li>

							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Form 2
								</a>
							</li>

							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Form 3
								</a>
              				</li>
						</ul>

					</li> <!-- Forms Side Option Ends -->

				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>