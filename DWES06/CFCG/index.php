<?php 
    session_start();
   
    require_once('src/DataBaseConnection.php');

    $usuario = "";
    $pass = "";
    $forbiden="";
    $dimension = 200;
    $listaErrores =[];
    $agente = $_SERVER['HTTP_USER_AGENT'];

    $conexion = new DataBaseConnection();

    /******************************************************************/
    /*Tratamos el formulario y activamos la session si todo esta bien*/
    if(isset($_POST['submit'])){
      if(!empty($_POST['usuario'])){
        $usuario = $conexion->cleanInput($_POST['usuario']);
        $encontrado = $conexion->existeUsuario($usuario);

      }else{
         $listaErrores['nombre']= '*Introducir un nombre';
      
      }
    

      if(!empty($_POST['pass'])){
        $pass = $conexion->cleanInput($_POST['pass']);
        
        if($encontrado){
          $passDB = $conexion->obtenerPass($usuario);
        }

        $hashPass = $passDB[0]['pass'];//loguearse devuelve un array con un elemento([0])y ese elemento a la vez devuelve un array con un solo elemento que es pass(nombre de la columna de la base de datos a la cual hemos hecho la consulta.);

        if(password_verify($pass, $passDB[0]['pass'])){
          
          $_SESSION['logued'] =true;
          $dimension = 600;
  
        }else{
          
          $listaErrores['acceso'] = "Verifique su usuario o contraseña!";
        }
      
      }else{
          $listaErrores['pass'] = '*Introducir una contraseña';
      }
    }//isset(submit)


    /*************************************************************************/
    /*Si desean acceder al area protegida sin SESSION utilizamos el codigo siguiente*/ 
    if(isset($_GET['error'])){
      $forbiden = "Tiene que loguearse para acceder a los enlaces.";

      /*obtener ip*/
      $ipDireccion =  $conexion->getIP();

      /*obtener pais del ip*/
      $ipPais = $conexion->ipPais();

      /*obtener el navegador*/
      $navegador = $conexion->detectarNavegador($agente);

      /*obtener el SO*/
      $so = $conexion->detectarSO($agente);

      /*escribir fichero log*/
      $archivo = $conexion->escribirFichero($ipDireccion, $ipPais, $navegador, $so);

      /*leer fichero log*/
      $mensaje = $conexion->leerFichero();

    }//$_GET['error'];

    /**************************************************************************/
    /*Cerramos la session si llegamos a este punto*/
    if(isset($_GET['cerrar'])){

        session_destroy();
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
      <?php if(!empty($forbiden)) {?>
        <h3><?=$forbiden?></h3>
        <h3><?=$mensaje?></h3>
      <?php } ?>
      <h5>Title description, Dec 7, 2017</h5>
      <?php if(!isset($_SESSION['logued'])) {?>
        <p>Debes iniciar sesión para ver el contenido</p>
      <?php } else{ $dimension=600; } ?>
      <img class="todo-espacio" src="https://picsum.photos/1200/<?=$dimension?>" />
    </div>
  </div>
  <div class="rightcolumn">
    <?php if(!isset($_SESSION['logued'])) {?>
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
        <p>
          <a class="recuperar" href="passrecover.php">¿Has olvidado tu contraseña?</a>
        </p>
      </p>
    </div>
    <?php }else{ ?>
    <div class="card2">
      <h2>Cerrar Sesión</h2>
        <a href="index.php?cerrar=cerrar"><img src="css/images/iconfinder_session_45244.png" alt="img"></a>
    </div>
  <?php } ?>
  </div>
</div>

<div class="footer">
  <h2>Footer</h2>
</div>

</body>
</html>
