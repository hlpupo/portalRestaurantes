<div id="pn_Panneau_Gauche" >
    <?php
    if (isset($informacion)) {
        echo $informacion;
    }
    ?>
    <div id="pn_admin_show_table_promociones">
        <table id="pn_admin_show_table_promociones_texto"></table> <div id="pn_admin_show_table_promociones_textopager2"></div>
    </div>

    <div id="pn_add_promociones" class="well">

        <?php echo form_open_multipart('navidad/c_administrateur/pn_update_promociones'); ?>


        <div class="pn_form_div_usser">
            <label for="pn_add_prenom">Nombre</label>
            <input type="text" id="pn_add_prenom" name="pn_add_prenom" placeholder="Nombre" class="span2" >
        </div>
        <div class="pn_form_div_usser">
            <label for="pn_add_prenom">Para</label>
            <select id="pn_selectionner_restaurante" class="control-label_usser  pn_selectionner" name="pn_selectionner_restaurante">
                <option value="-1">Del portal</option>             
                <?php
                foreach ($restaurante as $value) {
                    ?>
                    <option value="<?php echo $value->id_usser; ?>"> <?php echo $value->nombre; ?></option>
                <?php }
                ?>
            </select>
        </div>

        <div class="pn_form_div_usser">
            <label for="pn_add_nom">Tipo promoci&oacute;n</label>
            <select name="pn_tipo_promocion" id="pn_tipo_promocion" >
                <option value="text" > Texto</option>
                <option value="img" > Imagen</option>
            </select>
        </div>
        <div id="pn_promocion_txt">
            <div class="pn_form_div_usser">
                <label for="pn_add_prenom">Texto</label>
                <textarea rows="3" id="pn_texto" name="pn_texto" class="input-xlarge" maxlength="256"></textarea>
            </div>
        </div>
        <ul class="thumbnails" id="pn_show_img">
            <li class="span3">
                <div class="thumbnail">
                    <img width="75" height="75" src="" alt="">
                </div>
            </li>
        </ul>
        <div id="pn_promocion_img">
            <div class="pn_form_div_usser">
                <label for="pn_add_prenom">Imagen</label>
                <input type="file" name="userfile" size="20" />
                <br /><br />
            </div>
        </div>

        <input type="hidden" name="pn_id_promocion" id="pn_id_promocion" class="btn btn-primary"/>
        <div id="pn_promocion_txt">
            <div class="pn_form_div_usser">
                <input type="submit" value="Guardar" class="btn btn-danger"/>
            </div>
        </div>

        </form>

    </div>
</div>

<script>
    $(document).ready(function(){
        //        pn_grid_Lista_anuncio();
        pn_show_promociones_grid();
        $("#pn_show_status_slect").hide();
        $("#pn_add_promociones").hide();
        $("#pn_promocion_img").hide();
        $("#pn_show_img").hide();
        
        $("#pn_tipo_promocion").change(function(){
            
            if($(this).val() == 'text')
            {
                $("#pn_promocion_txt").show();
                $("#pn_promocion_img").hide();
                $("#pn_show_img").hide();
            }
            else
            {
                $("#pn_promocion_txt").hide();
                $("#pn_promocion_img").show(); 
                $("#pn_show_img").hide();
            }
        })
    })
</script>