<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="../css/main.css">
<script src="https://kit.fontawesome.com/cf6a1ce200.js" crossorigin="anonymous"></script>
<?php
    require_once('../class/venta.class.php');
    $VENTA->validateRol('Empleado');
    
    $accion = isset($_GET['accion'])?$_GET['accion']:null;
    $id = isset($_GET['id'])?$_GET['id']:null;
    $id = is_numeric($id)?$id:null;
    
    include('view/header_administracion.php');
    switch($accion){
        case 'createVenta':  
            $idc = isset($_GET['id_car'])?$_GET['id_car']:null;
            $venta = isset($_GET['ventaT'])?$_GET['ventaT']:null;
            

            if(isset($idc)){
                
                $ventas=$VENTA->create($idc, $venta);
                if($VENTA){
                    $VENTA->alerta("Venta dada de alta correctamente", "success");
                    $ventas = $VENTA->read();
                    include('view/ventas.php');
                    
                }
                else{
                    $VENTA->alerta("Error al guardar la venta", "danger");
                    include("view/ventas.form.php");
                }
            }else{
                header("Refresh:0; url=../index.php");
            }
            
            break;

        case 'delete':
            $ventas = $VENTA->delete($id);
            if($ventas)
                $VENTA->alerta("Registro borrado", "success");
            else
                $VENTA->alerta("Registro no encontrado", "danger");
            $ventas = $VENTA->read();
            include('view/ventas.php'); 
            break;
        case 'update':
            $data=isset($_POST["data"])?$_POST["data"]:null;
            if(isset($data["enviar"])){
                if(!is_null($id)){
                    $ventas=$VENTA->update($id, $data);              
                    if($ventas){
                        $VENTA->alerta("Venta actualizado correctamente", "success");
                        $ventas = $VENTA->read();
                        include('view/prendas.php');  
                    }
                    else{
                        $VENTA->alerta("Error al guardar la venta", "danger");
                        include("view/prendas.form.php");
                    }
                }
            }else{
                if(!is_null($id)){
                    $ventas=$VENTA->readOne($id);
                    if(isset($ventas[0])){
                        $data=$ventas[0];
                        include("view/ventas.form.php");
                    }else{
                        $VENTA->alerta("El registro que trata de modificar no existe", "danger");
                        $ventas = $VENTA->read();
                        include('view/ventas.php');
                    }
                }
            }
                
            break;
        case 'read':
        default:  
            
            $ventas = $VENTA->read();
            include('view/ventas.php');
    }
    include('view/footer.php');

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>