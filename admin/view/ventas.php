<h1 class="text-center">Ventas</h1>
<br>
<div style="margin-top: 1%;  display: flex; align-items: center; justify-content: space-around;">

    <button target="_blank" onclick="window.print();" <i style="color: #706C6A; "
        class="fa-solid fa-file-pdf fa-3x"></i></button>
</div>
<br>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Fecha</th>
            <th scope="col">Venta Total</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Correo</th>

        </tr>
    </thead>
    <tbody>

        <?php $cont=0; foreach($ventas as $venta):?>
        <tr>
            <td><?php echo $venta["id_venta"];?></td>
            <td><?php echo $venta["fecha"];?></td>
            <td><?php echo number_format($venta["venta_total"],2);?></td>
            <td><?php echo $venta["nombre"];?></td>
            <td><?php echo $venta["apellido"];?></td>
            <td><?php echo $venta["correo"];?></td>

        
            </td>
        </tr>
        <?php $cont++; endforeach;  
            ?>
    </tbody>
</table>
<p class="text-right"><?php echo "Se encontraron: " .$cont. " registros."; ?></p>