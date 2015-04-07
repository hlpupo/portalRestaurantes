<header id="pn_Conteneur_menu">
  <nav>
    <div class="navbar navbar-static" id="navbar-example">
      <div class="navbar-inner">
        <div style="width: auto;" class="container">
          <a href="#" class="brand">Project Name</a>
        
          <ul class="nav ">
            <li class="dropdown" id="fat-menu">
              <a data-toggle="dropdown" class="dropdown-toggle" href="#">Gestion<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#"><?php echo anchor('navidad/c_administrateur/pn_admin_admin_zona', 'Zona');?></a></li>
                <li><a href="#"><?php echo anchor('navidad/c_administrateur/pn_admin_gestion_promociones', 'Promociones');?></a></li>
                <li> <?php echo anchor('navidad/c_administrateur/pn_view_admin_gestionar_usser', 'Gestionar usuarios');?></li>
                <li><a href="#" onclick="pn_Mostrar_pedidos()"><i class="icon-user icon-white"></i>  Aprovar Pedidos </a></li>
                <li><?php echo anchor('navidad/c_administrateur/pn_ver_trazas_restaurante', 'Informacion restaurante');?></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
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
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
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
