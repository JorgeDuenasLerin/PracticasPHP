<?php 
session_start();
//if(isset($_SESSION['carrito'])){
    // echo "<pre>";
    // echo "<B>SESSION</B><BR>";
    // print_r($_SESSION);
    // echo "</pre>";
  //}

if(!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])){ // 
    echo "<H3>confirmarCompra.php entro en GET BORRAR</H3>";
    header('location: index.php');
}

// borrar un producto de la lista de la compra
if(isset($_GET['borrar'])){
  //echo "<H3>confirmarCompra.php - entro en GET BORRAR</H3>";
  unset($_SESSION['carrito'][$_GET['borrar']]); 
  header("location: confirmarCompra.php");
  die();
}

// restar un producto de la lista de la compra
if(isset($_GET["restar"])){
  //echo "<H3>confirmarCompra.php - entro en GET RESTAR</H3>";
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
  header("location: confirmarCompra.php");
  // el die es para que no siga y entre en mas condiciones porque tenia un header con un refresh despues de 2 segundos
  die();
}

if(isset($_GET['sumar'])){
  $id = $_GET['sumar'];
  $valor = $_SESSION['carrito'][$id][2];
  $valor++;
  $_SESSION['carrito'][$id][2] = $valor;
}

if(isset($_GET['procesar'])){
  //echo "<H3>confirmarCompra.php entro en GET PROCESAR</H3>";
  header("refresh:4;url=index.php");
  session_destroy();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
  <a href="index.php">Volver a la compra</a>
  <!---
  <a href="#">Link</a>
  <a href="#">Link</a>
  <a href="#" style="float:right">Link</a>
  --->
</div>
<div class="row">
  <div class="" style="margin:0 10%;">
    <div class="card">
      <h2>Tu compra</h2>
      <?php 
      $sumaTotal = 0;
      foreach ($_SESSION as $fila) {
        foreach ($fila as $clave => $valor) {
          ?>
            <a href="confirmarCompra.php?borrar=<?=$clave?>"><img class="eco" style="float:left;" src="https://cdn0.iconfinder.com/data/icons/round-ui-icons/512/close_red.png" alt="eliminar producto"></a>
            <a href="confirmarCompra.php?restar=<?=$clave?>"><img class="eco" style="float:left;" src="https://img.pngio.com/dash-minus-negative-remove-removed-subtract-subtraction-icon-subtraction-png-512_512.png" alt="restar cantidad"></a>
            <a href="confirmarCompra.php?sumar=<?=$clave?>"><img class="eco" style="float:left;" src="https://cdn1.iconfinder.com/data/icons/interface-elements/32/add-circle-512.png" alt="sumar cantidad"></a>
             <p><?=$valor[0]?> x<?=$valor[2]?><span class="precio-carrito"><?=$valor[1]*$valor[2]?> €</span></p>
            <?php
            $sumaTotal += $valor[1]*$valor[2];
        }
      }
      ?>
    
      <p class="separador">&nbsp;</p>
      <p>Total<span class="precio-carrito">5€</span></p>
      <p>&nbsp;</p>
      <a class="button button-100" href="confirmarCompra.php?procesar=true">Confirmar compra</a>
    </div> 
  </div>
  
</div> 
<?php if(isset($_GET['procesar'])) { ?>
<div class="" style="margin:0 10%;">
    <div class="card">
      <p><img src="https://loading.io/spinners/dual-ring/lg.dual-ring-loader.gif" style="float:left;position:relative;top:-30px;left:-10px;" alt="gif carga" width="10%"> Procesando pedido...</p>

    </div>
</div>
<?php } ?>
<div class="footer">
    <h2>Footer</h2>
</div>  
</body>
</html>