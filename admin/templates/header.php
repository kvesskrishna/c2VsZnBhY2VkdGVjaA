<?php session_start();
require_once('dbconfig.php');
if(!isset($_SESSION['user']))
{
	header('Location:signin.php');
	exit();
}
$sql_getuac="SELECT * FROM admins_uac WHERE adminid=".$_SESSION['userid'];
$res_getuac=$mysqli->query($sql_getuac);
$row_getuac=$res_getuac->fetch_assoc();
$ucat_create=$row_getuac['cat_create'];
$ucat_read=$row_getuac['cat_read'];
$ucat_update=$row_getuac['cat_update'];
$ucat_delete=$row_getuac['cat_delete'];
$ucourse_create=$row_getuac['course_create'];
$ucourse_read=$row_getuac['course_read'];
$ucourse_update=$row_getuac['course_update'];
$ucourse_delete=$row_getuac['course_delete'];
$utest_create=$row_getuac['test_create'];
$utest_read=$row_getuac['test_read'];
$utest_update=$row_getuac['test_update'];
$utest_delete=$row_getuac['test_delete'];
$ufaq_create=$row_getuac['faq_create'];
$ufaq_read=$row_getuac['faq_read'];
$ufaq_update=$row_getuac['faq_update'];
$ufaq_delete=$row_getuac['faq_delete'];
$uenreq_create=$row_getuac['enreq_create'];
$uenreq_read=$row_getuac['enreq_read'];
$uenreq_update=$row_getuac['enreq_update'];
$uenreq_delete=$row_getuac['enreq_delete'];
$ubusreq_create=$row_getuac['busreq_create'];
$ubusreq_read=$row_getuac['busreq_read'];
$ubusreq_update=$row_getuac['busreq_update'];
$ubusreq_delete=$row_getuac['busreq_delete'];
$uschreq_create=$row_getuac['schreq_create'];
$uschreq_read=$row_getuac['schreq_read'];
$uschreq_update=$row_getuac['schreq_update'];
$uschreq_delete=$row_getuac['schreq_delete'];
$uinsreq_create=$row_getuac['insreq_create'];
$uinsreq_read=$row_getuac['insreq_read'];
$uinsreq_update=$row_getuac['insreq_update'];
$uinsreq_delete=$row_getuac['insreq_delete'];
$udtraining_create=$row_getuac['dtraining_create'];
$udtraining_read=$row_getuac['dtraining_read'];
$udtraining_update=$row_getuac['dtraining_update'];
$udtraining_delete=$row_getuac['dtraining_delete'];
$untraining_create=$row_getuac['ntraining_create'];
$untraining_read=$row_getuac['ntraining_read'];
$untraining_update=$row_getuac['ntraining_update'];
$untraining_delete=$row_getuac['ntraining_delete'];
$uadminmanagement=$row_getuac['adminmanagement'];
$udsupport_create=$row_getuac['dsupport_create'];
$udsupport_read=$row_getuac['dsupport_read'];
$udsupport_update=$row_getuac['dsupport_update'];
$udsupport_delete=$row_getuac['dsupport_delete'];
$unsupport_create=$row_getuac['nsupport_create'];
$unsupport_read=$row_getuac['nsupport_read'];
$unsupport_update=$row_getuac['nsupport_update'];
$unsupport_delete=$row_getuac['nsupport_delete'];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Web Admin - Selfpaced Tech</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="assets/css/jquery-ui.custom.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="assets/js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		
	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default          ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="home.php" class="navbar-brand">
						<small>
							
							Selfpaced Tech Web Admin
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
					<li class="blue dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-bell"></i>
								<span class="badge badge-danger newenrollments"></span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-check"></i>
									<span class=newenrollments></span> new Enrollment Requests
								</li>

								
								<li class="dropdown-footer">
									<a href="enrollments.php">
										See all Enrollments
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>
						<li class="blue dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-clock-o"></i>
								<span class="badge badge-warning newschedulerequests"></span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-check"></i>
									<span class="newschedulerequests"></span> new Schedule Requests
								</li>

								
								<li class="dropdown-footer">
									<a href="schedulerequests.php">
										See all Schedule Requests
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>
						<li class="blue dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-bold"></i>
								<span class="badge badge-success newbusinessrequests"></span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-check"></i>
									<span class="newbusinessrequests"></span> new Business Requests
								</li>

								
								<li class="dropdown-footer">
									<a href="forbusiness.php">
										See all Business Requests
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>
						<li class="blue dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-italic"></i>
								<span class="badge badge-primary newinstructorrequests"></span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-check"></i>
									<span class="newinstructorrequests"></span> new Instructor Profiles
								</li>

								
								<li class="dropdown-footer">
									<a href="instructorapplications.php">
										See all Instructor Profiles
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>
						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="assets/images/avatars/admin.png" alt="Admin's Photo" />
								<span class="user-info">
									<small>Welcome,</small>
									<?php echo $_SESSION['adminname']?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
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

								<li class="divider"></li>

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
		