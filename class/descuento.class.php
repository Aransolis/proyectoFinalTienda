<?php 
require_once('tiendaProyecto.class.php');
class Descuento extends tiendaProyecto {
    public function read(){
        $linea = $this->db->prepare("SELECT * FROM descuento join prenda using(id_prenda);");
        $linea->execute();
        $descuento = $linea->fetchAll(PDO::FETCH_ASSOC);  
        return $descuento;
    }
    public function readOne($id){
        $linea = $this->db->prepare("select * FROM descuento where id_descuento=:id_descuento");
        $linea->bindParam(':id_descuento', $id, PDO::PARAM_INT);
        $linea->execute();
        $descuento = $linea->fetchAll(PDO::FETCH_ASSOC);  
        return $descuento;
    }
    
    public function delete($id, $idp){
        
    $linea = $this->db->prepare("select precio FROM prenda where id_prenda=:id_prenda");
    $linea->bindParam(':id_prenda', $idp, PDO::PARAM_INT);
    $linea->execute();
    $precio = $linea->fetch(PDO::FETCH_ASSOC); 
    

    $linea = $this->db->prepare("select porcentaje_desc FROM descuento where id_descuento=:id_descuento");
    $linea->bindParam(':id_descuento', $id, PDO::PARAM_INT);
    $linea->execute();
    $descuento = $linea->fetch(PDO::FETCH_ASSOC);  

    $nuevoprecio = ($precio['precio'] * 100) / ((1-$descuento['porcentaje_desc'])*100);
    $nuevoprecio = number_format($nuevoprecio, 2);

   

    $sql="update prenda set precio=:precio
    where id_prenda=:id_prenda";
    $actualizar = $this->db->prepare($sql);
    $actualizar->bindParam(':precio', $nuevoprecio, PDO::PARAM_INT);
    $actualizar->bindParam(':id_prenda', $idp, PDO::PARAM_INT);
    $actualizar->execute();

    $borrar = $this->db->prepare('delete from descuento where id_descuento=:id_descuento');
    $borrar->bindParam(':id_descuento', $id, PDO::PARAM_INT);
    $borrar->execute();
    $cuenta = $borrar->rowCount();

    return $cuenta;
    
}
public function create($data){
    $cuenta=null;

    $linea = $this->db->prepare("select precio FROM prenda where id_prenda=:id_prenda");
    $linea->bindParam(':id_prenda', $data['id_prenda'], PDO::PARAM_INT);
    $linea->execute();
    $precio = $linea->fetch(PDO::FETCH_ASSOC); 

    $nuevoprecio = $precio['precio'] - ($precio['precio']* $data['porcentaje_desc']);
    $nuevoprecio = number_format($nuevoprecio, 2);

    $sql="update prenda set precio=:precio
    where id_prenda=:id_prenda";
    $actualizar = $this->db->prepare($sql);
    $actualizar->bindParam(':precio', $nuevoprecio, PDO::PARAM_INT);
    $actualizar->bindParam(':id_prenda', $data['id_prenda'], PDO::PARAM_INT);
    $actualizar->execute();

    $sql= "insert into descuento(id_prenda,porcentaje_desc) values (:id_prenda,:porcentaje_desc)";
    $insertar = $this->db->prepare($sql);
    $insertar->bindParam(':id_prenda', $data['id_prenda'], PDO::PARAM_INT);
    $insertar->bindParam(':porcentaje_desc', $data['porcentaje_desc'], PDO::PARAM_STR);
    $insertar->execute();
    $cuenta = $insertar->rowCount();
    return $cuenta;
}
// public function update($id, $data){

//     $linea = $this->db->prepare("select precio FROM prenda where id_prenda=:id_prenda");
//     $linea->bindParam(':id_prenda', $data['id_prenda'], PDO::PARAM_INT);
//     $linea->execute();
//     $precio = $linea->fetch(PDO::FETCH_ASSOC); 


//     print_r($data['porcentaje_desc']);
//     print_r($precio['precio']);


//     $nuevoprecio = $precio['precio'] / (1- $data['porcentaje_desc']);
//     $nuevoprecio = number_format($nuevoprecio, 2);
//     print_r($nuevoprecio);
//     die();

//     $sql="update prenda set precio=:precio
//     where id_prenda=:id_prenda";
//     $actualizar = $this->db->prepare($sql);
//     $actualizar->bindParam(':precio', $nuevoprecio, PDO::PARAM_INT);
//     $actualizar->bindParam(':id_prenda', $data['id_prenda'], PDO::PARAM_INT);
//     $actualizar->execute();

//     $sql="update descuento set id_prenda=:id_prenda,
//     porcentaje_desc=:porcentaje_desc
//     where id_descuento=:id_descuento";
    
//     $actualizar = $this->db->prepare($sql);
//     $actualizar->bindParam(':id_descuento', $id, PDO::PARAM_INT);
//     $actualizar->bindParam(':id_prenda', $data['id_prenda'], PDO::PARAM_INT);
//     $actualizar->bindParam(':porcentaje_desc', $data['porcentaje_desc'], PDO::PARAM_STR);
//     $actualizar->execute();
//     $cuenta = $actualizar->rowCount();
   
    
//     return $cuenta;
// }


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
$DESCUENTO = new Descuento; 
$DESCUENTO->conexion();
?>