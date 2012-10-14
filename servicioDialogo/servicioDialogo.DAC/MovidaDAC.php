<?php

if (file_exists('./servicioDialogo.Datos/MovidaCorregida.php'))
    require_once './servicioDialogo.Datos/MovidaCorregida.php';
else
    require_once '../servicioDialogo.Datos/MovidaCorregida.php';

/**
 * Realiza y genera consultas vinculadas con la tabla movida. 
 */
class MovidaDAC {

    /**
     * Actualiza una movida en el maestro de movidas
     * @param Movida $mov 
     */
    public function actualizarMovida($mov) {
        $_ret = false;
        $conexion = ConnectionManager::ObtenerConexion();
        try {
            $_exito = $conexion->abrirConexion();
            if($_exito){
                $x_id_usuario = $mov->autor->nombreUsuario;
                $x_nombre_movida = $mov->Nombre;
                $x_descripcion_movida = $mov->descripcion;
                $d_fecha_creacion = date("d-m-Y H:i:s");
                $n_eje_movida = $mov->eje;
                
                if($x_nombre_movida == null || strlen(trim($x_nombre_movida)) == 0){
                    return false;
                }
                
                $_query = new Query($conexion, "maestro_movida");
                if($x_id_usuario != null && strlen(trim($x_id_usuario)) > 0)
                    $_query->addValorString ("x_id_usuario", $x_id_usuario);
                $_query->addValorString("x_nombre_movida", $x_nombre_movida);
                $_query->addValorString("x_descripcion_movida", $x_descripcion_movida);
                $_query->addValorString("n_eje_movida", $n_eje_movida);
                $_query->addValorString("d_fecha_creacion", $d_fecha_creacion);
                $_query->addCondicion("n_id_movida=" . $mov->IdMovida);
                $_ret = $conexion->modificar($_query->QueryUpdate());
                $conexion->cerrarConexion();
            }
        } catch (Exception $e) {
            
        }
        return $_ret;
    }

    /**
     * Agrega la movida a la categoria indicada.
     * @param CategoriaMovida $categoria categoría a la que se desea agregar la movida. Importa el id.
     * @param Movida $movida Movida para asignar a la categoria. Importa el ID.
     * @return bool Verdadero si la asociación fue correcta.
     */
    public function asociarCategorias($categoria, $movida) {
        $_ret = false;
        $conexion = ConnectionManager::ObtenerConexion();
        try {
            $_exito = $conexion->abrirConexion();
            if ($_exito) {
                $q = new Query($conexion, "maestro_det_categoria");
                $q->addValorString("n_id_movida", $movida->IdMovida);
                $q->addValorString("n_id_categoria", $categoria->idCategoria);
//                echo $q->QueryInsert();
                $_ret = $conexion->modificar($q->QueryInsert());
                $conexion->cerrarConexion();
            }
        } catch (Exception $e) {
            
        }

        return $_ret;
    }

    /**
     * Inserta una movida en el maestro de movidas.
     * @param Movida $mov 
     */
    public function insertarMovida($mov) {
        $_ret = false;
        $conexion = ConnectionManager::ObtenerConexion();
        try {
            $_exito = $conexion->abrirConexion();
            if ($_exito) {
                $x_id_usuario = $mov->autor->nombreUsuario;
                $x_nombre_movida = $mov->Nombre;
                $x_descripcion_movida = $mov->descripcion;
                $d_fecha_creacion = date("d-m-Y H:i:s");
                $n_eje_movida = $mov->eje;

                if ($x_nombre_movida == null || strlen(trim($x_nombre_movida)) == 0)
                    return false;

                $_query = new Query($conexion, "maestro_movida");
                if ($x_id_usuario != null && strlen(trim($x_id_usuario)) > 0)
                    $_query->addValorString("x_id_usuario", $x_id_usuario);
                $_query->addValorString("x_nombre_movida", $x_nombre_movida);
                $_query->addValorString("x_descripcion_movida", $x_descripcion_movida);
                $_query->addValorString("n_eje_movida", $n_eje_movida);
                $_query->addValorString("d_fecha_creacion", $d_fecha_creacion);

                $_ret = $conexion->modificar($_query->QueryInsert());

                $tid = $conexion->consultar("select n_id_movida from maestro_movida where x_nombre_movida='" . $x_nombre_movida . "'");
                $mov->IdMovida = intval($tid[0]["n_id_movida"]);

                $conexion->cerrarConexion();
            }
        } catch (Exception $e) {
            
        }
        
        return $_ret;
    }

