<?php

require_once 'Pizza.php';
require_once 'Venta.php';
require 'DataAccess.php';
require_once 'UploadManager.php';
    
    $body = json_decode(file_get_contents("php://input"), true);
    var_dump($body['NroPedido']);
    //--- Instance of the DataAccess class. ---//
    $daoManager = DataAccess::GetDAO();
    $oldDirectory = 'ImagenesDeLaVenta/';
    $newDirectory = './BACKUPVENTAS/';
    if(isset($body['NroPedido'])){
        //Searches a Venta in the DB.
        $salesToDelete = Venta::getVentaByID($daoManager, intval($body['NroPedido']));
        if(isset($salesToDelete)){
            if(Venta::deleteVentaByID($daoManager, intval($body['NroPedido']))>0){
                echo 'Venta Eliminada, se procede a mover la imagen de la venta.<br>';
                
                $imageName = UploadManager::getSalesImageName($salesToDelete[0]);
                echo '<br>'.'Image to be moved: '.$oldDirectory.$imageName.'<br>';
                
                
                if(UploadManager::moveImageFromTo($oldDirectory, $newDirectory, $imageName)){
                    echo '<br>Imagen fue movida a: '.$newDirectory.$imageName.'<br>';
                }else{
                    echo '<br>Error al mover la imagen.<br>';
                }
            }else{
                echo '<br>Ningun registro afectado.<br>';
            }
            
        }
    }else{
        echo '<br>La Venta a Borrar no existe.<br>';
    }
?>