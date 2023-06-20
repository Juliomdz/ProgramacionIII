<?php


require_once 'Pizza.php';
require_once 'Venta.php';
require 'DataAccess.php';
require_once 'UploadManager.php';
    
    if(isset($_POST['Sabor']) && isset($_POST['Email']) && 
        isset($_POST['Tipo']) && isset($_POST['Cantidad'])){
        $pSabor = $_POST['Sabor'];
        $vEmail = $_POST['Email'];
        $pTipo = $_POST['Tipo'];
        $pCantidad = intval($_POST['Cantidad']);

        
        


        $myPizza = new Pizza(null, $pSabor, null, $pTipo, $pCantidad);

        if(Pizza::UpdateArray($myPizza, "sub")){

            $venta = Venta::CreateVenta($vEmail, $myPizza);
            var_dump($venta);
            echo 'Venta a insertar: '.$venta->insertIntoDB($daoManager).'<br>';
            

            
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