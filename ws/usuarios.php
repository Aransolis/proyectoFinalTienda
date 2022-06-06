<?php
    include_once('../class/tiendaProyecto.class.php');
    include_once('../class/usuarios.class.php');
    $accion = $_SERVER['REQUEST_METHOD'];

    $datos = array();
    
    switch($accion){
        case 'POST':
            $datos = file_get_contents("php://input");

            $datos = json_decode($datos, true);

            if(isset($_GET['id_usuario'])){
                $id = $_GET['id_usuario'];
                foreach($datos as $usuario){
                    $usuarios = $USUARIOS->update2($id,$usuario,true);
                    $status=200;
                    $msj="se ha actualizado con exito";                  
                }
            }else{

                foreach($datos as $key => $usuario){                 
                    $usuarios = $USUARIOS->createCliente($usuario, true);
                    $status = 200;
                    $msj = "Se ha dado de alta una el usuario";    
                }
            }
            break;
        case 'DELETE':
            if (isset($_GET['id_usuario'])){
                $id_usuario = $_GET['id_usuario'];
                $cantidad= $USUARIOS->delete($id_usuario);
                $status=200;
                $msj= "se han eliminado: ".$cantidad." con exito" ;
            }else{
                $status= 404;
                $msj ="No se ah encontrado el recurso";
            }
            break;
        case 'GET':

            $datos= null;
            if (isset($_GET['id_usuario'])){
                $id_usuario = $_GET['id_usuario'];
                $datos= $USUARIOS->readOne($id_usuario);
            }else{
                $datos=$USUARIOS->read();
            }
            $status = 200;
            $mensaje = "Se an procesado con exito las acciones";
            break;
    }
    $tienda->json($datos, $status, $mensaje);
?>