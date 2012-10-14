<?php

require_once './servicioDialogo.Datos/Regla.php';

/**
 * Realiza y genera consultas vinculadas con las reglas de un diálogo. 
 */
class ReglaDAC {

    /**
     * Guarda una regla global para el sistema.
     * @param Regla $r
     * @param Usuario $usuarioCreador 
     */
    public function insertarReglaSistema($r, $usuarioCreador) {
        $_retorno = false;
        $conexion = ConnectionManager::ObtenerConexion();
        try {
            $_exito = $conexion->abrirConexion();
            
            if(!$_exito)
                return $_retorno;
            
            $_q = new Query($conexion, "maestro_regla");
            $_q->addValorString("x_id_usuario", $usuarioCreador->nombreUsuario);
            $_q->addValorString("x_texto_regla", $r->textoRegla);
            $_q->addValorString("d_fecha_creacion", date("d-m-Y H:i:s"));
            
            $_retorno = $conexion->modificar($_q->QueryInsert());
            $conexion->cerrarConexion();
        } catch (Exception $e) {
            
        }
        
        return $_retorno;
    }

    /**
     * Actualiza el texto de una regla del sistema 
     * @return bool Verdadero en caso de éxito.
     */
    public function actualizarReglasSistema($regla, $usuarioModificador) {
        $_retorno = false;
        $conexion = ConnectionManager::ObtenerConexion();
        try {
            $_exito = $conexion->abrirConexion();
            if (!$_exito) {
                return $_retorno;
            }

            $_q = new Query($conexion, "maestro_regla");
            $_q->addValorString("x_id_usuario", $usuarioModificador->nombreUsuario);
            $_q->addValorString("x_texto_regla", $regla->textoRegla);
            $_q->addValorString("d_fecha_creacion", date("d-m-Y H:i:s"));

            $_q->addCondicion("n_id_regla=" . $regla->idRegla);
            $_retorno = $conexion->modificar($_q->QueryUpdate());
            $conexion->cerrarConexion();
        } catch (Exception $e) {
            
        }

        return $_retorno;
    }

    /**
     * Elimina una regla asociada a un diálogo
     * @param Regla $regla Regla a eliminar, importa el id.
     * @return bool Verdadero en caso de éxito.
     */
    public function eliminarReglaDialogo($regla) {
        $_retorno = false;
        $conexion = ConnectionManager::ObtenerConexion();
        try {
            $_exito = $conexion->abrirConexion();
            if (!$_exito)
                return $_retorno;

            $_q = new Query($conexion, "regla_dialogo");
            $_q->addCondicion("n_id_regla_dialogo=" . $regla->idRegla);
            $_retorno = $conexion->modificar($_q->QueryDelete());
            $conexion->cerrarConexion();
        } catch (Exception $e) {
            
        }

        return $_retorno;
    }

    /**
     * Actualiza el texto de una regla asociada a un diálogo
     * @param Regla $regla Regla a eliminar, importa el id y el nuevo texto.
     * @return bool Verdadero en caso de éxito.
     */
    public function actualizarReglaDialogo($regla) {
        $_retorno = false;
        $conexion = ConnectionManager::ObtenerConexion();
        try {
            $_exito = $conexion->abrirConexion();
            if (!$_exito)
                return $_retorno;
            $_q = new Query($conexion, "maestro_regla");
            $_q->addValorString("x_texto_regla_dialogo", $regla->textoRegla);
            $_q->addValorString("d_fecha_creacion", date("d-m-Y H:i:s"));
            $_q->addCondicion("n_id_regla_dialogo=" . $regla->idRegla);
            $_retorno = $conexion->modificar($_q->QueryUpdate());
            $conexion->cerrarConexion();
        } catch (Exception $e) {
            
        }

        return $_retorno;
    }

    /**
     * Agrega una regla asociada a un diálogo.
     * @param Dialogo $dialogo Dialogo que contendrá la regla.
     * @param Regla $regla Objeto Regla compatible.
     * @return bool Verdadero si la inserción fue correcta.
     */
    public function insertarReglaDialogo($dialogo, $regla) {
        $_retorno = false;
        $conexion = ConnectionManager::ObtenerConexion();

        try {
            $_exito = $conexion->abrirConexion();
            if ($_exito) {
                $_q = new Query($conexion, "regla_dialogo");
                $_q->addValorString("n_id_dialogo", $dialogo->idDialogo);
                $_q->addValorString("x_texto_regla_dialogo", $regla->textoRegla);
                $_q->addValorString("d_fecha_creacion", date("d-m-Y H:i:s"));

                $_retorno = $conexion->modificar($_q->QueryInsert());
            }
            $conexion->cerrarConexion();
        } catch (Exception $e) {
            
        }

        return $_retorno;
    }

    /**
     * Lista las reglas disponibles para incorporar en los diálogos del sistema.
     * @return Regla[] Arreglo con todas las reglas del maestro Reglas.
     */
    public function obtenerReglasSistema() {
        $_retorno = array();
        $conexion = ConnectionManager::ObtenerConexion();
        try {
            $_exito = $conexion->abrirConexion();
            if ($_exito) {
                $_query = new Query($conexion, "maestro_regla");
                $_query->addCampo("n_id_regla");
                $_query->addCampo("x_texto_regla");
                $_query->addCampo("d_fecha_creacion");

                $_tablaRegla = $conexion->consultar($_query->QuerySelect());
                $conexion->cerrarConexion();
                $_retorno = array();
                $i = 0;
                foreach ($_tablaRegla as $dr) {
                    $_nueva = new Regla();
                    $_nueva->idRegla = $dr["n_id_regla"];
                    $_nueva->textoRegla = $dr["x_texto_regla"];
                    $_nueva->fechaCreacion = $dr["d_fecha_creacion"];

                    array_push($_retorno, $_nueva);
                }
            }
        } catch (Exception $e) {
            
        }
        return $_retorno;
    }

    /**
     * Lista las reglas definidas para el diálogo indicado
     * @param int $idDialogo Identificador del dialogo
     * @return Regla[] Arreglo de reglas con las reglas asociadas.
     */
    public function obtenerReglas($idDialogo) {
        //Regla[]
        $_retorno = array();
        $conexion = ConnectionManager::ObtenerConexion();
        try {
            $_exito = $conexion->abrirConexion();
            if ($_exito) {
                $_query = new Query($conexion, "regla_dialogo");

                $_query->addCampo("n_id_regla_dialogo");
                $_query->addCampo("x_texto_regla_dialogo");
                $_query->addCampo("d_fecha_creacion");
                $_query->addCondicion("n_id_dialogo=" . $idDialogo);

                $_tablaRegla = $conexion->consultar($_query->QuerySelect());
                $conexion->cerrarConexion();
                $_retorno = array();
                $i = 0;
                foreach ($_tablaRegla as $dr) {
                    $_nueva = new Regla();
                    $_nueva->idRegla = $dr["n_id_regla_dialogo"];
                    $_nueva->textoRegla = $dr["x_texto_regla_dialogo"];
                    $_nueva->fechaCreacion = $dr["d_fecha_creacion"];

                    $_retorno[$i++] = $_nueva;
                }
            }
        } catch (Exception $e) {
            
        }
        return $_retorno;
    }

}

?>
