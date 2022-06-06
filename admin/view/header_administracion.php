<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/main.css">
    <script src="https://kit.fontawesome.com/cf6a1ce200.js" crossorigin="anonymous"></script>

    <title >Administracción Tienda</title>
</head>

<body>
    <div class="admin-head">
        <nav class="navbar navbar-expand-lg admin">
            <a style="color: black; font-weight: bold;" class="navbar-brand" href="index.php">Administracion</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">

                    <?php 
                
                    foreach($_SESSION['roles'] as $key => $value){
                        if(file_exists("view/menu.".$value.".php")){
                            include("view/menu.".$value.".php");
                        }                              
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Regresa Tienda</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="login.php?accion=logOut">Salir</a>
                    </li>
                </ul>

            </div>
        </nav>
    </div>
    <br><br>