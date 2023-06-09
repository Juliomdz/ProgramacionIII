<?php
/* 6- (1 pts.) borrarVenta.php (por DELETE), debe recibir un número de pedido,se borra la venta y la foto se mueve a
la carpeta /BACKUPVENTAS.
*/

require_once "AccesoDatos.php";
require_once "ManejadorArchivos.php";
require_once "Venta.php";

// trae array asociativo
$body = json_decode(file_get_contents("php://input"), true); 

if(isset($body['numero']))
{
    $objAD = AccesoDatos::GetObjectAD();
    $venta = Venta::GetBy($objAD, 'numero', intval($body['numero']));
    if(!is_null($venta)){

        $directoryOld = './ImagenesDeLaVenta/2023';
        $directoryNew = './BACKUPVENTAS/2023';
        $fileName = $venta->GetFileName();
        
        echo 'Muevo imagen Venta eliminada en el directorio /BACKUPVENTAS/2023.', PHP_EOL;
        $resultSaveImage = 
        ManejadorArchivos::MoveImage($directoryOld, $directoryNew, $fileName);
        
        // Si logré mover la imagen, elimino en DB
        if($resultSaveImage){ 
            echo 'Se movio imagen a '.  $directoryNew . PHP_EOL; 
            
            echo 'Voy a eliminar Venta en DB.', PHP_EOL;
            $eliminados = Venta::DeleteBy($objAD, 'numero', intval($body['numero']));
            if($eliminados == 1) { echo 'Venta eliminada en DB.'. PHP_EOL; }
        }
    }
    
}
else{
    echo 'No fueron seteados valores por metodo DELETE en "borrarVenta.php". Verificar!!', PHP_EOL;
}

?>