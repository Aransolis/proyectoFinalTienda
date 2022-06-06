<?php 
require_once('tiendaProyecto.class.php');
class Prendas extends tiendaProyecto {
    public function read(){
        $linea = $this->db->prepare("SELECT * FROM prenda;");
        $linea->execute();
        $prendas = $linea->fetchAll(PDO::FETCH_ASSOC);  
        return $prendas;
    }

    public function readPrendasCantidad(){
        $linea = $this->db->prepare("SELECT distinct t.tipo_prenda, p.cantidad FROM prenda p join tipo_prenda t using(id_tipo_prenda);");
        $linea->execute();
        $prendas = $linea->fetchAll(PDO::FETCH_ASSOC);  
        return $prendas;
    }

    public function readSinDesc(){
        $linea = $this->db->prepare("select * FROM prenda LEFT JOIN descuento USING(id_prenda);");
        $linea->execute();
        $prendas = $linea->fetchAll(PDO::FETCH_ASSOC);  
        return $prendas;
    }

    public function readOne($id){
        $linea = $this->db->prepare("select * FROM prenda where id_prenda=:id_prenda");
        $linea->bindParam(':id_prenda', $id, PDO::PARAM_INT);
        $linea->execute();
        $prendas = $linea->fetch(PDO::FETCH_ASSOC);  
        return $prendas;
    }
    public function readGenero($id, $genero){
        $linea = $this->db->prepare("select * FROM prenda where id_tipo_prenda=:id_tipo_prenda and genero=:genero");
        $linea->bindParam(':id_tipo_prenda', $id, PDO::PARAM_INT);
        $linea->bindParam(':genero', $genero, PDO::PARAM_STR);
        $linea->execute();
        $prendas = $linea->fetchAll(PDO::FETCH_ASSOC);  
        return $prendas;
    }
    public function readDescuento($genero){
        $linea = $this->db->prepare("select * from prenda  join descuento 
        using(id_prenda) where genero=:genero;");
        $linea->bindParam(':genero', $genero, PDO::PARAM_STR);
        $linea->execute();
        $descuento = $linea->fetchAll(PDO::FETCH_ASSOC);  
        return $descuento;
    }
    public function delete($id){
            $borrar = $this->db->prepare('delete from prenda where id_prenda=:id_prenda');
            $borrar->bindParam(':id_prenda', $id, PDO::PARAM_INT);
            $borrar->execute();
            $cuenta = $borrar->rowCount();
            return $cuenta;
        
    }
    public function create($data){
        $cuenta=null;
        $foto= $this->cargarImagen("ropa");

        if($foto){
            $sql= "insert into prenda(prenda,cantidad,id_tipo_prenda,foto,precio,costo,genero) values (:prenda,:cantidad,:id_tipo_prenda,:foto,:precio,:costo,:genero)";
            $insertar = $this->db->prepare($sql);
            $insertar->bindParam(':prenda', $data['prenda'], PDO::PARAM_STR);
            $insertar->bindParam(':cantidad', $data['cantidad'], PDO::PARAM_INT);
            $insertar->bindParam(':id_tipo_prenda', $data['id_tipo_prenda'], PDO::PARAM_INT);
            $insertar->bindParam(':foto', $foto, PDO::PARAM_STR);
            $insertar->bindParam(':precio', $data['precio'], PDO::PARAM_STR);
            $insertar->bindParam(':costo', $data['costo'], PDO::PARAM_STR);
            $insertar->bindParam(':genero', $data['genero'], PDO::PARAM_STR);
            $insertar->execute();
            
            $cuenta = $insertar->rowCount();
        }
        return $cuenta;
    }
    public function update($id, $data){
        $foto= $this->cargarImagen("ropa");
        if($foto){
            $sql="update prenda set prenda=:prenda,
            cantidad=:cantidad,id_tipo_prenda=:id_tipo_prenda,
            foto=:foto,precio=:precio,costo=:costo,genero=:genero 
            where id_prenda=:id_prenda";
            
        }else{
            $sql="update prenda set prenda=:prenda,
            cantidad=:cantidad,id_tipo_prenda=:id_tipo_prenda,
            precio=:precio,costo=:costo,genero=:genero 
            where id_prenda=:id_prenda";
        }
        $actualizar = $this->db->prepare($sql);
        $actualizar->bindParam(':id_prenda', $id, PDO::PARAM_STR);
        $actualizar->bindParam(':prenda', $data['prenda'], PDO::PARAM_STR);
        $actualizar->bindParam(':cantidad', $data['cantidad'], PDO::PARAM_INT);
        $actualizar->bindParam(':id_tipo_prenda', $data['id_tipo_prenda'], PDO::PARAM_INT);
        $actualizar->bindParam(':precio', $data['precio'], PDO::PARAM_STR);
        $actualizar->bindParam(':costo', $data['costo'], PDO::PARAM_STR);
        $actualizar->bindParam(':genero', $data['genero'], PDO::PARAM_STR);
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
$PRENDAS = new Prendas; 
$PRENDAS->conexion();
?>