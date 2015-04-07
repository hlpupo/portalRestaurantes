<div>
    <ul class="breadcrumb">
        <li><a href="#" ><?php echo anchor('navidad/c_navidad/pn_vista_restaurante', 'Inicio'); ?></a> <span class="divider">/</span></li>
        <li class="active"><a href="#">Mi Ficha tecnica</a> </li>
    </ul>
</div>
<div id="pn_Panneau_GaucheRest">
    <div id="pn_Panneau_Utilisateur" >
        <div id="pn_cont_information_usser_corp" class="pn_cont_information_corp">
            <div id="pn_cont_add_menu_foto">
                <div>
                    Cantidad de Presupuesto enviados <?php echo $presupuesto; ?>
                </div>
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Menu</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($menu as $value) {
                            ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $value['nombre']; ?></td>
                                <td><?php echo $value['descripcion']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>

                <div>
                    <label class="pn_cont_menu_restaurant_head"><h3>Fotos</h3></label>
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

                </div>
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