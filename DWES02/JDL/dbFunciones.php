<?php

function conectar ($host, $dbname, $usuario, $password)
{
  try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $usuario, $password);
    return $db;
  }
  catch(PDOException $e) {
    echo $e->getMessage();
    die();
  }
}

function consulta ($dbConn, $sql){
  $sentencia = $dbConn->query($sql);

  # setting the fetch mode
  $sentencia->setFetchMode(PDO::FETCH_ASSOC);

  return $sentencia->fetchAll();
}

?>
