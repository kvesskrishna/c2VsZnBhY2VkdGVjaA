
 <header class="site-header size-lg text-center" style="background-image: url(assets/img/bg-banner1.jpg)">
      <div class="container">
        <div class="col-xs-12">
            <?php
            $api_call= 'http://www.selfpacedtech.com/services/api/courses?transform=1';
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
          $totalcourses=sizeof($courses);
 ?>
          <h2>We offer <mark><span class="hhmetric"> <?php echo $totalcourses;?></span>+</mark> online courses right now!</h2>
          <h5 class="font-alt">Find your desire course in a minute</h5>
          <form class="header-job-search" method="post" action="searchresults">
          <div class="col-xs-12 col-md-2"></div>
          <div class="header-metrics">          
          <div class="col-xs-12 col-md-2"><i class="fa fa-users"></i><span><br><span class="hmetric">20000</span>+ Students</span></div>
         <div class="col-xs-12 col-md-2"><i class="fa fa-pencil-square-o"></i><span><br><span class="hmetric">10000</span>+ Assignments</span></div>
         <div class="col-xs-12 col-md-2"><i class="fa fa-clock-o "></i><span><br><span class="hmetric">20000</span>+ Hours Classes</span></div>
         <div class="col-xs-12 col-md-2"><i class="fa fa-globe "></i><span><br><span class="hmetric">10</span>+ Countries</span></div>
          </div>
            <div class="input-keyword">
              <input type="text" class="form-control" name="coursesearch" placeholder="Search Course, Program, Certification">
              <div class="result"></div>
            </div>
            <div class="input-location">
             <select class="form-control" name="coursetype">
               <option selected value="Online Training">Online Training</option>
               <option value="Corporate Training">Corporate Training</option>
              </select>
            </div>
            <div class="btn-search">
              <button class="btn btn-primary" type="submit">Find Course</button>
             
            </div>
          </form>

        </div>
        <div class="col-xs-12 col-md-3 header-features text-center">
          <i class="fa fa-television fa-4x"></i>
          <h5>Interactive Sessions</h5>
          <p>Most effective and efficient learning through live, friendly sessions.</p>

        </div>
        <div class="col-xs-12 col-md-3 header-features text-center">
          <i class="fa fa-street-view fa-4x"></i>
          <h5>Qualified Instructors</h5>
          <p>Grab the best out of our well qualified and experienced instructors.</p>
        </div>
        <div class="col-xs-12 col-md-3 header-features text-center">
          <i class="fa fa-clock-o fa-4x"></i>
          <h5>365x24x7 Support</h5>
          <p>Round the clock and throughout the calendar, we are ready to assist you.</p>
        </div>
        <div class="col-xs-12 col-md-3 header-features text-center">
          <i class="fa fa-calendar-check-o fa-4x"></i>
          <h5>Customizable Schedules</h5>
          <p>Make use of our incredible services, at the time when you feel comfortable.</p>
        </div>

      </div>
      <div class="container-fluid">
      	
      		<div class="col-xs-12 text-center">

            <div class="list-group list-group-horizontal header-topcategories">
                <a href="#" class="list-group-item active"><i class="fa fa-hand-o-right"></i> Top Categories</a>
                <a href="courses" class="list-group-item">Big Data</a>
                <a href="courses" class="list-group-item">Cloud Computing</a>
                <a href="courses" class="list-group-item">Business Intelligence</a>
                <a href="courses" class="list-group-item">Mobile App Development</a>
                
            </div>

        </div>
      
      </div>
    </header>