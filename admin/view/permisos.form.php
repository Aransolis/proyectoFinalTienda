<?php if($accion=="create"):?>
<h1 class="text-center">Nuevo Permiso</h1>
<?php else: $accion="update"?>
<h1 class="text-center">Modificar Permiso</h1>

<div <div id="wrapper" class="container">
    <?php endif; ?>
    <form method="POST" enctype="multipart/form-data"
        action="permiso.php?accion=<?php echo $accion;?><?php if($accion =="update") echo "&id=".$id; ?>">
        <label class="form-label">Permiso: </label>
        <input class="form-control" type="text" value="<?php echo ($accion=="update")?$data["permiso"]:""; ?>"
            name="data[permiso]" />

        <h3>Escoge el tipo de Rol</h3>

        <?php foreach($roles as $rol):?>
        <input <?php if(isset($misRoles)){if(in_array($rol['id_rol'], $misRoles)){ echo 
        " checked ";}}?> class="form-check-input" type="checkbox" name="rol[<?php echo 
        $rol['id_rol'] ?>]" />
        <label class="form-check-label" for="flexCheckChecked" for=""><?php echo $rol['rol'] ?></label>
        <?php endforeach; ?>
        <br>
        <input class="btn btn-primary" type="submit" value="Guardar permiso" name="data[enviar]" />
    </form>
</div>