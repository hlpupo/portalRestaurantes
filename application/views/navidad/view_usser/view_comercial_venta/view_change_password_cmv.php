<div>
<ul class="breadcrumb">
                        <li><a href="#" ><?php echo anchor('navidad/c_navidad/pn_comercial_venta', 'Inicio');?></a> <span class="divider">/</span></li>
                        <li class="active"><a href="#">Cambiar contrase&ntilde;a</a> </li>
                    </ul>
</div>
<div id="pn_Panneau_GaucheCMP">
    <div id="pn_Panneau_Utilisateur" >
             <?php
                                if (isset($informacion)) {
                                    echo $informacion;
                                }
                                ?>
                    <div id="pn_show_change_password">
                        <fieldset>
                            <h3>Cambiar contrase&ntilde;a</h3>
                            <form class="well" action="pn_change_password_cmv" method="POST">
                                      <div class="control-group">
                                          <label class="control-label_usser control-label " for="name">Contrase&ntilde;a anterior</label>
                                            <div class="control-label_usser controls ">
                                                <input type="password" class="span3" id="pn_old_password" name="pn_old_password" >
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label_usser control-label" for="name">Nueva contrase&ntilde;a </label>
                                            <div class="control-label_usser controls">
                                                <input type="password" class="span3" id="pn_new_password" name="pn_new_password">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                                <label class="control-label_usser control-label" for="name">Repetir nueva contrase&ntilde;a </label>
                                                <div class="control-label_usser controls">
                                                    <input type="password" class="span3" id="pn_repeat_password" name="pn_repeat_password">
                                                </div>
                                            </div>
                                    <button type="submit" class="btn btn-danger">Cambiar contrase&ntilde;a</button>
                                </form>
                        </fieldset>
                    </div>
        </div>
    </div>
   


