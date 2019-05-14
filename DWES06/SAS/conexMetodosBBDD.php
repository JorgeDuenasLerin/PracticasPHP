<?php 
require_once('configBBDD.php');

class conexMetodosBBDD {

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

    public function consultarUsuario(String $nombre, String $pass){
        //$sentenciaSQL=$this->dbPDO->query('SELECT * FROM agenda')->fetchAll();
      
        $rs = $this->dbPDO->prepare("SELECT * FROM usuario WHERE nombre = :nombre");
        $rs->bindParam(':nombre', $nombre);
        
        if(!$rs->execute()){
            //echo "<h1>conexMetodosBBDD.php - NO Funciona la consulta</h1>";
            print_r($this->dbPDO->errorInfo());         
        } else {
            //echo "<h1>conexMetodosBBDD.php - Funciona la consulta</h1>";
            $rs->execute();
            $resultado = $rs->fetchAll(PDO::FETCH_ASSOC);
            $passbbdd = $resultado[0]['pass'];

            //echo "<p>$nombre</p><p>$pass</p>";

            if(password_verify($pass, $passbbdd)){
                //echo "<h1>CONTRASEÑA CORRECTA</h1>";
                return true;
                //return $resultado;
            } else {
                //echo "<h1>CONTRASEÑA INCORRECTA</h1>";
                return false;
            }
            echo "<h1>$passbbdd</h1>";
            die();
        }
    }

    public function mostrarProductos(){
        //$sentenciaSQL=$this->dbPDO->query('SELECT * FROM agenda')->fetchAll();
        $sentenciaSQL=$this->dbPDO->query('SELECT * FROM fruteria.producto');
        
        if($sentenciaSQL){
           return $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        } else {
            print_r($this->dbPDO->errorInfo());
        }
    }

    public function actualizarProducto($cod, $nombre, $nombre_corto, $descripcion, $pvp){
        $rs = $this->dbPDO->prepare("UPDATE producto SET cod = :cod, nombre = :nombre, nombre_corto = :nombre_corto, descripcion = :descripcion, pvp = :pvp WHERE cod = :cod");
        $rs->bindParam(':cod', $cod);
        $rs->bindParam(':nombre', $nombre);
        $rs->bindParam(':nombre_corto', $nombre_corto);
        $rs->bindParam(':descripcion', $descripcion);
        $rs->bindParam(':pvp', $pvp);
        $rs->execute();
        if(!$rs){
            print_r($this->dbPDO->errorInfo());
            throw new Exception("Error en la query");
            echo "<h2>no funciona la consulta</h2>";
        } else {
            echo "<h2>funcion la consulta</h2>";
            print_r($rs);
            return $rs;
        }
    }

   
    
} // de la clase conexMetodosBBDD
?>  