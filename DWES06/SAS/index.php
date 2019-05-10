<?php 
include_once('conexMetodosBBDD.php');

$usuario = "";
$logeado=false;

if(isset($_POST['login'])){
  echo "<h1>entro </h1>";
  if(!empty($_POST['usu'])){
    $usuario = $_POST['usu'];
    if(!empty($_POST['pass']) && $_POST['pass'] != ""){
      echo "<h1>entro </h1>";
      $instancia = new conexMetodosBBDD();
      $passCifrada = password_hash($_POST['pass'], PASSWORD_DEFAULT);
      echo "<b>POST</b><br>";
      echo "$usuario -> $passCifrada <br>";
      echo "<b>BBDD</b><br>";
      $passbbdd = $passCifrada = password_hash('1234', PASSWORD_DEFAULT);
      echo "$usuario -> $passbbdd <br>";

      $usuarioRegistrado = $instancia->consultarUsuario($usuario,  $passCifrada);
      echo "<h1>$usuarioRegistrado</h1>";
      if(!empty($usuarioRegistrado)) $logeado=true;
    }
  }

}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Proyecto de fotos</title>
  <link rel="stylesheet" href="css/estilos.css">
  <link rel="stylesheet" href="css/especifico.css">
</head>
<body>

<div class="header">
  <h1>Mi sitio web</h1>
  <p>Resize the browser window to see the effect.</p>
</div>

<div class="topnav">
  <a href="info1.php">Info1</a>
  <a href="info2.php">Info2</a>
  <a href="info3.php">Info3</a>
  <a href="info4.php">Info4</a>
  <a href="info5.php">Info5</a>
  <a href="#" style="float:right">Link</a>
</div>

<div class="row">
  <div class="leftcolumn">
    <div class="card">
      <h2>Bienvenido</h2>
      <h5>Title description, Dec 7, 2017</h5>
      <p>Debes iniciar sesión para ver el contenido</p>
      <img class="todo-espacio" src="https://picsum.photos/1200/200" />
    </div>
  </div>
  <div class="rightcolumn">
    <div class="card">
    <?php 
    if($logeado){
    ?>
      <h2><?= $usuario ?></h2>
      <p>
        <img src="https://upload.wikimedia.org/wikipedia/commons/d/d3/User_Circle.png" alt="">
      </p>
    <?php 
    } else {
    ?>
      <h2>Login</h2>
      <p>
        <form class="form-login" method="post">
          <input type="text" name="usu" value="" placeholder="usuario"></br>
          <input type="password" name="pass" value=""  placeholder="contraseña"></br>
          <input type="submit" name="login" value="Login">
        </form>
      </p>
    <?php } ?>

    </div>
  </div>
</div>

<div class="footer">
  <h2>Footer</h2>
</div>

</body>
</html>
