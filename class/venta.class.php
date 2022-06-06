<?php 
require_once('tiendaProyecto.class.php');
class Venta extends tiendaProyecto {
    public function read(){
        $linea = $this->db->prepare("select distinct v.id_venta as id_venta, v.fecha as fecha, v.venta_total as venta_total,
        u.nombre, u.correo, u.apellido FROM venta v
        join car c on v.id_car=c.id_car join usuario u on c.id_usuario=u.id_usuario;");
        $linea->execute();
        $venta = $linea->fetchAll(PDO::FETCH_ASSOC);  
        return $venta;
    }
    public function readOne($id){
        $linea = $this->db->prepare("select * FROM venta where id_venta=:id_venta");
        $linea->bindParam(':id_venta', $id, PDO::PARAM_INT);
        $linea->execute();
        $venta = $linea->fetchAll(PDO::FETCH_ASSOC);  
        return $venta;
    }
    public function delete($id){
        $borrar = $this->db->prepare('delete from venta where id_venta=:id_venta');
        $borrar->bindParam(':id_venta', $id, PDO::PARAM_INT);
        $borrar->execute();
        $cuenta = $borrar->rowCount();
        $this->db->commit();
        return $cuenta;
    
}
public function create($id, $total){
    $cuenta=null;
    $fecha= date("Y/m/d");

    $sql= "insert into venta(id_car,fecha,venta_total) values (:id_car,:fecha,:venta_total)";
    $insertar = $this->db->prepare($sql);
    $insertar->bindParam(':id_car', $id, PDO::PARAM_INT);
    $insertar->bindParam(':fecha', $fecha, PDO::PARAM_STR);
    $insertar->bindParam(':venta_total', $total, PDO::PARAM_INT);
    $insertar->execute();
    $cuenta = $insertar->rowCount();

    return $cuenta;
}
public function update($id, $data){
    $sql="update car set id_prenda=:id_prenda,
    id_cliente=:id_cliente,cantidad=:cantidad,
    where id_car=:id_car";
    
    $actualizar = $this->db->prepare($sql);
    $actualizar->bindParam(':id_prenda', $data['id_prenda'], PDO::PARAM_INT);
    $actualizar->bindParam(':id_cliente', $data['id_cliente'], PDO::PARAM_INT);
    $actualizar->bindParam(':cantidad', $data['cantidad'], PDO::PARAM_INT);
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
$VENTA = new Venta; 
$VENTA->conexion();
?>