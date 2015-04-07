<div id="pn_Panneau_Gauche">

    <!---- -->
    <div id="pn_view_cont_forme_restaurant" class="well ">
        <?php
        if (isset($informacion)) {
            echo $informacion;
        }
        ?>
        <div id="pn_view_cont_forme">

            <form action="pn_enregistrer_restaurant_data" id="registre-form_pago" class="form-horizontal usser_form" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="tipo_pago_campana" id="tipo_pago_campana" value="<?php echo $tipo;?>"/>
                <input type="hidden" name="pn_modo_registro" id="pn_modo_registro" value="1"/>

                <div class="control-group pn_form_registre_restaurante">
                    <label class="control-label_usser control-label " for="name">Nombre</label>
                    <div class="control-label_usser controls ">
                        <input type="text" class="input-medium" id="pn_add_prenom" name="pn_add_prenom" >
                    </div>
                </div>
                <div class="control-group pn_form_registre_restaurante">
                    <label class="control-label_usser control-label" for="name">Direcci&oacute;n electr&oacute;nica</label>
                    <div class="control-label_usser controls">
                        <input type="text" class="input-medium" name="pn_add_e_mail" id="pn_add_e_mail">
                    </div>
                </div>
                <div class="control-group pn_form_registre_restaurante">
                    <label class="control-label_usser control-label" for="name">Telefono</label>
                    <div class="control-label_usser controls">
                        <input type="text" class="input-medium" id="pn_phone" name="pn_phone">
                    </div>
                </div>


                <div class="control-group pn_form_registre_restaurante">
                    <label class="control-label_usser control-label" for="name">Provincia</label>
                    <div class="control-label_usser controls">
                        <select id="pn_selectionner_Provincia_pago" class=" control-label_usser pn_selectionner_usser" name="pn_selectionner_Provincia">
                            <?php
                            foreach ($provincia as $value) {
                                ?>
                                <option value="<?php echo $value->id_province; ?>"> <?php echo $value->prenom; ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="control-group pn_form_registre_restaurante">
                    <label class="control-label_usser control-label" for="pn_selectionner_Provincia">Municipio</label>
                    <div class="control-label_usser controls">
                        <select id="pn_selectionner_municipio_pago" class="control-label_usser pn_selectionner_usser" name="pn_selectionner_municipio">

                        </select>
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
                <div class="control-group pn_form_registre_restaurante">
                    <label class="control-label_usser control-label" for="pn_direccion">Direcci&oacute;n particular</label>
                    <div class="control-label_usser controls">
                        <textarea name="pn_direccion" id="pn_direccion" rows="4" cols="10" class="" ></textarea>
                    </div>
                </div>
                <label>Logo <input type="file" name="userfile" size="20" /></label>
                <div class="control-group pn_form_registre_restaurante">
                    <label class="" for="pn_option_condiciones">T&eacute;rminos y condiciones de uso</label>
                    <div class="control-label_usser controls">
                        <div class="pn_accpet_condiciones_restaurante"> <?php echo $condiciones[0]->description; ?></div>
                        <label class="pn_form_registre_restaurante controls checkbox">
                            <label for="pn_option_condiciones">
                                Aeptar los t&eacute;rminos y condiciones de uso

                                <input type="checkbox"  id="pn_option_condiciones" name="pn_option_condiciones" />
                            </label>
                        </label>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-danger btn-small">Registrarse</button>
                    <a href="<?php echo site_url(); ?>"><button class="btn btn-danger btn-small" type="button" > Cancelar</button></a>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">

    $("#pn_selectionner_Provincia_pago").change(function(){
    
        pn_cargar_municipio($("#pn_selectionner_municipio_pago"),$(this).val())
    })

</script>
