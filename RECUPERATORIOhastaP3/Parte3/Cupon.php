<?php

class Cupon{
    public $numeroPedido;
    public $descuento;

    public function __construct ($numeroPedido, $causa = '')
    {
        $this->numeroPedido = intval($numeroPedido);
        $this->descuento = 10;
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
                    if($r != false) { echo 'Se guardó el cupon del pedido en archivo '. $fileName . PHP_EOL; }
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
                                            $obj["numeroPedido"]
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


}