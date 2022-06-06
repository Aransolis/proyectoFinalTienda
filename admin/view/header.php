<?php 
if(isset($CAR)){
    $sliders = $CAR->getAllSlider();
}else{
    $sliders = $tienda->getAllSlider();
}

?>

<div id="wrapper" class="container">
    <div class="row">
        <div class="col">
            <header>
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php foreach($sliders as $slider):?>
                            <?php $ruta=$slider['imagen'];
                                if(is_file($ruta)){}else{$ruta = "../".$ruta;}?>
                        <div class="carousel-item <?php if($slider['prioridad']===1): echo "active"; endif;?>">
                            <img src="<?php echo $ruta?>" class="d-block w-100" alt="<?php $slider['slider'] ?>">
                            <?php if($slider['prioridad']===2):?>
                            <div class="carousel-caption d-none d-md-block">
                                <h8>TENDENCIAS</h8>
                                <h5>Variedad de articulos de temporada.</h5>
                            </div>
                            <?php endif;?>
                        </div>
                        <?php endforeach;?>

                    </div>

                </div>
            </header>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <nav class="navbar navbar-expand-lg" style="background-color:#AEB6BF;">
                <div class="container-fluid ">
                    <a class="navbar-brand"
                        href=<?php if(file_exists("../index.php")){ echo "../index.php";}else{ echo "index.php";} ?>>Inicio</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Hombre
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item"
                                            href=<?php if(file_exists("../articulos.php")){  echo "../articulos.php?genero=Masculino&id=8";}else{ echo "articulos.php?genero=Masculino&id=8";} ?>>Playeras</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href=<?php if(file_exists("../articulos.php")){  echo "../articulos.php?genero=Masculino&id=8";}else{ echo "articulos.php?genero=Masculino&id=9";} ?>>Camisa</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href=<?php if(file_exists("../articulos.php")){  echo "../articulos.php?genero=Masculino&id=8";}else{ echo "articulos.php?genero=Masculino&id=1";} ?>>Deportivo</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href=<?php if(file_exists("../articulos.php")){  echo "../articulos.php?genero=Masculino&id=8";}else{ echo "articulos.php?genero=Masculino&id=6";} ?>>Tenis</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href=<?php if(file_exists("../articulos.php")){  echo "../articulos.php?genero=Masculino&id=8";}else{ echo "articulos.php?genero=Masculino&id=7";} ?>>Tenis
                                            Deportivos</a></li>
                                    <li><a class="dropdown-item"
                                            href=<?php if(file_exists("../articulos.php")){  echo "../articulos.php?genero=Masculino&id=8";}else{ echo "articulos.php?genero=Masculino&id=4";} ?>>Pantalones</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href=<?php if(file_exists("../articulos.php")){  echo "../articulos.php?genero=Masculino&id=8";}else{ echo "articulos.php?genero=Masculino&id=5";} ?>>Short</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item"
                                            href=<?php if(file_exists("../articulos.php")){  echo "../articulos.php?genero=Masculino&id=8";}else{ echo "articulos.php?genero=Masculino&id=0";} ?>>Ofertas</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Mujer
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item"
                                            href=<?php if(file_exists("../articulos.php")){  echo "../articulos.php?genero=Mujer&id=3";}else{ echo "articulos.php?genero=Mujer&id=3";} ?>>Blusas</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href=<?php if(file_exists("../articulos.php")){  echo "../articulos.php?genero=Mujer&id=1";}else{ echo "articulos.php?genero=Mujer&id=1";} ?>>Deportivo</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href=<?php if(file_exists("../articulos.php")){  echo "../articulos.php?genero=Mujer&id=6";}else{ echo "articulos.php?genero=Mujer&id=6";} ?>>Tenis</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href=<?php if(file_exists("../articulos.php")){  echo "../articulos.php?genero=Mujer&id=7";}else{ echo "articulos.php?genero=Mujer&id=7";} ?>>Tenis
                                            Deportivos</a></li>
                                    <li><a class="dropdown-item"
                                            href=<?php if(file_exists("../articulos.php")){  echo "../articulos.php?genero=Mujer&id=2";}else{ echo "articulos.php?genero=Mujer&id=2";} ?>>Embarazada</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href=<?php if(file_exists("../articulos.php")){  echo "../articulos.php?genero=Mujer&id=4";}else{ echo "articulos.php?genero=Mujer&id=4";} ?>>Pantalones</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href=<?php if(file_exists("../articulos.php")){  echo "../articulos.php?genero=Mujer&id=5";}else{ echo "articulos.php?genero=Mujer&id=5";} ?>>Short</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item"
                                            href=<?php if(file_exists("../articulos.php")){  echo "../articulos.php?genero=Mujer&id=0";}else{ echo "articulos.php?genero=Mujer&id=0";} ?>>Ofertas</a>
                                    </li>
                                </ul>
                            </li>
                            <?php if(isset($_SESSION['correo'])){?>
                            <a class="navbar-brand"
                                href='../tiendaProyecto/admin/carCliente.php?accion=getCurrentCar'>Carrito</a>

                            <?php }?>

                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>