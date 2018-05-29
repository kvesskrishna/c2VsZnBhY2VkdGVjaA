<?php 
session_start();
include_once('header.php');?>
<body class="nav-on-header smart-nav">
<?php include_once('analytictracker.php');?>
  <!-- Navigation bar -->
    <?php include_once('nav.php');?>
  <!-- END Navigation bar -->
  
  <div style="background-color: black;height: 100px;">
</div>
  <!-- Main container -->
    <main>
      <!-- For Business -->
<div class="container">
<div style="color:black;font-size: 14px;margin-top: 50px;">
<p>
  <h2 class="text-center">Become an Instructor</h2>

</p>
  <img src="assets/img/become-an-instructor.jpg" style="border:30px solid #fff;border-top:0px;height:50%;width:50%;float: right;">
<p>     
     Do you have strong basic crochet or knitting technique skills? Do you enjoy teaching others? If you answered yes to these questions, then you are on a roll .
     <p>
Self paced tech is always looking for the best and the brightest to join the ranks of our world class cadre of instructors. Becoming a Self paced tech instructor is an honor reserved for those who exhibit consistent excellence in the classroom, both with their technical expertise and the way they interact with and impact the student. Whether you are just starting out or have some experience we invite you to consider starting your journey with Self paced tech. </p><p>
Upon entering the program, we assess your individual situation and experience to help build a plan to see you succeed, including Mentor multi-week format, travelling to teach Community Self paced tech events or attending regional conferences. Applications are accepted online below or email us at for more info.
</p></div>

<div class="col-md-offset-2 col-md-8">
<form class="form form-horizontal"  method="post" action="#" enctype="multipart/form-data">
  <div class="form-group">
  <label class="control-label col-md-4">Name</label>
  <div class="col-md-4">
    <input type="text" name="name" class="form-control" placeholder="Name" required="">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-md-4">Email</label>

  <div class="col-md-4">
    <input type="email" name="email" class="form-control" placeholder="Email" required="">
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-md-4">Phone</label>

  <div class="col-md-4">
    <input type="number" name="phone" class="form-control" placeholder="Phone" required="">
  </div>
  </div>
<div class="form-group">
  <label class="control-label col-md-4">Message</label>

  <div class="col-md-4">
  <textarea class="form-control" name="message" placeholder="Message"></textarea>
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-md-4">CV/Resume</label>

  <div class="col-md-4">
    <input type="file" name="resume">
  </div>
  </div>

  <div class="col-md-offset-4 col-md-4">
    <button class="btn btn-primary" type="submit" name="enquirybtn">Apply</button>
  </div>
</form>
</div>
</div>
      

      <!--Testimonial carousel-->
        <?php include_once('testimonials.php');?>
      <!--End Testimonial carousel-->
      
      <!--client carousel-->
        <?php include_once('clientslider.php');?>
      <!--End client carousel-->

      <!--partner carousel-->
        <?php //include_once('partnerslider.php');?>
      <!--End partner carousel-->

      <!-- Newsletter -->
        <?php include_once('newsletter.php');?>
      <!-- END Newsletter -->
      
    </main>
    <!-- END Main container -->


    <!-- Site footer -->
      <?php include_once('sitefooter.php');?>
    <!-- END Site footer -->

    <!-- Back to top button -->
    <a id="scroll-up" href="#"><i class="ti-angle-up"></i></a>
    <!-- END Back to top button -->
<div id="thankyouModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Thank you for your interest to join as instructor with us.</h4>
            </div>
            <div class="modal-body">
              <center>Our representative will get back to you shortly.<br>
              You can also reach us at +1 209-207-3043 or 
              write to <a href="mailto:queries@selfpacedtech.com">queries@selfpacedtech.com</a></center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Continue</button>                            
            </div>
        </div>
    </div>
</div>
    <!-- Scripts -->
      <script src="assets/js/app.min.js"></script>
      <script src="assets/js/custom.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
     
      <script type="text/javascript">
  $(document).ready(function(){
    $('#customertestimonials div').first().addClass('active');
    $('#testindicators li').first().addClass('active');

  });
</script>
  </body>
</html>
<?php 
if (isset($_POST['enquirybtn'])) {
  # code...

if(isset($_FILES['resume'])){
      $errors= array();
      $file_name = time().$_FILES['resume']['name'];
      $file_size = $_FILES['resume']['size'];
      $file_tmp = $_FILES['resume']['tmp_name'];
      $file_type = $_FILES['resume']['type'];
      $file_ext=pathinfo($_FILES["resume"]["name"])['extension'];


      
      $expensions= array("doc","docx","pdf");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a doc,docx,pdf file.";
      }
      
      if($file_size > 4097152) {
         $errors[]='File size must be less than 4 MB';
      }
      
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"instructors/resumes/".$file_name);
         $resume=$file_name;
      }else{
         print_r($errors);
      }
   }


  $message=$_POST['message'];
  $name=$_POST['name'];
  $email=$_POST['email'];
  $phone=$_POST['phone'];
  $api_url = 'http://www.selfpacedtech.com/services/api.php/instructor_applications'; // api url
/*create data array*/
$data = array(
        'message' => $message,
        'contact_name' => $name,
        'contact_email' => $email,
        'contact_phone' => $phone,
        'resume'=>$resume
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
echo "<script>
         $('document').ready(function(){
             $('#thankyouModal').modal('show');
         });
    </script>";   //result
}
