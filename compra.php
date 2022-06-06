<?php 
    require_once('class/prendas.class.php');     
    $id = isset($_GET['id'])?$_GET['id']:null;
    $id = is_numeric($id)?$id:null;
    
    $prendas = $PRENDAS->readOne($id);
    $accion = isset($_GET['accion'])?$_GET['accion']:null;
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TiendaProyecto</title>
    <link rel="stylesheet" href="css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/cf6a1ce200.js" crossorigin="anonymous"></script>
</head>

<body class="body">
    <?php include('admin/view/header.php')?>

    <br>
    <div class="row text-center">
        <div class="col">
            <img class="rounded-circle" src="<?php if(isset($prendas['foto'])){echo $prendas['foto'];}?>"
                style="height: 600px">
        </div>
        <div class="row text-center">
            <div class="col">
                <br>
                <h2 class=""><?php echo $prendas['prenda']?></h2>
                <br>
                <h2 style="color: black" class="">$ <?php echo $prendas['precio']?> MXN</h2>

                <br>
                <form method="POST" enctype="multipart/form-data"
                    action="admin/carCliente.php?accion=create&id="<?php echo $id ?>">
                    
                    <label class="form-label">Cantidad: </label>
                    <input class="form-control" name="data[cantidad]" id="" type="number">
                    <?php echo ($accion=="update")? $data["cantidad"]:""; ?></input>

                    <input class="form-control" value="<?php echo $id?>" name="data[id_prenda]" id="" type="hidden">
                    <?php echo ($accion=="update")? $data["id_prenda"]:""; ?></input>
        
                    <label class="form-label">Talla: </label>
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

                    <input class="btn btn-primary" type="submit" value="Agregar a Carrito" name="data[enviar]" />
                </form>

            </div>
        </div>
    </div>


    <br>

    <?php include('admin/view/footer.php')?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>