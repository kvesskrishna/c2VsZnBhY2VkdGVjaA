<?php include('templates/header.php');
$page="dashboard";
?>		<link rel="stylesheet" href="assets/css/jquery.gritter.min.css" />

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

<?php include('templates/sidenav.php');?>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							<li class="active">Dashboard</li>
						</ul><!-- /.breadcrumb -->
					</div>
<div class="col-md-12" id="catshares">
			<?php
		
			$sql_totalcourses="SELECT course_id FROM courses";
			$res_totalcourses=$mysqli->query($sql_totalcourses);
			$totalcourses=$res_totalcourses->num_rows;
			echo "<div class='h4'>Total Courses: ".$totalcourses."</div>";
				$sql_catshares="SELECT cat.category_id,cat.category_name, count(course.course_id) AS courses FROM course_categories cat, courses course WHERE cat.category_id=course.category_id group by course.category_id ";
				$res_catshares=$mysqli->query($sql_catshares);
				while ($row_catshares=$res_catshares->fetch_assoc()) {
					# code...
					
					$percent=$row_catshares['courses']/$totalcourses*100;

					?>
					<a href="viewcategory.php?id=<?php echo $row_catshares['category_id']?>">
						<div class="infobox infobox-large infobox-dark">
											<div class="infobox-progress">
												<div class="easy-pie-chart percentage" data-percent="<?php echo $percent?>" data-size="50">
													<span class="percent" style="color: white"><?php echo round($percent)?>%</span>
												</div>
											</div>

											<div class="infobox-data">
												<div class="infobox-content"><?php echo $row_catshares['category_name']?><br><?php echo $row_catshares['courses']?> courses</div>

											</div>
										</div></a>
					<?php
				}
			?>

					
									</div>
	
				</div>
			</div><!-- /.main-content -->
		
		</div><!-- /.main-container -->
		<!-- basic scripts -->
		<?php include('templates/basicscripts.php');?>
		<!-- page specific plugin scripts -->
				<script src="assets/js/jquery.gritter.min.js"></script>

		<script type="text/javascript">
			$(document).ready(function(){
				$('#catshares div').filter(':even').addClass('infobox-red');
				$('#catshares div').filter(':odd').addClass('infobox-blue');

			$.gritter.add({
				// (string | mandatory) the heading of the notificationclass_name: 'gritter-light',
				title: 'Hello Administrator!',
				// (string | mandatory) the text inside the notification
				text: 'Great power comes with great responsibility. Welcome to <a href="http://www.selfpacedtech.com" style="color:#ccc">Selfpaced tech</a>.',
			
				// (bool | optional) if you want it to fade out on its own or just sit there
				sticky: false,
				// (int | optional) the time you want it to be alive for before fading out
				time: '',
				class_name: 'gritter-info'
			});

			return false;
			
						});

		</script>
		<?php include('templates/JSpsDashboard.php');?>
		<!-- inline scripts related to this page -->
		<?php include('templates/JSisDashboard.php');?>	<?php include('templates/footer.php');?>
	</body>
</html>