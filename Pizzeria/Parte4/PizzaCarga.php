<?php


require_once 'Pizza.php';
require_once 'UploadManager.php';
    
    //--- Sets the timezone to use. ---//
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    
    if(isset($_POST['Sabor']) && isset($_POST['Precio']) && 
        isset($_POST['Tipo']) && isset($_POST['Cantidad'])){
        
        //--- Gets the input of the user. ---//
        $pSabor = $_POST['Sabor'];
        $pPrecio = floatval($_POST['Precio']);
        $pTipo = $_POST['Tipo'];
        $pCantidad = intval($_POST['Cantidad']);

        //--- Creates a new instance of the Pizza class. ---//
        $pID = rand(1, 999);
        $myPizza = new Pizza($pID, $pSabor, $pPrecio, $pTipo, $pCantidad);
        
        //--- Prints the information of the new pizza. ---//
        echo '<h1>Pizza a Buscar:</h1>'.'<br>';
        echo $myPizza->getInformation();

        //--- Adds or update the new Pizza to the array. ---//
        if(Pizza::UpdateArray($myPizza, "add")){
            //--- Instance of the class UploadManager. ---//
            $imagesDirectory = "./ImagenesDePizzas/";
            $UpManager = new UploadManager($imagesDirectory, $myPizza, $_FILES);
            echo '<h1>Pizza Agregada</h1><br>';
        }else{
            echo '<h1>Pizza No Agregada</h1>';
        }
        
    }else{
        echo 'Falta al menos un dato<br>';
    }
?>