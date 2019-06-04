<?php 
require_once "conexionBBDD.php";

class metodos {
    public function cleanInput(string $dato){
        $dato = trim($dato);
        $dato = stripslashes($dato);
        $dato = htmlspecialchars($dato);
        return $dato;
    
    }//cleanInput()

    function generateToken($length = 30){
        return bin2hex(random_bytes($length));
    }

    public function iniciarSesion(string $usuario, string $password){
        $usuario = self::cleanInput($usuario);
        $password = self::cleanInput($password); 
        $conexion = new conexionBBDD();
        $conexion->comprobarUsuario($usuario, $password);
        echo "<pre>";
        echo "<b>{conexion}</b>";
        print_r($conexion);
        echo "</pre>";
        
        return $conexion;
        $conexion->__destruct();
    }

    public function registrarUsuario(string $usuario, string $email ,string $password){
        $usuario = self::cleanInput($usuario);
        $email = self::cleanInput($email);
        //$password = self::cleanInput($password);
        $conexion = new conexionBBDD();
        $conexion->insertarUsuario($usuario, $email, $password);
        return $conexion;
        $conexion->__destruct();
    }

    public function restablecerContra($email){
        $email = self::cleanInput($email);
        $conexion = new conexionBBDD();
        $existe = $conexion->consultarUsuarioPorEmail($email);
        if($existe == 1 ){
            // obtener id del usuario
            $datosUsuario = $conexion->obtenerDatosUsuario($email);
            echo "<pre>";
            echo "<b>{datosUsuario}</b>";
            print_r($datosUsuario);
            echo "</pre>";
            
            $datosUsuario = $datosUsuario[0];
            $id = $datosUsuario['id'];

            // generar token y insertarlo en la bbdd
            $token = self::generateToken();
            $datosUsuario = $conexion->insertarToken($token, $id);

            // ponerle por get el token el id y el token
            // redirigirle a un formulario para poner nueva contraseña
            header("location: forgot.php?id=$id&token=$token");
            return true;
        } else {
            // mostrar mensaje de error
            return false;
        }
    }

    public function comprobarToken($token, $id){
        $conexion = new conexionBBDD();
        $existe = $conexion->comprobarToken($token, $id);
        return $existe;
        $conexion->__destruct();
    }

    public function cambiarContra($id, $pass){
        $conexion = new conexionBBDD();
        $cambiarContra = $conexion->cambiarPass($id, $pass);
        return $cambiarContra;
        $conexion->__destruct();
    }
  
}
?>