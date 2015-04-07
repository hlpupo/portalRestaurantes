<div>
    <ul class="breadcrumb">
        <li><a href="#" ><?php echo anchor('navidad/c_navidad/pn_vista_usser', 'Inicio'); ?></a> <span class="divider">/</span></li>
        <li><a href="#" ><?php echo anchor('navidad/c_navidad/pn_view_mis_anuncio', 'Mis Anuncios'); ?></a> <span class="divider">/</span></li>
        <li class="active"><a href="#">Ficha tecnica</a> </li>
    </ul>
</div>
<div id="pn_Panneau_Gauche">
    <div id="pn_Panneau_Utilisateur" >
        <div id="pn_cont_information_usser_head" class="pn_cont_information_head"></div>
        <div id="pn_cont_information_usser_corp" class="pn_cont_information_corp">
            <div id="pn_cont_add_menu_foto">
                <ul class="nav nav-tabs" id="myTab">
                    <li class=""><a data-toggle="tab" href="#home">Menu</a></li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div id="home" class="tab-pane fade">
                        <?php
                        foreach ($menu as $value) {
                            ?>
                            <div class="pn_cont_menu_restaurant">
                                <div class="pn_cont_menu_restaurant_head"><label ><?php echo $value['nombre']; ?></label></div>
                                <div class="pn_cont_menu_restaurant_descripcion"><label ><?php echo $value['descripcion']; ?></label></div>

                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div>
                    <label class="pn_cont_menu_restaurant_head">Fotos</label>
                    <ul class="thumbnails">
                        <?php
                        foreach ($fotos as $pit) {
                            ?>
                            <li class="span3">
                                <div class="thumbnail">
                                    <a rel="example_group" href="<?php echo base_url(); ?>/application/views/navidad/upload/<?php echo $pit->url; ?>" title="<?php echo $value['nombre']; ?>">
                                        <img width="75" height="75" src="<?php echo base_url(); ?>/application/views/navidad/upload/<?php echo $pit->url; ?>" alt="">
                                    </a>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <div>
                        Cantidad de Presupuesto enviados <?php echo $presupuesto;?>
                    </div>
                </div>
            </div >
        </div>
    </div>
</div>
<script>
    $("#pn_show_restaurante_anuncio").ready(function(){
        //mando a cargar el grid de los anuncios
        $("a[rel=example_group]").fancybox({
            'transitionIn'		: 'none',
            'transitionOut'		: 'none',
            'titlePosition' 	: 'over',
            'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
                return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
            }
        });
    })
</script>