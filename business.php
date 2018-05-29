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
  <h2 class="text-center">For Business</h2>
</p>
  <img src="assets/img/for-business.jpg" style="border:30px solid #fff;border-top:0px;height:50%;width:50%;float: right;">

<p>     
     We would like a support from a 3rd Party to deliver their deliverables. We help your students or organization to groom themselves into professionals by supporting them in their job. We impart knowledge in a practical way and make the resource understand the work flow and technology and learn skills of the job. We help the students for Job retention and the company on employee retention.
     </p>
     <p>
We master in Quick fix for that disastrous moment and also to mentor the resource to nurture into a Professional on-the job training and support. We understand the employer’s expectation on the resource and the resource capability to deliver.
</p>
<p>
Always there to provide you help and support in case you have a query.
</p></div>

<div class="col-md-offset-2 col-md-8">
<form class="form form-horizontal"  method="post" action="#">
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
    <button class="btn btn-primary" type="submit" name="enquirybtn">Enquire</button>
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
                <h4 class="modal-title">Thank you for business request</h4>
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
  $message=$_POST['message'];
  $name=$_POST['name'];
  $email=$_POST['email'];
  $phone=$_POST['phone'];
  $api_url = 'http://www.selfpacedtech.com/services/api.php/business_requests'; // api url
/*create data array*/
$data = array(
        'message' => $message,
        'contact_name' => $name,
        'contact_email' => $email,
        'contact_phone' => $phone
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
