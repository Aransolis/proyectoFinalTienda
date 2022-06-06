<?php if($accion=="create"):?>
<h1 class="text-center">Nuevo Tipo de prenda </h1>
<?php else: $accion="update"?>
<h1 class="text-center">Modificar tipo de Prenda</h1>
<?php endif; ?>

<div <div id="wrapper" class="container">
    <div class="centrar">
        <form method="POST" enctype="multipart/form-data"
            action="tipo_prenda.php?accion=<?php echo $accion;?><?php if($accion =="update") echo "&id=".$id; ?>">
            <label class="form-label">Nombre Tipo Prenda: </label>
            <input class="form-control" type="text" value="<?php echo ($accion=="update")?$data["tipo_prenda"]:""; ?>"
                name="data[tipo_prenda]" />
            <br>

            <label class="form-label"> Foto: </label>
            <input class="form-control" type="file" value="<?php echo ($accion=="update")? $data["foto"]:""; ?>"
                name="foto" />
            <br>

            <br>
            <br>

            <input class="btn btn-primary" type="submit" value="Guardar prenda" name="data[enviar]" />
        </form>
    </div>
</div>