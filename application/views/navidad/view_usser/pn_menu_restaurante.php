<header id="pn_Conteneur_menu">
    <nav>
        <div class="navbar navbar-static" id="navbar-example">
            <div class="navbar-inner">
                <div style="width: auto;" class="container">
                    <a href="<?php echo site_url("navidad/c_navidad/index"); ?>" class="brand">Portal navidad</a>
                           <ul class="nav ">
                            <li class="dropdown open" id="fat-menu">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">Acciones <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                       <li><?php echo anchor('navidad/c_navidad/pn_view_restaurante_crear_ficha_tecnica', 'Crear Ficha T&eacute;cnica');?></a></li>
                                        <li><?php echo anchor('navidad/c_navidad/pn_view_restaurante_ficha_tecnica', 'Ver Ficha T&eacute;cnica');?></li>
                                        <li><?php echo anchor('navidad/c_navidad/pn_view_ofertas_anuncio', 'Ver Anuncios');?></li>
                                        <li><?php echo anchor('navidad/c_navidad/pn_view_restaurante_anuncios', 'Seguir Anuncios');?></li>
                                        <li><?php echo anchor('navidad/c_navidad/pn_show_aprovar_promocion', 'Aprovar promoci&oacute;n');?></li>                                        
                                        <li><?php echo anchor('navidad/c_navidad/pn_change_pasword_restaurante', 'Cambiar Contrse&ntilde;a');?></li>
                                        <li><?php echo anchor('navidad/c_navidad/pn_view_update_datos_restaurante', 'Configuraci&oacute;n');?></li>
                                    <li class="divider"></li>
                                </ul>
                            </li>
                        </ul>
                    <?php
                    if (isset($usser)) {
                        ?>
                        <ul class="nav pull-right">
                            <li class="dropdown" id="fat-menu">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#"> 
                                    <?php
                                    echo "Bienvenido " . $usser['nombre'] . " " . $usser['apellido'];
                                    ?> 
                                    <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><?php
                                        echo anchor('/navidad/c_navidad/pn_enviar_email', 'pn_enviar_email');
                                        ?></a></li>
    <?php if (isset($pedidosHechos)) { ?>
                                        <li><a href="#">Pedidos <?php echo $pedidosHechos . '/' . $pedidoTotal; ?></a></li>
                                    <?php }
                                    ?>
                                    <li><?php
                                        echo anchor('/navidad/c_navidad/pn_change_pasword_usuario', 'Cambiar contrase&ntilde;a');
                                        ?></li>
                                    <li class="divider"></li>
                                    <li><a href="#">
    <?php
    echo anchor('/navidad/c_navidad/outlogin', 'cerrar seccion');
    ?>
                                        </a></li>
                                </ul>
                            </li>
                        </ul>
<?php }
?>
                </div>
            </div>
        </div>
    </nav>

</header>
