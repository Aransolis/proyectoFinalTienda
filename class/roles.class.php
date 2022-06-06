<?php 
require_once('tiendaProyecto.class.php');
class Roles extends tiendaProyecto {
    public function read(){
        $linea = $this->db->prepare("SELECT * from rol");
        $linea->execute();
        $roles = $linea->fetchAll(PDO::FETCH_ASSOC);  
        return $roles;
    }
    public function readOne($id){
        $linea = $this->db->prepare("select * FROM rol where id_rol=:id_rol");
        $linea->bindParam(':id_rol', $id, PDO::PARAM_INT);
        $linea->execute();
        $roles = $linea->fetchAll(PDO::FETCH_ASSOC);  
        return $roles;
    }
    public function delete($id){
        try{
            $this->db->beginTransaction();
            $sql = "delete from usuario_rol where id_rol=:id_rol";
            $borrar = $this->db->prepare($sql);
            $borrar->bindParam(':id_rol', $id, PDO::PARAM_INT);
            $borrar->execute();
            $cuenta = $borrar->rowCount();

            $sql = "delete from permiso_rol where id_rol=:id_rol";
            $borrar = $this->db->prepare($sql);
            $borrar->bindParam(':id_rol', $id, PDO::PARAM_INT);
            $borrar->execute();
            $cuenta = $borrar->rowCount();

            $borrar = $this->db->prepare('delete from rol where id_rol=:id_rol');
            $borrar->bindParam(':id_rol', $id, PDO::PARAM_INT);
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
        $sql= "insert into rol(rol) values (:rol)";
        $insertar = $this->db->prepare($sql);
        $insertar->bindParam(':rol', $data['rol'], PDO::PARAM_STR);
        $insertar->execute();
        $cuenta = $insertar->rowCount();       
        return $cuenta;
    }
    public function update($id, $data){
        $sql="update rol set rol=:rol
        where id_rol=:id_rol";
        $actualizar = $this->db->prepare($sql);
        $actualizar->bindParam(':rol', $data['rol'], PDO::PARAM_STR);
        $actualizar->bindParam(':id_rol', $id, PDO::PARAM_INT);        
        $actualizar->execute();
        $cuenta = $actualizar->rowCount();       
        return $cuenta;    
    }
    
}
$ROL = new Roles; 
$ROL->conexion();
?>