    /**
     * Copia las movidas de la categoría indicada.
     * la copia se realiza desde el maestro de movidas, al detalle de movidas para el diálogo.
     * @param Dialogo $dialogo
     * @param CategoriaMovida $categoria 
     * @return bool Verdadero para el éxito.
     */
    public function copiarMovidas($dialogo, $categoria) {
        $_ret = false;

        $idDialogo = $dialogo->idDialogo;

        $idCategoria = $categoria->idCategoria;
        $conexion = ConnectionManager::ObtenerConexion();
        try {
            $_exito = $conexion->abrirConexion();
            if ($_exito) {
                $_q = "insert into movida_dialogo";
                $_q .= "(n_id_dialogo,x_nombre_movida,x_descripcion_movida,x_icono_movida,n_eje_movida)";
                $_q .= " select " . $idDialogo . " id_dialogo, m.x_nombre_movida,m.x_descripcion_movida,";
                $_q .= " m.x_icono_movida,m.n_eje_movida";
                $_q .= " from maestro_movida m";
                $_q .= " inner join maestro_det_categoria d on m.n_id_movida = d.n_id_movida";
                $_q .= " and d.n_id_categoria = " . $idCategoria;

                $_ret = $conexion->modificar($_q);
            }
        } catch (Exception $e) {
            
        }
        $conexion->cerrarConexion();

        return $_ret;
    }

    /**
     * Obtiene las movidas para la categoría indicada.
     * @param CategoriaMovida $categoria Categoría a la que se desea obtener las movidas. Importa el ID.
     * @return Movida[] Colección de movidas para la categoría indicada.
     */
    public function seleccionarMovidas($categoria) {
        $conexion = ConnectionManager::ObtenerConexion();
        $_exito = $conexion->abrirConexion();

        $_ret = array();

        if ($_exito) {
            try {
                $_query = "select m.* from maestro_movida m"
                        . " inner join maestro_det_categoria d on m.n_id_movida = d.n_id_movida"
                        . " and d.n_id_categoria = " . $categoria->idCategoria . "order by x_nombre_movida ASC";

//                echo $_query;
                $_tablaMovidas = $conexion->consultar($_query);
                $conexion->cerrarConexion();

                $_movidas = array();
                foreach ($_tablaMovidas as $dr) {

                    $_mov = new Movida();
                    $_mov->Nombre = $dr["x_nombre_movida"];
                    $_mov->Icono = $dr["x_icono_movida"];
                    $_mov->descripcion = $dr["x_descripcion_movida"];
                    $_mov->IdMovida = $dr["n_id_movida"];
                    $_mov->eje = $dr["n_eje_movida"];

                    array_push($_movidas, $_mov);
                }

                $_ret = $_movidas;
            } catch (Exception $e) {
                
            }
        }
        return $_ret;
    }

    /**
     * Guarda la sugerencia de corrección
     * @param string $usuario Nombre de usuario que realizó la corrección
     * @param int $idIntervencion Identificador de la intervención con la sugerencia.
     * @param MovidaCorregida $movidaCorregida Movida que corresponde a la corrección.
     */
    public function insertarCorreccion($usuario, $idIntervencion, $movidaCorregida) {
        $_ret = false;

        $n_id_movida_dialogo = $movidaCorregida->IdMovida;

        $conexion = ConnectionManager::ObtenerConexion();
        try {
            $_exito = $conexion->abrirConexion();
            if ($_exito) {
                $_q = new Query($conexion, "correccion_movida");
                $_q->addValorString("n_id_intervencion", $idIntervencion);
                $_q->addValorString("x_id_usuario", $usuario);
                $_q->addValorString("n_id_movida_dialogo", $movidaCorregida->IdMovida);

                $_ret = $conexion->modificar($_q->QueryInsert());
                $conexion->cerrarConexion();
            }
        } catch (Exception $e) {
            $conexion->cerrarConexion();
        }

        return $_ret;
    }

