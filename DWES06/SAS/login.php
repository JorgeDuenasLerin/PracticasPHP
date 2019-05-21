<?php 
include_once('conexMetodosBBDD.php');

DEFINE('webpage', 'login.php');
$usuario = "";

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

function generateToken($length = 30){
    return bin2hex(random_bytes($length));
}



if(isset($noExiste)){
    if($noExiste != true){
        $noExiste = false;
    }
}

if(isset($_POST['enviar'])){
    if(isset($_POST['usu'])){
        $usuario = $_POST['usu'];
        if(isset($_POST['pass'])){
            $pass = $_POST['pass'];
            $instancia = new conexMetodosBBDD();
            $existeUsuario = $instancia->consultarUsuario($usuario, $pass);
    
            if($existeUsuario){
                session_start();
                $_SESSION['logged'] = true;
                if(isset($_POST['remember'])){
                    $instancia = new ConexMetodosBBDD();
                    $token = generateToken();
                    $tokenRemember = $instancia->insertarToken($token, $existeUsuario[0]['id']);
                    //setcookie("your_cookie_name", $session, time()+60*60*24*100,'/');
                    setcookie("remember_me", $token, time()+60*60*24*100);
                    print_r($tokenRemember);
                }
                $noExiste = false;
                //header('location: index.php');
            } else {
                // echo "<h1>usuario o pass incoorrecta</h1>";
                $noExiste = true;
            }
        }
    }
}

if(isset($_SESSION['logged'])){
    if($_SESSION['logged'] == true){
        header('location: index.php');
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
    <form action="#" method="POST">
        <h2 class="text-center">Log in</h2>  
        <?php if(isset($noExiste) && $noExiste == true) {?> 
        <div class="form-group has-error">
            <input type="text" name="usu" class="form-control" id="inputError" placeholder="Username" required="required" value="Usuario1">
        </div>  
        <div class="form-group has-error">
            <input type="password" name="pass" class="form-control" id="inputError" placeholder="Password" required="required" value="1234">
            <span class="help-block">Usuario o contraseña incorrectas</span>
        </div>      
        <?php } else { ?>
        <div class="form-group">
            <input type="text" name="usu" class="form-control" placeholder="Username" required="required" value="Usuario1">
        </div>
        <div class="form-group">
            <input type="password" name="pass" class="form-control" placeholder="Password" required="required" value="1234">
        </div>
        <?php } ?>
        <div class="form-group">
            <button type="submit" name="enviar" class="btn btn-primary btn-block">Log in</button>
        </div>
        <div class="clearfix">
            <label class="pull-left checkbox-inline"><input type="checkbox" name="remember"> Remember me</label>
            <a href="forgot.php" class="pull-right">Forgot Password?</a>
        </div>        
    </form>
    <!-- <p class="text-center"><a href="#">Create an Account</a></p> -->
</div>
</body>
</html>                                		                            