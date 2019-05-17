<?php 
require_once "conexMetodosBBDD.php";
// comprobar que me envien idToken y token por GET
if(!isset($_GET['id']) && !isset($_GET['token'])){
    echo '<div class="alert alert-danger" role="alert">No deberias de estar aqui, redirigiendo!</div>';
    header("refresh:4;url=forgot.php");
} else {
    $_GET['token'] = $_GET['token'];
    $_GET['id'] = $_GET['id'];
}

if(isset($_POST['enviar'])){
    if(isset($_POST['pass1']) && isset($_POST['pass1'])){
        if($_POST['pass1'] == $_POST['pass2']){
            $token = $_GET['token'];
            $id = $_GET['id'];
            $password = $_POST['pass1'];

            $instancia = new conexMetodosBBDD();
            $comprobarToken = $instancia->comprobarToken($token, $id);
            if($comprobarToken){
                // actualizar contraseña si esta todo bien y redirigir al index.php
                $actualizarPass = $instancia->cambiarPass($id, $password);
                if($actualizarPass){
                    // borrar token de este usuario
                    $borrarToken = $instancia->borrarToken($token, $id);
                    if(!$borrarToken){
                        echo '<div class="alert alert-danger" role="alert">No pude borrar el token, redirigiendo!</div>';
                        // header("refresh:4;url=forgot.php");
                    }
                } else {
                    echo '<div class="alert alert-danger" role="alert">No se actualizó la contraseña, redirigiendo!</div>';
                    //header("refresh:4;url=forgot.php");
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">No se comprobó bien el token, redirigiendo!</div>';
                header("refresh:4;url=forgot.php");
            }  
        } else {
            echo '<div class="alert alert-danger" role="alert">Contraseñas diferentes, redirigiendo!</div>';
            header("refresh:4;url=forgot.php");
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Pasó algo raro, redirigiendo!</div>';
        header("refresh:4;url=forgot.php");
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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<style type="text/css">
	.login-form {
		width: 340px;
    	margin: 50px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
</style>
</head>
<body>
<div class="login-form">
    <form action="" method="post">
        <h2 class="text-center">Reset Password</h2>       
        <div class="form-group">
            <input type="password" class="form-control" name="pass1" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="pass2" placeholder="Password confirm" required="required">
        </div>
        <div class="form-group">
            <button type="submit" name="enviar" class="btn btn-primary btn-block">Reset</button>
        </div>        
    </form>
</div>
</body>
</html>                                		                            