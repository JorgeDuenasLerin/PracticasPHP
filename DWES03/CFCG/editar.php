<?php 
	require_once('src/ConexionDataBase.php');

	$conexion = new ConexionDataBase();

	if($_SERVER['REQUEST_METHOD'] === 'GET'){
		if(isset($_GET)==['producto']){
			$producto = $conexion->cleanInput($_GET['producto']);
			$arrayProducto = $conexion->mostrarProducto($producto);
		}
	}

	foreach ($arrayProducto as $value) {
		$nombreCorto = $value['nombre_corto'];
		$nombre = $value['nombre'];
		$descripcion = $value['descripcion'];
		$precio = $value['PVP'];
		$cod = $value['cod'];
	}


 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Editar Tema 3</title>
  <link href="css/dwes.css" rel="stylesheet" type="text/css">
</head>

<body>

<div id="encabezado">
	<h1>Edición de un producto </h1>
	
</div>

<div id="contenido">
	<h2>Producto:</h2>
	<form id="form_seleccion" action="actualizar.php" method="post">
		<label><b>Nombre corto: </b></label><input type="text" name="nombre_corto" value="<?= $nombreCorto ?>"><br><br>
		<label><b>Nombre: </b></label><br>
		<textarea type="textarea" name="nombre" rows="3" cols="160"><?= $nombre ?></textarea><br><br>
		<label><b>Descripción: </b></label><br>
		<textarea type="textarea" name="descripcion" rows="5" cols="160" ><?= $descripcion ?></textarea><br><br>
		<label><b>PVP: </b></label><input type="text" name="PVP" value="<?= $precio ?>"><br><br>
		<input type="hidden" name="cod" value="<?= $cod ?>">
		<input type="submit" value="Actualizar" name="actualizar">
		<input type="submit" value="Cancelar" name="cancelar">
	</form>
	
</div>

<div id="pie">
</div>
</body>
</html>
