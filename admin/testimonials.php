<?php include('templates/header.php');
$page="testimonials";

if (isset($_POST['addtestimonial'])) {
	$testimonial=mysqli_real_escape_string($mysqli,$_POST['testimonial']);
	$course=mysqli_real_escape_string($mysqli,$_POST['course']);
	$customer=mysqli_real_escape_string($mysqli,$_POST['customer']);
	$sql_adddata="INSERT INTO testimonials (testimonial,course_id,customer_name) VALUES ('$testimonial','$course','$customer')";
	
	$res_adddata=$mysqli->query($sql_adddata);
	if(!$res_adddata){
		die($mysqli->error);
	}
	$_SESSION['message']="Testimonial Inserted Successfully";
	header('Location:testimonials.php');
}
if (isset($_POST['edittestimonial'])) {
	$testimonial=mysqli_real_escape_string($mysqli,$_POST['testimonial']);
	$customer=mysqli_real_escape_string($mysqli,$_POST['customer']);
	$course=mysqli_real_escape_string($mysqli,$_POST['course']);
	
	$status=mysqli_real_escape_string($mysqli,$_POST['status']);
	$testid=$_POST['testimonialid'];
	$sql_updatedata="UPDATE testimonials SET testimonial='$testimonial', course_id='$course', customer_name='$customer', status='$status', modified_on=now() WHERE testimonial_id=$testid";
	$res_updatedata=$mysqli->query($sql_updatedata);
	if(!$res_updatedata){
		die($mysqli->error);
	}
	$_SESSION['message']=$alert="Testimonial Updated Successfully";
	header('Location:testimonials.php');

}
if (isset($_POST['deletetestimonial'])) {
	# code...
	$testid=$_POST['testimonialid'];
	$sql_deletedata="DELETE FROM testimonials WHERE testimonial_id=$testid";
	$res_deletedata=$mysqli->query($sql_deletedata);
	if (!$res_deletedata) {
		$_SESSION['message']=$alert="Testimonial Deleted Successfully";
	header('Location:testimonials.php');
	}
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
							<li class="active">Testimonials</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h1>
								Testimonials
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
                            <?php if($utest_create==1) {?>
							<p class="text-right"><a href="#addtestModal" role="button" class="btn btn-large btn-primary" data-toggle="modal">New Testimonial</a></p>
                            <?php }?>
						</div><!-- /.page-header -->
						<div id="addtestModal" class="modal fade">
							<div class="modal-dialog">
							    <div class="modal-content">
							        <div class="modal-header">
						                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						                <h4 class="modal-title">Add testimonial</h4>
						            </div>						            
							<form class="form-horizontal" method="post" action="#">            				
            						<div class="modal-body">
            						<div class="form-group">
            							<label class="control-label col-md-4">Course</label>
            							<div class="col-md-4">
            								<select class="form-control" name="course">
            									<?php
            									$sql_courses="SELECT * FROM courses WHERE course_status='Active'";
            									$res_courses=$mysqli->query($sql_courses);
            									while ($row_courses=$res_courses->fetch_assoc()) {
            										# code...
            										?>
            										<option value="<?php echo $row_courses['course_name']?>"><?php echo $row_courses['course_name']?></option>
            										<?php
            									}
            									?>
            								</select>
            							</div>
            						</div>
  							  			<div class="form-group">
            								<label class="control-label col-md-4">Testimonial</label>
            								<div class="col-md-4">
            									<textarea name="testimonial" class="form-control"></textarea>
            								</div>
            							</div>
            							<div class="form-group">
            								<label class="control-label col-md-4">Customer name</label>
            								<div class="col-md-4">
            									<input type="text" name="customer" class="form-control" required="">
            								</div>
            							</div>
					            	</div>
						            <div class="modal-footer">
						                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						                <button type="submit" name="addtestimonial" class="btn btn-primary">Add testimonial</button>
						            </div>
            				</form>
				        </div>
				    </div>
				</div>



						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="row">
								<div class="col-md-12">
	<table id="ordersa" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Course</th>
                <th>Customer</th>
                <th>Testimonial</th>
                <th>Created On</th>
               <th>Edit/Delete</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Course</th>
                <th>Customer</th>
                <th>Testimonial</th>
                <th>Created On</th>
               <th>Edit/Delete</th>
            </tr>
        </tfoot>
        <tbody>
        <?php
        $sql_getdata="SELECT * FROM testimonials";
        $res_getdata=$mysqli->query($sql_getdata);
        while ($row_getdata=$res_getdata->fetch_assoc()) {
        	
        	?>
        	<tr>
                <td><?php echo $row_getdata['course_id']?></td>
                <td><?php echo $row_getdata['customer_name']?></td>
                <td><?php echo $row_getdata['testimonial']?></td>
                <td><?php echo $row_getdata['created_on']?></td>
                <td><?php if($utest_update==1) {?><a href="#edit<?php echo $row_getdata['testimonial_id']?>" data-toggle="modal"><i class="fa fa-pencil-square-o"></i></a><?php } if($utest_delete==1) {?>
                <a href="#delete<?php echo $row_getdata['testimonial_id']?>" data-toggle="modal"><i class="fa fa-trash"></i></a><?php }?>
                <div id="delete<?php echo $row_getdata['testimonial_id']?>" class="modal fade">
							<div class="modal-dialog">
							    <div class="modal-content">
							        <div class="modal-header">
						                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						                <h4 class="modal-title">Delete Testimonial</h4>
						            </div>						            
							<form class="form-horizontal" method="post" action="#">            				
								Delete Testimonial by <b><?php echo $row_getdata['customer_name']?></b>
            						<p class="text-primary">Are you sure you want to delete this testimonial?</p>
					            	<input type="hidden" name="testimonialid" value="<?php echo $row_getdata['testimonial_id']?>">
						            <div class="modal-footer">
						                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						                <button type="submit" id="deletebtn" name="deletetestimonial" class="btn btn-primary">Delete testimonial</button>
						            </div>
            				</form>
				        </div>
				    </div>
				</div>

                  <div id="edit<?php echo $row_getdata['testimonial_id']?>" class="modal fade">
							<div class="modal-dialog">
							    <div class="modal-content">
							        <div class="modal-header">
						                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						                <h4 class="modal-title">Edit testimonial</h4>
						            </div>						            
							<form class="form-horizontal" method="post" action="#">            				
            						<div class="modal-body">
            						<div class="form-group">
            							<label class="control-label col-md-4">Course</label>
            							<div class="col-md-4">
            								<select class="form-control" name="course">
            								<option selected="" value="<?php echo $row_getdata['course_id']?>"><?php echo $row_getdata['course_id']?></option>
            									<?php
            									$sql_courses="SELECT * FROM courses WHERE course_status='Active'";
            									$res_courses=$mysqli->query($sql_courses);
            									while ($row_courses=$res_courses->fetch_assoc()) {
            										# code...
            										?>
            										<option value="<?php echo $row_courses['course_name']?>"><?php echo $row_courses['course_name']?></option>
            										<?php
            									}
            									?>
            								</select>
            							</div>
            						</div>
  							  			<div class="form-group">
            								<label class="control-label col-md-4">Testimonial</label>
            								<div class="col-md-4">
            									<textarea name="testimonial" class="form-control"><?php echo $row_getdata['testimonial']?></textarea>
            								</div>
            							</div>
            							<div class="form-group">
            								<label class="control-label col-md-4">Customer</label>
            								<div class="col-md-4">
            									<input type="text" name="customer" class="form-control" required="" value="<?php echo $row_getdata['customer_name']?>">
            								</div>
            							</div>
            							<div class="form-group">
            								<label class="control-label col-md-4">Status</label>
            								<div class="col-md-4">
            									<select class="form-control" name="status">
            										<option selected="" value="<?php echo $row_getdata['status']?>"><?php echo $row_getdata['status']?></option>
            										<option value="Active">Active</option>
            										<option value="Inactive">Inactive</option>
            									</select>
            								</div>
            							</div>
					            	</div>
					            	<input type="hidden" name="testimonialid" value="<?php echo $row_getdata['testimonial_id']?>">
						            <div class="modal-footer">
						                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						                <button type="submit" id="editbtn" name="edittestimonial" class="btn btn-primary">Edit testimonial</button>
						            </div>
            				</form>
				        </div>
				    </div>
				</div>
                </td>
            </tr>

        	<?php
        }
        ?>               
        </tbody>
    </table>
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
    // Setup - add a text input to each footer cell
    $('#ordersa tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#ordersa').DataTable();
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );
		</script>
		
		<!-- page specific plugin scripts -->
		<?php include('templates/JSpsDashboard.php');?>
		<!-- inline scripts related to this page -->
		<?php include('templates/JSisDashboard.php');?>			<?php include('templates/footer.php');?>

	</body>
</html>