<?php 
	require_once('./config/bd_config.php');

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


	}// De la clase

?>