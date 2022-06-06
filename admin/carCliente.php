<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="../css/main.css">
<script src="https://kit.fontawesome.com/cf6a1ce200.js" crossorigin="anonymous"></script>
<?php
    require_once('../class/car.class.php');
    require_once('../class/prendas.class.php');
    require_once('../class/venta.class.php');
    require_once('../class/usuarios.class.php');

    
    $accion = isset($_GET['accion'])?$_GET['accion']:null;


    $idc = isset($_GET['id'])?$_GET['id']:null;
    $idc = is_numeric($idc)?$idc:null;
    
    $idu = isset($_GET['id_usuario'])?$_GET['id_usuario']:null;
    $idu = is_numeric($idu)?$idu:null;
    
    $prendas = $PRENDAS->read();
    
    include('view/header.php');
    switch($accion){
        case 'create':  
            $data=isset($_POST["data"])?$_POST["data"]:null;
            if(isset($data["enviar"])){
                
                $carrito=$CAR->create($data);
                if($CAR){
                    echo '<script>alert("Articulo dado de alta correctamente")</script>';
                    $carrito = $CAR->readClienteCarrito();
                    include("view/cars_detalle_cliente.php");
                    
                }
                else{
                    $CAR->alerta("Error al guardar el carrito", "danger");
                    $carrito = $CAR->readClienteCarrito();
                    include("view/cars_detalle_cliente.php");
                }
            }else{
                $carrito = $CAR->readClienteCarrito();
                include("view/cars_detalle_cliente.php");
            }
        case 'create2':  
            $data=isset($_POST["data"])?$_POST["data"]:null;
            if(isset($data["enviar"])){             
                $usuarios=$USUARIOS->createCliente($data);
                if($usuarios){
                    $USUARIOS->alerta("Usuario dada de alta correctamente", "success");                         
                }
                else{
                    $USUARIOS->alerta("Error al guardar el usuario", "danger");

                }
            }else{
                include("../index.php");
            }
                    
                break;
        case 'nuevoCliente':  
            $idc = isset($_GET['id_car'])?$_GET['id_car']:null;
            $venta = isset($_GET['ventaT'])?$_GET['ventaT']:null;
                    
            if(isset($idc)){
                        
                $ventas=$VENTA->create($idc, $venta);
                if($VENTA){
                    $VENTA->alerta("Venta dada de alta correctamente", "success");
                    $ventas = $VENTA->read();
                    $carrito = $CAR->readClienteCarrito();
                    include('view/cars_detalle_cliente.php');
                }else{
                    $VENTA->alerta("Error al guardar la venta", "danger");
                    $carrito = $CAR->readClienteCarrito();
    
                    include('view/cars_detalle_cliente.php');
                }}else{
                    $carrito = $CAR->readClienteCarrito();
                    include('view/cars_detalle_cliente.php');
                }
                    
            break;
            
            break;
        
        case 'getCurrentCar':  
            
            $carrito = $CAR->readClienteCarrito();

            include('view/cars_detalle_cliente.php');
                
            break;
        case 'createVenta':  
            $idc = isset($_GET['id_car'])?$_GET['id_car']:null;
            $venta = isset($_GET['ventaT'])?$_GET['ventaT']:null;
                
            if(isset($idc)){
                    
                $ventas=$VENTA->create($idc, $venta);
                if($VENTA){
                    $VENTA->alerta("Venta dada de alta correctamente", "success");
                    $ventas = $VENTA->read();
                    $carrito = $CAR->readClienteCarrito();

                    include('view/cars_detalle_cliente.php');
                        
                }
                else{
                    $VENTA->alerta("Error al guardar la venta", "danger");
                    $carrito = $CAR->readClienteCarrito();

                    include('view/cars_detalle_cliente.php');
                }
            }else{
                $carrito = $CAR->readClienteCarrito();

                include('view/cars_detalle_cliente.php');
            }
                
        break;
        case 'createDetalle':  
                
            break;
        case 'delete':
            $idp = isset($_GET['id_prenda'])?$_GET['id_prenda']:null;
                $idp = is_numeric($idp)?$idp:null;
            
                $idc = isset($_GET['id_car'])?$_GET['id_car']:null;
                $idc = is_numeric($idc)?$idc:null;

                $idu = $_SESSION['id_usuario'];

            $carrito = $CAR->delete($idp, $idc, $idu);
            if($carrito)
                $CAR->alerta("Registro borrado", "success");
            else
                $CAR->alerta("Registro no encontrado", "danger");
                
            $carrito = $CAR->readClienteCarrito();
            include('view/cars_detalle_cliente.php'); 
            break;
        case 'update':
            
            
                
            break;
        
    }
    include('view/footer.php');

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>