<div>
<ul class="breadcrumb">
    <li><a href="#" ><?php echo anchor('navidad/c_navidad/index', 'Inicio'); ?></a> <span class="divider">/</span></li>
    <li class="active"><a href="#">Anuncio</a> </li>
</ul>
</div>
<div id="pn_Panneau_GaucheRest">
    <div id="pn_show_contenedor_anuncio" class="pn_promociones_index pn_show_contenedor_anuncio" >
         <div class="pn_ultimos_anuncios pn_show_anuncio">
                <div class="pn_ultimos_anuncios_head pn_show_anuncio_head "><?php echo $anuncio[0]->nombre;?></div>
                <div class="pn_ultimos_anuncios_info ">
                    <div class="pn_calendar ">
                        <span><?php echo $anuncio[0]->fecha;?></span>
                    </div>
                    <div class="pn_provincia">
                        <span><?php echo $anuncio[0]->provincia;?></span>
                    </div>
                    <div class="pn_provincia">
                        <span><?php echo $anuncio[0]->municipio;?></span>
                    </div>
                </div>
                <div class="pn_ultimos_anuncio_descrip"><?php echo $anuncio[0]->descripcion;?></div>
            </div>
    </div>
    <div id="pn_show_restaurante_anuncio" class="pn_promociones_index">
        <h4>Listado de restaurantes</h4>
        <?php 
       //var_dump($restaurantes);
  for ($i = $start; $i < $end; $i++) {
    $value = $restaurantes[$i];
            
            ?>
        
        
        <div class="thumbnail span2 show_cont_restaurante_provincia pn_anuncio_restuarante" >
                <div class="show_restaurante_provincia span2">
                    <?php
                    if (!empty($value['logo'])) {
                        ?>
                        <img alt="" width="260" height="100" src="<?php echo base_url(); ?>application/views/navidad/upload/logoRestaurante/<?php echo $value['logo']; ?>">
                        <?php
                    } else {
                        ?>
                        <img alt="" src="<?php echo base_url(); ?>application/views/navidad/upload/logoRestaurante/noimagen.gif">
                    <?php } ?>
                </div>
                <div class="caption show_restaurante_provincia">
                     <p><?php echo $value['tipo']; ?></p>
                     <table id="pn_table_anucio_rest">
                        <tr><td>Presupuesto enviado</td><td>/</td><td>Presupuesto aceptados</td></tr>
                        <tr><td><?php echo $value['cantPresEnviado']; ?></td><td>/</td><td><?php echo $value['cantPresAcept']; ?></td></tr>
                    </table>
                </div>
            </div>
        
        
        
        
        
        
        
        
        
        
        
        
        
<!--        
             <div class="pn_ultimos_anuncios pn_show_anuncio">
                <div class="pn_ultimos_anuncios_head pn_show_anuncio_head "><?php //echo $value->nombre;?></div>
                <div class="pn_ultimos_anuncios_info ">
                    <div class=" pn_show_info_anuncio">
                        <span> Costo : <?php //echo $value->costo;?></span>
                    </div>
                </div>
                <div class="pn_ultimos_anuncio_descrip"><?php //echo $value->descripcion;?></div>
            </div>-->
        <?php
        }
        ?>
    </div>
    <?php if (isset($link)): ?>
            <center> <?php echo $link ?> </center>
            <?php endif ?>
</div>
<div id="pn_Panneau_Droit">
    <div id="pn_Debut_Section" >
        <?php
        if (isset($dataUsser)) {
            echo $dataUsser;
        }
        ?>
    </div>
    <div id="pn_publicite_Aliments" class="pn_ultimos_anuncios">
        <?php
        if (isset($busqueda)) {
            echo $busqueda;
        }
        ?>
       
    </div>
</div>
