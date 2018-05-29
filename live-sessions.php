<?php 
session_start();
include_once('header.php');?>
<body class="nav-on-header smart-nav">
<?php include_once('analytictracker.php');?>
  <!-- Navigation bar -->
    <?php include_once('nav.php');?>
    <div style="background-color: black;height: 100px;">
</div>
  
  <!-- END Navigation bar -->
  
  <!-- Main container -->
    <main>
      <!-- For Business -->
<div class="container">
<div class="row">
  <h2 class="text-center">Live Session</h2>
  <hr>

  <img src="assets/img/livesessions.png" alt="Live sessions on SelfPacedTech" style="border:30px solid #fff;border-top:0px;height:50%;width:50%;float: right;" class="img-responsive">
 <p>     
     Learn on the go, Anywhere, Anytime as per your choise right on your computer screen.<br>
     You directly learn and interact with a live expert instructor, the same as you do if you attended a physical classroom training. 
       </p>
       <p>
        <ul style="list-style: none;">
<li>Live Online Sessions –
Live Interactive Sessions, Step-by-step live demonstrations.</li><br>

<li>Learn from the Experts –
Expert who has tremendous industry experience.</li><br>

<li>Learn Anywhere –
At your comfort, learn from your home or work place. Save tavelling time.</li><br>

<li>Missed a class? Not an issue –
Every session will be recorded and will be mailed to you soon after session.</li>
     </ul></p>
  

</div>
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
