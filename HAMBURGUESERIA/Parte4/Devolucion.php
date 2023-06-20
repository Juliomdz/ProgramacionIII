<?php

class Devolucion{
    public $numeroPedido;
    public $causa;

    public function __construct ($numeroPedido, $causa = '')
    {
        $this->numeroPedido = intval($numeroPedido);
        $this->causa = $causa;
    }

    public function GetFileName()
    {
        if(!is_null($this)){
            $fileName = $this->numeroPedido;
            return $fileName;
        }

        echo '¡Ocurrió un Error en function GetFileName!: this es NULL. Verifique!!'. PHP_EOL;
        return NULL;
    }

    /////////////////////////////////////////////////////////////// MANEJO EN JSON
    static public function SaveInJson($arr = null, $fileName = "devoluciones.json")
    {
        try {
            $r = false;
            if (!is_null($arr) && is_array($arr) && count($arr) > 0) {
                $file = fopen($fileName, 'w');
                if ($file) {
                    $json = json_encode($arr, JSON_PRETTY_PRINT);
                    $r = fwrite($file, $json);
                    fclose($file);
                    if($r != false) { echo 'Se guardó la devolución en archivo '. $fileName . PHP_EOL; }
                }
            }
            return ($r == false) ? false : true;
        } catch (Exception $e) {
            echo "¡Ocurrió un Error!: ".  $e->getMessage() . PHP_EOL;
        }
    } 
    
    static public function ReadInJson($fileName = "devoluciones.json"){
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
                        $objNew = new Devolucion(
                                            $obj["numeroPedido"],
                                            $obj["causa"]
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
                echo "Devolucion Ingresada.",PHP_EOL;
            }else{
                    echo "Ya existe una devolucion para esa venta.",PHP_EOL;
                 }
        }
        return $arr;
    }

    static public function PrintList($arr){
        if(!is_null($arr) && is_array($arr) && count($arr) > 0){
            echo '<ul>';
            foreach ($arr as $value) {
                // echo '<li>'. 'id: ' . $value->id .'</li>';
                echo '<li>'. 'Numero de pedido: ' . $value->numeroPedido .'</li>';
                echo '<li>'. 'Causa de devolucion: ' . $value->causa .'</li>';
                echo '<br>'.PHP_EOL;
                echo '<br>'.PHP_EOL;
            }
            echo '</ul>';
        }
    }
    static public function PrintDetailedList($arrDev, $arrCup){
        if(!is_null($arrDev) && is_array($arrDev) && count($arrDev) > 0){
            echo '<ul>';
            foreach ($arrDev as $value) {
                $cupon = new Cupon(0,"","","");
                $cupon = $cupon->GetCuponByNumeroPedido($arrCup,$value->numeroPedido);
                // echo '<li>'. 'id: ' . $value->id .'</li>';
                echo '<li>'. 'Numero de pedido: ' . $value->numeroPedido .'</li>';
                echo '<li>'. 'Causa de devolucion: ' . $value->causa .'</li>';
                echo '<li>'. 'Causa de devolucion: ' . $cupon->estado .'</li>';
                echo '<br>'.PHP_EOL;
                echo '<br>'.PHP_EOL;
            }
            echo '</ul>';
        }
    }
}