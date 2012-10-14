<?php

/**
 *Representa una nota asociada a una intervención. 
 */
class Nota{
    
    /**
     *Identificador único de la nota.
     * @var int
     */
    public $IdNota;
    
    /**
     *Texto escrito por el usuario como nota.
     * @var string
     */
    public $Texto;
    
    /**
     *Autor que realiza la nota
     * @var Usuario
     */
    public $Autor;
    
    /**
     *Intervención asociada a la nota.
     * @var Intervencion
     */
    public $intervencionPadre;
}
?>
