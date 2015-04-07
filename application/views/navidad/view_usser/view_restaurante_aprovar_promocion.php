<div>
<ul class="breadcrumb">
                        <li><a href="#" ><?php echo anchor('navidad/c_navidad/pn_vista_restaurante', 'Inicio');?></a> <span class="divider">/</span></li>
                        <li class="active"><a href="#">Aprovar promocion</a> </li>
                    </ul>
</div>
<div id="pn_Panneau_GaucheRest">
    <div id="pn_Panneau_Utilisateur" >
                <div id="pn_cont_information_usser_corp" class="pn_cont_information_corp">
                    <div id="pn_show_aprovar_promocion" class="pn_show_restaurante_anuncio_ofertas">
                        <table id="pn_show_aprovar_promocion_table"></table> <div id="pn_show_aprovar_promocion_table_pager2"></div>
                    </div>
                    <div id="pn_aprovar_promocion">
                        <div class="thumbnail span2 promocion" id="pn_aprovar_promocion_texto">
                                <div class="caption">
                                    <h5 id="pn_aprovar_promocion_nombre">Promocion Hector</h5>
                                    <p id="pn_aprovar_promocion_descripcion">Ven aki las mejores oferrtas</p>
                              </div>
                             <div id="pn_btn_aprovar_promocion_txt" class="btn btn-primary">Publicar</div>
                         </div>
                        <div class="thumbnail span2 promocion" id="pn_aprovar_promocion_img">
                            <div class="caption">
                            <h5 id="pn_aprovar_promocion_nombre_img"></h5>
                           <a href="#" class="thumbnail">
                               <img id="pn_aprovar_promocion_img_img" src="http://localhost/PortailNoelV1/application/views/navidad/upload/31ec8147535be70a765957a1ffba77f8.jpg" alt="">
                            </a>
                          </div>
                             <div id="pn_btn_aprovar_promocion" class="btn btn-primary">Publicar</div>
                     </div>
                       
                    </div>
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
        pn_show_grid_aprovar_promocion();
        $("#pn_aprovar_promocion_texto").hide();
        $("#pn_aprovar_promocion_img").hide();
    })
</script>
