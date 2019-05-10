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
              "mysql:host=localhost;dbname=$db_name",
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

    /*
    id INT AUTO_INCREMENT,
    nombre VARCHAR(80) NOT NULL,
    telefono VARCHAR(12) NOT NULL,
    PRIMARY KEY (id)
    */

    public function mostrarProductos(){
        //$sentenciaSQL=$this->dbPDO->query('SELECT * FROM agenda')->fetchAll();
        $sentenciaSQL=$this->dbPDO->query('SELECT * FROM fruteria.producto');
        
        if($sentenciaSQL){
           return $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        } else {
            print_r($this->dbPDO->errorInfo());
        }
    }

    public function probando(String $usuario){
        //$sentenciaSQL=$this->dbPDO->query('SELECT * FROM agenda')->fetchAll();
        $rs = $this->dbPDO->prepare("SELECT * FROM usuario WHERE nombre = :usuario");
        $rs->bindParam(':usuario', $usuario);
        
        if($rs){
           return $resultado = $rs->fetchAll(PDO::FETCH_ASSOC);
        } else {
            print_r($this->dbPDO->errorInfo());
        }
    }

    public function consultarUsuario(String $usuario, String $password){
        //$sentenciaSQL=$this->dbPDO->query('SELECT * FROM agenda')->fetchAll();
        $rs = $this->dbPDO->prepare("SELECT * FROM usuario WHERE nombre = :usuario AND pass = :pass");
        $rs->bindParam(':usuario', $usuario);
        $rs->bindParam(':pass', $pass);
        
        if($rs){
           return $resultado = $rs->rowCount();
        } else {
            print_r($this->dbPDO->errorInfo());
        }
    }


    public function mostrarFamilia(string $familia){
        $rs = $this->dbPDO->prepare("SELECT * FROM producto WHERE familia = :familia");
        $rs->bindParam(':familia', $familia);
        $rs->execute();
        if(!$rs){
            print_r($this->dbPDO->errorInfo());
            throw new Exception("<h3>Oh noes! There's an error in the query!</h3>");
            //echo "<h2>no funciona la consulta</h2>";
        } else {
            //echo "<h2>funciona la consulta </h2>";
            //$resultado = $rs->fetchAll(PDO::FETCH_ASSOC);    
            $resultado = $rs->rowCount();    
            //print_r($resultado[0]);
           
            return $resultado;
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