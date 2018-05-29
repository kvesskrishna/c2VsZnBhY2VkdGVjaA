<?php include('templates/header.php');
$page="courses";

if (isset($_POST['addcategory'])) {
	$newcategory=mysqli_real_escape_string($mysqli,$_POST['catname']);
	$newcatref=mysqli_real_escape_string($mysqli,$_POST['catref']);
	$sql_adddata="INSERT INTO course_categories (category_name,category_reference) VALUES ('$newcategory','$newcatref')";
	
	$res_adddata=$mysqli->query($sql_adddata);
	if(!$res_adddata){
		die($mysqli->error);
	}
	$_SESSION['message']="Category Inserted Successfully";
	header('Location:coursecategories.php');
}
if (isset($_POST['editcategory'])) {
	$newcategory=mysqli_real_escape_string($mysqli,$_POST['catname']);
	$newcatref=mysqli_real_escape_string($mysqli,$_POST['catref']);
	$status=mysqli_real_escape_string($mysqli,$_POST['status']);
	$catid=$_POST['catid'];
	$sql_updatedata="UPDATE course_categories SET category_name='$newcategory', category_reference='$newcatref', category_status='$status', category_modifiedon=now() WHERE category_id=$catid";
	$res_updatedata=$mysqli->query($sql_updatedata);
	if(!$res_updatedata){
		die($mysqli->error);
	}
	$_SESSION['message']=$alert="Category Updated Successfully";
	header('Location:coursecategories.php');

}
if (isset($_POST['deletecategory'])) {
	# code...
	$catid=$_POST['catid'];
	$sql_deletedata="DELETE FROM course_categories WHERE category_id=$catid";
	$res_deletedata=$mysqli->query($sql_deletedata);
	if (!$res_deletedata) {
		$_SESSION['message']=$alert="Category Deleted Successfully";
	header('Location:coursecategories.php');
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
							<li class="active">Course Categories</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h1>
								Course Categories
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
							<?php if($ucat_create==1) {?>
							<p class="text-right"><a href="#addcatModal" role="button" class="btn btn-large btn-primary" data-toggle="modal">New Category</a></p>
							<?php }?>
						</div><!-- /.page-header -->
						<div id="addcatModal" class="modal fade">
							<div class="modal-dialog">
							    <div class="modal-content">
							        <div class="modal-header">
						                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						                <h4 class="modal-title">Add Category</h4>
						            </div>						            
							<form class="form-horizontal" method="post" action="#">            				
            						<div class="modal-body">
  							  			<div class="form-group">
            								<label class="control-label col-md-4">Category Name</label>
            								<div class="col-md-4">
            									<input type="text" name="catname" class="form-control" required="">
            								</div>
            							</div>
            							<div class="form-group">
            								<label class="control-label col-md-4">Category Reference</label>
            								<div class="col-md-4">
            									<input type="text" name="catref" class="form-control" required="">
            								</div>
            							</div>
					            	</div>
						            <div class="modal-footer">
						                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						                <button type="submit" name="addcategory" class="btn btn-primary">Add category</button>
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
        $sql_getdata="SELECT * FROM course_categories";
        $res_getdata=$mysqli->query($sql_getdata);
        while ($row_getdata=$res_getdata->fetch_assoc()) {
        	# code...
        	$sql_coursecount="SELECT course_id FROM courses WHERE category_id=".$row_getdata['category_id'];
        	$res_coursecount=$mysqli->query($sql_coursecount);
        	if (!$res_coursecount) {
        		die($mysqli->error);
        	}
        	$coursecount=$res_coursecount->num_rows;
        	?>
        	<tr>
                <td><a href="viewcategory.php?id=<?php echo $row_getdata['category_id']?>"><span class="label label-success"> <?php echo $coursecount;?> Courses</span> <?php echo $row_getdata['category_name']?> </a></td>
                <td><?php echo $row_getdata['category_reference']?></td>
                <td><?php echo $row_getdata['category_status']?></td>
                <td><?php echo $row_getdata['category_createdon']?></td>
                <td><?php echo $row_getdata['category_modifiedon']?></td>
                <td><?php if($ucat_update==1) {?><a href="#edit<?php echo $row_getdata['category_id']?>" data-toggle="modal"><i class="fa fa-pencil-square-o"></i></a>
                <?php } if($ucat_delete==1) {?>
                <a href="#delete<?php echo $row_getdata['category_id']?>" data-toggle="modal"><i class="fa fa-trash"></i></a>
                <?php }?>
                <div id="delete<?php echo $row_getdata['category_id']?>" class="modal fade">
							<div class="modal-dialog">
							    <div class="modal-content">
							        <div class="modal-header">
						                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						                <h4 class="modal-title">Delete Category</h4>
						            </div>						            
							<form class="form-horizontal" method="post" action="#">            				
								Delete Category <b><?php echo $row_getdata['category_name']?></b>
            						<p class="text-primary">Are you sure you want to delete this category?</p>
					            	<input type="hidden" name="catid" value="<?php echo $row_getdata['category_id']?>">
						            <div class="modal-footer">
						                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						                <button type="submit" id="deletebtn" name="deletecategory" class="btn btn-primary">Delete category</button>
						            </div>
            				</form>
				        </div>
				    </div>
				</div>

                  <div id="edit<?php echo $row_getdata['category_id']?>" class="modal fade">
							<div class="modal-dialog">
							    <div class="modal-content">
							        <div class="modal-header">
						                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						                <h4 class="modal-title">Edit Category</h4>
						            </div>						            
							<form class="form-horizontal" method="post" action="#">            				
            						<div class="modal-body">
  							  			<div class="form-group">
            								<label class="control-label col-md-4">Category Name</label>
            								<div class="col-md-4">
            									<input type="text" name="catname" class="form-control" required="" value="<?php echo $row_getdata['category_name']?>">
            								</div>
            							</div>
            							<div class="form-group">
            								<label class="control-label col-md-4">Category Reference</label>
            								<div class="col-md-4">
            									<input type="text" name="catref" class="form-control" required="" value="<?php echo $row_getdata['category_reference']?>">
            								</div>
            							</div>
            							<div class="form-group">
            								<label class="control-label col-md-4">Status</label>
            								<div class="col-md-4">
            									<select class="form-control" name="status">
            										<option selected="" value="<?php echo $row_getdata['category_status']?>"><?php echo $row_getdata['category_status']?></option>
            										<option value="Active">Active</option>
            										<option value="Inactive">Inactive</option>
            									</select>
            								</div>
            							</div>
					            	</div>
					            	<input type="hidden" name="catid" value="<?php echo $row_getdata['category_id']?>">
						            <div class="modal-footer">
						                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						                <button type="submit" id="editbtn" name="editcategory" class="btn btn-primary">Edit category</button>
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
		
		<!-- page specific plugin scripts -->
		<?php include('templates/JSpsDashboard.php');?>
		<!-- inline scripts related to this page -->
		<?php include('templates/JSisDashboard.php');?>			<?php include('templates/footer.php');?>

	</body>
</html>