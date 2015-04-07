<div id="pn_ultimos_restaurantes">
    <ul class="breadcrumb">
        <?php
        foreach ($ultimos as $value) {
        ?>
        <li>
          <div class="thumbnail">
              <div rel="tooltip" title="<?php echo $value->nombre;?>">
              <a href="<?php echo base_url();?>/index.php/navidad/c_navidad/pn_show_ficha_tecnica/<?php echo $value->id_usuario;?>" >
                  
                 <?php if($value->logo !='')
                 {?>
                 <img href="" width="50" height="50" src="<?php echo base_url();?>application/views/navidad/upload/logoRestaurante/<?php echo $value->logo;?>" alt="<?php echo $value->nombre;?>">
                 <?php }
                 else
                 {?>
                 <img width="50" height="50" src="<?php echo base_url();?>application/views/navidad/upload/logoRestaurante/noimagen.gif" alt="">
                 <?php }?>
                 
                </a>
                  </div>
         </div>
          <?php //echo anchor('navidad/c_navidad/view_index_anuncio_seleccionado/'.$value->id_restaurant,$value->nombre); ?> </li>
            <?php
        
            }
        ?>
      </ul>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var a = $("#pn_ultimos_restaurantes").find('div')
        $(a).each(function(){
            $(this).tooltip('hide')
        })
    })
</script>
