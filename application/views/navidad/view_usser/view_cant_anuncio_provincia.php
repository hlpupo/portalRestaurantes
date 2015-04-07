<div id="pn_show_cant_anunci_provi" class="pn_ultimos_anuncios">
    <div class="pn_ultimos_anuncios_head  "><?php echo $title; ?></div>
    <div class="pn_conte_provincia_zona">
    <ul class="pn_list">
    <?php 
    foreach ($AnuncioProvinca as $value) {
         $t = $value->prenom." (". $value->cantidad.")";
         echo '<li>'.anchor('navidad/c_navidad/'.$accion.'/'.$value->id_province,$t ).'</li>';
        }
    ?>
        </ul>
        </div>
</div>
