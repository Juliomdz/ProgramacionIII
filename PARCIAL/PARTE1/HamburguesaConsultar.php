<?php


require_once 'Hamburguesa.php';

    if(isset($_POST['Nombre']) && isset($_POST['Tipo'])){
        $pNombre = $_POST['Nombre'];
        $pTipo = $_POST['Tipo'];

        $myArray = Hamburguesa::ReadJSON();

        $myArray = Hamburguesa::ReadJSON();
        echo Hamburguesa::SearchFor($myArray, $pNombre, $pTipo);
    } 
?>