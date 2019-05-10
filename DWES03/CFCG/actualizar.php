<?php 
	require_once('src/ConexionDataBase.php');

	$conexion = new ConexionDataBase();

	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		if(isset($_POST['cancelar'])){

			header('Location:listado.php');

		}elseif(isset($_POST['actualizar'])){

			if(isset($_POST['nombre_corto']) && isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['PVP']) && isset($_POST['cod'])){

				$nombreCorto = $conexion->cleanInput($_POST['nombre_corto']);
				$nombre = $conexion->cleanInput($_POST['nombre']);
				$descripcion = $conexion->cleanInput($_POST['descripcion']);
				$precio = $conexion->cleanInput($_POST['PVP']);
				$codigo = $conexion->cleanInput($_POST['cod']);

				$actualizar = $conexion->actualizar($nombreCorto, $nombre, $descripcion, $precio, $codigo);


			}

		}

	}

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Plantilla para Ejercicios Tema 3</title>
  <link href="css/dwes.css" rel="stylesheet" type="text/css">
</head>

<body>

<div id="encabezado">
	<h1>Actualizar: </h1>
	<form id="form_seleccion" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
	</form>
</div>

<div id="contenido">
	<h2>Contenido</h2>
	<?php 
		if($actualizar === 1){

			echo "<h4>Se han actualizado los datos.</h4>";

			echo "<form action='listado.php' method='post'>
				
					<input type='submit' value='Continuar' name='continuar'>

			</form>";


		}elseif($actualizar === 0){

			echo "<h4 style='color:red'>No se ha podido actualizar!</h4>";

		}

	 ?>
</div>

<div id="pie">
</div>
</body>
</html>
