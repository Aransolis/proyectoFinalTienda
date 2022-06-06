<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="../css/main.css">
<script src="https://kit.fontawesome.com/cf6a1ce200.js" crossorigin="anonymous"></script>
<?php
    require_once('../class/permisos.class.php');
    require_once('../class/roles.class.php');
    $PERMISOS->validateRol('Administrador');


    $accion = isset($_GET['accion'])?$_GET['accion']:null;
    $id = isset($_GET['id'])?$_GET['id']:null;
    $id = is_numeric($id)?$id:null;

    $roles = $ROL->read();
    
    include('view/header_administracion.php');
    switch($accion){
        case 'create':  
            $data=isset($_POST["data"])?$_POST["data"]:null;
            if(isset($data["enviar"])){             
                $permisos=$PERMISOS->create($data);
                if($permisos){
                    $PERMISOS->alerta("Permiso dada de alta correctamente", "success");
                    $permisos = $PERMISOS->read();
                    include('view/permisos.php');
                    
                }
                else{
                    $PERMISOS->alerta("Error al guardar el permiso", "danger");
                    include("view/permisos.form.php");
                }
            }else{
                include("view/permisos.form.php");
            }
            
            break;
        case 'delete':
            $permisos = $PERMISOS->delete($id);
            if($permisos)
                $PERMISOS->alerta("Registro borrado", "success");
            else
                $PERMISOS->alerta("Registro no encontrado", "danger");
            $permisos = $PERMISOS->read();
            include('view/permisos.php'); 
            break;

        case 'update':
            $data=isset($_POST["data"])?$_POST["data"]:null;
            if(isset($data["enviar"])){
                if(!is_null($id)){
                    $permisos=$PERMISOS->update($id, $data);             
                    if($permisos){
                        $PERMISOS->alerta("Permiso actualizado correctamente", "success");
                        $permisos = $PERMISOS->read();
                        include('view/permisos.php');  
                    }
                    else{
                        $PERMISOS->alerta("Error al guardar el permiso", "danger");
                        include("view/permisos.form.php");
                    }
                }
            }else{
                if(!is_null($id)){
                    $permisos=$PERMISOS->readOne($id);
                    $misRoles = $PERMISOS->read_rol($id);
                    
                    if(isset($permisos[0])){
                        $data=$permisos[0];
                        include("view/permisos.form.php");
                    }else{
                        $PERMISOS->alerta("El registro que trata de modificar no existe", "danger");
                        $permisos = $PERMISOS->read();
                        include('view/permisos.php');
                    }
                }
            }
                
            break;
        
        default:                
            $permisos = $PERMISOS->read();
            include('view/permisos.php');
    }
    include('view/footer.php');

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>