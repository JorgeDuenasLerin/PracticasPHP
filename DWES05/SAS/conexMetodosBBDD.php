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

    /*
    `id` int NOT NULL,
    `nombre` varchar(50) NOT NULL,
    `descripcion` text,
    `precio` decimal(10,2) NOT NULL,
    `ecologico` boolean DEFAULT false NOT NULL,
    `tipo` int NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `nombre` (`nombre`),
        FOREIGN KEY tipo_fk (tipo)
                        REFERENCES tipo(id)
    */

    public function mostrarProductos(){
        //$sentenciaSQL=$this->dbPDO->query('SELECT * FROM agenda')->fetchAll();
        $sentenciaSQL=$this->dbPDO->query('SELECT * FROM fruteria.producto');
        
        if($sentenciaSQL){
           return $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        } else {
            print_r($this->dbPDO->errorInfo());
        }
    }// function mostrarProductos
    
} // de la clase conexMetodosBBDD
?>  