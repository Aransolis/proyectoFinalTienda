<?php 
$idu = isset($_GET['id_usuario'])?$_GET['id_usuario']:null;
$idu = is_numeric($idu)?$idu:null;

$idc = isset($_GET['id_car'])?$_GET['id_car']:null;
$idc = is_numeric($idc)?$idc:null;


?>

<?php if($accion=="createDetalle"):?>
<h1 class="text-center">Agregar Articulo a Carrito</h1>
<?php else: $accion="update"?>
<h1 class="text-center">Modificar Articulo a Carrito</h1>
<?php endif; ?>


<div id="wrapper" class="container">
    <form method="POST" enctype="multipart/form-data" action="car.php?accion=<?php echo $accion;?>">

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
        <br>
        <label class="form-label">Cantidad: </label>
        <input class="form-control" type="text"
            value="<?php echo ($accion=="update")&& isset($data["cantidad"])? $data["cantidad"]:""; ?>"
            name="data[cantidad]" />
        <br>

        <input class="form-control" type="hidden" value="<?php echo $idc?>" name="data[id_car]" />
        <input class="form-control" type="hidden" value="<?php echo $idu?>" name="data[id_usuario]" />
        <br>

        <select name="data[talla]" class="form-select" id="">
            <option <?php if(isset($data["talla"])){
        if($data["talla"]=='EXCH') echo
        "selected";} ?> value="EXCH">
                EXCH</option>
            <option <?php if(isset($data["talla"])){
        if($data["talla"]=='CHI') echo
        "selected";} ?> value="CHI">
                CHI</option>
            <option <?php if(isset($data["talla"])){
        if($data["talla"]=='MED') echo
        "selected";} ?> value="MED">
                MED</option>
            <option <?php if(isset($data["talla"])){
        if($data["talla"]=='GDE') echo
        "selected";} ?> value="GDE">
                GDE</option>
            <option <?php if(isset($data["talla"])){
        if($data["talla"]=='EX') echo
        "selected";} ?> value="EX">
                EX</option>
        </select>
        <br>
        <br>
        <input class="btn btn-primary" type="submit" value="Guardar prenda" name="data[enviar]" />
    </form>
</div>