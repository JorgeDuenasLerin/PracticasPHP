<?php 
	require_once('bd_config.php');

	$nombreError=""; 
	$nombre =""; 
	$telefono="";

	/*funcion que limpia el dato a recibir*/
	function cleanInput($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	/*
	echo "<pre>";
	var_dump($_SERVER);
	echo "</pre>";

	echo "<pre>";
	var_dump($_GET);
	echo "</pre>";
	*/

	//Comprobamos los datos enviados por $_GET
	if($_SERVER['REQUEST_METHOD'] == 'GET'){

		if(empty($_GET['nombre'])){
			$nombreError = "* El nombre es requerido";
		}else{
			$nombre = cleanInput($_GET['nombre']);
		}

		if(!empty($_GET['telefono'])){
			$telefono = cleanInput($_GET['telefono']);
		}
	}

	//
	function conectarBD($db_user, $db_pass ,$db_name, $nombre, $telefono){

		try{
			$pdo = new PDO("mysql:host=localhost;dbname=$db_name",$db_user,$db_pass);
		
			echo "<h2>Conectado a la Agenda!!</h2>";

			//Se realiza la consulta que comprueba si el nombre esta en la base de datos, hacemos un conteo del numero de veces que aparece y luego con fetchColumn(), realizamos la comprobacion respectiva.

			// TODO: Preparar esta consulta
			$buscado = $pdo->query("SELECT COUNT(*) from agenda WHERE nombre = '$nombre'");
			
			// TODO: ¿Qué ocurre si hay un error en la sintaxis de la consulta?

			$fila = $buscado->fetchColumn();
			//Si $fila es igual a 0, $nombre no esta en la base de datos.
			if($fila == 0){

				//Si estamos aqui, hacemos un INSERT en la base de datos.
				if(!empty($nombre) && !empty($telefono)){
					// TODO: preparar consulta

					$stmt = $pdo->prepare("INSERT INTO agenda (nombre, telefono) VALUES('$nombre', '$telefono')");
					
					$stmt->execute();	
				}
			
			}else{//Al estar aquí sabemos que $nombre si esta en la base de datos.

				//Si el nombre está y el campo del telefono no, borramos ese registro
				if(!empty($nombre) && empty($telefono)){

					$pdo->exec("DELETE FROM agenda WHERE nombre = '$nombre'");
				
				}elseif(!empty($nombre) && !empty($telefono)){//Si el nombre está y aparece un nuevo número de télefono, cambiamos el número de teléfono por uno nuevo.

					$stmt = $pdo->prepare("UPDATE agenda SET telefono = $telefono WHERE nombre = '$nombre'");
					$stmt->execute();

				}
			}

			//Aquí mostramos todos los registros en la parte superior de la pagina.
			$stmt = $pdo->query('SELECT * from agenda'); 
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			while($row = $stmt->fetch()) {
				echo "<b>NOMBRE: </b>".$row['nombre'] . "<br/>";
				echo "<b>TELEFONO: </b>". $row['telefono'] . "<br/><br/>";
			}

			$stmt = null;
			$pdo = null;
			
			
		}
		catch (Exception $ex){

			echo "No se puede conectar a: " . $e->getMessage() ."<p>";
		}
	}//conectarBD
	

	
	conectarBD($db_user, $db_pass, $db_name, $nombre, $telefono);


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

	<form action="index.php" >
		<label>Nombre :<input type="text" name="nombre" value="<?= $nombre;?>" ></label>
		<span style="color: red"><?= $nombreError; ?></span><br>
		<label>Teléfono: <input type="text" name="telefono"></label><br>
		<input type="submit" value="enviar">
	</form>
</body>
<!--http://localhost:8000/PracticasPHP/DWES02/CFCG/index.php
	terminal~$ php -S localhost:8000
	https://www.php.net/manual/es/class.pdostatement.php
-->
</html>