<div>
<ul class="breadcrumb">
                        <li><a href="#" ><?php echo anchor('navidad/c_navidad/pn_vista_restaurante', 'Inicio');?></a> <span class="divider">/</span></li>
                        <li class="active"><a href="#">Envio de presupuesto</a> </li>
                    </ul>
</div>
<div id="pn_Panneau_GaucheRestFull">
    <div id="pn_Panneau_Utilisateur" >
            
                
                    <div id="pn_show_seguir_anuncio">
                        <table id="pn_show_seguir_anuncio_table"></table> <div id="pn_show_seguir_anuncio_pager2"></div>
                    </div>
                    <div id="pn_show_dialog_anuncio">
                        
                    </div >
        </div>
    </div>
<!--    <div id="pn_Panneau_Droit">
        <div id="pn_plus_demandes">
            <div class="btn-success pn_cont_information_head"> 
                Restaurante
            </div>
            <div class="pn_cont_information_corp" id="pn_Restaurant_plus_demandes">
                <?php //echo $configR; ?>
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
    </div>-->
<script>
    $("#pn_show_restaurante_anuncio").ready(function(){
        //mando a cargar el grid de los anuncios
        pn_show_grid_seguir_anuncio();
    })
</script>
