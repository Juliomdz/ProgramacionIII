<?php

use Cupon as GlobalCupon;

class Cupon{
    public $numeroPedido;
    public $descuento;
    public $estado;
    public $vencimiento;

    public function __construct ($numeroPedido, $descuento, $estado, $vencimiento)
    {
        $this->numeroPedido = intval($numeroPedido);
        if ($descuento == "" || $descuento == NULL) {
            $descuento = 10;
        }
        $this->descuento = $descuento;
        if ($estado == "" || $estado == NULL) {
            $estado = "valido";
        }
        $this->estado = $estado;
        if ($vencimiento == "" || $vencimiento == NULL) {
            $vencimiento = date("Y-m-d", strtotime("+3 day"));
        }
        $this->vencimiento = $vencimiento;
    }

    public function GetFileName()
    {
        if(!is_null($this)){
            $fileName = $this->numeroPedido;
            return  $fileName;
        }

        echo '¡Ocurrió un Error en function GetFileName!: this es NULL. Verifique!!'. PHP_EOL;
        return NULL;
    }
    public function __Equals($obj){
        try {
            if(!is_null($obj)) { 
                if(($this->numeroPedido == $obj->numeroPedido)){ 
                    return true; 
                }
            }
            return false; 
        } catch (Exception $e) {
            echo "¡Ocurrió un Error!: ".  $e->getMessage() . PHP_EOL;
        }
    }
    public function ExistsInArray($arr){
        try {
            if(!is_null($this) && !is_null($arr) && is_array($arr) && count($arr) > 0) { 
                foreach ($arr as $value) {
                    if($this->__Equals($value)){ 
                        return true; 
                    }
                }
            }
            return false; 
        } catch (Exception $e) {
            echo "¡Ocurrió un Error!: ".  $e->getMessage() . PHP_EOL;
        }
    }
    public function UpdateArray($arr = array()){
        if (!is_null($this) && !is_null($arr) &&is_array($arr)){
            if (!$this->ExistsInArray($arr)) {
                array_push($arr, $this);
                echo "Cupon ingresado.",PHP_EOL;
            }else{
                    echo "Ya existe un cupon para esa venta.",PHP_EOL;
                 }
        }
        return $arr;
    }
    /////////////////////////////////////////////////////////////// MANEJO EN JSON
    static public function SaveInJson($arr = null, $fileName = "cupones.json")
    {
        try {
            $r = false;
            if (!is_null($arr) && is_array($arr) && count($arr) > 0) {
                $file = fopen($fileName, 'w');
                if ($file) {
                    $json = json_encode($arr, JSON_PRETTY_PRINT);
                    $r = fwrite($file, $json);
                    fclose($file);
                    if($r != false) { echo 'Se guardó el archivo '. $fileName . PHP_EOL; }
                }
            }
            return ($r == false) ? false : true;
        } catch (Exception $e) {
            echo "¡Ocurrió un Error!: ".  $e->getMessage() . PHP_EOL;
        }
    } 
    
    static public function ReadInJson($fileName = "cupones.json"){
        $arrayObj = array();
        try 
        {
            if(file_exists($fileName)){
                $file = fopen($fileName, 'r');
                if($file){
                    $arr = array();
                    $json = fread($file, filesize($fileName));
                    $arr = json_decode($json, true); 
                    foreach ($arr as $obj) {
                        $objNew = new Cupon(
                                            $obj["numeroPedido"],
                                            $obj["descuento"],
                                            $obj["estado"],
                                            $obj["vencimiento"]
                                        );
                        if(!is_null($objNew)){ array_push($arrayObj, $objNew); }
                    }
                    fclose($file);
                }
            }
        } catch (Exception $e) {
            echo "¡Ocurrió un Error!: ".  $e->getMessage() . PHP_EOL;
        }finally{
            return $arrayObj;
        }
    } 

    public function ValidarCupon($arr = array()){
        if(!is_null($this) && !is_null($arr) && is_array($arr) && count($arr) > 0) { 
            echo 'Validando cupon....', PHP_EOL;
            foreach ($arr as $value) {
                if($value->__Equals($this) && $value->estado == "valido"){ 
                    if ($value->vencimiento < date("Y-m-d")) {
                        $value->estado = "vencido";
                        echo 'CUPON VENCIDO.', PHP_EOL;
                    }
                    else {
                        if ($value->estado == "valido") {
                            $value->estado = "usado"; 
                            echo 'CUPON VALIDO.', PHP_EOL;
                        }
                    }
                    //retorno array nuevo
                    return $arr;
                }
            }
            //retorno invalido
            echo 'CUPON INVALIDO.', PHP_EOL;
        return false;
    }
    }

    static public function PrintList($arr){
        if(!is_null($arr) && is_array($arr) && count($arr) > 0){
            echo '<ul>';
            foreach ($arr as $value) {
                // echo '<li>'. 'id: ' . $value->id .'</li>';
                echo '<li>'. 'Numero de pedido: ' . $value->numeroPedido .'</li>';
                echo '<li>'. 'Status: ' . $value->estado .'</li>';
                echo '<br>'.PHP_EOL;
                echo '<br>'.PHP_EOL;
            }
            echo '</ul>';
        }
    }
    public function GetCuponByNumeroPedido($arr, $numeroPedido){
        try {
            if(!is_null($this) && !is_null($arr) && is_array($arr) && count($arr) > 0) { 
                foreach ($arr as $value) {
                    if($value->numeroPedido == $numeroPedido){ 
                        return $value; 
                    }
                }
            }
            return false; 
        } catch (Exception $e) {
            echo "¡Ocurrió un Error!: ".  $e->getMessage() . PHP_EOL;
        }
    }
}