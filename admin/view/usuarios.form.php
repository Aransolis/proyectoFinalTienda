<?php if($accion=="create"):?>
<h1 class="text-center">Nuevo Usuario</h1>
<?php else: $accion="update"?>
<h1 class="text-center">Modificar Usuario</h1>


<?php endif; ?>
<div <div id="wrapper" class="container">
    <form method="POST" enctype="multipart/form-data"
        action="usuario.php?accion=<?php echo $accion;?><?php if($accion =="update") echo "&id=".$id; ?>">
        <label class="form-label">Correo del usuario: </label>
        <input class="form-control" type="text" value="<?php echo ($accion=="update")?$data["correo"]:""; ?>"
            name="data[correo]" />
        <br>
        <label class="form-label">Contraseña del usuario: </label>
        <input class="form-control" type="password" value="" name="data[contrasena]" />
        <br>
        <h3>Escoge el tipo de Rol</h3>


        <?php foreach($roles as $rol):?>
        <input <?php if(isset($misRoles)){if(in_array($rol['id_rol'], $misRoles)){ echo 
        " checked ";}}?> class="form-check-input" type="checkbox" name="rol[<?php echo 
        $rol['id_rol'] ?>]" />
        <label class="form-check-label" for="flexCheckChecked" for=""><?php echo $rol['rol'] ?></label>
        <?php endforeach; ?>
        <br>
        <br>
        <label class="form-label">Nombre: </label>
        <input class="form-control" type="text" value="<?php echo ($accion=="update")?$data["nombre"]:""; ?>" name="data[nombre]" />
        <br>
        <label class="form-label">Apellido: </label>
        <input class="form-control" type="text" value="<?php echo ($accion=="update")?$data["apellido"]:""; ?>" name="data[apellido]" />
        <br>
        
        <input class="btn btn-primary" type="submit" value="Guardar Usuario" name="data[enviar]" />
        <br>
        <br>
    </form>
</div>