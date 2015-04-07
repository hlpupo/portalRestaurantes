<div class="pn_cont_information_corp pn_admin_cantidad_tipo_registro pn_cont_config" id="pn_trazas_restuarante_div"> 
    <table class="table table-bordered">
        <thead>
            <tr><th>Tipo de registro</th><th>Cantidad presupuesto</th><th>Cantidad de fotos</th></tr>
        </thead>
        <tbody>
            <?php foreach ($tipConfig as $value) {
                ?>
                <tr><td><?php echo $value->nom_registro; ?></td><td><?php echo $value->cantPedido; ?></td><td><?php echo $value->cantImg; ?></td></tr>
                <?php }
            ?>

        </tbody>
    </table>
    <div>
        <h4> Modificar tipo registro</h4>
        <div class="control-group pn_form_registre_restaurante">
            <label class="control-label_usser control-label" for="name">Tipo de registro</label>
            <div class="control-label_usser controls">
                <select id="pn_modo_registro" name="pn_modo_registro" class="pn_select span2">
                    <option value="-1"> -Seleccione- </option>
                    <option value="0">Gratis</option>
                    <option value="1">Media campa&ntilde;a Noviembre</option>
                    <option value="2">Campa&ntilde;a completa Noviembre y Diciembre</option>
                </select>
            </div>
        </div>
        <div id="pn_conte_form_config">
            <form action="pn_update_config" id="pn_cmv_alta_restaurante_form" class="form-horizontal usser_form" method="post">
                <div class="control-group pn_form_registre_restaurante">
                    <label class="control-label_usser control-label" for="name">Cantidad de presupuesto</label>
                    <div class="control-label_usser controls">
                        <input type="text" class="input-medium" id="pn_cant_presupuesto" name="pn_cant_presupuesto">
                    </div>
                </div>
                <div class="control-group pn_form_registre_restaurante">
                    <label class="control-label_usser control-label" for="name">Cantidad de fotos</label>
                    <div class="control-label_usser controls">
                        <input type="text" class="input-medium" id="pn_cant_fotos" name="pn_cant_fotos">
                    </div>
                </div>
                <input type="hidden" name="tipo_config" id="tipo_config">
                <div class="pn_btn_config">
                    <button type="submit" class="btn btn-danger btn-small" id="pn_cmv_save_publicar">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#pn_trazas_usuario_table").ready(function(){
        $("#pn_conte_form_config").hide();
        $("#pn_modo_registro").change(function(){
             $("#tipo_config").val($(this).val());
            $("#pn_conte_form_config").show();
            $.getJSON($.ruta.host+'index.php/navidad/c_administrateur/pn_get_data_config', {"idconfig":$(this).val()}, function(data){
                $("#pn_cant_presupuesto").val(data[0].cantPedido);
                $("#pn_cant_fotos").val(data[0].cantImg);
               
            })
        })
    })
</script>