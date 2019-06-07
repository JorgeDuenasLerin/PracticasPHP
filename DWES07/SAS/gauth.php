<?php 
// Holds the Google application Client Id, Client Secret and Redirect Url
include_once('config.php');

// Holds the various APIs functions
require_once('google-login-api.php');

// Google passes a parameter 'code' in the Redirect Url
if(isset($_GET['code'])) {
	try {
		// Get the access token 
		$data = GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);
        echo "<pre>";
        echo "<b>_GET</b><br>";
        print_r($data);
        echo "</pre>";

		// Access Tokem
		$access_token = $data['access_token'];
		
		// Get user information
        $user_info = GetUserProfileInfo($access_token);

        require_once('conexionBBDD.php');
        $conexion = new conexionBBDD();
        if($conexion->consultarUsuarioPorEmail($user_info['email']) == 1 ){
            $usuario = $conexion->obtenerDatosUsuario($user_info['email']);
            $usuario = $usuario[0];
            $conexion->insertarUsuario($user_info['email'], $usuario['username'], $usuario['pass'], $usuario['id'], "usuariosg");
            $id = $usuario['id'];
        } else {
            $conexion->insertarUsuario($user_info['email'], $user_info['name'], '', NULL, "usuariosg");
            $usuario = $conexion->obtenerDatosUsuario($user_info['email'], "usuariosg");
            $id = $usuario['id'];
        }
        require_once('metodos.php');
        $metodo = new Metodos();
        $token = $metodo->generateToken();
        $conexion->insertarToken($token, $id);
        session_start();
        $_SESSION['logged'] = true;
        
        // echo "<pre>";
        // echo "<b>{value}</b>";
        // print_r(get_defined_vars());
        // echo "</pre>";
        // die();
        
        header("location: index.php");
	}
	catch(Exception $e) {
		echo $e->getMessage();
		exit();
	}
}

?>