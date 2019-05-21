/*

Funciones relacionadas con la autentificación

*/


function accesoRestringido(){

}

function logDeAccesoNoValido(){

}

function autentificaUsuarioConCredenciales($user, $pass){

}

<?php 
// funcion que compruebe que el usuario existe en la BBDD
if(isset($_POST['login'])){
  
    if(!empty($_POST['usu'])){
  
      $usuario = $_POST['usu'];
  
      if(!empty($_POST['pass']) && $_POST['pass'] != ""){
        
        $instancia = new conexMetodosBBDD();
        $nombre = $_POST['usu'];
        $pass = $_POST['pass'];
        // consulta a la bbdd con la pass sin el has
        $existeUsuario = $instancia->consultarUsuario($nombre, $pass);
  
        if(!empty($existeUsuario)){
          // echo "<h1>usuario logeado</h1>";
          $_SESSION['logged'] = true;
          $_SESSION['logged_user'] = $nombre;
        } else {
          // echo "<h1>usuario o pass incoorrecta</h1>";
        }
        
      }
    }
  
  }
  
  // funcion que avise al usuario que se le ha denegado el acceso a la pagina porque no tiene acceso
  if(isset($_GET['denegado'])){
    echo "<h1>ACCESO DENEGADO</h1>";
    echo "<h1>".$_POST['denegado']."</h1>";
  }
  
  // funcion que si quieren cerrar sesion, restablezca todas las variables 
  if(isset($_GET['logout'])){
    unset($_SESSION['logged']);
    $_SESSION['logged_user'] = "";
    unset($_COOKIE['remember_me']);
    setcookie('remember_me', "", +0);
    //$_SESSION['logged']=false;
    header('location: '.webpage);
    // crear consulta que borre de la tabla de tokens el token que ya se va a quedar inutilizado
    die();
  }
  
  // comprobar cuando no este logeado
  if(!isset($_SESSION['logged'])){
    if(isset($_COOKIE)){
      if(isset($_COOKIE['remember_me'])){
        $token = $_COOKIE['remember_me'];
        $instancia = new conexMetodosBBDD();
        $consultarToken = $instancia->consultarToken($token);
        if(!$consultarToken){
          unset($_COOKIE['remember_me']);
          setcookie('remember_me', "", +0);
        } else {
          echo "<pre>";
          print_r($consultarToken);
          echo "</pre>";
          $id = $consultarToken[0]['userid'];
          $consultaUsuario = $instancia->consultarUsuarioPorId($id);
          echo "<pre>";
          print_r($consultaUsuario);
          echo "</pre>";
  
          $usuario = $consultaUsuario[0]['nombre'];
          $_SESSION['logged'] = true;
          $_SESSION['logged_user'] = $usuario;
          setcookie("remember_me", $token, time()+60*60*24*100);
          // update de alargar el campo de expiracion de el token en concreto
        }
      }
    }
  }
?>