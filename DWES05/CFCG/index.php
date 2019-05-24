<?php 
    session_start();

    

    require_once('src/DataBaseConnection.php');

    $conexion = new DataBaseConnection();

    $arrayProducto = $conexion->mostrarProducto(); 

    if(!isset($_SESSION["carrito"])){
        $_SESSION["carrito"] = [];
    }

    if(isset($_POST['añadir'])){
      if(isset($_POST['id'])){
        $id = $conexion->cleanInput($_POST['id']);

          if(array_key_exists($id, $_SESSION['carrito'])){

            $_SESSION["carrito"][$id]['cantidad'] += $_POST['cantidad'];

          }else{
            $nuevoElemento = [];
            $nuevoElemento['nombre'] = $conexion->cleanInput($_POST['nombre']);
            $nuevoElemento['precio'] = $conexion->cleanInput($_POST['precio']);
            $nuevoElemento['cantidad'] = $conexion->cleanInput($_POST['cantidad']);

            $_SESSION["carrito"][$id] = $nuevoElemento;
          }
        }
      }//if(isset($_POST['añadir']))

     
     /*
        Disminuir los elementos del carrito de la compra
     */
      if(isset($_GET['menos'])){
        $id = $conexion->cleanInput($_GET['menos']);
        
        $_SESSION['carrito'][$id]['cantidad']--;

        if($_SESSION['carrito'][$id]['cantidad']=== 0){
          unset($_SESSION['carrito'][$id]);
        }

        header("location:index.php");
      }

      /*
       Eliminar el producto del carrito de la compra
      */
      if(isset($_GET['eliminar'])){
        $idElimin = $conexion->cleanInput($_GET['eliminar']);
        unset($_SESSION["carrito"][$idElimin]);

        header("location:index.php");
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
    <?php foreach ($arrayProducto as $value) { 
      $tipo = $value['tipo'];
      $resul = $conexion->mostrarTipo($tipo);
      $nombreTipo = $resul[0]['nombre'];
      ?>

    <div class="card">
      <h5><?=$value['nombre']?>(<?=$nombreTipo?>)<img class="eco" src="imgs/leaf.png"></h5>
      <p><?=$value['descripcion']?></p>
      <p><?=$value['precio']?> €</p>
      <form class="anade-producto" method="post">
        <input type="hidden" name="id" value="<?=$value['id'] ?>">
        <input type="hidden" name="nombre" value="<?=$value['nombre']?>">
        <input type="hidden" name="precio" value="<?=$value['precio'] ?>">
        <input class="cantidad" type="number" name="cantidad" value="1">
        <input type="submit" name="añadir" value="Añadir">
      </form>
    </div>
    <?php  }?>

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
      <?php if(isset($_SESSION)) { 
              foreach ($_SESSION as $producto) {
                foreach ($producto as $key => $value) { ?>

                 <p><?=$value['nombre']?> x <?=$value['cantidad']?><span class="precio-carrito"><?=$value['precio'] * $value['cantidad']?>€ <a href="index.php?menos=<?=$key?>" class="menos">&#8722;</a><a href="index.php?eliminar=<?=$key?>" class="x" alt="eliminar">X</a></span></p>

      <?php     $costo = $value['precio']* $value['cantidad'];
                $costoTotal += $costo;
                }
              }
            } ?>
      <p class="separador">&nbsp;</p>
      <p>Total<span class="precio-carrito2"><?=$costoTotal?> €</span></p>
      <p>&nbsp;</p>
      <a class="button button-100" href="confirmarCompra.php">Confirmar compra</a>
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
