<?php

require_once("config.php");
require_once("dbFunciones.php");

// Sección de base de datos
$conn = conectar($host, $dbname, $usuario, $password);
$datos = consulta($conn, 'SELECT * from agenda');


// Variables del formulario
$nombre="";
$telefono="";

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php foreach ($datos as $fila) { ?>
      <div>
        <span><?=$fila['nombre']?></span>
        <span><?=$fila['telefono']?></span>
      </div>
    <?php } ?>
    <span>------------------------------------------------</span>
    <form action="index.php" method="post">
      Nombre: <input name="nombre" value="<?=$nombre?>" placeholder="Nombre..." /></br>
      Teléfono: <input name="telefono" value="<?=$telefono?>" placeholder="Teléfono..." /></br>
      <input type="submit" name="enviar" value="Enviar">
    </form>
  </body>
</html>
