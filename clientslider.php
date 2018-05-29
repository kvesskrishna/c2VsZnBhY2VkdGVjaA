<div class="container">
<div class="row">
    <div class='col-md-offset-2 col-md-8 text-center'>
   <header class="section-header">
            <h3>Clientele</h3>
            </header>
    </div>
  </div>
   <section class="client-logos slider">
<?php
$clientsdir = "assets/img/clients/*.*";
$clientsimages = glob( $clientsdir );
foreach( $clientsimages as $clientimage ):
   ?>
      <div class="slide"><img src="<?php echo $clientimage?>"></div>
   <?php
endforeach;
?>
</section>
</div>