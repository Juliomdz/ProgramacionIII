<?php


date_default_timezone_set('America/Argentina/Buenos_Aires');
$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) 
{
    case "GET":
        echo 'Petición por GET'. PHP_EOL;
        switch (key($_GET)) 
        {
            case 'consultarVentas':
                require_once "Parte4/ConsultasVentas.php";
            break;
            case 'consultarDevoluciones':
                require_once "Parte4/ConsultasDevoluciones.php";
            break;
            default:
                echo 'Opción por GET no válida.'. PHP_EOL;
            break;
        }
    break;
///////////////////////////////////////////////////////////////////////////
    case 'POST':
        echo 'Petición por POST'. PHP_EOL;
        switch (key($_GET)) 
        {
            case 'cargar':
                require_once "Parte4/HamburguesaCarga.php";
            break;
            case 'consultar':
                require_once "Parte4/HamburgesaConsultar.php";
            break;
            case 'vender':
                require_once "Parte4/AltaVenta.php";
            break;
            case 'devolver':
                require_once "Parte4/DevolverHamburguesa.php";
            break;
            default:
                echo 'Opción por POST no válida.'. PHP_EOL;
            break;
        }
    break;
///////////////////////////////////////////////////////////////////////////
    case 'PUT':
        echo 'Petición por PUT'. PHP_EOL;
        require_once "Parte4/modificarVenta.php";
    break;
///////////////////////////////////////////////////////////////////////////
    case 'DELETE':
        echo 'Petición DELETE'. PHP_EOL;
                require_once "Parte4/borrarVenta.php";
            break;
    break;
///////////////////////////////////////////////////////////////////////////
    default:
        echo 'Petición no válida.'. PHP_EOL;
    break;
}

?>