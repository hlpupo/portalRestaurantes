<div>
<ul class="breadcrumb">
                        <li><a href="#" ><?php echo anchor('navidad/c_navidad/pn_comercial_promocion', 'Inicio');?></a> <span class="divider">/</span></li>
                        <li class="active"><a href="#">Crear promociones</a> </li>
                    </ul>
</div>
<div id="pn_Panneau_GaucheCMP">
  <div id="pn_Panneau_Utilisateur" >
    <div id="pn_cont_information_usser_corp" class="pn_cont_information_corp">

      <div id="pn_cmp_show_table_promociones">
        <table id="pn_cmp_show_table_promociones_texto"></table> <div id="pn_cmp_show_table_promociones_textopager2"></div>
      </div>

      <div id="pn_cmp_add_promociones" class="well">

                                        <?php
                                        if (isset($informacion)) {
                                          echo $informacion;
                                        }
                                        ?>

                                        <?php echo form_open_multipart('navidad/c_comercial/pn_update_promociones'); ?>


                                        <div class="pn_form_div_usser">
                                          <label for="pn_add_prenom">Nombre</label>
                                          <input type="text" id="pn_add_prenom" name="pn_add_prenom" placeholder="Nombre" class="span2" >
                                        </div>
                                        <div class="pn_form_div_usser">
                                          <label for="pn_add_nom">Tipo promoci&oacute;n</label>
                                          <select name="pn_tipo_promocion" id="pn_tipo_promocion" class="span2" >
                                            <option value="text" > Texto</option>
                                            <option value="img" > Imagen</option>
                                          </select>
                                        </div>
                                        <div class="pn_form_div_usser">
                                          <label for="pn_add_prenom">Nombre</label>
                                          <select id="pn_selectionner_restaurante" class=" span2" name="pn_selectionner_restaurante">
                                            <?php
                                            foreach ($restaurante as $value) {
                                              ?>
                                              <option value="<?php echo $value->id_usser; ?>"> <?php echo $value->nombre; ?></option>
                                            <?php }
                                            ?>
                                          </select>
                                        </div>


                                        <div id="pn_promocion_txt">
                                          <div class="pn_form_div_usser">
                                            <label for="pn_add_prenom">Texto</label>
                                            <textarea rows="3" class="span6" id="pn_texto" name="pn_texto" cols="15"  maxlength="256"></textarea>
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
                                        <div class="pn_form-actions form-actions">
                                          <input type="submit" value="Guardar" class="btn btn-danger"/>
                                        </div>
                                        </form>
                                      </div>
      </div>
    </div>
  </div>
    <div id="pn_Panneau_Droit">
        <div id="pn_plus_demandes">
            <div class="" id="pn_Restaurant_plus_demandes">
                <?php echo $configR; ?>
            </div>
            
        </div>
     
    </div>
  <script>
    $(document).ready(function(){
      //        pn_grid_Lista_anuncio();
      pn_cmp_promociones_grid();
    
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