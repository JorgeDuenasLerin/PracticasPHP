<?php 
	include_once('./config/bd_config.php');

	/*
	* Clase que establece la conexión con la base de datos
	*/
	/**
	 * 
	 */
	class DataBaseConnection
	{
		private $dbPDO;

		function __construct()
		{
			global $db_user;
			global $db_pass;
			global $db_name;


			try{

				$this->dbPDO = new PDO("mysql:host=localhost;dbname=$db_name;charset=utf8",$db_user,$db_pass);
				$this->dbPDO -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			}catch(PDOException $ex){

				echo '<p>No se ha podido realizar la conexión.'.$ex->getMessage()."</p>";;
			}
		}//__construct()

		public function existeUsuario($nombre){
			$mensaje = "Usuario no registrado"; 

			try{
				$buscado = $this->dbPDO->prepare("SELECT count(*) from usuario WHERE nombre = ?");
				$buscado->bindParam(1, $nombre);
				$buscado->execute();

				$encontrado = $buscado->fetchColumn();

				if(!$encontrado == 0){
					return true;
				}else{
					return false;
				}

			}catch(PDOException $ex){
				echo "Error de base datos: ".$ex->getMessage();
			}

		}//existeUsuario();

		public function obtenerPass($nombre){

			try{
				$clave = $this->dbPDO->prepare("SELECT pass from usuario WHERE nombre = ?");
				$clave->bindParam(1, $nombre);
				$clave->execute();

				$resultadoClave = $clave->fetchAll(PDO::FETCH_ASSOC);

				return $resultadoClave;
			
			}catch(PDOException $ex){
				echo "Error de base datos: ".$ex->getMessage();
			}

		}//obtenerPass

		public function cleanInput(string $dato){
			$dato = trim($dato);
			$dato = stripslashes($dato);
			$dato = htmlspecialchars($dato);
			return $dato;
		
		}//cleanInput()

		public function getIP(){
			if(isset($_SERVER['HTTP_CLIENT_IP'])){
				return $_SERVER['HTTP_CLIENT_IP'];
			
			}elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				return $_SERVER['HTTP_X_FORWARDED_FOR'];
			
			}elseif(isset($_SERVER['HTTP_X_FORWARDED'])){
				return $_SERVER['HTTP_X_FORWARDED'];

			}elseif(isset($_SERVER['HTTP_FORWARDED_FOR'])){
				return $_SERVER['HTTP_FORWARDED_FOR'];

			}elseif(isset($_SERVER['HTTP_FORWARDED'])){
				return $_SERVER['HTTP_FORWARDED'];

			}else{
				return $_SERVER['REMOTE_ADDR'];
			}
		}//getIP()

		public function ipPais($direccionIP = '74.125.224.72'){
			
			//API que nos devuelve un JSON con datos relacionados a la ip solicitada
			$informacionSolicitud = file_get_contents("http://www.geoplugin.net/json.gp?ip=".$direccionIP);

			//Convertimos el JSON en un array
			$dataArray = json_decode($informacionSolicitud);

			//Extraemos del array el pais de la IP.
			foreach ($dataArray as $key => $value) {
				if($key == "geoplugin_countryName"){
					$pais = $value;
				}
			}
			return $pais;
		}//ipPais

		public function detectarSO($userAgent){

			$so ="";

			$arraySO = ["MS Windows", "GNU/Linux", "UNIX", "Fedora", "Ubuntu", "MacOS", "Solaris", "MacOS", "Haiku", "Chrome OS", "Sabayon Linux", "Android", "BlackBerry OS"];

			foreach($arraySO as $value) {
				if(strpos($userAgent,$value) !== false){
					$so = $value;
					break;
				}
			}

			return $so;
		}//detectarSO

		public function detectarNavegador($userAgent){

			$navegador ="";

			$arrayNavegadores = ["Firefox", "Chrome", "Safari", "Opera", "MSIE", "Trident", "Edge"];

			foreach($arrayNavegadores as $value) {
				if(strpos($userAgent,$value) !== false){
					$navegador = $value;
					break;
				}
			}

			return $navegador;
		}//detectarNavegador

		public function escribirFichero($ip, $pais, $navegador, $so){

			$fichero = fopen("log/mensajes/acceso-denegado.txt","w")
			or die("Ha habido un error al crear un archivo.");

			fwrite($fichero, "Datos: \n");
			fwrite($fichero, "Su IP: ".$ip."\n");
			fwrite($fichero, "Su Pais: ".$pais."\n");
			fwrite($fichero, "Su Navegador: ".$navegador."\n");
			fwrite($fichero, "Su SO: ".$so."\n");

			fclose($fichero);
		
		}//escribirFichero().

		public function leerFichero(){

			$mensajeTotal = "";
			$archivo = fopen("log/mensajes/acceso-denegado.txt", "r")
			or die("No se ha podido leer el fichero");

			while(!feof($archivo)){
				$linea = fgets($archivo);
				$saltoLinea = nl2br($linea);
				$mensajeTotal = $mensajeTotal.$saltoLinea;			
			}

			return $mensajeTotal;
		}//leerFichero()

		public function obtenerId($nombre){
			try{
				$clave = $this->dbPDO->prepare("SELECT id from usuario WHERE nombre = ?");
				$clave->bindParam(1, $nombre);
				$clave->execute();

				$resultadoClave = $clave->fetchAll(PDO::FETCH_ASSOC);

				return $resultadoClave;

			}catch(PDOException $ex){
				echo "Error de base datos: ".$ex->getMessage();
			}
		}//obtenerId()

		public function crearToken(){
			$token = bin2hex(random_bytes(32));
			return $token;
		}//crearToken()

		public function borrandoRowTokens($idUser){

			try{
				$borrar = $this->dbPDO->prepare("DELETE FROM auth_tokens WHERE userid = ?");
				$borrar->bindParam(1,$idUser);
				$borrar->execute();

				if($borrar >=1 ){
					return 1;
				}elseif ($borrar === 0) {
					return 0;
				}

			}catch(PDOException $ex){
				echo "Error de base datos: ".$ex->getMessage();
			}
		}//borrandoRowTokens

		public function insertarRowTokens($token, $idUser, $expire = "now()+ INTERVAL 1 DAY"){
  
			try{
				$insertar = $this->dbPDO->prepare("INSERT INTO auth_tokens (token, userid, expires) VALUES (?, ?, $expire)");
				$insertar->bindParam(1, $token);
				$insertar->bindParam(2, $idUser);
				$insertar->execute();

				if($insertar >=1 ){
					return 1;
				}elseif ($insertar === 0) {
					return 0;
				}

			}catch(PDOException $ex){
				echo "Error de base datos: ".$ex->getMessage();
			}
		}

		public function obtenerToken(int $patata){

			try{
				$extraer = $this->dbPDO->prepare("SELECT token from auth_tokens where userid = ? ");
				$extraer->bindParam(1, $patata);
				$extraer->execute();

				$tokenExtraido = $extraer->fetchAll(PDO::FETCH_ASSOC);
				return $tokenExtraido;

			}catch(PDOException $ex){
				echo "Error de base datos: ".$ex->getMessage();
			}
		}//obtenerTooken();


		public function actualizarPass($idUser, $pass){
			$pass = password_hash ($pass,PASSWORD_DEFAULT);

			try{

				$actualizar = $this->dbPDO->prepare("UPDATE usuario SET pass = ? where id = ? ");
				$actualizar->bindParam(1,$pass);
				$actualizar->bindParam(2,$idUser);
				$actualizar->execute();

				if($actualizar >=1 ){
					return 1;
				}elseif ($actualizar === 0) {
					return 0;
				}

			}catch(PDOException $ex){
				echo "Error de base datos: ".$ex->getMessage();
			}

		}//actualizarPass($idUser, $pass)


	}// De la clase

?>