<?php
$keyword=urlencode($_GET['term']);
$curl = curl_init();
          curl_setopt_array($curl, 
            array(
            CURLOPT_RETURNTRANSFER => 1,
            
            CURLOPT_URL => 'http://www.selfpacedtech.com/services/api/courses?transform=1&filter=course_name,cs,'.$keyword,
            CURLOPT_USERAGENT => 'Get courses from api'
            ));
          $resp = curl_exec($curl);
          curl_close($curl);
          

          $response= json_decode($resp);
          if(!empty($response))
          {
          $courses = $response->courses;
          foreach ($courses as $course) 
          {
          	echo "<p>".$course->course_name."</p>";
          }
 
}
          else
          	echo "No Match Found";
          

?>