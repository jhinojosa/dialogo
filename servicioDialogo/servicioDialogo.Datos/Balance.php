<?php

/**
 *Representa un balance para un tipo de movida específico 
 */
class Balance{
    
    /**
     *Identificador único de un valor de balance para una movida y diálogo.
     * @var int
     */
    public $idBalance;
    
    /**
     *Valor porcentual considerado como ideal para una movida.
     * @var decimal
     */
    public $valor;
    
    /**
     *Desviación del valor esperado de balance.
     * @var type 
     */
    public $valorTolerancia;
    
    /**
     *Movida asociada al balance.
     * @var Movida
     */
    public $movida;
    
}
?>
