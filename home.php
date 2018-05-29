<?php 
session_start();
include_once('header.php');?>
<body class="nav-on-header smart-nav">
<?php include_once('analytictracker.php');?>
  <!-- Navigation bar -->
    <?php include_once('nav.php');?>
  <!-- END Navigation bar -->
  
  <!-- Site header -->
    <?php include_once('sitehead.php');?>
  <!-- END Site header -->

  <!-- Main container -->
    <main>
      <!-- Top courses -->
      <div class="col-md-12" style="margin-top: 20px;">
        <div class="col-md-6 col-md-offset-6">
        <form class="form-horizontal">
        <div class="form-group">
        <label class="control-label col-md-8">Select Currency</label>
        <div class="col-md-4">
          <select id="currency" class="form-control">
          <option value="USD">US Dollar</option>
          <option value="EUR">Euros</option>
          <option value="AUD">Australian Dollar</option>
          <option value="CAD">Canadian Dollar</option>
          <option value="MYR">Malaysian Ringett</option>
          <option value="SGD">Singapore Dollar</option>
          <option value="INR">Indian Rupee</option>
          </select>
          </div>
          </div>
          </form>
        </div>
              <div class="loading" style="display: none">Loading&#8230;</div>

      </div>

      <div id="topcourses">

        <?php include_once('topcourses.php');?>
        </div>
      <!-- End Top courses -->

      <!-- Latest courses -->
      <div id="latestcourses">

        <?php include_once('latestcourses.php');?>
        </div>
      <!-- End latest courses -->

      <!-- Metric Strip -->
        <?php include_once('metricstrip.php');?>
      <!-- END Metric Strip -->

      <!-- How it works -->
        <?php include_once('howitworks.php');?>
      <!-- END How it works -->

      <!-- highlights -->
        <?php include_once('highlights.php');?>
      <!-- END highlights -->

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

    <!-- Scripts -->
      <script src="assets/js/app.min.js"></script>
      <script src="assets/js/custom.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <script type="text/javascript">
        $(document).ready(function(){
          $('#currency').change(function(){
            $('.loading').show();
            var currency=$(this).val();
            $.post('topcourses.php',{currency:currency},function(data){
              $('#topcourses').html(data);
              $('.loading').show();
              $.post('latestcourses.php',{currency:currency},function(data2){
                $('#latestcourses').html(data2);
                              $('.loading').hide();

              });
            });
          });
        });
      </script>
      <script type="text/javascript">
  $(document).ready(function(){
    $('#customertestimonials div').first().addClass('active');
    $('#testindicators li').first().addClass('active');

  });
</script>
  </body>
</html>