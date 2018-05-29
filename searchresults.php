<?php 
session_start();
include_once('header.php');
$coursesearch=urlencode($_POST['coursesearch']);
$coursetype=urlencode($_POST['coursetype']);
?>
<body class="nav-on-header smart-nav" ng-app="selfpacedtech">
<?php include_once('analytictracker.php');?>

  <!-- Navigation bar -->
    <?php include_once('nav.php');?>
  <!-- END Navigation bar -->
<div style="height: 120px;background-color: #333"></div>
<main>

<div class="container-fluid">
<div class="row">
  <div class="col-md-12">
    <ol class="breadcrumb" id="sptbreadcrumb">
  <li class="breadcrumb-item"><a href="home">Home</a></li>
  <li class="breadcrumb-item active"><a href="courses">Courses</a></li>
  <li class="breadcrumb-item" id="coursecat">Results for '<?php echo $coursesearch." - ".urldecode($coursetype) ?>'</li>
</ol>
  </div>
</div>
  <div class="row">
   
    <div class="col-md-8 col-md-offset-2 well" id="cat-courses">
    <?php
          $curl = curl_init();
          curl_setopt_array($curl, 
            array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://www.selfpacedtech.com/services/api/courses?transform=1&filter[]=course_status,eq,Active&filter[]=course_name,cs,'.$coursesearch.'&filter[]=course_type,eq,'.$coursetype,
            CURLOPT_USERAGENT => 'Get courses from api'
            ));
          $resp = curl_exec($curl);
          curl_close($curl);
          $response= json_decode($resp);
          if(empty($response)) echo "No Courses Match your criteria";
          $courses = $response->courses;
          foreach ($courses as $course) 
          {
            ?>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12?>" style="height: 300px">
            <div class="my-list">
              <img class="topcourseimg" src="assets/img/topcourses/<?php echo $course->course_thumbnail?>" alt="<?php echo $course->course_name?>" />
              <h3 style="height: 50px"><?php echo $course->course_name?></h3>
              <span><?php echo $course->course_type?></span><br>
              <span class="pull-left" style="text-decoration: line-through;">&#8377; <?php echo $course->course_actual_price?></span>
              <span class="pull-right">&#8377; <?php echo $course->course_offer_price?></span>
               <div class="offer">
              Rating: 
              <span style="color:orange;font-size: 16px;" class="stars" data-rating="<?php echo  $course->course_rating?>" data-num-stars="5" ></span>
              </div>
              <div class="detail">
                <p>Get trained by expert professionals and master the concepts.</p>
                <img class="topcourseimg" src="assets/img/topcourses/<?php echo $course->course_thumbnail?>" alt="<?php echo $course->course_name?>" /><br>&nbsp;<br>
                <a href="training-<?php echo urlencode($course->course_reference)?>" class="btn btn-warning btn-sm">More</a>
              </div>
            </div>
          </div>
            <?php
          }
        ?>
    
    </div>
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


  </body>
</html>