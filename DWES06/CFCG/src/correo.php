<?php
	if(isset($_GET['token'] ) && isset($_GET['id']) &&  isset($_GET['nombre'])){
    	if(!empty($_GET['token'] ) && !empty($_GET['id']) && !empty($_GET['nombre'])){
    		$token = $_GET['token'];
    		$id = $_GET['id'];
    		$nombre = $_GET['nombre'];
    	}
   	}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Proyecto de frutería</title>
  <link rel="stylesheet" href="../css/estilos.css">
  <link rel="stylesheet" href="../css/especifico.css">
</head>
<body>

<div class="header">
  <h1>Mi sitio web </h1>
  <p>Resize the browser window to see the effect.</p>
</div>

<div class="topnav">
	<a href="#" class="menuCorreo">Eliminar</a>
	<a href="#" class="menuCorreo">Spam</a>
	<a href="#" class="menuCorreo">Responder</a>
	<a href="#" class="menuCorreo">Reenviar</a>
	<a href="#" class="menuCorreo">Mover</a>
	<p style="float:right"></p>
</div>

<div class="row">
  <div class="leftcolumn">
    <div class="card">
      <h2>Bienvenido</h2>
      <h3>Recuperacion de contraseña en "Mi sitio web"</h3>
      <p>Estimado/a "<?=$nombre?>": </p>

		<p>Acabas de iniciar la recuperación de tu contraseña (o alguien lo ha hecho en tu nombre) en "Mi sitio web" El usuario de acceso es <?=$nombre?> </p>

		<p>Para poder hacer efectiva la recuperación, tendrás primero que activar tu cuenta haciendo clic en el siguiente enlace:

		<form action="../changepass.php" method="post">
			<input type="hidden" name="token" value="<?= $token ?>">
			<input type="hidden" name="id" value="<?= $id ?>">
			<input class="formOculto" type="submit" name="submit" value="http://www.Mi sitio web.com/bin/activate.php?id=1***1&key=???">
		</form>
		
		<p>Si no has sido tú quién ha realizado el registro, no te preocupes; simplemente ignora este mensaje.</p>

		<p>Saludos,
		El equipo de "Mi sitio web"</p>

		<p>P.D. Éste es un mensaje automático. Por favor, no lo contestes</p>
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