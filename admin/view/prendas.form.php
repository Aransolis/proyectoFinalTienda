<?php if($accion=="create"):?>
<h1 class="text-center">Nueva Prenda</h1>
<?php else: $accion="update"?>
<h1 class="text-center">Modificar Prenda</h1>
<?php endif; ?>

<div <div id="wrapper" class="container">
    <div class="centrar">
        <form method="POST" enctype="multipart/form-data"
            action="prenda.php?accion=<?php echo $accion;?><?php if($accion =="update") echo "&id=".$id; ?>">
            <label class="form-label">Nombre de la prenda: </label>
            <input class="form-control" type="text" value="<?php echo ($accion=="update")?$data["prenda"]:""; ?>"
                name="data[prenda]" />
            <br>
            <label class="form-label">Cantidad en Existencia: </label>
            <input class="form-control" type="number" value="<?php echo ($accion=="update")?$data["cantidad"]:""; ?>"
                name="data[cantidad]" />
            <br>
            <label for="" class="form-label">Tipo de prenda: </label>
            <select name="data[id_tipo_prenda]" class="form-select" id="">
                <?php
            foreach($tipo_prendas as $tipo_prenda):
        ?>
                <option <?php if(isset($data["id_tipo_prenda"])){
        if($data["id_tipo_prenda"]==$tipo_prenda["id_tipo_prenda"]) echo
        "selected";} ?> value="<?php echo $tipo_prenda["id_tipo_prenda"]?>">
                    <?php echo $tipo_prenda["tipo_prenda"]?></option>
                <?php endforeach;?>
            </select>
            <br>
            <label class="form-label">Foto: </label>
            <input class="form-control" type="file" value="<?php echo ($accion=="update")? $data["foto"]:""; ?>"
                name="foto" />
            <br>
            <label class="form-label">Precio: </label>
            <input class="form-control" type="text" value="<?php echo ($accion=="update")?$data["precio"]:""; ?>"
                name="data[precio]" />
            <br>
            <label class="form-label">Costo: </label>
            <input class="form-control" type="number" value="<?php echo ($accion=="update")?$data["costo"]:""; ?>"
                name="data[costo]" />
            <br>
            <select name="data[genero]" class="form-select" id="">
                <option <?php if(isset($data["genero"])){
        if($data["genero"]=='Masculino') echo
        "selected";} ?> value="Masculino">
                    Masculino</option>

                <option <?php if(isset($data["genero"])){
        if($data["genero"]=='Mujer') echo
        "selected";} ?> value="Mujer">
                    Mujer</option>
            </select>
            <br>
            <br>

            <input class="btn btn-primary" type="submit" value="Guardar prenda" name="data[enviar]" />
        </form>
    </div>
</div>