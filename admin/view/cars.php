<link rel="stylesheet" href="../../css/main.css">
<script src="https://kit.fontawesome.com/cf6a1ce200.js" crossorigin="anonymous"></script>

    <h1 class="text-center">Carrito</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id Carrito</th>
                <th scope="col">Usuario</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $cont=0; foreach($carrito as $car):?>
            <tr>
                <td><?php echo $car["id_car"];?></td>
                <td><?php echo $car["correo"];?></td>
                <td><a  
                        href="car.php?accion=delete&id=<?php echo $car["id_car"]; ?>"
                        role="button"><i style= "color: #D54040;" class="fa-solid fa-trash-can fa-2x"></i></a>
                        <a href="car.php?accion=detalles&id=<?php echo $car["id_car"]; ?>&id_usuario=<?php echo $car["id_usuario"]; ?>"
                        role="button"><i style= "color: #396BCE;" class="fa-solid fa-cart-shopping fa-2x"></i></a></td>
            </tr>
            <?php $cont++; endforeach;  
            ?>
        </tbody>
    </table>
    <p style="font-weight: bold;"class="text-right"><?php echo "Se encontraron: " .$cont. " registros."; ?></p>
    