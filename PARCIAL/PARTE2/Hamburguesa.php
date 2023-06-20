<?php


class Hamburguesa{
    public $_id;
    public $_nombre;
    public $_precio;
    public $_tipo;
    public $_aderezo;
    public $_cantidad;

    public function __construct($id, $nombre, $precio, $tipo, $aderezo, $cantidad){
        $this->setID($id);
        $this->setNombre($nombre);
        $this->setPrecio($precio);
        $this->setTipo($tipo);
        $this->setAderezo($aderezo);
        $this->setCantidad($cantidad);
    }


    public function setID($id){
        if (isset($id) && is_numeric($id)){
            $this->_id = $id;
        }
    }


    public function setNombre($nombre){
        if (isset($nombre)){
            $this->_nombre = $nombre;
        }
    }


    public function setPrecio($precio){
        if (!empty($precio) && is_numeric($precio)){
            $this->_precio = $precio;
        }
    }


    public function setTipo($tipo){
        if (isset($tipo)){
            $this->_tipo = $tipo;
        }
    }

    public function setAderezo($aderezo){
        if (isset($aderezo)){
            $this->_aderezo = $aderezo;
        }
    }

    public function setCantidad($cantidad){
        if (!empty($cantidad) && is_numeric($cantidad)){
            $this->_cantidad = $cantidad;
        }
    }

    public function getID(){
        return $this->_id;
    }


    public function getNombre(){
        return $this->_nombre;
    }


    public function getPrecio(){
        return $this->_precio;
    }


    public function getTipo(){
        return $this->_tipo;
    }

    public function getAderezo(){
        return $this->_aderezo;
    }

    public function getCantidad(){
        return $this->_cantidad;
    }


    public function __Equals($obj):bool{
        if (get_class($obj) == "Hamburguesa" &&
            $obj->getNombre() == $this->getNombre() &&
            $obj->getTipo() == $this->getTipo()) {
            return true;
        }
        return false;
    }


    public function HamburguesaInArray($arrayHamburguesas):bool{
        if(!empty($arrayHamburguesas)){
            echo "The array isn't empty<br>";
            foreach ($arrayHamburguesas as $hamburguesa) {
                if ($this->__Equals($hamburguesa)) {
                    return true;
                }
            }
        }else{
            echo 'Array Empty<br>';
        }
        return false;
    }


    public static function UpdateArray($hamburguesa, $action):string{
        $filePath = 'Hamburguesa.json';
        $message = '';
        $arrayOfHamburguesas = Hamburguesa::ReadJSON($filePath);
        
        // if not exist in the array, add it
        if (!$hamburguesa->HamburguesaInArray($arrayOfHamburguesas)) {
            if ($action == "add") {
                array_push($arrayOfHamburguesas, $hamburguesa);
                $message =  "hamburguesa agregada.<br>";
            }
        }else{
            foreach ($arrayOfHamburguesas as $ahamburguesa) {
                // if exist in the array, update it
                if ($ahamburguesa->__Equals($hamburguesa)) {
                    if($action == "add"){
                        $ahamburguesa->setCantidad($ahamburguesa->getCantidad() + $hamburguesa->getCantidad());
                        $ahamburguesa->setPrecio($hamburguesa->getPrecio());
                        $message =  "hamburguesa actualizada.<br>";
                        // if exist and the action is sub, substract it
                    }else if($action == "sub"){
                        if($ahamburguesa->getCantidad() >= $hamburguesa->getCantidad()){
                            $ahamburguesa->setCantidad($ahamburguesa->getCantidad() - $hamburguesa->getCantidad());
                            $message =  "hamburguesa Vendida.<br>";
                        }else{
                            $message =  "NO HAY STOCK SOLICITADO.<br>";
                        }
                    }
                    break;
                }
            }
        }

        Hamburguesa::SaveToJSON($arrayOfHamburguesas, $filePath);

        return $message;
    }


    public static function SearchFor($array, $nombre, $tipo){
        $message = "";
        $sTipo = false;
        $sNombre = false;
        foreach ($array as $hamburguesa){
            if($hamburguesa->getNombre() == $nombre){
                $sNombre = true;
            }
            if($hamburguesa->getTipo() == $tipo){
                $sTipo = true;
            }
        }

        if($sTipo && $sNombre){
            $message =  'Si Hay';
        }else if($sTipo){
            $message =  'Solo hay de tipo: '.$tipo.'';
        }else if($sNombre){
            $message =  'Solo hay de Nombre: '.$nombre.'';
        }else{
            $message =  'No hay Hamburguesas '.$tipo.' ni de Nombre '.$nombre.'';
        }

        return $message;
    }


    public static function ReadJSON($filename="Hamburguesa.json"):array{
        $Hamburguesas = array();
        try {
            if (file_exists($filename)) {                  
                $file = fopen($filename, "r");
                if ($file) {
                    $json = fread($file, filesize($filename));
                    $HamburguesasFromJson = json_decode($json, true);
                    foreach ($HamburguesasFromJson as $hamburguesa) {
                        array_push($Hamburguesas, new Hamburguesa($hamburguesa["_id"], 
                        $hamburguesa["_nombre"], 
                        $hamburguesa["_precio"], 
                        $hamburguesa["_tipo"], 
                        $hamburguesa["_aderezo"],
                        $hamburguesa["_cantidad"]));
                    }
                }
                fclose($file);
            } 
        }catch (\Throwable $th) {
            echo "Error en la lectura del archivo";
        } 
        finally {
            return $Hamburguesas;
        }
    }

    public static function SaveToJSON($HamburguesasArray, $filename="Hamburguesa.json"):bool{
        $success = false;
        try {
            $file = fopen($filename, "w");
            if ($file) {
                $json = json_encode($HamburguesasArray, JSON_PRETTY_PRINT);
                fwrite($file, $json);
                $success = true;
            }
        } catch (\Throwable $th) {
            echo "Error al guardar el archivo";
        } finally {
            fclose($file);
            return $success;
        }
    }
}
?>