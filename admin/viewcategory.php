<?php include('templates/header.php');
$page="courses";
 error_reporting(0);
$getcat=$_GET['id'];
$sql_catname="SELECT category_name FROM course_categories WHERE category_id=$getcat";
$res_catname=$mysqli->query($sql_catname);
if (!$res_catname) {
    # code...
    die($mysqli->error);
}
$row_catname=$res_catname->fetch_assoc();
$categoryname=$row_catname['category_name'];
if (isset($_POST['addcourse'])) {
    if(isset($_FILES['coursethumbnail'])){
      $errors= array();
      $file_name = time().$_FILES['coursethumbnail']['name'];
      $file_size = $_FILES['coursethumbnail']['size'];
      $file_tmp = $_FILES['coursethumbnail']['tmp_name'];
      $file_type = $_FILES['coursethumbnail']['type'];
      $file_ext=pathinfo($_FILES["coursethumbnail"]["name"])['extension'];


      
      $expensions= array("jpeg","jpg","png","gif");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a jpg,png,gif file.";
      }
      
      if($file_size > 4097152) {
         $errors[]='File size must be less than 2 MB';
      }
      
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"../assets/img/topcourses/".$file_name);
         $thumbnail=$file_name;
      }else{
         print_r($errors);
      }
   }
    $newcourse=mysqli_real_escape_string($mysqli,$_POST['coursename']);
    $newcourseref=mysqli_real_escape_string($mysqli,$_POST['courseref']);
    $newcoursetype=mysqli_real_escape_string($mysqli,$_POST['coursetype']);
    $newcourserating=mysqli_real_escape_string($mysqli,$_POST['courserating']);
    $newcoursenote=mysqli_real_escape_string($mysqli,$_POST['coursenote']);
    $newcourseactualprice=mysqli_real_escape_string($mysqli,$_POST['courseactualprice']);
    $newcourseofferprice=mysqli_real_escape_string($mysqli,$_POST['courseofferprice']);
    $newcoursethumbnail=mysqli_real_escape_string($mysqli,$thumbnail);
    $newcourseduration=mysqli_real_escape_string($mysqli,$_POST['courseduration']);
    $newcoursetitletag=mysqli_real_escape_string($mysqli,$_POST['course_titletag']);
    $newmetadescription=mysqli_real_escape_string($mysqli,$_POST['meta_description']);
    $newmetakeywords=mysqli_real_escape_string($mysqli,$_POST['meta_keywords']);

    $sql_adddata="INSERT INTO courses (course_name,category_id,course_reference,course_type,course_actual_price,course_offer_price,course_rating,course_thumbnail,course_note,course_duration,course_titletag,meta_description,meta_keywords) VALUES ('$newcourse',$getcat,'$newcourseref','$newcoursetype',$newcourseactualprice,$newcourseofferprice,$newcourserating,'$newcoursethumbnail','$newcoursenote','$newcourseduration','$newcoursetitletag','$newmetadescription','$newmetakeywords')";
    
    $res_adddata=$mysqli->query($sql_adddata);
    if(!$res_adddata){
        die($mysqli->error);
    }
    $_SESSION['message']="Course Inserted Successfully";
    header('Location:viewcategory.php?id='.$getcat);
}
if (isset($_POST['editcourse'])) {
    $thumbnail=$_POST['oldthumbnail'];
    if(isset($_FILES['coursethumbnail'])&&!empty($_FILES['coursethumbnail']['name'])){
        $delfile="../assets/img/topcourses/".$thumbnail;
        unlink($delfile);
      $errors= array();
      $file_name = time().$_FILES['coursethumbnail']['name'];
      $file_size = $_FILES['coursethumbnail']['size'];
      $file_tmp = $_FILES['coursethumbnail']['tmp_name'];
      $file_type = $_FILES['coursethumbnail']['type'];
      $file_ext=pathinfo($_FILES["coursethumbnail"]["name"])['extension'];


      
      $expensions= array("jpeg","jpg","png","gif");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a jpg,png,gif file.";
      }
      
      if($file_size > 4097152) {
         $errors[]='File size must be less than 2 MB';
      }
      
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"../assets/img/topcourses/".$file_name);
         $thumbnail=$file_name;
      }else{
         print_r($errors);
      }
   }
    $newcourse=mysqli_real_escape_string($mysqli,$_POST['coursename']);
    $newcourseref=mysqli_real_escape_string($mysqli,$_POST['courseref']);
    $newcoursetype=mysqli_real_escape_string($mysqli,$_POST['coursetype']);
    $newcourserating=mysqli_real_escape_string($mysqli,$_POST['courserating']);
    $newcoursenote=mysqli_real_escape_string($mysqli,$_POST['coursenote']);
    $newcourseactualprice=mysqli_real_escape_string($mysqli,$_POST['courseactualprice']);
    $newcourseofferprice=mysqli_real_escape_string($mysqli,$_POST['courseofferprice']);
    $newcoursethumbnail=mysqli_real_escape_string($mysqli,$thumbnail);
    $newcourseduration=mysqli_real_escape_string($mysqli,$_POST['courseduration']);
     $newcoursetitletag=mysqli_real_escape_string($mysqli,$_POST['course_titletag']);
    $newmetadescription=mysqli_real_escape_string($mysqli,$_POST['meta_description']);
    $newmetakeywords=mysqli_real_escape_string($mysqli,$_POST['meta_keywords']);

    $courseid=$_POST['courseid'];
    $sql_updatedata="UPDATE courses SET course_name='$newcourse',course_reference='$newcourseref',course_type='$newcoursetype',course_actual_price=$newcourseactualprice,course_offer_price=$newcourseofferprice,course_rating=$newcourserating,course_thumbnail='$newcoursethumbnail',course_note='$newcoursenote',course_duration='$newcourseduration',course_modifiedon=now(),course_titletag='$newcoursetitletag',meta_description='$newmetadescription',meta_keywords='$newmetakeywords' WHERE course_id=$courseid";
    
    $res_updatedata=$mysqli->query($sql_updatedata);
    if(!$res_updatedata){
        die($mysqli->error);
    }
    $_SESSION['message']=$alert="Course Updated Successfully";
    header('Location:viewcategory.php?id='.$getcat);

}
if (isset($_POST['deletecourse'])) {
    # code...
    $courseid=$_POST['courseid'];
    $delthumbnail=$_POST['delthumbnail'];
    $sql_deletedata="DELETE FROM courses WHERE course_id=$courseid";
    $res_deletedata=$mysqli->query($sql_deletedata);
    if (!$res_deletedata) {
        die($mysqli->error);
    }
    $delfile="../assets/img/topcourses/".$delthumbnail;
    unlink($delfile);
        $_SESSION['message']=$alert="Course Deleted Successfully";
    header('Location:viewcategory.php?id='.$getcat);
    
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
                            <li class="active">Courses</li>
                        </ul><!-- /.breadcrumb -->
                    </div>

                    <div class="page-content">
                        <div class="page-header">
                            <h1>
                               <?php echo $categoryname?> <i class="ace-icon fa fa-angle-double-right"></i>  Courses
                                <?php 
                                if(isset($_SESSION['message']))
                                echo "<div style='color:red'>".$_SESSION['message']."</div>";
                                unset($_SESSION['message']);
                            ?>
                            </h1>
                            <?php if($ucourse_create==1) {?>
                            <p class="text-right"><a href="#addcourseModal" role="button" class="btn btn-large btn-primary" data-toggle="modal">New Course</a></p>
                            <?php }?>
                        </div><!-- /.page-header -->
                        <div id="addcourseModal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Add Course</h4>
                                    </div>                                  
                            <form class="form-horizontal" method="post" action="#" enctype="multipart/form-data">                         
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Course Name</label>
                                            <div class="col-md-4">
                                                <input type="text" name="coursename" class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Course Reference</label>
                                            <div class="col-md-4">
                                                <input type="text" name="courseref" class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Course Type</label>
                                            <div class="col-md-4">
                                                <select class="form-control" name="coursetype">
                                                    <option value="Online Training">Online Training</option>
                                                    <option value="Corporate Training">Corporate Training</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Duration</label>
                                            <div class="col-md-4">
                                                <input type="text" name="courseduration" class="form-control">
                                            </div>
                                      </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Rating</label>
                                            <div class="col-md-4">
                                                <input type="text" name="courserating" class="form-control">
                                            </div>
                                      </div>
                                       <div class="form-group">
                                            <label class="control-label col-md-4">Actual Price</label>
                                            <div class="col-md-4">
                                                <input type="text" name="courseactualprice" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Offer Price</label>
                                            <div class="col-md-4">
                                                <input type="text" name="courseofferprice" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Thumbnail</label>
                                            <div class="col-md-4">
                                                <input type="file" name="coursethumbnail">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Note</label>
                                            <div class="col-md-4">
                                                <textarea name="coursenote" class="form-control"></textarea>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-4">Title Tag</label>
                                            <div class="col-md-4">
                                                <textarea name="course_titletag" class="form-control"></textarea>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-4">Meta Description</label>
                                            <div class="col-md-4">
                                                <textarea name="meta_description" class="form-control"></textarea>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-4">Meta Keywords</label>
                                            <div class="col-md-4">
                                                <textarea name="meta_keywords" class="form-control"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="submit" name="addcourse" class="btn btn-primary">Add Course</button>
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
                <th>Reference</th>
                <th>Type</th>
                <th>Rating</th>
                <th>Duration</th>
                <th>Actual Price</th>
                <th>Offer Price</th>
                <th>Status</th>
                <th>Created On</th>
                <th>Modified On</th>
               <th>Edit/Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql_getdata="SELECT * FROM courses WHERE category_id=$getcat";
        $res_getdata=$mysqli->query($sql_getdata);
        while ($row_getdata=$res_getdata->fetch_assoc()) {
            # code...
            ?>
            <tr>
                <td><a href="viewcourse.php?id=<?php echo $row_getdata['course_id']?>"><?php echo $row_getdata['course_name']?></a></td>
                <td><?php echo $row_getdata['course_reference']?></td>
                <td><?php echo $row_getdata['course_type']?></td>
                <td><?php echo $row_getdata['course_rating']?></td>
                <td><?php echo $row_getdata['course_duration']?></td>
                <td><?php echo $row_getdata['course_actual_price']?></td>
                <td><?php echo $row_getdata['course_offer_price']?></td>
                <td><?php echo $row_getdata['course_status']?></td>
                <td><?php echo $row_getdata['course_createdon']?></td>
                <td><?php echo $row_getdata['course_modifiedon']?></td>
                <td><?php if($ucourse_update==1) {?><a href="#edit<?php echo $row_getdata['course_id']?>" data-toggle="modal"><i class="fa fa-pencil-square-o"></i></a><?php } if($ucourse_delete==1) {?>
                <a href="#delete<?php echo $row_getdata['course_id']?>" data-toggle="modal"><i class="fa fa-trash"></i></a>
                <?php }?>
                <div id="delete<?php echo $row_getdata['course_id']?>" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Delete Course</h4>
                                    </div>                                  
                            <form class="form-horizontal" method="post" action="#">                         
                                Delete Course <b><?php echo $row_getdata['course_name']?></b>
                                    <p class="text-primary">Are you sure you want to delete this course?</p>
                                    <input type="hidden" name="courseid" value="<?php echo $row_getdata['course_id']?>">
                                    <input type="hidden" name="delthumbnail" value="<?php echo $row_getdata['course_thumbnail']?>">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="submit" id="deletebtn" name="deletecourse" class="btn btn-primary">Delete course</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>

                  <div id="edit<?php echo $row_getdata['course_id']?>" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Edit Course</h4>
                                    </div>                                  
                          <form class="form-horizontal" method="post" action="#" enctype="multipart/form-data">                         
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Course Name</label>
                                            <div class="col-md-4">
                                                <input type="text" name="coursename" class="form-control" required="" value="<?php echo $row_getdata['course_name']?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Course Reference</label>
                                            <div class="col-md-4">
                                                <input type="text" name="courseref" class="form-control" required="" value="<?php echo $row_getdata['course_reference']?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Course Type</label>
                                            <div class="col-md-4">
                                                <select class="form-control" name="coursetype">
                                                <option selected="" value="<?php echo $row_getdata['course_type']?>"><?php echo $row_getdata['course_type']?></option>
                                                    <option value="Online Training">Online Training</option>
                                                    <option value="Corporate Training">Corporate Training</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Duration</label>
                                            <div class="col-md-4">
                                                <input type="text" name="courseduration" class="form-control" value="<?php echo $row_getdata['course_duration']?>">
                                            </div>
                                      </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4">Rating</label>
                                            <div class="col-md-4">
                                                <input type="text" name="courserating" class="form-control" value="<?php echo $row_getdata['course_rating']?>">
                                            </div>
                                      </div>
                                       <div class="form-group">
                                            <label class="control-label col-md-4">Actual Price</label>
                                            <div class="col-md-4">
                                                <input type="text" name="courseactualprice" class="form-control" value="<?php echo $row_getdata['course_actual_price']?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Offer Price</label>
                                            <div class="col-md-4">
                                                <input type="text" name="courseofferprice" class="form-control" value="<?php echo $row_getdata['course_offer_price']?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Thumbnail</label>
                                            <div class="col-md-4">
                                                <input type="file" name="coursethumbnail">
                                            </div>
                                        </div>
                                        <input type="hidden" name="oldthumbnail" value="<?php echo $row_getdata['course_thumbnail']?>">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Note</label>
                                            <div class="col-md-4">
                                                <textarea name="coursenote" class="form-control"><?php echo $row_getdata['course_note']?></textarea>
                                            </div>
                                        </div>
                                          <div class="form-group">
                                            <label class="control-label col-md-4">Title Tag</label>
                                            <div class="col-md-4">
                                                <textarea name="course_titletag" class="form-control">
                                                    <?php echo $row_getdata['course_titletag']?>
                                                </textarea>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-4">Meta Description</label>
                                            <div class="col-md-4">
                                                <textarea name="meta_description" class="form-control">
                                                  <?php echo $row_getdata['meta_description']?>
                                                </textarea>
                                                
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-4">Meta Keywords</label>
                                            <div class="col-md-4">
                                                <textarea name="meta_keywords" class="form-control">
                                                    <?php echo $row_getdata['meta_keywords']?>
                                                </textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4">Status</label>
                                            <div class="col-md-4">
                                                <select class="form-control" name="status">
                                                    <option selected="" value="<?php echo $row_getdata['course_status']?>"><?php echo $row_getdata['course_status']?></option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                    <input type="hidden" name="courseid" value="<?php echo $row_getdata['course_id']?>">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="submit" name="editcourse" class="btn btn-primary">Edit Course</button>
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
                "order": [[ 8, "desc"]],
            });
            } );
    
        </script>
        
        <!-- page specific plugin scripts -->
        <?php include('templates/JSpsDashboard.php');?>
        <!-- inline scripts related to this page -->
        <?php include('templates/JSisDashboard.php');?>            <?php include('templates/footer.php');?>

    </body>
</html>