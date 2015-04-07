<div>
<ul class="breadcrumb">
    <li><a href="#" ><?php echo anchor('navidad/c_navidad/pn_vista_restaurante', 'Inicio'); ?></a> <span class="divider">/</span></li>
    <li class="active"><a href="#">Listado de Menu Disponibles</a> </li>
</ul>
</div>
<div id="pn_Panneau_GaucheRest">
    <div id="pn_Panneau_Utilisateur" >
                <div id="pn_cont_information_usser_corp" class="pn_cont_information_corp">
                    <div id="pn_show_ficha_tecnica"></div>
                    <div id="pn_cont_add_menu_foto">
                        

                        <ul class="nav nav-tabs" id="myTab">
                            <li class=""><a data-toggle="tab" href="#home">Foto</a></li>
                            <li class=""><a data-toggle="tab" href="#pn_ver_img">Ver Fotos</a></li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div id="home" class="tab-pane fade">
                                    <?php
                                if (isset($informacion)) {
                                    echo $informacion;
                                }
                                ?>
                                <?php echo form_open_multipart('navidad/c_navidad/pn_menu_foto_upload'); ?>
                                
                                <input type="file" name="userfile" size="20" />
                                <br /><br />
                                <input type="submit" value="upload" />
                                </form>
                            </div>
                              <div id="pn_ver_img" class="tab-pane fade">
                                    <?php
                                if (isset($informacion)) {
                                    echo $informacion;
                                }
                                ?>
                              
                            </div>
                        </div>
                        
                        
                    </div >
                </div>
        </div>
    </div>
    <div id="pn_Panneau_Droit">
        <div id="pn_Debut_Section" >
        <?php
        if(isset($dataUsser))
        {
        echo $dataUsser; 
        }?>
    </div>
        
       
    </div>
