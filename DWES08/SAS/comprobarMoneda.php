<?php
/**
 * Minijuegos: Tragaperras (2) - tragaperras-2-1.php
 *
 * @author    Escriba su nombre
 *
 */

session_start();

// si me envian por post moneda incremento la variable session moneda si existe y si no la creo
// si me mandan por post jugar, decremento la variable session moneda. (comprobar que moneda sea mayor que 0)
// si me mandan por post serializado las frutas, deserializo y las guardo en sesion

// si moneda vale 0, quiero quitar la variable para facilitarme la vida en futuras comprobaciones
if (isset($_SESSION['moneda']) && $_SESSION['moneda'] == 0) {
    echo "<h6>sesion vale 0, quito la session</h6>";
    unset($_SESSION['moneda']);
}

// si moneda vale 0, quiero quitar la variable para facilitarme la vida en futuras comprobaciones
if (isset($_SESSION['apuesta']) && $_SESSION['apuesta'] == 0) {
    echo "<h6>sesion vale 0, quito la session</h6>";
    unset($_SESSION['apuesta']);
}



if (isset($_POST['jugar']) && isset($_SESSION['moneda'])) {
    echo "<h6>jugamos</h6>";
    echo "<h6>decremento moneda</h6>";
    decrementoMoneda();

    if (isset($_POST['frutas'])) {
        echo "<h6>guardo las frutas</h6>";
        $numeros =  generarNumerosAleatorios();
        $premio = comprobarPremio($numeros);
        if ($premio !== -1) {
            if (isset($_SESSION['apuesta'])) {
                // $_SESSION['apuesta'] = decrementoApuesta(-$_SESSION['apuesta']);
                
                $premio = $premio * $_SESSION['apuesta'];
                echo "<h1>comprobarMoneda.php | $premio</h1>";
                unset($_SESSION['apuesta']);
            }
            incrementoMoneda($premio);
        } else {
            // $_SESSION['apuesta'] = decrementoApuesta(-$_SESSION['apuesta']);
            unset($_SESSION['apuesta']);
            echo "<h6>unlucky no hay premios, prueba otra vez!</h6>";
        }
        $_SESSION['premio'] = $premio;
        $_SESSION['frutas'] = $numeros;
    }
}

// cuando moneda vale 0 tiene que entrar aqui para inicializar la session moneda
if (! isset($_SESSION['moneda']) && isset($_POST['moneda'])) {
    echo "<h6>comprobarMoneda.php | inicalizo moneda a 1</h6>";
    $moneda = $_POST['moneda'];
    $moneda++;
    $_SESSION['moneda'] = $moneda;
}

if (isset($_POST['moneda'])) {
    echo "<h6>incremento moneda</h6>";
    incrementoMoneda();
}

function generarNumerosAleatorios()
{
    return [mt_rand(1, 8), mt_rand(1, 8), mt_rand(1, 8)];
}

function incrementoMoneda($incremento = 1)
{
    $moneda = $_SESSION['moneda'];
    $moneda = $moneda + $incremento;
    $_SESSION['moneda'] = $moneda;
}

function decrementoMoneda($decremento = -1)
{
    $moneda = $_SESSION['moneda'];
    $moneda = $moneda + $decremento;
    $_SESSION['moneda'] = $moneda;
}

function decrementoApuesta($decremento = -1)
{
    $apuesta = $_SESSION['apuesta'];
    $apuesta = $apuesta + $decremento;
    $_SESSION['apuesta'] = $apuesta;
}



// 1 - cerezas
// 2 - piña
// 3 - limón
// 4 - fresa
// 5 - platano
// 6 - naranja
// 7 - sandía
// 8 - uvas
function comprobarPremio(array $numeros)
{
    $n1 = $numeros[0];
    $n2 = $numeros[1];
    $n3 = $numeros[2];
    echo "<h2>comprobamos premios</h2>";
    // Si salen tres cerezas, se ganan diez monedas.
    if ($n1 == 1 && $n2 == 1 && $n3 == 1) {
        echo "<h6>hay 3 cerezas, se ganan 10 monedas</h6>";
        return 10;
    }

    // Si salen dos cerezas, se ganan cuatro monedas.
    if ($n1 == 1 && $n2 == 1 || $n1 == 1 && $n3 == 1 || $n2 == 1 && $n3 == 1) {
        echo "<h6>hay 2 cerezas, se ganan 4 monedas</h6>";
        return 4;
    }
    // Si sale una cereza, se gana una moneda.
    if ($n1 == 1 || $n2 == 1 || $n3 == 1) {
        echo "<h6>hay minimo una cereza, gana una moneda</h6>";

        // Si sale una cereza y dos frutas iguales, se ganan tres monedas.
        if ($n1 == $n2 || $n2 == $n3) {
            echo "<h6>1 cereza y 2 frutas iguales</h6>";
            return 3;
        } else {
            return 1;
        }
    }

    // Si salen tres frutas iguales que no sean cerezas, se ganan cinco monedas.
    if ($n1 == $n2 && $n2 == $n3) {
        echo "<h6>hay 3 frutas iguales, se ganan 5 monedas</h6>";
        return 5;
    }

    // Si salen dos frutas iguales que no sean cerezas, se ganan dos monedas.
    if ($n1 == $n2 || $n2 == $n3) {
        echo "<h6>hay 2 frutas iguales, se ganan 2 monedas</h6>";
        return 2;
    }

    return -1;
}


echo "<pre>";
echo '<b>{ARRAY $_SESSION}</b><br>';
print_r($_SESSION);
echo "</pre>";


die();

header("Location: index.php");
?>

