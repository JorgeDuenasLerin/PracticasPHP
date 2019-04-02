<?php 
$nombre = "";
$numero = "";

$errores = [];

require_once('conexMetodosBBDD.php');

$consulta = new conexMetodosBBDD();

if(isset($_GET['enviar'])){

    if(isset($_GET['nombre'])){
        if(!empty($_GET['nombre'])){
            $nombre = $_GET['nombre'];
        } else {
            $errores[]="Nombre vacío";
        }
    }

    if(isset($_GET['numero'])){
        if(!empty($_GET['numero'])){
            $numero = $_GET['numero'];
        } else {
            $errores[]="Número vacío";
        }
    }

    if(isset($_GET['nombre']) && isset($_GET['numero'])){
        if(!empty($_GET['nombre']) && !empty($_GET['numero'])){
            //header('Location: http://www.example.com/');
            
            $conctacto = $consulta->crearContacto();
            if($contacto){
                echo "<h1>Contacto creado</h1>";
            } else {
                echo "<h1>No se ha creado el contacto</h1>";
            }
        }
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Añadir contacto</title>
</head>
<body>
    <table>
    <?php
        $contactos = $consulta->mostrarContactos();
        foreach ($contactos as $key => $value) {
            echo '<tr><td>';
            echo $value;
            echo '</td></tr>';
        }
    ?>
    </table>
    <form>
        <label>Nombre<input type="text" name="nombre"></label>  <br>
        <label>Nº Telefono<input type="number" name="numero"></label> <br><br>
        <input type="submit" name="enviar" value="enviar">
    </form>
    <span>
    <?php 
    foreach ($errores as $key => $value) {
        echo $value;
    }
    ?>
    </span>
</body>
</html>