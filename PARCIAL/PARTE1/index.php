<?php

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST')
{
        switch (key($_GET)) {
            case 'Cargar':
                include 'HamburguesaCarga.php';
                break;
            case 'Consultas':
                include 'HamburguesaConsultar.php';
                break;
            case 'Venta':
                include 'AltaVenta.php';
                break;
            }
}
    
?>