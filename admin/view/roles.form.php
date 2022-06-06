<?php if($accion=="create"):?>
<h1 class="text-center">Nuevo Rol</h1>
<?php else: $accion="update"?>
<h1 class="text-center">Modificar Rol</h1>

<?php endif; ?>
<div <div id="wrapper" class="container">
    <form method="POST" enctype="multipart/form-data"
        action="rol.php?accion=<?php echo $accion;?><?php if($accion =="update") echo "&id=".$id; ?>">
        <label class="form-label">Nombre del Rol: </label>
        <input class="form-control" type="text" value="<?php echo ($accion=="update")? $data["rol"]:""; ?>"
            name="data[rol]" />
        <br>
        <input class="btn btn-primary" type="submit" value="Guardar Rol" name="data[enviar]" />
    </form>
</div>