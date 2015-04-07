<?php
if (isset($barNav)) {
    echo $barNav;
}
//var_dump($records);
//echo $this->table->generate($records);
//Creamos la páginación
?>
<div id="pn_Panneau_Gauche">
    <div id="pn_Restaurant_Publicite" class="pn_promociones_index" >

<?php
for ($i = $start; $i < $end; $i++) {
    $value = $ultimos_Anuncios[$i];
    // foreach ($ultimos_Anuncios as $value) {
    ?>

            <div id="pn_show_seccion_anuncios">
                <div class="pn_ultimos_anuncios_head  "><?php echo anchor('navidad/c_navidad/view_index_anuncio_seleccionado/' . $value->id_annonce, $value->nombre); ?>
                    <div class="pn_ultimos_anuncios_info ">
                        <div class="pn_calendar"><span><?php echo $value->fecha; ?></span></div>
                        <div class="pn_provincia"><span><?php echo $value->provincia; ?></span></div>
                        <div class="pn_provincia"><span><?php echo $value->municipio; ?></span></div>
                    </div>
                </div>
                <div class="pn_ultimos_anuncio_descrip"><?php echo $value->descripcion; ?></div>
            </div>
    <?php
}
?>

        <?php if (isset($link)): ?>
            <center> <?php echo $link ?> </center>
        <?php endif ?>



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