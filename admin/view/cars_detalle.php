
    
    
    <h1 class="text-center">Detalle de Carrito</h1>
    <br>
    <div style="margin-top: 1%;  display: flex; align-items: center; justify-content: space-around;">
    <a class="btn btn-success" href="car.php?accion=createDetalle&id_car=<?php echo $idc?>&id_usuario=<?php echo $idu?>" role="button">Agregar</a>
    <a href="car.php?accion=reporte&id_car=<?php echo $idc?>&id_usuario=<?php echo $idu?>" role="button"><i style= "color: #706C6A; " class="fa-solid fa-file-pdf fa-3x"></i></a>
    </div>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Prenda</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Foto</th>
                <th scope="col">Talla</th>
                <th scope="col">Precio</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $cont=0; $total=0; $costo=0; foreach($carrito as $car):?>
            <tr>
                <td><?php echo $car["prenda"];?></td>
                <td><?php echo $car["cantidad"];?></td>
                <td><img class="rounded-circle"src="../<?php echo 
                $car["foto"] ?>" alt="" width="50" height="50"></td>
                <td><?php echo $car["talla"];?></td>
                <td><?php echo $car["precio"];?></td>
                <td><?php echo number_format(($car["precio"] * $car["cantidad"]),2); ?></td>
                <td>
                    <a href="car.php?accion=delete&id_prenda=<?php echo $car["id_prenda"];?>&id_car=<?php echo $idc;?>&id_usuario=<?php echo $idu;?>"
                        role="button"><i style= "color: #D54040;" class="fa-solid fa-trash-can fa-2x"></i></a>
                        <a 
                        href="car.php?accion=update&id_prenda=<?php echo $car["id_prenda"];?>&id_car=<?php echo $idc;?>&id_usuario=<?php echo $idu;?>"
                        role="button"><i style= "color: #396BCE;" class="fa-solid fa-pen-clip fa-2x"></i></a></td>
            </tr>
            <?php $total = $total + ($car["precio"] * $car["cantidad"]);?>
            <?php $costo = $costo + ($car["costo"] * $car["cantidad"]); ?>
            <?php $cont++; endforeach;  
            ?>

            <?php $ganancia = $total-$costo?>

            <?php $ganancia = number_format($ganancia, 2);
                $total = number_format($total, 2);
            ?>
        </tbody>
    </table>
    <p style="font-weight: bold;" class="text-center"><?php echo "Una venta total de : $" .$total. " "; ?></p>
    <p style="font-weight: bold;" class="text-center"><?php echo "Con una ganancia de : $" .$ganancia. " "; ?></p>

    
    