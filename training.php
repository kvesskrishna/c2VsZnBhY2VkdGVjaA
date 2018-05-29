<?php
session_start();
$courseref=$_GET['course'];
$api_call= 'http://www.selfpacedtech.com/services/api/courses?transform=1&filter=course_reference,eq,'.$courseref;
 $curl = curl_init();
 curl_setopt_array($curl, array(
 		    CURLOPT_RETURNTRANSFER => 1, 
            CURLOPT_URL => $api_call,
            CURLOPT_USERAGENT => 'Get courses from api'
            ));
$resp = curl_exec($curl);
curl_close($curl);
$response= json_decode($resp);
$courses = $response->courses;
foreach ($courses as $course) 
  { 
  	$courseid=$course->course_id;
  	$course_name=$course->course_name;
  	$categoryid=$course->category_id;
  	$thumbnail=$course->course_thumbnail;
  	$coursenote=$course->course_note;
    $prerequisites=$course->course_prerequisites;
    $courseduration=$course->course_duration;
    $course_actualprice=$course->course_actual_price;
    $course_offerprice=$course->course_offer_price;
    $course_titletag=$course->course_titletag;
    $meta_description=$course->meta_description;
    $meta_keywords=$course->meta_keywords;

  }
$api_call= 'http://www.selfpacedtech.com/services/api/course_categories?transform=1&filter=category_id,eq,'.$categoryid;
 $curl = curl_init();
 curl_setopt_array($curl, array(
 		    CURLOPT_RETURNTRANSFER => 1, 
            CURLOPT_URL => $api_call
            ));
$resp = curl_exec($curl);
curl_close($curl);
$response= json_decode($resp);
$categories = $response->course_categories;
foreach ($categories as $category) 
  {
  	$category_name=$category->category_name;
  }
include_once('trainingheader.php');?>
<body class="nav-on-header smart-nav" data-spy="scroll" data-target="#myScrollspy">
<?php include_once('analytictracker.php');?>

<style type="text/css">
/* Custom Styles */
body{
	position: relative; /* required */
}
ul.nav-tabs {
	width: 100px;
	margin-top: 20px;
	border-radius: 4px;
    background: #fff;
    z-index: 999;
	border: 1px solid #ddd;
	box-shadow: 0 1px 4px rgba(0, 0, 0, 0.067);
	font-size: 13px;
}
ul.nav-tabs li {
	margin: 0;
	border-top: 1px solid #ddd;
}
ul.nav-tabs li:first-child {
	border-top: none;
}
ul.nav-tabs li a {
	margin: 0;
	padding: 8px 16px;
	border-radius: 0;
}
ul.nav-tabs li.active a, ul.nav-tabs li.active a:hover {
	color: #fff;
	background: #0088cc;
	border: 1px solid #0088cc;
}
ul.nav-tabs li:first-child a {
	border-radius: 4px 4px 0 0;
}
ul.nav-tabs li:last-child a {
	border-radius: 0 0 4px 4px;
}
ul.nav-tabs.affix {
	top: 50px; /* set the top position of pinned element */
}
@media screen and (min-width: 992px) and (max-width: 1199px){
    ul.nav-tabs{
        width: 100px; /* set nav width on medium devices */
    }
}
@media screen and (min-width: 1200px){
    ul.nav-tabs{
        width: 100px; /* set nav width on large devices */
    }
}
div.affix {
    top:0px;
    right:0;
    position:fixed;
}
</style>
  <!-- Navigation bar -->
    <?php include_once('nav.php');?>
  <!-- END Navigation bar -->
<div style="height: 120px;background-color: #333"></div>
<main>
<?php
 include_once('currencyConversion.php');

require_once('setCurrency.php');
?>
<div class="container-fluid">
<div class="row">
  <div class="col-md-12">
    <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="home">Home</a></li>
  <li class="breadcrumb-item"><a href="courses">Courses</a></li>
  <li class="breadcrumb-item active"><?php echo $category_name." > ".$course_name;?></li>
</ol>
  </div>
</div>

<div class="row" >
<div style="z-index: 1;background-color: #fff;" class="col-md-12" data-spy="affix" data-offset-top="197">
	<p class="snip1562"><?php echo $course_name?><span class="pull-right">Course Duration: <?php echo $courseduration?></span></p>
