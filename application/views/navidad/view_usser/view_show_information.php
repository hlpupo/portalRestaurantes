  <?php
            if(isset($opcion))
            {
            if ($opcion == 1) {
                ?>
                <div class=" alert alert-block alert-success  fade in" id="pn_show_status_true">
                    <span class="alert-heading">Su accion se ha realizado con exito.</span>
                </div>
                <?php
            }
            else if($opcion == 2)
            {
                ?>
                <div class=" alert alert-block alert-error fade in" id="pn_show_status_false">
                    <span class="alert-heading">Su forma de registro no deja que usted publique mas fotos, cambie el tipo registro.</span>
                </div>
                <?php  
            }
            else {
                ?>
                <div class=" alert alert-block alert-error fade in" id="pn_show_status_false">
                    <span class="alert-heading">Ha ocurrido un error, por favor intente de nuevo!</span>
                </div>
                <?php
            }
            }
            ?>
