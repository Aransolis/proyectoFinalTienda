<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="../../css/main.css">
<script src="https://kit.fontawesome.com/cf6a1ce200.js" crossorigin="anonymous"></script>
<?php
    require_once('../class/descuento.class.php');
    require_once('../class/prendas.class.php');


    $DESCUENTO->validateRol('Empleado');
    
    $accion = isset($_GET['accion'])?$_GET['accion']:null;
    $id = isset($_GET['id'])?$_GET['id']:null;
    $id = is_numeric($id)?$id:null;

    $prendas = $PRENDAS->readSinDesc();
    
    include('view/header_administracion.php');
    switch($accion){
        case 'create':  
            $data=isset($_POST["data"])?$_POST["data"]:null;
            if(isset($data["enviar"])){
                
                $descuento=$DESCUENTO->create($data);
                if($descuento){
                    $DESCUENTO->alerta("Descuento Dada de alta correctamente", "success");
                    $descuento = $DESCUENTO->read();
                    include('view/descuento.php');
                    
                }
                else{
                    $DESCUENTO->alerta("Error al guardar el descuento", "danger");
                    include("view/descuento.form.php");
                }
            }else{
                include("view/descuento.form.php");
            }
            
            break;
        case 'delete':
            $idp = isset($_GET['idp'])?$_GET['idp']:null;
            $idp = is_numeric($idp)?$idp:null;

            
            $descuento = $DESCUENTO->delete($id,$idp);
            if($descuento)
                $DESCUENTO->alerta("Registro borrado", "success");
            else
                $DESCUENTO->alerta("Registro no encontrado", "danger");
            $descuento = $DESCUENTO->read();
            include('view/descuento.php'); 
            break;
        // case 'update':
        //     $data=isset($_POST["data"])?$_POST["data"]:null;
        //     if(isset($data["enviar"])){
        //         if(!is_null($id)){
        //             $descuento=$DESCUENTO->update($id, $data);              
        //             if($descuento){
        //                 $DESCUENTO->alerta("Descuento actualizado correctamente", "success");
        //                 $descuento = $DESCUENTO->read();
        //                 include('view/descuento.php');  
        //             }
        //             else{
        //                 $DESCUENTO->alerta("Error al guardar el descuento", "danger");
        //                 include("view/descuento.form.php");
        //             }
        //         }
        //     }else{
        //         if(!is_null($id)){
        //             $descuento=$DESCUENTO->readOne($id);

        //             if(isset($descuento)){
        //                 $data=$descuento[0];
        //                 include("view/descuento.form.php");
        //             }else{
        //                 $DESCUENTO->alerta("El registro que trata de modificar no existe", "danger");
        //                 $descuento = $DESCUENTO->read();
        //                 include('view/descuento.php');
        //             }
        //         }
        //     }
                
        //     break;
        case 'read':
        default:                
            $descuento = $DESCUENTO->read();
            include('view/descuento.php');
    }
    include('view/footer.php');

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>