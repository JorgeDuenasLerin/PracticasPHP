<?php 
	require_once('src/DataBaseConnection.php');

	$conexion = new DataBaseConnection();

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

<div class="header">
  <h1>Mi sitio web</h1>
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
		<form action="passrecover.php" method="post">
			<label>Nombre de usuario: </label><br>
			<input type="text" name="nombre" placeholder="Introduzca su nombre"><br><br>
			<input type="submit" name="recover" Value="Reiniciar su contraseña">
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