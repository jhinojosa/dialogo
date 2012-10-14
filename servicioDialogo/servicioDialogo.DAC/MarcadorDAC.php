<?php
require_once './servicioDialogo.Datos/Marcador.php';

/**
 * Accede a los datos vinculados a los marcadores. 
 */
class MarcadorDAC {

    /**
     * Lista los marcadores ingresados en el sistema del usuario que inició la sesión.
     * @param Usuario $usuario Usuario que guardó los marcadores.
     * @return Marcador[] Colección de objetos Marcador.
     */
    public function seleccionarTodosLosMarcadores($usuario) {
        $_retorno = array();
        try {
            $conexion = ConnectionManager::ObtenerConexion();
            $_exito = $conexion->abrirConexion();
            
            if($_exito){
                $_q = new Query($conexion, "marcador");
                $_q->addCampo("n_id_marcador");
                $_q->addCampo("n_id_intervencion");
                $_q->addCondicion("x_id_usuario='" . $usuario->nombreUsuario . "'");
                //echo $_q->QuerySelect();
                $_tabla = $conexion->consultar($_q->QuerySelect());
                $conexion->cerrarConexion();
                $_retorno = array();
                foreach($_tabla as $dr){
                    $_nuevoBalance = new Marcador();
                    $_nuevoBalance->idMarcador = $dr["n_id_marcador"];
                    $_nuevoBalance->usuarioPadre = $usuario;
                    $_nuevoBalance->dondeApunto = new Intervencion();
                    $_nuevoBalance->dondeApunto->idIntervencion = $dr["n_id_intervencion"];
                    
                    array_push($_retorno, $_nuevoBalance);
                }
            }
        } catch (Exception $e) {
            
        }
        
        return $_retorno;
    }

    /**
     * Guarda el marcador indicado en el sistema.
     * @param Marcador $marcador 
     */
    public function insertarMarcador($marcador) {
        $_ret = false;


        $conexion = ConnectionManager::ObtenerConexion();
        try {

            $_exito = $conexion->abrirConexion();
            if ($_exito) {
                $_q = new Query($conexion, "marcador");
                $_q->addValorString("x_id_usuario", $marcador->usuarioPadre->nombreUsuario);
                $_q->addValorString("n_id_intervencion", $marcador->dondeApunto->idIntervencion);
                $_ret = $conexion->modificar($_q->QueryInsert());
                $conexion->cerrarConexion();
            }
        } catch (Exception $e) {
            
        }
        return $_ret;
    }

}

?>
