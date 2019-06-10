<?php
/**
 * Minijuegos: Tragaperras (1) - tragaperras-1.php
 *
 * @author    Escriba su nombre
 *
 */
session_start();




// si tengo session moneda la guardo, si no es 0 y borrare
// si session moneda vale 0 la borro
// si no hay session de frutas genero numeros y si hay session de las frutas las guardo
// serializar para mandar


$moneda = 0;
 // si tenemos sesion de moneda guardamos la cantidad, si no generamos otra vez frutas
 if (isset($_SESSION['moneda'])) {
     $moneda = $_SESSION['moneda'];
 }

 $apuesta = 0;
 // si tenemos sesion de apuesta guardamos la cantidad, si no generamos otra vez frutas
 if (isset($_SESSION['apuesta'])) {
     $apuesta = $_SESSION['apuesta'];
 }

if (isset($_SESSION['premio']) && $_SESSION['premio'] == -1) {
    $_SESSION['premio'] = 0;
}

 $premio = 0;
 // si tenemos sesion de premio guardamos la cantidad, si no generamos otra vez frutas
 if (isset($_SESSION['premio'])) {
     $premio = $_SESSION['premio'];
 }

 if (! isset($_SESSION['frutas'])) {
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

if ($_SESSION) {
    echo "<pre>";
    echo "<b>{_SESSION}</b>";
    print_r($_SESSION);
    echo "</pre>";
}


function generarNumerosAleatorios()
{
    return [mt_rand(1, 8), mt_rand(1, 8), mt_rand(1, 8)];
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
      echo "<pre>";
      echo "<b>{numeros}</b>";
      print_r($numeros);
      echo "</pre>";
      
      echo "<td><img src=\"img/frutas/$numeros[0].svg\"/></td>";
      echo "<td><img src=\"img/frutas/$numeros[1].svg\"/></td>";
      echo "<td><img src=\"img/frutas/$numeros[2].svg\"/></td>";
    ?>
    <td rowspan="2">    
      <form method="post" action="comprobarMoneda.php">
        <input type="hidden" name="frutas" value="<?php echo $numerosSerializados; ?>">
          
          <button type="submit" name="jugar">Jugar</button><br>
        </form>
    </td>
  </tr>
  <tr>
    <td><p><?= $premio ?>
          <?php if ($premio == 0) {?>
            <img src="img/face-plain.svg" alt="regular" height="10">
          <?php } else { ?>        
              <?php if ($premio != 0) {?>
                <img src="img/face-smile.svg" alt="bien" height="10">
              <?php } else {?>
                <img src="img/face-sad.svg" alt="mal" height="10">
              <?php }?>
           <?php } ?>
        </p>
        
    <td> 
        <form method="post" action="comprobarMoneda.php">
            <button type="submit" name="moneda" value="<?= $moneda ?>">Meter moneda</button><br>
            <!-- our form hidden input -->
            <input type="hidden" name="frutas" value="<?php echo $numerosSerializados; ?>">
            <input type="hidden" name="apuesta" value="<?php echo $apuesta; ?>">
            <p><?= $moneda ?></p>
        </form>   
    </td>
    <td>
        <form method="post" action="apuesta.php">
            <button type="submit" name="apuesta" value="<?= $apuesta ?>">apuesta</button><br>
            <p><?= $apuesta ?></p>
        </form>
    </td>
    
  
  </tr>
</table>

  <footer>
    <!-- <p>Escriba su nombre</p> -->
  </footer>
</body>
</html>
