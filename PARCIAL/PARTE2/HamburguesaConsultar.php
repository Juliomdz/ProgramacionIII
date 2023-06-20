<?php


require_once 'Hamburguesa.php';

    if(isset($_POST['Nombre']) && isset($_POST['Tipo'])){
        $pNombre = $_POST['Nombre'];
        $pTipo = $_POST['Tipo'];
        var_dump(key($_POST));

        $myArray = Hamburguesa::ReadJSON();

        echo ' Nombre: '.$pNombre.' Tipo: '.$pTipo.'<br>';

        $myArray = Hamburguesa::ReadJSON();
        echo Hamburguesa::SearchFor($myArray, $pNombre, $pTipo).'<br>';
    } 
?>