<?php include('templates/header.php');
$page="enrollments";

if (isset($_POST['addenrollment'])) {
    $timezone=mysqli_real_escape_string($mysqli,$_POST['timezone']);
    $newcourse=mysqli_real_escape_string($mysqli,$_POST['course']);
	$newname=mysqli_real_escape_string($mysqli,$_POST['name']);
	$newemail=mysqli_real_escape_string($mysqli,$_POST['email']);
	$newphone=mysqli_real_escape_string($mysqli,$_POST['phone']);
	$newstatus=mysqli_real_escape_string($mysqli,$_POST['status']);
	$newnotes=mysqli_real_escape_string($mysqli,$_POST['notes']."---Added by: ".$_SESSION['user']);

	$sql_updatedata="INSERT INTO enroll_requests (en_course, en_name,en_email,en_phone,en_status,en_notes, en_timezone) VALUES ('$newcourse','$newname','$newemail','$newphone','$newstatus','$newnotes','$timezone')";
	$res_updatedata=$mysqli->query($sql_updatedata);
	if(!$res_updatedata){
		die($mysqli->error);
	}
	$_SESSION['message']=$alert="Enrollment added Successfully";
	header('Location:enrollments.php');
}
if (isset($_POST['editenrollment'])) {
	$newcourse=mysqli_real_escape_string($mysqli,$_POST['course']);
	$newname=mysqli_real_escape_string($mysqli,$_POST['name']);
	$newemail=mysqli_real_escape_string($mysqli,$_POST['email']);
	$newphone=mysqli_real_escape_string($mysqli,$_POST['phone']);
	$newstatus=mysqli_real_escape_string($mysqli,$_POST['status']);
	$newnotes=mysqli_real_escape_string($mysqli,$_POST['notes']."---Edit by: ".$_SESSION['user']);
    $timezone=mysqli_real_escape_string($mysqli,$_POST['timezone']);
	$enid=$_POST['enid'];
	$sql_updatedata="UPDATE enroll_requests SET en_course='$newcourse', en_name='$newname',en_email='$newemail',en_phone='$newphone',en_status='$newstatus',en_notes='$newnotes', en_modifiedon=now(),  en_timezone='$timezone' WHERE en_id=$enid";
	$res_updatedata=$mysqli->query($sql_updatedata);
	if(!$res_updatedata){
		die($mysqli->error);
	}
	$_SESSION['message']=$alert="Enrollment Updated Successfully";
	header('Location:enrollments.php');

}
if (isset($_POST['deleteenrollment'])) {
	# code...
	$enid=$_POST['enid'];
	$sql_deletedata="DELETE FROM enroll_requests WHERE en_id=$enid";
	$res_deletedata=$mysqli->query($sql_deletedata);
	if (!$res_deletedata) {
		$_SESSION['message']=$alert="Enrollment Deleted Successfully";
	header('Location:enrollments.php');
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
							<li class="active">Enroll Requests</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h1>
								Enroll Requests
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
                            <?php if($uenreq_create==1) {?>
							<p class="text-right"><a href="#addenmodal" role="button" class="btn btn-large btn-primary" data-toggle="modal">New Enrollment</a></p><?php }?>
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
                   <label class="control-label col-md-4">Timezone</label>
                   <div class="col-md-5">
                    <select class="form-control" name="timezone">
                        <?php
$api_call="http://www.selfpacedtech.com/services/api/timezones?transform=1&filter[]=timezone_status,eq,active";
$curl = curl_init();
          curl_setopt_array($curl, 
            array(
            CURLOPT_RETURNTRANSFER => 1,
            
            CURLOPT_URL => $api_call,
            CURLOPT_USERAGENT => 'Get timezones from api'
            ));
          $resp = curl_exec($curl);
          curl_close($curl);
            $response= json_decode($resp);
          $timezones = $response->timezones;
          foreach ($timezones as $timezone) 
          {
?>
                      <option value="<?php echo $timezone->timezone?>"><?php echo $timezone->timezone?></option>
                    <?php } ?>
                    </select>
                   </div>
                 </div>
               
            							<div class="form-group">
            								<label class="control-label col-md-4">Phone</label>
            								<div class="col-md-4">
            									<input type="text" name="phone" class="form-control" required="">
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
                <th>Email</th>
                <th>Mobile</th>
              <th>Date</th> 
               <th>Edit/Delete</th>
            </tr>
        </thead>
        <tfoot>
          <tr>
                <th>Course</th>
                <th>Contact Name</th>
                <th>Email</th>
                <th>Mobile</th>
               <th>Date</th>
                <th>Edit/Delete</th>
            </tr>
        </tfoot>
        <tbody>
        <?php
        $sql_getdata="SELECT * FROM enroll_requests";
        $res_getdata=$mysqli->query($sql_getdata);
        while ($row_getdata=$res_getdata->fetch_assoc()) {
        	# code...
        	?>
        	<tr>
                <td><?php if($row_getdata['en_status']=='New'){?><span class="label label-success">New</span> <?php } echo $row_getdata['en_course']?> </td>
                <td><?php echo $row_getdata['en_name']?></td>
                <td><?php echo $row_getdata['en_email']?></td>
                <td><?php echo $row_getdata['en_phone']?></td>
                <td><?php echo $row_getdata['en_createdon']?></td>
               <td><?php if($uenreq_update==1) {?><a href="#edit<?php echo $row_getdata['en_id']?>" data-toggle="modal"><i class="fa fa-pencil-square-o"></i></a><?php } if($uenreq_delete==1) {?>
                <a href="#delete<?php echo $row_getdata['en_id']?>" data-toggle="modal"><i class="fa fa-trash"></i></a><?php }?>
                <div id="delete<?php echo $row_getdata['en_id']?>" class="modal fade">
							<div class="modal-dialog">
							    <div class="modal-content">
							        <div class="modal-header">
						                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						                <h4 class="modal-title">Delete Request</h4>
						            </div>						            
							<form class="form-horizontal" method="post" action="#">            				
								Delete Request for <b><?php echo $row_getdata['en_course']?></b>
            						<p class="text-primary">Are you sure you want to delete this request?</p>
					            	<input type="hidden" name="enid" value="<?php echo $row_getdata['en_id']?>">
						            <div class="modal-footer">
						                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						                <button type="submit" id="deletebtn" name="deleteenrollment" class="btn btn-primary">Delete Request</button>
						            </div>
            				</form>
				        </div>
				    </div>
				</div>

                  <div id="edit<?php echo $row_getdata['en_id']?>" class="modal fade">
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
            									<option selected="" value="<?php echo $row_getdata['en_course']?>">
            										<?php echo $row_getdata['en_course']?>
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
            									<input type="text" name="name" class="form-control" required="" value="<?php echo $row_getdata['en_name']?>">
            								</div>
            							</div>
            							<div class="form-group">
            								<label class="control-label col-md-4">Email</label>
            								<div class="col-md-4">
            									<input type="email" name="email" class="form-control" required="" value="<?php echo $row_getdata['en_email']?>">
            								</div>
            							</div>
                                         <div class="form-group">
                   <label class="control-label col-md-4">Timezone</label>
                   <div class="col-md-5">
                    <select class="form-control" name="timezone">
                        <option selected="" value="<?php echo $row_getdata['en_timezone']?>"><?php echo $row_getdata['en_timezone']?></option>
                       <?php
$api_call="http://www.selfpacedtech.com/services/api/timezones?transform=1&filter[]=timezone_status,eq,active";
$curl = curl_init();
          curl_setopt_array($curl, 
            array(
            CURLOPT_RETURNTRANSFER => 1,
            
            CURLOPT_URL => $api_call,
            CURLOPT_USERAGENT => 'Get timezones from api'
            ));
          $resp = curl_exec($curl);
          curl_close($curl);
            $response= json_decode($resp);
          $timezones = $response->timezones;
          foreach ($timezones as $timezone) 
          {
?>
                      <option value="<?php echo $timezone->timezone?>"><?php echo $timezone->timezone?></option>
                    <?php } ?>
                    </select>
                   </div>
                 </div>
                
            							<div class="form-group">
            								<label class="control-label col-md-4">Phone</label>
            								<div class="col-md-4">
            									<input type="text" name="phone" class="form-control" required="" value="<?php echo $row_getdata['en_phone']?>">
            								</div>
            							</div>
            							<div class="form-group">
            								<label class="control-label col-md-4">Status</label>
            								<div class="col-md-4">
            									<select class="form-control" name="status">
            										<option selected="" value="<?php echo $row_getdata['en_status']?>"><?php echo $row_getdata['en_status']?></option>
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
            									<textarea name="notes" class="form-control"><?php echo $row_getdata['en_notes']?></textarea>
            								</div>
            							</div>
					            	<input type="hidden" name="enid" value="<?php echo $row_getdata['en_id']?>">
						            <div class="modal-footer">
						                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						                <button type="submit" id="editbtn" name="editenrollment" class="btn btn-primary">Edit Request</button>
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
    <p>
        <form class="form-horizontal" method="post" action="exportenrollments.php">
            <h3>Export Report to Excel</h3>
            <div class="form-group">
                <label class="control-label col-md-4">Start Date</label>
                <div class="col-md-5">
                    <input type="text" name="start" class="form-control datepicker" required="">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">End Date</label>
                <div class="col-md-5">
                    <input type="text" name="end" class="form-control datepicker" required="">
                </div>
            </div>
            <button class="btn btn-success" type="submit">Export</button>
        </form>
    </p>
  
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
		  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( ".datepicker" ).datepicker({ 
         dateFormat: 'yy-mm-dd'
         });
  } );
  </script>
		<!-- page specific plugin scripts -->
		<?php include('templates/JSpsDashboard.php');?>
		<!-- inline scripts related to this page -->
		<?php include('templates/JSisDashboard.php');?>			<?php include('templates/footer.php');?>

	</body>
</html>