<?php

require_once 'BCAlerta.php';

/**
 * Gestiona el acceso a los datos para las intervenciones 
 */
class BCIntervencion {

    public function __construct() {
        
    }
    
    /**
     *Busca las intervenciones realizadas por el usuario indicado
     * @param Sesion $sesion Sesión del sistema.
     * @param string $nombreUsuario Nombre de usuario a buscar.
     * @return Intervencion[] Colección de objetos intervención que coinciden con el criterio de búsqueda.
     */
    public function buscarIntervenciones($sesion, $nombreUsuario){
        $_ret = array();
        if(BC_Sesion::sesionValida($sesion)){
            $_dac = new IntervencionDAC();
            $_bcDialogo = new BCDialogo();
            $_found = $_dac->obtenerIntervencionesUsuario($nombreUsuario);
            $_ret = array();
            $i=0;
            $_cacheDialogo=array();
            foreach($_found as $inte){
                $_nuevo = new Marcador();
                $_nuevo->dondeApunto = $inte;
                if(!isset($_cacheDialogo[$inte->idDialogo])){
                    $_cacheDialogo[$inte->idDialogo] = $_bcDialogo->obtenerEncabezadoDialogo($inte->idDialogo);
                }
                $_nuevo->dialogoAsociado = $_cacheDialogo[$inte->idDialogo];
                array_push($_ret, $_nuevo);
            }
        }
        
        return $_ret;
    }

    /**
     * Retorna todos los datos asociados a una intervención.
     * @param Sesion $sesion Sesión del sistema.
     * @param Intervencion $encabezado Objeto intervención cargado como mínimo con su id.
     */
    public function obtenerIntervencion($sesion, $encabezado) {
        $_retorno = new Intervencion();
        if (BC_Sesion::sesionValida($sesion)) {
            $_dac = new IntervencionDAC();
            //echo $encabezado->idIntervencion;
            $_retorno = $_dac->seleccionarIntervencion($encabezado->idIntervencion);
        }

        return $_retorno;
    }

    /**
     * Publica una intervención. Invoca la lógica del desbalance.
     * @param Sesion $sesion Sesion del sistema
     * @param Dialogo $dialogoPadre Diálogo al que pertenece la intervención.
     * @param Intervencion $intervencion Objeto de intervención.
     * @return bool Verdadero si la inserción fue exitosa.
     */
    public function publicarIntervencion($sesion, $dialogoPadre, $intervencion) {
        $_ret = false;
        if (BC_Sesion::sesionValida($sesion)) {
            $_dac = new IntervencionDAC();
            //Si se responde a la intervención de otro usuario.
            if ($intervencion->intervencionRespuesta->usuarioCreador->nombreUsuario
                    != $intervencion->usuarioCreador->nombreUsuario) {
                $_ret = $_dac->insertarIntervencion($dialogoPadre, $intervencion);
            } else {
                if (strlen(trim($intervencion->Texto)) > 0) {
                    //Si se responde a la intervención del mismo usuario.
                    //Modificar la intervención a la que se responde.
                    //Obtengo la intervención
                    $intAnterior = $this->obtenerIntervencion($sesion, $intervencion->intervencionRespuesta);
                    $nuevoTexto = $intAnterior->Texto;
                    $nuevoTexto .= "<br><i>--- agregado el " . date("d-m-Y H:i:s") . " ---</i><br>";
                    $nuevoTexto .= $intervencion->Texto;
                    $intAnterior->Texto = $nuevoTexto;
                    //Actualizar en la DB.
                    $intAnterior->Texto;
                    $_ret = $_dac->actualizarIntervencion($intAnterior);
                }else{
                    $_ret=false;
                }
                //No se iniciaría la lógica de desbalance.
                return $_ret;
            }

            if ($_ret) {
                $_negocioAlerta = new BCAlerta();
                try {
                    $_negocioAlerta->verificarBalance($sesion, $dialogoPadre);
                } catch (Exception $e) {
                    
                }
            }
        }

        return $_ret;
    }

    /**
     * Guarda una sugerencia de corrección.
     * @param Sesion $sesion Sesioón asignada por el sistema.
     * @param Intervencion $intervencion Intervencion con ID, y con movidaCorregida como mínimo.
     */
    public function guardarCorreccion($sesion, $intervencion) {
        $_ret = false;
        if (BC_Sesion::sesionValida($sesion)) {
            $_dac = new MovidaDAC();
            $_movida = $_dac->seleccionarCorreccion($intervencion->idIntervencion, $sesion->usuario);

            if ($sesion->usuario->esAdministrador() || $this->usuarioEsFacilitador($sesion->usuario, $intervencion)) {
                //echo "ADMIN";
                $_ret = $_dac->cambiarTipoIntervencion($intervencion, $intervencion->correccionMovida[0]);
            } else {
                if ($_movida->idCorreccion != 0) {
                    $_ret = $_dac->actualizarCorreccion($_movida->idCorreccion, $intervencion->correccionMovida[0]);
                } else {
                    $_movidaCorr = $intervencion->correccionMovida[0];

                    $_usuario = $sesion->usuario->nombreUsuario;

                    $_ret = $_dac->insertarCorreccion($_usuario, $intervencion->idIntervencion, $_movidaCorr);
                }
            }
        }

        return $_ret;
    }

    private function usuarioEsFacilitador($usuario, $intervencion) {
        try {
            $_dac = new IntervencionDAC();
            $_intVerificada = $_dac->seleccionarIntervencion($intervencion->idIntervencion);

            $idDialogo = $_intVerificada->idDialogo;
            $_bcdialog = new BCDialogo();
            $_dg = $_bcdialog->obtenerEncabezadoDialogo($idDialogo);
            return ($_dg->usuarioFacilitador->nombreUsuario == $usuario->nombreUsuario);
        } catch (Exception $e) {
            
        }

        return false;
    }

}

?>
