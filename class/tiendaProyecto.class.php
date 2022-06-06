<?php 
require_once("configuracion.php");

if(file_exists('../vendor/autoload.php')){
    require('../vendor/autoload.php');
}else{
    require('../../vendor/autoload.php');
}


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

session_start();
class tiendaProyecto{
    var $db=null;
    public function conexion(){
        $dsn = SGBD.':dbname='.BD_NAME.';host='.BD_HOST;
        $this->db = new PDO($dsn,BD_USER,BD_PASSWORD);     
    }
    
    public function alerta($mensaje, $tipo){
        include_once("view/mensajes.php");
    }
    public function alertaError($mensaje){
        include_once('view/header_error.php');
        $this ->alerta($mensaje,'danger');
        //$this->logOut();
        include_once('view/footer.php');
        die();
    }

    public function cargarImagen($carpeta){
        if(isset($_FILES["foto"])){
            $fotografia = $_FILES["foto"]; 
            if($fotografia["error"]==0){
                if($fotografia["size"]<=IMG_SIZE){
                    if(in_array($fotografia["type"], IMG)){
                        $origen=$fotografia["tmp_name"];
                        $num = random_int(1, 100);
                        $destino= PATH."images/".$carpeta."/".$num."_".$fotografia["name"]; 
                        if(move_uploaded_file($origen, $destino)){
                            return "images/".$carpeta."/".$num."_".$fotografia["name"]; 
                        }
                    }
                }
            }
        }
        
        return false;
    }
    
    /*  Funcion para validar usuario y contraseña
    @param string correo;
    @param string contrasena_plana;
    @return boolean;
    */
    public function login($correo, $contrasena){
        $contrasena = md5($contrasena);
        if($this->validateEmail($correo)){
            $sql="select * from usuario where correo=:correo and contrasena=:contrasena";
            $usuario = $this->db->prepare($sql);
            $usuario->bindParam(':correo', $correo, PDO::PARAM_STR);
            $usuario->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
            $usuario->execute();
            $usuario = $usuario->fetch(PDO::FETCH_ASSOC);

            if(isset($usuario["correo"])){
                $_SESSION['validado'] = true;
                $_SESSION['correo'] = $correo;
                $_SESSION['roles'] = $this->roles($correo);
                $_SESSION['permisos'] = $this->permisos($correo);
                $_SESSION['nombre'] = $usuario['nombre'];
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                return true;
            }   
            
        }
        $this->logOut();
        return false;

    }

    public function logOut(){
        if (isset($_SESSION['validado'])) unset($_SESSION['validado']);
        if (isset($_SESSION['correo'])) unset($_SESSION['correo']);
        if (isset($_SESSION['roles'])) unset($_SESSION['roles']);
        if (isset($_SESSION['permisos'])) unset($_SESSION['permisos']);
        session_destroy();
    }

    //valida el usuario
    public function validateUser(){
        if(isset($_SESSION['validado'])){        
            if($_SESSION['validado']){
                return true;
            }
        }
        return false;
    }
    /*
    Funcion para validar correo como expresion regular
    @param varchar correo
    @return boolean;
    */
    public function validateEmail($correo){
        if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }

    /*
    Este metodo obtiene los roles de un correo
    @param varchar correo
    @return roles[];
    */
    public function roles($correo){
        $roles=[];
        $sql='select r.rol FROM usuario join usuario_rol USING(id_usuario) join rol r USING(id_rol) where correo=:correo;';
        $rol = $this->db->prepare($sql);
        $rol->bindParam(':correo', $correo, PDO::PARAM_STR);
        $rol->execute();
        $rol = $rol->fetchAll(PDO::FETCH_ASSOC);
        if(isset($rol[0]['rol'])){
            foreach($rol as $r){
                array_push($roles, $r['rol']);
            }
        }
        return $roles;
    }

    public function permisos($correo){
        $permisos=[];
        $sql='select permiso FROM usuario join usuario_rol USING(id_usuario) join permiso_rol USING(id_rol) join permiso using(id_permiso) where correo=:correo;';
        $permiso = $this->db->prepare($sql);
        $permiso->bindParam(':correo', $correo, PDO::PARAM_STR);
        $permiso->execute();
        $permiso = $permiso->fetchAll(PDO::FETCH_ASSOC);
        if(isset($permiso[0]['permiso'])){
            foreach($permiso as $p){
                array_push($permisos, $p['permiso']);
            }
        }
        return $permisos;
    }

