<?php

/**
 *Inserta y selecciona datos inculados a la tabla Acta. 
 */
class ActaDAC{
    
    
    /**
     *Selecciona todas las actas para el identificador indicado.
     * @param Int $idDialogo Identificador único del diálogo. Basado en la regla de 1 acta por diálogo y por usuario.
     * @return Acta[] Colección de objetos Acta si existe. Null en caso contrario.
     */
    public function seleccionarActas($idDialogo){
        $_retorno = null;
        $conexion = ConnectionManager::ObtenerConexion();
        try{
            $_exito = $conexion->abrirConexion();
            if($_exito){
                $_q = new Query($conexion, "acta");
                $_q->addCampo("n_id_acta");
                $_q->addCampo("x_texto_acta");
                $_q->addCampo("d_fecha_modificacion");
                $_q->addCampo("x_id_usuario");
                $_q->addCondicionAND("n_id_dialogo=" . $idDialogo);
                //echo $_q->QuerySelect();
                $_tabla = $conexion->consultar($_q->QuerySelect());
                $conexion->cerrarConexion();
                
                if($_tabla != null && count($_tabla) > 0){
                    $actas = array();
                    
                    foreach($_tabla as $dr){
                        $nueva = new Acta();
                        $nueva->idActa = $dr["n_id_acta"];
                        $nueva->TextoActa = $dr["x_texto_acta"];
                        $nueva->fechaModificacion = $dr["d_fecha_modificacion"];
                        $nueva->UsuarioCreador->nombreUsuario = $dr["x_id_usuario"];
                        array_push($actas, $nueva);
                    }
                    $_retorno = $actas;
                }
            }
    }catch(Exception $e){}
    
    return $_retorno;
    }
    
    
    
    /**
     *Actualiza el acta en la base de datos.
     * @param Acta $acta
     * @return bool Verdadero si la consulta fue realizada correctamente. 
     */
    public function actualizarActa($acta){
        $_retorno = false;
        $conexion = ConnectionManager::ObtenerConexion();
        try{
            $_exito = $conexion->abrirConexion();
            if($_exito){
                $_q = new Query($conexion, "acta");
                $_q->addValorString("x_texto_acta", $acta->TextoActa);
                $_q->addValorString("d_fecha_modificacion", date("d-m-Y H:i:s"));
                $_q->addCondicionAND("n_id_acta=" . $acta->idActa);
                //echo $_q->QueryUpdate();
                $_retorno = $conexion->modificar($_q->QueryUpdate());
                $conexion->cerrarConexion();
            }
    }catch(Exception $e){}
    
    return $_retorno;
    }
    
    
    /**
     *Inserta una nueva acta en la base de datos.
     * @param Acta $acta Objeto acta completo. Incluyendo el diálogo que lo contiene.
     * @return bool Verdadero si la consulta fue realizada satisfactoriamente.
     */
    public function insertarActa($acta){
        $_retorno = false;
        $conexion = ConnectionManager::ObtenerConexion();
        try{
            $_exito = $conexion->abrirConexion();
            if($_exito){
                
                $_q = new Query($conexion, "acta");
                $_q->addValorString("n_id_dialogo", $acta->dialogoPadre->idDialogo);
                $_q->addValorString("x_id_usuario", $acta->UsuarioCreador->nombreUsuario);
                $_q->addValorString("x_texto_acta", $acta->TextoActa);
                $_q->addValorString("d_fecha_modificacion", date("d-m-Y H:i:s"));
                
                $_retorno = $conexion->modificar($_q->QueryInsert());
                $conexion->cerrarConexion();
                
            }
    }catch(Exception $e){}
    
    return $_retorno;
    }
    
    
    /**
     *Selecciona un acta de la base de datos.
     * @param int $idDialogo Identificador único del dialogo. basado en la regla de 1 acta por dialogo y usuario.
     * @param string $nombreUsuario Nombre de usuario del acta
     * @return Acta Objeto acta si existe. null en caso contrario.
     */
    public function seleccionarActa($idDialogo, $nombreUsuario){
        $_retorno = null;
        $conexion = ConnectionManager::ObtenerConexion();
        try{
            $_exito = $conexion->abrirConexion();
            if($_exito){
                $_q = new Query($conexion, "acta");
                $_q->addCampo("n_id_acta");
                $_q->addCampo("x_texto_acta");
                $_q->addCampo("d_fecha_modificacion");
                
                $_q->addCondicionAND("n_id_dialogo=" . $idDialogo);
                $_q->addCondicionAND("x_id_usuario='" . $nombreUsuario . "'");
                
                $_tabla = $conexion->consultar($_q->QuerySelect());
                $conexion->cerrarConexion();
                if($_tabla != null && count($_tabla) > 0){
                    $_dr = $_tabla[0];
                    $_retorno = new Acta();
                    $_retorno->idActa = $_dr["n_id_acta"];
                    $_retorno->TextoActa = $_dr["x_texto_acta"];
                    $_retorno->fechaModificacion = $_dr["d_fecha_modificacion"];
                }
            }
    }catch(Exception $e){}
    
    return $_retorno;
    }
}
?>
