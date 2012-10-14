<?php

class Acta{
    function __construct() {
        $this->idActa = 0;
    }
    
    /**
     *Identificador único del acta.
     * @var int
     */
    public $idActa;
    
    /**
     *Texto asociado al acta. Usualmente formateado en HTML
     * @var type 
     */
    public $TextoActa;
    
    /**
     *Fecha de modificación del acta, utilizado para fines de control
     * @var DateTime
     */
    public $fechaModificacion;
    
    /**
     *Usuario creador del acta, utilizado para fines de control
     * @var Usuario
     */
    public $UsuarioCreador;
    
    /**
     *
     * @var Dialogo
     */
    private $padre;
    
    /**
     *Identifica al dialogo al que pertenece el acta.
     * @param Dialogo $value
     * @return Dialogo 
     */
    public function dialogoPadre($value){
        if($value == null){
            return $this->padre;
        }else{
            $this->padre = $value;
            $this->padre->ActaUsuario = $this;
        }
    }
}
?>
