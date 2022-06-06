<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="../css/main.css">
<script src="https://kit.fontawesome.com/cf6a1ce200.js" crossorigin="anonymous"></script>
<?php
    require_once('../class/car.class.php');
    require_once('../class/prendaS.class.php');
    require_once('../class/venta.class.php');
    
    $CAR->validateRol('Empleado');
    
    $accion = isset($_GET['accion'])?$_GET['accion']:null;


    $idc = isset($_GET['id'])?$_GET['id']:null;
    $idc = is_numeric($idc)?$idc:null;
    
    $idu = isset($_GET['id_usuario'])?$_GET['id_usuario']:null;
    $idu = is_numeric($idu)?$idu:null;
    
    $prendas = $PRENDAS->read();
    
    include('view/header_administracion.php');
    switch($accion){
        case 'create':  
            
            $data=isset($_POST["data"])?$_POST["data"]:null;
            if(isset($data["enviar"])){
                
                $carrito=$CAR->create($data);
                if($CAR){
                    echo '<script>alert("Articulo dado de alta correctamente")</script>';
                    header("Refresh:0; url=../index.php");
                    
                }
                else{
                    $CAR->alerta("Error al guardar el carrito", "danger");
                    include("view/cars.form.php");
                }
            }else{
                
                include("view/cars.form.php");
            }
            
            break;
        
        case 'getCurrentCar':  
            
            $carrito = $CAR->readClienteCarrito();
            include('view/cars_detalle_cliente.php');
                
            break;

        case 'createDetalle':  
            $idc = isset($_GET['id_carrito'])?$_GET['id_carrito']:null;
            $idc = is_numeric($idc)?$idc:null;


            

            $data=isset($_POST["data"])?$_POST["data"]:null;
            if(isset($data["enviar"])){  

                $carrito=$CAR->createSimp($data);
                    if($CAR){
                        $CAR->alerta("Articulo dado de alta correctamente", "success");
                        $carrito = $CAR->read();
                        include('view/cars.php');
                        
                    }
                    else{
                        $CAR->alerta("Error al guardar el carrito", "danger");
                        include("view/cars.form.php");
                    }
                }else{
                    
                    
                    include("view/cars.form.php");
                }
                
            break;
        case 'delete':
            $idp = isset($_GET['id_prenda'])?$_GET['id_prenda']:null;
                $idp = is_numeric($idp)?$idp:null;
            
                $idc = isset($_GET['id_car'])?$_GET['id_car']:null;
                $idc = is_numeric($idc)?$idc:null;

                $idu = isset($_GET['id_usuario'])?$_GET['id_usuario']:null;
                $idu = is_numeric($idu)?$idu:null;

            $carrito = $CAR->delete($idp, $idc, $idu);
            if($carrito)
                $CAR->alerta("Registro borrado", "success");
            else
                $CAR->alerta("Registro no encontrado", "danger");
            $carrito = $CAR->read();
            include('view/cars.php'); 
            break;
        case 'update':
            
            $data=isset($_POST["data"])?$_POST["data"]:null;
            
            if(isset($data["enviar"])){

                    $carrito=$CAR->update($data);              
                    if($carrito){
                        $CAR->alerta("Carrito actualizado correctamente", "success");
                        $carrito = $CAR->read();
                        include('view/cars.php');  
                    }
                    else{
                        $CAR->alerta("Error al guardar el carrito", "danger");
                        include("view/cars.form.php");
                    }
                
            }else{
                $idp = isset($_GET['id_prenda'])?$_GET['id_prenda']:null;
                $idp = is_numeric($idp)?$idp:null;
            
                $idc = isset($_GET['id_car'])?$_GET['id_car']:null;
                $idc = is_numeric($idc)?$idc:null;

                $idu = isset($_GET['id_usuario'])?$_GET['id_usuario']:null;
                $idu = is_numeric($idu)?$idu:null;


                if(!is_null($idp) && !is_null($idc) && !is_null($idu)){

                    $carrito=$CAR->readOne($idu, $idp, $idc);

                    if(isset($carrito)){
                        $data=$carrito;
                        include("view/cars.form.php");
                    }else{
                        $CAR->alerta("El registro que trata de modificar no existe", "danger");
                        $carrito = $CAR->read();
                        include('view/cars.php');
                    }
                }
            }
                
            break;
        case 'reporte':
            $idc = isset($_GET['id_car'])?$_GET['id_car']:null;
            $idc = is_numeric($idc)?$idc:null;
            
            $idu = isset($_GET['id_usuario'])?$_GET['id_usuario']:null;
            $idu = is_numeric($idu)?$idu:null;

            ob_clean();
            $carrito = $CAR->read_detalles($idc, $idu);

            ob_start();
            include('view/cars_detallepdf.php');
            $variable=ob_get_clean();
            $CAR->pdf('P','A4',$variable,'detalleCarrito.pdf');
            break;
        case 'detalles':
                $carrito = $CAR->read_detalles($idc, $idu);
                include('view/cars_detalle.php');
            break;
        case 'read':
        default:                
            $carrito = $CAR->read();
            include('view/cars.php');
    }
    include('view/footer.php');

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>