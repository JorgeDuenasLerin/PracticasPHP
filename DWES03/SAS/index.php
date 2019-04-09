<?php 
$familia = "";

require_once('conexMetodosBBDD.php');

if(isset($_GET['enviar'])){
	if(isset($_GET['familia'])){
		if(!empty($_GET['familia'])){
			$familia = $_GET['familia'];
			$consulta = new conexMetodosBBDD();
			$resultado = $consulta->mostrarFamilia($familia);
		}
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Plantilla para Ejercicios Tema 3</title>
  <link href="dwes.css" rel="stylesheet" type="text/css">
</head>

<body>

<div id="encabezado">
	<h1>Tarea: Listado de productos de una familia</h1>
	<form id="form_seleccion" action=">">
		<label for="">Familia:
		<input type="text" name="familia" value="<?= $familia ?>">
		<input type="submit" name="enviar" value="Mostrar productos">
		</label>
	</form>
</div>

<div id="contenido">
	<h2>Productos de la familia: </h2>
	<?php 
	//if(!empty($resultado)){
		echo "<h1>ENTRO HTML</h1>";
		foreach ($resultado as $value) {
			foreach ($value as $clave => $valor) {
				echo "<p>";
				echo $clave;
				echo $valor;
				echo "</p>";
			}
		}
	//}
	?>
</div>
<pre>
</pre>
<div id="pie">
</div>
</body>
</html>

