<?php 
    session_start();

    if(isset($_GET['menos'])){
      $id = $_GET['menos'];

      $_SESSION['carrito'][$id]['cantidad']--;

      if($_SESSION['carrito'][$id]['cantidad']===0){
        unset($_SESSION['carrito'][$id]);
      }
      header('location:confirmarCompra.php');
    }

    if(isset($_GET['sumar'])){
      $id = $_GET['sumar'];

      $_SESSION['carrito'][$id]['cantidad']++;
      header('location:confirmarCompra.php');
    }

    if(isset($_GET['eliminar'])){
      $id = $_GET['eliminar'];

      unset($_SESSION['carrito'][$id]);

      header('location:confirmarCompra.php');
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
      <form class="anade-producto">
        <input class="cantidad" type="number" name="cantidad" value="1">
        <input type="submit" name="añadir" value="Añadir">
      </form>
    </div> -->
    <!---
    <div class="card">
      <h2>TITLE HEADING</h2>
      <h5>Title description, Dec 7, 2017</h5>
      <div class="fakeimg" style="height:200px;">Image</div>
      <p>Some text..</p>
      <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
    </div>
    <div class="card">
      <h2>TITLE HEADING</h2>
      <h5>Title description, Sep 2, 2017</h5>
      <div class="fakeimg" style="height:200px;">Image</div>
      <p>Some text..</p>
      <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
    </div>
    --->
  </div>
  <div class="rightcolumn">
    <div class="card">
      <h2>Tu compra</h2>
    <?php foreach ($_SESSION as $producto) {
            foreach ($producto as $clave => $valor) { 

              $precioProducto = $valor['precio'] * $valor['cantidad'];
            ?>
          
              <p><?=$valor['nombre']?>: <?=$valor['precio']?> x <?=$valor['cantidad']?>
              <span class='precio-carrito'><?=$precioProducto?>€
              <a href="confirmarCompra.php?menos=<?=$clave?>" class="menos">&#8722;</a>
              <a href="confirmarCompra.php?sumar=<?=$clave?>" class="sumar" alt="eliminar">+</a>
              <a href="confirmarCompra.php?eliminar=<?=$clave?>" class="x" alt="eliminar">X</a>
              </span></p>
    <?php   
          $precioTotal += $precioProducto;
            }
          } 
          ?>
      
      <p class="separador">&nbsp;</p>
      <p>Total<span class="precio-carrito2"><?=$precioTotal?>€</span></p>
      <p>&nbsp;</p>
      <a class="button button-100" href="">Confirmar compra</a>
    </div>
    <!---
    <div class="card">
      <h2>About Me</h2>
      <div class="fakeimg" style="height:100px;">Image</div>
      <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
    </div>
    <div class="card">
      <h3>Popular Post</h3>
      <div class="fakeimg"><p>Image</p></div>
      <div class="fakeimg"><p>Image</p></div>
      <div class="fakeimg"><p>Image</p></div>
    </div>
    --->
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
