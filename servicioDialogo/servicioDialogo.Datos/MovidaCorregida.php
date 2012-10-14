<?php

if (file_exists('./servicioDialogo.Datos/Movida.php'))
    require_once './servicioDialogo.Datos/Movida.php';
else{
    require_once '../servicioDialogo.Datos/Movida.php';
}
/**
 * Representa una sugerencia de corrección para una movida de un diálogo. 
 */
class MovidaCorregida extends Movida {

    /**
     * Identificador de la corrección sugerida.
     * @var int 
     */
    public $idCorreccion = 0;

    /**
     * Indica la intervención a la que pertenece la corrección.
     * @var int 
     */
    public $idIntervencionAsociada = 0;

    /**
     * Indica el usuario que realizó la corrección. 
     * @var string
     */
    public $usuarioCorrector;

}

?>
