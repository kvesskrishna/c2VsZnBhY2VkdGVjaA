<?php include('templates/header.php');
$page="support";

if (isset($_POST['addsupport'])) {
    $technology=mysqli_real_escape_string($mysqli,$_POST['technology']);
    $meeting_id=$_POST['meeting_id'];
	$meeting_platform=$_POST['meeting_platform'];
    $trainer_name=mysqli_real_escape_string($mysqli,$_POST['trainer_name']);
	$trainer_email=mysqli_real_escape_string($mysqli,$_POST['trainer_email']);
	$trainer_phone=mysqli_real_escape_string($mysqli,$_POST['trainer_phone']);
    $student_name=mysqli_real_escape_string($mysqli,$_POST['student_name']);
    $student_email=mysqli_real_escape_string($mysqli,$_POST['student_email']);
    $student_phone=mysqli_real_escape_string($mysqli,$_POST['student_phone']);
    $student_country=mysqli_real_escape_string($mysqli,$_POST['student_country']);
    $consultancy_name=mysqli_real_escape_string($mysqli,$_POST['consultancy_name']);
    $start_date=mysqli_real_escape_string($mysqli,$_POST['start_date']);
    $end_date=mysqli_real_escape_string($mysqli,$_POST['end_date']);
    $training_comments=mysqli_real_escape_string($mysqli,$_POST['training_comments']);
       $training_status=mysqli_real_escape_string($mysqli,$_POST['training_status']);
$training_createdby=$_SESSION['user'];
       $trainer_timezone=mysqli_real_escape_string($mysqli,$_POST['trainer_timezone']);
       $student_timezone=mysqli_real_escape_string($mysqli,$_POST['student_timezone']);
$training_time="Day";

   $sql_updatedata="INSERT INTO support (technology, meeting_id, trainer_name, trainer_email, trainer_phone, student_name, student_email, student_phone, student_country, consultancy_name, start_date, end_date, meeting_platform, training_comments, training_status, training_createdby, trainer_timezone, student_timezone, training_time) VALUES ('$technology', $meeting_id, '$trainer_name', '$trainer_email', '$trainer_phone', '$student_name', '$student_email', '$student_phone', '$student_country', '$consultancy_name', '$start_date', '$end_date', '$meeting_platform', '$training_comments', '$training_status', '$training_createdby', '$trainer_timezone', '$student_timezone', '$training_time')";
	$res_updatedata=$mysqli->query($sql_updatedata);
	if(!$res_updatedata){
        echo $sql_updatedata."<br>";
		die($mysqli->error);
	}
	$_SESSION['message']=$alert="Support Data added Successfully";
	header('Location:support.php');
}
if (isset($_POST['editsupport'])) {
	$technology=mysqli_real_escape_string($mysqli,$_POST['technology']);
    $meeting_id=$_POST['meeting_id'];
    $meeting_platform=$_POST['meeting_platform'];
    $trainer_name=mysqli_real_escape_string($mysqli,$_POST['trainer_name']);
    $trainer_email=mysqli_real_escape_string($mysqli,$_POST['trainer_email']);
    $trainer_phone=mysqli_real_escape_string($mysqli,$_POST['trainer_phone']);
    $student_name=mysqli_real_escape_string($mysqli,$_POST['student_name']);
    $student_email=mysqli_real_escape_string($mysqli,$_POST['student_email']);
    $student_phone=mysqli_real_escape_string($mysqli,$_POST['student_phone']);
    $student_country=mysqli_real_escape_string($mysqli,$_POST['student_country']);
    $consultancy_name=mysqli_real_escape_string($mysqli,$_POST['consultancy_name']);
    $start_date=mysqli_real_escape_string($mysqli,$_POST['start_date']);
    $end_date=mysqli_real_escape_string($mysqli,$_POST['end_date']);
    $training_status=mysqli_real_escape_string($mysqli,$_POST['training_status']);
    $training_id=$_POST['training_id'];
    $training_time=$_POST['training_time'];
        $training_comments=mysqli_real_escape_string($mysqli,$_POST['training_comments']);
 $trainer_timezone=mysqli_real_escape_string($mysqli,$_POST['trainer_timezone']);
       $student_timezone=mysqli_real_escape_string($mysqli,$_POST['student_timezone']);

	$sql_updatedata="UPDATE support SET technology='$technology', meeting_id=$meeting_id, trainer_name='$trainer_name', trainer_email='$trainer_email', trainer_phone='$trainer_phone', student_name='$student_name', student_email='$student_email', student_phone='$student_phone', student_country='$student_country', consultancy_name='$consultancy_name', start_date='$start_date', end_date='$end_date', training_status='$training_status', meeting_platform='$meeting_platform', training_time='$training_time', training_comments='$training_comments', trainer_timezone='$trainer_timezone', student_timezone='$student_timezone' WHERE training_id=$training_id";
	$res_updatedata=$mysqli->query($sql_updatedata);
	if(!$res_updatedata){
        echo $sql_updatedata."<br>";
		die($mysqli->error);
	}
	$_SESSION['message']=$alert="Support Data Updated Successfully";
	header('Location:support.php');

}
if (isset($_POST['deletesupport'])) {
	# code...
	$training_id=$_POST['training_id'];
	$sql_deletedata="DELETE FROM support WHERE training_id=$training_id";
	$res_deletedata=$mysqli->query($sql_deletedata);
	if (!$res_deletedata) {
		$_SESSION['message']=$alert="Support Data Deleted Successfully";
	header('Location:trainings.php');
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
							<li class="active">Day Support</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h1>
								Day Support
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
                            <?php if($udsupport_create==1) {?>
							<p class="text-right"><a href="#addmodal" role="button" class="btn btn-large btn-primary" data-toggle="modal">New Entry</a></p><?php }?>
						</div><!-- /.page-header -->
						 <div id="addmodal" class="modal fade">
							<div class="modal-dialog">
							    <div class="modal-content">
							        <div class="modal-header">
						                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						                <h4 class="modal-title">Add Entry</h4>
						            </div>						            
							<form class="form-horizontal" method="post" action="#">            				
            						<div class="modal-body">
  							  			<div class="form-group">
            								<label class="control-label col-md-4">Technology</label>
            								<div class="col-md-4">
            									<input type="text" name="technology" class="form-control">
            								</div>
            							</div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Meeting Platform</label>
                                            <div class="col-md-4">
                                                <select name="meeting_platform" class="form-control">
                                              
                                                    <option value="Goto Meeting">Goto Meeting</option>
                                                    <option value="Zoom">Zoom</option>
                                                  
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Meeting ID</label>
                                            <div class="col-md-4">
                                                <input type="text" name="meeting_id" class="form-control" required="">
                                            </div>
                                        </div>
            							<div class="form-group">
            								<label class="control-label col-md-4">Trainer Name</label>
            								<div class="col-md-4">
            									<input type="text" name="trainer_name" class="form-control" required="">
            								</div>
            							</div>
            							<div class="form-group">
            								<label class="control-label col-md-4">Trainer Email</label>
            								<div class="col-md-4">
            									<input type="email" name="trainer_email" class="form-control" required="">
            								</div>
            							</div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Trainer Phone</label>
                                            <div class="col-md-4">
                                                <input type="text" name="trainer_phone" class="form-control" required="">
                                            </div>
                                        </div>
                                         <div class="form-group">
                   <label class="control-label col-md-4">Trainer Timezone</label>
                   <div class="col-md-5">
                    <select class="form-control" name="trainer_timezone">
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
                                            <label class="control-label col-md-4">Student Name</label>
                                            <div class="col-md-4">
                                                <input type="text" name="student_name" class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Student Email</label>
                                            <div class="col-md-4">
                                                <input type="email" name="student_email" class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Student Phone</label>
                                            <div class="col-md-4">
                                                <input type="text" name="student_phone" class="form-control" required="">
                                            </div>
                                        </div>
                                         <div class="form-group">
                   <label class="control-label col-md-4">Student Timezone</label>
                   <div class="col-md-5">
                    <select class="form-control" name="student_timezone">
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
                                            <label class="control-label col-md-4">Student Country</label>
                                            <div class="col-md-4">
                                                <input type="text" name="student_country" class="form-control" required="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4">Consultancy Name</label>
                                            <div class="col-md-4">
                                                <input type="text" name="consultancy_name" class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Start Date</label>
                                            <div class="col-md-4">
                                                <input type="text" name="start_date" class="form-control datepicker" required="">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-4">End Date</label>
                                            <div class="col-md-4">
                                                <input type="text" name="end_date" class="form-control datepicker" required="">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-4">Status</label>
                                            <div class="col-md-4">
                                                <select name="training_status" class="form-control">
                                                   
                                                    <option selected="" value="New">New</option>
                                                    <option value="In Progress">In Progress</option>
                                                    <option value="With Held">With Held</option>
                                                    <option value="Aborted">Aborted</option>
                                                </select>
                                            </div>
                                        </div>
            							<div class="form-group">
                                            <label class="control-label col-md-4">Comments</label>
                                            <div class="col-md-4">
                                                <textarea name="training_comments"></textarea>
                                            </div>
                                        </div>
					            	
					            	
                                    </div>
						            <div class="modal-footer">
						                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						                <button type="submit" id="addbtn" name="addsupport" class="btn btn-primary">Add Entry</button>
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
                <th>Technology</th>
                <th>Trainer Name</th>
                <th>Student Name</th>
                <th>Consultancy</th>
              <th>Created on</th> 
               <th>Edit/Delete</th>
            </tr>
        </thead>
        <tfoot>
          <tr>
               <th>Technology</th>
                <th>Trainer Name</th>
                <th>Student Name</th>
                <th>Consultancy</th>
              <th>Created on</th> 
               <th>Edit/Delete</th>
            </tr>
        </tfoot>
        <tbody>
        <?php
        $sql_getdata="SELECT * FROM support WHERE training_time='Day'";
        $res_getdata=$mysqli->query($sql_getdata);
        while ($row_getdata=$res_getdata->fetch_assoc()) {
        	# code...
        	?>
        	<tr>
                <td><?php echo $row_getdata['technology']?> </td>
                <td><?php echo $row_getdata['trainer_name']?></td>
                <td><?php echo $row_getdata['student_name']?></td>
                <td><?php echo $row_getdata['consultancy_name']?></td>
                <td><?php echo $row_getdata['training_created']?></td>
               <td><?php if($udsupport_update==1) {?><a href="#edit<?php echo $row_getdata['training_id']?>" data-toggle="modal"><i class="fa fa-pencil-square-o"></i></a><?php } if($udsupport_delete==1) {?>
                <a href="#delete<?php echo $row_getdata['training_id']?>" data-toggle="modal"><i class="fa fa-trash"></i></a><?php }?>
                <a href="#view<?php echo $row_getdata['training_id']?>" data-toggle="modal"><i class="fa fa-eye"></i></a>

                <div id="delete<?php echo $row_getdata['training_id']?>" class="modal fade">
							<div class="modal-dialog">
							    <div class="modal-content">
							        <div class="modal-header">
						                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						                <h4 class="modal-title">Delete Entry</h4>
						            </div>						            
							<form class="form-horizontal" method="post" action="#">            				
								Delete Request for <b><?php echo $row_getdata['technology']?></b>
            						<p class="text-primary">Are you sure you want to delete this entry?</p>
					            	<input type="hidden" name="training_id" value="<?php echo $row_getdata['training_id']?>">
						            <div class="modal-footer">
						                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						                <button type="submit" id="deletebtn" name="deletesupport" class="btn btn-primary">Delete Entry</button>
						            </div>
            				</form>
				        </div>
				    </div>
				</div>

                <div id="view<?php echo $row_getdata['training_id']?>" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">View Entry</h4>
                                    </div>                                  
                           <table class="table" border="0" style="margin-left: 5px">
                               <tr>
                                <td><b>Technology:</b></td>
                                <td><?php echo $row_getdata['technology']?></td>
                              </tr>
                              <tr>
                                <td><b>Meeting platform:</b></td>
                                <td><?php echo $row_getdata['meeting_platform']?></td>
                              </tr>

                               <tr>
                                <td><b>Meeting id:</b></td>
                                <td><?php echo $row_getdata['meeting_id']?></td>
                              </tr>
                               <tr>
                                <td><b>Trainer Name:</b></td>
                                <td><?php echo $row_getdata['trainer_name']?></td>
                              </tr>
                               <tr>
                                <td><b>Trainer Phone:</b></td>
                                <td><?php echo $row_getdata['trainer_phone']?></td>
                              </tr>
                               <tr>
                                <td><b>Trainer Email:</b></td>
                                <td><?php echo $row_getdata['trainer_email']?></td>
                              </tr>
                              <tr>
                                <td><b>Trainer Timezone:</b></td>
                                <td><?php echo $row_getdata['trainer_timezone']?></td>
                              </tr>
                               <tr>
                                <td><b>Student Name:</b></td>
                                <td><?php echo $row_getdata['student_name']?></td>
                              </tr>
                               <tr>
                                <td><b>Student Phone:</b></td>
                                <td><?php echo $row_getdata['student_phone']?></td>
                              </tr>
                               <tr>
                                <td><b>Student Email:</b></td>
                                <td><?php echo $row_getdata['student_email']?></td>
                              </tr>
                              <tr>
                                <td><b>Student Timezone:</b></td>
                                <td><?php echo $row_getdata['student_timezone']?></td>
                              </tr>
                               <tr>
                                <td><b>Student Country:</b></td>
                                <td><?php echo $row_getdata['student_country']?></td>
                              </tr> <tr>
                                <td><b>Consultancy Name:</b></td>
                                <td><?php echo $row_getdata['consultancy_name']?></td>
                              </tr>
                              <tr>
                                <td><b>Day/Night:</b></td>
                                <td><?php echo $row_getdata['training_time']?></td>
                              </tr>
                               <tr>
                                <td><b>Start Date:</b></td>
                                <td><?php echo $row_getdata['start_date']?></td>
                              </tr>
                               <tr>
                                <td><b>End Date:</b></td>
                                <td><?php echo $row_getdata['end_date']?></td>
                              </tr> <tr>
                                <td><b>Status:</b></td>
                                <td><?php echo $row_getdata['training_status']?></td>
                              </tr><tr>
                                <td><b>Comments:</b></td>
                                <td><?php echo $row_getdata['training_comments']?></td>
                              </tr>
                              <tr>
                                <td><b>Created by:</b></td>
                                <td><?php echo $row_getdata['training_createdby']?></td>
                              </tr>

                           </table>
                        </div>
                    </div>
                </div>


                  <div id="edit<?php echo $row_getdata['training_id']?>" class="modal fade">
							<div class="modal-dialog">
							    <div class="modal-content">
							        <div class="modal-header">
						                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						                <h4 class="modal-title">Edit Entry</h4>
						            </div>						            
							<form class="form-horizontal" method="post" action="#">            			<div class="modal-body">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Technology</label>
                                            <div class="col-md-4">
                                                <input type="text" name="technology" class="form-control" value="<?php echo $row_getdata['technology']?>">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-4">Day/Night</label>
                                            <div class="col-md-4">
                                                <select name="training_time" class="form-control">
                                                    <option value="<?php echo $row_getdata['training_time']?>" selected><?php echo $row_getdata['training_time']?></option>
                                                    <option value="Day">Day</option>
                                                    <option value="Night">Night</option>
                                                  
                                                </select>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-4">Meeting Platform</label>
                                            <div class="col-md-4">
                                                <select name="meeting_platform" class="form-control">
                                                    <option value="<?php echo $row_getdata['meeting_platform']?>" selected><?php echo $row_getdata['meeting_platform']?></option>
                                                    <option value="Goto Meeting">Goto Meeting</option>
                                                    <option value="Zoom">Zoom</option>
                                                  
                                                </select>
                                            </div>
                                        </div>
                                          <div class="form-group">
                                            <label class="control-label col-md-4">Meeting ID</label>
                                            <div class="col-md-4">
                                                <input type="text" name="meeting_id" class="form-control" required="" value="<?php echo $row_getdata['meeting_id']?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Trainer Name</label>
                                            <div class="col-md-4">
                                                <input type="text" name="trainer_name" class="form-control" required="" value="<?php echo $row_getdata['trainer_name']?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Trainer Email</label>
                                            <div class="col-md-4">
                                                <input type="email" name="trainer_email" class="form-control" required="" value="<?php echo $row_getdata['trainer_email']?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Trainer Phone</label>
                                            <div class="col-md-4">
                                                <input type="text" name="trainer_phone" class="form-control" required="" value="<?php echo $row_getdata['trainer_phone']?>">
                                            </div>
                                        </div>
                                         <div class="form-group">
                   <label class="control-label col-md-4">Trainer Timezone</label>
                   <div class="col-md-5">
                    <select class="form-control" name="trainer_timezone">
                        <option selected="" value="<?php echo $row_getdata['trainer_timezone']?>"><?php echo $row_getdata['trainer_timezone']?></option>
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
                                            <label class="control-label col-md-4">Student Name</label>
                                            <div class="col-md-4">
                                                <input type="text" name="student_name" class="form-control" required="" value="<?php echo $row_getdata['student_name']?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Student Email</label>
                                            <div class="col-md-4">
                                                <input type="email" name="student_email" class="form-control" required="" value="<?php echo $row_getdata['student_email']?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Student Phone</label>
                                            <div class="col-md-4">
                                                <input type="text" name="student_phone" class="form-control" required="" value="<?php echo $row_getdata['student_phone']?>">
                                            </div>
                                        </div>
                                         <div class="form-group">
                   <label class="control-label col-md-4">Student Timezone</label>
                   <div class="col-md-5">
                    <select class="form-control" name="student_timezone">
                        <option selected="" value="<?php echo $row_getdata['student_timezone']?>"><?php echo $row_getdata['student_timezone']?></option>
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
                                            <label class="control-label col-md-4">Student Country</label>
                                            <div class="col-md-4">
                                                <input type="text" name="student_country" class="form-control" required="" value="<?php echo $row_getdata['student_country']?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4">Consultancy Name</label>
                                            <div class="col-md-4">
                                                <input type="text" name="consultancy_name" class="form-control" required="" value="<?php echo $row_getdata['consultancy_name']?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Start Date</label>
                                            <div class="col-md-4">
                                                <input type="text" name="start_date" class="form-control datepicker" required="" value="<?php echo $row_getdata['start_date']?>">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-4">End Date</label>
                                            <div class="col-md-4">
                                                <input type="text" name="end_date" class="form-control datepicker" required="" value="<?php echo $row_getdata['end_date']?>">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-4">Status</label>
                                            <div class="col-md-4">
                                                <select name="training_status" class="form-control">
                                                    <option value="<?php echo $row_getdata['training_status']?>" selected><?php echo $row_getdata['training_status']?></option>
                                                    <option value="New">New</option>
                                                    <option value="In Progress">In Progress</option>
                                                    <option value="With Held">With Held</option>
                                                    <option value="Aborted">Aborted</option>
                                                </select>
                                            </div>
                                        </div>
                                    <div class="form-group">
                                            <label class="control-label col-md-4">Comments</label>
                                            <div class="col-md-4">
                                                <textarea name="training_comments"><?php echo $training_comments?></textarea>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <input type="hidden" name="training_id" value="<?php echo $row_getdata['training_id']?>">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="submit" id="editbtn" name="editsupport" class="btn btn-primary">Edit Entry</button>
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
      <?php if($udsupport_delete==1){?>
        <form class="form-horizontal" method="post" action="exportsupport.php">
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
            <div class="form-group">
                                            <label class="control-label col-md-4">Status</label>
                                            <div class="col-md-4">
                                                <select name="status" class="form-control">
                                                   <option value="all">All</option>
                                                    <option value="New">New</option>
                                                    <option value="In Progress">In Progress</option>
                                                    <option value="With Held">With Held</option>
                                                    <option value="Aborted">Aborted</option>
                                                </select>
                                            </div>
                                        </div>
            <button class="btn btn-success" type="submit">Export</button>
        </form>
        <?php }?>
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