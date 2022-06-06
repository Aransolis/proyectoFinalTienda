<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="../css/main.css">
<script src="https://kit.fontawesome.com/cf6a1ce200.js" crossorigin="anonymous"></script>
<?php 
    require_once('../class/tiendaProyecto.class.php');
    require_once('../class/prendas.class.php');
    $tienda->validatePermiso('Portada');
    $prendas = $PRENDAS->readPrendasCantidad();

    include('view/header_administracion.php');
?>

<body>
    <h1 class="text-center">Bienvenido al Sistema <?php echo $_SESSION['nombre']?></h1>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <html>

    <head>
        <!--Load the AJAX API-->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
        // Load the Visualization API and the corechart package.
        google.charts.load('current', {
            'packages': ['corechart']
        });

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {

            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Tipo Preda');
            data.addColumn('number', 'Cantidad');
            data.addRows([
                <?php 
            foreach($prendas as $prenda){
            echo "['".$prenda['tipo_prenda']."', ".$prenda['cantidad']."],";
                    }
                    
                    ?>

            ]);

            // Set chart options
            var options = {
                'title': 'Cantidad De Drendas',
                'width': 700,
                'height': 600
            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
        </script>
    </head>

    <body>
        <!--Div that will hold the pie chart-->
        <div id="chart_div"></div>
    </body>

    </html>
    <footer>
        <div class="footer ">
            <div class="row ">
                <div class="col">
                    <h3>Siganos</h3>
                </div>
                <div class="col">
                    <h3>Enlaces Rápidos</h3>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="col d-flex justify-content-around">
                        <a href="https://www.facebook.com/"><i class="fa-brands fa-facebook fa-3x"></i></a>
                        <a href="https://www.whatsapp.com/"><i class="fa-brands fa-whatsapp fa-3x"></i></a>
                        <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram fa-3x"></i></a>
                        <a href="https://www.instagram.com/"><i class="fa-brands fa-twitter fa-3x"></i></a>
                    </div>
                </div>
                <div class="col">
                    <ul>
                        <li><a href="#">Atención al Cliente</a></li>

                        <li><a href='nosotros.php'>About Us</a></li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <P>D'MODA ©2022 | Diseño y Estilo</P>
                    <P>Todos los derechos reservados</P>
                </div>
            </div>
        </div>
    </footer>
</body>