
<?php 
    require_once('../class/tiendaProyecto.class.php');
    include_once('view/header_sin_menu.php');
    

    $accion = isset($_GET['accion'])?$_GET['accion']:null;
    switch($accion){
        case 'login':
            if(isset($_POST['correo']) && isset($_POST['contrasena'])){
                $correo = $_POST['correo'];
                $contrasena = $_POST['contrasena'];
                if($tienda->validateEmail($correo)){
                    if($tienda->login($correo, $contrasena)){
                        include_once('index.php');                      
                    }else{
                        $tienda->alerta('Usuario y contraseña no validos ', 'danger');
                    }
                }
            }
            break;
        case 'olvido':
            if(isset($_POST['correo'])){
                $correo = $_POST['correo'];
                if($tienda->validateEmail($correo)){
                    if($tienda->recuperar($correo)){
                        echo 'OK';
                    }else{
                        $tienda->alertaError('Correo electronico no existe');
                    }
                }else{
                    $tienda->alertaError('Correo electronico no existe');
                }
            }
            include_once('view/login.olvido.php');
            
            break;

        case 'restablecer':
            if(isset($_GET['correo']) && isset($_GET['token'])){
                $correo = $_GET['correo'];
                $token = $_GET['token'];
                if($tienda->validarToken($correo,$token)){
                    include_once('view/login.restablecer.php');
                }else{
                    $tienda->alertaError('El token a caducado');
                }
            }else{
                $tienda->alertaError('Un error grave a ocurrido');
            }
            break;

            case 'nueva':
                if(isset($_GET['correo']) && isset($_POST['token']) && isset($_POST['contrasena'])){
                    $correo = $_GET['correo'];
                    $contrasena = $_POST['contrasena'];
                    $token = $_POST['token'];
                    if($tienda->validarToken($correo,$token)){
                        if($tienda->nuevaContrasena($correo,$contrasena,$token)){
                            $tienda->alerta('Su contraseña ha sido cambiada, por favor inicie sesion','success');
                            include_once('view/login.php');
                        }else{
                            echo 'error';
                        }
                    }else{
                        $tienda->alerta('El token a caducado','danger');
                    }
                }else{
                    $tienda->alerta('Un error grave a ocurrido','danger');
                }
                
    
                break;
        case 'logOut':
            $tienda->logOut();
            include_once('view/footer_administracion.php');
            break;
        default:
        include('view/login.php');
        
    }


?>