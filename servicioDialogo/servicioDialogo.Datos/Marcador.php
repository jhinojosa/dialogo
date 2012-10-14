<?php

/**
 *Representa un marcador asociado a una intervención. 
 */
class Marcador {
    
    public function __construct() {
    }
    
    /**
     *Identificador único del marcador
     * @var int 
     */
    public $idMarcador=0;
    
    /**
     *Intervención que se agregó a marcadores.
     * @var Intervencion 
     */
    public $dondeApunto;
    
    /**
     *
     * @var Dialogo 
     */
    public $dialogoAsociado;
    
    /**
     *Usuario que agrega la intervención a marcadores.
     * @var Usuario
     */
    public $usuarioPadre;
}

?>
