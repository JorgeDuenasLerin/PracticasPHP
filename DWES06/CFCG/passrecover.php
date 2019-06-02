<?php 
	require_once('src/DataBaseConnection.php');

	$conexion = new DataBaseConnection();
	$listaErrores = [];

	if(isset($_POST['recover'])){
		if(!empty($_POST['nombre'])){
			$nombre = $conexion->cleanInput($_POST['nombre']);
			$encontrado = $conexion->existeUsuario($nombre);

			if($encontrado){
				$token = $conexion->crearToken();
				$idDB = $conexion->obtenerID($nombre);
				$id= $idDB[0]['id'];

				$borrando = $conexion->borrandoRowTokens($id);
				$creando = $conexion->insertarRowTokens($token, $id);

				if ($creando === 1) {
					$mensajeConfirmacion = "¡Revise su correo y acepte restablecer su contraseña!";
					
					header("refresh:4; url=src/correo.php?token=$token&id=$id&nombre=$nombre");
					
				}
			}else{
				$listaErrores['noRegistrado'] = "Su nombre no esta registrado";
				header("refresh:4; url=index.php");
			}//encontrado
			
		}else{
			$listaErrores['nombre'] = "*Introducir un nombre";

		}//!empty($_POST['nombre'])

	}//isset($_POST['recover'])
	
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
    	<?php if(strlen($mensajeConfirmacion) > 1) { ?>
            <h2 class="confirmacion"><?=$mensajeConfirmacion?></h2>
        <?php } else{ ?>
      		<h2>Bienvenido</h2>
      	<?php } ?>
      <h3>Restablecer su contraseña: </h3>
		<form action="passrecover.php" method="post">
			<label>Nombre de usuario: </label><br>
			<input type="text" name="nombre" placeholder="Introduzca su nombre">
			<?php if(count($listaErrores) > 0) { ?>
            <p>
              <?php foreach ($listaErrores as $value) { ?>
                <div style="color: red"><?=$value?></div>
              <?php } ?>             
            </p>
        <?php } else{ ?> <br><br> <?php } ?>
			<input type="submit" name="recover" value="Reiniciar su contraseña">
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