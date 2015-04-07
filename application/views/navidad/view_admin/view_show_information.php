<div class=" alert alert-block alert-error fade in pn_informacion_admin" id="pn_show_status_slect">
                    <span class="alert-heading">Debes seleccionar un elemento.</span>
                </div>
  <?php
            if(isset($opcion))
            {
            if ($opcion == 1) {
                ?>
                <div class=" alert alert-block alert-success  fade in pn_informacion_admin" id="pn_show_status_true">
                    <span class="alert-heading">Su accion se ha realizado con exito.</span>
                </div>
                <?php
            }
            else if($opcion == 2)
            {
                ?>
                <div class=" alert alert-block alert-error fade in pn_informacion_admin" id="pn_show_status_slect">
                    <span class="alert-heading">Bebe seleccionar un elemento.</span>
                </div>
                <?php  
            }
            else {
                ?>
                <div class=" alert alert-block alert-error fade in pn_informacion_admin" id="pn_show_status_false">
                    <span class="alert-heading">Ha ocurrido un error, por favor intente de nuevo!</span>
                </div>
                <?php
            }
            }
            ?>
