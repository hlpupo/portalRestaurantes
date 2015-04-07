<div id="pn_Panneau_Gauche" >
    <?php
    if (isset($informacion)) {
        echo $informacion;
    }
    ?>
    <div id="pn_admin_show_table_promociones">
        <table id="pn_table_liste_user"></table> <div id="pager_pedido"></div>
       
    </div>

   
</div>

<script>
    $(document).ready(function(){
        //        pn_grid_Lista_anuncio();
        pn_eliminar_pedidos();
    })
</script>