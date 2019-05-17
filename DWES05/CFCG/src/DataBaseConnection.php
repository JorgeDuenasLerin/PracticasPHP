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

		/*
		*
		*/
		public function mostrarProducto(){
			try{

				$producto = $this->dbPDO->prepare("SELECT * from producto");
				$producto->execute();

				$resultado = $producto->fetchAll(PDO::FETCH_ASSOC);

					return $resultado;

			}catch(PDOException $ex){

				echo "Error no se puede mostrar productos: ".$ex->getMessage();
				die();
			}
		}//mostrarProducto()

		public function mostrarTipo($tipo){
			try{

				$tipoProducto = $this->dbPDO->prepare("SELECT nombre from tipo where id = ?");
				$tipoProducto->bindParam(1, $tipo);
				$tipoProducto->execute();

				$tipoResul = $tipoProducto->fetchAll(PDO::FETCH_ASSOC);
				return $tipoResul;

			}catch(PDOException $ex){

				echo "Error: ".$ex->getMessage();
				die();
			}
		}

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
		* funcion que destruye la conexión
		*/
		public function __destruct(){

			$this->$dbPDO = null;
		
		}//__destruct()
	
	}// De la clase

?>