    /*
    Valida si el usuario tiene  el rol nada mas
    @param varchar permiso
    @return booleano;
    */
    public function validateRol($rol){
        if($this -> validateUser()){          
            $roles = $_SESSION['roles'];
            
            if(!in_array($rol, $roles)){
                $this -> alertaError('Usted no tiene el rol que le corresponde para realizar esta accion');
                return true;
            }
        }else{
            $this -> alertaError('Usted no es un usuario valido');
            return false;
        }
    }
    /*
    Valida si el usuario tiene  el permiso nada mas
    @param varchar permiso
    @return booleano;
    */
    public function validatePermiso($permiso){
        if($this -> validateUser()){
            $permisos = $_SESSION['permisos'];
            if(!in_array($permiso, $permisos)){
                $this -> alertaError('Usted no tiene el permiso que le corresponde para realizar esta accion');
            }
        }else{
            $this -> alertaError('Usted no es un usuario valido');
        }
    
    }

    public function enviarEmail($destinatario, $asunto, $msg){
        require '../../vendor/autoload.php';
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth = true;
        $mail->Username = EMAIL;
        $mail->Password = EMAIL_PASS;
        $mail->setFrom(EMAIL, 'Aran Uzziel');
        $mail->addAddress($destinatario, $destinatario);
        $mail->Subject = $asunto;
        $mail->msgHTML($msg);
        if (!$mail->send()) {
            return false;
        } else {
            return true;

        }
        function save_mail($mail)
        {
            $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';
            $imapStream = imap_open($path, $mail->Username, $mail->Password);
            $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
            imap_close($imapStream);
            return $result;
        }
    }

    public function recuperar($correo){
        $sql = 'select correo from usuario where correo=:correo';
        $recupera = $this->db->prepare($sql);
        $recupera->bindParam(':correo', $correo, PDO::PARAM_STR);
        $recupera->execute();
        $recuperado = $recupera->fetchAll(PDO::FETCH_ASSOC);
    
        if($recuperado[0]['correo']){
            $token= substr(md5(md5($correo.random_int(1,100000).'golden'.md5(random_int(1,500)).soundex('uculele'))),1,16);
            $sql='update usuario set token=:token where correo=:correo';
            $update = $this->db->prepare($sql);
            $update->bindParam(':correo', $correo, PDO::PARAM_STR);
            $update->bindParam(':token', $token, PDO::PARAM_STR);
            $update->execute();
            $mensaje = "<h2>Apreciable usuario presione el siguiente vinculo para reestablecer
            su contraseña. <h2><br><br><br> <a href=\"http://localhost:8080/tiendaProyecto/admin/login.php?accion=restablecer&correo=$correo&token=$token\"target=\"_blank\">Recuperar contraseña</a>
            <br><br>
            Si usted no realizo esta accion por favor ignore este correo y contacte el administrador.";
            $this->enviarEmail($correo,"Recuperacion de contraseña", $mensaje);
            return true;
        }
        return false;
    }

    public function validarToken($correo, $token){
        if($this->validateEmail($correo) && strlen($token)==16){
            $sql="select * from usuario where correo=:correo and token=:token";
            $usuario = $this->db->prepare($sql);
            $usuario->bindParam(':correo', $correo, PDO::PARAM_STR);
            $usuario->bindParam(':token', $token, PDO::PARAM_STR);
            $usuario->execute();
            $usuario = $usuario->fetch(PDO::FETCH_ASSOC);
            if(isset($usuario['correo'])){
                return true; 
            }     
        }
        return false;

    }

    public function nuevaContrasena($correo,$contrasena,$token){
        $contrasena = md5($contrasena);
        $sql = 'update usuario set contrasena=:contrasena, token=null where correo=:correo and token=:token';
        $update = $this->db->prepare($sql);
        $update->bindParam(':correo', $correo, PDO::PARAM_STR);
        $update->bindParam(':token', $token, PDO::PARAM_STR);
        $update->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
        $cuenta = $update->execute();
        return $cuenta;
    }

    public function pdf($orientacion, $tamano, $contenido, $nombre){
        error_reporting(E_ALL ^ E_WARNING);
        ob_clean();
        $html2pdf = new HTML2PDF($orientacion, $tamano, 'es');
//      $html2pdf->setModeDebug();
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($contenido);
        $html2pdf->Output($nombre);
        die();
    }

    public function json($datos, $status,$mensaje){
        ob_clean();
        header("content-type: application/json");
        http_response_code($status);
        array_push($datos, $mensaje);
        $datos=json_encode($datos, JSON_PRETTY_PRINT);
        echo $datos;
        die();
    }

    public function getAllSlider(){
        $todo = $this->db->prepare("select * from slider where vigencia>=CURRENT_DATE()
                                    ORDER BY prioridad");
        $todo->execute();
        $datos = $todo->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }
}

$tienda = new tiendaProyecto;
$tienda->conexion();
?>
