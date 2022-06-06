
    <h1 class="text-center">Prendas</h1>
    <a class="btn btn-success" href="prenda.php?accion=create" role="button">Agregar</a>
    <br>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Prenda</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Tipo Prenda</th>
                <th scope="col">Foto</th>
                <th scope="col">Precio</th>
                <th scope="col">Costo</th>
                <th scope="col">Genero</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $cont=1; foreach($prendas as $prenda):?>
            <tr>
                <td><?php echo $prenda["id_prenda"];?></td>
                <td><?php echo $prenda["prenda"];?></td>
                <td><?php echo $prenda["cantidad"];?></td>
                <td><?php echo $prenda["id_tipo_prenda"];?></td>
                <td><img class="rounded-circle"src="../<?php echo 
                $prenda["foto"] ?>" alt="" width="50" height="50"></td>
                <td><?php echo $prenda["precio"];?></td>
                <td><?php echo $prenda["costo"];?></td>
                <td><?php echo $prenda["genero"];?></td>
                <td><a href="prenda.php?accion=delete&id=<?php echo $prenda["id_prenda"]; ?>"
                        role="button"><i style= "color: #D54040;" class="fa-solid fa-trash-can fa-2x"></i></a>
                        <a  
                        href="prenda.php?accion=update&id=<?php echo $prenda["id_prenda"]; ?>"
                        role="button"><i style= "color: #396BCE;" class="fa-solid fa-pen-to-square fa-2x"></i></a></td>
            </tr>
            <?php $cont++; endforeach;  
            ?>
        </tbody>
    </table>
    <p class="text-right"><?php echo "Se encontraron: " .$cont. " registros."; ?></p>
    