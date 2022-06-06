<?php if($accion=="create"):?>
<h1 class="text-center">Nuevo Descuento</h1>
<?php else: $accion="update"?>
<h1 class="text-center">Modificar Descuento</h1>
<?php endif; ?>

<div <div id="wrapper" class="container">
    <form method="POST" enctype="multipart/form-data"
        action="descuento.php?accion=<?php echo $accion;?><?php if($accion =="update") echo "&id=".$id; ?>">

        <label for="" class="form-label">Prenda: </label>
        <select name="data[id_prenda]" class="form-select" id="">
            <?php
            foreach($prendas as $prenda):
        ?>
            <option <?php if(isset($data["id_prenda"])){
        if($data["id_prenda"]==$prenda["id_prenda"]) echo
        "selected";} ?> value="<?php echo $prenda["id_prenda"]?>">
                <?php echo $prenda["prenda"]?></option>
            <?php endforeach;?>
        </select>
        <br>

        <label class="form-label">Porcentaje Descuento: </label>
        <input class="form-control" type="text"
            value="<?php echo ($accion=="update") && isset($data["porcentaje_desc"])?$data["porcentaje_desc"]:""; ?>"
            name="data[porcentaje_desc]" />

        <br>
        <input class="btn btn-primary" type="submit" value="Guardar Descuento" name="data[enviar]" />
    </form>
</div>