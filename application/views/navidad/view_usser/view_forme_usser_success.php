<div id="view_forme_usser_enregistrer_success">
<?php
if($opcion == 1)
{
    ?>
     
     <div class=" alert alert-block alert-success  fade in" id="pn_show_status_true">
         <span class="alert-heading">Su accion se ha realizado con exito.</span>
    </div>
    <div><a href="<?php echo site_url("navidad/c_navidad/pn_vista_usser");?>"><span class="label label-info">Continuar</span></a></div>
   <?php
    
    
}
else
{
   ?>
     <div class=" alert alert-block alert-error fade in" id="pn_show_status_false">
        <span class="alert-heading">Ha ocurrido un error, por favor intente de nuevo!</span>
     </div>
    <div><a href="<?php echo site_url("navidad/c_navidad/pn_view_anuncio");?>"><span class="label label-info">Continuar</span></a></div>
   <?php 
}
?>
    
</div>