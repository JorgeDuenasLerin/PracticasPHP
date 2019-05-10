<?php
include_once('conexMetodosBBDD.php');
$instancia = new conexMetodosBBDD();
$listado_productos = $instancia->mostrarProductos();

// echo "<pre>";
// echo "<B>POST</B><BR>";
// print_r($_POST);
// echo "</pre>";



session_start();
//session_destroy();

if(isset($_POST['añadir'])){
  if(!isset($_SESSION['carrito'])){
    $_SESSION['carrito'] = [];
  }
  //$_SESSION['carrito'][] = $_POST;

  $cod = $_POST['cod'];
  
  if(array_key_exists($cod, $_SESSION["carrito"])){
    $_SESSION["carrito"][$cod][2] += $_POST["cantidad"];
  } else {
    $nuevo_dato = [];
    $nuevo_dato[0]=$_POST["nombre"];
    $nuevo_dato[1]=$_POST["precio"];
    $nuevo_dato[2]=$_POST["cantidad"];

    $_SESSION["carrito"][$cod] = $nuevo_dato;
  }
  
  // if(isset($_SESSION)){
  //   echo "<pre>";
  //   echo "<B>SESSION</B><BR>";
  //   print_r($_SESSION);
  //   echo "</pre>";
  // }

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
      $sumaTotal=0;
      if(isset($_SESSION)){
        foreach ($_SESSION as $fila) {
          foreach ($fila as $clave => $valor) {
            //print_r($valor);
            ?>
             <p><?=$valor[0]?> x<?=$valor[2]?><span class="precio-carrito"><?=$valor[1]*$valor[2]?> €</span></p>
            <?php
            $sumaTotal += $valor[1]*$valor[2];
          }
        }
      }


      // $precio = 0;
      // $cantidad = 0;
      // foreach ($_SESSION['carrito'] as $fila) {
      //   foreach ($fila as $clave => $valor) {
      //     //echo "$clave -> $valor <br>";
      //     if($clave == 1) $precio = $valor;
      //     if($clave == 2) {
      //       $cantidad = $valor;
      //       //echo "precio: $precio";
      //       //echo "cantidad: $cantidad";
      //     }

      //   }
      // }
      ?>
      <!-- <p>Tomates x4<span class="precio-carrito">5€</span></p>
      <p>Tomates x4<span class="precio-carrito">5€</span></p>
      <p>Tomates x4<span class="precio-carrito">5€</span></p>
      <p>Tomates x4<span class="precio-carrito">5€</span></p>
      <p>Tomates x4<span class="precio-carrito">5€</span></p> -->

      <p class="separador">&nbsp;</p>
      <p>Total<span class="precio-carrito"><?=$sumaTotal?> €
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
