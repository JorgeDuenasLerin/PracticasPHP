<?php 
//if(isset($_SESSION['carrito'])){
    echo "<pre>";
    echo "<B>SESSION</B><BR>";
    print_r($_SESSION);
    echo "</pre>";
  //}

if(!isset($_SESSION['carrito'])|| empty($_SESSION['carrito'])){ // 
   // header('location: index.php');
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
  <a href="#">Compra</a>
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
      <p>Tomates x4<span class="precio-carrito">5€</span></p>
      <p>Tomates x4<span class="precio-carrito">5€</span></p>
      <p>Tomates x4<span class="precio-carrito">5€</span></p>
      <p>Tomates x4<span class="precio-carrito">5€</span></p>
      <p>Tomates x4<span class="precio-carrito">5€</span></p>
      <p class="separador">&nbsp;</p>
      <p>Total<span class="precio-carrito">5€</span></p>
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
    
  </div>
  
</div> 
<div class="footer">
    <h2>Footer</h2>
</div>  
</body>
</html>