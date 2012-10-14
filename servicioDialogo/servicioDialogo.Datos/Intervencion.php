<?php

/**
 *Representa una opinión ingresada en el sistema, vincula a la intervención a la que responde, incluyendo el texto citado 
 */
class Intervencion{
    /**
     *Odentificador para la intervenciones. 0 => nueva intervencion.
     * @var int 
     */
    public $idIntervencion;
    
    /**
     *Texto de la intervención. Formateado en HTML.
     * @var string. 
     */
    public $Texto;
    
    /**
     *Fecha de publicación de la intervencion
     * @var DateTime
     */
    public $FechaCreacion;
    
    /**
     *Párrafo o texto al que cita la respuesta
     * @var string 
     */
    public $TextoRespuesta;
    
    /**
     *Intervención a la que se responde
     * @var Intervencion 
     */
    public $intervencionRespuesta;
    
    /**
     *
     * @var Movida
     */
    public $tipoMovida;
    
    /**
     *Corrección de sugerencias realizadas para la corrección por parte del facilitador.
     * Este valor debiera ser cargado solo al usuario facilitador.
     * @var MovidaCorregida[]
     */
    public $correccionMovida;
    
    /**
     *Usuario que emite la respuesta
     * @var Usuario 
     */
    public $usuarioCreador;
    
    /**
     *Carga las ntoas creadas por el usuario.
     * Se supone que es 1 por usuario, per se deja
     * abierta la posibilidad de tener varias
     * notas para una intervención.
     * @var Nota[] 
     */
    public $Notas;
    
    /**
     *
     * @var int
     */
    public $idDialogo;
    
    
}
?>
