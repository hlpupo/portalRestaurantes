<div id="pn_Panneau_Gauche" >
    <div id="pn_Restaurant_Publicite" class="pn_promociones_index" >
        
        <?php 
            foreach ($promociones_text as $value) {
                ?>
        <div class="thumbnail span2 promocion" >
                <div class="caption">
                <h5><?php echo $value->nombre; ?></h5>
                <p><?php echo $value->texto; ?></p>
              </div>
         </div>
        <?php
            }
        ?>
         <?php 
            foreach ($promociones_img as $value) {
                ?>
        <div class="thumbnail span2 promocion" >
               <a  href="#">
                   <img width="205" height="160" alt="<?php echo $value->nombre; ?>" src=<?php echo base_url();?>application/views/navidad/upload/promociones/<?php echo $value->url; ?>>
                </a>
         </div>
        <?php
            }
        ?>
      
         
        
        <!--Promociones -->
        
    </div>
    <div id="pn_banner_index_promocional">
        
    </div>
    <div id="pn_Derniere_Enregistres" class="pn_promociones_index">
        <!--Anuncio 1 -->
        <?php foreach ($ultimos_Anuncios as $value) {
            ?>
            <div class="pn_ultimos_anuncios">
                <div class="pn_ultimos_anuncios_head  "><?php echo anchor('navidad/c_navidad/view_index_anuncio_seleccionado/'.$value->id_annonce,$value->nombre); ?></div>
                <div class="pn_ultimos_anuncios_info btn-success">
                    <div class="pn_calendar">
                        <span><?php echo $value->fecha;?></span>
                    </div>
                    <div class="pn_provincia">
                        <span><?php echo $value->provincia;?></span>
                    </div>
                    <div class="pn_provincia">
                        <span><?php echo $value->municipio;?></span>
                    </div>
                </div>
                <div class="pn_ultimos_anuncio_descrip"><?php echo $value->descripcion;?></div>
            </div>
        <?php
        }?>
        
    </div>

</div>