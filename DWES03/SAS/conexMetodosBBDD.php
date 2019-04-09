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

    public function mostrarContactos(){
        //$sentenciaSQL=$this->dbPDO->query('SELECT * FROM agenda')->fetchAll();
        $sentenciaSQL=$this->dbPDO->query('SELECT * FROM agenda');
        
        if($sentenciaSQL){
           return $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        } else {
            print_r($this->dbPDO->errorInfo());
        }
    }

    public function mostrarFamilia(string $familia){
       
        try {
            $rs = $this->dbPDO->prepare("SELECT * FROM producto WHERE familia = :familia");
            $rs->bindParam(':familia', $familia);
            $rs->execute();

            if(!$rs){
                print_r($this->dbPDO->errorInfo());
                throw new Exception("<h3>Oh noes! There's an error in the query!</h3>");
                //echo "<h2>no funciona la consulta</h2>";
            } else {
                //echo "<h2>funciona la consulta </h2>";
                $resultado = $rs->fetchAll(PDO::FETCH_ASSOC);    
                //print_r($resultado[0]);
               
                return $resultado;
            }
            
        } catch (Exception $e) {
            print_r($this->dbPDO->errorInfo());
            echo 'Message: ' .$e->getMessage();
            die();
        }
    }

    public function consultarContacto(string $nombre){
        $sentenciaSQL = $this->dbPDO->prepare("SELECT * FROM agenda WHERE nombre = :nombre");
        $sentenciaSQL->bindParam(':nombre', $nombre);
        $sentenciaSQL->execute();
        if(!$sentenciaSQL){
            print_r($this->dbPDO->errorInfo());
        } else {
            $resultado = $sentenciaSQL->fetchALl(PDO::FETCH_ASSOC);
            return $resultado;
        }
    }

    public function crearContacto(string $nombre, string $telefono){

        if(!$existeContacto){
            $sentenciaSQL=$this->dbPDO->prepare("INSERT INTO agenda(nombre, telefono) VALUES (:nombre, :telefono)");
            $sentenciaSQL->bindParam(':nombre', $nombre);
            $sentenciaSQL->bindParam(':telefono', $telefono);
            $sentenciaSQL->execute(); 
        } else {
            echo "<h2>Ya existe el contacto</h2>";
        }

        if (!$sentenciaSQL) {
            print_r($this->dbPDO->errorInfo());
        }else{
            // BOTH en inglés es AMBOS (asociativo y numérico)
            // ASSOC solo lo devuelve en modo asociativo
            $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }
    } // funcion crearContacto

    public function modificarContacto(string $nombre, string $telefono){
        $stmt = $this->dbPDO->prepare("UPDATE agenda SET telefono = :telefono WHERE nombre = :nombre");
        
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':telefono', $telefono);

        $stmt->execute();

        return $stmt;
    }

    public function eliminarContacto(string $nombre){
        $stmt=$this->dbPDO->prepare("DELETE FROM agenda WHERE nombre = :nombre");
        $stmt->bindParam(':nombre', $nombre);

        $stmt->execute();

        return $stmt->rowCount();
    }
    
} // de la clase conexMetodosBBDD
?>  