<?php include('templates/header.php');
$page="faqs";
if (isset($_POST['addfaq'])) {
	$newfaqquestion=mysqli_real_escape_string($mysqli,$_POST['faqquestion']);
	$newfaqanswer=mysqli_real_escape_string($mysqli,$_POST['faqanswer']);
	$sql_adddata="INSERT INTO faqs (faq_question,faq_answer) VALUES ('$newfaqquestion','$newfaqanswer')";
	
	$res_adddata=$mysqli->query($sql_adddata);
	if(!$res_adddata){
		die($mysqli->error);
	}
	$_SESSION['message']="FAQ Inserted Successfully";
	header('Location:faqs.php');
}
if (isset($_POST['editfaq'])) {
	$newfaqquestion=mysqli_real_escape_string($mysqli,$_POST['faqquestion']);
	$newfaqanswer=mysqli_real_escape_string($mysqli,$_POST['faqanswer']);
	$status=mysqli_real_escape_string($mysqli,$_POST['status']);
	$faqid=$_POST['faqid'];
	$sql_updatedata="UPDATE faqs SET faq_question='$newfaqquestion', faq_answer='$newfaqanswer', faq_status='$status', faq_modifiedon=now() WHERE faq_id=$faqid";
	$res_updatedata=$mysqli->query($sql_updatedata);
	if(!$res_updatedata){
		die($mysqli->error);
	}
	$_SESSION['message']=$alert="FAQ Updated Successfully";
	header('Location:faqs.php');

}
if (isset($_POST['deletefaq'])) {
	# code...
	$faqid=$_POST['faqid'];
	$sql_deletedata="DELETE FROM faqs WHERE faq_id=$faqid";
	$res_deletedata=$mysqli->query($sql_deletedata);
	if (!$res_deletedata) {
		$_SESSION['message']=$alert="FAQ Deleted Successfully";
	header('Location:faqs.php');
	}
}
?>

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
							<li class="active">FAQs</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h1>
FAQs
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									overview &amp; stats
								</small>                                
                                <?php 
                                if(isset($_SESSION['message']))
                                echo "<div style='color:red'>".$_SESSION['message']."</div>";
                                unset($_SESSION['message']);
                            ?>
							</h1><?php if($ufaq_create==1) {?>
							<p class="text-right"><a href="#addfaqModal" role="button" class="btn btn-large btn-primary" data-toggle="modal">New FAQ</a></p>
							<?php }?>
						</div><!-- /.page-header -->
							<div id="addfaqModal" class="modal fade">
							<div class="modal-dialog">
							    <div class="modal-content">
							        <div class="modal-header">
						                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						                <h4 class="modal-title">Add FAQ</h4>
						            </div>						            
							<form class="form-horizontal" method="post" action="#">            				
            						<div class="modal-body">
  							  			<div class="form-group">
            								<label class="control-label col-md-4">Question</label>
            								<div class="col-md-8">
            									<input type="text" name="faqquestion" class="form-control">
            								</div>
            							</div>
            							<div class="form-group">
            								<label class="control-label col-md-4">Answer</label>
            								<div class="col-md-8">
            									<textarea name="faqanswer" class="form-control"></textarea>
            								</div>
            							</div>
					            	</div>
						            <div class="modal-footer">
						                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						                <button type="submit" name="addfaq" class="btn btn-primary">Add FAQ</button>
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
                <th>Category</th>
                <th>Reference</th>
                <th>Status</th>
                <th>Created On</th>
                <th>Modified On</th>
               <th>Edit/Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql_getdata="SELECT * FROM faqs";
        $res_getdata=$mysqli->query($sql_getdata);
        while ($row_getdata=$res_getdata->fetch_assoc()) {
        	# code...
        	?>
        	<tr>
                <td><?php echo $row_getdata['faq_question']?> </a></td>
                <td><?php echo $row_getdata['faq_answer']?></td>
                <td><?php echo $row_getdata['faq_status']?></td>
                <td><?php echo $row_getdata['faq_createdon']?></td>
                <td><?php echo $row_getdata['faq_modifiedon']?></td>
                <td><?php if($ufaq_update==1) {?><a href="#edit<?php echo $row_getdata['faq_id']?>" data-toggle="modal"><i class="fa fa-pencil-square-o"></i></a><?php } if($ufaq_delete==1) {?>
                <a href="#delete<?php echo $row_getdata['faq_id']?>" data-toggle="modal"><i class="fa fa-trash"></i></a><?php }?>
                <div id="delete<?php echo $row_getdata['faq_id']?>" class="modal fade">
							<div class="modal-dialog">
							    <div class="modal-content">
							        <div class="modal-header">
						                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						                <h4 class="modal-title">Delete FAQ</h4>
						            </div>						            
							<form class="form-horizontal" method="post" action="#">            				
								Delete FAQ <b><?php echo $row_getdata['faq_question']?></b>
            						<p class="text-primary">Are you sure you want to delete this FAQ?</p>
					            	<input type="hidden" name="faqid" value="<?php echo $row_getdata['faq_id']?>">
						            <div class="modal-footer">
						                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						                <button type="submit" id="deletebtn" name="deletefaq" class="btn btn-primary">Delete FAQ</button>
						            </div>
            				</form>
				        </div>
				    </div>
				</div>

                  <div id="edit<?php echo $row_getdata['faq_id']?>" class="modal fade">
							<div class="modal-dialog">
							    <div class="modal-content">
							        <div class="modal-header">
						                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						                <h4 class="modal-title">Edit FAQ</h4>
						            </div>						            
							<form class="form-horizontal" method="post" action="#">            				
            						<div class="modal-body">
  							  			<div class="form-group">
            								<label class="control-label col-md-4">Question</label>
            								<div class="col-md-8">
            									<input type="text" name="faqquestion" class="form-control" value="<?php echo $row_getdata['faq_question']?>">
            								</div>
            							</div>
            							<div class="form-group">
            								<label class="control-label col-md-4">Answer</label>
            								<div class="col-md-8">
            									<textarea name="faqanswer" class="form-control"><?php echo $row_getdata['faq_answer']?></textarea>
            								</div>
            							</div>
            							<div class="form-group">
            								<label class="control-label col-md-4">Status</label>
            								<div class="col-md-4">
            									<select class="form-control" name="status">
            										<option selected="" value="<?php echo $row_getdata['faq_status']?>"><?php echo $row_getdata['faq_status']?></option>
            										<option value="Active">Active</option>
            										<option value="Inactive">Inactive</option>
            									</select>
            								</div>
            							</div>
					            	</div>
					            	<input type="hidden" name="faqid" value="<?php echo $row_getdata['faq_id']?>">
						            <div class="modal-footer">
						                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						                <button type="submit" id="editbtn" name="editfaq" class="btn btn-primary">Edit FAQ</button>
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