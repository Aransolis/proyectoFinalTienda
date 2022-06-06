<script src="https://kit.fontawesome.com/cf6a1ce200.js" crossorigin="anonymous"></script>
<h1 class="text-center">Permisos</h1>
<a class="btn btn-success" href="permiso.php?accion=create" role="button">Agregar</a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Permiso</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php $cont=0; foreach($permisos as $permiso):?>
        <tr>
            <td><?php echo $permiso["id_permiso"];?></td>
            <td><?php echo $permiso["permiso"];?></td>

            <td>
                <a class="btn btn-danger" href="permiso.php?accion=delete&id=<?php echo $permiso["id_permiso"]; ?>"
                    role="button"><i class="fa-solid fa-trash-can"></i></a>
                <a class="btn btn-info" href="permiso.php?accion=update&id=<?php echo $permiso["id_permiso"]; ?>"
                    role="button"><i class="fa-solid fa-pen-to-square"></i></a>
                
            </td>
        </tr>
        <?php $cont++; endforeach;  
            ?>
    </tbody>
</table>
<p class="text-right"><?php echo "Se encontraron: " .$cont. " registros."; ?></p>



