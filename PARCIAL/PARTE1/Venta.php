<?php



class Venta{
    public $_date;
    public $_userEmail;
    public $_nombreHamburguesa;
    public $_tipoHamburguesa;
    public $_cantidadHamburguesa;

    public function __construct(){
        
    }
    public function getDate(){
        $this->_date = str_replace(" ", "__", $this->_date);
        $this->_date = str_replace(":", "_", $this->_date);
        return $this->_date;
    }


    public function getUserEmail(){
        return $this->_userEmail;
    }

    public function getnombreHamburguesa(){
        return $this->_nombreHamburguesa;
    }

    public function gettipoHamburguesa(){
        return $this->_tipoHamburguesa;
    }


    public function getcantidadHamburguesa(){
        return $this->_cantidadHamburguesa;
    }


    public function setDate($date){
        if (!empty($date)) {
            $this->_date = $date;
        }
    }

    public function setUserEmail($userEmail){
        if (!empty($userEmail)) {
            $this->_userEmail = $userEmail;
        }
    }


    public function setnombreHamburguesa($nombreHamburguesa){
        if (!empty($nombreHamburguesa)) {
            $this->_nombreHamburguesa = $nombreHamburguesa;
        }
    }


    public function settipoHamburguesa($tipoHamburguesa){
        if (!empty($tipoHamburguesa)) {
            $this->_tipoHamburguesa = $tipoHamburguesa;
        }
    }

    public function setcantidadHamburguesa($cantidadHamburguesa){
        if (!empty($cantidadHamburguesa) && is_numeric($cantidadHamburguesa)) {
            $this->_cantidadHamburguesa = $cantidadHamburguesa;
        }
    }


    public static function CreateVenta($vEmail, $Hamburguesa){
        $venta = new Venta();
        $venta->setDate(date('Y-m-d H:i:s'));
        $venta->setUserEmail($vEmail);
        $venta->setnombreHamburguesa($Hamburguesa->getNombre());
        $venta->settipoHamburguesa($Hamburguesa->getTipo());
        $venta->setcantidadHamburguesa($Hamburguesa->getCantidad());
        return $venta;
    }
}

?>