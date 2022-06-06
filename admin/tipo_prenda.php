<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="../../css/main.css">
<script src="https://kit.fontawesome.com/cf6a1ce200.js" crossorigin="anonymous"></script>
<?php
    require_once('../class/prendas.class.php');
    require_once('../class/tipo_prenda.class.php');

    $TIPO_PRENDAS->validateRol('Empleado');
    
    $accion = isset($_GET['accion'])?$_GET['accion']:null;
    $id = isset($_GET['id'])?$_GET['id']:null;
    $id = is_numeric($id)?$id:null;


    
    include('view/header_administracion.php');
    switch($accion){
        case 'create':  
            $data=isset($_POST["data"])?$_POST["data"]:null;
            if(isset($data["enviar"])){
                
                $tipo_prendas=$TIPO_PRENDAS->create($data);
                if($tipo_prendas){
                    $TIPO_PRENDAS->alerta("Prenda Dada de alta correctamente", "success");
                    $tipo_prendas = $TIPO_PRENDAS->read();
                    include('view/tipo_prendas.php');
                    
                }
                else{
                    $TIPO_PRENDAS->alerta("Error al guardar el tipo de prenda", "danger");
                    include("view/tipo_prendas.form.php");
                }
            }else{
                include("view/tipo_prendas.form.php");
            }
            
            break;
        case 'delete':
            $tipo_prendas = $TIPO_PRENDAS->delete($id);
            if($tipo_prendas)
                $TIPO_PRENDAS->alerta("Registro borrado", "success");
            else
                $PRENDAS->alerta("Registro no encontrado", "danger");
            $tipo_prendas = $TIPO_PRENDAS->read();
            include('view/tipo_prendas.php'); 
            break;
        case 'update':
            $data=isset($_POST["data"])?$_POST["data"]:null;
            if(isset($data["enviar"])){
                if(!is_null($id)){
                    $tipo_prendas=$TIPO_PRENDAS->update($id, $data);              
                    if($tipo_prendas){
                        $TIPO_PRENDAS->alerta("Prenda actualizado correctamente", "success");
                        $tipo_prendas = $TIPO_PRENDAS->read();
                        include('view/tipo_prendas.php');  
                    }
                    else{
                        $PRENDAS->alerta("Error al guardar la prenda", "danger");
                        include("view/tipo_prendas.form.php");
                    }
                }
            }else{
                if(!is_null($id)){
                    $tipo_prendas=$TIPO_PRENDAS->readOne($id);

                    if(isset($tipo_prendas)){
                        $data=$tipo_prendas;
                        include("view/tipo_prendas.form.php");
                    }else{
                        $TIPO_PRENDAS->alerta("El registro que trata de modificar no existe", "danger");
                        $tipo_prendas = $TIPO_PRENDAS->read();
                        include('view/tipo_prendas.php');
                    }
                }
            }
                
            break;
        case 'read':
        default:                
            $tipo_prendas = $TIPO_PRENDAS->read();
            include('view/tipo_prendas.php');
    }
    include('view/footer.php');

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>