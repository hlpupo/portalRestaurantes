
<div id="pn_login"  >
    <form action="<?php echo base_url()?>navidad/c_navidad/pn_login" method="post" class="form-inline">
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