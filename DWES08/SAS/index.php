<?php
/**
 * Minijuegos: Tragaperras (1) - tragaperras-1.php
 *
 * @author    Escriba su nombre
 *
 */
session_start();

 if(isset($_SESSION['moneda'])){
   $moneda = $_SESSION['moneda'];
   $_SESSION['frutas'] = $numeros;
 } else {
   $numeros = generarNumerosAleatorios();
   echo "<pre>";
   echo "<b>{numeros}</b>";
   print_r($numeros);
   echo "</pre>";
   $moneda = 0;
 }


if(isset($_SESSION['frutas'])){
  $numeros = $_SESSION['frutas'];
}
 


function generarNumerosAleatorios(){
  return [mt_rand(1,8), mt_rand(1,8), mt_rand(1,8)];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>
    index.php
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Index.php</h1>

<table>
  <tr>
    <?php

      echo "<td><img src=\"img/frutas/$numeros[0].svg\"/></td>";
      echo "<td><img src=\"img/frutas/$numeros[1].svg\"/></td>";
      echo "<td><img src=\"img/frutas/$numeros[2].svg\"/></td>";
    ?>
  </tr>
  <tr>
    <td>
      <form method="post" action="comprobarMoneda.php">
        <button type="submit" name="moneda" value="<?= $moneda ?>">Meter moneda</button><br>
        <p><?= $moneda ?></p>
      </form>
    </td>
  </tr>
</table>

  <footer>
    <!-- <p>Escriba su nombre</p> -->
  </footer>
</body>
</html>
