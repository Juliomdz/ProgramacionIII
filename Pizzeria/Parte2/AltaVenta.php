<?php


require_once 'Pizza.php';
require_once 'Venta.php';
require 'DataAccess.php';
require_once 'UploadManager.php';
    
    //--- Sets the timezone to use. ---//
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    
    //--- Check if the data is correct. ---//
    if(isset($_POST['Sabor']) && isset($_POST['Email']) && 
        isset($_POST['Tipo']) && isset($_POST['Cantidad'])){
        $pSabor = $_POST['Sabor'];
        $vEmail = $_POST['Email'];
        $pTipo = $_POST['Tipo'];
        $pCantidad = intval($_POST['Cantidad']);

        //--- Instance of the DataAccess class. ---//
        $daoManager = DataAccess::GetDAO();
        
        

        //--- Creates a new instance of the Pizza class. ---//
        $myPizza = new Pizza(null, $pSabor, null, $pTipo, $pCantidad);
        //$actualDateTime = date('Y-m-d__H_i_s');
        echo '<h1>Pizza a Buscar para vender</h1>';
        var_dump($myPizza);

        //--- Adds or update the new Pizza to the array. ---//
        if(Pizza::UpdateArray($myPizza, "sub")){
            // Agrego a BBDD la venta
            $venta = Venta::CreateVenta($vEmail, $myPizza);
            echo '<h1>Venta a agregar a BBDD</h1><br>';
            var_dump($venta);
            echo 'Venta a insertar: '.$venta->insertIntoDB($daoManager).'<br>';
            
            //--- Instance of the class UploadManager. ---//
            $imagesDirectory = "./ImagenesDeLaVenta/";
            $UpManager = new UploadManager($imagesDirectory, $venta, $_FILES);
            echo 'Venta Cargada con exito.<br>';
        }else{
            echo 'No hay stock de la pizza seleccionada<br>';
        }
        
    }else{
        echo 'Falta al menos un dato<br>';
    }
?>