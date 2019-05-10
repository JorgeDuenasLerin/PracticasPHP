<?php
include_once('conexMetodosBBDD.php');
$instancia = new conexMetodosBBDD();
$listado_productos = $instancia->mostrarProductos();

echo "<pre>";
print_r($_POST);
echo "</pre>";

if(isset($_SESSION)){
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
}

session_start();
//session_destroy();
$array = [];
if(isset($_POST['añadir'])){
  if(!isset($_SESSION['carrito'])){
   // $_SESSION['carrito'] = [];
  }
  $_SESSION['carrito'][] = $_POST;

  
  $cod = $_POST['cod'];
  if(!array_key_exists($cod, $array)){
    $array[$cod] = $_POST;
  }
  
  echo "<pre>";
  print_r($array);
  echo "</pre>";
  
  //header('location: index.php');
}

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
      // echo "<pre>";
      // print_r($producto);
      // echo "</pre>";
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
      $sumaTotal="";
      $array = [];
      // foreach ($_SESSION as $value1) {
      //   $fila = $value1;
      //   foreach ($fila as $valor) {
      //     foreach ($valor as $key => $value) {
      //       echo "$key -> $value";
      //       echo "<br>";
      //     }
      //   }
      // }
      ?>
      <!-- <p>Tomates x4<span class="precio-carrito">5€</span></p>
      <p>Tomates x4<span class="precio-carrito">5€</span></p>
      <p>Tomates x4<span class="precio-carrito">5€</span></p>
      <p>Tomates x4<span class="precio-carrito">5€</span></p>
      <p>Tomates x4<span class="precio-carrito">5€</span></p> -->
      <?php
      foreach ($array as  $value) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
      }
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
