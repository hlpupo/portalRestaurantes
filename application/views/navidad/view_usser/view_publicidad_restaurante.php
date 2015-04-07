<?php
//foreach ($promocionImgRest as $value) {
//    
//}
?>
<?php if(isset($promocionComida))
    
{?>
<div class="pn_cont_slide_publicidad">
  <div class="slider-wrapper theme-bar">
    <div id="slider" class="nivoSlider">
      <img width="255" height="160"  src="<?php echo base_url(); ?>application/views/navidad/upload/promociones/comida1.jpg" data-thumb="images/toystory.jpg" alt="" />
      <a href="http://dev7studios.com"><img width="255" height="160"  src="<?php echo base_url(); ?>application/views/navidad/upload/promociones/comida2.jpg" data-thumb="images/up.jpg" alt="" title="This is an example of a caption" /></a>
      <img width="255" height="160" src="<?php echo base_url(); ?>application/views/navidad/upload/promociones/comida3.jpg" data-thumb="<?php echo base_url(); ?>application/views/navidad/upload/promociones/comida3.jpg" alt="" data-transition="slideInLeft" />
      <img width="255" height="160" src="<?php echo base_url(); ?>application/views/navidad/upload/promociones/comida4.jpg" data-thumb="<?php echo base_url(); ?>application/views/navidad/upload/promociones/comida4.jpg" alt="" title="#htmlcaption" />
    </div>
    <div id="htmlcaption" class="nivo-html-caption">
      <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>. 
    </div>
  </div>
</div>
<?php
}
?>
<?php if(isset($promocionPromocion))
    
{?>
<div class="pn_cont_slide_publicidad">
  <div class="slider-wrapper theme-bar">
    <div id="slider1" class="nivoSlider">
      <img width="255" height="160"  src="<?php echo base_url(); ?>application/views/navidad/upload/promociones/promocion1.png" data-thumb="<?php echo base_url(); ?>application/views/navidad/upload/promociones/promocion1.png" alt="" />
      <a href=""><img width="255" height="160"  src="<?php echo base_url(); ?>application/views/navidad/upload/promociones/promocion2.png" /></a>
      <img width="255" height="160" src="<?php echo base_url(); ?>application/views/navidad/upload/promociones/promocion3.png" data-transition="slideInLeft" />
    </div>
      </div>
</div>
<?php
}
?>
<?php if(isset($promocionImgRest))
    
{?>
<div class="pn_cont_slide_publicidad">
  <div class="slider-wrapper theme-bar">
    <div id="slider3" class="nivoSlider">
        <?php        foreach ($promocionImgRest as $value) {
         ?>
        <a href=""><img width="255" height="160"  src="<?php echo base_url(); ?>application/views/navidad/upload/promociones/<?php echo $value->url;?>" title="<?php echo $value->nombre;?>" /></a>
        <?php 
        }?>
      
    </div>
  </div>
</div>
<?php
}
?>



<!--<div class="pn_cont_slide_publicidad">
  <div id="slider2" class="nivoSlider">
    <a><div class="pn_slide">  Nullam quis risus eget urna mollis ornare vel eu leo. 
        Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula.</div></a>
    <a><div class="pn_slide"> 1232321312 21 a2sd12sd1a2 sda12sd1a2d12d 2ads1a2ds1a2d a2d s</div></a>
    <a><div class="pn_slide"> asd asd asdas dad asd asd asd a sdasd ads asd asd asdasd asd</div></a>
  </div>
</div>-->
<script type="text/javascript">
  $(window).load(function() {
    $('#slider').nivoSlider();
    $('#slider1').nivoSlider();
    $('#slider2').nivoSlider();
     $('#slider3').nivoSlider();
  });
</script>