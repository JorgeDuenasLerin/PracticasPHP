<?php 
	require_once('src/ConexionDataBase.php');

	$conexion= new ConexionDataBase();


	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		if(isset($_POST['mostrar'])){
			if(isset($_POST['familia'])){
				$nombreFamilia =$conexion->cleanInput($_POST['familia']);
				$arrayFamilia = $conexion->mostrar($nombreFamilia);

			}
		}
	}

	$opcion = ['Cámaras digitales', 'Consolas', 'Libros electrónicos', 'Impresoras', 'Memorias flash', 'Reproductores MP3', 'Equipos multifunción', 'Netbooks', 'Ordenadores', 'Ordenadores portátiles', 'Routers', 'Sistemas de alimentación ininterrumpida', 'Software', 'Televisores', 'Videocámaras'];

?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Plantilla para Ejercicios Tema 3</title>
	<link href="css/dwes.css" rel="stylesheet" type="text/css">
</head>

<body>

	<div id="encabezado">
		<h1>Listado de productos de una familia: </h1>
		<form id="form_seleccion" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
			<label><b>Familia: </b></label>
			<select name="familia" form="form_seleccion">
				<?php foreach ($opcion as $value) { ?>
				<option value="<?=$value?>"><?=$value?></option>
				<?php } ?>
			</select>
			<input type="submit" name="mostrar" value="Mostrar Productos">
		</form>
	</div>

	<div id="contenido">
		<h2>Productos de la familia: <i><?=$nombreFamilia ?></i></h2>
		<?php 
			if(empty($arrayFamilia) && isset($_POST['mostrar'])){

				echo "<h3>La familia seleccionada no tiene producto alguno</h3>";

			}elseif(!empty($arrayFamilia) && isset($_POST['mostrar'])){

				foreach ($arrayFamilia as $valor) {
					echo "<p><b>Producto: </b>"
					.$valor['nombre_corto'].' -> € '
					.$valor['PVP'];
					$cod = $valor['cod'];

		?>         
				<a href="editar.php?producto=<?= $cod ?>"><button>Editar</button></a>
					
		<?php  
					echo "</p>";
				}
			}
		 ?>
	</div>

	<div id="pie">
	</div>
</body>
</html>
