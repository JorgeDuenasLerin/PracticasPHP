<?php 
require_once('config.php');

class conexionBBDD {

    private $dbPDO; // necesitamos un objeto $dbPDO que va a ser la conexion con la db
    public function __construct(){
        global $db_user;
        global $db_pass;
        global $db_name;

        try {
            $this->dbPDO = new PDO(
              "mysql:host=localhost;dbname=$db_name;charset=utf8",
              $db_user,
              $db_pass
            );

        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function __destruct(){
        $this->dbPDO = null; // destruye la conexion 
    }
    /*NOTAS A TENER EN CUENTA
    EN GENERAL: IMPORTANTE QUE SEA PREPARE Y NO QUERY
    CONSULTAS UPDATE, DELETE Y INSERT: hacer un fetchAll no devolverá nada, con lo cual hay que hacer ->rowCount()
    si haces un print_r($rs->fetchAll(PDO::FETCH_ASSOC)); aunque sea un print se pierde lo que hay en $rs, por lo tanto hay que borrar las impresiones y devolver $rs despues de ejecutar
    */ 

    /**
     * Comprobar si el usuario o correo existe
     * Comprobar que ese usuario y su contraseña coincida
     */
    public function obtenerDatosUsuario(String $email){
        $rs = $this->dbPDO->prepare("SELECT * FROM usuario WHERE email = :email;");
        $rs->bindParam(':email', $email);
        $rs->execute();

        if(!$rs){
            print_r($this->dbPDO->errorInfo());
        } else {   
            // echo "<pre>";
            // print_r($rs->fetchAll(PDO::FETCH_ASSOC));
            // echo "</pre>";
            
            return $rs->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function obtenerDatosUsername(String $username){
        $rs = $this->dbPDO->prepare("SELECT * FROM usuario WHERE username = :username;");
        $rs->bindParam(':username', $username);
        $rs->execute();

        if(!$rs){
            print_r($this->dbPDO->errorInfo());
        } else {   
            // echo "<pre>";
            // print_r($rs->fetchAll(PDO::FETCH_ASSOC));
            // echo "</pre>";
            
            return $rs->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function consultarUsuarioPorId(String $id){
        $rs = $this->dbPDO->prepare("SELECT * FROM usuario WHERE id = :id;");
        $rs->bindParam(':id', $id);
         
        if(!$rs){
            print_r($this->dbPDO->errorInfo());
        } else {   
            $rs->execute();
            echo "<pre>";
            print_r($rs->execute());
            print_r($rs->fetchAll(PDO::FETCH_ASSOC));
            echo "</pre>";
            
            return $rs->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function consultarUsuarioPorEmail(String $email){
        $rs = $this->dbPDO->prepare("SELECT * FROM usuario WHERE email = :email;");
        $rs->bindParam(':email', $email);
         
        if(!$rs){
            print_r($this->dbPDO->errorInfo());
        } else {   
            $rs->execute();
            // echo "<pre>";
            // print_r($rs->execute());
            // print_r($rs->fetchAll(PDO::FETCH_ASSOC));
            // echo "</pre>";
            
            return $rs->rowCount();
        }
    }

    public function consultarUsuarioPorUsername(String $username){
        $rs = $this->dbPDO->prepare("SELECT * FROM usuario WHERE username = :username;");
        $rs->bindParam(':username', $username);

        if(!$rs->execute()){
            print_r($this->dbPDO->errorInfo());
        } else {
            $rs->execute();        
            return $rs->rowCount();
        }
    }

    public function comprobarUsuario(String $username, String $pass){
        
        $arroba = strpos($username, '@');
        // lo que costó, strpos no funciona bien para comprobar
        if(is_int($arroba)) {
            $usuario = self::obtenerDatosUsuario($username);

        } else {
            $usuario = self::obtenerDatosUsername($username);
        }

        if($usuario){
            $usuario = $usuario[0];
            // echo "<pre>";
            // echo "<b>{usuario}</b>";
            // print_r($usuario);
            // echo "</pre>";
            $passbbdd = $usuario['pass'];
            echo "$pass - $passbbdd";
            if(password_verify($pass, $passbbdd)){
                 echo "<h1>CONTRASEÑA CORRECTA</h1>";
                return $usuario;
            } else {
                 echo "<h1>CONTRASEÑA INCORRECTA</h1>";
                return false;
            }
            echo "<h1>$passbbdd</h1>";
            // return $resultado = $rs->rowCount();        
        }  else {
            //echo "1<br>";
            echo "<h1>conexMetodosBBDD.php - No existe el usuario</h1>";
            print_r($this->dbPDO->errorInfo());
            return false;
        }
    } // comprobarUsuario

    public function insertarUsuario($username, $email, $pass){
        $rs = self::consultarUsuarioPorEmail($email);
        if($rs == 0){
            $rs = self::consultarUsuarioPorUsername($username);
            if($rs == 0){
                $pass = password_hash($pass, PASSWORD_DEFAULT);
                $rs=$this->dbPDO->prepare("INSERT INTO usuario (username, email, pass) VALUES (:username, :email, :pass);");
                $rs->bindParam(':username', $username);
                $rs->bindParam(':email', $email);
                $rs->bindParam(':pass', $pass);
                $rs->execute();
                
                if($rs){
                    return $resultado = $rs->rowCount();
                } else {
                    //echo "1<br>";
                    return 0;
                }
            } else {
                //echo "2<br>";
                return null;
            }
        } else {
            //echo "3<br>";
            return false;
        }
    }

    public function insertarToken($token, $userid, $expires = "now() + INTERVAL 1 DAY"){
        $rs=$this->dbPDO->prepare("INSERT INTO auth_tokens (token, userid, expires) VALUES (:token, :userid, $expires);");
        $rs->bindParam(':token', $token);
        $rs->bindParam(':userid', $userid);
        $rs->execute();
        
        if($rs){
           return $resultado = $rs->rowCount();
        } else {
            print_r($this->dbPDO->errorInfo());
        }
    }
    
    public function borrarToken(String $token, String $id){
        $rs = $this->dbPDO->prepare("DELETE FROM auth_tokens WHERE token = :token AND userid = :id ;");
        $rs->bindParam(':token', $token);
        $rs->bindParam(':id', $id);
        $rs->execute();

        if(!$rs){
            print_r($this->dbPDO->errorInfo());
        } else {  
            return  $rs->rowCount();
        }
    }

    public function comprobarToken(String $token, String $id){
        $rs = $this->dbPDO->prepare("SELECT * FROM auth_tokens WHERE token = :token AND userid = :id;");
        $rs->bindParam(':token', $token);
        $rs->bindParam(':id', $id);

        if(!$rs->execute()){
            print_r($this->dbPDO->errorInfo());
        } else {
            $rs->execute();
            return  $rs->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function consultarToken(String $token){
        $rs = $this->dbPDO->prepare("SELECT * FROM auth_tokens WHERE token = :token;");
        $rs->bindParam(':token', $token);

        if(!$rs->execute()){
            print_r($this->dbPDO->errorInfo());
        } else {
            $rs->execute();
            return  $rs->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function cambiarPass(String $id, String $pass){
        // estaria genial hacer una preconsulta comprobando que la contraseña nueva no sea igual que la que ya estaba
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $rs = $this->dbPDO->prepare("UPDATE usuario SET pass = ? WHERE id = ?");
        $rs->execute([$pass, $id]);
        // echo "$id $pass<br>";
        if(!$rs){
            print_r($this->dbPDO->errorInfo());
        } else {   
            return $rs->rowCount();
        }
        die();
    }
    
} // de la clase conexMetodosBBDD
?>  