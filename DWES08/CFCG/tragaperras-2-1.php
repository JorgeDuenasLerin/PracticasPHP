<?php
/**
 * Minijuegos: Tragaperras (1) - tragaperras-1.php
 *
 * @author    Escriba su nombre
 *
 */
  session_start();

  if(!isset($_SESSION['suma']) && !isset($_SESSION['fruta1']) &&
    !isset($_SESSION['fruta2'])  &&  !isset($_SESSION['fruta3'])){
    $_SESSION['fruta1'] = rand(1,8);
    $_SESSION['fruta2'] = rand(1,8);
    $_SESSION['fruta3'] = rand(1,8);
    $_SESSION['suma'] = 0;
    $_SESSION['face'] = "face-plain";
    $_SESSION['apostar'] = 0;
    $_SESSION['resultado'] = 0;

  }

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>
    Tragaperras (2).
    Minijuegos.
    Escriba su nombre
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/mclibre-php-ejercicios.css" title="Color" />
</head>
<style>
  
  main.contenedor{
    width: 730px
  }
</style>

<body>
  <h1>Tragaperras (2)</h1>

<?php

print "  <p class=\"aviso\">Ejercicio incompleto</p>\n";

?>
  <main class="contenedor">
    <div class="imagenes">
      <img src="img/frutas/<?=$_SESSION['fruta1']?>.svg" alt="">
      <img src="img/frutas/<?=$_SESSION['fruta2']?>.svg" alt="">
      <img src="img/frutas/<?=$_SESSION['fruta3']?>.svg" alt="">
    </div>
    <div class="formulario">
      <form action="tragaperras-2-2.php" >
        <input type="text" name="numero" value="<?=$_SESSION['apostar']?>">
        <input type="submit" name="apostar" value="aumentar apuesta">
        <input type="text" name="numero" value="<?=$_SESSION['suma']?>">
        <input type="submit" name="enviar" value="meter moneda">
        <input type="submit" name="jugar" value="jugar">
      </form> 
      <p class="resultado">
        <img src="img/<?=$_SESSION['face']?>.svg" alt="algo">
        <span><?=$_SESSION['resultado']?></span>
      <p>   
    </div>
  </main>
  <footer>
    <p>Escriba su nombre</p>
  </footer>
</body>
</html>
