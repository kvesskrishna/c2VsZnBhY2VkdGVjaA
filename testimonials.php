<section>
<div class="container">
  <div class="row">
    <div class='col-md-offset-2 col-md-8 text-center'>
   <header class="section-header">
            <h3>Customer Reviews</h3>
            </header>
    </div>
  </div>
  <div class='row'>
    <div class='col-md-offset-2 col-md-8'>
      <div class="carousel slide" data-ride="carousel" id="quote-carousel">
        <!-- Bottom Carousel Indicators -->
        <?php
            $api_call= 'http://www.selfpacedtech.com/services/api/testimonials?transform=1&filter=status,eq,Active';
 $curl = curl_init();
          curl_setopt_array($curl, 
            array(
            CURLOPT_RETURNTRANSFER => 1,
            
            CURLOPT_URL => $api_call,
            CURLOPT_USERAGENT => 'Get testimonials from api'
            ));
          $resp = curl_exec($curl);
          curl_close($curl);
            $response= json_decode($resp);
          $testimonials = $response->testimonials;
          $testcount=sizeof($testimonials);
          ?>
        <ol class="carousel-indicators" id="testindicators">
        <?php
        for ($i=0 ; $i < $testcount ; $i++ ) {         
        ?>
          <li data-target="#quote-carousel" data-slide-to="<?php echo $i?>"></li>
          <?php } ?>
        </ol>
        
        <!-- Carousel Slides / Quotes -->
        <div class="carousel-inner" id="customertestimonials">
        
        <?php
          foreach ($testimonials as $testimonial) 
          {
            
 ?>
          <!-- Quote 1 -->
          <div class="item ">
            <blockquote>
              <div class="row">
                <div class="col-sm-3 text-center">
                  <img class="img-circle" src="assets/img/student.png" style="width: 100px;height:100px;">
                </div>
                <div class="col-sm-9">
                  <p><?php echo $testimonial->testimonial?> </p>
                  <small><?php echo $testimonial->customer_name.", ".$testimonial->course_id?></small>
                </div>
              </div>
            </blockquote>
          </div>
       <?php } ?>
        </div>
        
        <!-- Carousel Buttons Next/Prev -->
        <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
        <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
      </div>                          
    </div>
  </div>
</div>
</section>
