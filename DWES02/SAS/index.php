<?php 
$nombre = "";
$numero = "";

$errores = [];

require_once('conexMetodosBBDD.php');

$consulta = new conexMetodosBBDD();

if(isset($_GET['enviar'])){

    // Si el nombre está vacio, mostrar una advertencia
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
        }
    }

    // Si el nombre que se introdujo ya existe en la agenda y no se indica número de teléfono, se eliminará de la agenda la entrada correspondiente a ese nombre.
    if(isset($_GET['nombre']) && empty($_GET['numero'])){
        if(!empty($_GET['nombre'])){
            $existeContacto = $consulta->consultarContacto($nombre);

            if(!empty($existeContacto)){
                echo "<h2>existe contacto, lo elimino</h2>";
                $consulta->eliminarContacto($nombre);
                header( "refresh:3;url=http://localhost:8080/DWES02/SAS/index.php" );
            } else {
                echo "<h3>no existe este contacto por eso no lo puedo eliminar</h3>";
            }
        }
    }

    // Si el nombre que y el numero se introdujo no existe en la agenda se añadirá a la agenda.
    // Si el nombre que se introdujo ya existe en la agenda y se indica un número de teléfono, se sustituirá el número de teléfono anterior.
    if(isset($_GET['nombre']) && isset($_GET['numero'])){
        if(!empty($_GET['nombre']) && !empty($_GET['numero'])){          
            $existeContacto = $consulta->consultarContacto($nombre, $numero);
            if($existeContacto){
                echo "<h3>Existe el contacto - modifico el numero</h3>";
                $consulta->modificarContacto($nombre, $numero);
            } else {
                echo "<h2>Creo contacto porque no existe en la BBDD</h2>";
                $consulta->crearContacto($nombre, $numero);
            }

            header( "refresh:3;url=http://localhost:8080/DWES02/SAS/index.php" );

        }
    } 

} // isset enviar
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
    <?php 
    echo "<pre>";
    echo "<span>GET</span><br>";
    print_r($_GET);
    echo "<pre>";
    ?>
    <table border>
    <tr>
        <th>ID</th><th>NOMBRE</th><th>TELÉFONO</th>
    </tr>
    <?php
        $contactos = $consulta->mostrarContactos();
        
        foreach ($contactos as $value) {
            // echo "<pre>";
            // print_r($value);
            // echo "<pre>";
            echo '<tr>';
            echo "<td>{$value['id']}</td>";
            echo "<td>{$value['nombre']}</td>";
            echo "<td>{$value['telefono']}</td>";
            echo '</tr>';
        }
    ?>
    </table>
    <br>
    <form>
        <label>Nombre<input type="text" name="nombre" value="<?= $nombre ?>"></label>  <br>
        <label>Nº Telefono<input type="number" name="numero" value="<?= $numero ?>"></label> <br><br>
        <input type="submit" name="enviar" value="enviar">
    </form>
    <span>
    <?php 
    if(isset($_GET['enviar'])){
        if(empty($_GET['nombre'])){
            echo '<span style="color:red">No has introducido el NOMBRE</span>';
        }
    }
    ?>
    </span>
</body>
</html>