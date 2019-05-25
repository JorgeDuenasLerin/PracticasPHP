<?php 
    session_start();

    $usuario = "";
    $pass = "";
    $forbiden="";
    $estaLogueado = false;
    $listaErrores =[];
    $infoList = ["info1"=>"Info1", "info2"=>"Info2", "info3"=>"Info3", "info4"=>"Info4", "info5"=>"Info5"];
    $dimension = 200;

    require_once('src/DataBaseConnection.php');

    $conexion = new DataBaseConnection();

    if(isset($_POST['submit'])){
      if(!empty($_POST['usuario'])){
        $usuario = $conexion->cleanInput($_POST['usuario']);
      }else{
         $listaErrores['nombre']= '*Introducir un nombre';
      
      }

      if(!empty($_POST['pass'])){
        $pass = $conexion->cleanInput($_POST['pass']);

        $passDB = $conexion->loguearse($usuario);

        $hashPass = $passDB[0]['pass'];//loguearse devuelve un array con un elemento([0])y ese elemento a la vez devuelve un array con un solo elemento que es pass(nombre de la columna de la base de datos a la cual hemos hecho la consulta.);

        if(password_verify($pass, $passDB[0]['pass'])){
          
          $estaLogueado = true;
          $dimension = 600;
          var_dump($estaLogueado); 
        }else{
          
          $listaErrores['acceso'] = "Verifique su usuario o contraseña!";
        }
      
      }else{
          $listaErrores['pass'] = '*Introducir una contraseña';
      }
    }//isset(submit)

    if(isset($_GET['error'])){
      $forbiden = "Tiene que loguearse para acceder a los enlaces.";
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Proyecto de frutería</title>
  <link rel="stylesheet" href="css/estilos.css">
  <link rel="stylesheet" href="css/especifico.css">
  <style>
    h3{
      color: red;
    }
  </style>
</head>
<body>

<div class="header">
  <h1>Mi sitio web</h1>
  <p>Resize the browser window to see the effect.</p>
</div>

<div class="topnav">
  <?php 
      if($estaLogueado) {
        foreach ($infoList as $key => $value) { ?>
          <a href="<?=$key?>.php"><?=$value?></a>
  
  <?php } 
      }else{
        foreach ($infoList as $value) { ?>
          <a href="index.php?error=error"><?=$value?></a>
  <?php }
      } ?>
  <a href="#" style="float:right">Link</a>
</div>

<div class="row">
  <div class="leftcolumn">
    <div class="card">
      <h2>Bienvenido</h2>
      <?php if(!empty($forbiden)) {?>
        <h3><?=$forbiden?></h3>
      <?php } ?>
      <h5>Title description, Dec 7, 2017</h5>
      <?php if($estaLogueado == false) {?>
        <p>Debes iniciar sesión para ver el contenido</p>
      <?php } ?>
      <img class="todo-espacio" src="https://picsum.photos/1200/<?=$dimension?>" />
    </div>
  </div>
  <div class="rightcolumn">
    <div class="card">
      <h2>Login</h2>
      <p>
        <form class="form-login" action="index.php" method="post">
          <input type="text" name="usuario" placeholder="usuario"></br>
          <input type="password" name="pass"  placeholder="contraseña"></br>
          <?php if(count($listaErrores) > 0) { ?>
            <p>
              <?php foreach ($listaErrores as $value) { ?>
                <div style="color: red"><?=$value?></div>
              <?php } ?>             
            </p>
          <?php } ?>
          <input type="submit" name="submit" value="Login">
        </form>
      </p>
    </div>
  </div>
</div>

<div class="footer">
  <h2>Footer</h2>
</div>

</body>
</html>
