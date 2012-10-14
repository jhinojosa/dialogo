<?php

/**
 *Representa un perfil de movidas. 
 */
class CategoriaMovida{
    
    function __construct() {
    }

    /**
     *Identificador único de la categoría.
     * @var int 
     */
    public $idCategoria;
    
    /**
     *Nombre asignado a la categoría.
     * @var string
     */
    public $nombre;
    
    /**
     *Descripción para la categoría
     * @var string
     */
    public $descripcion;
    
    /**
     *Colección de movidas asociadas a la movida.
     * @var Movida[]
     */
    public $movidas;
    
    /**
     *Fecha de creación de la movida.
     * @var DateTime
     */
    public $fechaCreacion;
    
    /**
     *Autor asociado a la movida.
     * @var Usuario
     */
    public $autor;
}
?>
