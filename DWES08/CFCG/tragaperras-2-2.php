<?php
/**
 * Minijuegos: Tragaperras (2) - tragaperras-2-2.php
 *
 * @author    Escriba su nombre
 *
 */
session_start();

$array = [];
$contadorCereza=0;
$countFrRep = 0;
$noRepe = 0;
$_SESSION['premio'] = 0;

if(isset($_GET['enviar'])){
	$_SESSION['face'] = "face-plain";
	if(is_numeric($_GET['numero'])){
		$_SESSION['suma']++;
	}
}

if(isset($_GET['jugar']) && $_SESSION['suma']>0 && $_SESSION['apostar']>0){
		$_SESSION['fruta1'] = rand(1,8);
			$array[0]=$_SESSION['fruta1'];
		$_SESSION['fruta2'] = rand(1,8);
			$array[1]=$_SESSION['fruta2'];
		$_SESSION['fruta3'] = rand(1,8);
			$array[2]=$_SESSION['fruta3'];

		$primerValor = current($array);
		$segundoValor = next($array);
		$ultimoValor = end($array);

		foreach ($array as $value) {

			if($value === 1){
				$contadorCereza++;
			}

			if($value !== 1){
				if($value === $primerValor){
					$countFrRep++;
				}elseif($value === $ultimoValor){
					$noRepe++;
				}
			} 
		}
		
		if(($contadorCereza ===1 && $countFrRep === 2) || ($contadorCereza ===1 && $noRepe === 2)){
			$_SESSION['premio']+=3;
		}elseif(($countFrRep === 2 && $contadorCereza === 0) || ($noRepe === 2 && $contadorCereza === 0)){
			$_SESSION['premio']+=2;
		}elseif($countFrRep === 3){
			$_SESSION['premio']+=5;
		}elseif($contadorCereza === 3){
			$_SESSION['premio']+=10;
		}elseif($contadorCereza === 2){
			$_SESSION['premio']+=4;
		}elseif($contadorCereza === 1){
			$_SESSION['premio']++;
		}else{
			$_SESSION['premio'] === 0;
		}

		$_SESSION['resultado'] = $_SESSION['premio'] * $_SESSION['apostar'];

		$_SESSION['suma'] += $_SESSION['resultado'];
		$_SESSION['apostar']= 0;
}
	var_dump(count($array));echo "array";
 if($_SESSION['resultado'] > 0){
 	$_SESSION['face'] = "face-smile";
 }elseif(count($array) === 0){
 	$_SESSION['face'] = "face-plain";
 }else{
 	$_SESSION['face'] = "face-sad";
 }

 if(isset($_GET['apostar']) && $_SESSION['suma'] > 0){
 		$_SESSION['apostar']++;
 		$_SESSION['suma']--;
 		$_SESSION['face'] = "face-plain";
}

	header("location:tragaperras-2-1.php");
	// header("refresh: 4; url=tragaperras-2-1.php");
?>
<!-- Si sale una cereza, se gana una moneda.
Si salen dos cerezas, se ganan cuatro monedas.
Si salen tres cerezas, se ganan diez monedas.
Si salen dos frutas iguales que no sean cerezas, se ganan dos monedas.
Si salen tres frutas iguales que no sean cerezas, se ganan cinco monedas.
Si sale una cereza y dos frutas iguales, se ganan tres monedas.
En el resto de casos, se pierde una moneda. -->