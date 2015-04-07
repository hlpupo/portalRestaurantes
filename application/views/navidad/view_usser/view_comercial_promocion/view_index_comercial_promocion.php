<div id="pn_Panneau_Gauche">
    <div id="pn_Panneau_Utilisateur" >
        <div id="pn_cont_information_usser_corp" class="pn_cont_information_corp">
            
            <div class="pn_option_select">

                <a href="<?php echo site_url("navidad/c_comercial/pn_crear_grud_promocion"); ?>" >
                    <div id="pn_pedido">

                    </div>
                    <div>Crear Promociones</div>
                </a>
            </div>
             <div class="pn_option_select">
                        <a href="<?php echo site_url("navidad/c_comercial/pn_change_pasword_cmp");?>" >
                        <div id="pn_pedido">
                            
                        </div>
                            <div>Cambiar Contrse&ntilde;a</div>
                        </a>
                    </div>
          
        </div>
    </div>
</div>
<div id="pn_Panneau_Droit">
    <div id="pn_plus_demandes">
        <div class="btn-success pn_cont_information_head"> 
            Restaurante
        </div>
        <div class="pn_cont_information_corp" id="pn_Restaurant_plus_demandes">
            <?php echo $configR; ?>
        </div>

    </div>
    <div id="pn_cont_image_promotion">
        <div class="btn-success pn_cont_information_head"> 
            Segerencia
        </div>
        <div class="pn_cont_information_corp" id="pn_image_promotion">
            restaurante mas demandados
        </div>
    </div>
</div>
