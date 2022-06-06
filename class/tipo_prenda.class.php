<?php 

require_once('tiendaProyecto.class.php');
class Tipo_prendas extends tiendaProyecto {
    public function read(){
        $linea = $this->db->prepare("SELECT * FROM tipo_prenda;");
        $linea->execute();
        $tipo = $linea->fetchAll(PDO::FETCH_ASSOC);  
        return $tipo;
    }
    public function readOne($id){
        $linea = $this->db->prepare("select * FROM tipo_prenda where id_tipo_prenda=:id_tipo_prenda");
        $linea->bindParam(':id_tipo_prenda', $id, PDO::PARAM_INT);
        $linea->execute();
        $tipo = $linea->fetch(PDO::FETCH_ASSOC);  
        return $tipo;
    }
    
    public function delete($id){
            $borrar = $this->db->prepare('delete from tipo_prenda where id_tipo_prenda=:id_tipo_prenda');
            $borrar->bindParam(':id_tipo_prenda', $id, PDO::PARAM_INT);
            $borrar->execute();
            $cuenta = $borrar->rowCount();
            $this->db->commit();
            return $cuenta;
        
    }
    public function create($data){
        $cuenta=null;
        $foto= $this->cargarImagen("tipo");
        if($foto){
            $sql= "insert into tipo_prenda(tipo_prenda,foto) values (:tipo_prenda,:foto)";
            $insertar = $this->db->prepare($sql);
            $insertar->bindParam(':tipo_prenda', $data['tipo_prenda'], PDO::PARAM_STR);
            $insertar->bindParam(':foto', $foto, PDO::PARAM_STR);
            $insertar->execute();
            $cuenta = $insertar->rowCount();
        }
        return $cuenta;
    }
    public function update($id, $data){
        $foto= $this->cargarImagen("tipo");
        if($foto){
            $sql="update tipo_prenda set tipo_prenda=:tipo_prenda,
            foto=:foto
            where id_tipo_prenda=:id_tipo_prenda";
            
        }else{
            $sql="update tipo_prenda set tipo_prenda=:tipo_prenda
            where id_tipo_prenda=:id_tipo_prenda";
        }
        $actualizar = $this->db->prepare($sql);
        $actualizar->bindParam(':id_tipo_prenda', $id, PDO::PARAM_INT);
        $actualizar->bindParam(':tipo_prenda', $data['tipo_prenda'], PDO::PARAM_STR);
        if($foto){
            $actualizar->bindParam(':foto', $foto, PDO::PARAM_STR);
        }
        $actualizar->execute();
        $cuenta = $actualizar->rowCount();
        
        return $cuenta;
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
$TIPO_PRENDAS = new Tipo_prendas; 
$TIPO_PRENDAS->conexion();
?>