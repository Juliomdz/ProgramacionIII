<?php


require_once 'Pizza.php';
require_once 'Venta.php';
require 'DataAccess.php';
    
    //--- Sets the timezone to use. ---//
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    //--- Instance of the DataAccess class. ---//
    $daoManager = DataAccess::GetDAO();
    
    //--- 4 - Query 01 ---//
    Venta::getPizzasSoldAmount($daoManager);
    echo '<br>';

    //--- 4 - Query 02 ---//
    if(isset($_POST['Fecha1'] ) && isset($_POST['Fecha2'])){
        Venta::PrintsAllVentasBetweenDates($daoManager, $_POST['Fecha1'], $_POST['Fecha2']);
        echo '<br>';
    }

    //--- 4 - Query 03 ---//
    if(isset($_POST['Usuario'])){
        Venta::PrintsAllVentasByUser($daoManager, $_POST['Usuario']);
        echo '<br>';
    }

    //--- 4 - Query 04 ---//
    if(isset($_POST['Sabor'])){
        Venta::PrintsAllVentasByFlavor($daoManager, $_POST['Sabor']);
        echo '<br>';
    }
    
?>