</div>
	<div class="col-md-12 text-center" id="coursenote">
  <p><i class="fa fa-quote-left"></i><em>Selfpaced Tech is the leader in <?php echo $course_name?> online training courses. We provide quality of online training and corporate training courses by real time faculty and well trained software specialists. Our <?php echo $course_name?>  online training is regarded as the best training by students who attended <?php echo $course_name?> online training with us. All our students were happy and able to find Jobs quickly in India, Singapore, Japan, Europe, Canada, Australia, USA and UK. We provide <?php echo $course_name?> online training in India, UK, USA, Singapore and Canada etc..</em></p>
		
	</div>
<div class="loading" style="display: none">Loading&#8230;</div>
	<div class="col-md-2">
		<img src="assets/img/topcourses/<?php echo $thumbnail?>" class="img-responsive"><br>
		<small>Rating:</small> 
              <span style="color:orange;font-size: 16px;" class="stars text-center" data-rating="<?php echo  $course->course_rating?>" data-num-stars="5" ></span> <small><?php echo $course->course_rating?>/5</small>
	</div>
	<div class="col-md-10" id="coursehighlights">
  <h2>Course Description</h2>
	<p><?php echo $coursenote;?></p>
  <p class="pull-left h3"><span id="courseprices">Course Price: <small style="text-decoration: line-through;"><?php echo $curr_symbol." ".currencyConverter('USD',$currency,$course_actualprice)?></small> <?php echo $curr_symbol." ".currencyConverter('USD',$currency,$course_offerprice)?></span>
       <span style="display: inline-block;">
          <select id="currency" class="form-control input-sm">
          <option value="USD">US Dollar</option>
          <option value="EUR">Euros</option>
          <option value="AUD">Australian Dollar</option>
          <option value="CAD">Canadian Dollar</option>
          <option value="MYR">Malaysian Ringett</option>
          <option value="SGD">Singapore Dollar</option>
          <option value="INR">Indian Rupee</option>
          </select>
          </span>
        </p>
        <span class="hidden" id="actualprice"><?php echo $course_actualprice?></span>
        <span class="hidden" id="offerprice"><?php echo $course_offerprice?></span>

    <div class="col-md-12 text-center">

<a class="snip1544" href="#enrollModal" role="button" data-toggle="modal">Enroll Now</a>
			</div>
	</div>
	
</div>

</div>


<div class="container">
  
    <div class="row">
    
        <div class="col-sm-2" id="myScrollspy">
            <ul class="nav nav-tabs nav-stacked" data-offset-top="420" data-spy="affix">
               
             
             <li class="text-center"><a href="#course-features"><i class="fa fa-hashtag"></i><br>Features</a></li>
             <li class="text-center"><a href="#prerequisites"><i class="fa fa-exclamation"></i><br>Prerequisites</a></li>
               
                <li class="text-center"><a href="#curriculum"><i class="fa fa-asterisk"></i><br>Curriculum</a></li>
              
                <li class="text-center"><a href="#faqs"><i class="fa fa-question"></i><br>FAQs</a></li>
            </ul>
        </div>
        <div class="col-sm-10">
			
			
			<div id="course-features">
				<h2>Features</h2>
				<table class="table">
					<tr>
						<td><img src="assets/icons/desktop.png" style="height: 50px;width: 50px;">
						<span>Live online instructor led sessions by industry veterans.</span>
						</td>
						<td><img src="assets/icons/writing.png" style="height: 50px;width: 50px;">
						<span>Industry renowed training to boost your resume.</span>
						</td>
					</tr>
					<tr>
						<td><img src="assets/icons/ereader-2.png" style="height: 50px;width: 50px;">
						<span>Incredible practicals, workshops, labs, quiz and assignments.</span>
						</td>
						<td><img src="assets/icons/video-chat.png" style="height: 50px;width: 50px;">
						<span>Personalized one to one career discussion with the trainer.</span>
						</td>
					</tr>
					<tr>
						<td><img src="assets/icons/notebook.png" style="height: 50px;width: 50px;">
						<span>Real life case studies and live project to solve real problem </span>
						</td>
						<td><img src="assets/icons/chat.png" style="height: 50px;width: 50px;">
						<span>Mock interview & resume preparation to excel in interviews </span>
						</td>
					</tr>
					<tr>
						<td><img src="assets/icons/library.png" style="height: 50px;width: 50px;">
						<span>Lifetime access to course, recorded sessions and study materials  </span>
						</td>
						<td><img src="assets/icons/audio.png" style="height: 50px;width: 50px;">
						<span>Premium job assistance and support to step ahead in career</span>
						</td>
					</tr>
				</table>
            </div>
			<hr>
			<div id="prerequisites">
      <h2>Prerequisites</h2>
        <p>
          <?php echo $prerequisites?>
        </p>
      </div>
			<div id="curriculum">
				<h2>Curriculum</h2>
