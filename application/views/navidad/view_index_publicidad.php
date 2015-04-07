
<div id="pn_area_index_publicidad">
  <ul class="thumbnails">
  </ul>
  <?php
    if(isset($promocionAnuncio))
  {
      echo $promocionAnuncio;
  }
  if(isset($promocionImgRest))
  {
      echo $promocionImgRest;
  }
    if(isset($topRestaurante))
  {
      echo $topRestaurante;
  }
  if(isset($promocionPortal))
  {
  foreach ($promocionPortal as $value) {
    //var_dump($value);
    if ($value->tipo_promocion == "text") {
      ?>
<!--
      <li class="span3">
          <a class="thumbnail caption" href="#">
          <h5><?php //echo $value->nombre; ?></h5>
          <p><?php //echo $value->texto; ?></p>
          </a>
      </li>-->
      <?
    } else {
      ?>
<!--      <div class="span2">
        <a class="thumbnail" href="#">
          <img alt="" src="<?php //echo base_url(); ?>application/views/navidad/upload/promociones/comida4.jpg" >
        </a>
      </div>-->
    <?php
  }
  }
}
?>
</div>     

