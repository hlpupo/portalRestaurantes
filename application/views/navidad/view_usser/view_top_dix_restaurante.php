<div class="pn_ultimos_anuncios " id="pn_top_dix">
    <label>Top 10 Restaurante</label>
    <div>
            <ul>
        <?php 
       
        foreach ($topDixRestaurante as $value) {
            echo '<li>'.$value->nombre.'</li>';
        }?>
     </ul>
    </div>
</div>
