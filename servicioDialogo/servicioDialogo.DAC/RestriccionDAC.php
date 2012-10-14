<?php

/**
 * Realiza y genera consultas vinculadas con las restricciones de acceso para un diálogo.
 */
class RestriccionDAC {

    
    /**
     *Agrega un usuario a la tabla de restricciones del sistema.
     * @param Dialogo $dialogo 
     */
    public function insertarRestricciones($dialogo){
        $_retorno = false;
        $conexion = ConnectionManager::ObtenerConexion();
        $_exito = $conexion->abrirConexion();
        
        if($_exito){
            foreach($dialogo->usuariosPermitidos as $usu){
                $_q = new Query($conexion, "restriccion_dialogo");
                $_q->addValorString("n_id_dialogo", $dialogo->idDialogo);
                $_q->addValorString("x_id_string", $usu->nombreUsuario);
                
                $conexion->modificar($_q->QueryInsert());
                $conexion->cerrarConexion();
            }
            $_retorno = true;
        }
        return $_retorno;
    }
    
    
    /**
     * Obtiene las restricciones desde la base de datos.
     * @param int $idDialogo 
     */
    public function seleccionarRestricciones($idDialogo) {
        //Usuario[]
        $_retorno = array();
        $conexion = ConnectionManager::ObtenerConexion();
        $_exito = $conexion->abrirConexion();

        if (!$_exito) {
            return $_retorno;
        }

        $_q = new Query($conexion, "restriccion_dialogo");
        $_q->addCampo("x_id_usuario");
        $_q->addCampo("n_id_restriccion");
        $_q->addCondicion("n_id_dialogo=" . $idDialogo);
        $_tabla = $conexion->consultar($_q->QuerySelect());
        
        $_retorno = array();
        $i = 0;
        foreach($_tabla as $dr){
            $_nuevo = new Usuario();
            $_nuevo->nombreUsuario = $dr["x_id_usuario"].ToString();
            $_retorno[$i++] = $_nuevo;
        }
        
        return $_retorno;
    }

}

?>
