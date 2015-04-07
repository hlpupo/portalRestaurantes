<div>
    <ul class="breadcrumb">
        <li><a href="#" ><?php echo anchor('navidad/c_navidad/pn_vista_usser', 'Inicio'); ?></a> <span class="divider">/</span></li>
        <li class="active"><a href="#">Insertar Anuncio</a> </li>
    </ul>
</div>
<div id="pn_Panneau_GaucheUsser">
    <div id="pn_Panneau_Utilisateur" >
        <div id="pn_view_cont_forme_usser" class="well">

            <div id="pn_view_cont_forme">

                <?php
                if (isset($opcion)) {
                    if ($opcion == 1) {
                        ?>
                        <div class=" alert alert-block alert-success  fade in" id="pn_show_status_true">
                            <span class="alert-heading">Su accion se ha realizado con exito.</span>
                        </div>
                        <div><a href="<?php echo site_url("navidad/c_navidad/pn_vista_usser"); ?>"><span class="label label-info">Continuar</span></a></div>
                        <?php
                    } else {
                        ?>
                        <div class=" alert alert-block alert-error fade in" id="pn_show_status_false">
                            <span class="alert-heading">Ha ocurrido un error, por favor intente de nuevo!</span>
                        </div>
                        <div><a href="<?php echo site_url("navidad/c_navidad/pn_view_anuncio"); ?>"><span class="label label-info">Continuar</span></a></div>
                        <?php
                    }
                }
                ?>

                <form action="pn_registrar_anuncio" id="anuncio-form" class="form-horizontal usser_form" method="post">
                    <div class="control-group pn_form_registre_Anuncio">
                        <label class="control-label_usser control-label " for="name">T&iacute;tulo del pedido</label>
                        <div class="control-label_usser controls ">
                            <input type="text" class="input-xlarge" id="pn_titulo" name="pn_titulo" >
                        </div>
                    </div>
                    <div class="control-group pn_form_registre_Anuncio">
                        <label class="control-label_usser control-label" for="name">Provincia</label>
                        <div class="control-label_usser controls">
                            <select id="pn_selectionner_Provincia" class="control-label_usser pn_selectionner span2" name="pn_selectionner_Provincia">
                                <?php
                                foreach ($provincia as $value) {
                                    ?>
                                    <option value="<?php echo $value->id_province; ?>"> <?php echo $value->prenom; ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group pn_form_registre_Anuncio">
                        <label class="control-label_usser control-label" for="pn_selectionner_Provincia">Municipio</label>
                        <div class="control-label_usser controls">
                            <select id="pn_selectionner_municipio" class="control-label_usser pn_selectionner span2" name="pn_selectionner_municipio" >
                                <option value=""> Seleccione la provincia</option>
                            </select>
                        </div>
                    </div>

                    <div class="control-group pn_form_registre_Anuncio">
                        <label class="control-label_usser control-label " for="name">Cantidad de comensales</label>
                        <div class="control-label_usser controls ">
                            <input type="text" class="input-mini" id="pn_cantidad_personas" name="pn_cantidad_personas" >
                        </div>
                    </div>
                    <div class="control-group pn_form_registre_Anuncio">
                        <label class="control-label_usser control-label " for="name">Fecha</label>
                        <div class="control-label_usser controls ">
                            <input type="text" class="input-small" id="pn_fecha" name="pn_fecha" >
                        </div>
                    </div>
                    <div class="control-group pn_form_registre_Anuncio">
                        <label class="control-label_usser control-label" for="name">Rango</label>
                        <div class="control-label_usser controls">
                            <select id="pn_select_rango" class="control-label_usser pn_selectionner_usser" name="pn_select_rango">
                                <option value="1">Econ&oacute;mico</option>
                                <option value="2">Medio</option>
                                <option value="3">Alto</option>
                            </select>
                        </div>
                    </div>



                    <div class="control-group pn_form_registre_Anuncio">
                        <label class="control-label_usser control-label" for="pn_option_condiciones">Descripcion</label>
                        <div class="control-label_usser controls">
                            <textarea class="pn_input-xlarge" name="descripcion" id="descripcion" rows="5" class="pn_input-xlarge" ></textarea>
                        </div>


                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-danger btn-small">Guardar</button>
                        <a href="<?php echo site_url("navidad/c_navidad/pn_vista_usser"); ?>"><button class="btn btn-danger btn-small" type="button" > Cancelar</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#pn_view_cont_forme_usser").ready(function(){
         
        $("#pn_selectionner_Provincia").change(function(){
            pn_cargar_municipio($("#pn_selectionner_municipio"), $(this).val());
        })
        $( "#pn_fecha" ).datepicker();
        $("#pn_fecha").datepicker( "option", "dateFormat", 'yy-mm-dd' );
    })
    
</script>