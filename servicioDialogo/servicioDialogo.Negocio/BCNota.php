<?php
require_once './servicioDialogo.DAC/NotaDAC.php';
/**
 * Gestiona el acceso a los datos para las ntoas de una movida. 
 */
class BCNota {

    function __construct() {
        
    }

    
    /**
     *Elimina la nota indicada
     * @param Sesion $sesion Sesión asignada por el sistema
     * @param Nota $nota Objeto de nota a eliminar.
     */
    public function eliminarNota($sesion,$nota){
        $_ret = false;
        if(BC_Sesion::sesionValida($sesion)){
            $_dac = new NotaDAC();
            $_ret = $_dac->eliminarNota($nota->IdNota);
        }
        
        return $_ret;
    }
    
    
    /**
     *Crea o modifica la nota indicada.
     * @param Sesion $sesion Sesión asignada por el sistema
     * @param Nota $nota Objeto nota a guardar.
     */
    public function guardarNota($sesion, $nota){
        //bool
        $_ret = false;
        if(BC_Sesion::sesionValida($sesion)){
            $_dac = new NotaDAC();
            $_notaExistente = $_dac->obtenerNota($nota->IdNota);
            //echo json_encode($_notaExistente);
            if($_notaExistente == null){
                $_ret = $_dac->insertarNota($nota);
            }else{
                $_ret = $_dac->modificarNota($nota);
            }
        }
        
        return $_ret;
    }
    
    
    /**
     * Asigna notas a las intervenciones del diálogo indicado
     * @param Sesion $sesion Sesión asignada por el sistema
     * @param Dialogo $dialogo Dialogo al que se asignarán las notas.
     * @return void
     */
    public function agregarNotasDialogo($sesion, $dialogo) {
        try {
            $_notaDac = new NotaDAC();
            //Nota[]
            $_notasDialogo = $_notaDac->obtenerNotasDialogo($dialogo->idDialogo, $sesion->usuario);
            
            foreach ($dialogo->intervenciones as $i){
                $i->Notas = $this->buscarNotas($_notasDialogo, $i->idIntervencion);
            }
        } catch (Exception $e) {
            
        }
    }
    
    /**
     *Busca las notas reales asociadas a la intervención indicada.
     * @param Notas[] $notas Universo de notas a buscar
     * @param int $idIntervencion Identificador de la nota asociada.
     * @return Nota[] Colección de notas que coinciden con la intervención indicada.
     */
    private function buscarNotas($notas, $idIntervencion){
        $_retorno = array();
        foreach($notas as $nota){
            if($nota->intervencionPadre->idIntervencion == $idIntervencion){
                array_push($_retorno, $nota);
            }
        }
        return $_retorno;
    }

}

?>
