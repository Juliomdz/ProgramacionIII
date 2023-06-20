<?php
/* 9-
(2 pts.) ConsultasDevoluciones.php:-
a- Listar las devoluciones con cupones.
b- Listar solo los cupones y su estado
c- Listar devoluciones y sus cupones y si fueron usados
*/
require_once "Cupon.php";
require_once "Devolucion.php";



//a - Listar las devoluciones con cupones.
if(isset($_GET['devoluciones']))
{
    echo PHP_EOL; 
    echo 'a) Listar las devoluciones con cupones: '. PHP_EOL;
    $arrDev = Devolucion::ReadInJson();
    Devolucion::PrintList($arrDev);
}

//b- Listar  cupones y su estado
if(isset($_GET['cupones']))
{
    echo PHP_EOL; 
    echo 'b) Listar los cupones y su status: '. PHP_EOL;
    $arrCup = Cupon::ReadInJson();
    Cupon::PrintList($arrCup);
}

// c- Listar devoluciones y sus cupones y si fueron usados 
if(isset($_GET['detalleDevoluciones']))
{
    echo PHP_EOL; 
    echo 'c) Listar las devoluciones y sus cupones y si fueron usados: '. PHP_EOL;
    $arrDev = Devolucion::ReadInJson();
    $arrCup = Cupon::ReadInJson();
    Devolucion::PrintDetailedList($arrDev,$arrCup);
}
