<?php
/**
 * Minijuegos: Tragaperras (2) - tragaperras-2-2.php
 *
 * @author    Escriba su nombre
 *
 */
session_start();
function incrementoApuesta($incremento = 1)
{
    $apuesta = $_SESSION['apuesta'];
    $apuesta = $apuesta + $incremento;
    $_SESSION['apuesta'] = $apuesta;
}

function decrementoMoneda($decremento = -1)
{
    $moneda = $_SESSION['moneda'];
    $moneda = $moneda + $decremento;
    $_SESSION['moneda'] = $moneda;
}

if (isset($_POST['apuesta']) && isset($_SESSION['moneda'])) {
    if ($_SESSION['moneda'] != 0) {
        incrementoApuesta();
        decrementoMoneda();
    }
}

echo "<pre>";
echo "<b>{_SESSION}</b>";
print_r($_SESSION);
echo "</pre>";

header("location: index.php");