    /**
     * Modifica una sugerencia de corrección ya realizada.
     * @param int $idCorreccion ID único de la corrección ya realizada.
     * @param MovidaCorregida $movidaCorregida Nueva movida ya corregida.
     * @return bool Verdadero si la actualización fue exitosa.
     */
    public function actualizarCorreccion($idCorreccion, $movidaCorregida) {
        $_ret = false;

        $n_id_movida_dialogo = $movidaCorregida->IdMovida;

        $conexion = ConnectionManager::ObtenerConexion();
        try {
            $_exito = $conexion->abrirConexion();
            if ($_exito) {
                $_q = new Query($conexion, "correccion_movida");
                $_q->addValorString("n_id_movida_dialogo", $movidaCorregida->IdMovida);
                $_q->addCondicion("n_id_correccion_movida=" . $idCorreccion);

                $_ret = $conexion->modificar($_q->QueryUpdate());

                $conexion->cerrarConexion();
            }
        } catch (Exception $e) {
            $conexion->cerrarConexion();
        }

        return $_ret;
    }

    /**
     * Actualiza el tipo de movida para la intervencion indicada.
     * @param Intervencion $intervencion Intervención a actualizar. Importa el ID
     * @param MovidaCorregida $movidaCorregida Nueva movida para asignar. Importa el ID.
     * @return bool Verdadero si la actualización fue exitosa.
     */
    public function cambiarTipoIntervencion($intervencion, $movidaCorregida) {
        $_ret = false;

        $n_id_intervencion = $intervencion->idIntervencion;

        $conexion = ConnectionManager::ObtenerConexion();

        try {
            $_exito = $conexion->abrirConexion();
            if ($_exito) {
                $_q = new Query($conexion, "intervencion");

                $_q->addValorString("n_id_movida", $movidaCorregida->IdMovida);

                $_q->addCondicion("n_id_intervencion=" . $n_id_intervencion);
                $_ret = $conexion->modificar($_q->QueryUpdate());
                $conexion->cerrarConexion();
            }
        } catch (Exception $e) {
            $conexion->cerrarConexion();
        }

        return $_ret;
    }

    /**
     * Selecciona la movida corregida, en caso de no existir retorna un objeto vacío.
     * @param int $idIntervencion Identificador de la intervención.
     * @param Usuario $usuario Nombre de usuario a buscar.
     */
    public function seleccionarCorreccion($idIntervencion, $usuario) {
        $_ret = new MovidaCorregida();
        $x_id_usuario = $usuario->nombreUsuario;
        $conexion = ConnectionManager::ObtenerConexion();
        try {
            $_exito = $conexion->abrirConexion();
            if ($_exito) {
                $_q = new Query($conexion, "correccion_movida");
                $_q->addCampo("n_id_correccion_movida");
                $_q->addCampo("n_id_movida_dialogo");

                $_q->addCondicionAND("x_id_usuario='" . $x_id_usuario . "'");
                $_q->addCondicionAND("n_id_intervencion=" . $idIntervencion);

                $_tabla = $conexion->consultar($_q->QuerySelect());

                $conexion->cerrarConexion();

                if (count($_tabla) > 0) {
                    $_dr = $_tabla[0];
                    $_ret = new MovidaCorregida();
                    $_ret->idCorrección = $_dr["n_id_correccion_movida"];
                    $_ret->IdMovida = $_dr["n_id_movida_dialogo"];

                    $_ret->autor = $usuario;
                }
            }
        } catch (Exception $e) {
            $conexion->cerrarConexion();
        }

        return $_ret;
    }

