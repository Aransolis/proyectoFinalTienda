<?php 
require_once('tiendaProyecto.class.php');
class Car extends tiendaProyecto {
    public function read(){
        $linea = $this->db->prepare("select DISTINCT u.correo as correo, c.id_car as id_car, u.id_usuario as id_usuario
        from car c join usuario u on c.id_usuario=u.id_usuario order by 1 ASC; ");
        $linea->execute();
        $car = $linea->fetchAll(PDO::FETCH_ASSOC);  
        return $car;
    }
    public function read_detalles($idc, $idu){
        $linea = $this->db->prepare("select c.id_car as id_car, p.prenda as prenda, p.id_prenda as id_prenda,
        p.precio as precio, p.costo as costo, p.foto as foto, u.correo as correo, c.cantidad as cantidad, u.id_usuario as id_usuario, u.nombre as nombre,
        u.apellido as apellido, talla 
        from car c join usuario u on c.id_usuario=u.id_usuario join prenda p on c.id_prenda=p.id_prenda WHERE
        c.id_car=:id_carrito and u.id_usuario=:id_usuario order by 1 ASC; ");
        $linea->bindParam(':id_carrito', $idc, PDO::PARAM_INT);
        $linea->bindParam(':id_usuario', $idu, PDO::PARAM_INT);
        $linea->execute();
        $car = $linea->fetchAll(PDO::FETCH_ASSOC);  
        return $car;
    }   

    public function readClienteCarrito(){
        $idu = $_SESSION['id_usuario'];


        $linea = $this->db->prepare("select distinct c.id_car as id_car from car c left join venta v on c.id_car=v.id_car 
        where v.id_venta is null and c.id_usuario=:id_usuario;");
        $linea->bindParam(':id_usuario', $idu, PDO::PARAM_INT);
        $linea->execute();
        $clientecar = $linea->fetch(PDO::FETCH_ASSOC); 
        
        
        if(isset($clientecar['id_car'])){

            $idc = $clientecar['id_car'];

            $linea = $this->db->prepare("select p.prenda as prenda, c.cantidad as cantidad,
            p.foto as foto, c.talla as talla, p.precio as precio, p.id_prenda as id_prenda, c.id_car as id_car
            from  car c join prenda p on c.id_prenda=p.id_prenda
            where c.id_usuario=:id_usuario and c.id_car=:id_carrito; ");
            $linea->bindParam(':id_usuario', $idu, PDO::PARAM_INT);
            $linea->bindParam(':id_carrito', $idc, PDO::PARAM_INT);
            $linea->execute();
            $car = $linea->fetchAll(PDO::FETCH_ASSOC); 
            return $car;
            
        }else{
            $car = null;
            return $car;
        }
        
    }   

    public function readOne($id, $idp, $idc){

        $linea = $this->db->prepare("select * FROM car where id_car=:id_car and id_usuario=:id_usuario and
        id_prenda=:id_prenda");
        $linea->bindParam(':id_car', $idc, PDO::PARAM_INT);
        $linea->bindParam(':id_usuario', $id, PDO::PARAM_INT);
        $linea->bindParam(':id_prenda', $idp, PDO::PARAM_INT);
        $linea->execute();
        $car = $linea->fetch(PDO::FETCH_ASSOC); 

        return $car;
    }
    public function delete($idp, $idc, $idu){
        $borrar = $this->db->prepare('delete from car where id_car=:id_car and id_prenda=:id_prenda and id_usuario=:id_usuario');
        $borrar->bindParam(':id_car', $idc, PDO::PARAM_INT);
        $borrar->bindParam(':id_usuario', $idu, PDO::PARAM_INT);
        $borrar->bindParam(':id_prenda', $idp, PDO::PARAM_INT);
        $borrar->execute();
        $cuenta = $borrar->rowCount();
        return $cuenta;
    
}

public function createSimp($data){
    
    $cuenta=null;
    $sql= "insert into car(id_car,id_prenda,cantidad, id_usuario, talla) values (:id_car,:id_prenda,:cantidad,:id_usuario,:talla)";
    $insertar = $this->db->prepare($sql);
    $insertar->bindParam(':id_car', $data['id_car'], PDO::PARAM_INT);
    $insertar->bindParam(':id_prenda', $data['id_prenda'], PDO::PARAM_INT);
    $insertar->bindParam(':cantidad', $data['cantidad'], PDO::PARAM_INT);
    $insertar->bindParam(':id_usuario', $data['id_usuario'], PDO::PARAM_INT);
    $insertar->bindParam(':talla', $data['talla'], PDO::PARAM_STR);
    $insertar->execute();
    $cuenta = $insertar->rowCount();

    return $cuenta;
    
    
}

public function create($data){
    $cuenta=null;
    $id = $_SESSION['id_usuario'];

    try{
    $linea = $this->db->prepare("select * FROM car where id_usuario=:id_usuario order by id_car DESC limit 1;");
    $linea->bindParam(':id_usuario', $id, PDO::PARAM_INT);
    $linea->execute();
    $car = $linea->fetch(PDO::FETCH_ASSOC);
    

    if(isset($car['id_car'])){
        $linea = $this->db->prepare("select * FROM car join venta USING(id_car) where id_car=:id_car;");
        $linea->bindParam(':id_car', $car['id_car'], PDO::PARAM_INT);
        $linea->execute();
        $car1 = $linea->fetch(PDO::FETCH_ASSOC);
        
    
        
        if(isset($car1['id_car'])){

            $linea = $this->db->prepare("select id_car from car order by id_car DESC limit 1;");
            $linea->execute();
            $id2 = $linea->fetch(PDO::FETCH_ASSOC); 
            $id3 = $id2['id_car']+1; 
            

            $sql= "insert into car(id_car,id_prenda,cantidad, id_usuario, talla) values (:id_car,:id_prenda,:cantidad,:id_usuario,:talla)";
            $insertar = $this->db->prepare($sql);
            $insertar->bindParam(':id_car', $id3 , PDO::PARAM_INT);
            $insertar->bindParam(':id_prenda', $data['id_prenda'], PDO::PARAM_INT);
            $insertar->bindParam(':cantidad', $data['cantidad'], PDO::PARAM_INT);
            $insertar->bindParam(':id_usuario', $id, PDO::PARAM_INT);
            $insertar->bindParam(':talla', $data['talla'], PDO::PARAM_STR);
            $insertar->execute();
            $cuenta = $insertar->rowCount();
            return $cuenta;
        }else{
    
            $sql= "insert into car(id_car,id_prenda,cantidad, id_usuario, talla) values (:id_car,:id_prenda,:cantidad,:id_usuario,:talla)";
            $insertar = $this->db->prepare($sql);
            $insertar->bindParam(':id_car', $car['id_car'], PDO::PARAM_INT);
            $insertar->bindParam(':id_prenda', $data['id_prenda'], PDO::PARAM_INT);
            $insertar->bindParam(':cantidad', $data['cantidad'], PDO::PARAM_INT);
            $insertar->bindParam(':id_usuario', $id, PDO::PARAM_INT);
            $insertar->bindParam(':talla', $data['talla'], PDO::PARAM_STR);
            $insertar->execute();
            $cuenta = $insertar->rowCount();
            return $cuenta;
        }

    }else{


        $linea = $this->db->prepare("select id_car from car order by id_car DESC limit 1;");
        $linea->execute();
        $id2 = $linea->fetch(PDO::FETCH_ASSOC); 
        $idn = $id2['id_car']+1; 

        $sql= "insert into car(id_car,id_prenda,cantidad, id_usuario, talla) values (:id_car,:id_prenda,:cantidad,:id_usuario,:talla)";
        $insertar = $this->db->prepare($sql);
        $insertar->bindParam(':id_car', $idn, PDO::PARAM_INT);
        $insertar->bindParam(':id_prenda', $data['id_prenda'], PDO::PARAM_INT);
        $insertar->bindParam(':cantidad', $data['cantidad'], PDO::PARAM_INT);
        $insertar->bindParam(':id_usuario', $id, PDO::PARAM_INT);
        $insertar->bindParam(':talla', $data['talla'], PDO::PARAM_STR);
        $insertar->execute();
        $cuenta = $insertar->rowCount();
        return $cuenta;
    }
}catch(Exception $e){
    echo '<script>alert("Ya existe esta prenda en el carrito")</script>';
}
    
}
public function update($data){
    $sql="update car set cantidad=:cantidad, talla=:talla
    where id_car=:id_car and id_usuario=:id_usuario and id_prenda=:id_prenda";
    
    $actualizar = $this->db->prepare($sql);
    $actualizar->bindParam(':id_car', $data['id_car'], PDO::PARAM_INT);
    $actualizar->bindParam(':id_prenda', $data['id_prenda'], PDO::PARAM_INT);
    $actualizar->bindParam(':cantidad', $data['cantidad'], PDO::PARAM_INT);
    $actualizar->bindParam(':id_usuario', $data['id_usuario'], PDO::PARAM_INT);
    $actualizar->bindParam(':talla', $data['talla'], PDO::PARAM_STR);
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
$CAR = new Car; 
$CAR->conexion();
?>