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

	$opciones = ['GMT-2', 'GMT-1', 'GMT', 'GMT+1', 'GMT+2'];
// Variable idioma:
// .- Sinse carga la página por primera vez tendrá el valor por defecto.
// .- Si están enviando el form, se establece la sessión y la variable idioma se queda bien.
// .- Me visitan y antes han establecido su preferencia la cargo en la variable.


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<title>Preferencias</title>
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
				<?php foreach ($opciones as $value) { ?>
				<option value="<?=$value?>" <?php if($hora==$value) echo "selected" ?> ><?=$value?></option>
				<?php } ?>
			</select><br><br>
			<input type="submit" name="enviar" value="Establecer preferencias">
		</form>

		<a href="mostrar.php">Mostrar preferencias</a>
	</fieldset>
</body>
</html>