<div class="bs-example">
    <div class="panel-group" id="accordion">
<?php
$api_call="http://www.selfpacedtech.com/services/api/course_curriculum?transform=1&filter=course_id,eq,".$courseid;
$curl = curl_init();
          curl_setopt_array($curl, 
            array(
            CURLOPT_RETURNTRANSFER => 1,
            
            CURLOPT_URL => $api_call,
            CURLOPT_USERAGENT => 'Get course curriculum from api'
            ));
          $resp = curl_exec($curl);
          curl_close($curl);
            $response= json_decode($resp);
          $curriculums = $response->course_curriculum;
          foreach ($curriculums as $curriculum) 
          {
?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#curr<?php echo $curriculum->topic_id?>"><span class="glyphicon glyphicon-plus"></span><?php echo $curriculum->topic_title?></a>
                </h4>
            </div>
            <div id="curr<?php echo $curriculum->topic_id?>" class="panel-collapse collapse">
                <div class="panel-body">
                	<?php echo $curriculum->topic_content?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
	</div>
            </div>
			<hr>
			
			<div id="faqs">
				<h2>FAQs</h2>
			<div class="bs-example">
    <div class="panel-group" id="accordion1">
<?php
$api_call="http://www.selfpacedtech.com/services/api/faqs?transform=1&filter[]=faq_status,eq,Active";
$curl = curl_init();
          curl_setopt_array($curl, 
            array(
            CURLOPT_RETURNTRANSFER => 1,
            
            CURLOPT_URL => $api_call,
            CURLOPT_USERAGENT => 'Get faq from api'
            ));
          $resp = curl_exec($curl);
          curl_close($curl);
            $response= json_decode($resp);
          $faqs = $response->faqs;
          foreach ($faqs as $faq) 
          {
?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion1" href="#faq<?php echo $faq->faq_id?>"><span class="glyphicon glyphicon-plus"></span><?php echo $faq->faq_question?></a>
                </h4>
            </div>
            <div id="faq<?php echo $faq->faq_id?>" class="panel-collapse collapse">
                <div class="panel-body">
                  <?php echo $faq->faq_answer?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
  </div>
				
            </div>
			
		</div>
    <div style="z-index: 1;background-color: #d3dfe8;top:90%;padding:5px;" class="col-md-12 text-center" data-spy="affix" data-offset-top="197">
  <img src="assets/img/calendar.png" style="height: 50px;width: 50px;"> Get your batch scheduled at your convenient time. <span class="text-right"><a class="btn btn-primary btn-sm" href="#scheduleModal" role="button" data-toggle="modal">Schedule Now</a></span></p>
</div>
    </div>
</div>

<div id="enrollModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo $course_name?> - Enroll</h4>
            </div>
            <div class="modal-body">
               <form class="form-horizontal" method="post" action="#">
                 <div class="form-group">
                   <label class="control-label col-md-4">Course</label>
                   <div class="col-md-5">
                    <select name="course" class="form-control">
                      <option value="<?php echo $course_name?>" selected><?php echo $course_name?></option>
                              <?php
                              require_once('admin/dbconfig.php');
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
                   <label class="control-label col-md-4">Name </label>
                   <div class="col-md-5">
                     <input type="text" name="name" class="form-control" required="">
                   </div>
                 </div>
                 <div class="form-group">
                   <label class="control-label col-md-4">Email</label>
                   <div class="col-md-5">
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
                   <div class="col-md-5">
                    <input type="number" name="phone" class="form-control" required="">
                   </div>
                 </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" name="enrollbtn" class="btn btn-success">Enroll Request</button>
                               </form>

            </div>
        </div>
    </div>
</div>

<div id="scheduleModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo $course_name?> - Request Schedule</h4>
            </div>
            <div class="modal-body">
               <form class="form-horizontal" method="post" action="#">
                 <div class="form-group">
                   <label class="control-label col-md-4">Course</label>
                   <div class="col-md-5">
                     <select name="course" class="form-control">
                      <option value="<?php echo $course_name?>" selected><?php echo $course_name?></option>
                              <?php
                              require_once('admin/dbconfig.php');
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
                   <label class="control-label col-md-4">Name </label>
                   <div class="col-md-5">
                     <input type="text" name="name" class="form-control" required="">
                   </div>
                 </div>
                 <div class="form-group">
                   <label class="control-label col-md-4">Email</label>
                   <div class="col-md-5">
                     <input type="email" name="email" class="form-control" required="">
                   </div>
                 </div>
                 <div class="form-group">
                   <label class="control-label col-md-4">Phone</label>
                   <div class="col-md-5">
                     <input type="number" name="phone" class="form-control" required="">
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
                   <label class="control-label col-md-4">Preferred Time</label>
                   <div class="col-md-5">
                     <input type="text" name="preferredtime" class="form-control" required="" placeholder="Ex: 7:00 AM to 9:00 AM">
                   </div>
                 </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" name="schedulebtn" class="btn btn-success">Request Schedule</button>
                               </form>

            </div>
        </div>
    </div>
</div>
<div id="thankyouModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Thank you for enrollment/schedule request</h4>
            </div>
            <div class="modal-body">
              <center>We have received your request. Our representative will get back to you shortly.<br>
              You can also reach us at +1 209-207-3043 or 
              write to <a href="mailto:queries@selfpacedtech.com">queries@selfpacedtech.com</a></center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Continue</button>                            
            </div>
        </div>
    </div>
</div>


      <!-- Newsletter -->
        <?php //include_once('newsletter.php');?>
      <!-- END Newsletter -->
  
    <!-- END Main container -->


    <!-- Site footer -->
      <?php include_once('sitefooter.php');?>
    <!-- END Site footer -->

    <!-- Back to top button -->
    <a id="scroll-up" href="#"><i class="ti-angle-up"></i></a>
    <!-- END Back to top button -->

    <!-- Scripts -->
      <script src="assets/js/app.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
            <script src="assets/js/custom.js"></script>

      <script src="assets/js/filter-gallery.js"></script>
<script>
    $(document).ready(function(){
        // Add minus icon for collapse element which is open by default
        $(".collapse.in").each(function(){
        	$(this).siblings(".panel-heading").find(".glyphicon").addClass("glyphicon-minus").removeClass("glyphicon-plus");
        });
        
        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
        	$(this).parent().find(".glyphicon").removeClass("glyphicon-plus").addClass("glyphicon-minus");
        }).on('hide.bs.collapse', function(){
        	$(this).parent().find(".glyphicon").removeClass("glyphicon-minus").addClass("glyphicon-plus");
        });
        $('#currency').change(function(){
          $('.loading').show();
          var currency=$(this).val();
          var actualprice=$('#actualprice').text();
          var offerprice=$('#offerprice').text();
          $.post('trainingpageprices.php',{currency:currency,actualprice:actualprice,offerprice:offerprice},function(data){
            $('#courseprices').html(data);
            $('.loading').hide();
          });

        });
    });
 
