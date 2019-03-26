<?php

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
    <div>
      <span>Nombre</span>
      <span>Teléfono</span>
    </div>
    <div>
      <span>Nombre</span>
      <span>Teléfono</span>
    </div>
    <div>
      <span>Nombre</span>
      <span>Teléfono</span>
    </div>
    <div>
      <span>Nombre</span>
      <span>Teléfono</span>
    </div>
    <form action="index.php" method="post">
      Nombre: <input name="nombre" value="<?=$nombre?>" placeholder="Nombre..." /></br>
      Teléfono: <input name="telefono" value="<?=$telefono?>" placeholder="Teléfono..." /></br>
      <input type="submit" name="enviar" value="Enviar">
    </form>
  </body>
</html>
