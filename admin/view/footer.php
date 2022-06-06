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
                    <?php if(!isset($_SESSION['validado'])) {?>
                    <li><a href="cliente_nuevo.form.php">Crear cuenta nueva</a></li>
                    <?php }?>
                    <?php if(!isset($_SESSION['validado'])) {?>
                    <li><a href="admin/login.php">Login</a></li>
                    <?php }?>
                    <?php if(isset($_SESSION['validado'])) {?>
                    <li><a href= <?php if(is_file("admin/index.php")){ echo "admin/index.php";}else{ echo "index.php";} ?>>Sistema</a></li>
                    <?php }?>

                    
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