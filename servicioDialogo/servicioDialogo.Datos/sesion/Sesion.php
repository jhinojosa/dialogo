<?php

/**
 *Contiene los datos de una sesión asignada en el sistema. 
 */
class Sesion{
    /**
     *Identificador único de sesión
     * @var type 
     */
    public $idSesion;
    
    /**
     *Fecha en que la sesión deja de ser válida 
     */
    public $expiracion;
    
    /**
     *Fecha en que la sesión se creó 
     */
    public $creacion;
    
    /**
     * Define un mensaje para retornar en caso de errores
     */
    public $MensajeError;
    
    /**
     *Usuario asociado a la sesión. 
     * @var Usuario 
     */
    public $usuario;
    
    function __construct() {
        
    }
}
?>
