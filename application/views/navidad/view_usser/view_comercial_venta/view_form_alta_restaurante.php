
<script type="text/javascript">
    $("#pn_view_cont_forme_restaurant").ready(function()
    {
        $("#pn_view_cmv_cont_forme_restaurant").hide();
        $("#pn_cmv_nota").hide();
        $("#pn_show_status_false").hide();
        $("#pn_show_status_true").hide();
        $("#pn_show_status_email").hide();
        $("#pn_selectionner_Provincia").change(function(){
            pn_cargar_municipio($("#pn_selectionner_municipio"),$(this).val())
        })
        
         $("#pn_cmv_save_borrador").toggle(function(){
           $("#pn_cmv_nota").show('clip');
        },function(){
            pn_cmv_save_borrador($("#pn_cmv_alta_restaurante_form").serializeArray());
        })
        $("#pn_cmv_save_publicar").click(function(){
            pn_cmv_save_restaurante($("#pn_cmv_alta_restaurante_form").serializeArray());
        })
      pn_cmv_grid_restaurante_borrador();
      $('.btn-group').button()
      $("#pn_mv_btn").find("button").each(function(){
          $(this).click(function(){
              
              if($(this).attr('id') == "0")
                  {
                      $("#tipo_pago_campana").attr('value', '0')
                      $("#pn_modo_registro").attr('value', '0')
                  }
              else
                  {
                      $("#tipo_pago_campana").val($(this).attr('id'))
                      $("#pn_modo_registro").val(1)
                  }
          })
          
      })
    })


</script>
<div>
<ul class="breadcrumb">
    <li><a href="#" ><?php echo anchor('navidad/c_navidad/pn_comercial_venta', 'Inicio'); ?></a> <span class="divider">/</span></li>
    <li class="active"><a href="#">Registro del comercial de venta</a> </li>
</ul>
</div>
<div id="pn_Panneau_GaucheCMP">
    <div id="pn_Panneau_Utilisateur" >
        <div id="pn_cmv_alta_restaurante_grid">
            <table id="pn_cmv_alta_restaurante_grid_table"></table> <div id="pn_cmv_alta_restaurante_grid_pager2"></div>
        </div>
        <div id="pn_view_cmv_cont_forme_restaurant" class="well pn_view_cont_forme ">
                
            <div data-toggle="buttons-radio" class="btn-group" id="pn_mv_btn">
                <button class="btn btn-danger active" id="0">Gratis</button>
                    <button class="btn btn-danger " id="1">Media</button>
                    <button class="btn btn-danger" id="2">Completa</button>
            </div>
             <div class=" alert alert-block alert-error fade in" id="pn_show_status_false">
                        <span class="alert-heading">Ha ocurrido un error, por favor intente de nuevo!</span>
                    </div>
                    <div class=" alert alert-block alert-error fade in" id="pn_show_status_email">
                        <span class="alert-heading">Ya existe esa direcci&oacute;n electr&oacute;nica!</span>
                    </div>
                    <div class=" alert alert-block alert-success  fade in" id="pn_show_status_true">
                        <span class="alert-heading">Su accion se ha realizado con exito.</span>
                    </div>
            <div id="pn_view_cont_forme">
                <form action="pn_enregistrer_restaurant_data" id="pn_cmv_alta_restaurante_form" class="form-horizontal usser_form" method="post">
                   
                   
                    <input type="hidden" id="pn_modo_registro" name="pn_modo_registro" value="0"/>
                    <input type="hidden" id="tipo_pago_campana" name="tipo_pago_campana" value="0"/>
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
                    <div class="control-group pn_form_registre_restaurante">
                        <label class="control-label_usser control-label" for="pn_selectionner_Provincia">Municipio</label>
                        <div class="control-label_usser controls">
                            <select id="pn_selectionner_municipio" class="control-label_usser pn_selectionner_usser pn_select" name="pn_selectionner_municipio">
                                
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
                    <div>
                        <div class="control-group pn_form_registre_restaurante pn_form_textarea pn_form_textarea_cmv" >
                            <label class="control-label_usser control-label" for="pn_direccion">Direcci&oacute;n particular</label>
                            <div class="control-label_usser controls">
                                <textarea name="pn_direccion" id="pn_direccion" rows="3" cols="7" ></textarea>
                            </div>
                        </div>
                        <div class="control-group pn_form_registre_restaurante pn_form_textarea pn_form_textarea_cmv" id="pn_cmv_nota">
                            <label class="control-label_usser control-label" for="pn_direccion">Nota</label>
                            <div class="control-label_usser controls">
                                <textarea name="pn_Nota" id="pn_Nota" rows="3"  ></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions_CMV form-actions">
                        <button type="button" class="btn btn-danger btn-small" id="pn_cmv_save_publicar">Publicar</button>
                        <button type="button" class="btn btn-danger btn-small" id="pn_cmv_save_borrador">Guardar borrador</button>
                        <a href="<?php echo site_url("navidad/c_navidad/pn_comercial_venta"); ?>"><button class="btn btn-danger btn-small" type="button" > Cancel</button></a>
                    </div>
                    <input type="hidden" id="pn_id_borrador" name="pn_id_borrador" >
                </form>
            </div>
        </div> 
      
          
    </div>
</div>
