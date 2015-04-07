<div>
    <ul class="breadcrumb">
        <li><a href="#" ><?php echo anchor('navidad/c_navidad/pn_vista_restaurante', 'Inicio'); ?></a> <span class="divider">/</span></li>
        <li><a href="#" >Configuraci&oacute;n</a> <span class="divider">/</span></li>
    </ul>
</div>
<div id="pn_Panneau_GaucheRest">
<div id="pn_view_cont_forme_restaurant" class="well">
<!--    <div class="btn-success pn_head_registre">
        <h4> Registrar restaurante</h4>
    </div>-->
    <div id="pn_view_cont_forme">
         <?php
            if (isset($informacion)) {
                echo $informacion;
            }
            ?>
        <form action="pn_update_datos_restaurante" id="registre-form" class="form-horizontal usser_form" method="post">
          
            <div class="control-group pn_form_registre_restaurante">
                <label class="control-label_usser control-label " for="name">Nombre</label>
                <div class="control-label_usser controls ">
                    <input type="text" class="input-medium" id="pn_add_prenom" name="pn_add_prenom" value="<?php echo $dataRest->nombre ;?>"  >
                </div>
            </div>
             <div class="control-group pn_form_registre_restaurante">
                 <label class="control-label_usser control-label" for="name">Direcci&oacute;n electr&oacute;nica</label>
                <div class="control-label_usser controls">
                    <input type="text" class="input-medium" name="pn_add_e_mail" id="pn_add_e_mail" value="<?php echo $dataRest->email;?>" >
                </div>
            </div>
               <div class="control-group pn_form_registre_restaurante">
                <label class="control-label_usser control-label" for="name">Telefono</label>
                <div class="control-label_usser controls">
                    <input type="text" class="input-medium" id="pn_phone" name="pn_phone" value="<?php echo $dataRest->telefono ;?>" >
                </div>
            </div>
           
         
            <div class="control-group pn_form_registre_restaurante">
                <label class="control-label_usser control-label" for="name">Provincia</label>
                <div class="control-label_usser controls">
                    <select id="pn_selectionner_Provincia" class=" control-label_usser pn_selectionner_usser" name="pn_selectionner_Provincia">
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
                    <select id="pn_selectionner_municipio" class="control-label_usser pn_selectionner_usser" name="pn_selectionner_municipio">
                     
                    </select>
                </div>
            </div>
             <div class="control-group pn_form_registre_restaurante">
                <label class="control-label_usser control-label" for="name">CIF</label>
                <div class="control-label_usser controls">
                    <input type="text" class="input-small" id="pn_cif" name="pn_cif" value="<?php echo $dataRest->cif ;?>" >
                </div>
            </div>
             <div class="control-group pn_form_registre_restaurante">
                <label class="control-label_usser control-label" for="pn_codigo_postal">Codigo Postal</label>
                <div class="control-label_usser controls">
                    <input type="text" class="input-small" id="pn_codigo_postal" name="pn_codigo_postal" value="<?php echo $dataRest->codigo_postal ;?>" >
                </div>
            </div>
            <div class="control-group pn_form_registre_restaurante">
                <label class="control-label_usser control-label" for="pn_direccion">Direcci&oacute;n particular</label>
                <div class="control-label_usser controls">
                    <textarea name="pn_direccion" id="pn_direccion" rows="5" class="pn_input-xlarge_Rest"  ><?php echo $dataRest->direccion ;?></textarea>
                </div>
            </div>
            <input type="hidden" class="input-medium" id="pn_id_usser" name="pn_id_usser" value="<?php echo $dataRest->id_usser ;?>" >
            <div class="form-actions">
                <button type="submit" class="btn btn-primary btn-small">Actualizar</button>
                <a href="<?php echo site_url()."/navidad/c_navidad/pn_vista_restaurante"; ?>"><button class="btn btn-primary btn-small" type="button" > Cancel</button></a>
            </div>
        </form>
    </div>
</div>
</div>
    <div id="pn_Panneau_Droit">
           <div id="pn_Debut_Section" >
        <?php
        if(isset($dataUsser))
        {
        echo $dataUsser; 
        }?>
    </div>
    </div>
<script type="text/javascript">
$("#pn_selectionner_Provincia").change(function(){
    pn_cargar_municipio($("#pn_selectionner_municipio"),$(this).val())
})
</script>
