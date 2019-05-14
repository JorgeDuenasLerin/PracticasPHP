<?php 

	function cleanInput($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);

		return $data;
	}
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		if(isset($_POST['enviar'])){
			if(isset($_POST['idioma']) && isset($_POST['perfil']) && isset($_POST['hora'])){
				$idioma = cleanInput($_POST['idioma']);
				$perfil = cleanInput($_POST['perfil']);
				$hora = cleanInput($_POST['hora']);

				session_id('recuerdo');
				session_start();
				if(empty($_SESSION)){
					$_SESSION['idioma'] ="$idioma";
					$_SESSION['perfil'] = $perfil;
					$_SESSION['hora'] = $hora;
				}
			}
		}
	}

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
	<form action="" method="post">
		<?php if(!empty($_SESSION)){ ?>
			
			<span>Información guardada en la sesión</span><br><br>

		<?php } ?>
		
		<label class="etiqueta">Idioma:</label><br>
		<select name="idioma" id="">
			<?php if(!empty($_SESSION) && ($_SESSION['idioma'])=== $_POST['idioma'])  {?>
					
					<option value="<?= $_SESSION['idioma'] ?> "><?= $_SESSION['idioma'] ?> </option>

			<?php }else{ ?>
						<option value="Español">Español</option>
						<option value="Inglés">Inglés</option>
			<?php } ?>
		</select><br><br>
		<label class="etiqueta">Perfil público:</label><br>
		<select name="perfil" id="">
			<?php if(!empty($_SESSION) && ($_SESSION['perfil'])=== $_POST['perfil'])  {?>
					
					<option value="<?= $_SESSION['perfil'] ?> "><?= $_SESSION['perfil'] ?> </option>

			<?php }else{ ?>
						<option value="si">si</option>
						<option value="no">no</option>
			<?php } ?>
		</select><br><br>
		<label class="etiqueta">Zona Horaria:</label><br>
		<select name="hora" id="">
			<?php if(!empty($_SESSION) && ($_SESSION['hora'])=== $_POST['hora'])  {?>
					
					<option value="<?= $_SESSION['hora'] ?> "><?= $_SESSION['hora'] ?> </option>

			<?php }else{ ?>
					<option value="GMT-2">GMT-2</option>
					<option value="GMT-1">GMT-1</option>
					<option value="GMT">GMT</option>
					<option value="GMT+1">GMT+1</option>
					<option value="GMT+2">GMT+2</option>
			<?php } ?>
		</select><br><br>
		<input type="submit" name="enviar" value="Establecer preferencias">
	</form>

	<!-- <a href="mostrar.php?idioma=<?= $_SESSION['idioma'] ?> & perfil= <?=$perfil?> && hora=<?=$hora?>">Mostrar preferencias</a> -->
	<a href="mostrar.php?' . SID . '">Mostrar preferencias</a>
	</fieldset>
</body>
</html>
