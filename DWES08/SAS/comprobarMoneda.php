<?php
/**
 * Minijuegos: Tragaperras (2) - tragaperras-2-1.php
 *
 * @author    Escriba su nombre
 *
 */

session_start();

// si me envian por post moneda incremento la variable session moneda si existe y si no la creo
// si me mandan por post jugar, decremento la variable session moneda. (comprobar que moneda sea mayor que 0)
// si me mandan por post serializado las frutas, deserializo y las guardo en sesion

if(isset($_POST['moneda'])){
  $moneda = $_POST['moneda'];
  $moneda++;
  $_SESSION['moneda'] = $moneda;
}

if(isset($_POST['jugar'])){
  if(isset($_SESSION['moneda'])){
    $moneda = $_SESSION['moneda'];
    $moneda--;
    $_SESSION['moneda'] = $moneda;
  }

  if(isset($_POST['frutas'])){
    $numeros =  unserialize($_POST['frutas']);
    $_SESSION['frutas'] = $numeros;
  }
}




echo "<pre>";
echo "<b>{_SESSION}</b>";
print_r($_SESSION);
echo "</pre>";

echo "<pre>";
echo "<b>{_POST}</b>";
print_r($_POST);
echo "</pre>";

die();

header("Location: index.php");
?>