</script>
<?php 
if (isset($_POST['enrollbtn'])) {
  # code...
  $course=$_POST['course'];
  $name=$_POST['name'];
  $email=$_POST['email'];
  $phone=$_POST['phone'];
  $timezone=$_POST['timezone'];

  $api_url = 'http://www.selfpacedtech.com/services/api.php/enroll_requests'; // api url
/*create data array*/
$data = array(
        'en_course' => $course,
        'en_name' => $name,
        'en_email' => $email,
        'en_phone' => $phone,
        'en_timezone' => $timezone,

);                   
/*create data array end*/
$data_string = json_encode($data); // convert to json and assign to variable                                                                                         
/*curl handle*/
$ch = curl_init($api_url);  
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                            
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                          
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                       
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_string)));       
$result = curl_exec($ch);
curl_close($ch);
/*curl handle end*/
//mail to user
$to = $email;

$subject = 'Thankyou for '.$course.' Enrollment Request at Selfpacedtech';

$message = '<html><body>';

$message .= '<h1 style="color:#f40;">Hi '.$name.'!</h1>';

$message .= '<p style="color:#080;font-size:18px;">Thanks for your interest in enrolling for '.$course.' with Selfpacedtech, we have received your request, we will get back to you shortly.</p>
<p>
Training Team,<br>
Selfpacedtech.
</p>
';
$message .= '</body></html>';

