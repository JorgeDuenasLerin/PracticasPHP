<?php 
session_start();
//if(isset($_SESSION['carrito'])){
    echo "<pre>";
    echo "<B>SESSION</B><BR>";
    print_r($_SESSION);
    echo "</pre>";
  //}

if(!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])){ // 
    echo "<H3>confirmarCompra.php entro en GET BORRAR</H3>";
    header('location: index.php');
}

// borrar un producto de la lista de la compra
if(isset($_GET['borrar'])){
  echo "<H3>confirmarCompra.php entro en GET BORRAR</H3>";
  $_POST['borrar']=$_GET['borrar'];
  header( "refresh:1;url=confirmarCompra.php");
}
// si esta borrar en post borro el producto
if(isset($_POST['borrar'])){
  echo "<H3>confirmarCompra.php entro en POST BORRA</H3>";
  unset($_SESSION['carrito'][$_POST['borrar']]); 
  //$_SESSION['carrito'][$_POST['borrar']] = array();
}

// restar un producto de la lista de la compra
if(isset($_GET['restar'])){
  echo "<H3>confirmarCompra.php entro en GET RESTAR</H3>";
  $_POST['restar']=$_GET['restar'];
  header( "refresh:1;url=confirmarCompra.php");
}
// si esta restar en post borro el producto
if(isset($_POST['restar']) && isset($_SESSION["carrito"])){
  echo "<H3>confirmarCompra.php entro en POST RESTAR</H3>";
  $decremento = $_SESSION["carrito"][$_POST["restar"]][2];
  $decremento = $decremento-1;
  $_SESSION["carrito"][$_POST["restar"]][2] = $decremento;
  if($_SESSION["carrito"][$_POST["restar"]][2] == 0){
    if($_POST["restar"] == 0){
      array_shift($_SESSION["carrito"]);
    } else {
      array_splice($_SESSION["carrito"], $_POST['restar'], 1);
    }
  }
  //unset($_SESSION['carrito'][$_POST['restar']]);
  header( "refresh:1;url=confirmarCompra.php");
}

if(isset($_GET['procesar'])){
  echo "<H3>confirmarCompra.php entro en GET PROCESAR</H3>";
  header("refresh:3;url=index.php");
  session_destroy();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/especifico.css">
</head>
<body>
<div class="header">
  <h1>My Website</h1>
  <p>Resize the browser window to see the effect.</p>
</div>

<div class="topnav">
  <a href="index.php">Compra</a>
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
             <p><?=$valor[0]?> x<?=$valor[2]?><span class="precio-carrito"><?=$valor[1]*$valor[2]?> €</span></p>
            <?php
            $sumaTotal += $valor[1]*$valor[2];
        }
      }
      ?>
    
      <p class="separador">&nbsp;</p>
      <p>Total<span class="precio-carrito">5€</span></p>
      <p>&nbsp;</p>
      <a class="button button-100" href="confirmarCompra?procesar=true.php">Confirmar compra</a>
    </div> 
  </div>
  
</div> 
<?php if(isset($_GET['procesar'])) { ?>
<div class="" style="margin:0 10%;">
    <div class="card">
      <p><img src="http://www.cardgamedb.com/deckbuilders/images/card-loading-high-new.gif" alt="gif carga"> Procesando pedido...</p>

    </div>
</div>
<?php } ?>
<div class="footer">
    <h2>Footer</h2>
</div>  
</body>
</html>