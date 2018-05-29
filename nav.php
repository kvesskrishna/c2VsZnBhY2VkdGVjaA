<nav class="navbar navbar-default">
    <div class="navbar-header">
    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  <a class="navbar-brand" href="home"><img src="assets/img/logo.png"></a>
  </div>
  
  <div class="collapse navbar-collapse js-navbar-collapse">
   <ul class="nav navbar-nav navbar-right">
                <li><a href="#" target="_blank" style="color:#ddd">Login</a></li>
                <li><a href="#" target="_blank" style="color:#ddd">Register</a></li>


            </ul>
    <ul class="nav navbar-nav">
     <li class="dropdown dropdown-large">
        <a href="business">For Business</a>
      </li>
     
      <li class="dropdown dropdown-large">
        <a href="courses" class="dropdown-toggle" data-toggle="dropdown">Courses <b class="caret"></b></a>
        
        <ul class="dropdown-menu dropdown-menu-large row">

        <?php
         $curl = curl_init();
          curl_setopt_array($curl, 
            array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://www.selfpacedtech.com/services/api/course_categories?transform=1&filter=category_status,eq,active&order=category_name,asc',
            CURLOPT_USERAGENT => 'Get categories from api'
            ));
          $resp = curl_exec($curl);
          curl_close($curl);
            $response= json_decode($resp);
          $categories = $response->course_categories;
          foreach ($categories as $category) 
          {
?>
<li class="col-sm-2" style="height: 200px;">
  <ul>
    <li class="dropdown-header"><?php echo $category->category_name?></li>
    <?php
    $curl = curl_init();
          curl_setopt_array($curl, 
            array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://www.selfpacedtech.com/services/api/courses?transform=1&order=course_name,asc&page=1,3&filter=category_id,eq,'.$category->category_id,
            CURLOPT_USERAGENT => 'Get courses based on categories from api'
            ));
          $resp = curl_exec($curl);
          curl_close($curl);
            $response= json_decode($resp);
          $courses = $response->courses;
          foreach ($courses as $course) 
          {
            ?>
                <li><a style="font-size: 12px" href="training-<?php echo urlencode($course->course_reference)?>"><?php echo $course->course_name?></a></li>
            <?php
          }
          echo '
          <li><a style="font-size: 12px" href="courses"><b>View All..</b></a></li>';
    ?>
  </ul>
</li>
<?php
          }
        ?>
</ul>
        
      </li>  
       <li><a href="#" target="_blank" style="color:#ddd"><i class="fa fa-phone"></i><small>Call Now:</small> <img src="assets/img/usflag.png" style="height: 15px;width: 30px"> +1 209-207-3043 <img src="assets/img/canflag.png" style="height: 15px;width: 30px"> +1 416-834-6577</a></li>
    </ul>
    
  </div><!-- /.nav-collapse -->
</nav>
 <div class="alert alert-info text-center" role="alert" style="margin-bottom: 0px;position: fixed;top:0px;z-index: 999;width: 100%" id="latest-alert">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Enroll Now!</strong> Choose your convenient slot &amp; master your dream course.
</div>
