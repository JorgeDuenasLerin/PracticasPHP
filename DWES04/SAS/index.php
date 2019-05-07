<?php
$mensaje = "";
session_start();

if(isset($_POST['establecer'])){
  if( isset($_POST['idioma']) && isset($_POST['perfil']) && isset($_POST['zona']) ){
    //if(!empty($_POST['idioma']) && !empty($_POST['perfil']) && !empty($_POST['zona'])){
      $_SESSION["idioma"] = $_POST['idioma'];
      $_SESSION["perfil"] = $_POST['perfil'];
      $_SESSION["zona"] = $_POST['zona'];
      $mensaje = "Informacion guardada en la sesión";
    //}
  }
}

echo "<pre>";
print_r($_POST);
echo "</pre>";

echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="DWES04_TAR_R05_tarea.css">
  </head>
  <body>
    <fieldset>
      <legend>Preferencias</legend>
      <span><?= $mensaje ?></span>
      <form action="" method="post">

        <b>Idioma:</b>
        <select name="idioma">      
          
          <option value="español" <?php  if($_POST['idioma'] == 'español') echo "selected"; ?>>español</option>
          <option value="ingles" <?php  if($_POST['idioma'] == 'ingles') echo "selected"; ?>>inglés</option>
        </select><br><br>

        <b>Perfil público:</b>
        <select name="perfil">      
          <option value="no" <?php if($_SESSION['perfil'] == 'no') echo "selected"; ?>>no</option>
          <option value="si" <?php if($_SESSION['perfil'] == 'si') echo "selected"; ?>>si</option>
        </select><br><br>

        <b>Zona horaria:</b>
        <select name="zona">      
          <option value="GMT-2" <?php if($_SESSION['zona'] == 'GMT-2') echo "selected"; ?>>GMT-2</option>
          <option value="GMT-1" <?php if($_SESSION['zona'] == 'GMT-1') echo "selected"; ?>>GMT-1</option>
          <option value="GMT"   <?php if($_SESSION['zona'] == 'GMT') echo "selected"; ?>>GMT</option>
          <option value="GMT+1" <?php if($_SESSION['zona'] == 'GMT+1') echo "selected"; ?>>GMT+1</option>
          <option value="GMT+2" <?php if($_SESSION['zona'] == 'GMT+2') echo "selected"; ?> >GMT+2</option>
        </select><br><br>

        <input type="submit" name="establecer" value="Establecer preferencias"><br>
        <a href="mostrar.php">Mostrar preferencias</a>

      </form>
      
    </fieldset>
  </body>
</html>
