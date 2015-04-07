<div  class="pn_cont_information_corp pn_admin_cantidad_tipo_registro">
<table class="table table-condensed">  
    <thead>
        <tr>
            <th></th>
            <th>Cantidad</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($cantRestauranteRegistro as $value) {
            if($value->id_tipo_registro == 0)
            {
                $tipo = "Gratis";
            }
            else if($value->id_tipo_registro == 1)
            {
                $tipo = "Media campa&ntilde;a";
            }
            else
            {
                $tipo = "Campa&ntilde;a completa";
            }
            ?>
            <tr>
                <td><?php echo $tipo; ?></td>
                <td><?php echo $value->cantidad; ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
</div>