<?php

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        switch (key($_GET)) {
            case 'Cargar':
                include 'HamburguesaCarga.php';
                break;
            case 'Consultas':
                include 'HamburguesaConsultar.php';
                break;
            case 'Venta':
                include 'PARTE2/AltaVenta.php';
                break;
            case 'ConsultasVentas':
                include 'PARTE3/ConsultasVentas.php';
                break;
            case 'Cargar':
                include 'PARTE4/HamburguesaCarga.php';
                break;
            }
        break;
    case 'PUT':
        include 'PARTE4/ModificarVenta.php';
        break;
    case 'DELETE':
        include 'PARTE4/BorrarVenta.php';
        break;
}
    
?>