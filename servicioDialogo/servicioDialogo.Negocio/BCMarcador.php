<?php

require_once './servicioDialogo.DAC/MarcadorDAC.php';

/**
 * Gestiona el acceso a los datos para los marcadores. 
 */
class BCMarcador {

    function __construct() {
        
    }

    
    
    /**
     *Lista los marcadores ingresados en el sistema, del usuario que inició la sesión.
     * @param Sesion $sesion Sesión asignada por el sistema.
     * @return Marcador[] Colección de objetos marcador.
     */
    public function listarMarcadores($sesion){
        $_retorno = array();
        if(BC_Sesion::sesionValida($sesion)){
            $_dac = new MarcadorDAC();
            $_retorno = $_dac->seleccionarTodosLosMarcadores($sesion->usuario);
            
//            echo json_encode($_retorno);
            
            $_bc = new BCIntervencion();
            $_bcDialogo = new BCDialogo();
            $_cacheDialogo = array();
            
            foreach($_retorno as $m){ //Obtiene el objeto intervención completo.
                $m->dondeApunto = $_bc->obtenerIntervencion($sesion, $m->dondeApunto);
                
                if(!isset($_cacheDialogo[$m->dondeApunto->idDialogo])){
                    $_cacheDialogo[$m->dondeApunto->idDialogo] = $_bcDialogo->obtenerEncabezadoDialogo($m->dondeApunto->idDialogo);
                }
                
                $m->dialogoAsociado = $_cacheDialogo[$m->dondeApunto->idDialogo];
            }
        }
        
        return $_retorno;
    }
    
    /**
     * Ordena agregar el marcador indicado al sistema (si no existe)
     * @param Sesion $sesion
     * @param Marcador $marcador 
     */
    public function agregarMarcador($sesion, $marcador) {
        $_ret = false;
        if (BC_Sesion::sesionValida($sesion)) {

            $_dac = new MarcadorDAC();
            $_ret = $_dac->insertarMarcador($marcador);
        }
        return $_ret;
    }

}

?>
