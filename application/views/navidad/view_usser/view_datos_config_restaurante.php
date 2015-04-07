<div>
    <table class="table">
        <thead>
            <tr>
                <th colspan="3">Presupuestos</th>
                <th> </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td>enviados</td>
                <td><?php echo $cantPresEnviado;?></td>
            </tr>
            <tr>
                <td></td>
                <td>Aceptados</td>
                <td><?php echo $cantPresAcept;?></td>
            </tr>

        </tbody>
    </table>
    <table class="table">
        <thead>
            <tr>
                <th colspan="3">Datos </th>
                <th> </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td>Tipo de registro</td>
                <td><?php echo $tipoRegistro;?></td>
            </tr>
            <tr>
                <td></td>
                <td>Fotos</td>
                <td><?php echo $configregistro['FotosHechas'].' / '.$configregistro['FotosTotal'];?></td>
            </tr>
            <tr>
                <td></td>
                <td>Presupuesto</td>
                <td><?php echo $configregistro['pedidosHechos'].' / '.$configregistro['pedidoTotal'];?></td>
            </tr>

        </tbody>
    </table>
</div>
