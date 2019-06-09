<?php
/**
 * Minijuegos: Tragaperras (1) - tragaperras-1.php
 *
 * @author    Escriba su nombre
 *
 */
session_start();

$moneda = 0;


// si tengo session moneda la guardo, si no es 0 y borrare
// si session moneda vale 0 la borro
// si no hay session de frutas genero numeros y si hay session de las frutas las guardo
// serializar para mandar



 // si tenemos sesion de moneda guardamos la cantidad, si no generamos otra vez frutas
 if(isset($_SESSION['moneda'])){
   $moneda = $_SESSION['moneda'];
   // $_SESSION['frutas'] = $numeros;
 }
 // si moneda vale 0, quiero quitar la variable para facilitarme la vida en futuras comprobaciones
 if(isset($_SESSION['moneda']) && $_SESSION['moneda'] == 0)  {
   unset($_SESSION['moneda']);
   echo "<h1>index.php | entro</h1>";
 }

 if(! isset($_SESSION['frutas'])){
    $numeros = generarNumerosAleatorios();
    echo "<pre>";
    echo "<b>{numeros}</b>";
    print_r($numeros);
    echo "</pre>";
    $_SESSION['frutas'] = $numeros;
 } else { // Recupero las frutas que habia y las cargo porque le ha dado a introducir moneda
  $numeros = $_SESSION['frutas'];
 }

  // para mandar todo el array en un solo input hidden
  $numerosSerializados = serialize($numeros);

 

   
echo "<pre>";
echo "<b>{_SESSION}</b>";
print_r($_SESSION);
echo "</pre>";

echo "<pre>";
echo "<b>{_POST}</b>";
print_r($_POST);
echo "</pre>";


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
        <!-- our form hidden input -->
        <input type="hidden" name="frutas" value="<?php echo $numerosSerializados; ?>">
        <p><?= $moneda ?></p>
      </form>
    </td>
    <td>
        <form method="post" action="comprobarMoneda.php">
        <input type="hidden" name="frutas" value="<?php echo $numerosSerializados; ?>">
          <button type="submit" name="jugar">Jugar</button><br>
        </form>
    </td>
  
  </tr>
</table>

  <footer>
    <!-- <p>Escriba su nombre</p> -->
  </footer>
</body>
</html>
