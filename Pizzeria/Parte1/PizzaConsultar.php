<?php


require_once 'Pizza.php';

    if(isset($_POST['Sabor']) && isset($_POST['Tipo'])){
        $pSabor = $_POST['Sabor'];
        $pTipo = $_POST['Tipo'];
        var_dump(key($_POST));

        //--- Gets the old array of pizzas from the file. ---//
        $myArray = Pizza::ReadJSON();

        echo '<h1>Pizzas a Buscar</h1><br>';
        echo '<h2> Sabor: '.$pSabor.' Tipo: '.$pTipo.'</h2><br>';

        //--- Adds or update the new Pizza to the array. ---//
        $myArray = Pizza::ReadJSON();
        echo '<h3>'.Pizza::SearchFor($myArray, $pSabor, $pTipo).'</h3> <br>';
    } 
?>