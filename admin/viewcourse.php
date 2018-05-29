<?php include('templates/header.php');
$page="courses";
$courseid=$_GET['id'];
$sql_coursename="SELECT * FROM courses WHERE course_id=$courseid";
$res_coursename=$mysqli->query($sql_coursename);
if (!$res_coursename) {
	# code...
	die($mysqli->error);
}
$row_coursename=$res_coursename->fetch_assoc();

if (isset($_POST['update'])) {
	$topictitle=$_POST['topictitle'];
	$topiccontent=$_POST['topiccontent'];
	$topicid=$_POST['topicid'];
	for($j=0;$j<count($topictitle);$j++){
		if ($topictitle[$j]!=""&&$topiccontent[$j]!=""&&$topicid[$j]) {
			$topictitle[$j]=mysqli_real_escape_string($mysqli,$topictitle[$j]);
			$topiccontent[$j]=mysqli_real_escape_string($mysqli,$topiccontent[$j]);

			if($topicid[$j]!="null")
			{
				$sql_update="UPDATE course_curriculum SET topic_title='$topictitle[$j]', topic_content='$topiccontent[$j]',topic_modifiedon=now() WHERE topic_id=$topicid[$j]";
			}
			else
				$sql_update="INSERT INTO course_curriculum (topic_title,topic_content,course_id) VALUES ('$topictitle[$j]','$topiccontent[$j]',$courseid)";
			$res_update=$mysqli->query($sql_update);
			if(!$res_update) die($mysqli->error);
			header('Location:viewcourse.php?id='.$courseid);
		}
	}
}
if (isset($_POST['updateprerequisites'])) {
	# code...
	$prerequisites=$_POST['prerequisites'];
	$sql_updatepre="UPDATE courses SET course_prerequisites='$prerequisites' WHERE course_id=$courseid";
	$res_updatepre=$mysqli->query($sql_updatepre);
	if(!$res_updatepre) die($mysqli->error);
	header('Location:viewcourse.php?id='.$courseid);
}
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<style type="text/css">
	.table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th {
   background-color: lightblue;   
}
#orders i{
	font-size: 16px;
   	margin-left: 15px;
   }
   .fa-eye{
   	color: green;
   }
   .fa-trash{
   	color: red;
   }
</style>
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
							<li class="active">Course Details</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h1>
								<?php echo $row_coursename['course_name']?> <i class="ace-icon fa fa-angle-double-right"></i> Course Details
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									overview &amp; stats
								</small>                                
                                <?php 
                                if(isset($_SESSION['message']))
                                echo "<div style='color:red'>".$_SESSION['message']."</div>";
                                unset($_SESSION['message']);
                            ?>
							</h1>
							
						</div><!-- /.page-header -->
						

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								 <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#curriculum">Curriculum</a></li>
    <li><a data-toggle="tab" href="#prerequisites">Prerequisites</a></li>
    </ul>

  <div class="tab-content">
    <div id="curriculum" class="tab-pane fade in active">
      <h3>Curriculum</h3>
      <p>Course Contents</p>
      <form method="post" action="#" enctype="multipart/form-data">
      <table id="curriculum_table" align="center">
      <?php
      $sql_curriculum="SELECT * FROM course_curriculum WHERE course_id=$courseid";
      $res_curriculum=$mysqli->query($sql_curriculum);
      if (!$res_curriculum) {
      	# code...
      	die($mysqli->error);
      }
      $i=1;
      if($res_curriculum->num_rows==0){ ?>
      	<tr id="row<?php echo $i?>">
      		<td>
      			<label class="control-label col-md-4">Topic</label>
      			<input type="text" name="topictitle[]"  class="form-control">
      		</td>
            <td>
      			<textarea class="form-control" name="topiccontent[]"></textarea>
      	   </td>
           <td>
		      	<input type="hidden" name="topicid[]" value="null" >
      		</td>
      	</tr>
      <?php }
      while($row_curriculum=$res_curriculum->fetch_assoc()){
      	?>
      	<tr id="row<?php echo $i?>">
      		<td>
      			<label class="control-label col-md-4">Topic</label>
      			<input type="text" name="topictitle[]" value="<?php echo $row_curriculum['topic_title']?>" class="form-control">
      		</td>
            <td>
      			<textarea class="form-control" name="topiccontent[]"><?php echo $row_curriculum['topic_content']?></textarea>
      	   </td>
           <td>
		      	<input type="hidden" name="topicid[]" value="<?php echo $row_curriculum['topic_id']?>">
      		</td>
      	</tr>
      	<?php
      	$i++;
      }
      ?>   
      </table>
      	<button class="btn btn-success" onclick="add_row()" type="button">Add topic</button>
      	
      	<button class="btn btn-primary" name="update" type="submit">Update</button>
      </form>
      </div>
    <div id="prerequisites" class="tab-pane fade">
      <h3>Prerequisites</h3>
     <form method="post" action="#">
     	<textarea name="prerequisites"><?php echo $row_coursename['course_prerequisites']?></textarea>
     	<br>
     	<button class="btn btn-primary" name="updateprerequisites">Update</button>
     </form>
    </div>
  </div>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->
		<!-- basic scripts -->
		<?php include('templates/basicscripts.php');?>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
    		$('#ordersa').DataTable({
    			"order": [[ 3, "desc"]],
    		});
			} );
	
		</script>
		<script type="text/javascript" src="assets/js/tinymce/jquery.tinymce.min.js"></script>
		<script type="text/javascript" src="assets/js/tinymce/tinymce.min.js"></script>
		<script type="text/javascript">
			tinymce.init({ selector:'textarea',
				menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code'
  ]
			 });
		</script>
		<script type="text/javascript">
function add_row()
{
 $rowno=$("#curriculum_table tr").length;
 $rowno=$rowno+1;
 $("#curriculum_table tr:last").after("<tr id='row"+$rowno+"'><td><label class='control-label col-md-4'>Topic</label><input type='text' name='topictitle[]' class='form-control'></td><td><textarea name='topiccontent[]' class='form-control'></textarea></td><td><input type='hidden' name='topicid[]' value='null'></td><td><button type='button' class='btn btn-danger' onclick=delete_row('row"+$rowno+"')>Delete</button></td></tr>");
 tinymce.init({ selector:'textarea',
				menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code'
  ]
			 });
}
function delete_row(rowno)
{
 $('#'+rowno).remove();
}
</script>
		<!-- page specific plugin scripts -->
		<?php include('templates/JSpsDashboard.php');?>
		<!-- inline scripts related to this page -->
		<?php include('templates/JSisDashboard.php');?>			<?php include('templates/footer.php');?>

	</body>
</html>