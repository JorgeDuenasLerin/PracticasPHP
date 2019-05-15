<?php
include_once('conexMetodosBBDD.php');
$instancia = new conexMetodosBBDD();
$listado_productos = $instancia->mostrarProductos();

// echo "<pre>";
// echo "<B>POST</B><BR>";
// print_r($_POST);
// echo "</pre>";

// echo "<pre>";
// echo "<B>GET</B><BR>";
// print_r($_GET);
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

// borrar un producto de la lista de la compra
if(isset($_GET['borrar'])){
  //echo "<H3>index.php - entro en GET BORRAR</H3>";
  unset($_SESSION['carrito'][$_GET['borrar']]); 
  header("location: index.php");
  die();
}

// restar un producto de la lista de la compra
if(isset($_GET["restar"])){
  //echo "<H3>index.php - entro en GET RESTAR</H3>";
  $id = $_GET["restar"];
  // en $decremento guardo el valor actual del producto que me quieren restar
  $decremento = $_SESSION["carrito"][$id][2];
  // hago la resta
  $decremento = $decremento-1;
  // le guardo el nuevo valor
  $_SESSION["carrito"][$id][2] = $decremento;
  // cuando llegue a 0 se va a borrar esa fruta del array
  if($_SESSION["carrito"][$id][2] == 0){
    unset($_SESSION["carrito"][$id]);
  }
  header("location: index.php");
  // el die es para que no siga y entre en mas condiciones porque tenia un header con un refresh despues de 2 segundos
  die();
}

if(isset($_GET['sumar'])){
  $id = $_GET['sumar'];
  $valor = $_SESSION['carrito'][$id][2];
  $valor++;
  $_SESSION['carrito'][$id][2] = $valor;
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>frutería</title>
  <link rel="stylesheet" href="css/estilos.css">
  <link rel="stylesheet" href="css/especifico.css">
</head>
<body>

<div class="header">
  <h1>Mi Frutería</h1>
  <p>Resize the browser window to see the effect.</p>
</div>

<div class="topnav">
  <a href="#"><!-- Compra --></a>
  <!--- <a href="#" style="float:right">Link</a> --->
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
    -->
    <?php
    foreach ($listado_productos as $producto) {
      // echo "<pre>";
      // print_r($producto);
      // echo "</pre>";
      ?>
      <div class="card">

      <?php if($producto['ecologico'] == 1){ ?>
         <h5><?= $producto['nombre']?> <img class="eco" src="imgs/leaf.png"></h5>
      <?php } else { ?>
         <h5><?= $producto['nombre']?></h5>
      <?php } ?>

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
            <a href="index.php?borrar=<?=$clave?>"><img class="eco" style="float:left;" src="https://cdn0.iconfinder.com/data/icons/round-ui-icons/512/close_red.png" alt="eliminar producto"></a>
            <a href="index.php?restar=<?=$clave?>"><img class="eco" style="float:left;" src="https://img.pngio.com/dash-minus-negative-remove-removed-subtract-subtraction-icon-subtraction-png-512_512.png" alt="restar cantidad"></a>
            <a href="index.php?sumar=<?=$clave?>"><img class="eco" style="float:left;" src="https://cdn1.iconfinder.com/data/icons/interface-elements/32/add-circle-512.png" alt="sumar cantidad"></a>
             <p><?=$valor[0]?> x<?=$valor[2]?><span class="precio-carrito"><?=$valor[1]*$valor[2]?> €</span></p>
            <?php
            $sumaTotal += $valor[1]*$valor[2];
          }
        }
      }
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
      <a class="button button-100" href="confirmarCompra.php">Confirmar compra</a>
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
