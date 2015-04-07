<div id="pn_view_cont_forme">
    <?php
    if (isset($informacion)) {
        echo $informacion;
    }
    ?>
    <form action="pn_enregistrer_usser_cmp" id="contact-form" class="form-vertical usser_form" method="post">
        <div class="control-group pn_form_registre_usser">
            <label class="control-label_usser control-label " for="name">Nombre</label>
            <div class="control-label_usser controls ">
                <input type="text" class="span3 " id="pn_add_prenom" name="pn_add_prenom" >
            </div>
        </div>
        <div class="control-group pn_form_registre_usser">
            <label class="control-label_usser control-label" for="name">Apellidos</label>
            <div class="control-label_usser controls">
                <input type="text" class="span3 " id="pn_add_nom" name="pn_add_nom">
            </div>
        </div>
        <div class="control-group pn_form_registre_usser">
            <label class="control-label_usser control-label" for="name">Direcci&oacute;n electr&oacute;nica</label>
            <div class="control-label_usser controls">
                <input type="text" class="span3 " name="pn_add_e_mail" id="pn_add_e_mail">
            </div>
        </div>
        <div class="control-group pn_form_registre_usser">
            <label class="control-label_usser control-label" for="name">Provincia</label>
            <div class="control-label_usser controls"> 
                <select id="pn_selectionner_Provincia" class="control-label_usser  span3 pn_select" name="pn_selectionner_Provincia">
                    <?php
                    foreach ($provincia as $value) {
                        ?>
                        <option value="<?php echo $value->id_province; ?>"> <?php echo $value->prenom; ?></option>
                    <?php }
                    ?>
                </select>
            </div>
        </div>
        <div class="control-group pn_form_registre_usser">
            <label class="control-label_usser control-label" for="pn_selectionner_Provincia">Municipio</label>
            <div class="control-label_usser controls">
                <select id="pn_selectionner_municipio" class="control-label_usser span3 pn_select" name="pn_selectionner_municipio">

                </select>
            </div>
        </div>
        <input type="hidden" id="pn_id_usser_cmp" name="pn_id_usser_cmp">
        <div  class="form-actions_find">
            <button type="submit" class="btn btn-danger btn-small">Registrarse</button>
            <a href="<?php echo site_url(); ?>/navidad/c_navidad/pn_comercial_promocion"><button class="btn btn-danger btn-small" type="button" > Cancelar</button></a>
        </div>
    </form>
</div>


<script type="text/javascript">
    $("#pn_selectionner_Provincia").change(function(){
        pn_cargar_municipio($("#pn_selectionner_municipio"),$(this).val())
    })
</script>