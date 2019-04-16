<?php 
include_once('conexMetodosBBDD.php');

$cod = "";
$nombre = "";
$nombre_corto = "";
$descripcion = "";
$pvp = "";

echo "<pre>";
print_r($_GET);
echo "</pre>";

// si trae cod por get, hace la consulta a la bbdd de ese producto
// si no, redirige al index
if(isset($_GET['producto']) && !empty($_GET['producto'])){
    $consultas = new conexMetodosBBDD();
    $consultaPro = $consultas->consultarProducto($_GET['producto']);
    echo "<pre>";
    print_r($consultaPro);
    echo "</pre>";
    
    
    
    foreach ($consultaPro as $value) {
        $cod = $value['cod'];
        $nombre = $value['nombre'];
        $nombre_corto = $value['nombre_corto'];
        $descripcion = $value['descripcion'];
        $pvp = $value['PVP'];
    }
} else {
    //header('Location: index.php');
}


if(isset($_GET['actualizar'])){
    if(!empty($_GET['actualizar'])){
        
        $consultas = new conexMetodosBBDD();
        if(isset($_GET['cod']) && isset($_GET['nombre']) && isset($_GET['nombre_corto']) && isset($_GET['descripcion']) && isset($_GET['pvp'])){
            //if(!empty($_GET['cod']) && !empty($_GET['nombre']) && !empty($_GET['nombre_corto']) && !empty($_GET['descripcion']) && !empty($_GET['pvp'])){
            // si meto la anterior comprobacion puede que no entre ya que hay alguno que puede ser null  
                $cod = $_GET['cod'];
                $nombre = $_GET['nombre'];
                $nombre_corto = $_GET['nombre_corto'];
                $descripcion = $_GET['descripcion'];
                $pvp = $_GET['pvp'];
                $consultaAct = $consultas->actualizarProducto($cod, $nombre, $nombre_corto, $descripcion, $pvp);
                echo "<pre>";
                print_r($consultaAct);
                echo "</pre>";
                
                if(empty($consultaAct)){
                    echo '<span style="color:red;">No he actualizado lso campos</span>';
                    header( "refresh:3;url=http://localhost:8080/DWES03/SAS/editar.php?producto=$cod" );
                } else {
                    echo '<span style="color:green;">Campos actuallizados</span>';
                    header( "refresh:3;url=http://localhost:8080/DWES03/SAS/actualizar.php" );
                }
            //}
        }
        
        
    }
}

if(isset($_GET['cancelar'])){
    if(!empty($_GET['cancelar'])){
        echo "<h2>ENTRO 3</h2>";
        header('Location: index.php');
    }
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Plantilla para Ejercicios Tema 3</title>
  <link href="dwes.css" rel="stylesheet" type="text/css">
  <style>
  input[type=text]{
      width:90%;
  }
  input:nth-of-type(2){width:100px;}
  input:nth-of-type(3){width:84%;}

  textarea{
      width:90%;
      height:150px;
  }
  </style>
</head>

<body>

<div id="encabezado">
	<h1>Tarea: Edición de un producto</h1>
</div>

<div id="contenido">
	<h2>Producto:</h2>
    <form action="#">
        <input type="text" name="cod" value="<?= $cod ?>"><br><br>

        <label for="">Nombre <br><br>
        <input type="text" name="nombre" value="<?= $nombre ?>">
        </label> <br><br>

        <input type="hidden" name="nombre_corto" value="<?= $nombre_corto ?>">

        <label for="">Características: <br><br>
        <textarea name="descripcion"><?=$descripcion ?></textarea>
        </label><br><br>

        PVP. <input type="text" name="pvp" value="<?= $pvp ?>"><br><br>

        <input type="submit" name="actualizar" value="Actualizar">
        <input type="submit" name="cancelar" value="Cancelar">
    </form>
</div>

<div id="pie">
</div>
</body>
</html>
