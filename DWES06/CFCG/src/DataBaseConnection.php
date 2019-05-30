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
		public function loguearse($nombre){

			$mensaje = "Usuario no registrado";

			try{
				$buscado = $this->dbPDO->prepare("SELECT count(*) from usuario WHERE nombre = ?");
				$buscado->bindParam(1, $nombre);
				$buscado->execute();

				$encontrado = $buscado->fetchColumn();

				if(!$encontrado == 0){
					$clave = $this->dbPDO->prepare("SELECT pass from usuario WHERE nombre = ? ");
					$clave->bindParam(1, $nombre);
					$clave->execute();

					$resultadoClave = $clave->fetchAll(PDO::FETCH_ASSOC);

					return $resultadoClave;
				}else{

					return $mensaje;
				}

				

			}catch(PDOException $ex){

				echo "Error de base datos: ".$ex->getMessage();
			}

		}//loguearse

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


	}// De la clase

?>