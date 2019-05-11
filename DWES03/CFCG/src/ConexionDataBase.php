<?php 

	require_once('./config/bd_config.php');
	/**
	 * Clase que establece la conexión, y que contiene funciones que se utilizaran luego.
	 */
	class ConexionDataBase
	{
		private $dbPDO;
		
		function __construct()
		{
			global $db_user;
			global $db_pass;
			global $db_name;
		

			try{

				$this->dbPDO = new PDO("mysql:host=localhost;dbname=$db_name;charset=utf8",$db_user,$db_pass);
				$this->dbPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			}catch(PDOException $ex){
				echo "<p> No se puede conectar a: ".$ex->getMessage()."</p>";
			}

		}//__construct()

		/*
		*
		*/
		public function cleanInput(string $dato){
			$dato = trim($dato);
			$dato = stripslashes($dato);
			$dato = htmlspecialchars($dato);
			return $dato;
		
		}//cleanInput()

		/*
		*
		*/
		public function mostrar($nombreFamilia){
			try{

				$muestra = $this->dbPDO->prepare("SELECT nombre_corto, PVP, cod from producto where familia = (SELECT cod from familia where nombre = ?);");

				$muestra->bindParam(1,$nombreFamilia);
				$muestra->execute();

				$stmt = $muestra->fetchAll(PDO::FETCH_ASSOC);

				return $stmt;
				
			}catch(PDOException $ex){
				echo 'Error de conexion usuario: '.$ex->getMessage();
				die();
			}
		}//mostrar()

		/*
		*
		*/
		public function mostrarProducto($codigo){

			try{

				$descPro = $this->dbPDO->prepare("SELECT nombre_corto, nombre, descripcion, PVP, cod FROM producto WHERE cod = ?");
				$descPro->bindParam(1,$codigo);
				$descPro->execute();

				$stmt = $descPro->	fetchAll(PDO::FETCH_ASSOC);

				return $stmt;

			}catch(PDOException $ex){
				echo "Error conexion: ".$ex->getMessage();
				die();
			}
		}//mostrarProducto()

		public function actualizar($nombreCorto, $nombre, $descripcion, $precio, $codigo){

			try{

				$actualizar = $this->dbPDO->prepare("UPDATE producto SET nombre_corto = ?, nombre = ?, descripcion = ?, PVP = ? WHERE cod = ? ");
				$actualizar->bindParam(1,$nombreCorto);
				$actualizar->bindParam(2,$nombre);
				$actualizar->bindParam(3,$descripcion);
				$actualizar->bindParam(4,$precio);
				$actualizar->bindParam(5,$codigo);
				$actualizar->execute();

				if($actualizar->rowCount() === 1){

					return 1;

				}elseif($actualizar->rowCount() === 0){

					return 0;
				}
				
			}catch(PDOException $ex){
				echo "Error al actualizar: ".$ex->getMessage();
				die();
			}

		}

		/*
		* Funcion que destruye la conexión;
		*/
		public function __destruct(){

			$this->dbPDO = null;
		}
	
	}//De la clase
 ?>