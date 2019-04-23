<?php

/*

Clase para conectarse a una base de datos y ejecutar consultas parametrizadas.

por:
  Jorge Dueñas Lerín
*/

class DB {

    private $connection;

    public function __construct(
                        $db_user,
                        $db_password,
                        $db_name,
                        $db_host='localhost',
                        $db_type='mysql'
                    ) {
        try {
            $this->connection = new PDO(
              "$db_type:host=$db_host;dbname=$db_name",
              $db_user,
              $db_password
            );
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            //echo print_r($e, true);
            die();
        }
    }

    public function getLastId(){
        return $this->connection->lastInsertId();
    }

    /*

    $db->execute("SELECT * FROM articulos WHERE id = ?" , 34);
    $db->execute("SELECT * FROM articulos WHERE id = ? AND login = ?", 34, 'Jorge');

      Esta función devuelve...
        Si estamos pidiendo un conjunto de datos:
          un array con la información
        Si estamos ejecutando una sentencia insert, update o delete:
          un array vacío
        Si da un error una cadena con el error
    */
    public function ejecutar($sql, ...$params) {
        try {
            if ( !$this->connection ) {
                return false;
            }

            $sentenciaSQL = $this->connection->prepare($sql);
            print_r($sentenciaSQL);
            $sentenciaEjecutada = $sentenciaSQL->execute($params);
            print_r($sentenciaEjecutada);

            if(!$sentenciaEjecutada) {
                // Es boolean y contiene false
                //  tenemos un error
                return implode(' - ', $sentenciaSQL->errorInfo());
            } else {
                $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
                return $resultado;
            }
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            return false;
        }
    }

    public function __destruct()
    {
        $this->connection = null;
    }
}

?>
