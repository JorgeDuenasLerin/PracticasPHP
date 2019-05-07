<?php 

session_start();
//session_destroy();

if(isset($_POST['añadir'])){
  if( isset($_POST['Tomates'])){
    if(!empty($_POST['Tomates'])){
      if($_SESSION["Tomates"] != 0){
        $_SESSION["Tomates"] = $_POST['Tomates'];
      } else {
        //unset( $_SESSION["Tomates"] );  
        $_SESSION["Tomates"] = ""; 
      }
    }
  }

  if( isset($_POST['Naranjas'])){
    if(!empty($_POST['Naranjas'])){
      //if($_SESSION["Naranjas"] != 0){
        $_SESSION["Naranjas"] = $_POST['Naranjas'];
      //} else {
        //unset( $_SESSION["Naranjas"] );  
      //}
    }
  }

  if( isset($_POST['Tomates_pare'])){
    if(!empty($_POST['Tomates_pare'])){
      //if($_SESSION["Tomates_pare"] != 0){
        $_SESSION["Tomates_pare"] = $_POST['Tomates_pare'];
      //} else {
        //unset( $_SESSION["Tomates_pare"] );  
      //}
    }
  }

  if( isset($_POST['Pimientos verde'])){
    if(!empty($_POST['Pimientos verde'])){
      //if($_SESSION["Pimientos verde"] != 0){
        $_SESSION["Pimientos verde"] = $_POST['Pimientos verde'];
      //} else {
        //unset( $_SESSION["Pimientos verde"] );  
      //}
    }
  }
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
    include_once('conexMetodosBBDD.php');
    $instancia = new conexMetodosBBDD();
    $consulta = $instancia->mostrarProductos();
    foreach ($consulta as $key => $value) {
      ?>
      <div class="card">
      <h5><?= $value['nombre']?> <img class="eco" src="imgs/leaf.png"></h5>
      <p>Producto de primera calidad traido de ...<?= $value['descripcion']?></p>
      <p><?= $value['precio']?> €</p>
      <form class="anade-producto" method="post">
        <input class="cantidad" type="number" name="<?= $value['nombre']?>" value="1">
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
