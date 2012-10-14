<?php

/**
 *Asocia una movida con la frecuencia en la que aparece. 
 */
class CuentaMovida{
    
    /**
     *
     * @var int
     */
    public $Cuenta = 0;
    
    /**
     *
     * @var Movida 
     */
    public $movida;
    
    /**
     *
     * @param Movida $movida
     * @param int $cantidad 
     */
    function __construct($movida, $cantidad) {
        $this->movida = $movida;
        $this->Cuenta = $cantidad;
    }
}
?>
