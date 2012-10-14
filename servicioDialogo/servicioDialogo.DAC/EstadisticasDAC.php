<?php

/**
 *Genera y ejecuta consultas para obtener estadísticas acerca de los dialogos. 
 */
class EstadisticasDAC{
    
    /**
     *Consulta la cantidad de intervenciones realizadas por cada participante.
     * @param int $idDialogo Identificador del diálogo a analizar
     * @return DataTable Tabla con todos los participantes,
     * y su cantidad de intervenciones realizada para cada tipo de movida (id).
     * columnas: x_id_usuario: identificador del usuario.
     * n_id_movida_dialogo: Identificador de la movida.
     * cuenta: Cantidad de veces que el usaurio utilizó la movida.
     */
    public function seleccionarMovidasParticipante($idDialogo){
        $_ret = null;
        $conexion = ConnectionManager::ObtenerConexion();
        
        $_exito = $conexion->abrirConexion();
        if($_exito){
            $_q = "select i.x_id_usuario,m.n_id_movida_dialogo, m.x_nombre_movida, count(i.n_id_intervencion) cuenta";
            $_q .= " from intervencion i ";
            $_q .= " inner join movida_dialogo m on m.n_id_movida_dialogo = i.n_id_movida";
            $_q .= " where i.n_id_dialogo = " . $idDialogo;
            $_q .= " group by i.x_id_usuario,m.n_id_movida_dialogo,m.x_nombre_movida";
//            echo $_q;
            $_ret = $conexion->consultar($_q);
            $conexion->cerrarConexion();
            //$_ret
        }
        
        return $_ret;
    }
}
?>