//mail to admin
$to1 = 'training@selfpacedtech.com';

$subject1 = $course.' Enrollment Request at Selfpacedtech';
 

// Compose a simple HTML email message

$message1 = '<html><body>';

$message1 .= '<h1 style="color:#f40;">Hi Admin!</h1>';

$message1 .= '<p style="color:#080;font-size:18px;">There is an interest in enrolling for '.$course.' with Selfpacedtech, we have received a request, get back to them immediately. Details are below
<br>Name: '.$name.'
<br>Course: '.$course.'
<br>Timezone: '.$timezone.'
<br>Email: '.$email.'
<br>Phone: '.$phone.'
</p>
<p>
Training Team,<br>
Selfpacedtech.
</p>
';
$message1 .= '</body></html>';


// Sending email
require_once 'assets/PHPMailer/SMTPMailer.php';
  SMTPMailer($to, $subject,$message);
  SMTPMailer($to1, $subject1,$message1);


  echo "<script>
         $('document').ready(function(){
             $('#thankyouModal').modal('show');
         });
    </script>";   //result


}

if (isset($_POST['schedulebtn'])) {
  # code...
  $course=$_POST['course'];
  $name=$_POST['name'];
  $email=$_POST['email'];
  $phone=$_POST['phone'];
  $timezone=$_POST['timezone'];
  $preferredtime=$_POST['preferredtime'];
  $api_url = 'http://www.selfpacedtech.com/services/api.php/schedule_requests'; // api url
/*create data array*/
$data = array(
        'sch_course' => $course,
        'sch_name' => $name,
        'sch_email' => $email,
        'sch_phone' => $phone,
        'sch_timezone' => $timezone,
        'sch_time' => $preferredtime
);                   
/*create data array end*/
$data_string = json_encode($data); // convert to json and assign to variable                                                                                         
/*curl handle*/
$ch = curl_init($api_url);  
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                            
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                          
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                       
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_string)));       
$result = curl_exec($ch);
curl_close($ch);
/*curl handle end*/
//mail to user
$to = $email;

$subject = 'Thankyou for '.$course.' Schedule Request at Selfpacedtech';

$from = 'training@selfpacedtech.com';
 

// Compose a simple HTML email message

$message = '<html><body>';

$message .= '<h1 style="color:#f40;">Hi '.$name.'!</h1>';

$message .= '<p style="color:#080;font-size:18px;">Thanks for your interest in schedule request for '.$course.' with Selfpacedtech, we have received your request, we will get back to you shortly.</p>
<p>
Training Team,<br>
Selfpacedtech.
</p>
';
$message .= '</body></html>';

//mail to admin
$to1 = 'training@selfpacedtech.com';

$subject1 = $course.' Schedule Request at Selfpacedtech';

$from1 = 'training@selfpacedtech.com';

// To send HTML mail, the Content-type header must be set

// Compose a simple HTML email message

$message1 = '<html><body>';

$message1 .= '<h1 style="color:#f40;">Hi Admin!</h1>';

$message1 .= '<p style="color:#080;font-size:18px;">There is an interest in schedule request for '.$course.' with Selfpacedtech, we have received a request, get back to them immediately. Details are below
<br>Name: '.$name.'
<br>Course: '.$course.'
<br>Timezone: '.$timezone.'
<br>Email: '.$email.'
<br>Phone: '.$phone.'
<br>Preferred Time: '.$preferredtime.'

</p>
<p>
Training Team,<br>
Selfpacedtech.
</p>
';
$message1 .= '</body></html>';


// Sending email

require_once 'assets/PHPMailer/SMTPMailer.php';
  SMTPMailer($to, $subject,$message);
  SMTPMailer($to1, $subject1,$message1);

  echo "<script>
         $('document').ready(function(){
             $('#thankyouModal').modal('show');
         });
    </script>";   //result

}
?>
  </body>
</html>