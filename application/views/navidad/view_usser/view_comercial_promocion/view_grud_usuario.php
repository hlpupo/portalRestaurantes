<div>
    <ul class="breadcrumb">
        <li><a href="#" ><?php echo anchor('navidad/c_navidad/pn_comercial_promocion', 'Inicio'); ?></a> <span class="divider">/</span></li>
        <li class="active"><a href="#">Gestinar usuarios</a> </li>
    </ul>
</div>
<div id="pn_Panneau_GaucheCMP">
    <div id="pn_Panneau_Utilisateur" >
        <div id="pn_cont_information_usser_corp" class="pn_cont_information_corp">

            <div id="pn_cmp_show_table_promociones">
                <table id="pn_cmp_show_table_usuario"></table> <div id="pn_cmp_show_table_usuario_pager2"></div>
            </div>

            <div id="pn_cmp_add_promociones" class="well">

                <?php
                echo $show_usser;
                ?>
                
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
        pn_cmp_grud_usuario_grid();

    })
</script>