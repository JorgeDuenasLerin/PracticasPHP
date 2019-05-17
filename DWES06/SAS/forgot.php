<?php 
include('conexMetodosBBDD.php');

$usuario = "";

if(isset($noExiste)){
    if($noExiste != true){
        $noExiste = false;
    }
}

echo "<pre>";
print_r($_POST);
echo "</pre>";

echo "<pre>";
print_r($_GET);
echo "</pre>";

if(isset($_SESSION)){
  echo "<pre>";
  print_r($_SESSION);
  echo "</pre>";
}

if(isset($_POST['enviar'])){
    if(isset($_POST['usu'])){
        if(!empty($_POST['usu'])){
            $usuario = $_POST['usu'];
            $instancia = new conexMetodosBBDD();
            $consultaNombre = $instancia->consultarNombre($usuario);
            echo "<pre>";
            print_r($consultaNombre);
            echo "</pre>";
            
            if(!empty($consultaNombre)){
                // generar token (aleatorio...) del usuario
                $token = '98a8a61f4583f87bb0361b355db95274ba0de3eec824b81b7932fbb57605';
                $id = $consultaNombre[0]['id'];
                // insertarlo a la bbdd con su id y enviarselo por correo para el reseteo
                $tokenInsert = $instancia->insertarToken($token, $id);
                
                if(!$tokenInsert){
                    // $_POST['token'] = $tokenInsert[0]['token'];
                    // $_POST['id'] = $tokenInsert[0]['id'];
                    header("location: mail.php?forgot=true&token=$token&id=$id");
                }
                
            } else {
                $noExiste = true;
            }
        }
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap Simple Login Form</title>
<link rel="stylesheet" href="css/login.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
</head>
<body>
<div class="login-form">
    <form action="" method="POST">
        <h2 class="text-center">Forgot Password</h2>
        <?php if(isset($noExiste) && $noExiste == true) {?>       
        <div class="form-group has-error">
            <!-- <label class="control-label" for="inputError">Input con error</label> -->
            <input type="text" name="usu" class="form-control" id="inputError" required="required" value="<?= $usuario ?>">
            <span class="help-block">Usuario inexistente</span>
        </div>
        <?php } else { ?>
        <div class="form-group">
            <input type="text" name="usu" class="form-control" placeholder="Username" required="required" value="<?= $usuario ?>">
        </div>
        <?php } ?>
        <div class="form-group">
            <button type="submit" name="enviar" class="btn btn-primary btn-block">Reset My Password</button>
        </div>     
    </form>
</div>
</body>
</html>                                		                            