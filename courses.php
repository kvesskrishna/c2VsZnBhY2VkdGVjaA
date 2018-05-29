<?php 
session_start();
include_once('header.php');?>
<body class="nav-on-header smart-nav" ng-app="selfpacedtech">
<?php include_once('analytictracker.php');?>

  <!-- Navigation bar -->
    <?php include_once('nav.php');?>
  <!-- END Navigation bar -->
<div style="height: 120px;background-color: #333"></div>
<main>

<div class="container-fluid">
<div class="row">
  <div class="col-md-6">
    <ol class="breadcrumb" id="sptbreadcrumb">
  <li class="breadcrumb-item"><a href="home">Home</a></li>
  <li class="breadcrumb-item active"><a href="courses">Courses</a></li>
  <li class="breadcrumb-item" id="coursecat">All Courses</li>
</ol>
  </div>
  <div class="col-md-6" id="currencyselector">
        <form class="form-horizontal">
        <div class="form-group">
        <label class="control-label col-md-8">Select Currency</label>
        <div class="col-md-4">
          <select id="currency" class="form-control" current-currency="USD" current-category="all">
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

</div>
  <div class="row">
    <div class="col-md-3 well">
     
      <div class="list-group " id="course-categories">
        <?php
          $curl = curl_init();
          curl_setopt_array($curl, 
            array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://www.selfpacedtech.com/services/api/course_categories?transform=1&order=category_name,asc&filter=category_status,eq,Active',
            CURLOPT_USERAGENT => 'Get course categories from api'
            ));
          $resp = curl_exec($curl);
          curl_close($curl);
          $response= json_decode($resp);
          $categories = $response->course_categories;

          foreach ($categories as $category) 
          {
            ?>
            <a class="list-group-item category-button" href="#" course-category="<?php echo $category->category_id?>"><?php echo $category->category_name?></a>
            <?php
          }
        ?>
        </div>
    </div>
<div class="loading" style="display: none">Loading&#8230;</div>
    <div class="col-md-9 well" id="cat-courses">
   <img src="assets/img/leftarrow.gif" style="height: 50px;width: 100px"> Select Category
  </div>
</div>

      <!-- Newsletter -->
        <?php include_once('newsletter.php');?>
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

<script type="text/javascript">
  $(document).ready(function(){
    var catcat=$('#currency').attr('current-category');
    if (catcat=='all') {
      $('#currencyselector').hide();
    }
  });
</script>
  </body>
</html>