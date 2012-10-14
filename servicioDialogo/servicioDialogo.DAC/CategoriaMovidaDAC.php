<?php

if (file_exists('./servicioDialogo.Datos/CategoriaMovida.php'))
    require_once './servicioDialogo.Datos/CategoriaMovida.php';
else {
    require_once '../servicioDialogo.Datos/CategoriaMovida.php';
}

/**
 * Accede a los datos vinculados con las categorías de intervenciones. 
 */
class CategoriaMovidaDAC {

     /**
     * obtiene la movida predeterminada para la creación del diálogo para la categoria señalada.
     * única para la creación de diálogos.
     * @param type $idCategoria
     * @param type $idMovida 
     */
    function obtenerMovidaCrearDialogo($idCategoria) {
        $_ret = 0;
        $conexion = ConnectionManager::ObtenerConexion();

        try {
            $_exito = $conexion->abrirConexion();
            if($_exito){
                $_query = new Query($conexion, "maestro_categoria");
                $_query->addCampo("n_movida_crear_dialogo");
                $_query->addCondicion("n_id_categoria=" . $idCategoria);
                
//                echo $_query->QuerySelect();
                $db = $conexion->consultar($_query->QuerySelect());
//                print_r($db);
                
                $_ret = $db[0]["n_movida_crear_dialogo"];
            }
            
        } catch (Exception $e) {
            return 0;
        }
        
        return $_ret;
    }
    /**
     * inserta en la categoria señalada, la movida seleccionada como
     * única para la creación de diálogos.
     * @param type $idCategoria
     * @param type $idMovida 
     */
    public function insertarMovidaCrearDialogo($idCategoria, $idMovida) {
        $_ret = false;
        $conexion = ConnectionManager::ObtenerConexion();

        try {
            $_exito = $conexion->abrirConexion();
            if($_exito){
                $_query = new Query($conexion, "maestro_categoria");
                $_query->addValorString("n_movida_crear_dialogo", $idMovida);
                $_query->addCondicion("n_id_categoria=" . $idCategoria);
                
//                echo $_query->QueryUpdate();
                $_ret = $conexion->modificar($_query->QueryUpdate());
            }
            
        } catch (Exception $e) {
            return false;
        }
        
        return $_ret;
    }

    /**
     *
     * @param CategoriaMovida $categoria 
     */
    public function actualizarCategoria($categoria) {
        $_ret = false;
        $conexion = ConnectionManager::ObtenerConexion();

        try {
            $_exito = $conexion->abrirConexion();
            if ($_exito) {
                $x_id_usaurio = $categoria->autor->nombreUsuario;
                $x_nombre_categoria = $categoria->nombre;
                $x_descripcion_categoria = $categoria->descripcion;
                $d_fecha_creacion = date("d-m-Y H:i:s");

                if ($x_nombre_categoria == null || strlen(trim($x_nombre_categoria)) == 0)
                    return false;

                $_query = new Query($conexion, "maestro_categoria");

                if ($x_id_usaurio != null && strlen(trim($x_id_usaurio)) == 0)
                    $_query->addValorString("x_id_usuario", $x_id_usaurio);
                $_query->addValorString("x_nombre_categoria", $x_nombre_categoria);
                $_query->addValorString("x_descripcion_categoria", $x_descripcion_categoria);
                $_query->addValorString("d_fecha_creacion", $d_fecha_creacion);

                $_query->addCondicion("n_id_categoria=" . $categoria->idCategoria);

                $_ret = $conexion->modificar($_query->QueryUpdate());
                $conexion->cerrarConexion();
            }
        } catch (Exception $ex) {
            
        }
        return $_ret;
    }

    /**
     * Inserta una categoría de movida en el maestro de movidas.
     * @param CategoriaMovida $categoria 
     */
    public function insertarCategoria($categoria) {
        $_ret = false;
        $conexion = ConnectionManager::ObtenerConexion();
        try {
            $_exito = $conexion->abrirConexion();
            if ($_exito) {
                $x_id_usuario = $categoria->autor->nombreUsuario;
                $x_nombre_categoria = $categoria->nombre;
                $x_descripcion_categoria = $categoria->descripcion;
                $d_fecha_creacion = date("d-m-Y H:i:s");

                if ($x_nombre_categoria == null || strlen(trim($x_nombre_categoria)) == 0)
                    return false;

                $_query = new Query($conexion, "maestro_categoria");

                if ($x_id_usuario != null && strlen(trim($x_nombre_categoria) == 0))
                    $_query->addValorString("x_id_usuario", $x_id_usuario);
                $_query->addValorString("x_nombre_categoria", $x_nombre_categoria);
                $_query->addValorString("x_descripcion_categoria", $x_descripcion_categoria);
                $_query->addValorString("d_fecha_creacion", $d_fecha_creacion);

//                echo $_query->QueryInsert();
                $_ret = $conexion->modificar($_query->QueryInsert());

                $tid = $conexion->consultar("select n_id_categoria from maestro_categoria where x_nombre_categoria='" . $x_nombre_categoria . "'");
//                echo json_encode($tid[0]["n_id_categoria"]);
                $categoria->idCategoria = intval($tid[0]["n_id_categoria"]);


                $conexion->cerrarConexion();
            }
        } catch (Exception $e) {
            
        }

        if (is_array($_ret)) {
            if (count($_ret) > 0)
                return true;
            else
                return false;
        }

        return $_ret;
    }

    /**
     * Obtiene una lista de las categorías creadas en el sistema.
     * @return CategoriaMovida[] Colección de categorías de movidas disponibles en el sistema, con su detalle. 
     */
    public function seleccionarCategorias() {
        $_retorno = array();
        $conexion = ConnectionManager::ObtenerConexion();

        try {
            $_exito = $conexion->abrirConexion();
            if ($_exito) {
                $_query = new Query($conexion, "maestro_categoria");
                $_query->addCampo("n_id_categoria");
                $_query->addCampo("x_nombre_categoria");
                $_query->addCampo("x_descripcion_categoria");
                $_query->addOrden("x_nombre_categoria ASC");
//echo $_query->QuerySelect();
                $_dt = $conexion->consultar($_query->QuerySelect());

                if ($_dt != null) {
                    $_retorno = array();
                    $i = 0;
                    foreach ($_dt as $dr) {
                        $_nueva = new CategoriaMovida();

                        $_nueva->idCategoria = $dr["n_id_categoria"];
                        $_nueva->nombre = $dr["x_nombre_categoria"];
                        $_nueva->descripcion = $dr["x_descripcion_categoria"];
                        array_push($_retorno, $_nueva);
                    }
                }
            }
        } catch (Exception $e) {
            
        }

        return $_retorno;
    }

}

?>
