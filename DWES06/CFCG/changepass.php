<?php
  require_once('src/DataBaseConnection.php');
  
  $conexion = new DataBaseConnection();
  $listaErrores = [];
  $pruebaToken = "";

  
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
	 
    if(isset($_POST['submit'])){
      if(!empty($_POST['token'])){
        $tokenCorreo = $conexion->cleanInput($_POST['token']);
      }

      if(!empty($_POST['id'])){
        $idCorreo = $conexion->cleanInput($_POST['id']);

        $tokenDbArray = $conexion->obtenerToken($idCorreo);
        $tokenBaseDatos = $tokenDbArray[0][token];
       }
     
    }//isset($_GET['submit']))-> que viene del email.
    

    if(isset($_POST['enviar'])){
      if(!empty($_POST['idPag'])){
        $idPag = $conexion->cleanInput($_POST['idPag']);
      }

      if(!empty($_POST['tokenCorreoRe'])){
        $tokenCorreoRe = $conexion->cleanInput($_POST['tokenCorreoRe']);
      }

      if(!empty($_POST['tokenBaseDatosRe'])){
        $tokenBaseDatosRe = $conexion->cleanInput($_POST['tokenBaseDatosRe']); 
      }

      if(!empty($_POST['pass'])){
        $pass = $conexion->cleanInput($_POST['pass']);
      }else{
        $listaErrores['vacio'] = "*No puede estar vacio un campo";
      }

      if(!empty($_POST['pass2'])){
        $pass2 = $conexion->cleanInput($_POST['pass2']);
      }else{
        $listaErrores['vacio'] = "*No puede estar vacio un campo";
      }

      if($pass === $pass2 && !empty($pass) && !empty($pass2)){
        if($tokenCorreoRe === $tokenBaseDatosRe){
          $actualizar = $conexion->actualizarPass($idPag, $pass2);

          if($actualizar === 1){
            $mensaje = "Su password se ha cambiado satisfactorimente";
            //header("refresh:2; url=index.php");

          }elseif ($actualizar === 0) {
            $mensaje = "No se ha podido cambiar su password";
            //header("refresh:2; url=index.php");
          }
        }else{
           $listaErrores['mensajeToken'] = "*Hay un error de identificación de datos.";
        }

      }elseif($pass !== $pass2 && !empty($pass) && !empty($pass2)){
        $listaErrores['mensajePass'] = "*No coinciden las contraseñas.";
      }
    }//isset($_POST['enviar'])) -> viene de la misma página.

  }elseif($_SERVER['REQUEST_METHOD'] == 'GET'){
    header('Location:index.php');
  };

  echo "<b>1ºvez Token Correo: </b>";echo $tokenCorreo; echo "<br>";
  echo "<b>1ºvez Id Correo: </b>";echo $idCorreo; echo "<br>";
  echo "<b>1ºvez Token base de datos: </b>";echo $tokenBaseDatos; echo "<br><br>";

  echo "<b>2ºvez Id pagina: </b>";echo $idPag; echo "<br>";
  echo "<b>2ºvez Token Correo reenviado: </b>";echo $tokenCorreoRe; echo "<br>";
  echo "<b>2ºvez Token base de datos reenviado: </b>";echo $tokenBaseDatosRe; echo "<br>";

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
  <script>
    function mouseoverPass(obj) {
      var obj = document.getElementById('myPassword');
      obj.type = "text";
    }
    function mouseoutPass(obj) {
      var obj = document.getElementById('myPassword');
      obj.type = "password";
    }

    function mouseoverPass2(obj) {
      var obj = document.getElementById('myPassword2');
      obj.type = "text";
    }
    function mouseoutPass2(obj) {
      var obj = document.getElementById('myPassword2');
      obj.type = "password";
    }

  </script>

<div class="header">
  <h1>Mi sitio web email</h1>
  <p>Resize the browser window to see the effect.</p>
</div>

<div class="topnav">
  <p style="float:right"></p>
</div>

<div class="row">
  <div class="leftcolumn">
    <div class="card">
      <h2>Bienvenido</h2>
      <h3>Restablecer su contraseña: </h3>
      <?php if(isset($_POST['enviar'])) {?>
        <h3 class="confirmacion"><?=$mensaje?></h3>
      <?php } ?>
    <form action="changepass.php" method="post">
      <label>Contraseña nueva: </label><br>
      <input type="hidden" name="idPag" value="<?=$idCorreo?>">
      <input type="hidden" name="tokenCorreoRe" value="<?=$tokenCorreo?>">
      <input type="hidden" name="tokenBaseDatosRe" value="<?=$tokenBaseDatos?>"><br>
      <input type="password" name="pass" id="myPassword" placeholder="contraseña nueva">
      <img class="mostrar" src="css/images/icons.png" onmouseover="mouseoverPass();" onmouseout="mouseoutPass();" /><br>
      <label>Confirmar su contraseña: </label><br>
      <input type="password" name="pass2" id="myPassword2" placeholder="confirmar contraseña" />
      <img class="mostrar" src="css/images/icons.png" onmouseover="mouseoverPass2();" onmouseout="mouseoutPass2();" /><br>
      <?php if(count($listaErrores) > 0) { ?>
            <p>
              <?php foreach ($listaErrores as $value) { ?>
                <div style="color: red"><?=$value?></div>
              <?php } ?>             
            </p>
        <?php } else{ ?> <br><br> <?php } ?>
      <input type="submit" name="enviar" value="Enviar">
    </form>
    </div>
  </div>
  <div class="rightcolumn">
    <div class="card">
      
    </div>
  </div>
</div>

<div class="footer">
  <h2>Footer</h2>
</div>

</body>
</html>