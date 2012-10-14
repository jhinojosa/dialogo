<?php
require_once './servicioDialogo.Datos/Acta.php';
require_once './servicioDialogo.DAC/ActaDAC.php';
class BCActa{
    
    /**
     *Guarda el acta indicada
     * @param Sesion $sesion Sesión asignada por el sistema.
     * @param Dialogo $dialogo Objeto de diálogo con el acta como contenido.
     */
    public function guardarActaDialogo($sesion, $dialogo){
        $_retorno = false;
        if(BC_Sesion::sesionValida($sesion)){
            $_dac = new ActaDAC();
            if($_dac->seleccionarActa($dialogo->idDialogo, $sesion->usuario->nombreUsuario) == null){
                $dialogo->ActaUsuario->dialogoPadre = $dialogo;
                //echo json_encode($dialogo->ActaUsuario);
                $_retorno = $_dac->insertarActa($dialogo->ActaUsuario);
                
            }else{
                
                $dialogo->ActaUsuario->dialogoPadre = $dialogo;
                $_retorno = $_dac->actualizarActa($dialogo->ActaUsuario);
            }
        }
        return $_retorno;
    }
    
    
    /**
     *Obtiene el acta para el dialogo indicado. Importa el ID
     * @param Sesion $sesion Sesión asignada por el sistema
     * @param Dialogo $dialogo Diálogo al que se desea obtener el acta para el usuario. Importa el identificador.
     * @return Acta Objeto acta si existe, objeto acta vacío (id 0) en caso contrario.
     */
    public function obtenerActaDialogo($sesion, $dialogo){
        $_retorno = new Acta();
        
        if(BC_Sesion::sesionValida($sesion)){
            $_dac = new ActaDAC();
            $_retorno = $_dac->seleccionarActa($dialogo->idDialogo, $sesion->usuario->nombreUsuario);
            
            if($_retorno == null)
                $_retorno = new Acta();
            
        }
        return $_retorno;
    }
    
    /**
     *Obtiene las actas para el dialogo indicado. Importa el ID del parámetro dialogo.
     * @param Sesion $sesion Sesión asignada por el sistema.
     * @param Dialogo $dialogo Diálogo al que se desea obtener las actas de usuarios. Importa el ID
     * @return Acta[] Colección de Acta, si existe. Arreglo de actas vacío en caso contrario.
     */
    public function obtenerActasDialogo($sesion, $dialogo){
        $_retorno = array();
        if(BC_Sesion::sesionValida($sesion)){
            $_dac = new ActaDAC();
            $_retorno = $_dac->seleccionarActas($dialogo->idDialogo);
            
            if($_retorno == null){
                $_retorno = array();
            }
        }
        return $_retorno;
    }
    
    
    function __construct() {
       
    }
}
?>
