<div class="container">
<div class="row">
    <div class='col-md-offset-2 col-md-8 text-center'>
   <header class="section-header">
            <h3>Partners</h3>
            </header>
    </div>
  </div>
   <section class="partner-logos slider">
<?php
$partnersdir = "assets/img/partners/*.*";
$partnersimages = glob( $partnersdir );
foreach( $partnersimages as $partnerimage ):
   ?>
      <div class="slide"><img src="<?php echo $partnerimage?>"></div>
   <?php
endforeach;
?>
</section>
</div>