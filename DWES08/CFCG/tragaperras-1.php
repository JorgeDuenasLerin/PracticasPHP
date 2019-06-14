<?php
/**
 * Minijuegos: Tragaperras (1) - tragaperras-1.php
 *
 * @author    Escriba su nombre
 *
 */
  $suma = "0";
  $fruta1 = rand(1,8);
  $fruta2 = rand(1,8);
  $fruta3 = rand(1,8);

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>
    Tragaperras (1).
    Minijuegos.
    Escriba su nombre
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Tragaperras (1)</h1>

<?php

print "  <p class=\"aviso\">Ejercicio incompleto</p>\n";

?>
  <main class="contenedor">
    <div class="imagenes">
      <img src="img/frutas/<?=$fruta1?>.svg" alt="">
      <img src="img/frutas/<?=$fruta2?>.svg" alt="">
      <img src="img/frutas/<?=$fruta3?>.svg" alt="">
    </div>
  </main>
  </main>
  <footer>
    <p>Escriba su nombre</p>
  </footer>
</body>
</html>
