<?php


$_DELETE = array();
$method = $_SERVER['REQUEST_METHOD'];

//--- Sets the timezone to use. ---//
date_default_timezone_set('America/Argentina/Buenos_Aires');

switch ($method) {
    case 'GET':
        switch (key($_GET)) {
            case 'Cargar':
                include 'Parte1/PizzaCarga.php';
                break;
            }
        break;
    case 'POST':
        switch (key($_GET)) {
            case 'Consultas':
                include 'Parte1/PizzaConsultar.php';
                break;
            case 'Venta':
                include 'Parte2/AltaVenta.php';
                break;
            case 'ConsultasVentas':
                include 'Parte3/ConsultasVentas.php';
                break;
            case 'Cargar':
                include 'Parte4/PizzaCarga.php';
                break;
            }
        break;
    case 'PUT':
        include 'Parte4/ModificarVenta.php';
        break;
    case 'DELETE':
        include 'Parte4/BorrarVenta.php';
        break;
}
    
?>