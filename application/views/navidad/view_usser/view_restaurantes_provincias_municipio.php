<?php
if (isset($barNav)) {
    echo $barNav;
}
?>
<div id="pn_Panneau_GaucheCMP">

    <div id="pn_Restaurant_Publicite" class="pn_promociones_index" >
        <div>
            <?php if (!empty($provincia)) {
                ?>

            <?php } ?>
        </div>
        <div class="pn_conte_provincia_zona" id="pn_conte_provincia_zona_List">
<?php
//foreach ($restaurantes as $value) 
for ($i = $start; $i < $end; $i++) {
    $value = $restaurantes[$i];
    ?>

                <div class="thumbnail span2 show_cont_restaurante_provincia" >
                    <div class="show_restaurante_provincia span2">
    <?php
    if (!empty($value->logo)) {
        ?>
                        <img alt="" width="260" height="100" src="<?php echo base_url(); ?>application/views/navidad/upload/logoRestaurante/<?php echo $value->logo; ?>">
                            <?php
                        } else {
                            ?>
                            <img alt="" src="<?php echo base_url(); ?>application/views/navidad/upload/logoRestaurante/noimagen.gif">
                        <?php } ?>
                    </div>
                    <div class="caption show_restaurante_provincia">
                        <h4><?php echo $value->nombre; ?></h4>
                        <p><?php echo $value->email; ?></p>
                        <p><?php echo $value->direccion; ?></p>

                    </div>
                </div>
    <?php
}
?>
        </div>
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
