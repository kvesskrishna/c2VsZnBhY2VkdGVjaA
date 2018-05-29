<?php include('templates/header.php');
$page="usermanagement";

if (isset($_POST['adduser'])) {
	$newusername=mysqli_real_escape_string($mysqli,$_POST['username']);
	$newemail=mysqli_real_escape_string($mysqli,$_POST['email']);
	$newphone=mysqli_real_escape_string($mysqli,$_POST['phone']);
	$newpassword=mysqli_real_escape_string($mysqli,$_POST['password']);
    $newfullname=mysqli_real_escape_string($mysqli,$_POST['fullname']);

	$sql_updatedata="INSERT INTO spt_admins (username,email,mobile,fullname,password) VALUES ('$newusername','$newemail','$newphone','$newfullname','$newpassword')";
	$res_updatedata=$mysqli->query($sql_updatedata);
	if(!$res_updatedata){
		die($mysqli->error);
	}
    $last_id = $mysqli->insert_id;
$sql_adduac="INSERT INTO admins_uac (adminid) VALUES ($last_id)";
$res_adduac=$mysqli->query($sql_adduac);
if(!$res_adduac) die($mysqli->error);
	$_SESSION['message']=$alert="User added Successfully";
	header('Location:usermanagement.php');
}
if (isset($_POST['edituser'])) {
   $newusername=mysqli_real_escape_string($mysqli,$_POST['username']);
    $newemail=mysqli_real_escape_string($mysqli,$_POST['email']);
    $newphone=mysqli_real_escape_string($mysqli,$_POST['phone']);
    $newpassword=mysqli_real_escape_string($mysqli,$_POST['password']);
    $newfullname=mysqli_real_escape_string($mysqli,$_POST['fullname']);

if(isset($_POST['cat_create'])) {$cat_create=1;} else {$cat_create=0;}
if(isset($_POST['cat_read'])) {$cat_read=1;} else {$cat_read=0;}
if(isset($_POST['cat_update'])) {$cat_update=1;} else {$cat_update=0;}
if(isset($_POST['cat_delete'])) {$cat_delete=1;} else {$cat_delete=0;}


if(isset($_POST['course_create'])) {$course_create=1;} else {$course_create=0;}
if(isset($_POST['course_read'])) {$course_read=1;} else {$course_read=0;}
if(isset($_POST['course_update'])) {$course_update=1;} else {$course_update=0;}
if(isset($_POST['course_delete'])) {$course_delete=1;} else {$course_delete=0;}


if(isset($_POST['test_create'])) {$test_create=1;} else {$test_create=0;}
if(isset($_POST['test_read'])) {$test_read=1;} else {$test_read=0;}
if(isset($_POST['test_update'])) {$test_update=1;} else {$test_update=0;}
if(isset($_POST['test_delete'])) {$test_delete=1;} else {$test_delete=0;}



if(isset($_POST['faq_create'])) {$faq_create=1;} else {$faq_create=0;}
if(isset($_POST['faq_read'])) {$faq_read=1;} else {$faq_read=0;}
if(isset($_POST['faq_update'])) {$faq_update=1;} else {$faq_update=0;}
if(isset($_POST['faq_delete'])) {$faq_delete=1;} else {$faq_delete=0;}


if(isset($_POST['enreq_create'])) {$enreq_create=1;} else {$enreq_create=0;}
if(isset($_POST['enreq_read'])) {$enreq_read=1;} else {$enreq_read=0;}
if(isset($_POST['enreq_update'])) {$enreq_update=1;} else {$enreq_update=0;}
if(isset($_POST['enreq_delete'])) {$enreq_delete=1;} else {$enreq_delete=0;}


if(isset($_POST['schreq_create'])) {$schreq_create=1;} else {$schreq_create=0;}
if(isset($_POST['schreq_read'])) {$schreq_read=1;} else {$schreq_read=0;}
if(isset($_POST['schreq_update'])) {$schreq_update=1;} else {$schreq_update=0;}
if(isset($_POST['schreq_delete'])) {$schreq_delete=1;} else {$schreq_delete=0;}


if(isset($_POST['busreq_create'])) {$busreq_create=1;} else {$busreq_create=0;}
if(isset($_POST['busreq_read'])) {$busreq_read=1;} else {$busreq_read=0;}
if(isset($_POST['busreq_update'])) {$busreq_update=1;} else {$busreq_update=0;}
if(isset($_POST['busreq_delete'])) {$busreq_delete=1;} else {$busreq_delete=0;}


if(isset($_POST['insreq_create'])) {$insreq_create=1;} else {$insreq_create=0;}
if(isset($_POST['insreq_read'])) {$insreq_read=1;} else {$insreq_read=0;}
if(isset($_POST['insreq_update'])) {$insreq_update=1;} else {$insreq_update=0;}
if(isset($_POST['insreq_delete'])) {$insreq_delete=1;} else {$insreq_delete=0;}

if(isset($_POST['dtraining_create'])) {$dtraining_create=1;} else {$dtraining_create=0;}
if(isset($_POST['dtraining_read'])) {$dtraining_read=1;} else {$dtraining_read=0;}
if(isset($_POST['dtraining_update'])) {$dtraining_update=1;} else {$dtraining_update=0;}
if(isset($_POST['dtraining_delete'])) {$dtraining_delete=1;} else {$dtraining_delete=0;}

if(isset($_POST['ntraining_create'])) {$ntraining_create=1;} else {$ntraining_create=0;}
if(isset($_POST['ntraining_read'])) {$ntraining_read=1;} else {$ntraining_read=0;}
if(isset($_POST['ntraining_update'])) {$ntraining_update=1;} else {$ntraining_update=0;}
if(isset($_POST['ntraining_delete'])) {$ntraining_delete=1;} else {$ntraining_delete=0;}

if(isset($_POST['dsupport_create'])) {$dsupport_create=1;} else {$dsupport_create=0;}
if(isset($_POST['dsupport_read'])) {$dsupport_read=1;} else {$dsupport_read=0;}
if(isset($_POST['dsupport_update'])) {$dsupport_update=1;} else {$dsupport_update=0;}
if(isset($_POST['dsupport_delete'])) {$dsupport_delete=1;} else {$dsupport_delete=0;}

if(isset($_POST['nsupport_create'])) {$nsupport_create=1;} else {$nsupport_create=0;}
if(isset($_POST['nsupport_read'])) {$nsupport_read=1;} else {$nsupport_read=0;}
if(isset($_POST['nsupport_update'])) {$nsupport_update=1;} else {$nsupport_update=0;}
if(isset($_POST['nsupport_delete'])) {$nsupport_delete=1;} else {$nsupport_delete=0;}

if(isset($_POST['adminmanagement'])) {$adminmanagement=1;} else {$adminmanagement=0;}

	$id=$_POST['id'];
	$sql_updatedata="UPDATE spt_admins SET username='$newusername',email='$newemail',mobile='$newphone',fullname='$newfullname',password='$newpassword', modified_on=now() WHERE id=$id";
	$res_updatedata=$mysqli->query($sql_updatedata);
	if(!$res_updatedata){
		die($mysqli->error);
	}
    $sql_updateuac="UPDATE admins_uac SET cat_create=$cat_create,cat_read=$cat_read,cat_update=$cat_update,cat_delete=$cat_delete,course_create=$course_create,course_read=$course_read,course_update=$course_update,course_delete=$course_delete,test_create=$test_create,test_read=$test_read,test_update=$test_update,test_delete=$test_delete,faq_create=$faq_create,faq_read=$faq_read,faq_update=$faq_update,faq_delete=$faq_delete,enreq_create=$enreq_create,enreq_read=$enreq_read,enreq_update=$enreq_update,enreq_delete=$enreq_delete,busreq_create=$busreq_create,busreq_read=$busreq_read,busreq_update=$busreq_update,busreq_delete=$busreq_delete,schreq_create=$schreq_create,schreq_read=$schreq_read,schreq_update=$schreq_update,schreq_delete=$schreq_delete,insreq_create=$insreq_create,insreq_read=$insreq_read,insreq_update=$insreq_update,insreq_delete=$insreq_delete,dtraining_create=$dtraining_create,dtraining_read=$dtraining_read,dtraining_update=$dtraining_update,dtraining_delete=$dtraining_delete,ntraining_create=$ntraining_create,ntraining_read=$ntraining_read,ntraining_update=$ntraining_update,ntraining_delete=$ntraining_delete,dsupport_create=$dsupport_create,dsupport_read=$dsupport_read,dsupport_update=$dsupport_update,dsupport_delete=$dsupport_delete,nsupport_create=$nsupport_create,nsupport_read=$nsupport_read,nsupport_update=$nsupport_update,nsupport_delete=$nsupport_delete,adminmanagement=$adminmanagement, modified_on=now() WHERE adminid=$id";
$res_updateuac=$mysqli->query($sql_updateuac);
if(!$res_updateuac) die($mysqli->error);
	$_SESSION['message']=$alert="User Updated Successfully";
	header('Location:usermanagement.php');

}
if (isset($_POST['deleteuser'])) {
	# code...
	$id=$_POST['id'];
	$sql_deletedata="DELETE FROM spt_admins WHERE id=$id";
	$res_deletedata=$mysqli->query($sql_deletedata);
	if (!$res_deletedata) {
		$_SESSION['message']=$alert="User Deleted Successfully";
	header('Location:usermanagement.php');
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
							<li class="active">Administrators</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h1>
								Administrators
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
							<p class="text-right"><a href="#addenmodal" role="button" class="btn btn-large btn-primary" data-toggle="modal">New Admin</a></p>
						</div><!-- /.page-header -->
						 <div id="addenmodal" class="modal fade">
							<div class="modal-dialog">
							    <div class="modal-content">
							        <div class="modal-header">
						                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						                <h4 class="modal-title">Add Admin</h4>
						            </div>						            
							<form class="form-horizontal" method="post" action="#">            				
            						<div class="modal-body">
  							  			
            							<div class="form-group">
            								<label class="control-label col-md-4">User Name</label>
            								<div class="col-md-4">
            									<input type="text" name="username" class="form-control" required="">
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
                                            <label class="control-label col-md-4">Fullname</label>
                                            <div class="col-md-4">
                                                <input type="text" name="fullname" class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Password</label>
                                            <div class="col-md-4">
                                                <input type="password" name="password" class="form-control" required="">
                                            </div>
                                        </div>
					            	</div>
					            
						            <div class="modal-footer">
						                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						                <button type="submit" id="addbtn" name="adduser" class="btn btn-primary">Add Admin</button>
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
                <th>Username</th>
                <th>Fullname</th>
                <th>Mobile</th>
                <th>Email</th>
               <th>Edit/Delete</th>
            </tr>
        </thead>
        <tfoot>
          <tr>
               <th>Username</th>
                <th>Fullname</th>
                <th>Mobile</th>
                <th>Email</th>
               <th>Edit/Delete</th>
            </tr>
        </tfoot>
        <tbody>
        <?php
        $sql_getdata="SELECT * FROM spt_admins WHERE id>1";
        $res_getdata=$mysqli->query($sql_getdata);
        while ($row_getdata=$res_getdata->fetch_assoc()) {
        	# code...
        	?>
        	<tr>
                <td><?php echo $row_getdata['username']?> </td>
                <td><?php echo $row_getdata['fullname']?></td>
                <td><?php echo $row_getdata['mobile']?></td>
                <td><?php echo $row_getdata['email']?></td>
                <td><?php if($uadminmanagement==1&&$row_getdata['id']!=$_SESSION['userid']) {?><a href="#edit<?php echo $row_getdata['id']?>" data-toggle="modal"><i class="fa fa-pencil-square-o"></i></a><?php } if($ucat_create==1&&$row_getdata['id']!=$_SESSION['userid']) {?>
                <a href="#delete<?php echo $row_getdata['id']?>" data-toggle="modal"><i class="fa fa-trash"></i></a><?php }?>
                <div id="delete<?php echo $row_getdata['id']?>" class="modal fade">
							<div class="modal-dialog">
							    <div class="modal-content">
							        <div class="modal-header">
						                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						                <h4 class="modal-title">Delete Admin</h4>
						            </div>						            
							<form class="form-horizontal" method="post" action="#">            				
								Delete Admin<b><?php echo $row_getdata['fullname']?></b>
            						<p class="text-primary">Are you sure you want to delete this admin?</p>
					            	<input type="hidden" name="id" value="<?php echo $row_getdata['id']?>">
						            <div class="modal-footer">
						                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						                <button type="submit" id="deletebtn" name="deleteuser" class="btn btn-primary">Delete Admin</button>
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
						                <h4 class="modal-title">Edit Admin</h4>
						            </div>						            
							<form class="form-horizontal" method="post" action="#">            				
            						<div class="modal-body">
  							  			<div class="form-group">
                                            <label class="control-label col-md-4">User Name</label>
                                            <div class="col-md-4">
                                                <input type="text" name="username" class="form-control" required="" value="<?php echo $row_getdata['username']?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Email</label>
                                            <div class="col-md-4">
                                                <input type="email" name="email" class="form-control" required="" value="<?php echo $row_getdata['email']?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Phone</label>
                                            <div class="col-md-4">
                                                <input type="text" name="phone" class="form-control" required="" value="<?php echo $row_getdata['mobile']?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Fullname</label>
                                            <div class="col-md-4">
                                                <input type="text" name="fullname" class="form-control" required="" value="<?php echo $row_getdata['fullname']?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Password</label>
                                            <div class="col-md-4">
                                                <input type="password" name="password" class="form-control" required="" value="<?php echo $row_getdata['password']?>">
                                            </div>
                                        </div>
                                         <?php 
                                        $sql_getuac="SELECT * FROM admins_uac WHERE id=".$row_getdata['id'];
                                        $res_getuac=$mysqli->query($sql_getuac);
                                        if(!$res_getuac) die($mysqli->error);
                                        $row_getuac=$res_getuac->fetch_assoc();
                                        ?>
                                      <div class="form-group">
                                            <label class="control-label col-md-4">Course Categories</label>
                                            <div class="col-md-4">
                                               <div class="checkbox" <?php
                                                    if($row_getuac['cat_create']==1) echo "checked"; 
                                                    ?>>
                                                    <label><input name="cat_create" type="checkbox" value=""
                                                    <?php
                                                    if($row_getuac['cat_create']==1) echo "checked"; 
                                                    ?>
                                                    >Create</label>
                                                </div>
                                                <div class="checkbox" <?php
                                                    if($row_getuac['cat_read']==1) echo "checked"; 
                                                    ?>>
                                                    <label><input name="cat_read" type="checkbox" value=""
                                                    <?php
                                                    if($row_getuac['cat_read']==1) echo "checked"; 
                                                    ?>
                                                    >Read</label>
                                                </div>
                                                <div class="checkbox" <?php
                                                    if($row_getuac['cat_update']==1) echo "checked"; 
                                                    ?>>
                                                    <label><input name="cat_update" type="checkbox" value=""
                                                    <?php
                                                    if($row_getuac['cat_update']==1) echo "checked"; 
                                                    ?>
                                                    >Update</label>
                                                </div>
                                                <div class="checkbox" <?php
                                                    if($row_getuac['cat_delete']==1) echo "checked"; 
                                                    ?>>
                                                    <label><input name="cat_delete" type="checkbox" value=""
                                                    <?php
                                                    if($row_getuac['cat_delete']==1) echo "checked"; 
                                                    ?>
                                                    >Delete</label>
                                                </div>
                       
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-4">Courses</label>
                                            <div class="col-md-4">
                                               <div class="checkbox" <?php
                                                    if($row_getuac['course_create']==1) echo "checked"; 
                                                    ?>>
                                                    <label><input name="course_create" type="checkbox" value=""
                                                    <?php
                                                    if($row_getuac['course_create']==1) echo "checked"; 
                                                    ?>
                                                    >Create</label>
                                                </div>
                                                <div class="checkbox" <?php
                                                    if($row_getuac['course_read']==1) echo "checked"; 
                                                    ?>>
                                                    <label><input name="course_read" type="checkbox" value=""
                                                    <?php
                                                    if($row_getuac['course_read']==1) echo "checked"; 
                                                    ?>
                                                    >Read</label>
                                                </div>
                                                <div class="checkbox" <?php
                                                    if($row_getuac['course_update']==1) echo "checked"; 
                                                    ?>>
                                                    <label><input name="course_update" type="checkbox" value=""
                                                    <?php
                                                    if($row_getuac['course_update']==1) echo "checked"; 
                                                    ?>
                                                    >Update</label>
                                                </div>
                                                <div class="checkbox" <?php
                                                    if($row_getuac['course_delete']==1) echo "checked"; 
                                                    ?>>
                                                    <label><input name="course_delete" type="checkbox" value=""
                                                    <?php
                                                    if($row_getuac['course_delete']==1) echo "checked"; 
                                                    ?>
                                                    >Delete</label>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-4">Testimonials</label>
                                            <div class="col-md-4">
                                               <div class="checkbox" <?php
                            if($row_getuac['test_create']==1) echo "checked"; 
                            ?>>
                            <label><input name="test_create" type="checkbox" value=""
                            <?php
                            if($row_getuac['test_create']==1) echo "checked"; 
                            ?>
                            >Create</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['test_read']==1) echo "checked"; 
                            ?>>
                            <label><input name="test_read" type="checkbox" value=""
                            <?php
                            if($row_getuac['test_read']==1) echo "checked"; 
                            ?>
                            >Read</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['test_update']==1) echo "checked"; 
                            ?>>
                            <label><input name="test_update" type="checkbox" value=""
                            <?php
                            if($row_getuac['test_update']==1) echo "checked"; 
                            ?>
                            >Update</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['test_delete']==1) echo "checked"; 
                            ?>>
                            <label><input name="test_delete" type="checkbox" value=""
                            <?php
                            if($row_getuac['test_delete']==1) echo "checked"; 
                            ?>
                            >Delete</label>
                        </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">FAQs</label>
                                            <div class="col-md-4">
                                               <div class="checkbox" <?php
                            if($row_getuac['faq_create']==1) echo "checked"; 
                            ?>>
                            <label><input name="faq_create" type="checkbox" value=""
                            <?php
                            if($row_getuac['faq_create']==1) echo "checked"; 
                            ?>
                            >Create</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['faq_read']==1) echo "checked"; 
                            ?>>
                            <label><input name="faq_read" type="checkbox" value=""
                            <?php
                            if($row_getuac['faq_read']==1) echo "checked"; 
                            ?>
                            >Read</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['faq_update']==1) echo "checked"; 
                            ?>>
                            <label><input name="faq_update" type="checkbox" value=""
                            <?php
                            if($row_getuac['faq_update']==1) echo "checked"; 
                            ?>
                            >Update</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['faq_delete']==1) echo "checked"; 
                            ?>>
                            <label><input name="faq_delete" type="checkbox" value=""
                            <?php
                            if($row_getuac['faq_delete']==1) echo "checked"; 
                            ?>
                            >Delete</label>
                        </div>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-4">Enrollment Requests</label>
                                            <div class="col-md-4">
                                               <div class="checkbox" <?php
                            if($row_getuac['enreq_create']==1) echo "checked"; 
                            ?>>
                            <label><input name="enreq_create" type="checkbox" value=""
                            <?php
                            if($row_getuac['enreq_create']==1) echo "checked"; 
                            ?>
                            >Create</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['enreq_read']==1) echo "checked"; 
                            ?>>
                            <label><input name="enreq_read" type="checkbox" value=""
                            <?php
                            if($row_getuac['enreq_read']==1) echo "checked"; 
                            ?>
                            >Read</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['enreq_update']==1) echo "checked"; 
                            ?>>
                            <label><input name="enreq_update" type="checkbox" value=""
                            <?php
                            if($row_getuac['enreq_update']==1) echo "checked"; 
                            ?>
                            >Update</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['enreq_delete']==1) echo "checked"; 
                            ?>>
                            <label><input name="enreq_delete" type="checkbox" value=""
                            <?php
                            if($row_getuac['enreq_delete']==1) echo "checked"; 
                            ?>
                            >Delete</label>
                        </div>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-4">Business Requests</label>
                                            <div class="col-md-4">
                                               <div class="checkbox" <?php
                            if($row_getuac['busreq_create']==1) echo "checked"; 
                            ?>>
                            <label><input name="busreq_create" type="checkbox" value=""
                            <?php
                            if($row_getuac['busreq_create']==1) echo "checked"; 
                            ?>
                            >Create</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['busreq_read']==1) echo "checked"; 
                            ?>>
                            <label><input name="busreq_read" type="checkbox" value=""
                            <?php
                            if($row_getuac['busreq_read']==1) echo "checked"; 
                            ?>
                            >Read</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['busreq_update']==1) echo "checked"; 
                            ?>>
                            <label><input name="busreq_update" type="checkbox" value=""
                            <?php
                            if($row_getuac['busreq_update']==1) echo "checked"; 
                            ?>
                            >Update</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['busreq_delete']==1) echo "checked"; 
                            ?>>
                            <label><input name="busreq_delete" type="checkbox" value=""
                            <?php
                            if($row_getuac['busreq_delete']==1) echo "checked"; 
                            ?>
                            >Delete</label>
                        </div>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-4">Schedule Requests</label>
                                            <div class="col-md-4">
                                               <div class="checkbox" <?php
                            if($row_getuac['schreq_create']==1) echo "checked"; 
                            ?>>
                            <label><input name="schreq_create" type="checkbox" value=""
                            <?php
                            if($row_getuac['schreq_create']==1) echo "checked"; 
                            ?>
                            >Create</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['schreq_read']==1) echo "checked"; 
                            ?>>
                            <label><input name="schreq_read" type="checkbox" value=""
                            <?php
                            if($row_getuac['schreq_read']==1) echo "checked"; 
                            ?>
                            >Read</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['schreq_update']==1) echo "checked"; 
                            ?>>
                            <label><input name="schreq_update" type="checkbox" value=""
                            <?php
                            if($row_getuac['schreq_update']==1) echo "checked"; 
                            ?>
                            >Update</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['schreq_delete']==1) echo "checked"; 
                            ?>>
                            <label><input name="schreq_delete" type="checkbox" value=""
                            <?php
                            if($row_getuac['schreq_delete']==1) echo "checked"; 
                            ?>
                            >Delete</label>
                        </div>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-4">Instructor Profiles</label>
                                            <div class="col-md-4">
                                               <div class="checkbox" <?php
                            if($row_getuac['insreq_create']==1) echo "checked"; 
                            ?>>
                            <label><input name="insreq_create" type="checkbox" value=""
                            <?php
                            if($row_getuac['insreq_create']==1) echo "checked"; 
                            ?>
                            >Create</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['insreq_read']==1) echo "checked"; 
                            ?>>
                            <label><input name="insreq_read" type="checkbox" value=""
                            <?php
                            if($row_getuac['insreq_read']==1) echo "checked"; 
                            ?>
                            >Read</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['insreq_update']==1) echo "checked"; 
                            ?>>
                            <label><input name="insreq_update" type="checkbox" value=""
                            <?php
                            if($row_getuac['insreq_update']==1) echo "checked"; 
                            ?>
                            >Update</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['insreq_delete']==1) echo "checked"; 
                            ?>>
                            <label><input name="insreq_delete" type="checkbox" value=""
                            <?php
                            if($row_getuac['insreq_delete']==1) echo "checked"; 
                            ?>
                            >Delete</label>
                        </div>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-4">Day Training</label>
                                            <div class="col-md-4">
                                               <div class="checkbox" <?php
                            if($row_getuac['dtraining_create']==1) echo "checked"; 
                            ?>>
                            <label><input name="dtraining_create" type="checkbox" value=""
                            <?php
                            if($row_getuac['dtraining_create']==1) echo "checked"; 
                            ?>
                            >Create</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['dtraining_read']==1) echo "checked"; 
                            ?>>
                            <label><input name="dtraining_read" type="checkbox" value=""
                            <?php
                            if($row_getuac['dtraining_read']==1) echo "checked"; 
                            ?>
                            >Read</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['dtraining_update']==1) echo "checked"; 
                            ?>>
                            <label><input name="dtraining_update" type="checkbox" value=""
                            <?php
                            if($row_getuac['dtraining_update']==1) echo "checked"; 
                            ?>
                            >Update</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['dtraining_delete']==1) echo "checked"; 
                            ?>>
                            <label><input name="dtraining_delete" type="checkbox" value=""
                            <?php
                            if($row_getuac['dtraining_delete']==1) echo "checked"; 
                            ?>
                            >Delete</label>
                        </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Night Training</label>
                                            <div class="col-md-4">
                                               <div class="checkbox" <?php
                            if($row_getuac['ntraining_create']==1) echo "checked"; 
                            ?>>
                            <label><input name="ntraining_create" type="checkbox" value=""
                            <?php
                            if($row_getuac['ntraining_create']==1) echo "checked"; 
                            ?>
                            >Create</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['ntraining_read']==1) echo "checked"; 
                            ?>>
                            <label><input name="ntraining_read" type="checkbox" value=""
                            <?php
                            if($row_getuac['ntraining_read']==1) echo "checked"; 
                            ?>
                            >Read</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['ntraining_update']==1) echo "checked"; 
                            ?>>
                            <label><input name="ntraining_update" type="checkbox" value=""
                            <?php
                            if($row_getuac['ntraining_update']==1) echo "checked"; 
                            ?>
                            >Update</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['ntraining_delete']==1) echo "checked"; 
                            ?>>
                            <label><input name="ntraining_delete" type="checkbox" value=""
                            <?php
                            if($row_getuac['ntraining_delete']==1) echo "checked"; 
                            ?>
                            >Delete</label>
                        </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Day Support</label>
                                            <div class="col-md-4">
                                               <div class="checkbox" <?php
                            if($row_getuac['dsupport_create']==1) echo "checked"; 
                            ?>>
                            <label><input name="dsupport_create" type="checkbox" value=""
                            <?php
                            if($row_getuac['dsupport_create']==1) echo "checked"; 
                            ?>
                            >Create</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['dsupport_read']==1) echo "checked"; 
                            ?>>
                            <label><input name="dsupport_read" type="checkbox" value=""
                            <?php
                            if($row_getuac['dsupport_read']==1) echo "checked"; 
                            ?>
                            >Read</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['dsupport_update']==1) echo "checked"; 
                            ?>>
                            <label><input name="dsupport_update" type="checkbox" value=""
                            <?php
                            if($row_getuac['dsupport_update']==1) echo "checked"; 
                            ?>
                            >Update</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['dsupport_delete']==1) echo "checked"; 
                            ?>>
                            <label><input name="dsupport_delete" type="checkbox" value=""
                            <?php
                            if($row_getuac['dsupport_delete']==1) echo "checked"; 
                            ?>
                            >Delete</label>
                        </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Night Support</label>
                                            <div class="col-md-4">
                                               <div class="checkbox" <?php
                            if($row_getuac['nsupport_create']==1) echo "checked"; 
                            ?>>
                            <label><input name="nsupport_create" type="checkbox" value=""
                            <?php
                            if($row_getuac['nsupport_create']==1) echo "checked"; 
                            ?>
                            >Create</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['nsupport_read']==1) echo "checked"; 
                            ?>>
                            <label><input name="nsupport_read" type="checkbox" value=""
                            <?php
                            if($row_getuac['nsupport_read']==1) echo "checked"; 
                            ?>
                            >Read</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['nsupport_update']==1) echo "checked"; 
                            ?>>
                            <label><input name="nsupport_update" type="checkbox" value=""
                            <?php
                            if($row_getuac['nsupport_update']==1) echo "checked"; 
                            ?>
                            >Update</label>
                        </div>
                        <div class="checkbox" <?php
                            if($row_getuac['nsupport_delete']==1) echo "checked"; 
                            ?>>
                            <label><input name="nsupport_delete" type="checkbox" value=""
                            <?php
                            if($row_getuac['nsupport_delete']==1) echo "checked"; 
                            ?>
                            >Delete</label>
                        </div>
                                            </div>
                                        </div>
                                           <div class="form-group">
                                            <label class="control-label col-md-4">Admin Management</label>
                                            <div class="col-md-4">
                                               <div class="checkbox" <?php
                            if($row_getuac['adminmanagement']==1) echo "checked"; 
                            ?>>
                            <label><input name="adminmanagement" type="checkbox" value=""
                            <?php
                            if($row_getuac['adminmanagement']==1) echo "checked"; 
                            ?>
                            >Enabled</label>
                        </div>
                      
                       
                                            </div>
                                        </div>
                                    </div>
                                    </div>
					            	<input type="hidden" name="id" value="<?php echo $row_getdata['id']?>">
						            <div class="modal-footer">
						                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						                <button type="submit" id="editbtn" name="edituser" class="btn btn-primary">Edit Admin</button>
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