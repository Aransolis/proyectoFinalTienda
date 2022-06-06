
    <h1 class="text-center">Tipo prendas</h1>
    <a class="btn btn-success" href="tipo_prenda.php?accion=create" role="button">Agregar</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tipo Prenda</th>
                <th scope="col">Foto</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $cont=1; foreach($tipo_prendas as $tipo_prenda):?>
            <tr>
                <td><?php echo $tipo_prenda["id_tipo_prenda"];?></td>
                <td><?php echo $tipo_prenda["tipo_prenda"];?></td>
                <td><img class="rounded-circle"src="../<?php echo 
                $tipo_prenda["foto"] ?>" alt="" width="50" height="50"></td>
                

                <td><a href="tipo_prenda.php?accion=delete&id=<?php echo $tipo_prenda["id_tipo_prenda"]; ?>"
                        role="button"><i style= "color: #D54040;" class="fa-solid fa-trash-can fa-2x"></i></a>
                        <a  
                        href="tipo_prenda.php?accion=update&id=<?php echo $tipo_prenda["id_tipo_prenda"]; ?>"
                        role="button"><i style= "color: #396BCE;" class="fa-solid fa-pen-to-square fa-2x"></i></a></td>
            </tr>
            <?php $cont++; endforeach;  
            ?>
        </tbody>
    </table>
    <p class="text-right"><?php echo "Se encontraron: " .$cont. " registros."; ?></p>
    