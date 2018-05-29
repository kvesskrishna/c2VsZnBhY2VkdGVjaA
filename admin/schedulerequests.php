<?php include('templates/header.php');
$page="schedulerequests";

if (isset($_POST['addschrequest'])) {
	$newcourse=mysqli_real_escape_string($mysqli,$_POST['course']);
	$newname=mysqli_real_escape_string($mysqli,$_POST['name']);
	$newemail=mysqli_real_escape_string($mysqli,$_POST['email']);
	$newphone=mysqli_real_escape_string($mysqli,$_POST['phone']);
	$newstatus=mysqli_real_escape_string($mysqli,$_POST['status']);
	$newnotes=mysqli_real_escape_string($mysqli,$_POST['notes']."<br>-Added by: ".$_SESSION['user']);
    $newtimezone=mysqli_real_escape_string($mysqli,$_POST['timezone']);
    $newpreferredtime=mysqli_real_escape_string($mysqli,$_POST['preferredtime']);
    
	$sql_updatedata="INSERT INTO schedule_requests (sch_course, sch_name,sch_email,sch_phone,sch_status,sch_notes,sch_timezone,sch_time) VALUES ('$newcourse','$newname','$newemail','$newphone','$newstatus','$newnotes','$newtimezone','$newpreferredtime')";
	$res_updatedata=$mysqli->query($sql_updatedata);
	if(!$res_updatedata){
		die($mysqli->error);
	}
	$_SESSION['message']=$alert="Request added Successfully";
	header('Location:schedulerequests.php');
}
if (isset($_POST['editschrequest'])) {
	$newcourse=mysqli_real_escape_string($mysqli,$_POST['course']);
	$newname=mysqli_real_escape_string($mysqli,$_POST['name']);
	$newemail=mysqli_real_escape_string($mysqli,$_POST['email']);
	$newphone=mysqli_real_escape_string($mysqli,$_POST['phone']);
	$newstatus=mysqli_real_escape_string($mysqli,$_POST['status']);
	$newnotes=mysqli_real_escape_string($mysqli,$_POST['notes']."---Edit by: ".$_SESSION['user']);
 $newtimezone=mysqli_real_escape_string($mysqli,$_POST['timezone']);
    $newpreferredtime=mysqli_real_escape_string($mysqli,$_POST['preferredtime']);
    
	$schid=$_POST['schid'];
	$sql_updatedata="UPDATE schedule_requests SET sch_course='$newcourse', sch_name='$newname',sch_email='$newemail',sch_phone='$newphone',sch_status='$newstatus',sch_notes='$newnotes', sch_modifiedon=now(),sch_timezone='$newtimezone',sch_time='$newpreferredtime' WHERE sch_id=$schid";
	$res_updatedata=$mysqli->query($sql_updatedata);
	if(!$res_updatedata){
		die($mysqli->error);
	}
	$_SESSION['message']=$alert="Request Updated Successfully";
	header('Location:schedulerequests.php');

}
if (isset($_POST['deleteschrequest'])) {
	# code...
	$schid=$_POST['schid'];
	$sql_deletedata="DELETE FROM schedule_requests WHERE sch_id=$schid";
	$res_deletedata=$mysqli->query($sql_deletedata);
	if (!$res_deletedata) {
		$_SESSION['message']=$alert="Request Deleted Successfully";
	header('Location:schedulerequests .php');
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
							<li class="active">Schedule Requests</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h1>
								Schedule Requests
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
                            <?php if($uschreq_create==1) {?>
							<p class="text-right"><a href="#addenmodal" role="button" class="btn btn-large btn-primary" data-toggle="modal">New Request</a></p>
                            <?php }?>
						</div><!-- /.page-header -->
						 <div id="addenmodal" class="modal fade">
							<div class="modal-dialog">
							    <div class="modal-content">
							        <div class="modal-header">
						                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						                <h4 class="modal-title">Add Request</h4>
						            </div>						            
							<form class="form-horizontal" method="post" action="#">            				
            						<div class="modal-body">
  							  			<div class="form-group">
            								<label class="control-label col-md-4">Course</label>
            								<div class="col-md-4">
            									<select name="course" class="form-control">
            									<?php
            									$sql_courselist="SELECT * FROM courses WHERE course_status='Active'";
            									$res_courselist=$mysqli->query($sql_courselist);
            									while ($row_courselist=$res_courselist->fetch_assoc()) {
            										?>
            										<option value="<?php echo $row_courselist['course_name']?>"><?php echo $row_courselist['course_name']?></option>
            										<?php
            									}
            									?>
            									
            									</select>
            								</div>
            							</div>
            							<div class="form-group">
            								<label class="control-label col-md-4">Contact Name</label>
            								<div class="col-md-4">
            									<input type="text" name="name" class="form-control" required="">
            								</div>
            							</div>
            							<div class="form-group">
            								<label class="control-label col-md-4">Email</label>
            								<div class="col-md-4">
            									<input type="email" name="email" class="form-control" required="">
            								</div>
            							</div>
            							<div class="form-group">
            								<label class="control-label col-md-4">Phone</label>
            								<div class="col-md-4">
            									<input type="text" name="phone" class="form-control" required="">
            								</div>
            							</div>
                                         <div class="form-group">
                                            <label class="control-label col-md-4">Timezone</label>
                                            <div class="col-md-4">
                                                <input type="text" name="timezone" class="form-control" required="" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Preferred Time</label>
                                            <div class="col-md-4">
                                                <input type="text" name="preferredtime" class="form-control" required="" >
                                            </div>
                                        </div>
            							<div class="form-group">
            								<label class="control-label col-md-4">Status</label>
            								<div class="col-md-4">
            									<select class="form-control" name="status">
            										<?php
            									$sql_stlist="SELECT * FROM request_status";
            									$res_stlist=$mysqli->query($sql_stlist);
            									while ($row_stlist=$res_stlist->fetch_assoc()) {
            										?>
            										<option value="<?php echo $row_stlist['rs_name']?>"><?php echo $row_stlist['rs_name']?></option>
            										<?php
            									}
            									?>
            									
            									</select>
            								</div>
            							</div>
					            	</div>
					            	<div class="form-group">
            								<label class="control-label col-md-4">Notes</label>
            								<div class="col-md-4">
            									<textarea name="notes" class="form-control"></textarea>
            								</div>
            							</div>
						            <div class="modal-footer">
						                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						                <button type="submit" id="addbtn" name="addenrollment" class="btn btn-primary">Add Request</button>
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
	<table id="ordersa" width="100%" cellspacing="0" class="display compact" width="70%">
        <thead>
            <tr>
                <th>Course</th>
                <th>Contact Name</th>
                <th>Mobile</th>
                <th>Status</th>
                <th>Date</th>
               <th>Edit/Delete</th>
            </tr>
        </thead>
        <tfoot>
          <tr>
                <th>Course</th>
                <th>Contact Name</th>
                <th>Mobile</th>
                <th>Status</th>
                <th>Date</th>
                <th>Edit/Delete</th>
            </tr>
        </tfoot>
        <tbody>
        <?php
        $sql_getdata="SELECT * FROM schedule_requests";
        $res_getdata=$mysqli->query($sql_getdata);
        while ($row_getdata=$res_getdata->fetch_assoc()) {
        	# code...
        	?>
        	<tr>
                <td><?php if($row_getdata['sch_status']=='New'){?><span class="label label-success">New</span> <?php } echo $row_getdata['sch_course']?> </td>
                <td><?php echo $row_getdata['sch_name']?></td>
                <td><?php echo $row_getdata['sch_phone']?></td>
                <td><?php echo $row_getdata['sch_status']?></td>
                <td><?php echo $row_getdata['sch_createdon']?></td>
               <td><?php if($uschreq_update==1) {?><a href="#edit<?php echo $row_getdata['sch_id']?>" data-toggle="modal"><i class="fa fa-pencil-square-o"></i></a><?php } if($uschreq_delete==1) {?>
                <a href="#delete<?php echo $row_getdata['sch_id']?>" data-toggle="modal"><i class="fa fa-trash"></i></a><?php }?>
                <div id="delete<?php echo $row_getdata['sch_id']?>" class="modal fade">
							<div class="modal-dialog">
							    <div class="modal-content">
							        <div class="modal-header">
						                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						                <h4 class="modal-title">Delete Request</h4>
						            </div>						            
							<form class="form-horizontal" method="post" action="#">            				
								Delete Request for <b><?php echo $row_getdata['sch_course']?></b>
            						<p class="text-primary">Are you sure you want to delete this request?</p>
					            	<input type="hidden" name="schid" value="<?php echo $row_getdata['sch_id']?>">
						            <div class="modal-footer">
						                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						                <button type="submit" id="deletebtn" name="deleteschrequest" class="btn btn-primary">Delete Request</button>
						            </div>
            				</form>
				        </div>
				    </div>
				</div>

                  <div id="edit<?php echo $row_getdata['sch_id']?>" class="modal fade">
							<div class="modal-dialog">
							    <div class="modal-content">
							        <div class="modal-header">
						                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						                <h4 class="modal-title">Edit Request</h4>
						            </div>						            
							<form class="form-horizontal" method="post" action="#">            				
            						<div class="modal-body">
  							  			<div class="form-group">
            								<label class="control-label col-md-4">Course</label>
            								<div class="col-md-4">
            									<select name="course" class="form-control">
            									<option selected="" value="<?php echo $row_getdata['sch_course']?>">
            										<?php echo $row_getdata['sch_course']?>
            									</option>
            									<?php
            									$sql_courselist="SELECT * FROM courses WHERE course_status='Active'";
            									$res_courselist=$mysqli->query($sql_courselist);
            									while ($row_courselist=$res_courselist->fetch_assoc()) {
            										?>
            										<option value="<?php echo $row_courselist['course_name']?>"><?php echo $row_courselist['course_name']?></option>
            										<?php
            									}
            									?>
            									
            									</select>
            								</div>
            							</div>
            							<div class="form-group">
            								<label class="control-label col-md-4">Contact Name</label>
            								<div class="col-md-4">
            									<input type="text" name="name" class="form-control" required="" value="<?php echo $row_getdata['sch_name']?>">
            								</div>
            							</div>
            							<div class="form-group">
            								<label class="control-label col-md-4">Email</label>
            								<div class="col-md-4">
            									<input type="email" name="email" class="form-control" required="" value="<?php echo $row_getdata['sch_email']?>">
            								</div>
            							</div>
            							<div class="form-group">
            								<label class="control-label col-md-4">Phone</label>
            								<div class="col-md-4">
            									<input type="text" name="phone" class="form-control" required="" value="<?php echo $row_getdata['sch_phone']?>">
            								</div>
            							</div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Timezone</label>
                                            <div class="col-md-4">
                                                <input type="text" name="timezone" class="form-control" required="" value="<?php echo $row_getdata['sch_timezone']?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Preferred Time</label>
                                            <div class="col-md-4">
                                                <input type="text" name="preferredtime" class="form-control" required="" value="<?php echo $row_getdata['sch_time']?>">
                                            </div>
                                        </div>
            							<div class="form-group">
            								<label class="control-label col-md-4">Status</label>
            								<div class="col-md-4">
            									<select class="form-control" name="status">
            										<option selected="" value="<?php echo $row_getdata['sch_status']?>"><?php echo $row_getdata['sch_status']?></option>
            										<?php
            									$sql_stlist="SELECT * FROM request_status";
            									$res_stlist=$mysqli->query($sql_stlist);
            									while ($row_stlist=$res_stlist->fetch_assoc()) {
            										?>
            										<option value="<?php echo $row_stlist['rs_name']?>"><?php echo $row_stlist['rs_name']?></option>
            										<?php
            									}
            									?>
            									
            									</select>
            								</div>
            							</div>
					            	</div>
					            	<div class="form-group">
            								<label class="control-label col-md-4">Notes</label>
            								<div class="col-md-4">
            									<textarea name="notes" class="form-control"><?php echo $row_getdata['sch_notes']?></textarea>
            								</div>
            							</div>
					            	<input type="hidden" name="schid" value="<?php echo $row_getdata['sch_id']?>">
						            <div class="modal-footer">
						                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						                <button type="submit" id="editbtn" name="editschrequest" class="btn btn-primary">Edit Request</button>
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
			//$(document).ready(function() {
    		//$('#ordersa').DataTable({
    		//	"order": [[ 4, "desc"]],
    		//});
			//} );
            $(document).ready(function() {
               $('#ordersa').DataTable({
             "order": [[ 4, "desc"]],
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