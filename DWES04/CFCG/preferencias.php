<?php 

session_start();

$idioma="Español";
$perfil="si";
$hora="GMT-2";



if(isset($_POST['enviar'])){/*ENVIAN UN POST*/
	$_SESSION['idioma'] = $_POST['idioma'];
	$_SESSION['perfil'] = $_POST['perfil'];
	$_SESSION['hora'] = $_POST['hora'];

	$idioma = $_POST['idioma'];
	$perfil = $_POST['perfil'];
	$hora = $_POST['hora'];

	$span = "Información guardada en la sesión";
}

if(isset($_SESSION['idioma']) && isset($_SESSION['perfil']) && isset($_SESSION['hora'])){
	$idioma = $_SESSION['idioma'];
	$perfil = $_SESSION['perfil'];
	$hora = $_SESSION['hora'];
}

// Variable idioma:
// .- Sinse carga la página por primera vez tendrá el valor por defecto.
// .- Si están enviando el form, se establece la sessión y la variable idioma se queda bien.
// .- Me visitan y antes han establecido su preferencia la cargo en la variable.






	// function cleanInput($data){
	// 	$data = trim($data);
	// 	$data = stripslashes($data);
	// 	$data = htmlspecialchars($data);

	// 	return $data;
	// }

	// if($_SERVER['REQUEST_METHOD'] === 'POST'){
	// 	if(isset($_POST['enviar'])){
	// 		if(isset($_POST['idioma']) && isset($_POST['perfil']) && isset($_POST['hora'])){
	// 			$idioma = cleanInput($_POST['idioma']);
	// 			$perfil = cleanInput($_POST['perfil']);
	// 			$hora = cleanInput($_POST['hora']);

	// 			session_start();
	// 			if(empty($_SESSION)){
	// 				$_SESSION['idioma'] ="$idioma";
	// 				$_SESSION['perfil'] = $perfil;
	// 				$_SESSION['hora'] = $hora;
	// 			}else{
	//
	//}
	// 		}
	// 	}
	// }

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
  		<legend>Preferencias</legend>
	<form action="preferencias.php" method="post">
		<span><?=$span?></span><br><br>
		
		<label class="etiqueta">Idioma:</label><br>
		<select name="idioma" id="">

			<option value="Español" <?php if($idioma=="Español") echo "selected"; ?>>Español</option>
			<option value="Inglés" <?php if($idioma=="Inglés") echo "selected"; ?>>Inglés</option>
		</select><br><br>
		
		<label class="etiqueta">Perfil público:</label><br>
		<select name="perfil" id="">
			<option value="si" <?php if($perfil=="si") echo "selected" ?> >si</option>
			<option value="no" <?php if($perfil=="no") echo "selected" ?> >no</option>
		</select><br><br>
		
		<label class="etiqueta">Zona Horaria:</label><br>
		<select name="hora" id="">
			<option value="GMT-2" <?php if($hora=="GMT-2") echo "selected" ?> >GMT-2</option>
			<option value="GMT-1" <?php if($hora=="GMT-1") echo "selected" ?> >GMT-1</option>
			<option value="GMT" <?php if($hora=="GMT") echo "selected" ?> >GMT</option>
			<option value="GMT+1" <?php if($hora=="GMT+1") echo "selected" ?> >GMT+1</option>
			<option value="GMT+2" <?php if($hora=="GMT+2") echo "selected" ?> >GMT+2</option>
		</select><br><br>
		<input type="submit" name="enviar" value="Establecer preferencias">
	</form>

	<a href="mostrar.php">Mostrar preferencias</a>
	</fieldset>
</body>
</html>
