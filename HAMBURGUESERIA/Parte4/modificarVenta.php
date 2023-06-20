<?php
/* 5-(1 pts.) ModificarVenta.php (por PUT), debe recibir el número de pedido, el email del usuario, el nombre, tipo,
aderezo y cantidad, si existe se modifica , de lo contrario informar.
*/
require_once "AccesoDatos.php";
require_once "Venta.php";



$body = json_decode(file_get_contents("php://input"), true); 

/*
Debe recibir el número de pedido, el email del usuario, el nombre, tipo,
aderezo y cantidad, si existe se modifica , de lo contrario informar.
*/
if(isset($body['numero']))
{ 
    $objAD = AccesoDatos::GetObjectAD();

    $mail = $body['mail'];
    $nombre = $body['nombre'];
    $tipo = $body['tipo'];
    $aderezo = $body['aderezo'];
    $cantidad = intval($body['cantidad']);
    $numero  = intval($body['numero']);

    $ventaUpdate = new Venta(0, $mail, $nombre, $tipo, $aderezo, NULL, $cantidad);
    $cantidadActualizadas = Venta::UpdateBy($objAD,'numero', $numero, $ventaUpdate);
    echo 'A) Se modificó la venta N°: ', $numero, PHP_EOL;
}
    


