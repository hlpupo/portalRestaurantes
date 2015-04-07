<div>
<ul class="breadcrumb">
                        <li><a href="#" ><?php echo anchor('navidad/c_navidad/pn_vista_restaurante', 'Inicio');?></a> <span class="divider">/</span></li>
                        <li class="active"><a href="#">Envio de presupuesto</a> </li>
                    </ul>
</div>
<div id="pn_Panneau_GaucheRest">
    <div id="pn_Panneau_Utilisateur" >
                <div id="pn_cont_information_usser_corp" class="pn_cont_information_corp">
                    <div id="pn_show_restaurante_anuncio" class="pn_show_restaurante_anuncio_ofertas"></div>
                    <div id="pn_cont_ofertas_anuncio">
                        
                    </div >
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
<script>
    $("#pn_show_restaurante_anuncio").ready(function(){
        //mando a cargar el grid de los anuncios
        pn_grid_restaurante_anuncio();
    })
</script>
