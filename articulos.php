<?php 
    require_once('class/prendas.class.php');
    require_once('class/tipo_prenda.class.php');
    require_once('class/descuento.class.php');             

    $genero = isset($_GET['genero'])?$_GET['genero']:null;
    $id = isset($_GET['id'])?$_GET['id']:null;
    $id = is_numeric($id)?$id:null;

    if ($id !=0){
        $prendas = $PRENDAS->readGenero($id, $genero);
        $tipo= $TIPO_PRENDAS->readOne($id);  
    }else{
        $prendas = $PRENDAS->readDescuento($genero); 
        $tipo='';
    }


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

    <main>
        <br>
        <h2 class="text-center">Articulos de tipo <?php if ($id != 0) echo $tipo['tipo_prenda']; else echo 'Ofertas' ?> Para <?php echo $genero ?></h2>
        <br>
        <?php
                        $renglon = 0;
                        foreach($prendas as $prenda):
                    ?>
        <?php 

                    if($renglon % 3 == 0 or $renglon == 0):$col = 0; ?>
        <div class="row text-center">
            <?php endif; ?>
            <div class="col">
                <?php $col++; ?>
                <img class="rounded-rounded img-thumbnail" src="<?php echo $prenda["foto"];?>">
                <h2><?php echo $prenda["prenda"];?></h2>
                <h3 style="color: black">$<?php echo $prenda["precio"];?> MXN</h3>
                <?php if($id==0){?>
                <h3 style="color: red"><?php echo floatval($prenda["porcentaje_desc"])*100;?> % DESCUENTO</h3>
                <?php } ?>
                <p><a class="btn btn-secondary <?php if(!isset($_SESSION['correo'])){echo 'disabled';}else{ '';}?>" href="compra.php?id=<?php echo $prenda['id_prenda']?>">Ver más &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
            <?php if($col % 3 == 0): ?>
        </div><!-- /.row -->
        <?php endif;?>
        <?php 
                        $renglon++;
                        endforeach;
                    ?>
    </main>
    <?php include('admin/view/footer.php')?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>