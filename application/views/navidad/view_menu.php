<header id="pn_Conteneur_menu">

  <div id="pn_cont_menu">
    <a href="<?php echo site_url("navidad/c_navidad/index"); ?>" class="brand">
      <div id="pn_logo"> </div>
    </a>
    <div id="pn_registre">         <?php
if (isset($usser)) {
 ?>
        <?php
        if (empty($usser)) {
          ?>

          <div id="pn_login"  >
            <form action="<?php echo base_url()?>index.php/navidad/c_navidad/pn_login" method="post" class="form-inline">
              <label for="pn_e_mail">Email:</label>
              <div class="input-prepend">
                <span class="add-on"><i class="icon-white icon-envelope"></i></span><input type="email" id="pn_e_mail" name="pn_e_mail" placeholder="correo electronico" class="span2" value="@gmail.com">
              </div>
              <label for="pn_password">Password:</label>
              <div class="input-prepend">

                <span class="add-on"><i class="icon-white icon-pencil"></i></span><input type="password" id="pn_password" name="pn_password" placeholder="contrase&ntilde;a"  class="span2">
              </div>

              <input type="submit" value="Entrar" name="entrar" class="btn btn-danger"/>
            </form>
          </div>
          <?php
        }
        ?>
      <?php }
      ?>

