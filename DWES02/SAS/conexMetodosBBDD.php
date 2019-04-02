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
    nombre VARCHAR(30) NOT NULL,
    apellido VARCHAR(30) NOT NULL,
    sueldo INTEGER NOT NULL,
    fecha_contratacion DATE NOT NULL,
    */

    public function crearEmpleado(string $nombre, string $apellido, string $sueldo){
        $sentenciaSQL=$this->dbPDO->prepare("INSERT INTO empleado(nombre, apellido, sueldo, fecha_contratacion) 
                            VALUES (:nombre, :apellido, :sueldo, CURRENT_DATE)
                           ");
            $sentenciaSQL->bindParam(':nombre', $nombre);
            $sentenciaSQL->bindParam(':apellido', $apellido);
            $sentenciaSQL->bindParam(':sueldo', $sueldo);
            $sentenciaSQL->execute(); 

        /* Redirigimos al archivo listar empleados*/
        header('Location: listarEmpleados.php');
        exit;
    }

    /*
    nombre VARCHAR(30) NOT NULL,
    apellido VARCHAR(30) NOT NULL,
    sueldo INTEGER NOT NULL,
    fecha_contratacion DATE NOT NULL,
    */

    public function mostrarEmpleados(string $ordenarPor="id"){ // string $ordenarPor 
        try {
            $sentenciaSQL = $this->dbPDO->query("SELECT id, nombre, apellido FROM empleado ORDER BY $ordenarPor");
            //$sentenciaSQL->execute();
            if (!$sentenciaSQL) {
                    print_r($this->dbPDO->errorInfo());
                    echo "No hay Empleados";     
            }else{
             // BOTH en inglés es AMBOS (asociativo y numérico)
             // ASSOC solo lo devuelve en modo asociativo
                $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
                return $resultado;
            }   
        } catch (PDOException $e) {
            print_r("¡Error!: ". $e->getMessage() . "<br/>");
            die();
        }
    }//ListarTemas 

    public function verEmpleado(int $id){
        try {
            $sentenciaSQL = $this->dbPDO->query("SELECT * FROM empleado WHERE id=$id");
            //$sentenciaSQL->execute();
            if (!$sentenciaSQL) {
                    print_r($this->dbPDO->errorInfo());
                    echo "No hay Empleados";     
            }else{
             // BOTH en inglés es AMBOS (asociativo y numérico)
             // ASSOC solo lo devuelve en modo asociativo
                $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
                return $resultado;
            }   
        } catch (PDOException $e) {
            print_r("¡Error!: ". $e->getMessage() . "<br/>");
            die();
        }
    }//ListarTemas 

    public function borrarEmpleado(int $id){
        $sentenciaDeleteSQL = $this->dbPDO->prepare(
                            "DELETE FROM empleado WHERE id = :id"
        );
        $sentenciaDeleteSQL->bindParam(':id', $id);
        $sentenciaDeleteSQL->execute();
        
        /* Redirigimos al archivo listar empleados*/
        header('Location: listarEmpleados.php');
        exit;
    }//borrarTema

    public function actualizarEmpleado(int $id, int $nuevoSueldo){
        echo "dentro";
        try {
            $sentenciaUpdateSQL = $this->dbPDO->prepare("UPDATE empleado SET sueldo = :nuevoSueldo WHERE id = :id");
            $sentenciaUpdateSQL->bindParam(':id', $id);
            $sentenciaUpdateSQL->bindParam(':nuevoSueldo', $nuevoSueldo);
            $sentenciaUpdateSQL->execute();

            // if (!$sentenciaSQL) {
            //         print_r($this->dbPDO->errorInfo());
            //         echo "No existe ese empleado Empleados";     
            // } 
            // Redirigimos al archivo listar empleados
            header('Location: perfilEmpleado.php?id='.urlencode($id));
            exit;
        

        } catch (PDOException $e) {
            print_r("¡Error!: ". $e->getMessage() . "<br/>");
            die();
        }
    }

    // public function actualizarEmpleado(int $id,int $nuevoSueldo){
    //     try {
    //         $sentenciaSQL = $this->dbPDO->prepare("UPDATE empleado SET sueldo=:nuevoSueldo WHERE id=:id");
    //             $sentenciaSQL->bindParam(':id',$id);
    //             $sentenciaSQL->bindParam(':nuevoSueldo',$nuevoSueldo);
    //             $sentenciaSQL->execute();
    //             header("Location: empleadoVer.php?id=".urldecode($id));
    //             exit;

    //         //Se podria poner un error al igual que en la linea 27
    //     } catch (PDOException $e) {
    //         print_r("¡Error!: ". $e->getMessage() . "<br/>");
    //         die();
    //     }
    // }//actualizarEmpleado

} // de la clase conexMetodosBBDD
?>  