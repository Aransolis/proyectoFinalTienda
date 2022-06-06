<?php 
require_once('tiendaProyecto.class.php');
class Permisos extends tiendaProyecto {
    public function read(){
        $linea = $this->db->prepare("SELECT id_permiso, permiso FROM permiso  
        ORDER BY 1 asc;");
        $linea->execute();
        $permisos = $linea->fetchAll(PDO::FETCH_ASSOC);  
        return $permisos;
    }
    public function readOne($id){
        $linea = $this->db->prepare("select * FROM permiso where id_permiso=:id_permiso");
        $linea->bindParam(':id_permiso', $id, PDO::PARAM_INT);
        $linea->execute();
        $permisos = $linea->fetchAll(PDO::FETCH_ASSOC);  
        return $permisos;
    }
    public function delete($id){
        try{
            $this->db->beginTransaction();
            $sql = "delete from permiso_rol where id_permiso=:id_permiso";
            $borrar = $this->db->prepare($sql);
            $borrar->bindParam(':id_permiso', $id, PDO::PARAM_INT);
            $borrar->execute();
            $cuenta = $borrar->rowCount();

            $borrar = $this->db->prepare('delete from permiso where id_permiso=:id_permiso');
            $borrar->bindParam(':id_permiso', $id, PDO::PARAM_INT);
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
            $sql= "insert into permiso(permiso) values (:permiso)";
            $insertar = $this->db->prepare($sql);
            $insertar->bindParam(':permiso', $data['permiso'], PDO::PARAM_STR);
            $insertar->execute();
            $cuenta = $insertar->rowCount();

            $sql="select id_permiso from permiso order by id_permiso desc limit 1";
            $buscar = $this->db->prepare($sql);
            $buscar->execute();
            $permiso = $buscar->fetchAll(PDO::FETCH_ASSOC);  
            if (isset($permiso[0]['id_permiso'])){
                $id_permiso = $permiso[0]['id_permiso'];
                $susRoles = 
                isset($_POST['rol'])?$_POST['rol']:array();
                $sql = "insert into permiso_rol (id_permiso, id_rol)
                values (:id_permiso, :id_rol)";
                $insertar = $this->db->prepare($sql);
                foreach ($susRoles as $key => $rol){
                    $insertar->bindParam(':id_permiso', $id_permiso, PDO::PARAM_INT);
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
    public function update($id, $data){
        try{
            $this->db->beginTransaction();
            $sql="update permiso set permiso=:permiso where id_permiso=:id_permiso";
        
            $actualizar = $this->db->prepare($sql);
            $actualizar->bindParam(':permiso', $data['permiso'], PDO::PARAM_STR);
            $actualizar->bindParam(':id_permiso', $id, PDO::PARAM_INT);
            $actualizar->execute();
            
            if (isset($id)){

                $id_permiso = $id;
                $susRoles = 
                isset($_POST['rol'])?$_POST['rol']:array();
                $borrado = $this->delete_rol($id_permiso);
                $sql = "insert into permiso_rol (id_permiso, id_rol)
                values (:id_permiso, :id_rol)";
                $insertar = $this->db->prepare($sql);
                foreach ($susRoles as $key => $rol){
                    $insertar->bindParam(':id_permiso', $id_permiso, PDO::PARAM_INT);
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

    public function delete_rol($id_permiso){
        $borrar = $this->db->prepare('delete from permiso_rol
        where id_permiso=:id_permiso');
        $borrar->bindParam(':id_permiso', $id_permiso, PDO::PARAM_INT);
        $borrar->execute();
        $cuenta = $borrar->rowCount();
        return $cuenta;
    }

    
    
    public function read_rol($id_usuario){
        $linea = $this->db->prepare("SELECT *  FROM permiso_rol
        where id_permiso=:id_permiso");
        $linea->bindParam(':id_permiso', $id_usuario, PDO::PARAM_INT);
        $linea->execute();
        $permiso_roles = $linea->fetchAll(PDO::FETCH_ASSOC);
        $roles = array();
        foreach($permiso_roles as $permiso_rol){
            array_push($roles, $permiso_rol['id_rol']);
        }  
        return $roles;
    }
    
/*--------------------*/

}
$PERMISOS = new Permisos; 
$PERMISOS->conexion();
?>