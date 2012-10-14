<?php

/**
 *Representa una movida, tanto global del sistema, como asociada a un dialogo particular. 
 */
class Movida{
    
    public function __construct() {
        
        $this->Eje = new Eje();
    }
    /**
     *Codificación de los ejes a los que pertenece el diálogo.
     * @var Eje
     * BuscarEntender = 0;
     * DarseAEntender = 1;
     */
    public $Eje;
    
    
    /**
     *Identificado único de la movida.
     * @var int 
     */
    public $IdMovida=0;

    /**
     *Nombre a mostrar para la movida.
     * @var string 
     */
    public $Nombre;
    
    /**
     *Nombre o dirección del icono asociado a la movida.
     * @var string 
     */
    public $Icono;
    
    /**
     *Texto que describe la movida.
     * @var string 
     */
    public $descripcion;
    
    /**
     *Eje al que pertenece (0:buscar entender, 1:darse a entender)
     * @var int 
     */
    public $eje=0;
    
    /**
     *Fecha de creación de la movida por parte del administrador.
     * @var string
     */
    public $fechaCreacion;
    
    /**
     *Autor de la movida.
     * @var Usuario
     */
    public $autor;
}

class Eje{
    
    public $BuscarEntender = 0;
    public $DarseAEntender = 1;
    
}
?>