<nav>
      <div class="navbar navbar-static" id="navbar-example">
        <div class="">
          <div style="width: auto;" class="container">

      <?php
            if (!empty($usser)) {
              ?>
              <ul class="nav pull-right">
                <li class="dropdown" id="fat-menu">
                  <a data-toggle="dropdown" class="dropdown-toggle" href="#"> 
                    <?php
                    echo "Bienvenido " . $usser['nombre'] . " " . $usser['apellido'];
                    ?> 
                    <b class="caret"></b></a>
                  <ul class="dropdown-menu">
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
          </div></div></div></nav>
<!--- -->
    </div>

    <nav>
      <div class="navbar navbar-static" id="navbar-example">
        <div class="navbar-inner">
          <div style="width: auto;" class="container">


            <ul class="nav pull-right">
              <?php
              if (isset($usser)) {
                if (empty($usser)) {
                  ?>
                  <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#" ><i class="icon-user icon-white"></i> Registro <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href=<?php echo site_url("navidad/c_navidad/pn_enregistrer"); ?>>Usuario</a></li>
                      <li><a href=<?php echo site_url("navidad/c_navidad/pn_enregistrer_restaurante"); ?>>Restaurante</a></li>

                    </ul>
                  </li>
                  <?php
                }
              }
              ?>
            </ul>
            <ul class="nav pull-right">

              <li class="dropdown">
                <a href=<?php echo site_url("navidad/c_navidad/pn_publicidad_comercial"); ?>>Publicidad Comercial</a>

              </li>
            </ul> 
            <ul class="nav pull-right">

              <li class="dropdown">
                <a href=<?php echo site_url("navidad/c_navidad/pn_seccion_anuncios"); ?>>Anuncios</a>

              </li>
            </ul>
            
            <?php
            if (isset($usser)) {//tipo restaurante
              if ($usser['tipo'] == 3) {
                ?>
                <ul class="nav  pull-right">
                  <li class="dropdown" id="fat-menu">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Acciones <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><?php echo anchor('navidad/c_navidad/pn_view_restaurante_crear_ficha_tecnica', 'Crear Ficha T&eacute;cnica'); ?></a></li>
                      <li><?php echo anchor('navidad/c_navidad/pn_view_restaurante_ficha_tecnica', 'Ver Ficha T&eacute;cnica'); ?></li>
                      <li><?php echo anchor('navidad/c_navidad/pn_view_ofertas_anuncio', 'Ver Anuncios'); ?></li>
                      <li><?php echo anchor('navidad/c_navidad/pn_view_restaurante_anuncios', 'Seguir Anuncios'); ?></li>
                      <li><?php echo anchor('navidad/c_navidad/pn_show_aprovar_promocion', 'Aprovar promoci&oacute;n'); ?></li>                                        
                      <li><?php echo anchor('navidad/c_navidad/pn_change_pasword_restaurante', 'Cambiar Contrse&ntilde;a'); ?></li>
                      <li><?php echo anchor('navidad/c_navidad/pn_view_update_datos_restaurante', 'Configuraci&oacute;n'); ?></li>
                      <li class="divider"></li>
                    </ul>
                  </li>
                </ul>
                <?php
              }
            }
            ?>
            <?php
            if (isset($usser)) {//tipo restaurante
              if ($usser['tipo'] == 5) {
                ?>
                <ul class="nav pull-right">
                  <li class="dropdown" id="fat-menu">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Acciones <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><?php echo anchor('navidad/c_comercial/pn_view_alta_restaurante', 'Alta restaurante'); ?></a></li>
                      <li><?php echo anchor('navidad/c_comercial/pn_change_pasword_cmv', 'Cambiar Contrse&ntilde;a'); ?></li>
                    </ul>
                  </li>
                </ul>
                <?php
              }
            }
            ?>
            <?php
            if (isset($usser)) {//tipo restaurante
              if ($usser['tipo'] == 6) {
                ?>
                <ul class="nav pull-right">
                  <li class="dropdown" id="fat-menu">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Acciones <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><?php echo anchor('navidad/c_comercial/pn_crear_grud_promocion', 'Crear Promociones'); ?></a></li>
                      <li><?php echo anchor('navidad/c_comercial/pn_crear_grud_usuario', 'Gestionar Usuarios'); ?></a></li>
                      <li><?php echo anchor('navidad/c_comercial/pn_change_pasword_cmp', 'Cambiar Contrse&ntilde;a'); ?></li>
                    </ul>
                  </li>
                </ul>
                <?php
              }
            }
            ?>
            <?php
            if (isset($usser)) {//tipo restaurante
              if ($usser['tipo'] == 2) {
                ?>
                <ul class="nav pull-right">
                  <li class="dropdown" id="fat-menu">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Acciones <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><?php echo anchor('navidad/c_navidad/pn_view_anuncio', 'Crear Anuncio'); ?></a></li>
                      <li><?php echo anchor('navidad/c_navidad/pn_view_mis_anuncio', 'Ver mis anuncios'); ?></a></li>
                      <li><?php echo anchor('navidad/c_navidad/pn_change_pasword_usuario', 'Cambiar Contrse&ntilde;a'); ?></a></li>
                      
                    </ul>
                  </li>
                </ul>
                <?php
              }
            }
            ?>
            <?php
            if (isset($usser)) {//tipo restaurante
              if ($usser['tipo'] == 1) {
                ?>
                <ul class="nav pull-right">
                  <li class="dropdown" id="fat-menu">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Acciones <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="#"><?php echo anchor('navidad/c_administrateur/pn_admin_admin_zona', 'Zona'); ?></a></li>
                      <li><a href="#"><?php echo anchor('navidad/c_administrateur/pn_admin_gestion_promociones', 'Promociones'); ?></a></li>
                      <li> <?php echo anchor('navidad/c_administrateur/pn_view_admin_gestionar_usser', 'Gestionar usuarios'); ?></li>
                      <li> <?php echo anchor('navidad/c_administrateur/pn_admin_gestion_anuncios', 'Aprovar anuncio'); ?></li>
                      <li> <?php echo anchor('navidad/c_administrateur/pn_admin_del_anuncios', 'Eliminar anuncio'); ?></li>
                      <li><?php echo anchor('navidad/c_administrateur/pn_ver_trazas_restaurante', 'Informacion restaurante'); ?></li>
                      <li><?php echo anchor('navidad/c_administrateur/pn_ver_trazas_usuarios', 'Informacion usuario'); ?></li>
                      <li><?php echo anchor('navidad/c_administrateur/pn_config_Tipo_registro', 'Tipo de registro'); ?></li>
                      <li><?php echo anchor('navidad/c_administrateur/pn_admin_send_msg_comercial', 'Enviar Mensaje'); ?></li>
                      
                    </ul>
                  </li>
                </ul>
                <?php
              }
            }
            ?>
          

          </div>
        </div>
      </div>
    </nav>
  </div>
</header>
