
    <h1 class="text-center">Detalle de Carrito De</h1>
    <h2> <?php echo $carrito[0]['nombre']?> <?php echo $carrito[0]['apellido'] ?> </h2>
    
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Prenda</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Foto</th>
                <th scope="col">Talla</th>
                <th scope="col">Precio</th>
                <th scope="col">Subtotal</th>

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
                <td><?php echo ($car["precio"] * $car["cantidad"]); ?></td>

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

    
    