<?php
/**
 * Minijuegos: Tragaperras (2) - tragaperras-2-1.php
 *
 * @author    Escriba su nombre
 *
 */


if(isset($_POST['moneda'])){
  session_start();
  $moneda = $_POST['moneda'];
  $moneda++;
  $_SESSION['moneda'] = $moneda;
  header("Location: index.php");
}


?>