    public function seleccionarMovidasDialogo($idDialogo) {
        $_retorno = array();
        $conexion = ConnectionManager::ObtenerConexion();
        try {
            $_exito = $conexion->abrirConexion();
            if ($_exito) {
                $_consulta = new Query($conexion, "movida_dialogo");
                $_consulta->addCampo("n_id_movida_dialogo");
                $_consulta->addCampo("x_nombre_movida");
                $_consulta->addCampo("x_descripcion_movida");
                $_consulta->addCampo("x_icono_movida");
                $_consulta->addCampo("n_eje_movida");
                
                $_consulta->addCondicion("n_id_dialogo=" . $idDialogo);
                $_consulta->addOrden("x_nombre_movida ASC");
                
//                print_r($_consulta->QuerySelect());
                $_tablaMovidas = $conexion->consultar($_consulta->QuerySelect());
                $conexion->cerrarConexion();
//echo json_encode($_tablaMovidas);
                $_retorno = Array();

                $i = 0;
                foreach ($_tablaMovidas as $dr) {
                    $_nueva = new Movida();
                    $_nueva->IdMovida = $dr["n_id_movida_dialogo"];
                    $_nueva->Nombre = $dr["x_nombre_movida"];
                    $_nueva->descripcion = $dr["x_descripcion_movida"];
                    $_nueva->Icono = $dr["x_icono_movida"];
                    $_nueva->eje = $dr["n_eje_movida"];
                    array_push($_retorno, $_nueva);
//$_retorno[$i++] = $_nueva;
                }
            }
        } catch (Exception $e) {
            
        }

        return $_retorno;
    }

    /**
     * Obtiene todas las correcciones ingresadas para el dialogo indicado.
     * @param int $idDialogo Identificador único del diálogo.
     * @return MovidaCorregida[] Colección de correcciones.
     */
    public function seleccionarSugerenciasDialogo($idDialogo) {
        $_retorno = new MovidaCorregida();

        $conexion = ConnectionManager::ObtenerConexion();

        try {
            $_exito = $conexion->abrirConexion();
            if ($_exito) {
                $_q = "select cm.n_id_correccion_movida,cm.n_id_intervencion,cm.x_id_usuario";
                $_q .= ",cm.n_id_movida_dialogo,md.x_nombre_movida,md.x_descripcion_movida";
                $_q .= ",md.x_icono_movida,md.n_eje_movida";
                $_q .= " from correccion_movida cm";
                $_q .= " inner join movida_dialogo md on cm.n_id_movida_dialogo = md.n_id_movida_dialogo";
                $_q .= " inner join dialogo dia on md.n_id_dialogo = dia.n_id_dialogo";
                $_q .= " where dia.n_id_dialogo = " . $idDialogo;

                //echo json_encode($_q);
                $_tablaMovidas = $conexion->consultar($_q);

                $conexion->cerrarConexion();

                //MovidaCorregida[]
                $_retorno = array();

                $i = 0;
                foreach ($_tablaMovidas as $dr) {
                    $_nueva = new MovidaCorregida();
                    $_nueva->IdMovida = $dr["n_id_movida_dialogo"];
                    $_nueva->Nombre = $dr["x_nombre_movida"];
                    $_nueva->descripcion = $dr["x_descripcion_movida"];
                    $_nueva->Icono = $dr["x_icono_movida"];
                    $_nueva->eje = $dr["n_eje_movida"];
                    $_nueva->idCorrección = $dr["n_id_correccion_movida"];
                    $_nueva->idIntervencionAsociada = $dr["n_id_correccion_movida"];
                    $_nueva->usuarioCorrector = $dr["x_id_usuario"];
                    $_retorno[$i++] = $_nueva;
                }
            }
        } catch (Exception $e) {
            
        }
        return $_retorno;
    }

}

?>
