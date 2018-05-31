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

<div class="row">
  <h2 class="text-center">Learning Managment System</h2>
  <hr>

  <img src="assets/img/lms.png" style="border:30px solid #fff;border-top:0px;height:50%;width:50%;float: right;">
 <p>     
     Get lifetime access to entire course content including notes and assignments<br> 
       </p>
       <p>
        <ul style="list-style: none;">
<li>ALL OF YOUR LEARNING UNDER ONE ROOF</li><br>

<li>REAL-TIME ACCESS ANYTIME, ANYWHERE USING LMS</li><br>

     </ul></p>
  
</div>

</div>
      

     
          
    </main>
    <!-- END Main container -->


    <!-- Site footer -->
      <?php include_once('sitefooter.php');?>
    <!-- END Site footer -->

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
