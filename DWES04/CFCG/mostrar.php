<?php

	session_start();
	$idioma = $_SESSION['idioma'];
	$perfil = $_SESSION['perfil'];
	$hora = $_SESSION['hora'];

	if($_SERVER['REQUEST_METHOD'] === 'GET'){
		if(isset($_GET['borrar'])){

			session_destroy();
			header("refresh:0.000001;url=mostrar.php");
		}
	}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/DWES04_TAR_R05_tarea.css">
  </head>
  <body>
  	<fieldset>
  		<legend>Mostrar</legend>

  		<div>
  			<?php if(empty($_SESSION)){
				echo "<p>Informacion de la sesion eliminada.</p>";
			} ?>
  			<label class="etiqueta">Idioma:</label><br>
  			<span><?=$idioma?></span><br>
  		</div><br>
  		<div>
  			<label class="etiqueta">Perfil público:</label><br>
  			<span><?=$perfil?></span><br>
  		</div><br>
  		<div>
  			<label class="etiqueta">Zona horaria:</label><br>
  			<span><?=$hora?></span><br>
  		</div><br>
  		<form action="mostrar.php">
			<input type="submit" name="borrar" value="Borrar preferencias"><br>
		</form>

	<a href="preferencias.php">Establecer preferencias</a>
	</fieldset>
</body>
</html>
