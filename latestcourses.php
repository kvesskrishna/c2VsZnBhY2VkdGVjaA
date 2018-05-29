<?php 
include_once('currencyConversion.php');

require_once('setCurrency.php');
?>
 <div class="container">
	<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<header class="section-header">
            <span>Courses</span>
            <h2>Booming Today</h2>
            </header>
	</div>
		
		<?php
            $api_call= 'http://www.selfpacedtech.com/services/api/courses?transform=1&order=course_createdon,desc&page=1,4';
 $curl = curl_init();
          curl_setopt_array($curl, 
            array(
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
            
 ?>
 			 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12?>" style="height: 300px">
            <div class="my-list">
              <img class="topcourseimg" src="assets/img/topcourses/<?php echo $course->course_thumbnail?>" alt="<?php echo $course->course_name?>" />
              <h3 style="height: 50px"><?php echo $course->course_name?></h3>
              <span><?php echo $course->course_type?></span><br>
              <span class="pull-left" style="text-decoration: line-through;"><?php echo $curr_symbol." ".currencyConverter('USD', $currency , $course->course_actual_price);?></span>
              <span class="pull-right"><?php echo $curr_symbol." ".currencyConverter('USD',$currency,$course->course_offer_price)?></span>
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
    <script type="text/javascript">
  $.fn.stars = function() {
        return $(this).each(function() {

            var rating = $(this).data("rating");

            var numStars = $(this).data("numStars");

            var fullStar = new Array(Math.floor(rating + 1)).join('<i class="fa fa-star"></i>');

            var halfStar = ((rating%1) !== 0) ? '<i class="fa fa-star-half-empty"></i>': '';

            var noStar = new Array(Math.floor(numStars + 1 - rating)).join('<i class="fa fa-star-o"></i>');

            $(this).html(fullStar + halfStar + noStar);

        });
    }

    $('.stars').stars();
</script>