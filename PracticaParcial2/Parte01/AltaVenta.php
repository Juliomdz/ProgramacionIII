<?php


require_once 'Pizza.php';
require_once 'Venta.php';
require_once 'DataAccess.php';
require_once 'UploadManager.php';
    
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
        $myNewObject = Pizza::createPizza(0, $pSabor, $pTipo, 0, $pCantidad);
        echo '<h2>Pizza a Buscar para vender</h2><br>';
        Pizza::printSingleProductAsTable($myNewObject);
        //var_dump($myNewObject);

        //--- Adds or update the new Pizza to the array. ---//
        if(Pizza::UpdateFile($myNewObject, "sub")){
            // Agrego a BBDD la venta
            $newSale = Venta::CreateVenta($vEmail, $myNewObject);
            echo '<h1>Venta a agregar a BBDD</h1><br>';
            Venta::printSingleSaleAsTable($newSale);
            //var_dump($newSale);
            echo '<br>ID Venta insertada: ['.$newSale->insertIntoDB($daoManager).']<br>';
            
            //--- Instance of the class UploadManager. ---//
            $imagesDirectory = "./ImagenesDeLaVenta/";
            $UpManager = new UploadManager($imagesDirectory, $newSale, $_FILES);
            echo '<br>Venta Cargada con exito.<br>';
        }else{
            echo '<br>No hay stock del producto seleccionado<br>';
        }
        
    }else{
        echo '<br>Falta al menos un dato<br>';
    }
?>