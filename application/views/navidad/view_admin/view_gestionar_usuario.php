<div id="pn_admin_conte_Gauche">

    <table id="pn_table_liste_user"></table> <div id="pager2"></div>
</div>
<div id="pn_form_grud_usser" >
      <?php
        if (isset($informacion)) {
            echo $informacion;
        }
        ?>
    <form action="pn_ajouter_usser" id="pn_cmv_alta_restaurante_form" class="form-vertical usser_form" method="post">
        
            <div class="control-group pn_form_registre_restaurante">
            <label class="control-label_usser control-label " for="name">Nombre</label>
            <div class="control-label_usser controls ">
                <input type="text" class="input-medium" id="pn_add_prenom" name="pn_add_prenom" >
            </div>
        </div>
        
        <div class="control-group pn_form_registre_restaurante">
            <label class="control-label_usser control-label " for="pn_add_nom">Apellidos</label>
            <div class="control-label_usser controls ">
                <input type="text" class="input-medium" id="pn_add_nom" name="pn_add_nom" >
            </div>
        </div>
        <div class="control-group pn_form_registre_restaurante">
            <label class="control-label_usser control-label" for="name">Direcci&oacute;n electr&oacute;nica</label>
            <div class="control-label_usser controls">
                <input type="text" class="input-medium" name="pn_add_e_mail" id="pn_add_e_mail">
            </div>
        </div>



        <div class="control-group pn_form_registre_restaurante">
            <label class="control-label_usser control-label" for="name">Provincia</label>
            <div class="control-label_usser controls">
                <select id="pn_selectionner_Provincia" class=" control-label_usser pn_selectionner_usser pn_select" name="pn_selectionner_Provincia">
                    <?php
                    foreach ($provincia as $value) {
                        ?>
                        <option value="<?php echo $value->id_province; ?>"> <?php echo $value->prenom; ?></option>
                    <?php }
                    ?>
                </select>
            </div>
        </div>
        <div class="control-group pn_form_registre_restaurante" style="clear:right;">
            <label class="control-label_usser control-label" for="pn_selectionner_Provincia">Municipio</label>
            <div class="control-label_usser controls">
                <select id="pn_selectionner_municipio" class="control-label_usser pn_selectionner_usser pn_select" name="pn_selectionner_municipio">

                </select>
            </div>
        </div>
        <div class="control-label_usser controls pn_form_registre_restaurante" id="pn_tipo_user">
            <label class="control-label_usser input-medium"  for="tipo_usuario">Tipo usuario
                <select id="tipo_usuario" name="tipo_usuario" class="span2 pn_select">
                    <?php
                    foreach ($tipousuario as $value) {
                        ?>
                        <option value="<?php echo $value->tipo_usser; ?>"> <?php echo $value->groupe; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </label>

        </div>
         <input type="hidden" name="pn_mod_usser" id="pn_mod_usser" value="0"/>
        <div id="pn_admin_registre_rest">
            <div class="control-group pn_form_registre_restaurante">
                <label class="control-label_usser control-label" for="name">Tipo de registro</label>
                <div class="control-label_usser controls">
                    <select id="tipo_pago_campana" name="pn_modo_registro" class="pn_select span2">
                        <option value="0">Gratis</option>
                        <option value="1">Media campa&ntilde;a Noviembre</option>
                        <option value="2">Campa&ntilde;a completa Noviembre y Diciembre</option>
                    </select>
                </div>
            </div>
            <table><tr><td>
            <div class="control-group pn_form_registre_restaurante">
                <label class="control-label_usser control-label" for="name">Telefono</label>
                <div class="control-label_usser controls">
                    <input type="text" class="input-medium" id="pn_phone" name="pn_phone">
                </div>
            </div>
            <div class="control-group pn_form_registre_restaurante">
                <label class="control-label_usser control-label" for="name">CIF</label>
                <div class="control-label_usser controls">
                    <input type="text" class="input-small" id="pn_cif" name="pn_cif">
                </div>
            </div>
            <div class="control-group pn_form_registre_restaurante">
                <label class="control-label_usser control-label" for="pn_codigo_postal">Codigo Postal</label>
                <div class="control-label_usser controls">
                    <input type="text" class="input-small" id="pn_codigo_postal" name="pn_codigo_postal">
                </div>
            </div>
                </td>
                <td>
            <div class="control-group pn_form_registre_restaurante " >
                <label class="control-label_usser control-label" for="pn_direccion">Direcci&oacute;n particular</label>
                <div class="control-label_usser controls">
                    <textarea name="pn_direccion" id="pn_direccion" rows="3" class="span3" ></textarea>
                </div>
            </div>
               </td> </tr></table>
        </div>



        <div class="pn_form-actions_admin">
            <button type="submit" class="btn btn-danger btn-small" id="pn_cmv_save_publicar">Guardar</button>
            <a href="<?php echo site_url("navidad/c_navidad/index"); ?>"><button class="btn btn-danger btn-small" type="button" > Cancel</button></a>
        </div>
        <input type="hidden" id="pn_id_borrador" name="pn_id_borrador" >
    </form>
</div>

<script type="text/javascript">
    $("#pn_admin_conte_Gauche").ready(function(){
        $("#pn_form_grud_usser").hide();
        pn_EnregistrerUtilisateur();
        $("#pn_admin_registre_rest").hide();
        $("#tipo_usuario").change(function(){
            if($(this).val() == '3')
            {
                $("#pn_admin_registre_rest").show();
            }
            else
            {
                $("#pn_admin_registre_rest").hide();
            }
           
        })
   $("#pn_selectionner_Provincia").change(function(){
    
        pn_cargar_municipio($("#pn_selectionner_municipio"),$(this).val())
    })
    })
    
</script>