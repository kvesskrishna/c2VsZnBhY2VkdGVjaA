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
        <h2 class="text-center">Our Demo Sessions</h2>
        <hr>
        <div class="col-md-12">
          <div class="col-md-6">
            <iframe width="100%" height="350" src="https://www.youtube.com/embed/WZzE5o0VsMo" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
          </div>

          <div class="col-md-6">
            <iframe width="100%" height="350" src="https://www.youtube.com/embed/ClBnIFU49iw" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
          </div>

        </div>

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
