<br>
<h1 class="text-center">Carrito</h1>
<br>
<div style="margin-top: 1%;  display: flex; align-items: center; justify-content: space-around;">

    <button target="_blank" onclick="window.print();" <i style="color: #706C6A; "
        class="fa-solid fa-print fa-3x"></i></button>
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
    
        <?php if(isset($carrito)){?>
        <?php $cont=0; $total=0; foreach($carrito as $car):?>
        <tr>
            <td><?php echo $car["prenda"];?></td>
            <td><?php echo $car["cantidad"];?></td>
            <td><img class="rounded-circle" src="../<?php echo 
                $car["foto"] ?>" alt="" width="50" height="50"></td>
            <td><?php echo $car["talla"];?></td>
            <td><?php echo $car["precio"];?></td>
            <td><?php echo number_format(($car["precio"] * $car["cantidad"]),2); ?></td>
            <td>
                <a href="carCliente.php?accion=delete&id_prenda=<?php echo $car["id_prenda"];?>&id_car=<?php echo $car['id_car']?>"
                    role="button"><i style="color: #D54040;" class="fa-solid fa-trash-can fa-2x"></i></a>
            </td>
        </tr>
        <?php $total = $total + ($car["precio"] * $car["cantidad"]);?>

        <?php $cont++; endforeach;  
            ?>



        <?php 
                $total2 = number_format($total, 2);
            ?>
        <?php } ?>
    </tbody>
</table>

<?php if(isset($carrito)){?>
<p style="font-weight: bold;" class="text-center"><?php echo "Venta total: $" .$total2. " "; ?></p>
<div style="margin-top: 1%;  display: flex; align-items: center; justify-content: space-around;">
    <a style="align: center"
        href="carCliente.php?accion=createVenta&id_car=<?php echo $car['id_car']?>&ventaT=<?php echo $total?>"
        role="button"><i style="color: #5BD874;" class="fa-solid fa-dollar-sign fa-5x"></i></a>
</div>
<?php }else{ ?>
<br>
<br>
<h2 class="text-center">El carrito esta vacío</h2>
<?php }?>
<br>