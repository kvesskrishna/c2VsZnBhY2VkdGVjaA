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
  <h2 class="text-center">Contact Us</h2>
</p>
</div>
<div class="col-md-6"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2375.7695202128884!2d-113.38601668464777!3d53.454706174290926!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x53a0199d991ef077%3A0x268caf3c8a7e8236!2sSelfpaced+Tech!5e0!3m2!1sen!2sin!4v1508307733941" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>

<div class="col-md-6">
<p class="text-center">
  <h4>Location</h4><br>
  3004, 24 Ave, <br>
  Edmonton, Alberta, T6T0G7,<br> 
  Canada, 416-834-6577
</p>
</div>

<div class="col-md-offset-2 col-md-8">
<form class="form form-horizontal"  method="post" action="postContact" enctype="multipart/form-data">
<h6 class="text-center">In case of any queries or requirements, please write to us, we will get back to you</h6>
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

  <div class="col-md-offset-4 col-md-4">
    <button class="btn btn-primary" type="submit" name="contactbtn">Contact</button>
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
                <h4 class="modal-title">Thank you for your interest with us.</h4>
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


if (isset($_SESSION['success'])) {
  echo "<script>
         $('document').ready(function(){
             $('#thankyouModal').modal('show');
         });
    </script>";   //result
unset($_SESSION['success']);
}



