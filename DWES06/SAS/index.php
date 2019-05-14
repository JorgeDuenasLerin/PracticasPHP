<?php 
include_once('conexMetodosBBDD.php');

DEFINE('webpage', 'index.php');
$usuario  = "";


echo "<pre>";
print_r($_POST);
echo "</pre>";

echo "<pre>";
print_r($_GET);
echo "</pre>";

if(isset($_SESSION)){
  echo "<pre>";
  print_r($_SESSION);
  echo "</pre>";
}

if(isset($_POST['login'])){
  
  if(!empty($_POST['usu'])){
    $usuario = $_POST['usu'];
    if(!empty($_POST['pass']) && $_POST['pass'] != ""){
      
      $instancia = new conexMetodosBBDD();
      $nombre = $_POST['usu'];
      $pass = $_POST['pass'];
      // $pass = password_hash($pass, PASSWORD_DEFAULT);
      $existeUsuario = $instancia->consultarUsuario($nombre, $pass);

      if($existeUsuario){
        //echo "<h1>usuario logeado</h1>";
        session_start();
        $_SESSION['logged'] = true;
      } else {
        // echo "<h1>usuario o pass incoorrecta</h1>";
      }
      
    }
  }

}

if(isset($_GET['denegado'])){
  $_POST['denegado'] = $_GET['denegado'];
  header('location: index.php');
}

if(isset($_POST['denegado'])){
  echo "<h1>ACCESO DENEGADO</h1>";
  echo "<h1>".$_POST['denegado']."</h1>";
}


if(isset($_GET['logout'])){
  $_POST['logout'] = $_GET['logout'];
  header("Location: ". webpage);
  // LAS CONSTANTES VAN SIN EL $ DELANTE
  die();
}

if(isset($_POST['logout'])){
  // echo "<h1>ACCESO POST logout</h1>";
  //unset($_SESSION['log']);
  $_SESSION['logged']=false;
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
  <?php if($_SESSION['logged'] == true){ ?>
    <a href="<?=$webpage?>?logout" style="float:right">Log out</a>
  <?php } else { ?>
    <a href="login.php" style="float:right">Sign in</a>
  <?php } ?>
</div>

<div class="row">
  <div class="leftcolumn">
  <?php if($_SESSION['logged'] == true){?>
    <div class="card">
      <h2>Bienvenido <?= $usuario?></h2>
      <h5>Title description, Dec 7, 2017</h5>
      <img class="todo-espacio" src="https://picsum.photos/1200/1200"/>
    </div>
  <?php } else { ?>
    <div class="card">
      <h2>Bienvenido</h2>
      <h5>Title description, Dec 7, 2017</h5>
      <p>Debes iniciar sesión para ver el contenido</p>
      <img class="todo-espacio" src="https://picsum.photos/1200/200" />
    </div>
  <?php } ?>
  </div>
  <div class="rightcolumn">
    <div class="card">
    <?php if($_SESSION['logged'] == true){
    ?>
      <h2><?=  $usuario ?></h2>
      <p>
        <img src="https://upload.wikimedia.org/wikipedia/commons/d/d3/User_Circle.png" alt="" width="70%">
        <a href="<?=$webpage?>?logout="><img src="https://cdn1.iconfinder.com/data/icons/interface-elements-ii-1/512/Logout-512.png" alt="" width="70%"></a>
        
      </p>
    <?php 
    } else {
    ?>
      <h2>Login</h2>
      <p>
        <form class="form-login" method="post">
          <input type="text" name="usu" value="Usuario1" placeholder="usuario"></br>
          <input type="password" name="pass" value="1234"  placeholder="contraseña"></br>
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
