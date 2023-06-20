<?php


require_once 'Pizza.php';
    
    if(isset($_GET['Sabor']) && isset($_GET['Precio']) && 
        isset($_GET['Tipo']) && isset($_GET['Cantidad'])){
        $pSabor = $_GET['Sabor'];
        $pPrecio = floatval($_GET['Precio']);
        $pTipo = $_GET['Tipo'];
        $pCantidad = intval($_GET['Cantidad']);

        //--- Creates a new instance of the Pizza class. ---//
        $pID = rand(1, 9);
        $myPizza = new Pizza($pID, $pSabor, $pPrecio, $pTipo, $pCantidad);
        
        echo '<h1>Pizza a Buscar</h1>';
        var_dump($myPizza);

        //--- Adds or update the new Pizza to the array. ---//
        echo Pizza::UpdateArray($myPizza, "add");
        
    }else{
        echo 'Falta al menos un dato';
    }
?>