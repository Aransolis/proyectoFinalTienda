<?php 
require_once('tiendaProyecto.class.php');
class Usuarios extends tiendaProyecto {
    public function read(){
        $linea = $this->db->prepare("SELECT * FROM usuario  
        ORDER BY id_usuario asc;");
        $linea->execute();
        $usuarios = $linea->fetchAll(PDO::FETCH_ASSOC);  
        return $usuarios;
    }
    public function readOne($id){
        $linea = $this->db->prepare("select * FROM usuario where id_usuario=:id_usuario");
        $linea->bindParam(':id_usuario', $id, PDO::PARAM_INT);
        $linea->execute();
        $usuarios = $linea->fetchAll(PDO::FETCH_ASSOC);  
        return $usuarios;
    }
    public function delete($id){
        try{
            $this->db->beginTransaction();
            $sql = "delete from usuario_rol where id_usuario=:id_usuario";
            $borrar = $this->db->prepare($sql);
            $borrar->bindParam(':id_usuario', $id, PDO::PARAM_INT);
            $borrar->execute();
            $cuenta = $borrar->rowCount();

            $borrar = $this->db->prepare('delete from usuario where id_usuario=:id_usuario');
            $borrar->bindParam(':id_usuario', $id, PDO::PARAM_INT);
            $borrar->execute();
            $cuenta = $borrar->rowCount();
            $this->db->commit();
            return $cuenta;
        }catch(Exception $e){
            $this->db->rollback();
            return 0;
        }
        
        
    }
    public function create($data){
        $cuenta=null;
        try{
            $this->db->beginTransaction();
            $sql= "insert into usuario(correo,contrasena,nombre,apellido) values (:correo, md5(:contrasena),:nombre,:apellido)";
            $insertar = $this->db->prepare($sql);
            $insertar->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
            $insertar->bindParam(':contrasena', $data['contrasena'], PDO::PARAM_STR);
            $insertar->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
            $insertar->bindParam(':apellido', $data['apellido'], PDO::PARAM_STR);
            $insertar->execute();
            $cuenta = $insertar->rowCount();

            $sql="select id_usuario from usuario order by id_usuario desc limit 1";
            $buscar = $this->db->prepare($sql);
            $buscar->execute();
            $usuario = $buscar->fetchAll(PDO::FETCH_ASSOC);  
            if (isset($usuario[0]['id_usuario'])){
                $id_usuario = $usuario[0]['id_usuario'];
                $susRoles = 
                isset($_POST['rol'])?$_POST['rol']:array();
                $sql = "insert into usuario_rol (id_usuario, id_rol)
                values (:id_usuario, :id_rol)";
                $insertar = $this->db->prepare($sql);
                foreach ($susRoles as $key => $rol){
                    $insertar->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                    $insertar->bindParam(':id_rol', $key, PDO::PARAM_INT);
                    $insertar->execute();
                }
                $this->db->commit();
                return $cuenta;
            }else{
                $this->db->rollback();
                return 0;
            }
        }catch(Exception $e){
            $this->db->rollback();
            //echo 'Excepcion capturada: ', $e->getMessage(), "\n";
            return 0;
        }
    }

    public function create2($data){
        $cuenta=null;

            $sql= "insert into usuario(correo,contrasena,nombre,apellido) values (:correo, md5(:contrasena),:nombre,:apellido);";
            $insertar = $this->db->prepare($sql);
            $insertar->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
            $insertar->bindParam(':contrasena', $data['contrasena'], PDO::PARAM_STR);
            $insertar->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
            $insertar->bindParam(':apellido', $data['apellido'], PDO::PARAM_STR);
            $insertar->execute();
            $cuenta = $insertar->rowCount();     
            return $cuenta;     
    }

    public function createCliente($data){
        $cuenta=null;
        
        try{
            $this->db->beginTransaction();
            $sql= "insert into usuario(correo,contrasena,nombre,apellido) values (:correo, md5(:contrasena),:nombre,:apellido)";
            $insertar = $this->db->prepare($sql);
            $insertar->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
            $insertar->bindParam(':contrasena', $data['contrasena'], PDO::PARAM_STR);
            $insertar->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
            $insertar->bindParam(':apellido', $data['apellido'], PDO::PARAM_STR);
            $insertar->execute();
            $cuenta = $insertar->rowCount();
            
            $id_rol = 1;
            $sql="select id_usuario from usuario order by id_usuario desc limit 1";
            $buscar = $this->db->prepare($sql);
            $buscar->execute();
            $usuario = $buscar->fetch(PDO::FETCH_ASSOC);
            
            if (isset($usuario)){
                
                $sql = "insert into usuario_rol (id_usuario, id_rol)
                values (:id_usuario, :id_rol)";
                $insertar = $this->db->prepare($sql);
    
                $insertar->bindParam(':id_usuario', $usuario['id_usuario'], PDO::PARAM_INT);
                $insertar->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
                $insertar->execute();

                
                $this->db->commit();
                return $cuenta;
            }else{
                $this->db->rollback();
                return 0;
            }
        }catch(Exception $e){
            $this->db->rollback();
            //echo 'Excepcion capturada: ', $e->getMessage(), "\n";
            return 0;
        }
    }

    

    public function update($id, $data){
        try{
            $this->db->beginTransaction();
            $sql="update usuario set correo=:correo,
            contrasena=md5(:contrasena), nombre=:nombre, apellido=:apellido
            where id_usuario=:id_usuario";
        
            $actualizar = $this->db->prepare($sql);
            $actualizar->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
            $actualizar->bindParam(':id_usuario', $id, PDO::PARAM_INT);
            $actualizar->bindParam(':contrasena', $data['contrasena'], PDO::PARAM_INT);
            $actualizar->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
            $actualizar->bindParam(':apellido', $data['apellido'], PDO::PARAM_STR);
            $actualizar->execute();
            if (isset($id)){
                $id_usuario = $id;
                $susRoles = 
                isset($_POST['rol'])?$_POST['rol']:array();
                $borrado = $this->delete_rol($id_usuario);
                $sql = "insert into usuario_rol (id_usuario, id_rol)
                values (:id_usuario, :id_rol)";
                $insertar = $this->db->prepare($sql);
                foreach ($susRoles as $key => $rol){
                    $insertar->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                    $insertar->bindParam(':id_rol', $key, PDO::PARAM_INT);
                    $insertar->execute();
                }
                $this->db->commit();
                return $actualizar;
            }else{
                $this->db->rollback();
                return 0;
            }
            
        }catch (Exception $e){
            $this->db->rollback();
        }
    }

    public function update2($id, $data){

        $sql="update usuario set correo=:correo,
        contrasena=md5(:contrasena), nombre=:nombre, apellido=:apellido where id_usuario=:id_usuario";
        
        $actualizar = $this->db->prepare($sql);
        $actualizar->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
        $actualizar->bindParam(':id_usuario', $id, PDO::PARAM_INT);
        $actualizar->bindParam(':contrasena', $data['contrasena'], PDO::PARAM_STR);
        $actualizar->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
        $actualizar->bindParam(':apellido', $data['apellido'], PDO::PARAM_STR);
        $actualizar->execute();
            
        return $actualizar;
            
    }

    public function delete_rol($id_usuario){
        $borrar = $this->db->prepare('delete from usuario_rol
        where id_usuario=:id_usuario');
        $borrar->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $borrar->execute();
        $cuenta = $borrar->rowCount();
        return $cuenta;
    }

    
    
    public function read_rol($id_usuario){
        $linea = $this->db->prepare("SELECT *  FROM usuario_rol
        where id_usuario=:id_usuario");
        $linea->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $linea->execute();
        $usuarios_roles = $linea->fetchAll(PDO::FETCH_ASSOC);
        $roles = array();
        foreach($usuarios_roles as $usuario_rol){
            array_push($roles, $usuario_rol['id_rol']);
        }  
        return $roles;
    }
    
/*--------------------*/

}
$USUARIOS = new Usuarios; 
$USUARIOS->conexion();
?>