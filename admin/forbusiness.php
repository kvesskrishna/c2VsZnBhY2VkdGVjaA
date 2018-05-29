<?php include('templates/header.php');
$page="forbusiness";

if (isset($_POST['addforbusiness'])) {
	$newname=mysqli_real_escape_string($mysqli,$_POST['name']);
	$newemail=mysqli_real_escape_string($mysqli,$_POST['email']);
	$newphone=mysqli_real_escape_string($mysqli,$_POST['phone']);
	$newstatus=mysqli_real_escape_string($mysqli,$_POST['status']);
	$newnotes=mysqli_real_escape_string($mysqli,$_POST['message']."---Added by: ".$_SESSION['user']);

	$sql_updatedata="INSERT INTO business_requests (contact_name,contact_email,contact_phone,status,message) VALUES ('$newname','$newemail','$newphone','$newstatus','$newnotes')";
	$res_updatedata=$mysqli->query($sql_updatedata);
	if(!$res_updatedata){
		die($mysqli->error);
	}
	$_SESSION['message']=$alert="Request added Successfully";
	header('Location:forbusiness.php');
}
if (isset($_POST['editforbusiness'])) {
	$newname=mysqli_real_escape_string($mysqli,$_POST['name']);
	$newemail=mysqli_real_escape_string($mysqli,$_POST['email']);
	$newphone=mysqli_real_escape_string($mysqli,$_POST['phone']);
	$newstatus=mysqli_real_escape_string($mysqli,$_POST['status']);
	$newnotes=mysqli_real_escape_string($mysqli,$_POST['message']."---Edit by: ".$_SESSION['user']);

	$enid=$_POST['enid'];
	$sql_updatedata="UPDATE business_requests SET contact_name='$newname',contact_email='$newemail',contact_phone='$newphone',status='$newstatus',message='$newnotes', modified_on=now() WHERE id=$enid";
	$res_updatedata=$mysqli->query($sql_updatedata);
	if(!$res_updatedata){
		die($mysqli->error);
	}
	$_SESSION['message']=$alert="Request Updated Successfully";
	header('Location:forbusiness.php');

}
if (isset($_POST['deleteforbusiness'])) {
	# code...
	$enid=$_POST['enid'];
	$sql_deletedata="DELETE FROM business_requests WHERE id=$enid";
	$res_deletedata=$mysqli->query($sql_deletedata);
	if (!$res_deletedata) {
		$_SESSION['message']=$alert="Request Deleted Successfully";
	header('Location:forbusiness.php');
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
							<li class="active">Business Requests</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h1>
								Business Requests
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
                            <?php if($ubusreq_create==1) {?>
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
            								<label class="control-label col-md-4">Message</label>
            								<div class="col-md-4">
            									<textarea name="message" class="form-control"></textarea>
            								</div>
            							</div>
						            <div class="modal-footer">
						                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						                <button type="submit" id="addbtn" name="addforbusiness" class="btn btn-primary">Add Request</button>
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
                <th>Contact Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Status</th>
                 <th>Date</th>
               <th>Edit/Delete</th>
            </tr>
        </thead>
        <tfoot>
          <tr>
               <th>Contact Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Status</th>
                <th>Date</th>
               <th>Edit/Delete</th>
            </tr>
        </tfoot>
        <tbody>
        <?php
        $sql_getdata="SELECT * FROM business_requests";
        $res_getdata=$mysqli->query($sql_getdata);
        while ($row_getdata=$res_getdata->fetch_assoc()) {
        	# code...
        	?>
        	<tr>
                <td><?php if($row_getdata['status']=='New'){?><span class="label label-success">New</span> <?php } echo $row_getdata['contact_name']?> </td>
                <td><?php echo $row_getdata['contact_phone']?></td>
                <td><?php echo $row_getdata['contact_email']?></td>
                <td><?php echo $row_getdata['status']?></td>
                <td><?php echo $row_getdata['created_on']?></td>

               <td><?php if($ubusreq_update==1) {?><a href="#edit<?php echo $row_getdata['id']?>" data-toggle="modal"><i class="fa fa-pencil-square-o"></i></a><?php } if($ubusreq_delete==1) {?>
                <a href="#delete<?php echo $row_getdata['id']?>" data-toggle="modal"><i class="fa fa-trash"></i></a><?php }?>
                <div id="delete<?php echo $row_getdata['id']?>" class="modal fade">
							<div class="modal-dialog">
							    <div class="modal-content">
							        <div class="modal-header">
						                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						                <h4 class="modal-title">Delete Request</h4>
						            </div>						            
							<form class="form-horizontal" method="post" action="#">            				
								Delete Request by <b><?php echo $row_getdata['contact_name']?></b>
            						<p class="text-primary">Are you sure you want to delete this request?</p>
					            	<input type="hidden" name="enid" value="<?php echo $row_getdata['id']?>">
						            <div class="modal-footer">
						                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						                <button type="submit" id="deletebtn" name="deleteforbusiness" class="btn btn-primary">Delete Request</button>
						            </div>
            				</form>
				        </div>
				    </div>
				</div>

                  <div id="edit<?php echo $row_getdata['id']?>" class="modal fade">
							<div class="modal-dialog">
							    <div class="modal-content">
							        <div class="modal-header">
						                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						                <h4 class="modal-title">Edit Request</h4>
						            </div>						            
							<form class="form-horizontal" method="post" action="#">            				
            						<div class="modal-body">
  							  			<div class="form-group">

            							<div class="form-group">
            								<label class="control-label col-md-4">Contact Name</label>
            								<div class="col-md-4">
            									<input type="text" name="name" class="form-control" required="" value="<?php echo $row_getdata['contact_name']?>">
            								</div>
            							</div>
            							<div class="form-group">
            								<label class="control-label col-md-4">Email</label>
            								<div class="col-md-4">
            									<input type="email" name="email" class="form-control" required="" value="<?php echo $row_getdata['contact_email']?>">
            								</div>
            							</div>
            							<div class="form-group">
            								<label class="control-label col-md-4">Phone</label>
            								<div class="col-md-4">
            									<input type="text" name="phone" class="form-control" required="" value="<?php echo $row_getdata['contact_phone']?>">
            								</div>
            							</div>
            							<div class="form-group">
            								<label class="control-label col-md-4">Status</label>
            								<div class="col-md-4">
            									<select class="form-control" name="status">
            										<option selected="" value="<?php echo $row_getdata['status']?>"><?php echo $row_getdata['status']?></option>
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
            								<label class="control-label col-md-4">Message</label>
            								<div class="col-md-4">
            									<textarea name="message" class="form-control"><?php echo $row_getdata['message']?></textarea>
            								</div>
            							</div>
					            	<input type="hidden" name="enid" value="<?php echo $row_getdata['id']?>">
						            <div class="modal-footer">
						                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						                <button type="submit" id="editbtn" name="editforbusiness" class="btn btn-primary">Edit Request</button>
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