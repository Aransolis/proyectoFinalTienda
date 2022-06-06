
<?php
    require_once('../class/usuarios.class.php');
    require_once('../class/roles.class.php');

    $accion = isset($_GET['accion'])?$_GET['accion']:null;
    $id = isset($_GET['id'])?$_GET['id']:null;
    $id = is_numeric($id)?$id:null;

    $roles = $ROL->read();
    
    include('view/header_administracion.php');
    switch($accion){
        case 'create':  
            $data=isset($_POST["data"])?$_POST["data"]:null;
            if(isset($data["enviar"])){             
                $usuarios=$USUARIOS->create($data);
                if($usuarios){
                    $USUARIOS->alerta("Usuario dada de alta correctamente", "success");
                    $usuarios = $USUARIOS->read();
                    include('view/usuarios.php');
                    
                }
                else{
                    $USUARIOS->alerta("Error al guardar el usuario", "danger");
                    include("view/usuarios.form.php");
                }
            }else{
                include("view/usuarios.form.php");
            }
            
            break;

        
        case 'delete':
            $usuarios = $USUARIOS->delete($id);
            if($usuarios)
                $USUARIOS->alerta("Registro borrado", "success");
            else
                $USUARIOS->alerta("Registro no encontrado", "danger");
            $usuarios = $USUARIOS->read();
            include('view/usuarios.php'); 
            break;

        case 'update':
            $data=isset($_POST["data"])?$_POST["data"]:null;
            if(isset($data["enviar"])){
                if(!is_null($id)){
                    $usuarios=$USUARIOS->update($id, $data);             
                    if($usuarios){
                        $USUARIOS->alerta("Usuarios actualizada correctamente", "success");
                        $usuarios = $USUARIOS->read();
                        include('view/usuarios.php');  
                    }
                    else{
                        $USUARIOS->alerta("Error al guardar el usuario", "danger");
                        include("view/usuarios.form.php");
                    }
                }
            }else{
                if(!is_null($id)){
                    $usuarios=$USUARIOS->readOne($id);
                    $misRoles = $USUARIOS->read_rol($id);
                    
                    if(isset($usuarios[0])){
                        $data=$usuarios[0];
                        include("view/usuarios.form.php");
                    }else{
                        $USUARIOS->alerta("El registro que trata de modificar no existe", "danger");
                        $usuarios = $USUARIOS->read();
                        include('view/usuarios.php');
                    }
                }
            }
                
            break;
        
        default:                
            $usuarios = $USUARIOS->read();
            include('view/usuarios.php');
    }
    include('view/footer.php');

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>