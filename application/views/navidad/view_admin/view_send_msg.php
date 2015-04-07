<div id="pn_Panneau_Gauche" >
    <?php
    if (isset($informacion)) {
        echo $informacion;
    }
    ?>
    <div id="pn_admin_show_table_promociones">
        <form action="pn_send_msg" method="POST" >
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Para</th>
                        <th>
                            <select id="pn_destinatario" name="pn_destinatario" class="pn_select">
                                <?php
                                foreach ($comerciales as $value) {
                                    ?>
                                    <option value="<?php echo $value->email; ?>"><?php echo $value->email; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <label class="add" id="pn_add_destinatario"></label>
                            <textarea class="span7" rows="2" id="pn_list_destinatario" name="pn_list_destinatario"></textarea>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Texto</td>
                        <td><textarea class="span7" rows="6" id="pn_msg" name="pn_msg"></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="text-align: right;"><input type="submit" value="Enviar" class="btn btn-danger"></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>


</div>

<script>
    $(document).ready(function(){
        $("#pn_add_destinatario").click(function(){
            var dest = $("#pn_destinatario").val();
            var text = $("#pn_list_destinatario").val();
            if(text == "")
            {
                $("#pn_list_destinatario").val(dest);
            }
            else
            {
                text = text+","+dest;
                $("#pn_list_destinatario").val(text);
            }
        })
    })
</script>