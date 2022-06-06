<script src="https://kit.fontawesome.com/cf6a1ce200.js" crossorigin="anonymous"></script>

<div class="body-adm">
    <h1 class="text-center">Usuarios</h1>
    <a class="btn btn-success" href="usuario.php?accion=create" role="button">Agregar</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Correo</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $cont=0; foreach($usuarios as $usuario):?>
            <tr>
                <td><?php echo $usuario["id_usuario"];?></td>
                <td><?php echo $usuario["nombre"];?></td>
                <td><?php echo $usuario["apellido"];?></td>
                <td><?php echo $usuario["correo"];?></td>

                <td>
                    <a class="btn btn-danger" href="usuario.php?accion=delete&id=<?php echo $usuario["id_usuario"]; ?>"
                        role="button"><i class="fa-solid fa-trash-can"></i></a>
                    <a class="btn btn-info" href="usuario.php?accion=update&id=<?php echo $usuario["id_usuario"]; ?>"
                        role="button"><i class="fa-solid fa-pen-to-square"></i></a>

                </td>
            </tr>
            <?php $cont++; endforeach;  
            ?>
        </tbody>
    </table>
    <p class="text-right"><?php echo "Se encontraron: " .$cont. " registros."; ?></p>
</div>