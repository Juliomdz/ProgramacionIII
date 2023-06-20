<?php


require_once 'Hamburguesa.php';
    
    if(isset($_POST['Nombre']) && isset($_POST['Precio']) && 
        isset($_POST['Tipo']) && isset($_POST['Aderezo']) && isset($_POST['Cantidad'])){
        $pNombre = $_POST['Nombre'];
        $pPrecio = floatval($_POST['Precio']);
        $pTipo = $_POST['Tipo'];
        $pAderezo = $_POST['Aderezo'];
        $pCantidad = intval($_POST['Cantidad']);

        //--- ID EMULADO. ---//
        $pID = rand(1, 9);
        $myHamburguesa = new Hamburguesa($pID, $pNombre, $pPrecio, $pTipo,$pAderezo, $pCantidad);
        
        echo '<h1>Hamburguesa a Buscar</h1>';
        var_dump($myHamburguesa);


        echo Hamburguesa::UpdateArray($myHamburguesa, "add");
        
    }else{
        echo 'Falta al menos un dato';
    }
?>