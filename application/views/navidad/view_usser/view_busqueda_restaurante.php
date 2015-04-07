<div class="pn_cont_busqueda">
    <div class="pn_ultimos_anuncios_head  ">Buscar Restaurante</div>
    <form action="<?php echo base_url();?>index.php/navidad/c_navidad/pn_show_find_restaurante" method="POST">
        <table class="pn_cont_busqueda_table">
            <tbody>
                <tr>
                    <td></td>
                    <td>Provincia</td>
                    <td><select id="pn_find_Provincia" name="pn_find_Provincia" class="span2 pn_select">
                             <option value="-1"> - Cualquiera -</option>
                            <?php
                            foreach ($provincia as $value) {
                                ?>
                                <option value="<?php echo $value->id_province; ?>"> <?php echo $value->prenom; ?></option>
                            <?php }
                            ?>
                        </select></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Zona</td>

                    <td><select id="pn_find_municipio" name="pn_find_municipio" class="span2 pn_select">
                             <option value="-1"> - Cualquiera -</option>
                           
                        </select></td>
                </tr>
                <tr >
                    <td colspan="3" class="pn_cont_busqueda_table_check"> &Uacute;ltimos restaurantes <input type="checkbox" value="1" name="ultimosAnuncios" class=""></td>
                </tr>
                <tr>
                    <td colspan="3" class="pn_cont_busqueda_table_check">  Restaurantes con &eacute;xitos  <input type="checkbox" value="1" name="restaurante_Exitos" class=""></td>
                </tr>
            </tbody>
        </table>
        <div class="form-actions_find">
        <button class="btn btn-danger btn-small" type="submit"><i class="icon-search icon-white"></i>Buscar</button>
      </div>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#pn_find_Provincia").change(function(){
            var id = $(this).val();
                $.getJSON($.ruta.host+'index.php/navidad/c_navidad/pn_obtener_municipalite',{
                    "id":id
                },function(data){
                    $("#pn_find_municipio").empty();
                    $("#pn_find_municipio").html(' <option value="-1"> - Cualquiera -</option>');
                    
                    for(var i =0; i< data.length; i++)
                    {
                        var option = "<option value="+data[i].id_municipalite +">"+ data[i].prenom+"</option>"
                        $("#pn_find_municipio").append(option);
                    }
                })
        })
    })
</script>