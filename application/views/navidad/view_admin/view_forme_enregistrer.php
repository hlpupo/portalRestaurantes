<div>
    <form id="pn_forme_enregistrer " class="add-on">
        <div >
            <label for="pn_add_e_mail">Email:</label>
            <input type="email" id="pn_add_e_mail" name="pn_add_e_mail" placeholder="correo electronico" class="span2" />
        </div>

        <div class="pn_form_div_usser">
            <label for="pn_add_prenom">Nombre:</label>
            <input type="email" id="pn_add_prenom" name="pn_add_prenom" placeholder="Nombre" class="span2" >
        </div>
        <div class="pn_form_div_usser">
            <label for="pn_add_nom">Apellidos:</label>
            <input type="email" id="pn_add_nom" name="pn_add_nom" placeholder="Apellidos" class="span2" >
        </div>


        <div class="input-prepend pn_form_div_usser">
            <label for="pn_selectionner_group">Provincia:</label>
            <select id="pn_selectionner_Provincia" class="pn_selectionner">
                <?php
                foreach ($provincia as $value) {
                    ?>
                    <option value="<?php echo $value->id_province; ?>"> <?php echo $value->prenom; ?></option>
                <?php }
                ?>
            </select>
        </div>

        <div class="input-prepend pn_form_div_usser">
            <label for="pn_selectionner_municipio">Municipio:</label>
            <select id="pn_selectionner_municipio" class="pn_selectionner">

            </select>
        </div>
        <div class="input-prepend pn_form_div_usser" >
            <label for="pn_selectionner_group">Grupo:</label>
            <select id="pn_selectionner_group" class="pn_selectionner span2">
                <?php
                foreach ($arrayGroup as $value) {
                    ?>
                    <option value="<?php echo $value->tipo_usser; ?>"> <?php echo $value->groupe; ?></option>
                <?php }
                ?>
            </select>
        </div>
    </form>
    <div class=" alert alert-block alert-error fade in" id="pn_show_status_false">
        <span class="alert-heading">Ha ocurrido un error, por favor intente de nuevo!</span>
    </div>
    <div class=" alert alert-block alert-success  fade in" id="pn_show_status_true">
        <span class="alert-heading">Usuario adicionado correctamente</span>
    </div>
</div>