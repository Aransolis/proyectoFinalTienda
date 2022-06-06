<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="../css/main.css">
<script src="https://kit.fontawesome.com/cf6a1ce200.js" crossorigin="anonymous"></script>
<?php
    require_once('../class/roles.class.php');
    $ROL->validateRol('Administrador');
    
    $accion = isset($_GET['accion'])?$_GET['accion']:null;
    $id = isset($_GET['id'])?$_GET['id']:null;
    $id = is_numeric($id)?$id:null;
    
    include('view/header_administracion.php');
    switch($accion){
        case 'create':  
            $data=isset($_POST["data"])?$_POST["data"]:null;
            if(isset($data["enviar"])){
                
                $roles=$ROL->create($data);
                if($ROL){
                    $ROL->alerta("Rol Dada de alta correctamente", "success");
                    $roles = $ROL->read();
                    include('view/roles.php');
                    
                }
                else{
                    $ROL->alerta("Error al guardar el rol", "danger");
                    include("view/roles.form.php");
                }
            }else{
                include("view/roles.form.php");
            }
            
            break;
        case 'delete':
            $roles = $ROL->delete($id);
            if($roles)
                $ROL->alerta("Registro borrado", "success");
            else
                $ROL->alerta("Registro no encontrado", "danger");
            $roles = $ROL->read();
            include('view/roles.php'); 
            break;
        case 'update':
            $data=isset($_POST["data"])?$_POST["data"]:null;
            if(isset($data["enviar"])){
                if(!is_null($id)){
                    $roles=$ROL->update($id, $data);              
                    if($roles){
                        $ROL->alerta("Rol actualizado correctamente", "success");
                        $roles = $ROL->read();
                        include('view/roles.php');  
                    }
                    else{
                        $ROL->alerta("Error al guardar el rol", "danger");
                        include("view/roles.form.php");
                    }
                }
            }else{
                if(!is_null($id)){
                    $roles=$ROL->readOne($id);
                    if(isset($roles[0])){
                        $data=$roles[0];
                        include("view/roles.form.php");
                    }else{
                        $ROL->alerta("El registro que trata de modificar no existe", "danger");
                        $roles = $ROL->read();
                        include('view/roles.php');
                    }
                }
            }
                
            break;
        case 'read':
        default:                
            $roles = $ROL->read();
            include('view/roles.php');
    }
    include('view/footer.php');

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>