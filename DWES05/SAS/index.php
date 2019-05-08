<?php

include_once('conexMetodosBBDD.php');
$instancia = new conexMetodosBBDD();
$listado_productos = $instancia->mostrarProductos();


session_start();
//session_destroy();



if(isset($_POST['añadir'])){
  if(!isset($_SESSION['carrito'])){
    $_SESSION['carrito'] = [];
  }

  $_SESSION['carrito'][] = $_POST;
}

echo "<pre>";
print_r($_POST);
echo "</pre>";

echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Proyecto de frutería</title>
  <link rel="stylesheet" href="css/estilos.css">
  <link rel="stylesheet" href="css/especifico.css">
</head>
<body>

<div class="header">
  <h1>My Website</h1>
  <p>Resize the browser window to see the effect.</p>
</div>

<div class="topnav">
  <a href="#">Compra</a>
  <!---
  <a href="#">Link</a>
  <a href="#">Link</a>
  <a href="#" style="float:right">Link</a>
  --->
</div>

<div class="row">
  <div class="leftcolumn">
    <!-- <div class="card">

      <h5>Tomates (Verduras)<img class="eco" src="imgs/leaf.png"></h5>
      <p>Producto de primera calidad traido de ...</p>
      <p>1.95 €</p>
      <form class="anade-producto" method="post">
        <input class="cantidad" type="number" name="Tomates" value="1">
        <input type="submit" name="añadir" value="Añadir">
      </form>
    </div>

    <div class="card">

      <h5>Naranja (Frutas)<img class="eco" src="imgs/leaf.png"></h5>
      <p>Producto de primera calidad traido de ...</p>
      <p>2.35 €</p>
      <form class="anade-producto" method="post">
        <input class="cantidad" type="number" name="Naranjas" value="1">
        <input type="submit" name="añadir" value="Añadir">
      </form>
    </div> -->
    <?php

    foreach ($listado_productos as $producto) {
      echo "<pre>";
      print_r($producto);
      echo "</pre>";
      ?>

      <div class="card">
      <h5><?= $producto['nombre']?> <img class="eco" src="imgs/leaf.png"></h5>
      <p><?= $producto['descripcion']?></p>
      <p><?= $producto['precio']?> €</p>
      <form class="anade-producto" method="post">
        <input type="hidden" name="cod" value="<?= $producto['id']?>">
        <input type="hidden" name="nombre" value="<?= $producto['nombre']?>">
        <input type="hidden" name="precio" value="<?= $producto['precio']?>">
        <input class="cantidad" type="number" name="cantidad" value="1">
        <input type="submit" name="añadir" value="Añadir">
      </form>
</div>
      <?php
    }
    ?>

  </div>
  <div class="rightcolumn">
    <div class="card">
      <h2>Tu compra</h2>
      <?php
      $sumaTotal = "";
      // if(isset($_SESSION['Tomates'])){
      //   $cantidad = $_SESSION['Tomates'];

      //   $total = $cantidad*1.95;

      //   echo "<p>Tomates x$cantidad (1.95)";
      //   echo "<span class=\"precio-carrito\">$total</p>";

      //   $sumaTotal=$total;
      // }

      // if(isset($_SESSION['Naranjas'])){
      //   $cantidad = $_SESSION['Naranjas'];

      //   $total = $cantidad*2.35;

      //   echo "<p>Naranjas x$cantidad (2.35€)";
      //   echo "<span class=\"precio-carrito\">$total</p>";

      //   $sumaTotal=$sumaTotal+$total;
      // }

      if(isset($_SESSION['Tomates_pare'])){
          $cantidad = $_SESSION['Tomates_pare'];

          $total = $cantidad*1.95;

          echo "<p>Tomates pare x$cantidad (1.95)";
          echo "<span class=\"precio-carrito\">$total</p>";

          $sumaTotal=$total;
        }

        if(isset($_SESSION['Pimientos verde'])){
          $cantidad = $_SESSION['Pimientos verde'];

          $total = $cantidad*2.35;

          echo "<p>Pimientos verde x$cantidad (2.35€)";
          echo "<span class=\"precio-carrito\">$total</p>";

          $sumaTotal=$sumaTotal+$total;
        }
      ?>
      <!-- <p>Tomates x4<span class="precio-carrito">5€</span></p>
      <p>Tomates x4<span class="precio-carrito">5€</span></p>
      <p>Tomates x4<span class="precio-carrito">5€</span></p>
      <p>Tomates x4<span class="precio-carrito">5€</span></p>
      <p>Tomates x4<span class="precio-carrito">5€</span></p> -->
      <?php
      echo "<pre>";
      print_r($_SESSION);
      echo "</pre>";
      ?>
      <p class="separador">&nbsp;</p>
      <p>Total<span class="precio-carrito"><?=$sumaTotal?>
      <?php
      // $sumaTotal=0;
      // foreach ($_SESSION as $key => $value) {
      //   $sumaTotal = $sumaTotal + $value;
      // }
      // echo $sumaTotal;
      ?>
      </span></p>
      <p>&nbsp;</p>
      <a class="button button-100" href="">Confirmar compra</a>
    </div>

    <div class="card">
      <h3>Follow Me</h3>
      <p>Some text..</p>
    </div>
  </div>
</div>

<div class="footer">
  <h2>Footer</h2>
</div>

</body>
</html>
