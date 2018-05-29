<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>


				<ul class="nav nav-list">
					<li <?php if ($page=="dashboard") echo "class='active'";?>>
						<a href="home.php">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>
					<?php if($ucat_read==1){?>
					<li <?php if ($page=="courses") echo "class='active'";?>>
						<a href="coursecategories.php">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Courses </span>
						</a>

						<b class="arrow"></b>
					</li>
					<?php } if($utest_read==1){?>
					
					<li <?php if ($page=="testimonials") echo "class='active'";?>>
						<a href="testimonials.php">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Testimonials </span>
						</a>

						<b class="arrow"></b>
					</li>
					<?php } if($ufaq_read==1){?>
					<li <?php if ($page=="faqs") echo "class='active'";?>>
						<a href="faqs.php">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> FAQs </span>
						</a>

						<b class="arrow"></b>
					</li>
										<?php } if($uenreq_read==1){?>

					<li <?php if ($page=="enrollments") echo "class='active'";?>>
						<a href="enrollments.php">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Enrollment Requests </span>
						</a>

						<b class="arrow"></b>
					</li>
										<?php } if($uschreq_read==1){?>

					<li <?php if ($page=="schedulerequests") echo "class='active'";?>>
						<a href="schedulerequests.php">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Schedule Requests </span>
						</a>

						<b class="arrow"></b>
					</li>
										<?php } if($ubusreq_read==1){?>

						<li <?php if ($page=="forbusiness") echo "class='active'";?>>
						<a href="forbusiness.php">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> For Business </span>
						</a>

						<b class="arrow"></b>
					</li>
										<?php } if($uinsreq_read==1){?>

					<li <?php if ($page=="instructorapplications") echo "class='active'";?>>
						<a href="instructorapplications.php">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Instructor Resumes </span>
						</a>

						<b class="arrow"></b>
					</li>
					<?php } if($uadminmanagement==1){?>
					<li <?php if ($page=="usermanagement") echo "class='active'";?>>
						<a href="usermanagement.php">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Admin Management </span>
						</a>

						<b class="arrow"></b>
					</li>
					<?php } ?>
					
					<li >
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Training </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<?php if($udtraining_read==1){?>
							<li <?php if ($page=="trainings") echo "class='active'";?>>
								<a href="trainings.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Day Training
								</a>

								<b class="arrow"></b>
							</li>
							<?php } if($untraining_read==1){?>

							<li <?php if ($page=="nighttrainings") echo "class='active'";?>>
								<a href="nighttrainings.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Night Training
								</a>

								<b class="arrow"></b>
							</li>
							<?php }?>
						</ul>
					</li>
					<li >
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Support </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<?php if($udsupport_read==1){?>
							<li <?php if ($page=="support") echo "class='active'";?>>
								<a href="support.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Day Support
								</a>

								<b class="arrow"></b>
							</li>
							<?php } if($unsupport_read==1){?>

							<li <?php if ($page=="nightsupport") echo "class='active'";?>>
								<a href="nightsupport.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Night Support
								</a>

								<b class="arrow"></b>
							</li>
							<?php }?>
						</ul>
					</li>
	
				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>