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
include_once('conexMetodosBBDD');
// index.php a funciones
function inicioDeSesion($nombre, $pass){    
  $conexionBBDD = new conexMetodosBBDD();

  // consulta a la bbdd con la pass sin el hash
  $existeUsuario = $conexionBBDD->consultarUsuario($nombre, $pass);
  // echo "<pre>";
  // print_r($existeUsuario);
  // echo "</pre>";
  if(!empty($existeUsuario)){
    echo "<h1>usuario logeado</h1>";
    $_SESSION['logged'] = true;
    $_SESSION['logged_user'] = $nombre;
    $_SESSION['logged_id'] = $existeUsuario[0]['id'];
  } else {
    echo "<h1>usuario o pass incoorrecta</h1>";
  }
} // inicioSesion()

/*Muestre el mensaje en una parte de la pagian en rojo, rediriga y muera para que no siga procesando*/
function msgAccesoDenegado(){
  echo "<h1>ACCESO DENEGADO</h1>";
  header("refresh:3;url=index.php");
  die();
} // msgAccesoDenegado()

if(isset($_GET['logout'])){
  unset($_SESSION['logged']);
  //$_SESSION['logged']=false;

  $_SESSION['logged_user'] = "";

  $conexion = new conexMetodosBBDD();
  if(isset($_COOKIE['remember_me'])){
    $borrarToken = $conexion->borrarToken($_COOKIE['remember_me'], $_SESSION['logged_id']);
  }
  $_SESSION['logged_id'] = "";

  unset($_COOKIE['remember_me']);
  setcookie('remember_me', "", +0);
  
  header('location: '.webpage);
  die();
}

// habrá que comprobar cuando esté logeado ¿?


// comprobacion cuando no este logeado
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
        $_SESSION['logged_id'] = $existeUsuario[0]['id'];
        setcookie("remember_me", $token, time()+60*60*24*100);
        // update de alargar el campo de expiracion de el token en concreto
      }
    }
  }
}

?>