<h1 class="text-center">Roles</h1>
<a class="btn btn-success" href="rol.php?accion=create" role="button">Agregar</a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Rol</th>

        </tr>
    </thead>
    <tbody>
        <?php $cont=0; foreach($roles as $rol):?>
        <tr>
            <td><?php echo $rol["id_rol"];?></td>
            <td><?php echo $rol["rol"];?></td>
            <td>
                <a class="btn btn-info" href="rol.php?accion=update&id=<?php echo $rol["id_rol"];?>" role="button"><i
                        class="fa-solid fa-pen-to-square"></i></a>
                <a class="btn btn-danger" href="rol.php?accion=delete&id=<?php echo $rol["id_rol"];?>" role="button"><i
                        class="fa-solid fa-trash-can"></i></a>
            </td>
        </tr>
        <?php $cont++; endforeach;  
            ?>
    </tbody>
</table>
<p class="text-right"><?php echo "Se encontraron: " .$cont. " registros."; ?></p>