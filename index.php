<?php 
    require_once('class/tipo_prenda.class.php');     
    $tipo_prendas = $TIPO_PRENDAS->read();              
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
    <div id="contenido" class="row">
        <div class="col">
            <main>
                <br>

                <h2 class="text-center">Categorías que te podrían gustar <?php if(isset($_SESSION['nombre'])){echo $_SESSION['nombre'];;}else{ '';}?> </h2>
                <br>
                <?php
                        $renglon = 0;
                        foreach($tipo_prendas as $tipo_prenda):
                    ?>
                <?php 

                    if($renglon % 3 == 0 or $renglon == 0):$col = 0; ?>
                <div class="row text-center">
                    <?php endif; ?>
                    <div class="col">
                        <?php $col++; ?>
                        <img class="rounded-rounded img-thumbnail" src="<?php echo $tipo_prenda["foto"];?>">
                        <h2><?php echo $tipo_prenda["tipo_prenda"];?></h2>
                    </div><!-- /.col-lg-4 -->
                    <?php if($col % 3 == 0): ?>
                </div><!-- /.row -->
                <?php endif;?>
                <?php 
                        $renglon++;
                        endforeach;
                    ?>
            </main>
        </div>

    </div>
    <br>
    <br>
    <?php include('admin/view/footer.php')?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>