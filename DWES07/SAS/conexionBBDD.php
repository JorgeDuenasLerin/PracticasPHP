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
    */ 

    /**
     * Comprobar si el usuario o correo existe
     * Comprobar que ese usuario y su contraseña coincida
     */

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

    public function consultarNombre(String $nombre){
        $rs = $this->dbPDO->prepare("SELECT * FROM usuario WHERE nombre = :nombre;");
        $rs->bindParam(':nombre', $nombre);

        if(!$rs->execute()){
            print_r($this->dbPDO->errorInfo());
        } else {
            $rs->execute();        
            return $rs->fetchAll(PDO::FETCH_ASSOC);;
        }
    }

    public function consultarUsuario(String $nombre, String $pass){
        //$sentenciaSQL=$this->dbPDO->query('SELECT * FROM agenda')->fetchAll();
      
        $rs = $this->dbPDO->prepare("SELECT * FROM usuario WHERE nombre = :nombre");
        $rs->bindParam(':nombre', $nombre);
        $rs->execute();

        if(!$rs){
            // echo "<h1>conexMetodosBBDD.php - NO Funciona la consulta</h1>";
            print_r($this->dbPDO->errorInfo());         
        } else {
            // echo "<h1>conexMetodosBBDD.php - Funciona la consulta</h1>";
            $resultado = $rs->fetchAll(PDO::FETCH_ASSOC);

            if($resultado){
               
                
                $passbbdd = $resultado[0]['pass'];
                if(password_verify($pass, $passbbdd)){
                    // echo "<h1>CONTRASEÑA CORRECTA</h1>";
                    return $resultado;
                    //return $resultado;
                } else {
                    // echo "<h1>CONTRASEÑA INCORRECTA</h1>";
                    return false;
                }
                //echo "<h1>$passbbdd</h1>";
            }
            //echo "<p>$nombre</p><p>$pass</p>";
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
        //echo "$id $pass<br>";

        if(!$rs){
            print_r($this->dbPDO->errorInfo());
        } else {   
            return $rs->rowCount();
        }

    }
    
} // de la clase conexMetodosBBDD
?>  