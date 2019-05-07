<?php 
$idioma = "";
$perfil = "";
$zona = "";

session_start();
echo "<pre>";
print_r($_SESSION);
echo "</pre>";


//if($_SESSION != ''){
//if(isset($_SESSION)){
//if(session_status() == PHP_SESSION_ACTIVE){

if(session_id() == '' || !isset($_SESSION)){
  header( "refresh:3;url=/DWES04/SAS/");
} else {
  if( isset($_SESSION['idioma']) && isset($_SESSION['perfil']) && isset($_SESSION['zona']) ){
    if(!empty($_SESSION['idioma']) && !empty($_SESSION['perfil']) && !empty($_SESSION['zona'])){
      $idioma = $_SESSION["idioma"];
      $perfil = $_SESSION["perfil"];
      $zona = $_SESSION["zona"];
      $mensaje = "Informacion guardada en la sesión";
    }
  }
}



echo "<pre>";
print_r($_SESSION);
echo "</pre>";

if(isset($_POST['borrar'])){
  session_destroy();
  echo "<h2>borrando preferencias</h2>";
  header( "refresh:3;url=/DWES04/SAS/");
}
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
      
      <form action="" method="post">

        <b>Idioma:</b>
        <p><?= $idioma ?></p>

        <b>Perfil público:</b>
        <p><?= $perfil ?></p>

        <b>Zona horaria:</b>
        <p><?= $zona ?></p>

        <input type="submit" name="borrar" value="Borrar preferencias"><br>
        <a href="index.php">Establecer preferencias</a>

      </form>
      
    </fieldset>
  </body>
</html>