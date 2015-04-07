<div id="pn_Panneau_Gauche">
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
                    <div class="caption">
                        <h5><?php echo $value->nombre; ?></h5>
                        <a class="thumbnail" href="#">
                            <img alt="" src=<?php echo base_url(); ?>application/views/navidad/upload/promociones/<?php echo $value->url; ?>>
                        </a>
                    </div>  
                </div>
                <?php
            }
            ?>

        
     


        <!--Promociones -->

    </div>
</div>
<div id="pn_Panneau_Droit">
       <div id="pn_publicite_Aliments" class="pn_ultimos_anuncios">
             <?php
        if (isset($publicidad)) {
            echo $publicidad;
        }
        ?>
         <?php
        if (isset($busqueda)) {
            echo $busqueda;
        }
        ?>

    </div>
    <div id="pn_Debut_Section" >
        <?php
        if (isset($dataUsser)) {
            echo $dataUsser;
        }
        ?>
    </div>
 
</div>