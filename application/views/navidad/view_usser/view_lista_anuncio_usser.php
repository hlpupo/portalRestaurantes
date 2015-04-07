<div>
<ul class="breadcrumb">
    <li><a href="#" ><?php echo anchor('navidad/c_navidad/pn_vista_usser', 'Inicio'); ?></a> <span class="divider">/</span></li>
    <li class="active"><a href="#">MIs Anuncios</a> </li>
</ul>
</div>
<div  class="well">
    <div id="pn_view_lista_anuncio_usser"></div>
    <div id="pn_view_lista_anuncio_usser_ctr"></div>
    <div id="pn_view_anuncio_usser_dialog"></div>
</div>
<script>
    $("#pn_show_restaurante_anuncio").ready(function(){
        //mando a cargar el grid de los anuncios
        pn_grid_Lista_anuncio();
    })
</script>